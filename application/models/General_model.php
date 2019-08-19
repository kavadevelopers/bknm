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
		return $this->session->userdata('year');
	}

	public function get_all_finincial_year()
	{
		return $this->db->get_where('financial_year')->result_array();	
	}

	public function get_files($head_id)
	{
		return $this->db->get_where('file',['head' => $head_id, 'year' => $this->active_year() ])->result_array();
	}

	public function get_files_new($head_id,$sem)
	{
		return $this->db->get_where('file',['head' => $head_id, 'year' => $this->active_year(),'sem' => $sem])->result_array();
	}

	public function get_all_files($head_id,$year)
	{
		return $this->db->order_by('id','DESC')->get_where('file',['head' => $head_id, 'year' => $year ])->result_array();	
	}

	public function count_dashboard_files($head_id,$year)
	{
		if($this->session->userdata('sem') && $this->session->userdata('sem') != '0'){
			$this->db->where('sem',$this->session->userdata('sem'));
		}
		return $this->db->order_by('id','DESC')->get_where('file',['head' => $head_id, 'year' => $year ])->result_array();	
	}

	public function get_files_for_index($head_id,$year)
	{
		if($this->session->userdata('sem') && $this->session->userdata('sem') != '0'){
			$this->db->where('sem',$this->session->userdata('sem'));
		}
		return $this->db->order_by('id','DESC')->get_where('file',['head' => $head_id, 'year' => $year ])->result_array();	
	}

	public function get_checked_files($file_ids)
	{
			foreach ($file_ids as $key => $value) {
				$this->db->or_where('id',$value);
			}
		return $this->db->order_by('id','ASC')->get('file')->result_array();	
	}

	public function get_head($id)
	{
		return $this->db->get_where('head',['id' => $id])->result_array();
	}

	public function get_original_file($id,$head_id){
		return $this->db->get_where('file',['id' => $id,'head' => $head_id, 'year' => $this->active_year() ])->result_array();
	}

	public function get_file_byid($id){
		return $this->db->get_where('file',['id' => $id])->result_array()[0];
	}

    public function _get_file_byid($id){
        return $this->db->get_where('file',['id' => $id])->result_array();
    }


}