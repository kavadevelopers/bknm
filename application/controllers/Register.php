<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  Register 
 */
	class Register extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('validate');
        	$this->load->model('users');
        	$this->load->model('binary_model');
		}

		public function index(){
			$this->load->view('register');
		}	

		public function save(){


			$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		/******************************************************
					Login Details Set Rules
		******************************************************/
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[30]|alpha_dash|is_unique[user.user_name]',array('is_unique' => 'Username Is Already Exists'));
		
		$this->form_validation->set_rules('ref', 'Reference Id','callback_RefId_Check');
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|required');
		$this->form_validation->set_rules('con_pass', 'Confirm Password', 'required|matches[pass]');
		

		$this->form_validation->set_rules('coust_id', 'Coustomer Id', 'min_length[5]|callback_Coustmer_id');


		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('gur_type', 'Select Gurdian Type', 'trim|required');
		$this->form_validation->set_rules('gur_name', 'Gurdian Name', 'trim|required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		//$this->form_validation->set_rules('fa_name', 'Father Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mo_name', 'Mother Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('jdate', 'Joining Date', 'trim|required|callback_date_valid');

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



		/*****************************************************
					Bank Details
		******************************************************/
		$this->form_validation->set_rules('bank', 'Bank Name', 'trim|required|min_length[3]|max_length[50]');
		
		$this->form_validation->set_rules('ac_number', 'A/C Number', 'trim|required|alpha_numeric|min_length[8]|max_length[20]');
		
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|alpha_numeric|min_length[5]|max_length[20]');

		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[5]|max_length[50]');



		
		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		else
		{ 
			$this->load->model('my_custom_func_model');
			$new_agent_id = $this->my_custom_func_model->get_user_type_id('agent');

			$user_insert = array(
		        'user_type'           => 	'agent',
				'user_type_id'        => 	$new_agent_id,
		        'user_name'           => 	strtolower($this->input->post('user_name')),
		        'pass'                => 	md5($this->input->post('pass')),
		        'email'               => 	$this->input->post('email'),
		        'mobile'              => 	$this->input->post('mobile'),
		        'reference_id'        => 	strtoupper($this->input->post('ref')),
		        'created_by'		  => 	$this->users->get_user_by_ref($this->input->post('ref'))['id'],
		        'updated_by'		  => 	$this->users->get_user_by_ref($this->input->post('ref'))['id'],
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('user', $user_insert)){

				$insert_id = $this->db->insert_id();

					if($this->binary_model->get_agent_leg($this->input->post('ref'))['last_leg'] == ''){
						$_leg = 'left';
					}
					else if($this->binary_model->get_agent_leg($this->input->post('ref'))['last_leg'] == 'left')
					{
						$_leg = 'right';
					}
					else
					{
						$_leg = 'left';
					}

				
					$binary = [
						'agent_id'        =>    $new_agent_id,	
						'parent'          =>    strtoupper($this->input->post('ref')),
				        'coustmer'		  => 	strtoupper($this->input->post('coust_id')),
						'leg'          	  =>    $_leg

					];	
					
					$this->db->insert('binary', $binary);

					$this->binary_model->update_parent_after_insert($new_agent_id,strtoupper($this->input->post('ref')),$_leg);
				
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
					'state'	              =>	$this->input->post('state'),
					'bank'		          =>	$this->input->post('bank'),
					'ac_number'		      =>	$this->input->post('ac_number'),
					'ifsc_code'		      =>	strtoupper($this->input->post('ifsc_code')),
					'branch_name'		  =>	$this->input->post('branch_name'),
					'user_id'		      =>	$insert_id,
					'sex'		  	  =>	$this->input->post('sex'),
					'gur_type'			  => 	$this->input->post('gur_type'),
					'gur_name'			  => 	$this->input->post('gur_name')

				);
				if($this->db->insert('agent_details', $agent_insert))
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
								$this->session->set_flashdata('msg', 'Registration Successful');
	        					redirect(base_url().'welcome');
							}
							else
							{
								$this->session->set_flashdata('error', 'Registration Successful - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'welcome');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Registration Successful - '.$this->upload->display_errors());
	        				redirect(base_url().'welcome');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Registration Successful');
	        			redirect(base_url().'welcome');
		        	}

					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Registration Try Again');
	        		redirect(base_url().'welcome');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Registration Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'welcome');
			}
		}
	
		


		}  //  Save Function

	
	//	Reference Id
	function RefId_Check($id){
			if($this->validate->Agennt_RefId_Check($id) == true){
	            return true;
			}
			else{
				$this->form_validation->set_message(__FUNCTION__ , 'Please Enter Valid Reference Id');
	            return false;
			}
	}

	function validate_leg($leg,$agent){
		if($leg != ''){
			if($this->validate->Agennt_RefId_Check($agent)){
	            
				if($leg == $this->users->leg($agent)['last_leg'])
				{
					$this->form_validation->set_message(__FUNCTION__ , 'Left Leg Is Full Please Select Right');
					return false;
				}
				else
				{

					return true;
				}
			}
			else{ 
					$this->form_validation->set_message(__FUNCTION__ , 'Please Enter Valid Reference Id.');
					return false; 
				}

		}
		else{ 
				$this->form_validation->set_message(__FUNCTION__ , 'Please Select Leg.');
				return false; 
			}

	
	}

	// Check Coustmer Id
	function Coustmer_id($id){
		if($id != ''){
			if($this->users->get_customer_id($id)){
	            return true;
			}
			else{
				$this->form_validation->set_message(__FUNCTION__ , 'Please Enter Valid Coustmer Id');
	            return false;
			}
		}
		else
		{
			return true;
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


					

		
	}

?>