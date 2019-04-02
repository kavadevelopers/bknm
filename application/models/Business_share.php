<?php

class Business_share extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_business_all()
	{
				$this->db->where('delete_flag','0');
		$query = $this->db->get('business_share');
    	return $query->result_array();
	}

}
?>