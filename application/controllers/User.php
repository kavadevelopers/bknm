<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('user_model');
        $this->load->model('general_model');
    }


	public function index()
	{	
		$data['_title']		= "Manage User";
		$data['users']		= $this->user_model->users();
		$this->load->template('user/index',$data);
	}

	public function add()
	{
		$data['_title']				= "Add User";
		$data['finicial_years']		= $this->general_model->get_all_finincial_year();
		$this->load->template('user/add',$data);	
	}

	public function edit($user_id = false)
	{
		if($user_id){
			if($this->user_model->user_from_id($user_id)){
				$data['_title']		= "Edit User";
				$data['user']		= $this->user_model->user_from_id($user_id)[0];
				$data['finicial_years']		= $this->general_model->get_all_finincial_year();
 				$this->load->template('user/edit',$data);
			}
			else{
				$this->session->set_flashdata('error', 'User Not Found Try Again');
		        redirect(base_url().'user');
			}
		}else{
			$this->session->set_flashdata('error', 'User Not Found Try Again');
	        redirect(base_url().'user');
		}
	}

	public function delete($user_id = false)
	{
		if($user_id){
			if($this->user_model->user_from_id($user_id)){

				$this->db->where('id',$user_id);
				$this->db->update('user', ['delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s')]);

				$this->session->set_flashdata('msg', 'User Successfully Deleted');
	        	redirect(base_url().'user');

			}
			else{
				$this->session->set_flashdata('error', 'User Not Found Try Again');
		        redirect(base_url().'user');
			}
		}else{
			$this->session->set_flashdata('error', 'User Not Found Try Again');
	        redirect(base_url().'user');
		}
	}

	public function reset_pass($user_id = false)
	{
		if($user_id){
			if($this->user_model->user_from_id($user_id)){
				
				$data['_title']		= "Reset Password";
				$data['user']		= $this->user_model->user_from_id($user_id)[0];
 				$this->load->template('user/reset_pass',$data);

			}
			else{
				$this->session->set_flashdata('error', 'User Not Found Try Again');
		        redirect(base_url().'user');
			}
		}else{
			$this->session->set_flashdata('error', 'User Not Found Try Again');
	        redirect(base_url().'user');
		}
	}


	public function save()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[30]|alpha_dash|is_unique[user.user_name]',array('is_unique' => 'Username Is Already Exists'));
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[5]|max_length[200]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]|is_unique[user.mobile]',array('is_unique' => 'Mobile No Is Already Exists'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|max_length[20]|required');
		$this->form_validation->set_rules('con_pass', 'Confirm Password', 'required|matches[pass]');
		$this->form_validation->set_rules('f_year[]', 'Check box', 'required',array('required' => 'Please Select At least One Finincial Year'));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add User";
			$data['finicial_years']		= $this->general_model->get_all_finincial_year();
			$this->load->template('user/add',$data);
		}
		else
		{
			$f_year = '';
			foreach ($this->input->post('f_year') as $key => $value) {
				$f_year .= $value.',';
			}
			$f_year = rtrim($f_year,',');

			$user_insert = array(
		        'user_type'           => 	'user',
		        'user_name'           => 	strtolower($this->input->post('user_name')),
		        'name'		          => 	$this->input->post('name'),
		        'pass'                => 	md5($this->input->post('pass')),
		        'email'               => 	$this->input->post('email'),
		        'mobile'              => 	$this->input->post('mobile'),
		        'year'	              => 	$f_year,
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('user', $user_insert)){

				$this->session->set_flashdata('msg', 'User Successfully Added');
	        	redirect(base_url().'user');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add User Please Try Again');
	        	redirect(base_url().'user/add');

			}

		}
	}

	public function update()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[5]|max_length[200]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]|callback_mobile_unique['.$this->input->post('user_id').']');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[100]|callback_email_unique['.$this->input->post('user_id').']');
		$this->form_validation->set_rules('user_id', 'user_id', 'trim');
		$this->form_validation->set_rules('f_year[]', 'Check box', 'required',array('required' => 'Please Select At least One Finincial Year'));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']				= "Edit User";
			$data['finicial_years']		= $this->general_model->get_all_finincial_year();
			$data['user']				= $this->user_model->user_from_id($this->input->post('user_id'))[0];
			$this->load->template('user/edit',$data);
		}
		else
		{

			$f_year = '';
			foreach ($this->input->post('f_year') as $key => $value) {
				$f_year .= $value.',';
			}
			$f_year = rtrim($f_year,',');
			
			$user_insert = array(
		        'name'		          => 	$this->input->post('name'),
		        'email'               => 	$this->input->post('email'),
		        'year'	              => 	$f_year,
		        'mobile'              => 	$this->input->post('mobile'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);


			$this->db->where('id',$this->input->post('user_id'));
			if($this->db->update('user', $user_insert)){

				$this->session->set_flashdata('msg', 'User Successfully Save');
	        	redirect(base_url().'user');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Edit User Please Try Again');
	        	redirect(base_url().'user');

			}

		}
	}


	public function pass_save()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|max_length[20]|required');
		$this->form_validation->set_rules('con_pass', 'Confirm Password', 'required|matches[pass]');
		
		$this->form_validation->set_rules('user_id', 'user_id', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Reset Password";
			$data['user']		= $this->user_model->user_from_id($this->input->post('user_id'))[0];
			$this->load->template('user/edit',$data);
		}
		else
		{

			$user_insert = array(
		        'pass'                => 	md5($this->input->post('pass')),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);


			$this->db->where('id',$this->input->post('user_id'));
			if($this->db->update('user', $user_insert)){

				$this->session->set_flashdata('msg', 'Password Successfully Save');
	        	redirect(base_url().'user');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Reset Password Please Try Again');
	        	redirect(base_url().'user');

			}

		}
	}


	



	public function mobile_unique($mobile,$id){

		if($this->user_model->user_from_mobile_id($mobile,$id)){
			$this->form_validation->set_message(__FUNCTION__ , 'Mobile Already Exists');
            return false;
		}
		else{
			return true;
		}

	}

	public function email_unique($email,$id){

		if($this->user_model->user_from_email_id($email,$id)){
			$this->form_validation->set_message(__FUNCTION__ , 'Email Already Exists');
            return false;
		}
		else{
			return true;
		}

	}





	

}
