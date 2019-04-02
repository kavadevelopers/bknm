<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_data extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
		$this->load->model('sel_product');
        $this->load->model('add_product');
        $this->load->model('user_genaral');
    }


	public function add()
	{	
		$this->load->model('users');
		$data['page_title']	= 'Installment Detail';
		$data['installment'] = $this->sel_product->get_sale_by_customer($this->session->userdata('id'));
		$this->load->template('customer_data/add',$data);
	}

	public function view()
	{	
		
	        redirect(base_url().'customer_data/show/'.$_POST['product_id']);
	}


	public function show($id = false){
		if($id)
		{
			if($this->sel_product->get_product($id))
			{
				$data['page_title']	= 'Installment Detail';
				$data['sale'] = $this->sel_product->get_product($id)[0];
				$data['installment_detail'] = $this->sel_product->installment_detail_asc($id);

				$this->load->template('customer_data/view',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Installment Detail Not Found');
	        	redirect(base_url().'customer_data/add');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Installment Detail Not Found');
	        redirect(base_url().'customer_data/add');
		}
	}
}
?>

	
