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
		$data['_title']		= "Manage Subject";
		$data['subjects']	= $this->subject_model->subjects();
		$this->load->template('subject/index',$data);
	}

	public function add()
	{
		$data['_title']		= "Add Subject";
		$this->load->template('subject/add',$data);
	}


	public function edit($subject_id = false)
	{
		if($subject_id){
			if($this->subject_model->subject_fr_id_chk($subject_id)){
				$data['_title']		= "Edit Subject";
				$data['subject']		= $this->subject_model->subject_fr_id_chk($subject_id)[0];
 				$this->load->template('subject/edit',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Subject Not Found Try Again');
		        redirect(base_url().'subject');
			}
		}else{
			$this->session->set_flashdata('error', 'Subject Not Found Try Again');
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

					$this->session->set_flashdata('msg', 'Subject Successfully Deleted');
		        	redirect(base_url().'subject');

				}
				else{

					$this->session->set_flashdata('error', 'Error In Delete Subject Please Try Again');
		        	redirect(base_url().'subject');

				}

			}
			else{
				$this->session->set_flashdata('error', 'Subject Not Found Try Again');
		        redirect(base_url().'subject');
			}
		}else{
			$this->session->set_flashdata('error', 'Subject Not Found Try Again');
		    redirect(base_url().'subject');
		}
	}


	public function save()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('subject_name', 'Subject Name', 'callback_subject_unique');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Subject";
			$this->load->template('subject/add',$data);
		}
		else
		{

			$subject = array(
		        'name'           	  => 	$this->input->post('subject_name'),
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
			);

			if($this->db->insert('subject', $subject)){

				$this->session->set_flashdata('msg', 'Subject Successfully Added');
	        	redirect(base_url().'subject');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add Subject Please Try Again');
	        	redirect(base_url().'subject/add');

			}

		}
	}

	public function update()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('subject_name', 'Subject Name', 'callback_subject_unique_edit['.$this->input->post('id').']');
		$this->form_validation->set_rules('id', 'id', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Subject";
			$data['subject']	= $this->subject_model->subject_fr_id_chk($this->input->post('id'))[0];
			$this->load->template('subject/edit',$data);
		}
		else
		{

			$subject = array(
		        'name'           	  => 	$this->input->post('subject_name'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
			);
			$this->db->where('id',$this->input->post('id'));
			if($this->db->update('subject', $subject)){

				$this->session->set_flashdata('msg', 'Subject Successfully Save');
	        	redirect(base_url().'subject');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Subject Please Try Again');
	        	redirect(base_url().'subject');

			}

		}
	}




	public function subject_unique($subject){

		if($subject != ''){
			if(strlen($subject) > 200){
				$this->form_validation->set_message(__FUNCTION__ , 'Subject Name Not Allowed Greater Than 200 Characters');
	        	return false;
			}
			else{
				if($this->db->get_where('subject',['name' => $subject,'delete_flag' => '0'])->result_array()){
					$this->form_validation->set_message(__FUNCTION__ , 'Subject Name Already Exists');
		            return false;
				}
				else{
					return true;
				}
			}
		}
		else{
			$this->form_validation->set_message(__FUNCTION__ , 'Subject Name Is Required');
	        return false;
		}

	}


	public function subject_unique_edit($subject,$id){

		if($subject != ''){
			if(strlen($subject) > 200){
				$this->form_validation->set_message(__FUNCTION__ , 'Subject Name Not Allowed Greater Than 200 Characters');
	        	return false;
			}
			else{
				if($this->db->get_where('subject',['name' => $subject,'delete_flag' => '0','id !=' => $id])->result_array()){
					$this->form_validation->set_message(__FUNCTION__ , 'Subject Name Already Exists');
		            return false;
				}
				else{
					return true;
				}
			}
		}
		else{
			$this->form_validation->set_message(__FUNCTION__ , 'Subject Name Is Required');
	        return false;
		}

	}


}
?>