<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class partner_transaction extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('users');
        $this->load->model('partner_transact');
		$this->load->model('dash_model');
        $this->load->model('add_product');
        $this->load->model('transaction_model');
        $this->load->model('user_genaral');
        $this->load->model('sel_product');
    }

    public function index()
	{	
		$data['page_title']	= 'Investor Transaction';
		$data['business'] = $this->users->all_business();
		
		$this->load->template('partner_transaction/index',$data);

	}

	public function view()
	{	
		$business_id = $this->input->post('business_id');
		if($business_id)
		{
			$data['page_title']	= 'Investor Transaction';
			$data['busi_id'] = $this->partner_transact->business_id($business_id);
			$data['b_id'] = $business_id;
			$data['business_trans'] = $this->partner_transact->business_partner_transaction($data['busi_id']['id']);
			$this->load->template('partner_transaction/view',$data);	
		}
		else
		{
			$this->session->set_flashdata('error', 'Investor Id Not Found');
	        redirect(base_url().'partner_transaction/index');
		}

		

	}

 }
 ?>