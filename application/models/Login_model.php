<?php
class Login_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login_Ath($user,$pass,$year)
	{
		$user = $this->db->escape($user);
		$select = $this->db->query("SELECT * FROM `user` WHERE user_name = $user AND `delete_flag` = '0'" );

		if($select->num_rows() > 0)
		{
			$data = $select->result_object();
			if($data[0]->pass === $pass)
			{
				
				foreach(explode(',',$data[0]->year) as $k => $v)
				{	
					if($year == $v)
					{
						return array(0,'Login Successfull...','dashboard',$data[0]->id);
						exit;
					}
				}

				return array(1,'Username And Financial Year Not Match','');

				
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

	public function pre_login_Ath($user,$pass)
	{
		$user = $this->db->escape($user);
		$select = $this->db->query("SELECT * FROM `user` WHERE user_name = $user AND `delete_flag` = '0'" );

		if($select->num_rows() > 0)
		{
			$data = $select->result_object();
			if($data[0]->pass === $pass)
			{
				$options = '<option value="">-- Select Financial Year --</option>';
				foreach (explode(',',$data[0]->year) as $key => $value) {
					$options .= '<option value="'.$value.'">'.$value.'</option>';
				}

				return array(0,'<select id="year_drop" class="form-control" required>'.$options.'</select>');
				
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