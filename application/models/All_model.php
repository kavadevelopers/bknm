<?php

class All_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}




	public function agent_total_debit($id)
	{	
		
		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `debit_by` = '".$id."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function agent_total_credit($id)
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND  `credit_by` = '".$id."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}


	public function agent_balance($id)
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND  `credit_by` = '".$id."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `debit_by` = '".$id."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$dbt = $debit[0]['all_debit'];
			}
			else
			{
				$dbt = 0;
			}

			return $ar - $dbt;

	}

	public function sale_get_byid($id)
	{
		return $this->db->get_where('sell_product',['created_by' => $id])->result_array();
	}


	public function business_total_debit($id)
	{	
		
		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `type` = 'withdraw' AND `debit_by` = '".$id."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function business_total_credit($id)
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND `type` != 'investment' AND `credit_by` = '".$id."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}


	public function business_balance($id)
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND `type` != 'investment' AND  `credit_by` = '".$id."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `type` = 'withdraw' AND `debit_by` = '".$id."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$dbt = $debit[0]['all_debit'];
			}
			else
			{
				$dbt = 0;
			}

			return $ar - $dbt;

	}


	public function get_transaction_business($id)
	{
		$this->db->where('credit_by',$id);
		$this->db->or_where('debit_by',$id);
		$query = $this->db->get('transaction');
		return $query->result_array();
	}



}


?>