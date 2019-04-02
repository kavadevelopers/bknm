<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subadmin extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('all_model');
        $this->load->model('dash_model');
        $this->load->model('add_product');
        $this->load->model('payment_model');
        $this->load->model('user_genaral');


    }


	public function index()
	{
		$this->load->model('users');
		$data['page_title']	= 'Manage SubAdmins';
		$data['subadmin'] = $this->users->all_agents('subadmin');
		$this->load->template('subadmin/index',$data);
	}

	function add()
	{
	    $data['page_title']	= 'Add SubAdmin';
		$this->load->template('subadmin/register',$data);
	}

	public function view($id = false)
	{

		if($id)
		{
			if($this->users->get_user_with_type($id,'subadmin')[0])
			{
				$data['page_title']	= 'View Sub Admin';
			    $data['user'] = $this->users->get_user($id)[0];
			    $data['admin'] = $id;
				$data['detail'] = $this->users->subadmin_detail($id)[0];
				$data['data'] = $this->payment_model->get_sell_payments_byid($id);
				$this->load->template('subadmin/view',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Admins Not Found');
	        	redirect(base_url().'subadmin');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Admins Not Found');
	        redirect(base_url().'subadmin');
		}
	    
	}

	public function save(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		/******************************************************
					Login Details Set Rules
		******************************************************/
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[30]|alpha_dash|is_unique[user.user_name]',array('is_unique' => 'Username Is Already Exists'));
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|required');
		$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[pass]');

		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('middle_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');

		/*****************************************************
					Contact information
		******************************************************/
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('mobile2', 'Mobile Number2', 'regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[12]');

		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[10]|max_length[500]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('zip', 'Zip code', 'trim|required|min_length[4]|max_length[10]');
		$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[2]|max_length[50]');
		

		//	Start User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Add Subadmin';
			$this->load->template('subadmin/register',$data);
		}
		else
		{
			$this->load->model('my_custom_func_model');
			

			$user_insert = array(
		        'user_type'           => 	'subadmin',
				'user_type_id'        => 	$this->my_custom_func_model->get_user_type_id('subadmin'),
		        'user_name'           => 	strtolower($this->input->post('user_name')),
		        'pass'                => 	md5($this->input->post('pass')),
		        'email'               => 	$this->input->post('email'),
		        'mobile'              => 	$this->input->post('mobile'),
		        'reference_id'        => 	$this->session->userdata('id'),
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('user', $user_insert)){

				$insert_id = $this->db->insert_id();

				$subadmin_insert = array(
					'first_name'    	  => 	$this->input->post('first_name'),
					'middle_name'         => 	$this->input->post('middle_name'),
					'last_name'			  => 	$this->input->post('last_name'),
					'email'		          =>	$this->input->post('email'),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'zip'		          =>	$this->input->post('zip'),
					'state'	              =>	$this->input->post('state'),
					'user_id'		      =>	$insert_id,
					'sex'		  	  =>	$this->input->post('sex')

				);

				if($this->db->insert('subadmin_details', $subadmin_insert))
				{

					if(!empty($_FILES['my_image']['name']))
					{
						$path = $_FILES['my_image']['name'];
						$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
						$config['upload_path']		= './uploads/';
						$config['allowed_types']	= 'gif|jpg|png|jpeg';
						$config['max_size']			= 1000000;
						
						
						$config['file_name'] = $newName;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('my_image'))
						{
							
							
							$subadmin_insert = array(
								'image'    	  => 	$newName
							);

							
							$this->db->where('id', $insert_id);
							if($this->db->update('user', $subadmin_insert))
							{
								$this->session->set_flashdata('msg', 'Subadmin Successfully Added');
	        					redirect(base_url().'subadmin');
							}
							else
							{
								$this->session->set_flashdata('error', 'Subadmin Successfully Added - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'subadmin');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Subadmin Successfully Added - '.$this->upload->display_errors());
	        				redirect(base_url().'subadmin');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Subadmin Successfully Added');
	        			redirect(base_url().'subadmin');
		        	}

					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Add Subadmin Try Again');
	        		redirect(base_url().'subadmin/add');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Add Subadmin Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'subadmin/add');
			}
		}
	
		
	}  // End  Save Function

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  							START Edit Subadmin
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function edit($id = false)
	{	
		if($id)
		{
			if($this->users->get_user_with_type($id,'subadmin')[0])
			{
				$data['page_title']	= 'Edit Subadmin';
				$data['user'] = $this->users->get_user($id)[0];
				$data['subadmin'] = $this->users->subadmin_detail($id)[0];
				$this->load->template('subadmin/edit',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Subadmin Not Found');
	        	redirect(base_url().'subadmin');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Subadmin Not Found');
	        redirect(base_url().'subadmin');
		}
	    
	}	

	public function update(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		
		/******************************************************
					Login Details Set Rules
		******************************************************/
		$this->form_validation->set_rules('user_name', 'Username', 'trim');
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|required');
		$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[pass]');
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('middle_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		

		/*****************************************************
					Contact information
		******************************************************/
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('mobile2', 'Mobile Number2', 'regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[12]');

		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[10]|max_length[500]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('zip', 'Zip code', 'trim|required|min_length[4]|max_length[10]');
		$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[2]|max_length[50]');

		
		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Subadmin';
			$data['user'] = $this->users->get_user($this->input->post('main_id'))[0];
			$data['subadmin'] = $this->users->subadmin_detail($this->input->post('main_id'))[0];
			$this->load->template('subadmin/edit',$data);
		}
		else
		{
			

			$user_insert = array(
		        'email'               => 	$this->input->post('email'),
		        'mobile'              => 	$this->input->post('mobile'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
			);
				$this->db->where('id', $this->input->post('main_id'));
			if($this->db->update('user', $user_insert)){

				

				$subadmin_insert = array(
					'first_name'    		  => 	$this->input->post('first_name'),
					'middle_name'         	  => 	$this->input->post('middle_name'),
					'last_name'			  => 	$this->input->post('last_name'),
					'email'		          =>	$this->input->post('email'),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'zip'		          =>	$this->input->post('zip'),
					'state'	              =>	$this->input->post('state'),
					'sex'		  	  =>	$this->input->post('sex')
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('subadmin_details', $subadmin_insert))
				{
					if(!empty($_FILES['my_image']['name']))
					{
						
						$path = $_FILES['my_image']['name'];
						$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
						$config['upload_path']		= './uploads/';
						$config['allowed_types']	= 'gif|jpg|png|jpeg';
						$config['max_size']			= 1000000;
						
						$config['file_name'] = $newName;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('my_image'))
						{
							
    						$user = $this->auth->get_admin($this->input->post('main_id'));

    						if($user->image != 'user.png')
    						{
    							unlink('./uploads/'.$user->image);
    						}

							$subadmin_insert = array(
								'image'    	  => 	$newName
							);

							
							$this->db->where('id', $this->input->post('main_id'));
							if($this->db->update('user', $subadmin_insert))
							{
								$this->session->set_flashdata('msg', 'Subadmin Successfully Saved');
	        					redirect(base_url().'subadmin');
							}
							else
							{
								$this->session->set_flashdata('error', 'Subadmin Successfully Saved - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'subadmin');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Subadmin Successfully Saved - '.$this->upload->display_errors());
	        				redirect(base_url().'subadmin');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Subadmin Successfully Saved');
	        			redirect(base_url().'subadmin');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Subadmin Try Again');
	        		redirect(base_url().'subadmin');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Subadmin Try Again');
	        	redirect(base_url().'subadmin');
			}
		}
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								DELETE AGENT 
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/  

	
	public function delete($id = false)
	{	
		if($id)
		{
			if($this->users->get_user_with_type($id,'subadmin')[0])
			{

				$this->db->where('id',$id);
				if($this->db->update('user',array('updated_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
				{

					$user = $this->auth->get_admin($id);

					if($user->image != 'user.png')
					{
						unlink('./uploads/'.$user->image);
					}

					$this->session->set_flashdata('msg', 'Subadmin Successfully Deleted');
	        		redirect(base_url().'subadmin');
				}
				else{
					$this->session->set_flashdata('error', 'Subadmin Not Deleted Try Again');
	        		redirect(base_url().'subadmin');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Subadmin Not Found');
	        	redirect(base_url().'subadmin');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Subadmin Not Found');
	        redirect(base_url().'subadmin');
		}
	}		


}
