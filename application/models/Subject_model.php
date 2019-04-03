<?php
class Subject_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function subjects()
	{
		return $this->db->get_where('subject',['delete_flag' => '0'])->result_array();
	}

	public function subject_fr_id_chk($id)
	{
		return $this->db->get_where('subject',['id' => $id,'delete_flag' => '0'])->result_array();
	}



}
?>