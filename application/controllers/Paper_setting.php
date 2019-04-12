<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paper_setting extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('dashboard_model');
    }


	public function index()
	{	
		$data['_title']				= "Paper Setting Files";
		$data['count_professor']	= $this->dashboard_model->count_professor();
		$this->load->template('dashboard',$data);
	}

	public function add()
	{
		$data['_title']				= "Add Bill";
	}

}
