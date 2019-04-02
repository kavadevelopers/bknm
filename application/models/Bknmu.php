<?php

class Bknmu extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function person_by_id($id)
	{
		return $this->db->get_where('person',['id' => $id])->result_array()[0];
	}

	public function cource_by_id($id)
	{
		return $this->db->get_where('cource',['id' => $id])->result_array()[0];
	}




}