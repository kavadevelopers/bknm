<?php


class Validate extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function RefId_Check($id)
	{
		$query = $this->db->get_where('binary', array('agent_id' => $id));
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function Agennt_RefId_Check($id)
	{
		$query = $this->db->get_where('user', array('user_type_id' => $id,'delete_flag' => '0','key_persons' => '0'));
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}

	}
}

?>