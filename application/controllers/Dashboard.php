<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('dashboard_model');
        $this->load->model('setting_model');
        $this->load->model('user_model');
    }


	public function index()
	{	
		$data['_title']				= "Dashboard";
		$data['count_professor']	= $this->dashboard_model->count_professor();
		$data['year']				= $this->setting_model->financial_year_all();
		$this->load->template('dashboard',$data);
	}

	function logout()
	{
	    $user_data = $this->session->all_userdata();
	    $this->session->unset_userdata($user_data['id']);
	    $this->session->sess_destroy();
	    redirect(base_url());
	}

	function retrive_flash(){
	    $this->session->unset_userdata('id');
	    $this->session->unset_userdata('year');
	    $this->session->set_flashdata('error', "Your Financial Year Changed By Admin Please Login Again To Continue");
	    redirect(base_url());
	}


}
