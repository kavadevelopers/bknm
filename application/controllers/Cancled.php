<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancled extends CI_Controller {

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

    public function plan(){

        $data['page_title'] = 'Cancled Plans';
        $data['sell'] = $this->sel_product->get_cancle_plans();
        $this->load->template('cancle/plan',$data);

    }

    public function booking(){

        $data['page_title'] = 'Cancled Bookings';
        $data['sell'] = $this->sel_product->get_cancle_booked_bookings();
        $this->load->template('cancle/booking',$data);

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


    public function repayment_plan($id = false)
    {
        if($id)
        {

            $data['page_title'] = 'Add Repayment';
            $data['sell'] = $this->sel_product->get_product($id)[0];
            $data['repay'] = $this->sel_product->get_repayments_all($id);
            $data['type']  = "plan";
            $this->load->template('cancle/repayment',$data);

        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'cancled/plan');
        }
    }

    public function repayment_booking($id = false)
    {
        if($id)
        {

            $data['page_title'] = 'Add Repayment';
            $data['sell'] = $this->sel_product->get_product($id)[0];
            $data['repay'] = $this->sel_product->get_repayments_all($id);
            $data['type']  = "booking";
            $this->load->template('cancle/repayment',$data);

        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'cancled/plan');
        }
    }



    public function save_pay()
    {


        $data  =    [
                        'sale'          =>   $this->input->post('sell_id'),
                        'date'          =>   _ddate($this->input->post('date')),
                        'amount'        =>   $this->input->post('instal_remaining'),
                        'paymode'       =>   $this->input->post('payment_mode'),
                        'paydet'        =>   $this->input->post('payment_mode_detail')
                    ];

        $this->db->insert('repayment',$data);

        $this->session->set_flashdata('msg', 'Repayment Successfully Added');
        redirect(base_url().'cancled/'.$this->input->post('type'));


    }


    public function repay_detail($id = false)
    {
        if($id)
        {

            $data['page_title'] = 'Repayment details';
            $data['sell'] = $this->sel_product->get_product($id)[0];
            $data['repay'] = $this->db->get_where('repayment',['sale' => $id])->result_array();
            $this->load->template('cancle/repayments',$data);

        }
        else{
            $this->session->set_flashdata('error', 'Sale Not Found');
            redirect(base_url().'cancled/plan');
        }
    }

}