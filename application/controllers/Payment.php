<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('payment_model');
        $this->load->model('users');
        $this->load->model('user_genaral');
        $this->load->model('transaction_model');
    }

    public function sell_payments()
    {
    	$data['page_title']	= 'Sales Payments';
    	$data['data'] = $this->payment_model->get_sell_payments('sales');
    	$this->load->template('payment/sell_payments',$data);
    }


    public function sell_view($id)
    {
        $data['page_title'] = 'View Sale Installment Receipt';
        $data['sell_payment'] = $this->payment_model->get_sell_payment($id)[0];
        $this->load->template('payment/sell_receipt',$data);
    }

    public function sell_print($id)
    {
        $data['page_title'] = 'Print Sale Installment Receipt';
        $data['sell_payment'] = $this->payment_model->get_sell_payment($id)[0];
        $this->load->view('payment/sale_print',$data);
    }

    public function sell()
    {
    	$data['page_title']	= 'Sales Payment';
    	$data['all_sales'] = $this->payment_model->get_installment_yes_all();
    	$this->load->template('payment/sell',$data);
    }

    public function save_sell()
    {
    	$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
    	$this->form_validation->set_rules('customer_id', 'Customer Name', 'required');
    	
    	if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Sales Payment';
	    	$data['all_sales'] = $this->payment_model->get_installment_yes_all();
	    	$this->load->template('payment/sell',$data);
		}
		else
		{
			redirect(base_url().'payment/add_sell/'.$_POST['customer_id']);
		}
    }


    public function add_sell($id = FALSE)
    {
    	if($id)
    	{
    		if($this->payment_model->get_sell_for_payment($id))
    		{
    			$data['page_title']	= 'Pay Sales Installment';
    			$data['sell_data'] = $this->payment_model->get_sell_for_payment($id)[0];
    			$data['payment'] = $this->payment_model->get_sell_paid_installment($id);
    			$data['get_installment'] = $this->payment_model->get_sell_installment($id);
    			$this->load->template('payment/add_sell',$data);
    		}
    		else
    		{
    			$this->session->set_flashdata('error', 'Customer Name Is Not Valid Please Try Again');
	        	redirect(base_url().'payment/sell');
    		}
    	}
    	else
    	{
    		$this->session->set_flashdata('error', 'Customer Name Is Not Valid Please Try Again');
	        redirect(base_url().'payment/sell');
    	}
    }



    public function sell_pay()
    {
    		$payment = array(
		        'main_id'           	=> 	$this->input->post('sell_id'),
		        'installment_id'        => 	$this->input->post('installment_id'),
		        'type'           		=> 	'sales',
                'date'                  =>  _ddate($this->input->post('date')),
                'amount_install'        =>  $this->input->post('instal_remaining'),
		        'late_charge'           => 	trim($this->input->post('late_charge')),
		        'pay_type'           	=> 	$this->input->post('payment_mode'),
		        'pay_detail'           	=> 	$this->input->post('payment_mode_detail'),
		        'created_at'            =>  date('Y-m-d H:i:s'),
                'updated_at'            =>  date('Y-m-d H:i:s'),
                'created_by'            =>  $this->session->userdata('id'),
                'updated_by'            =>  $this->session->userdata('id')
		    );

		    if($this->db->insert('payment', $payment))
		    {
                $payment_id = $this->db->insert_id();
                if( $this->input->post('instal_remaining') == $this->input->post('remaning_ins_pay') ){
    		    	$update_installment = array(
    		    		'status'   			=> 1,
                        'instal_remaining'            => ($this->input->post('remaning_ins_pay') - $this->input->post('instal_remaining'))
    		    	);
                    $this->db->where('id', $this->input->post('installment_id'));
                    $this->db->update('sell_installment_detail', $update_installment);

                    
                }
                else
                {
                    $update_installment = array(
                        'instal_remaining'            => ($this->input->post('remaning_ins_pay') - $this->input->post('instal_remaining'))
                    );
                    $this->db->where('id', $this->input->post('installment_id'));
                    $this->db->update('sell_installment_detail', $update_installment);
                }
		    	
                    $update_sell = array(
                        'rem_amount'            => ($this->input->post('sale_remaning_amt') - $this->input->post('instal_remaining'))
                    );

                    $this->db->where('id', $this->input->post('sell_id'));
                    $this->db->update('sell_product', $update_sell);
				    
                    $sell_insert_id = $this->input->post('sell_id');

                    $commission_agent = $this->user_genaral->commission_agent_ins($sell_insert_id,floatval($this->input->post('instal_remaining')),_ddate($this->input->post('date')),'installment_',$payment_id);

                        $promotio_agent = $this->user_genaral->promotion_agent_ins($sell_insert_id,floatval($this->input->post('instal_remaining')),_ddate($this->input->post('date')),'installment_',$payment_id);
                        
                        $commission_parterner = $this->user_genaral->commission_parterner_ins($sell_insert_id,floatval($this->input->post('instal_remaining')),_ddate($this->input->post('date')),'installment_',$payment_id);

                        $after_shares_amount = $commission_agent + $promotio_agent + $commission_parterner;

                        $new_due = $this->input->post('instal_remaining') - $after_shares_amount;

                        $sales_profit = $this->user_genaral->share_company_after_all_ins($sell_insert_id,floatval($new_due),_ddate($this->input->post('date')),'installment_',$payment_id);

                if($this->input->post('late_charge') > 0){

                    $transaction = [
                        'type'              =>  'late_payment',
                        'credit'             =>  $this->input->post('late_charge'), 
                        'credit_by'          =>  0,
                        'date'              =>  _ddate($this->input->post('date')),
                        'investment_id'     =>  $payment_id,
                        'created_by'        =>  $this->session->userdata('id'),
                        'created_at'        =>  date('Y-m-d H:i:s')
                    ];

                    $this->db->insert('transaction', $transaction);
                }


				$this->session->set_flashdata('msg', 'Payment Added Successfully');
	        	redirect(base_url().'payment/sell_payments');

		    }
		    else
		    {
		    	$this->session->set_flashdata('error', 'Problem In Add Payment Try Again');
	        	redirect(base_url().'payment/sell');
		    }
    }


    public function sale_edit($id){
        $data['page_title'] = 'Edit Sales Installment';
        $data['sale'] = $this->payment_model->get_sell_installment_by_id($this->payment_model->_payment($id)['installment_id']);
        $data['payment'] = $this->payment_model->_payment($id);
        $this->load->template('payment/edit_sale',$data);
    }

    public function sale_update()
    {
            $payment = array(
                'date'                  =>  _ddate($this->input->post('date')),
                'late_charge'           =>  trim($this->input->post('late_charge')),
                'pay_type'              =>  $this->input->post('payment_mode'),
                'pay_detail'            =>  $this->input->post('payment_mode_detail'),
                'updated_at'            =>  date('Y-m-d H:i:s'),
                'updated_by'            =>  $this->session->userdata('id')
            );

                $this->db->where('id', $this->input->post('id'));
            if($this->db->update('payment', $payment))
            {
                $this->session->set_flashdata('msg', 'Payment Updated Successfully');
                redirect(base_url().'payment/sell_payments');
            }
            else
            {
                $this->session->set_flashdata('error', 'Problem In Update Payment Try Again');
                redirect(base_url().'payment/sell_payments');
            }
    }


    public function delete_sale($id)
    {

        $payment = $this->payment_model->_payment($id);

        $get_installment = $this->payment_model->get_sell_installment_by_id($payment['installment_id']);
        $update_installment = array(
            'status'            => 0,
            'instal_remaining'  => ($payment['amount_install'] + $get_installment['instal_remaining'])
        );

        $this->db->where('id', $payment['installment_id']);
        $this->db->update('sell_installment_detail', $update_installment);

        $sale_rem = $this->payment_model->get_sell($payment['main_id'])['rem_amount'] + $payment['amount_install'];
        

        $update_sell = array(
            'rem_amount'            => $sale_rem
        );

        $this->db->where('id', $payment['main_id']);
        $this->db->update('sell_product', $update_sell);

        $this->db->where('type','installment_commission');
        $this->db->where('investment_id',$id);
        $this->db->delete('transaction');

        $this->db->where('type','installment_direct_income');
        $this->db->where('investment_id',$id);
        $this->db->delete('transaction');

        $this->db->where('type','installment_promotion');
        $this->db->where('investment_id',$id);
        $this->db->delete('transaction');

        $this->db->where('type','installment_sales');
        $this->db->where('investment_id',$id);
        $this->db->delete('transaction');

        $this->db->where('type','installment_profit');
        $this->db->where('investment_id',$id);
        $this->db->delete('transaction');

        
        $this->db->where('id', $id);
        $this->db->delete('payment');

        $this->session->set_flashdata('msg', 'Payment Deleted Successfully');
        redirect(base_url().'payment/sell_payments');
    }

    /******************************************************************************************************
                                        START Purchase
    *******************************************************************************************************/
    public function purchase_payment()
    {
    	$data['page_title']    = 'Purchase Payments';
        $data['data'] = $this->payment_model->get_sell_payments('purchase');
        $this->load->template('payment/purchase_payment',$data);
    }

     public function purchase()
    {
        $data['page_title'] = 'Purchase Payment';
        $data['all_purchase'] = $this->payment_model->get_pruchase_install_yes_all();
        $this->load->template('payment/purchase',$data);
    }

    public function save_purchase()
    {
        $this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
        $this->form_validation->set_rules('purchase_id', 'Purchase Id', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['page_title'] = 'Purchase Payment';
            $data['all_purchase'] = $this->payment_model->get_pruchase_install_yes_all();
            $this->load->template('payment/purchase',$data);
        }
        else
        {
            redirect(base_url().'payment/add_purchase/'.$_POST['purchase_id']);
        }
    }

    public function add_purchase($id = FALSE)
    {
        if($id)
        {
            if($this->payment_model->find_saleer($id))
            {
                $data['page_title'] = 'Pay Purchase Installment';
                $data['id'] = $id;
                $data['purchase'] = $this->payment_model->find_saleer($id)[0];
                $paid = $data['purchase']['share'] - $data['purchase']['advance'] - $data['purchase']['balance'];
                $data['payment'] = $paid;
                $data['get_installment'] = $this->payment_model->get_purchase_installment($id);
                
                $Parterners = [];
                $Parterners[] = ['id' => 0,'user_type_id' => 'company','fullname' => 'Champs'];
                foreach ($this->transaction_model->all_business() as $key => $value) {
                    $Parterners[] = ['id' => $value['id'],'user_type_id' => $value['user_type_id'],'fullname' => $this->transaction_model->get_business_name($value['id'])];
                }

                $data['Parterners'] = $Parterners;

                $this->load->template('payment/add_purchase',$data);
            }
            else
            {
                $this->session->set_flashdata('error', 'Purchase Id Is Not Valid Please Try Again');
                redirect(base_url().'payment/purchase');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Purchase Id Is Not Valid Please Try Again');
            redirect(base_url().'payment/purchase');
        }
    }

    public function purchase_pay()
    {
            $payment = array(
                'main_id'               =>  $this->input->post('saler_id'),
                'installment_id'        =>  $this->input->post('installment_id'),
                'type'                  =>  'purchase',
                'date'                  =>  _ddate($this->input->post('date')),
                'amount_install'        =>  $this->input->post('instal_remaining'),
                'late_charge'           =>  trim($this->input->post('late_charge')),
                'pay_type'              =>  $this->input->post('payment_mode'),
                'pay_detail'            =>  $this->input->post('payment_mode_detail'),
                'created_at'            =>  date('Y-m-d H:i:s'),
                'updated_at'            =>  date('Y-m-d H:i:s'),
                'created_by'            =>  $this->session->userdata('id'),
                'updated_by'            =>  $this->session->userdata('id')
            );

            if($this->db->insert('payment', $payment))
            {
                $insert_id = $this->db->insert_id();


                if( $this->input->post('instal_remaining') == $this->input->post('remaning_ins_pay') ){
                    $update_installment = array(
                        'status'            => 1,
                        'instl_remaning'            => ($this->input->post('remaning_ins_pay') - $this->input->post('instal_remaining'))
                    );
                    $this->db->where('id', $this->input->post('installment_id'));
                    $this->db->update('purchase_installment_detail', $update_installment);

                    
                }
                else
                {
                    $update_installment = array(
                        'instl_remaning'            => ($this->input->post('remaning_ins_pay') - $this->input->post('instal_remaining'))
                    );
                    $this->db->where('id', $this->input->post('installment_id'));
                    $this->db->update('purchase_installment_detail', $update_installment);
                }


                foreach ($this->input->post('parter_id') as $key => $value) {
                    $transaction = [
                        'type'          =>   'purchase_installment',
                        'debit'         =>   $this->input->post('paid')[$key],  
                        'debit_by'      =>   $this->input->post('parter_id')[$key], 
                        'date'          =>   _ddate($this->input->post('date')),
                        'investment_id' =>   $insert_id,   
                        'created_by'    =>   $this->session->userdata('id'),    
                        'created_at'    =>  date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('transaction', $transaction);
                }

                $update_sell = array(
                    'balance'            => ($this->input->post('sale_remaning_amt') - $this->input->post('instal_remaining'))
                );

                $this->db->where('id', $this->input->post('saler_id'));
                $this->db->update('purchase_seller_dynamic', $update_sell);

                $this->session->set_flashdata('msg', 'Payment Added Successfully');
                redirect(base_url().'payment/purchase_payment');

            }
            else
            {
                $this->session->set_flashdata('error', 'Problem In Add Payment Try Again');
                redirect(base_url().'payment/purchase');
            }
    }

    /******************************************************************************************************
                                        Edit Purchase
    *******************************************************************************************************/
    
    public function purchase_edit($id)
    {
        if($this->payment_model->_payment($id)){

            $data['page_title'] = 'Edit Purchase Installment';
            $data['purchase_edit'] = $this->payment_model->get_purchase_installment_by_id($this->payment_model->_payment($id)['installment_id']);
            $data['payment'] = $this->payment_model->_payment($id);
            $this->load->template('payment/edit_purchase',$data);

        }
        else
        {
            $this->session->set_flashdata('error', 'Payment Not Found Try Again');
            redirect(base_url().'payment/purchase');
        }
    }

    public function purchase_update()
    {
            $payment = array(
                'date'                  =>  _ddate($this->input->post('date')),
                'late_charge'           =>  trim($this->input->post('late_charge')),
                'pay_type'              =>  $this->input->post('payment_mode'),
                'pay_detail'            =>  $this->input->post('payment_mode_detail'),
                'updated_at'            =>  date('Y-m-d H:i:s'),
                'updated_by'            =>  $this->session->userdata('id')
            );

                $this->db->where('id', $this->input->post('id'));
            if($this->db->update('payment', $payment))
            {

                $transaction = [
                    'type'              =>  'purchase_installment',
                    'debit'             =>  $this->input->post('amount_install') + $this->input->post('late_charge'), 
                    'date'              =>  _ddate($this->input->post('date'))
                ];

                $this->db->where('type', 'purchase_installment');
                $this->db->where('investment_id', $this->input->post('id'));
                $this->db->update('transaction', $transaction);

                $this->session->set_flashdata('msg', 'Payment Updated Successfully');
                redirect(base_url().'payment/purchase_payment');
            }
            else
            {
                $this->session->set_flashdata('error', 'Problem In Update Payment Try Again');
                redirect(base_url().'payment/purchase_payment');
            }
    }

    public function delete_purchase($id)
    {


        $payment = $this->payment_model->_payment($id);

        $get_installment = $this->payment_model->get_purchase_installment_by_id($payment['installment_id']);
        $update_installment = array(
            'status'            => 0,
            'instl_remaning'  => ($payment['amount_install'] + $get_installment['instal_remaining'])
        );

        $this->db->where('id', $payment['installment_id']);
        $this->db->update('purchase_installment_detail', $update_installment);

        $sale_rem = $this->payment_model->get_purchase_saller($this->payment_model->get_purchase_installment_by_id($payment['installment_id'])['saller_id'])['balance'] + $payment['amount_install'];
        
        
        $update_sell = array(
            'balance'            => $sale_rem
        );

        $this->db->where('id', $payment['main_id']);
        $this->db->update('purchase_seller_dynamic', $update_sell);

        $this->db->where('type', 'purchase_installment');
        $this->db->where('investment_id', $id);
        $this->db->delete('transaction');

        $this->db->where('id', $id);
        $this->db->delete('payment');

        $this->session->set_flashdata('msg', 'Payment Deleted Successfully');
        redirect(base_url().'payment/purchase_payment');
    }



}