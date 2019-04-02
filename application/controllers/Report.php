<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('expense_model');
        $this->load->model('transaction_model');
        $this->load->model('users');
        $this->load->model('report_model');
        $this->load->model('add_product');
        $this->load->model('payment_model');
        $this->load->model('dash_model');
    }


	public function add_expense()
	{
	    $data['page_title']	= 'Expense Report';
		$others = array('id' => '0' ,'purchase_id' => 'Others');
		$purchases = $this->expense_model->get_purchase();
		array_push($purchases, $others);
		$data['purchase_id'] = $purchases;

		$this->load->template('report/add_expense',$data);
		
		
	}

	public function show_expense()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('purchase_id', 'Purchase Id', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Expense Report';
			$others = array('id' => '0' ,'purchase_id' => 'Others');
			$purchases = $this->expense_model->get_purchase();
			array_push($purchases, $others);
			$data['purchase_id'] = $purchases;
			$this->load->template('report/add_expense',$data);
		}
		else
		{
			$data['page_title']	= 'Expense Report';
			$d = explode(' - ',$this->input->post('date_range'));
			$date1 = date('Y-m-d',strtotime(trim($d[0])));
			$date2 = date('Y-m-d',strtotime(trim($d[1])));
			$data['data'] = $this->report_model->get_expense($this->input->post('purchase_id'),$date1,$date2);
			$this->load->template('report/show_expense',$data);
		}

	}

	public function add_sell()
	{
	    $data['page_title']	= 'Sell Report';
		$data['get_product_all'] = $this->add_product->get_product_used();
		$this->load->template('report/sell/add_sell',$data);
	}

	public function show_sale()
	{

		$data['page_title']		= 'Sell Report';
		$data['sale']			= $this->report_model->get_sale($this->input->post('product_id'));
		$data['product']		= $this->report_model->get_product($data['sale']['product_id']);
		$data['transaction']	= $this->report_model->sale_profit_report($this->input->post('product_id'));
		$this->load->template('report/sell/show_sale',$data);
	}



	public function add_admin()
	{
		$data['page_title']	= 'Admin Report';
		
		$data['admins'] = $this->report_model->get_admins();

		$this->load->template('report/admin/add_admin',$data);
	}

	public function show_admin_report()
	{
		$data['page_title']		= 'Admin Report';
		$d = explode(' - ',$this->input->post('date_range'));
		$date1 = date('Y-m-d',strtotime(trim($d[0])));
		$date2 = date('Y-m-d',strtotime(trim($d[1])));
		$data['total_sale'] = $this->report_model->get_total_sale($this->input->post('admin'),$date1,$date2);
		$data['sale_rows'] = $this->report_model->get_sales_by_id($this->input->post('admin'),$date1,$date2);
		$data['total_installment'] = $this->report_model->get_total_installment($this->input->post('admin'),$date1,$date2);
		$data['ins_row'] = $this->report_model->get_sell_payments_byid($this->input->post('admin'),$date1,$date2);

		$this->load->template('report/admin/show_report',$data);
	}


	public function add_transaction()
	{
		$data['page_title']	= 'Transaction Report';

		$this->load->template('report/transaction/add_transaction',$data);
	}

	public function show_transaction_report()
	{
		$data['page_title']	= 'Transaction Report';
		
		$d = explode(' - ',$this->input->post('date_range'));
		$date1 = date('Y-m-d',strtotime(trim($d[0])));
		$date2 = date('Y-m-d',strtotime(trim($d[1])));

		$data['transactions'] = $this->report_model->get_transaction($date1,$date2);
		
		$this->load->template('report/transaction/show_report',$data);
	}

}
