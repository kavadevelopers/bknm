<?php
class User_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function users()
	{
		return $this->db->get_where("user",['delete_flag' => '0','id !=' => '1'])->result_array();
	}

	
	public function user_from_usename($username)
	{
		return $this->db->get_where("user",['user_name' => $username])->result_array();
	}

	public function user_from_id($userid)
	{
		return $this->db->get_where("user",['id' => $userid,'id !=' => '1'])->result_array();
	}

	public function _user($userid)
	{
		return $this->db->get_where("user",['id' => $userid])->result_array();
	}

	public function user_from_mobile_id($mobile,$id)
	{
		return $this->db->get_where("user",['mobile' => $mobile ,'id !=' => $id])->result_array();
	}

	public function user_from_email_id($email,$id)
	{
		return $this->db->get_where("user",['email' => $email ,'id !=' => $id])->result_array();
	}


	


}

?>