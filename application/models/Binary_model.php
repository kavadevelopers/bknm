<?php
class Binary_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_tree_data($id){
		$this->db->where('user_type_id',$id);
		$this->db->where('delete_flag','0');
		return $data = $this->db->get('user')->result_array()[0];
	}

	public function find_agent($id){
		$this->db->where('user_type','agent');
		$this->db->where('user_type_id',$id);
		return $this->db->get('user')->result_array();
	}		


	public function get_left($agent)
	{
		$this->db->where('parent',$agent);
		$this->db->where('leg','left');
		return $this->db->get('binary')->result_array();
	}

	public function get_right($agent)
	{
		$this->db->where('parent',$agent);
		$this->db->where('leg','right');
		return $this->db->get('binary')->result_array();
	}

	


	public function get_agent_leg($agent_id){
		$this->db->where('agent_id',$agent_id);
		return $this->db->get('binary')->result_array()[0];
	}

	public function update_parent_after_insert($agent_id,$parent_id,$leg)
	{
		$this->db->where('agent_id',$parent_id);
		$parent_data = $this->db->get('binary')->result_array()[0];
		if($parent_data[$leg] == '')
		{
			$update = [
				$leg     	 => $agent_id,
				'last_leg'   => $leg
 			];
 			$this->db->where('agent_id',$parent_id);
 			$this->db->update('binary',$update);
		}
		else
		{
			$new_agent_id = $parent_data[$leg];
			while($this->get_agent_leg($new_agent_id)[$leg] != ''){

				$new_agent_id = $this->get_agent_leg($new_agent_id)[$leg];

			}

			$update = [
				$leg     	 => $agent_id
 			];
 			$this->db->where('agent_id',$new_agent_id);
 			$this->db->update('binary',$update);


 			$update_main = [
				'last_leg'   => $leg
 			];
 			$this->db->where('agent_id',$parent_id);
 			$this->db->update('binary',$update_main);
		}
	}

	public function update_parent_register($agent_id,$parent_id)
	{
		$this->db->where('agent_id',$parent_id);
		$parent_data = $this->db->get('binary')->result_array()[0];

		if($parent_data['last_leg'] == '')
		{
			$update = [
				'left'     	 => $agent_id,
				'last_leg'   => 'left'
 			];
 			$this->db->where('agent_id',$parent_id);
 			$this->db->update('binary',$update);
		}
		else if($parent_data['last_leg'] == 'left')
		{
			$leg = 'right';
			if($parent_data['right'] == ''){
				$update = [
					'right'     	 => $agent_id,
					'last_leg'   => 'right'
	 			];
	 			$this->db->where('agent_id',$parent_id);
	 			$this->db->update('binary',$update);
	 		}
	 		else
	 		{
	 			$new_agent_id = $parent_data[$leg];
				while($this->get_agent_leg($new_agent_id)[$leg] != ''){

					$new_agent_id = $this->get_agent_leg($new_agent_id)[$leg];

				}

				$update = [
					$leg     	 => $agent_id
	 			];
	 			$this->db->where('agent_id',$new_agent_id);
	 			$this->db->update('binary',$update);


	 			$update_main = [
					'last_leg'   => $leg
	 			];
	 			$this->db->where('agent_id',$parent_id);
	 			$this->db->update('binary',$update_main);
	 		}
		}
		else if($parent_data['last_leg'] == 'right')
		{
			$leg = 'left';
			if($parent_data['left'] == ''){
				$update = [
					'left'     	 => $agent_id,
					'last_leg'   => 'left'
	 			];
	 			$this->db->where('agent_id',$parent_id);
	 			$this->db->update('binary',$update);
	 		}
	 		else
	 		{
	 			$new_agent_id = $parent_data[$leg];
				while($this->get_agent_leg($new_agent_id)[$leg] != ''){

					$new_agent_id = $this->get_agent_leg($new_agent_id)[$leg];

				}

				$update = [
					$leg     	 => $agent_id
	 			];
	 			$this->db->where('agent_id',$new_agent_id);
	 			$this->db->update('binary',$update);


	 			$update_main = [
					'last_leg'   => $leg
	 			];
	 			$this->db->where('agent_id',$parent_id);
	 			$this->db->update('binary',$update_main);
	 		}
		}
		
	}

}