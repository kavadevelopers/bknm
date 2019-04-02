<?php
class Setting_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_plan_code()
	{

				$this->db->where('delete_flag','0');
				$this->db->order_by('id','DESC');
		$query = $this->db->get('plan_code');
    	return $query->result_array();
	}

	public function edit_plan_code($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('plan_code');
    	return $query->result_array();
	}

	public function get_bank()
	{

				$this->db->where('id','1');
		$query = $this->db->get('bank');
    	return $query->result_array()[0];
	}

	public function get_promotion()
	{

				$this->db->where('id','1');
		$query = $this->db->get('agent_promotion');
    	return $query->result_array()[0];
	}


	public function get_plan_code_single($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('plan_code');
    	return $query->result_array()[0];
	}

	public function get_plan_code_single_by_code($id)
	{

				$this->db->where('plan_code',$id);
		$query = $this->db->get('plan_code');
    	return $query->result_array()[0];
	}

	
	public function get_agent_deactivation()
	{

		$query = $this->db->get('agent_deactivation');
    	return $query->result_array()[0];
	}

	public function get_locations()
	{
		return $this->db->get_where('purchase',['delete_flag' => '0'])->result_array();
	}


	public function get_authcode()
	{
		return $this->db->get('auth_key')->result_array();
	}

	


}

?>