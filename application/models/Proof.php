<?php
class Proof extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get Proof Data For All Module
	
		public function proof_type($user_type)
		{
			$query = $this->db->get('proof');
	    	return $query->result_array();
		}

	/*******************************************/

}
?>