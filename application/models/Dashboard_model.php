<?php
class Dashboard_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function count_professor()
	{
		return $this->db->get_where("professor",['delete_flag' => '0'])->num_rows();
	}

}
?>