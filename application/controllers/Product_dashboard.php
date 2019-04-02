<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_dashboard extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('add_product');
        $this->load->model('setting_model');
    }


	public function index()
	{
		$data['page_title']	= 'Product Dashboard';
		$data['location'] = $this->setting_model->get_locations();
		$this->load->template('product_dashboard/index',$data);
	}

	public function ajax_get()
	{
		$data['products'] = $this->add_product->get_product_dash($_POST['location']);
		echo $this->load->view('product_dashboard/products',$data,TRUE);
	}
	

}
?>