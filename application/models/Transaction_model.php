
<?php
class Transaction_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// For Business Partner Dashboard
	public function get_transaction_business()
	{
		$this->db->where('credit_by',$this->session->userdata('id'));
		$this->db->or_where('debit_by',$this->session->userdata('id'));
		$query = $this->db->get('transaction');
		return $query->result_array();
	}

	public function get_transaction_agent()
	{
		$this->db->where('credit_by',$this->session->userdata('id'));
		$this->db->or_where('debit_by',$this->session->userdata('id'));
		$query = $this->db->get('transaction');
		return $query->result_array();
	}
	/************************************/

	public function distinct_id_credit()
	{
		$this->db->select('credit_by');
		$this->db->distinct();
		$this->db->where('credit_by !=','');
		$query = $this->db->get('transaction');
		return $query->result_array();
	}


	public function all_business()
	{
		

    	$array  = ['id !=' => '1','delete_flag' => '0','user_type' => 'business','key_persons' => '0'];
		return $query = $this->db->get_where('user',$array)->result_array();

	}

	public function get_business_name($id)
	{
		

    	$this->db->where('user_id',$id);
    	$data = $this->db->get('business_partners')->result_array()[0];
    	return $data['fi_name'].' '.$data['mi_name'].' '.$data['la_name'];
	}

	

	public function balance()
	{
		$ar = [];
		foreach ($this->distinct_id_credit() as $key => $value) {

			$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `credit_by` = '".$this->distinct_id_credit()[$key]['credit_by']."'")->result_array();

			$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `debit_by` = '".$this->distinct_id_credit()[$key]['credit_by']."'")->result_array();
			if($credit[0]['all_credit'] - $debit[0]['all_debit'] > 0){
				$ar[] = [$this->distinct_id_credit()[$key]['credit_by'],$credit[0]['all_credit'] - $debit[0]['all_debit']];
			}
		}
		return $ar;
	}


	public function get_parterner_balance($id)
	{
		

			$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `credit_by` = '".$id."'")->result_array();

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

	public function get_parterner_credit($id)
	{
		

			$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `credit_by` = '".$id."' AND `type` != 'investment'")->result_array();

			if($credit){
				$ar = ['balance' => $credit[0]['all_credit']];
			}
			else
			{
				$ar = ['balance' => 0];
			}
			return $ar;
	}

	public function get_parterner_debit($id)
	{
		

			$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `debit_by` = '".$id."'")->result_array();

			if($debit){
				$ar = ['balance' => $debit[0]['all_debit']];
			}
			else
			{
				$ar = ['balance' => 0];
			}
			return $ar;
	}

	public function get_parterner_total_investment($id)
	{
		
			$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `credit_by` = '".$id."' AND `type` = 'investment'")->result_array();

			if($credit){
				$ar = ['balance' => $credit[0]['all_credit']];
			}
			else
			{
				$ar = ['balance' => 0];
			}
			return $ar;
	}
}
?>