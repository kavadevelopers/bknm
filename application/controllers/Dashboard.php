<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('users');
        $this->load->model('dash_model');
        $this->load->model('add_product');
        $this->load->model('transaction_model');
        $this->load->model('user_genaral');
        $this->load->model('sel_product');
        $this->load->model('partner_transact');

    }


	public function index()
	{	
		$session_user_id = $this->session->userdata('id');
		
		$session_user_type_id = $this->session->userdata('user_type_id');

		$data['page_title']	= 'Dashboard';
		$data['get_product_all'] = $this->add_product->get_product_for_index();
		$data['business_trans'] = $this->transaction_model->get_transaction_business();
		$data['agent_trans'] = $this->transaction_model->get_transaction_agent();
		$data['sell'] = $this->sel_product->get_product_for_dashboard();
		$data['total_reffered'] = $this->dash_model->total_reffered($session_user_type_id);
		$data['monthly_reffered'] = $this->dash_model->monthly_reffered($session_user_type_id);
		$data['total_sale'] = $this->dash_model->total_sale($session_user_id);
		$data['monthly_sale'] = $this->dash_model->monthly_sale($session_user_id);

		$data['total_direct_income'] = $this->dash_model->total_direct_income($session_user_id);
		$data['monthly_direct_income'] = $this->dash_model->monthly_direct_income($session_user_id);
		$data['total_indirect_income'] = $this->dash_model->total_indirect_income($session_user_id);
		$data['monthly_indirect_income'] = $this->dash_model->monthly_indirect_income($session_user_id);
		$data['total_bonus_income'] = $this->dash_model->total_bonus_income($session_user_id);
		$data['monthly_bonus_income'] = $this->dash_model->monthly_bonus_income($session_user_id);
		$data['total_promotion_income'] = $this->dash_model->total_promotion_income($session_user_id);
		$data['monthly_promotion_income'] = $this->dash_model->monthly_promotion_income($session_user_id);
		
		$this->load->template('dashboard',$data);
	}

	function logout()
	{
	    $user_data = $this->session->all_userdata();
	        
	        
	    $this->session->unset_userdata($user_data['id']);
	           
	        
	    $this->session->sess_destroy();
	    redirect(base_url());
	}


	public function remove_hold($id)
	{
		$customer = $this->dash_model->customer_detail_get($id);

		$this->dash_model->product_status_change($customer['booking']);
		$this->dash_model->remove_from_hold($id);
		$this->session->set_flashdata('msg', 'Agent Successfully Saved');
	    redirect(base_url());
	}


}
