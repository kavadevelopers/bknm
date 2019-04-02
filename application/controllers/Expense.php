<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('expense_model');
        $this->load->model('transaction_model');
        $this->load->model('users');
    }


	public function index()
	{	
		$this->load->model('users');
		$data['page_title']	= 'Manage Expenses';
		$data['expense_all'] = $this->expense_model->get_expense_all();
		$this->load->template('expense/index',$data);
	}


	public function add()
	{
	    $data['page_title']	= 'Add Expense';
		
	    $Parterners = [];
	    $Parterners[] = ['id' => 0,'user_type_id' => 'company','fullname' => 'Champs'];
		foreach ($this->transaction_model->all_business() as $key => $value) {
			$Parterners[] = ['id' => $value['id'],'user_type_id' => $value['user_type_id'],'fullname' => $this->transaction_model->get_business_name($value['id'])];
		}

		$data['Parterners'] = $Parterners;
		$others = array('id' => '0' ,'purchase_id' => 'Others');
		$purchases = $this->expense_model->get_purchase();
		array_push($purchases, $others);
		$data['purchase_id'] = $purchases;

		$this->load->template('expense/add',$data);
		
		
	}


	public function save(){
		
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('purchase_id', 'Purchase Id', 'trim|required');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[40]');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Add Expense';
			$this->load->template('expense/add',$data);
		}
		else
		{
			$expense = [
				'purchase_id'  		 	 =>    $this->input->post('purchase_id'),
				'desc'  		 	 =>    $this->input->post('desc'),
				'amount'  		 	 =>    $this->input->post('amount'),
				'date'  		 	 =>    _ddate($this->input->post('date')),
				'created_by'         =>    $this->session->userdata('id'),
				'updated_by'         =>    $this->session->userdata('id'),
				'created_at'         =>    date('Y-m-d H:i:s'),
				'updated_at'         =>    date('Y-m-d H:i:s')
			];

			if($this->db->insert('expense', $expense))
			{
				$expense_insert_id = $this->db->insert_id();

				foreach ($this->input->post('parter_id') as $key => $value) {
					$transaction = [
						'type'		 	=>	 'expense',
						'debit'		 	=>	 $this->input->post('paid')[$key],	
						'debit_by'   	=>	 $this->input->post('parter_id')[$key],	
						'date'   	 	=>	 date('Y-m-d',strtotime($this->input->post('date'))),
						'investment_id' =>	 $expense_insert_id,	
						'created_by'   	=>	 $this->session->userdata('id'),	
						'created_at'   	=>	date('Y-m-d H:i:s')
					];
					$this->db->insert('transaction', $transaction);
				}


				$this->session->set_flashdata('msg', 'Expense Successfully Added');
	        	redirect(base_url().'expense');
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Add Expense Try Again');
        		redirect(base_url().'expense/add');
			}	
		}
	}



	public function edit($id = false)
	{	
		if($id)
		{
			if($this->expense_model->get_expense($id))
			{
				$data['page_title']	= 'Edit Expense';
				$data['expense'] = $this->expense_model->get_expense($id);
				$this->load->template('expense/edit',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Expense Not Found');
	        	redirect(base_url().'expnese');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Expense Not Found');
	        redirect(base_url().'expnese');
		}
	    
	}	

	public function update(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[40]');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Expense';
			$data['expense'] = $this->expense_model->get_expense($id);
			$this->load->template('expense/edit',$data);
		}
		else
		{

			$expense = [
				'desc'  		 	 =>    $this->input->post('desc'),
				'amount'  		 	 =>    $this->input->post('amount'),
				'date'  		 	 =>    _ddate($this->input->post('date')),
				'updated_by'         =>    $this->session->userdata('id'),
				'updated_at'         =>    date('Y-m-d H:i:s')
			];

				$this->db->where('id', $this->input->post('id'));

			if($this->db->update('expense', $expense))
			{

				$transaction = [
					'type'		   		=>	 'expense',
					'debit'		   		=>	 $this->input->post('amount'),	
					'debit_by'     		=>	 '2',	
					'date'   	   		=>	 date('Y-m-d',strtotime($this->input->post('date'))),
					'investment_id'     =>	 $this->input->post('id'),	
					'created_by'   		=>	 $this->session->userdata('id')
				];
					
					$this->db->where('type','expense');
					$this->db->where('investment_id', $this->input->post('id'));
				$this->db->update('transaction', $transaction);

				$this->session->set_flashdata('msg', 'Expense Successfully Save');
	        	redirect(base_url().'expense');
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Expense Try Again');
        		redirect(base_url().'expense/edit');
			}	
		}

	}






	public function delete($id = false)
	{	
		if($id)
		{
			if($this->expense_model->get_expense_all($id))
			{

				$this->db->where('id',$id);
				if($this->db->update('expense',array('updated_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
				{

					$this->db->where('type','expense');
					$this->db->where('investment_id',$id);
					$this->db->delete('transaction');

					$this->session->set_flashdata('msg', 'Expense Successfully Deleted');
	        		redirect(base_url().'expense');
				}
				else{
					$this->session->set_flashdata('error', 'Expense Not Deleted Try Again');
	        		redirect(base_url().'expense');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Expense Not Found');
	        	redirect(base_url().'expense');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Expense Not Found');
	        redirect(base_url().'expense');
		}
	}		




}
