<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('all_model');
        $this->load->model('transaction_model');
        $this->load->model('partner_transact');
    }


	public function index()
	{	
		$this->load->model('users');
		$data['page_title']	= 'Manage Investors';
		$data['business'] = $this->users->_all_agents('business');
		$this->load->template('business/index',$data);
	}

	public function view($id = false)
	{

		if($id)
		{
			if($this->users->get_user_with_type($id,'business')[0])
			{
				$data['page_title']	= 'View Investor';
			    $data['user'] = $this->users->get_user($id)[0];
				$data['detail'] = $this->users->business_detail($id)[0];
				$data['business_id'] = $id;
				$data['business_trans'] = $this->all_model->get_transaction_business($id);
				$this->load->template('business/view',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Investor Not Found');
	        	redirect(base_url().'business');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Investor Not Found');
	        redirect(base_url().'business');
		}
	    
	}
	
	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Add Business Partner
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/


	public function add()
	{
	    $data['page_title']	= 'Add Investor';
		$this->load->template('business/register',$data);
	}

	
	public function save(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		/******************************************************
					Login Details Set Rules
		******************************************************/
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[30]|alpha_dash|is_unique[user.user_name]',array('is_unique' => 'Username Is Already Exists'));
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|required');
		$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[pass]');
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('percentage', 'Credit Percentage', 'trim|required|decimal');
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



		/*****************************************************
					Bank Details
		******************************************************/
		$this->form_validation->set_rules('bank', 'Bank Name', 'trim|required|min_length[3]|max_length[50]');
		
		$this->form_validation->set_rules('ac_number', 'A/C Number', 'trim|required|alpha_numeric|min_length[8]|max_length[20]');
		
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|alpha_numeric|required|min_length[5]|max_length[20]');

		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[5]|max_length[50]');



		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Add Investor';
			$this->load->template('business/register',$data);
		}
		else
		{
			$this->load->model('my_custom_func_model');
			

			$user_insert = array(
		        'user_type'           => 	'business',
				'user_type_id'        => 	$this->my_custom_func_model->get_user_type_id('business'),
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

				$busines_insert = array(
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
					'ifsc_code'		      =>	strtoupper($this->input->post('ifsc_code')),
					'branch_name'		  =>	$this->input->post('branch_name'),
					'persent'		  	  =>	$this->input->post('percentage'),
					'user_id'		      =>	$insert_id,
					'sex'		  	  =>	$this->input->post('sex')

				);
				if($this->db->insert('business_partners', $busines_insert))
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
								$this->session->set_flashdata('msg', 'Investor Successfully Added');
	        					redirect(base_url().'business');
							}
							else
							{
								$this->session->set_flashdata('error', 'Investor Successfully Added - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'business');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Investor Successfully Added - '.$this->upload->display_errors());
	        				redirect(base_url().'business');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Investor Successfully Added');
	        			redirect(base_url().'business');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Add Investor Try Again');
	        		redirect(base_url().'business/add');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Add Investor Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'business/add');
			}
		}
	
		


	}  //  Save Function

	//	Reference Id
	function RefId_Check($id){
			if( $a = $this->validate->RefId_Check($id) == true){
	            return true;
			}
			else{
				$this->form_validation->set_message(__FUNCTION__ , 'Please Enter Valid Reference Id');
	            return false;
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
		    $this->form_validation->set_message('date_valid', 'The Date field must be dd-mm-yyyy');
		    return false;
		  }


	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  							Edit Business Partner
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/ 
	public function edit($id = false){
		if($id)
		{
			if($this->users->get_user_with_type($id,'business')[0])
			{
				$data['page_title']	= 'Edit Investor';
				$data['user'] = $this->users->get_user($id)[0];
				$data['business'] = $this->users->business_detail($id)[0];
				$this->load->template('business/edit',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Investor Not Found');
	        	redirect(base_url().'business');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Investor Not Found');
	        redirect(base_url().'business');
		}
	}

	public function update(){
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
		$this->form_validation->set_rules('percentage', 'Credit Percentage', 'trim|required|decimal');
		$this->form_validation->set_rules('proof_type', 'Id Proof Type', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('proof_num', 'Id Proof Number', 'trim|required|min_length[5]|max_length[240]');
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
		
		$this->form_validation->set_rules('quali', 'Qualification', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('desig', 'Designation', 'trim|required|min_length[3]|max_length[50]');


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

		$this->form_validation->set_rules('bank', 'Bank Name', 'trim|required|min_length[3]|max_length[50]');
		
		$this->form_validation->set_rules('ac_number', 'A/C Number', 'trim|required|alpha_numeric|min_length[8]|max_length[20]');
		
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|alpha_numeric|required|min_length[5]|max_length[20]');

		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[5]|max_length[50]');


		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Investor';
			$data['user'] = $this->users->get_user($this->input->post('main_id'))[0];
			$data['business'] = $this->users->business_detail($this->input->post('main_id'))[0];
			$this->load->template('business/edit',$data);
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
					'persent'		  	  =>	$this->input->post('percentage'),
					'sex'		  	  =>	$this->input->post('sex')
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('business_partners', $agent_insert))
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
								$this->session->set_flashdata('msg', 'Investor Successfully Saved');
	        					redirect(base_url().'business');
							}
							else
							{
								$this->session->set_flashdata('error', 'Investor Successfully Saved - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'business');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Investor Successfully Saved - '.$this->upload->display_errors());
	        				redirect(base_url().'business');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Investor Successfully Saved');
	        			redirect(base_url().'business');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Investor Try Again');
	        		redirect(base_url().'business');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Investor Try Again');
	        	redirect(base_url().'business');
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
			if($this->users->get_user_with_type($id,'business')[0])
			{

				$this->db->where('id',$id);
				if($this->db->update('user',array('updated_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
				{
					$user = $this->auth->get_admin($id);

					if($user->image != 'user.png')
					{
						unlink('./uploads/'.$user->image);
					}
					
					$this->session->set_flashdata('msg', 'Investor Successfully Deleted');
	        		redirect(base_url().'business');
				}
				else{
					$this->session->set_flashdata('error', 'Investor Not Deleted Try Again');
	        		redirect(base_url().'business');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Investor Not Found');
	        	redirect(base_url().'business');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Investor Not Found');
	        redirect(base_url().'business');
		}
	}		
}
