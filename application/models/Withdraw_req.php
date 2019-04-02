<?php

class Withdraw_req extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_amount($id){
		$this->db->where('id',$id);
		$query = $this->db->get('withdraw_request');
		return $query->result_array();
	}


	// Get Balance 
	public function get_balance()
	{
			$id = $this->session->userdata('id');	
			
			$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `credit_by` = '".$id."' AND `type` != 'investment'")->result_array();

			$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `debit_by` = '".$id."'")->result_array();
			if($credit[0]['all_credit'] - $debit[0]['all_debit'] > 0){
				$ar = ['balance' => $credit[0]['all_credit'] - $debit[0]['all_debit']];
			}
			else
			{
				$ar = ['balance' => 0];
			}
			return $ar;
	}

	public function get_balance_with_id($id)
	{
				

			$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `credit_by` = '".$id."'")->result_array();

			$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `debit_by` = '".$id."'")->result_array();
			if($credit[0]['all_credit'] - $debit[0]['all_debit'] > 0){
				$ar = $credit[0]['all_credit'] - $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}
	/*********************************************************************************/


	public function all_request(){
		if($this->session->userdata('id') != '1'){
			$this->db->order_by('id','DESC');
			$this->db->where('created_by',$this->session->userdata('id'));
		}
		else
		{
			$this->db->order_by('confirm');
		}
		
		$query = $this->db->get('withdraw_request');
		return $query->result_array();
	}

	public function get_request_amount($id){
		
				 $this->db->where('id',$id);
		$query = $this->db->get('withdraw_request');
		return $query->result_array();
	}

	public function check_pending_rquist($id)
	{
		$this->db->where('created_by',$id);
		$this->db->where('confirm','0');
		$query = $this->db->get('withdraw_request');
		return $query->result_array();
	}

	public function get_userdata($type,$id)
	{

		if($type == 'agent')
		{
			$this->db->where('user_id',$id);
			$query = $this->db->get('agent_details')->result_array();
		}
		else
		{
			$this->db->where('user_id',$id);
			$query = $this->db->get('business_partners')->result_array();
		}
		return $query[0]['fi_name'].' '.$query[0]['la_name'];
	}

	public function get_user($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('user');
		return $query->result_array();
	}
}
?>