<?php
class Setting_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function financial_year_all(){

		return $this->db->order_by('id', 'DESC')->get_where('financial_year',['delete_flag' => '0'])->result_array();

	}

	public function head_all(){

		return $this->db->order_by('id', 'DESC')->get_where('head',['delete_flag' => '0'])->result_array();

	}

	public function financial_year_df_id($id){

		return $this->db->get_where('financial_year',['delete_flag' => '0','id' => $id])->result_array();

	}

	public function head_df_id($id){

		return $this->db->get_where('head',['delete_flag' => '0','id' => $id])->result_array();

	}


	

}

?>