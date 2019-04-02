<?php
class Partner_transact extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function business_id($id)
	{
				$this->db->where('delete_flag','0');
				$this->db->where('id !=','1');
				$this->db->where('user_type_id',$id);
		$query = $this->db->get('user');
    	return $query->result_array()[0];
	}



	public function business_partner_transaction($id)
	{			
				$this->db->where('credit_by',$id);
				$this->db->or_where('debit_by',$id);
		$query = $this->db->get('transaction');
    	return $query->result_array();
	}

	public function get_expense_type($expen_id)
	{
		$this->db->where('id',$expen_id);
		$query = $this->db->get('expense');
    	return $query->result_array()[0];
	}

	public function get_purchase_id($purchase_id)
	{
		$this->db->where('id',$purchase_id);
		$query = $this->db->get('purchase');
    	return $query->result_array()[0];
	}


}
?>