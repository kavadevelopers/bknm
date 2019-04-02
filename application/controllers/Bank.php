<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('bknmu');
    }


	public function index()
	{
		$data['page_title']	= 'Bank';

		$data['person'] = $this->db->query("SELECT DISTINCT `person` FROM `bill` ORDER BY `id` ASC")->result_array();
		

        $this->load->template('bill/bank',$data);

	}

}
?>