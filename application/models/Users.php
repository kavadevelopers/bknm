<?php
class Users extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/*****************************************/
	public function leg($agent_id){

				 $this->db->where('agent_id',$agent_id);
		$query = $this->db->get('binary');
		return $query->result_array()[0];
	}


	/*****************************************/



	public function all_agents($user_type)
	{
		
				 $this->db->order_by("id","desc");
				 if($this->session->userdata('user_type') == 'agent'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
					}
				 $this->db->where('id !=','1');
				 $this->db->where('delete_flag','0');
				 $this->db->where('user_type',$user_type);
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function _all_agents($user_type)
	{
		
				 $this->db->order_by("id","desc");
				 if($this->session->userdata('user_type') == 'agent'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
					}
				 $this->db->where('id !=','1');
				 $this->db->where('delete_flag','0');
				 $this->db->where('key_persons','0');
				 $this->db->where('user_type',$user_type);
		$query = $this->db->get('user');
    	return $query->result_array();
	}


	public function get_user($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function get_user_by_ref($id)
	{

				$this->db->where('user_type_id',$id);
		$query = $this->db->get('user');
    	return $query->result_array()[0];
	}

	public function get_user_with_type($id,$type)
	{

				$this->db->where('id',$id);
				$this->db->where('user_type',$type);
				$this->db->where('delete_flag','0');
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	

	public function get_agent($id)
	{

				$this->db->where('id',$id);
				$this->db->where('user_type','agent');
				
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function agent_detail($id)
	{

				$this->db->where('user_id',$id);
		$query = $this->db->get('agent_details');
    	return $query->result_array();
	}

	public function active_agent($id)
	{
				$this->db->where('agent_id',$id);
		$query = $this->db->get('binary');
    	return $query->result_array();
	}



	/*//////////////////////////////////////////////////////////////////////////////////////
								STRAT SUBADMIN
	//////////////////////////////////////////////////////////////////////////////////////*/
	
	public function subadmin_detail($id)
	{

				$this->db->where('user_id',$id);
		$query = $this->db->get('subadmin_details');
    	return $query->result_array();
	}

	/*//////////////////////////////////////////////////////////////////////////////////////
								START BUSINESS PARTNER
	//////////////////////////////////////////////////////////////////////////////////////*/
	
	// USE Business Partner Share
	public function business_detail($id)
	{

				$this->db->where('user_id',$id);
		$query = $this->db->get('business_partners');
    	return $query->result_array();
	}

	// USE Business Partner Share
	public function all_business()
	{
				$this->db->where('id !=','1');
				$this->db->where('key_persons','0');
				$this->db->where('delete_flag','0');
				$this->db->where('user_type','business');
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	// USE Business Partner Share
	public function all_business_user_type($id)
	{
				$this->db->where('id',$id);
		$query = $this->db->get('user');
    	return $query->result_array();
	}
	

	public function business_partner()
	{
				$this->db->order_by('id','ASC');
				$this->db->where('user_type','business');
				$this->db->where('delete_flag','0');
				$this->db->where('key_persons','0');
		$query = $this->db->get('user');
    	return $query->result_array();
	}
	/*//////////////////////////////////////////////////////////////////////////////////////
								START COUSTMER
	//////////////////////////////////////////////////////////////////////////////////////*/
	
	public function customer_detail($id)
	{
				$this->db->where('user_id',$id);
		$query = $this->db->get('customer_detail');
    	return $query->result_array();
	}


	public function get_customer_id($id)
	{

				$this->db->where('user_type_id',$id);
				$this->db->where('delete_flag','0');
				$this->db->where('user_type_id',$id);
				$this->db->where('user_type','customer');
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function get_agent_id($id)
	{

				$this->db->where('user_type_id',$id);
				$this->db->where('delete_flag','0');
				$this->db->where('user_type_id',$id);
				$this->db->where('user_type','agent');
		$query = $this->db->get('user');
    	return $query->result_array();
	}
	

	/*//////////////////////////////////////////////////////////////////////////////////////
								KEY PERSONS
	//////////////////////////////////////////////////////////////////////////////////////*/

	public function key_persons()
	{
				$this->db->where('id !=','1');
				$this->db->where('delete_flag','0');
				$this->db->where('user_type','business');
				$this->db->where('key_persons','1');
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function get_key_persons($id)
	{

				$this->db->where('id',$id);
				$this->db->where('id !=','1');
				$this->db->where('delete_flag','0');
				$this->db->where('user_type','business');
				$this->db->where('key_persons','1');
		$query = $this->db->get('user');
    	return $query->result_array();
	}

}