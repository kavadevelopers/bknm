<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_request extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('withdraw_req');
    }


	public function index()
	{
		$data['page_title']	= 'Withdraw Request';
		$data['request'] = $this->withdraw_req->all_request();
		$this->load->template('withdraw_request/index',$data);
	}


	public function add()
	{	
	    $data['page_title']	= 'Withdraw Request';
		$data['total_amount'] = $this->withdraw_req->get_balance();
		$this->load->template('withdraw_request/add',$data);
	}

	public function save(){
		
		if($this->withdraw_req->check_pending_rquist($this->session->userdata('id')))
		{
			$this->session->set_flashdata('error', 'You cannot Add Withdraw Request Because Your Past Request Is In Process');
	        redirect(base_url().'withdraw_request');
		}
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('withdraw_amount', 'Withdraw Amount', 'trim|decimal|required|max_length[30]');

		if ($this->form_validation->run() == FALSE)
		{
	    	$data['page_title']	= 'Withdraw Request';
	    	$data['total_amount'] = $this->withdraw_req->get_balance();
			$this->load->template('withdraw_request/add',$data);
		}
		else
		{ 
			$withdraw_insert = array(
		        'user_type'           		=> 	$this->session->userdata('user_type'),
		        'date'  			        => 	date('Y-m-d'),
		        'withdraw_amount'           => 	$this->input->post('withdraw_amount'),
				'created_by'		  		=> 	$this->session->userdata('id'),
		        'created_at' 		  		=> 	date('Y-m-d H:i:s')
		    );

			if($this->db->insert('withdraw_request', $withdraw_insert)){

				$insert_id = $this->db->insert_id();

					if($this->session->userdata('user_type') == 'agent'){
						$user_type = 'Agent';
					}
					else{
						$user_type = 'Business Partner';	
					}

					$notification = [
						'user_id'        			=>    $this->session->userdata('id'),
						'message'          			=>    $this->session->userdata('user_type_id').' Withdraw Request',
				        'notification_type'		  	=> 	  'withdraw',
						'main_id'          			=>    $insert_id,
						'for'          				=>    '1',
						'created_at' 		  		=> 	  date('Y-m-d H:i:s')
					];	
					
					$this->db->insert('notification', $notification);

					$this->session->set_flashdata('msg', 'Withdraw Request Successfully Sent');
	        		redirect(base_url().'withdraw_request');
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Withdraw Request Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'withdraw_request/add');
			}
		}

	}	// Save Function



	/************************************************************************************************************************
												Confirm Request
	************************************************************************************************************************/
	
	public function confirm($id){

		$withdraw_confirm = [ 'confirm'   => 	'1' ];

			$this->db->where('id',$id);
		if($this->db->update('withdraw_request', $withdraw_confirm)){


					$notification = [ 'read' => '1' ];	
					
					$this->db->where('main_id',$id);
					$this->db->where('notification_type','withdraw');
					$this->db->update('notification', $notification);

				// 	$transaction = [
				// 		'type'        				=>    'withdraw',
				// 		'debit'          			=>    $this->withdraw_req->get_request_amount($id)[0]['withdraw_amount'],
				// 		'debit_by'		  			=> 	  $this->users->business_partner()[0]['id'],
				// 		'date'          			=>    date('Y-m-d'),
				// 		'investment_id'          	=>    $id,
				// 		'created_at' 		  		=> 	  date('Y-m-d H:i:s'),
				// 		'created_by' 		  		=> 	  $this->session->userdata('id')
				// 	];	
					
				// 	$this->db->insert('transaction', $transaction);

					$transaction = [
						'type'        				=>    'withdraw',
						'debit'          			=>    $this->withdraw_req->get_request_amount($id)[0]['withdraw_amount'],
						'debit_by'		  			=> 	  $this->withdraw_req->get_request_amount($id)[0]['created_by'],
						'date'          			=>    date('Y-m-d'),
						'investment_id'          	=>    $id,
						'created_at' 		  		=> 	  date('Y-m-d H:i:s'),
						'created_by' 		  		=> 	  $this->session->userdata('id')
					];	
					
					$this->db->insert('transaction', $transaction);

					$notification = [
						'user_id'        			=>    $this->session->userdata('id'),
						'message'          			=>    'Approved Withdraw Request',
				        'notification_type'		  	=> 	  'withdraw',
						'for'          				=>    $this->withdraw_req->get_request_amount($id)[0]['created_by'],
						'created_at' 		  		=> 	  date('Y-m-d H:i:s')
					];	
					
					$this->db->insert('notification', $notification);

					$this->session->set_flashdata('msg', 'Withdraw Request Successfully Approved');
	        		redirect(base_url().'withdraw_request');
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Approve Request Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'withdraw_request');
			}
	}


	/************************************************************************************************************************
												Reject Request
	************************************************************************************************************************/
	public function reject($id){
		
		$withdraw_confirm = [ 'confirm'   => 	'2' ];
		$this->db->where('id',$id);
		$this->db->update('withdraw_request', $withdraw_confirm);

		$notification = [ 'read' => '1' ];	
					
		$this->db->where('main_id',$id);
		$this->db->where('notification_type','withdraw');
		$this->db->update('notification', $notification);

		$notification = [
			'user_id'        			=>    $this->session->userdata('id'),
			'message'          			=>    'Rejected Withdraw Request',
	        'notification_type'		  	=> 	  'withdraw',
			'for'          				=>    $this->withdraw_req->get_request_amount($id)[0]['created_by'],
			'created_at' 		  		=> 	  date('Y-m-d H:i:s')
		];	
		
		$this->db->insert('notification', $notification);

		$this->session->set_flashdata('msg', 'Withdraw Request Rejected.');
		redirect(base_url().'withdraw_request');	
	}
}
?>