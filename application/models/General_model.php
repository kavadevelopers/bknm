<?php
class General_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function active_year()
	{
		return $this->db->get_where('financial_year',['active' => '1'])->result_array()[0]['id'];	
	}

	public function active_year_data()
	{
		return $this->db->get_where('financial_year',['active' => '1'])->result_array()[0];	
	}

	public function get_files($head_id)
	{
		return $this->db->get_where('file',['head' => $head_id, 'year' => $this->active_year() ])->result_array();
	}

	public function get_all_files($head_id,$year)
	{
		return $this->db->order_by('id','DESC')->get_where('file',['head' => $head_id, 'year' => $year ])->result_array();
	}

	public function get_head($id)
	{
		return $this->db->get_where('head',['id' => $id])->result_array();
	}

	public function get_year($id)
	{
		return $this->db->get_where('financial_year',['id' => $id])->result_array();
	}

	public function get_file($id)
	{
		return $this->db->get_where('file',['id' => $id])->result_array();
	}


	public function get_original_file($id,$head_id){
		return $this->db->get_where('file',['id' => $id,'head' => $head_id, 'year' => $this->active_year() ])->result_array();
	}




}