<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('users');
    }


	public function index()
	{
		$data['page_title']	= 'My Profile';
		$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];


		if($this->session->userdata('user_type') == 'agent')
		{
			$data['detail'] = $this->users->agent_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/agent',$data);
		}
		else if($this->session->userdata('user_type') == 'subadmin')
		{
			$data['detail'] = $this->users->subadmin_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/admin',$data);
		}
		else if($this->session->userdata('user_type') == 'business')
		{
			$data['detail'] = $this->users->business_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/business',$data);
		}
		else if($this->session->userdata('user_type') == 'customer')
		{
			$data['detail'] = $this->users->customer_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/customer',$data);
		}
		else
		{
			$data['detail'] = $this->users->subadmin_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/admin',$data);
		}


	}

	// public function edit()
	// {
	// 	$data['page_title']	= 'Edit Profile';
	// 	$this->load->template('profile/index',$data);
	// }

	public function admin()
	{
		$data['page_title']	= 'Edit Profile';
		$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
		$data['subadmin'] = $this->users->subadmin_detail($this->session->userdata('id'))[0];
		$this->load->template('profile/edit_admin',$data);
	}

	public function admin_update(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		
		

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

		
		
		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Profile';
			$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
			$data['subadmin'] = $this->users->subadmin_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/edit_admin',$data);
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
					'sex'		  	  =>	$this->input->post('sex')
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('subadmin_details', $subadmin_insert))
				{
					if(!empty($_FILES['my_image']['name'])){
						$path = $_FILES['my_image']['name'];
						$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
						$config['upload_path']		= './uploads/';
						$config['allowed_types']	= 'gif|jpg|png|jpeg';
						$config['max_size']			= 1000000;
						
						
						$config['file_name'] = $newName;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('my_image'))
						{
							$user  = $this->session->userdata('id');
    						$user = $this->auth->get_admin($user);

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
								$this->session->set_flashdata('msg', 'Profile Successfully Saved');
		        				redirect(base_url().'profile');
							}
							else
							{
								$this->session->set_flashdata('error', 'Problem In Upload Image');
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'profile/admin');
							}
						}
						else
						{
							$this->session->set_flashdata('error', $this->upload->display_errors());
	        				redirect(base_url().'profile/admin');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Profile Successfully Saved');
		        		redirect(base_url().'profile');
		        	}
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        		redirect(base_url().'profile/admin');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        	redirect(base_url().'profile/admin');
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function agent()
	{
		$data['page_title']	= 'Edit Profile';
		$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
		$data['agent'] = $this->users->agent_detail($this->session->userdata('id'))[0];
		$this->load->template('profile/edit_agent',$data);
	}

	public function agent_update(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		
		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('fa_name', 'Father Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mo_name', 'Mother Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('jdate', 'Joining Date', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('quali', 'Qualification', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('desig', 'Designation', 'trim|required|min_length[3]|max_length[50]');

		$this->form_validation->set_rules('proof_type', 'Id Proof Type', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('proof_num', 'Id Proof Number', 'trim|required|min_length[5]|max_length[240]');

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
		$this->form_validation->set_rules('year', 'Year', 'trim');
		$this->form_validation->set_rules('jdate', 'Jdate', 'trim');

		
		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			
			$data['page_title']	= 'Edit Profile';
			$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
			$data['agent'] = $this->users->agent_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/edit_agent',$data);
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

				

				$agent_insert = array(
					'fi_name'    		  => 	$this->input->post('fi_name'),
					'mi_name'         	  => 	$this->input->post('mi_name'),
					'la_name'			  => 	$this->input->post('la_name'),
					'fa_name'	 	      => 	$this->input->post('fa_name'),
					'mo_name'		      =>	$this->input->post('mo_name'),
					'bdate'		          =>	date('Y-m-d',strtotime($this->input->post('bdate'))),
					'jdate'		          =>	date('Y-m-d',strtotime($this->input->post('jdate'))),
					'year'		          =>	$this->input->post('year'),

					'proof_type'		  =>	$this->input->post('proof_type'),
					'proof_num'		      =>	strtoupper($this->input->post('proof_num')),

					'quali'		          =>	$this->input->post('quali'),
					'desig'		          =>	$this->input->post('desig'),
					'email'		          =>	$this->input->post('email'),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'zip'		          =>	$this->input->post('zip'),
					'state'	              =>	$this->input->post('state')
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('agent_details', $agent_insert))
				{


					if(!empty($_FILES['my_image']['name'])){
						$path = $_FILES['my_image']['name'];
						$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
						$config['upload_path']		= './uploads/';
						$config['allowed_types']	= 'gif|jpg|png|jpeg';
						$config['max_size']			= 1000000;
						
						
						$config['file_name'] = $newName;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('my_image'))
						{
							$user  = $this->session->userdata('id');
    						$user = $this->auth->get_admin($user);

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
								$this->session->set_flashdata('msg', 'Profile Successfully Saved');
	        					redirect(base_url().'profile');
							}
							else
							{
								$this->session->set_flashdata('error', 'Problem In Upload Image');
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'profile/agent');
							}
						}
						else
						{
							$this->session->set_flashdata('error', $this->upload->display_errors());
	        				redirect(base_url().'profile/agent');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Profile Successfully Saved');
	        			redirect(base_url().'profile');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        		redirect(base_url().'profile/agent');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        	redirect(base_url().'profile/agent');
			}
		}
	}

	public function date_valid($date)
		  {
		    $parts = explode("-", $date);
		    if (count($parts) == 3) {      
		      if (checkdate($parts[1], $parts[0], $parts[2]))
		      {
		        return TRUE;
		      }
		    }
		    $this->form_validation->set_message('date_valid', 'The Date field must be mm/dd/yyyy');
		    return false;
		  }

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
										Business Partner
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function business()
	{
		$data['page_title']	= 'Edit Profile';
		$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
		$data['business'] = $this->users->business_detail($this->session->userdata('id'))[0];
		$this->load->template('profile/edit_business',$data);
	}		  

	public function business_update(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		

		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('fa_name', 'Father Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mo_name', 'Mother Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('jdate', 'Joining Date', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('age', 'Age', 'trim');
		
		$this->form_validation->set_rules('proof_type', 'Id Proof Type', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('proof_num', 'Id Proof Number', 'trim|required|min_length[5]|max_length[240]');
		

		$this->form_validation->set_rules('quali', 'Qualification', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('desig', 'Designation', 'trim|required|min_length[3]|max_length[50]');
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
		$this->form_validation->set_rules('year', 'Year', 'trim');
		$this->form_validation->set_rules('jdate', 'Jdate', 'trim');


		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Profile';
			$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
			$data['business'] = $this->users->business_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/edit_business',$data);
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

				

				$agent_insert = array(
					'fi_name'    		  => 	$this->input->post('fi_name'),
					'mi_name'         	  => 	$this->input->post('mi_name'),
					'la_name'			  => 	$this->input->post('la_name'),
					'fa_name'	 	      => 	$this->input->post('fa_name'),
					'mo_name'		      =>	$this->input->post('mo_name'),
					'bdate'		          =>	date('Y-m-d',strtotime($this->input->post('bdate'))),
					'jdate'		          =>	date('Y-m-d',strtotime($this->input->post('jdate'))),
					'age'		          =>	$this->input->post('age'),

					'proof_type'		  =>	$this->input->post('proof_type'),
					'proof_num'		      =>	strtoupper($this->input->post('proof_num')),
					
					'quali'		          =>	$this->input->post('quali'),
					'desig'		          =>	$this->input->post('desig'),
					'email'		          =>	$this->input->post('email'),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'zip'		          =>	$this->input->post('zip'),
					'state'	              =>	$this->input->post('state'),
					'bank'		          =>	$this->input->post('bank'),
					'ac_number'		      =>	$this->input->post('ac_number'),
					'ifsc_code'		      =>	$this->input->post('ifsc_code'),
					'branch_name'		  =>	$this->input->post('branch_name'),
					'sex'		  	  =>	$this->input->post('sex')
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('business_partners', $agent_insert))
				{
					if(!empty($_FILES['my_image']['name'])){
						$path = $_FILES['my_image']['name'];
						$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
						$config['upload_path']		= './uploads/';
						$config['allowed_types']	= 'gif|jpg|png|jpeg';
						$config['max_size']			= 1000000;
						
						
						$config['file_name'] = $newName;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('my_image'))
						{
							$user  = $this->session->userdata('id');
    						$user = $this->auth->get_admin($user);

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
								$this->session->set_flashdata('msg', 'Profile Successfully Saved');
	        					redirect(base_url().'profile');
							}
							else
							{
								$this->session->set_flashdata('error', 'Problem In Upload Image');
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'profile/business');
							}
						}
						else
						{
							$this->session->set_flashdata('error', $this->upload->display_errors());
	        				redirect(base_url().'profile/business');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Profile Successfully Saved');
	        			redirect(base_url().'profile');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        		redirect(base_url().'profile/business');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        	redirect(base_url().'profile/business');
			}
		}
	}


	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
										Customer
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function customer()
	{
		$data['page_title']	= 'Edit Profile';
		$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
		$data['customer'] = $this->users->customer_detail($this->session->userdata('id'))[0];
		$this->load->template('profile/edit_customer',$data);
	}		  


	public function update_customer(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		

		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		
		$this->form_validation->set_rules('bdate', 'Date of Birth', 'trim|required|callback_date_valid');
		
		/*****************************************************
					Contact information
		******************************************************/
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('mobile2', 'Mobile Number2', 'regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[12]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[10]|max_length[500]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|min_length[4]|max_length[10]');
		$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[2]|max_length[50]');
		
		/*****************************************************
					Nominee’s Details
		******************************************************/
		
		$this->form_validation->set_rules('no_fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('no_mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('no_la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('no_bdate', 'Date of Birth', 'trim|required|callback_date_valid');
		
		$this->form_validation->set_rules('relation', 'Relationship with customer ', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('no_address', 'Address ', 'trim|required|min_length[2]|max_length[500]');


		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Profile';
			$data['user'] = $this->users->get_user($this->session->userdata('id'))[0];
			$data['customer'] = $this->users->customer_detail($this->session->userdata('id'))[0];
			$this->load->template('profile/edit_customer',$data);
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

				

				$customer_insert = array(
					'fi_name'    		  => 	$this->input->post('fi_name'),
					'mi_name'         	  => 	$this->input->post('mi_name'),
					'la_name'			  => 	$this->input->post('la_name'),
					'bdate'		          =>	date('Y-m-d',strtotime($this->input->post('bdate'))),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'pin_code'		      =>	$this->input->post('pin_code'),
					'state'	              =>	$this->input->post('state'),
					'no_fi_name'	      =>	$this->input->post('no_fi_name'),
					'no_mi_name'	      =>	$this->input->post('no_mi_name'),
					'no_la_name'  		  =>	$this->input->post('no_la_name'),
					'no_bdate'	          =>	date('Y-m-d',strtotime($this->input->post('no_bdate'))),
					'relation'	          =>	$this->input->post('relation'),
					'no_address'	      =>	$this->input->post('no_address')
					
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('customer_detail', $customer_insert))
				{

					if(!empty($_FILES['my_image']['name'])){
						$path = $_FILES['my_image']['name'];
						$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
						$config['upload_path']		= './uploads/';
						$config['allowed_types']	= 'gif|jpg|png|jpeg';
						$config['max_size']			= 1000000;
						
						
						$config['file_name'] = $newName;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('my_image'))
						{
							$user  = $this->session->userdata('id');
    						$user = $this->auth->get_admin($user);

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
								$this->session->set_flashdata('msg', 'Profile Successfully Saved');
	        					redirect(base_url().'profile');
							}
							else
							{
								$this->session->set_flashdata('error', 'Problem In Upload Image');
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'profile/customer');
							}
						}
						else
						{
							$this->session->set_flashdata('error', $this->upload->display_errors());
	        				redirect(base_url().'profile/customer');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Profile Successfully Saved');
	        			redirect(base_url().'profile');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        		redirect(base_url().'profile/customer');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Profile Try Again');
	        	redirect(base_url().'profile/customer');
			}
		}
	}


}
