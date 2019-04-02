<?php

class Expense_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_expense($id)
	{
				$this->db->where('id',$id);
				$this->db->where('delete_flag','0');
		$query = $this->db->get('expense');
    	return $query->result_array();
	}

	public function get_expense_all()
	{
				
				$this->db->where('delete_flag','0');
		$query = $this->db->get('expense');
    	return $query->result_array();
	}

	public function get_purchase()
	{
				$this->db->where('delete_flag','0');
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}

	public function get_purchase_row($id)
	{
		if($id != 0)
		{
			$this->db->where('id',$id);
			$query = $this->db->get('purchase');
    		return $query->result_array()[0]['purchase_id'];
		}
		else
		{
			return "Others";
		}
		
	}



	public function expence_purchase_wise($purchase_id)
	{
		$sum = $this->db->query("SELECT SUM(amount) AS `amount_all` FROM `expense` WHERE `purchase_id` = '".$purchase_id."' AND  `delete_flag` = '0'")->result_array();

			if($sum){
				if(empty($sum[0]['amount_all']))
				{
					$ar = 0;
				}
				else
				{
					$ar = $sum[0]['amount_all'];	
				}
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}


}
?>