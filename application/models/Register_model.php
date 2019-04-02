<?php
class Register_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function user_check($user)
	{
		$select = $this->db->query("SELECT * FROM `user` WHERE `user_name` = '$user' ");

		if($select->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function email_check($mail){
		$email = $this->db->query("SELECT * FROM `user` WHERE `email` = '$mail' ");

		if($email->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function reference_check($refer){
		$data = $this->db->query("SELECT * FROM `user` WHERE `user_type_id` = '$refer' ");

		if($data->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	// Insert Data 
	function insert_data($data)
	{
	    $this->db->insert('user',$data);
	    return false;
	}
}
?>