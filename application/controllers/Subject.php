<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('subject_model');
        $this->load->model('user_model');
    }


	public function index()
	{	
		$data['_title']		= "Manage Courses";
		$data['subjects']	= $this->subject_model->subjects();
		$this->load->template('subject/index',$data);
	}

	public function add()
	{
		$data['_title']		= "Add Courses";
		$this->load->template('subject/add',$data);
	}


	public function edit($subject_id = false)
	{
		if($subject_id){
			if($this->subject_model->subject_fr_id_chk($subject_id)){
				$data['_title']		= "Edit Courses";
				$data['subject']		= $this->subject_model->subject_fr_id_chk($subject_id)[0];
 				$this->load->template('subject/edit',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Courses Not Found Try Again');
		        redirect(base_url().'subject');
			}
		}else{
			$this->session->set_flashdata('error', 'Courses Not Found Try Again');
	        redirect(base_url().'subject');
		}
	}

	public function delete($subject_id = false)
	{
		if($subject_id){
			if($this->subject_model->subject_fr_id_chk($subject_id)){
				
				$subject = array(
			        'delete_flag'         => 	'1',
			        'updated_by'		  => 	$this->session->userdata('id'),
			        'deleted_at' 		  => 	date('Y-m-d H:i:s')
				);

				$this->db->where('id',$subject_id);
				if($this->db->update('subject', $subject)){

					$this->session->set_flashdata('msg', 'Courses Successfully Deleted');
		        	redirect(base_url().'subject');

				}
				else{

					$this->session->set_flashdata('error', 'Error In Delete Courses Please Try Again');
		        	redirect(base_url().'subject');

				}

			}
			else{
				$this->session->set_flashdata('error', 'Courses Not Found Try Again');
		        redirect(base_url().'subject');
			}
		}else{
			$this->session->set_flashdata('error', 'Courses Not Found Try Again');
		    redirect(base_url().'subject');
		}
	}


	public function save()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('subject_name', 'Courses Name', 'callback_subject_unique');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('pep_setting_price', 'Paper Setting Price', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('pep_assesment_price', 'Paper Assessment Price', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('examination_fees', 'Examination Fees', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('total_papers', 'Total Papers', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('pep_moderation_price', 'Paper Moderation Price', 'trim|required|max_length[200]|numeric');


		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Courses";
			$this->load->template('subject/add',$data);
		}
		else
		{

			$subject = array(
		        'name'           	  		=> 	$this->input->post('subject_name'),
		        'paper_setting_price'       => 	$this->input->post('pep_setting_price'),
		        'assessment_price'       	=> 	$this->input->post('pep_assesment_price'),
		        'examination_fees'       	=> 	$this->input->post('examination_fees'),
		        'total_paper'       		=> 	$this->input->post('total_papers'),
		        'semester'       			=> 	$this->input->post('semester'),
		        'moderation_price'     		=> 	$this->input->post('pep_moderation_price'),
		        'created_by'		  		=> 	$this->session->userdata('id'),
		        'updated_by'		  		=> 	$this->session->userdata('id'),
		        'created_at' 		 		=> 	date('Y-m-d H:i:s'),
		        'updated_at' 		 		=> 	date('Y-m-d H:i:s')
			);

			if($this->db->insert('subject', $subject)){

				$this->session->set_flashdata('msg', 'Courses Successfully Added');
	        	redirect(base_url().'subject');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add Courses Please Try Again');
	        	redirect(base_url().'subject/add');

			}

		}
	}

	public function update()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('subject_name', 'Courses Name', 'callback_subject_unique_edit['.$this->input->post('id').']');
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('pep_setting_price', 'Paper Setting Price', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('pep_assesment_price', 'Paper Assessment Price', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('examination_fees', 'Examination Fees', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('total_papers', 'Total Papers', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('pep_moderation_price', 'Paper Moderation Price', 'trim|required|max_length[200]|numeric');
		$this->form_validation->set_rules('id', 'id', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Courses";
			$data['subject']	= $this->subject_model->subject_fr_id_chk($this->input->post('id'))[0];
			$this->load->template('subject/edit',$data);
		}
		else
		{

			$subject = array(
		        'name'           	  		=> 	$this->input->post('subject_name'),
		        'paper_setting_price'       => 	$this->input->post('pep_setting_price'),
		        'assessment_price'       	=> 	$this->input->post('pep_assesment_price'),
		        'examination_fees'       	=> 	$this->input->post('examination_fees'),
		        'total_paper'       		=> 	$this->input->post('total_papers'),
		        'semester'       			=> 	$this->input->post('semester'),
		        'moderation_price'     		=> 	$this->input->post('pep_moderation_price'),
		        'updated_by'		 		=> 	$this->session->userdata('id'),
		        'updated_at' 		  		=> 	date('Y-m-d H:i:s')
			);
			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('subject', $subject)){

				$this->session->set_flashdata('msg', 'Courses Successfully Save');
	        	redirect(base_url().'subject');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Courses Please Try Again');
	        	redirect(base_url().'subject');

			}

		}
	}




	public function subject_unique($subject){

		if($subject != ''){
			if(strlen($subject) > 200){
				$this->form_validation->set_message(__FUNCTION__ , 'Courses Name Not Allowed Greater Than 200 Characters');
	        	return false;
			}
			else{
				if($this->db->get_where('subject',['name' => $subject,'delete_flag' => '0'])->result_array()){
					$this->form_validation->set_message(__FUNCTION__ , 'Courses Name Already Exists');
		            return false;
				}
				else{
					return true;
				}
			}
		}
		else{
			$this->form_validation->set_message(__FUNCTION__ , 'Courses Name Is Required');
	        return false;
		}

	}


	public function subject_unique_edit($subject,$id){

		if($subject != ''){
			if(strlen($subject) > 200){
				$this->form_validation->set_message(__FUNCTION__ , 'Courses Name Not Allowed Greater Than 200 Characters');
	        	return false;
			}
			else{
				if($this->db->get_where('subject',['name' => $subject,'delete_flag' => '0','id !=' => $id])->result_array()){
					$this->form_validation->set_message(__FUNCTION__ , 'Courses Name Already Exists');
		            return false;
				}
				else{
					return true;
				}
			}
		}
		else{
			$this->form_validation->set_message(__FUNCTION__ , 'Courses Name Is Required');
	        return false;
		}

	}


}
?>