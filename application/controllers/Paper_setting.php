<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paper_setting extends CI_Controller {
	public $year;
	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->auth->check_year();
        $this->load->model('general_model');
        $this->load->model('user_model');
        $this->load->model('professor_model');
        $this->year = $this->load->database(year_db(),TRUE);
    }


	public function index()
	{	
		$data['_title']				= "Paper Setting Files";
		$data['files']				= $this->general_model->get_all_files('1',$this->general_model->active_year());
		
		$this->load->template('paper_setting/file',$data);
	}

	public function add_file()
	{
		
		if($this->general_model->get_files('1'))
		{
			$no = count($this->general_model->get_files('1')) + 1;
		}
		else{
			$no = 1;
		}



		$data = [
						'no'			=> 	$no,
						'head'			=> 	'1',
						'file_name'		=> 	'paper_setting_file'.$no,
						'year'			=>	$this->general_model->active_year(),
						'created_by'	=> 	$this->session->userdata('id'),
						'updated_by'	=> 	$this->session->userdata('id'),
						'created_at' 	=> 	date('Y-m-d H:i:s'),
		        		'updated_at' 	=> 	date('Y-m-d H:i:s')
				];

		if($this->db->insert('file', $data)){
			$file_id = $this->db->insert_id();
			$query = 'CREATE TABLE IF NOT EXISTS `paper_setting_file'.$no.'` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
  						`bill_no` text NOT NULL,
  						`acc_code` text NOT NULL,
  						`name` text NOT NULL,
						`ac_no` text NOT NULL,
						`bank` text NOT NULL,
						`ifsc` text NOT NULL,
						`branch` text NOT NULL,
						`type` text NOT NULL,
						`date` text NOT NULL,
						`cource` text NOT NULL,
						`pap_rate` text NOT NULL,
						`nos` text NOT NULL,
						`day` text NOT NULL,
						`ta` text NOT NULL,
						`tall_tax` text NOT NULL,
						`paper_total` text NOT NULL,
						`day_all` text NOT NULL,
						`total` text NOT NULL,
						PRIMARY KEY (`id`)
					)';
			if($this->year->query($query)){
				$this->session->set_flashdata('msg', 'File Successfully Added');
	        	redirect(base_url().'paper_setting');
        	}
        	else{

        		$this->db->where('id',$file_id);
        		$this->db->delete('file');
        		$this->session->set_flashdata('error', 'Error In Add File Please Try Again');
        		redirect(base_url().'paper_setting');
        	}
		}
		else{

			$this->session->set_flashdata('error', 'Error In Add File Please Try Again');
        	redirect(base_url().'paper_setting');

		}

	}


	public function add_data($id = false)
	{
		if($id){
			if($this->general_model->get_original_file($id,'1'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'1')[0];
				$data['_title']			= 'Paper Setting - File-'.$data['file']['no'];
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				
				if($data['old_data_num'] > 0){
					$this->load->template('paper_setting/edit_data',$data);
				}else{
					$this->load->template('paper_setting/add_data',$data);
				}
			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'paper_setting');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'paper_setting');
			
		}
	}

	public function view_data($id = false)
	{
		if($id){
			if($this->general_model->get_original_file($id,'1'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'1')[0];
				$data['_title']			= 'Paper Setting - File-'.$data['file']['no'];
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				
				if($data['old_data_num'] > 0){
					$this->load->template('paper_setting/view',$data);
				}else{
					$this->session->set_flashdata('error', 'No Data Found');
		        	redirect(base_url().'paper_setting');
				}
			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'paper_setting');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'paper_setting');
			
		}
	}





	public function acc_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->professor_model->acc_autocom($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label'         => $row->acc_code.' - '.$row->name.' - '.$row->acno,
                    'value'			=> $row->acc_code,
                    'name'         	=> $row->name,
                    'acno'         	=> $row->acno,
                    'bnk'         	=> $row->bank_short_name,
                    'ifsc'         	=> $row->ifsc,
                    'branch'         	=> $row->branch
             	);
                echo json_encode($arr_result);
            }
        }
    }

    public function course_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->professor_model->course_autocom($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label'         => $row->name,
                    'paprate'      	=> $row->paper_setting_price
             	);
                echo json_encode($arr_result);
            }
        }
    }




    public function ajax_submit()
    {
    	if($this->year->get($this->input->post('file_name'))->num_rows() > 0)
    	{
    		$this->year->query('TRUNCATE TABLE '.$this->input->post('file_name'));    	
    	}

    	foreach ($this->input->post('bill_id') as $key => $value) {
    		
    		$data 	=	[
    						'bill_no'		=>	$this->input->post('bill_id')[$key],
    						'acc_code'		=>	$this->input->post('acc_code')[$key],
    						'name'			=>	$this->input->post('name')[$key],
    						'ac_no'			=>	$this->input->post('acno')[$key],
    						'bank'			=>	$this->input->post('bank')[$key],
    						'ifsc'			=>	$this->input->post('ifsc')[$key],
    						'branch'		=>	$this->input->post('branch')[$key],
    						'date'			=>	$this->input->post('date')[$key],
    						'cource'		=>	$this->input->post('course')[$key],
    						'pap_rate'		=>	$this->input->post('pap_rate')[$key],
    						'nos'			=>	$this->input->post('nos')[$key],
    						'day'			=>	$this->input->post('day')[$key],
    						'ta'			=>	$this->input->post('ta')[$key],
    						'tall_tax'		=>	$this->input->post('talltax')[$key],
    						'paper_total'	=>	$this->input->post('papertotal')[$key],
    						'day_all'		=>	$this->input->post('day_tot')[$key],
    						'total'			=>	$this->input->post('row_total')[$key],
    						'type'			=>	$this->input->post('type')[$key]
    					];


    		$this->year->insert($this->input->post('file_name'),$data);

    	}




    }







}
