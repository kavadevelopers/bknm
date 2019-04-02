<?php
class Login_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login_Ath($user,$pass,$code)
	{
		$user = $this->db->escape($user);
		$select = $this->db->query("SELECT * FROM `user` WHERE user_name = $user AND `delete_flag` = '0'" );

		if($select->num_rows() > 0)
		{
			$data = $select->result_object();
			if($data[0]->pass === $pass)
			{
				if($this->auth_code($data[0]->user_type) === $code)
				{
					return array(0,'Login Successfull...','dashboard',$data[0]->id,$data[0]->user_type,$data[0]->user_type_id,$data[0]->user_type);
				}
				else
				{
					return array(1,'Please Enter Valid Authentication Code','');
				}
			}
			else
			{
				return array(1,'Username And Password Not Match','');
			}
		}
		else
		{
			return array(1,'Username Not Registered','');
		}
	}
}

?>