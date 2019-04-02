<?php
class My_custom_func_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}



	public function get_user_type_id($userType)
	{
		$select = $this->db->query("SELECT * FROM `user` WHERE `user_type` = '$userType' ORDER BY `id` DESC LIMIT 1");

		$prefix = $this->db->query("SELECT * FROM `prefix` WHERE `user_type` = '$userType' ");

		if($select->num_rows() > 0)
		{
			$prefix = $prefix->result_array();
			$select = $select->result_array();
			$autoinc = intval(str_replace($prefix[0]['prefix'],' ',$select[0]['user_type_id'])) + 1;
			return $prefix[0]['prefix'].$autoinc;
		}
		else
		{
			$prefix = $prefix->result_array();
			return $prefix[0]['prefix'].'1';
		}
	}

	public function new_purchase_id()
	{
		$select = $this->db->query("SELECT * FROM `purchase` WHERE `delete_flag` = '0' ORDER BY `id` DESC LIMIT 1");

		$prefix = $this->db->query("SELECT * FROM `prefix` WHERE `user_type` = 'purchase' ");

		if($select->num_rows() > 0)
		{
			$prefix = $prefix->result_array();
			$select = $select->result_array();
			$autoinc = intval(str_replace($prefix[0]['prefix'],' ',$select[0]['purchase_id'])) + 1;
			return $prefix[0]['prefix'].$autoinc;
		}
		else
		{
			$prefix = $prefix->result_array();
			return $prefix[0]['prefix'].'1';
		}
	}
	
	public function get_key_person_id($userType)
	{
		$select = $this->db->query("SELECT * FROM `user` WHERE `user_type` = '$userType' AND `key_persons` = '1' ORDER BY `id` DESC LIMIT 1");

		$prefix = $this->db->query("SELECT * FROM `prefix` WHERE `user_type` = 'person' ");

		if($select->num_rows() > 0)
		{
			$prefix = $prefix->result_array();
			$select = $select->result_array();
			$autoinc = intval(str_replace($prefix[0]['prefix'],' ',$select[0]['user_type_id'])) + 1;
			return $prefix[0]['prefix'].$autoinc;
		}
		else
		{
			$prefix = $prefix->result_array();
			return $prefix[0]['prefix'].'1';
		}
	}

}
?>