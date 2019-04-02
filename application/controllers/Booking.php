<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('sel_product');
        $this->load->model('users');
        $this->load->model('add_product');
        $this->load->model('user_genaral');
        $this->load->model('report_model');
        $this->load->model('setting_model');
    }

    public function index(){

        $data['page_title'] = 'Bookings';
        $data['sell'] = $this->sel_product->get_booked_all();
        $this->load->template('booking/index',$data);

    }

    public function add()
    {
        $data['page_title'] = 'Add Booking';
        $data['customer'] = $this->users->all_agents('customer');
        $data['get_product_all'] = $this->add_product->get_product_all_book();
        $data['get_plan_code'] = $this->setting_model->get_plan_code();
        $this->load->template('booking/add',$data);
    }

    public function save()
    {

            $selling_amount = $this->input->post('adva_payment');

            $add_product = array(
                'coust_name'         =>    $this->input->post('coust_name'),
                'product_id'         =>    $this->input->post('product_id'),
                'date'               =>    date('Y-m-d',strtotime($this->input->post('date'))),
                'ploat_size_yrd'     =>    $this->input->post('ploat_size_yrd'),
                'ploat_size_h'       =>    $this->input->post('ploat_size_h'),
                'ploat_size'         =>    $this->input->post('ploat_size'),
                'selling_amount'     =>    $this->input->post('selling_amount'),
                'adva_payment'       =>    $this->input->post('adva_payment'),
                'rem_amount'         =>    $this->input->post('rem_amount'),
                'payment_mode'       =>    $this->input->post('payment_mode'),
                'pay_detail'         =>    $this->input->post('payment_mode_detail'),
                'first_receipt_date' =>    _ddate($this->input->post('first_receipt_date')),
                'receipt_no'         =>    $this->input->post('receipt_no'),
                'book_no'            =>    $this->input->post('book_no'),
                'install_packges'    =>    $this->input->post('install_packges'),
                'no_of_installment'  =>    $this->input->post('no_of_installment'), 
                'time_installment'   =>    $this->input->post('time'),  
                'created_by'         =>    $this->session->userdata('id'),
                'updated_by'         =>    $this->session->userdata('id'),
                'created_at'         =>    date('Y-m-d H:i:s'),
                'updated_at'         =>    date('Y-m-d H:i:s'),
                'remarks'            =>    $this->input->post('remarks'),
                'plan_id'            =>    $this->input->post('plan_code'),
                'type'               =>    '1'

            );

            if($this->db->insert('sell_product', $add_product)){
                    $sell_insert_id = $this->db->insert_id();
                    $add_p = ['status'  =>  1];

                    $this->db->where('id', $this->input->post('product_id'));
                    //$this->db->update('create_product', $add_p);
                    $instal_pk = $_POST['install_packges']; // value (Yes / No) time

            if($instal_pk == 'Yes'){

                $date = $_POST['date'];
                $time = $_POST['time']; // Time(montyly, quertly etc..)
                $plus_time;
                if($time == 'Monthly')
                {
                    $plus_time = '1';
                }
                else if($time == 'Quarterly')
                {
                    $plus_time = '3';
                }
                else if($time == 'Half Yearly')
                {
                    $plus_time = '6';
                }
                else if($time == 'Yearly')
                {
                    $plus_time = '12';
                }

                $no_install = $_POST['no_of_installment'];  
                $instal_pk = $_POST['instal_amount'];   

                $installment = $instal_pk / $no_install;

                $new_date = strtotime($date);
                $rem_amount = floatval($this->input->post('deal_amount')) - floatval($this->input->post('adva_payment'));
                

                for($i=1; $i <= $no_install; $i++){
                    
                    $rem_amount -= $installment;
                    $new_date = strtotime("+".$plus_time." months", $new_date);
                    
                    $instal_detail = array(
                        'install_packges'   =>  $this->input->post('install_packges'),              
                        'no_of_installment' =>  $i,
                        'time'              =>  $this->input->post('time'),                 
                        'deal_amount'       =>  $this->input->post('deal_amount'),                  
                        'adva_payment'      =>  $this->input->post('adva_payment'),                 
                        'instal_amount'     =>  $installment,   
                        'remaining_amount'  =>  $rem_amount,                
                        'instal_remaining'  =>  $installment,               
                        'date'              =>  date('Y-m-d',$new_date),                
                        'sell_product_id'   =>  $sell_insert_id
                    );
                    

                    
                    $insert = $this->db->insert('sell_installment_detail', $instal_detail);
                }
                    

                    if($insert = TRUE)
                    {


                        

                        ////////////// payments


                        $commission_agent = $this->user_genaral->commission_agent($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')),'');

                        $promotio_agent = $this->user_genaral->promotion_agent($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')),'');

                        $commission_parterner = $this->user_genaral->commission_parterner($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')),'');

                        $after_shares_amount = $commission_agent + $promotio_agent + $commission_parterner;

                        $new_due = $selling_amount - $after_shares_amount;

                        $sales_profit = $this->user_genaral->share_company_after_all($sell_insert_id,floatval($new_due),_ddate($this->input->post('date')),'');
                        
                        // $sales_share = $this->user_genaral->share_company_expence_etc($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')));

                        // 

                        // $net_profit = $selling_amount - $after_shares_amount;

                        // if($net_profit > 0)
                        // {
                            
                        // }

                        // $net_profit -= $sales_profit;

                        // if($net_profit > 0)
                        // {
                        //  $this->user_genaral->profit_company($sell_insert_id,floatval($net_profit),_ddate($this->input->post('date')));
                        // }

                        $this->sel_product->agent_promotion();

                        /////////////  payments end




                        $this->session->set_flashdata('msg', 'Sell Product Successfully Added');
                        redirect(base_url().'booking');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Problem In Sell Product Try Again');
                        redirect(base_url().'booking/add');
                    }

                
            
            }
            else
            {


                

                        ////////////// payments


                        $commission_agent = $this->user_genaral->commission_agent($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')),'');

                        $promotio_agent = $this->user_genaral->promotion_agent($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')),'');
                        
                        $commission_parterner = $this->user_genaral->commission_parterner($sell_insert_id,floatval($selling_amount),_ddate($this->input->post('date')),'');

                        $after_shares_amount = $commission_agent + $promotio_agent + $commission_parterner;

                        $new_due = $selling_amount - $after_shares_amount;

                        $sales_profit = $this->user_genaral->share_company_after_all($sell_insert_id,floatval($new_due),_ddate($this->input->post('date')),'');

                        $this->sel_product->agent_promotion();

                        /////////////  payments end
                
                $this->session->set_flashdata('msg', 'Sell Product Successfully Added');
                redirect(base_url().'booking');
            }

        }

    }


    public function view($id = false){
        if($id)
        {
            if($this->sel_product->get_product($id))
            {
                $data['page_title'] = 'Sale View';
                $data['sale'] = $this->sel_product->get_product($id)[0];
                $data['installment_detail'] = $this->sel_product->installment_detail_asc($id);

                        
                        
                $this->load->template('sell_product/view',$data);
            }
            else{
                $this->session->set_flashdata('error', 'Sale Not Found');
                redirect(base_url().'sell_product');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'sell_product');
        }
    }

    public function sale_print($id = false){
        if($id)
        {
            if($this->sel_product->get_product($id))
            {
                $data['page_title'] = 'Sales';
                $data['sale'] = $this->sel_product->get_product($id)[0];
                $data['installment_detail'] = $this->sel_product->installment_detail_asc($id);
                
                $this->load->view('sell_product/print',$data);
            }
            else{
                $this->session->set_flashdata('error', 'Sale Not Found');
                redirect(base_url().'sell_product');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'sell_product');
        }
    }

    public function sale_report($id = false)
    {
        if($id)
        {
            if($this->sel_product->get_product($id))
            {
                $data['page_title']     = 'Sell Report';
                $data['sale']           = $this->report_model->get_sale($id);
                $data['product']        = $this->report_model->get_product($data['sale']['product_id']);
                $data['transaction']    = $this->report_model->sale_profit_report($id);
                $this->load->template('sell_product/report',$data);
            }
            else{
                $this->session->set_flashdata('error', 'Sale Not Found');
                redirect(base_url().'sell_product');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'sell_product');
        }
    }

    public function print_invoice($id = false){
        if($id)
        {
            if($this->sel_product->get_product($id))
            {
                $this->load->model('setting_model');
                $data['page_title'] = 'Sales';
                $data['sale'] = $this->sel_product->get_product($id)[0];
                


                if($data['sale']['install_packges'] == 'Yes'){
                    $data['installment_detail'] = $this->sel_product->installment_detail_asc($id);
                    $data['installment_expire'] = $this->sel_product->installment_expire_date($id);
                    $data['installment_due'] = _vdate($data['installment_detail'][0]['date']);
                    $data['installment_expire'] = _vdate($data['installment_expire'][0]['date']);
                }
                else
                {
                    $data['installment_due'] = "NA";
                    $data['installment_expire'] = "NA";
                }


                $data['coust_detail'] = $this->sel_product->coust_detail($this->sel_product->get_product($id)[0]['coust_name']);
                $data['coust_photo'] = $this->db->get_where('user', array('id' => $this->sel_product->get_product($id)[0]['coust_name']))->result_array()[0];

                $data['product_detail'] = $this->sel_product->product_detail($this->sel_product->get_product($id)[0]['product_id']);

                
                $this->load->view('sell_product/print_invoice',$data);
            }
            else{
                $this->session->set_flashdata('error', 'Sale Not Found');
                redirect(base_url().'sell_product');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'sell_product');
        }
    }

    public function delete($id = false)
    {   
        if($id)
        {
            $this->db->where('id',$id);
            if($this->db->update('sell_product',array('updated_by'  =>  $this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
            {
                
                $this->db->where('sell_product_id',$id);
                $this->db->delete('sell_installment_detail');

                $this->db->where('type','commission');
                $this->db->where('investment_id',$id);
                $this->db->delete('transaction');

                $this->db->where('type','direct_income');
                $this->db->where('investment_id',$id);
                $this->db->delete('transaction');

                $this->db->where('type','promotion');
                $this->db->where('investment_id',$id);
                $this->db->delete('transaction');

                $this->db->where('type','sales');
                $this->db->where('investment_id',$id);
                $this->db->delete('transaction');

                $this->db->where('type','profit');
                $this->db->where('investment_id',$id);
                $this->db->delete('transaction');

                $pd_id = $this->sel_product->get_product($id)[0]['product_id'];

                $add_p = ['status'  =>  0];
                $this->db->where('id',$pd_id);
                $this->db->update('create_product', $add_p);


                $this->session->set_flashdata('msg', 'Sell Product Successfully Deleted');
                redirect(base_url().'booking');
            }
            else{
                $this->session->set_flashdata('error', 'Sell Product Not Deleted Try Again');
                redirect(base_url().'booking');
            }

        }
        else{
            $this->session->set_flashdata('error', 'Sell Product Not Found');
            redirect(base_url().'booking');
        }
    }  


    public function cancel($id = false)
    {
        if($id)
        {

            $this->db->where("id",$id);
            $this->db->update("sell_product",['cancel' => '1','updated_at' => date('Y-m-d H:i:s')]);

            // $sales = $this->sel_product->get_product($id);
            // $this->db->where("id",$id);
            // $this->db->update("create_product",['status' => '0']);

            $this->session->set_flashdata('msg', 'Plan Successfully Removed');
            redirect(base_url().'booking');

        }
        else{
            $this->session->set_flashdata('error', 'Booking Not Found');
            redirect(base_url().'sell_product');
        }
    }    



}

?>