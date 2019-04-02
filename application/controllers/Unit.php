<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }


	public function index()
	{
		$data['page_title']	= 'Manage Units';
		$this->load->template('unit/index',$data);
	}

	public function add()
	{
		$data['page_title']	= 'Add Unit';
		$this->load->template('unit/add',$data);
	}
}
