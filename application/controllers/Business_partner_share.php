<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Business_partner_share extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->auth->check_session();
        $this->load->model('users');
        $this->load->model('business_share');
        
	}

	public function index(){
		$data['page_title']	= 'Business Partner Share';
		$data['business_all'] = $this->business_share->get_business_all();
		$this->load->template('business_partner_share/index',$data);
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Add  Business Partner
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function add(){
		$data['page_title']	= 'Add Business Partner Share';
		$data['business_name'] = $this->users->all_business();
		$this->load->template('business_partner_share/add',$data);
	}

	public function save()
	{
		$business_insert = array(
	        'business_name'             => 	 $this->input->post('business_name'),
	        'credit_amount'           	=> 	 $this->input->post('credit_amount'),
	        'date'           			=> 	 _ddate($this->input->post('date')),
	        'payment_mode'           	=> 	 $this->input->post('payment_mode'),
	        'payment_mode_detail'       => 	 $this->input->post('payment_mode_detail'),
			'created_by'		  		=> 	 $this->session->userdata('id'),
	        'updated_by'		  		=> 	 $this->session->userdata('id'),
	        'created_at' 		  		=> 	 date('Y-m-d H:i:s'),
	        'updated_at' 		  		=> 	 date('Y-m-d H:i:s')
	    );

		

	    if($this->db->insert('business_share', $business_insert)){

			$insert_id = $this->db->insert_id();

	    	$transaction = [
				'type'		 	=>	 'share',
				'credit'		=>	 $this->input->post('credit_amount'),	
				'credit_by'   	=>	 $this->input->post('business_name'),	
				'date'   	 	=>	 _ddate($this->input->post('date')),
				'investment_id' =>	 $insert_id,	
				'created_by'   	=>	 $this->session->userdata('id'),	
				'created_at'   	=>	date('Y-m-d H:i:s')
			];


			$this->db->insert('transaction', $transaction);

			$this->session->set_flashdata('msg', 'Business Partner Share Successfully Added');
	        redirect(base_url().'business_partner_share/index');
		}
		else{

			$this->session->set_flashdata('error', 'Problem In Add Business Partner Share Try Again');
        	redirect(base_url().'business_partner_share/add');
		
		}
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								DELETE Business Partner
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/  

	
	public function delete($id = false)
	{	
		if($id)
		{
			
			$this->db->where('id',$id);
			if($this->db->update('business_share',array('updated_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
			{
				

				$this->db->where('type','share');
				$this->db->where('investment_id',$id);
				$this->db->delete('transaction');


				$this->session->set_flashdata('msg', 'Business Partner Share Successfully Deleted');
        		redirect(base_url().'business_partner_share');
			}
			else{
				$this->session->set_flashdata('error', 'Business Partner Share Not Deleted Try Again');
        		redirect(base_url().'business_partner_share');
			}
			
		}
		else{
			$this->session->set_flashdata('error', 'Business Partner Share Not Found');
	        redirect(base_url().'business_partner_share');
		}
	}		
}	
?>