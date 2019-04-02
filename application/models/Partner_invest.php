<?php
class Partner_invest extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function users()
	{	
		$this->db->where('delete_flag',0);
		$this->db->where('user_type','business');
		$this->db->where('key_persons','0');
		return $data = $this->db->get('user')->result_array();
	}

	public function business_detail($id)
	{	
		$this->db->where('user_id',$id);
		return $this->db->get('business_partners')->result_array()[0];
	}

	public function investment_detail($id)
	{	
		$this->db->where('id',$id);
		return $this->db->get('investment')->result_array();
	}



}

?>