<?php
class Dashboard_model extends CI_Model
{
	public $year;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->year = $this->load->database(year_db(),TRUE);
	}

	public function count_professor()
	{
		return $this->db->get_where("professor",['delete_flag' => '0'])->num_rows();
	}


	public function total_by_head($head)
	{
		$files = $this->db->get_where('file',['head' => $head,'year' => $this->session->userdata('year')])->result_array();
		$total = 0;
		foreach ($files as $key => $value) {
			$this->year->where('bill_no !=','Credit');
			$file = $this->year->get($value['file_name']);
			if($file->num_rows() > 0)
			{
				foreach ($file->result_array() as $keya => $valuea) {
					$total += $valuea['total'];
				}
			}
		}

		return $total;
	}



}
?>