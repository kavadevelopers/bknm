<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('setting_model');
        $this->load->model('user_model');
        $this->load->dbforge();
    }


	public function index()
	{	
		redirect('error404');
	}

	public function financial_year()
	{

		$data['_title']		= "Manage Financial Year";
		$data['year']		= $this->setting_model->financial_year_all();
		$this->load->template('setting/financial_year',$data);

	}

	public function head()
	{

		$data['_title']		= "Manage Head";
		$data['head']		= $this->setting_model->head_all();
		$this->load->template('setting/head',$data);

	}

	public function file_limit()
	{

		$data['_title']		= "Change File Limit";
		$data['setting']	= $this->db->get_where('setting',['id' => '1'])->result_array()[0];
		$this->load->template('setting/setting',$data);

	}

	public function save_file_limit()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('file_limit', 'File Limit', 'trim|required|min_length[1]|max_length[250]|numeric');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Change File Limit";
			$data['setting']	= $this->db->get_where('setting',['id' => '1'])->result_array()[0];
			$this->load->template('setting/setting',$data);
		}
		else
		{

			$setting = array(
		        
		        'file_limit'          => 	$this->input->post('file_limit')
		        
			);


			$this->db->where('id','1');
			if($this->db->update('setting', $setting)){

				$this->session->set_flashdata('msg', 'Setting Successfully Saved');
	        	redirect(base_url().'setting/file_limit');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Setting Please Try Again');
	        	redirect(base_url().'setting/file_limit');

			}

		}
	}



	public function save_financial_year()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('financial_year', 'Financial Year', 'trim|required|min_length[9]|max_length[9]|callback_f_year_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Manage Financial Year";
			$data['year']		= $this->setting_model->financial_year_all();
			$this->load->template('setting/financial_year',$data);
		}
		else
		{
			$year = array(
		        
		        'name'           	  => 	$this->input->post('financial_year'),
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('financial_year', $year)){
				$id_year = $this->db->insert_id();
				if($this->dbforge->create_database($this->input->post('financial_year'))){

					if($this->db->get('financial_year')->num_rows() == 1)
					{
						$this->db->where('id',$id_year);
						$this->db->update("financial_year",['active' => '1']);
					}

					$this->session->set_flashdata('msg', 'Financial Year Successfully Added');
	        		redirect(base_url().'setting/financial_year');
				}
				else{
					$this->db->where('id',$id_year);
					$this->db->delete("financial_year");
					$this->session->set_flashdata('error', 'Error In Add Financial Year Please Try Again');
	        		redirect(base_url().'setting/financial_year');
				}

				

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add Financial Year Please Try Again');
	        	redirect(base_url().'setting/financial_year');

			}

		}
	}

	public function save_head()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('head', 'Head Name', 'trim|required|min_length[2]|max_length[200]|callback_head_check');
		$this->form_validation->set_rules('file_limit', 'File Limit', 'trim|required|max_length[4]|numeric');


		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Manage Head";
			$data['head']		= $this->setting_model->head_all();
			$this->load->template('setting/head',$data);
		}
		else
		{

			$year = array(
		        
		        'name'           	  => 	$this->input->post('head'),
		        'file_limit'          => 	$this->input->post('file_limit'),
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('head', $year)){

				$this->session->set_flashdata('msg', 'Head Successfully Added');
	        	redirect(base_url().'setting/head');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add Head Please Try Again');
	        	redirect(base_url().'setting/head');

			}

		}
	}


	public function edit_head($id = false)
	{

		if($id){

			if($this->setting_model->head_df_id($id)){

				$data['_title']		= "Edit Head";
				$data['fyear']		= $this->setting_model->head_df_id($id)[0];
				$this->load->template('setting/head',$data);

			}else{

				$this->session->set_flashdata('error', 'Head Not Found Try Again');
	        	redirect(base_url().'setting/head');

			}


		}else{

			$this->session->set_flashdata('error', 'Head Not Found Try Again');
	        redirect(base_url().'setting/head');

		}

	}

	public function update_head()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

		$this->form_validation->set_rules('head', 'Head Name', 'trim|required|min_length[2]|max_length[200]|callback_head_checkedit['.$this->input->post('id').']');
		$this->form_validation->set_rules('file_limit', 'File Limit', 'trim|required|max_length[4]|numeric');
		$this->form_validation->set_rules('day', 'Day Allowance', 'trim|required|max_length[4]|numeric');
		
		$this->form_validation->set_rules('id', 'id', 'trim');

		if($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Head";
			$data['fyear']		= $this->setting_model->head_df_id($this->input->post('id'))[0];
			$this->load->template('setting/head',$data);
		}
		else
		{

			$year = array(
		        
		        'name'           	  => 	$this->input->post('head'),
		        'file_limit'          => 	$this->input->post('file_limit'),
		        'day' 				  => 	$this->input->post('day'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('head', $year)){

				$this->session->set_flashdata('msg', 'Head Successfully Saved');
	        	redirect(base_url().'setting/head');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Head Please Try Again');
	        	redirect(base_url().'setting/head');

			}

		}
	}


	public function delete_financial_year($id = false)
	{
		if($id){

			if($this->setting_model->financial_year_df_id($id)){

				$this->db->where('id',$id);
				if($this->db->update('financial_year', ['delete_flag' => '1','updated_by' => $this->session->userdata('id'),'deleted_at' =>	date('Y-m-d H:i:s')])){

					$this->session->set_flashdata('msg', 'Financial Year Successfully Deleted');
		        	redirect(base_url().'setting/financial_year');

				}
				else{

					$this->session->set_flashdata('error', 'Error In Delete Financial Year Please Try Again');
		        	redirect(base_url().'setting/financial_year');

				}
				

			}else{

				$this->session->set_flashdata('error', 'Financial Year Not Found Try Again');
	        	redirect(base_url().'setting/financial_year');

			}


		}else{

			$this->session->set_flashdata('error', 'Financial Year Not Found Try Again');
	        redirect(base_url().'setting/financial_year');

		}
	}

	public function active_financial_year($id = false)
	{
		if($id){

			if($this->setting_model->financial_year_df_id($id)){

				$this->db->update('financial_year', ['active' => '0','updated_by' => $this->session->userdata('id'),'updated_at' =>	date('Y-m-d H:i:s')]);

				$this->db->where('id',$id);
				if($this->db->update('financial_year', ['active' => '1','updated_by' => $this->session->userdata('id'),'updated_at' =>	date('Y-m-d H:i:s')])){

					$this->session->set_flashdata('msg', 'Financial Year Successfully Activated');
		        	redirect(base_url().'setting/financial_year');

				}
				else{

					$this->session->set_flashdata('error', 'Error In Active Financial Year Please Try Again');
		        	redirect(base_url().'setting/financial_year');

				}
				

			}else{

				$this->session->set_flashdata('error', 'Financial Year Not Found Try Again');
	        	redirect(base_url().'setting/financial_year');

			}


		}else{

			$this->session->set_flashdata('error', 'Financial Year Not Found Try Again');
	        redirect(base_url().'setting/financial_year');

		}
	}


	public function active_year_dash($name)
	{
		$this->session->set_userdata('year',$name);

		$this->session->set_flashdata('msg', 'Financial Year Successfully Changed To '.$name);
		redirect(base_url('dashboard'));
	}


	public function delete_head($id = false)
	{
		if($id){

			if($this->setting_model->head_df_id($id)){

				$this->db->where('id',$id);
				if($this->db->update('head', ['delete_flag' => '1','updated_by' => $this->session->userdata('id'),'deleted_at' =>	date('Y-m-d H:i:s')])){

					$this->session->set_flashdata('msg', 'Head Successfully Deleted');
		        	redirect(base_url().'setting/head');

				}
				else{

					$this->session->set_flashdata('error', 'Error In Delete Head Please Try Again');
		        	redirect(base_url().'setting/head');

				}
				

			}else{

				$this->session->set_flashdata('error', 'Head Not Found Try Again');
	        	redirect(base_url().'setting/head');

			}


		}else{

			$this->session->set_flashdata('error', 'Head Not Found Try Again');
	        redirect(base_url().'setting/head');

		}
	}

	public function f_year_checkedit($year,$id)
	{

		if($this->db->get_where('financial_year',['name' => $year,'id !=' => $id])->result_array())
		{
			$this->form_validation->set_message(__FUNCTION__ , 'Financial Year Already Exists');
            return false;
		}
		else{
			return true;
		}

	}


	public function head_checkedit($name,$id)
	{

		if($this->db->get_where('head',['name' => $name,'id !=' => $id])->result_array())
		{
			$this->form_validation->set_message(__FUNCTION__ , 'Head Name Already Exists');
            return false;
		}
		else{
			return true;
		}

	}

	public function f_year_check($year)
	{

		if($this->db->get_where('financial_year',['name' => $year,'delete_flag' => '0'])->result_array())
		{
			$this->form_validation->set_message(__FUNCTION__ , 'Financial Year Already Exists');
            return false;
		}
		else{
			return true;
		}

	}


	public function head_check($name)
	{

		if($this->db->get_where('head',['name' => $name,'delete_flag' => '0'])->result_array())
		{
			$this->form_validation->set_message(__FUNCTION__ , 'Head Name Already Exists');
            return false;
		}
		else{
			return true;
		}

	}


}
?>