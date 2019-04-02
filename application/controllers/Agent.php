<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('binary_model');
        $this->load->model('all_model');
        $this->load->model('dash_model');
        $this->load->model('add_product');
    }


	public function index()
	{
		$this->load->model('users');
		$data['page_title']	= 'Manage Agents';
		$data['agents'] = $this->users->all_agents('agent');
		$this->load->template('agent/index',$data);
	}

	public function view($id = false)
	{

		if($id)
		{
			if($this->users->get_user_with_type($id,'agent')[0])
			{
				$data['page_title']	= 'View Agent';
			    $data['user'] = $this->users->get_user($id)[0];
				$data['detail'] = $this->users->agent_detail($id)[0];
				$data['agent_id'] = $id;

				$data['total_reffered'] = $this->dash_model->total_reffered($data['user']['user_type_id']);
				$data['monthly_reffered'] = $this->dash_model->monthly_reffered($data['user']['user_type_id']);
				$data['total_sale'] = $this->dash_model->total_sale($id);
				$data['monthly_sale'] = $this->dash_model->monthly_sale($id);
				$data['total_direct_income'] = $this->dash_model->total_direct_income($id);
				$data['monthly_direct_income'] = $this->dash_model->monthly_direct_income($id);
				$data['total_indirect_income'] = $this->dash_model->total_indirect_income($id);
				$data['monthly_indirect_income'] = $this->dash_model->monthly_indirect_income($id);
				$data['total_bonus_income'] = $this->dash_model->total_bonus_income($id);
				$data['monthly_bonus_income'] = $this->dash_model->monthly_bonus_income($id);
				$data['total_promotion_income'] = $this->dash_model->total_promotion_income($id);
				$data['monthly_promotion_income'] = $this->dash_model->monthly_promotion_income($id);

				$this->load->template('agent/view',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Agent Not Found');
	        	redirect(base_url().'agent');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Agent Not Found');
	        redirect(base_url().'agent');
		}
	    
	}

	
	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Add Agent
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/


	public function add()
	{	
	    $data['page_title']	= 'Add Agent';
		$this->load->template('agent/register',$data);
	}

	
	public function save(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		/******************************************************
					Login Details Set Rules
		******************************************************/
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[30]|alpha_dash|is_unique[user.user_name]',array('is_unique' => 'Username Is Already Exists'));
		
		$this->form_validation->set_rules('ref', 'Reference Id','callback_RefId_Check');
		$this->form_validation->set_rules('leg', 'Leg','callback_validate_leg['.$this->input->post('ref').']');
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
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');


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
			$data['page_title']	= 'Add Agent';

			$this->load->template('agent/register',$data);
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
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('user', $user_insert)){

				$insert_id = $this->db->insert_id();

				
					$binary = [
						'agent_id'        =>    $new_agent_id,	
						'parent'          =>    strtoupper($this->input->post('ref')),
				        'coustmer'		  => 	strtoupper($this->input->post('coust_id')),
						'leg'          	  =>    $this->input->post('leg')

					];	
					
					$this->db->insert('binary', $binary);

					$this->binary_model->update_parent_after_insert($new_agent_id,strtoupper($this->input->post('ref')),$this->input->post('leg'));
				
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
								$this->session->set_flashdata('msg', 'Agent Successfully Added');
	        					redirect(base_url().'agent');
							}
							else
							{
								$this->session->set_flashdata('error', 'Agent Successfully Added - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'agent');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Agent Successfully Added - '.$this->upload->display_errors());
	        				redirect(base_url().'agent');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Agent Successfully Added');
	        			redirect(base_url().'agent');
		        	}

					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Add Agent Try Again');
	        		redirect(base_url().'agent/add');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Add Agent Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'agent/add');
			}
		}
	
		


	}  //  Save Function

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
		  								START AGENT EDIT
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/  

	
	public function edit($id = false)
	{	
		if($id)
		{
			if($this->users->get_agent($id))
			{
				$data['page_title']	= 'Edit Agent';
				$data['user'] = $this->users->get_user($id)[0];
				$data['agent'] = $this->users->agent_detail($id)[0];
				//$data['leg'] = $this->users->leg($data['user']['reference_id']);
				$data['coustmer_id'] = $this->users->leg($data['user']['user_type_id'])['coustmer'];
				$this->load->template('agent/edit',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Agent Not Found');
	        	redirect(base_url().'agent');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Agent Not Found');
	        redirect(base_url().'agent');
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
		//$this->form_validation->set_rules('fa_name', 'Father Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mo_name', 'Mother Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('bdate', 'Birth Date', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('jdate', 'Joining Date', 'trim|required|callback_date_valid');

		$this->form_validation->set_rules('proof_type', 'Id Proof Type', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('proof_num', 'Id Proof Number', 'trim|required|min_length[5]|max_length[240]');

		$this->form_validation->set_rules('gur_type', 'Select Gurdian Type', 'trim|required');
		$this->form_validation->set_rules('gur_name', 'Gurdian Name', 'trim|required|min_length[2]|max_length[250]');
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

		$this->form_validation->set_rules('bank', 'Bank Name', 'trim|required|min_length[3]|max_length[50]');
		
		$this->form_validation->set_rules('ac_number', 'A/C Number', 'trim|required|alpha_numeric|min_length[8]|max_length[20]');
		
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|alpha_numeric|min_length[5]|max_length[20]');

		$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|min_length[5]|max_length[50]');

		
		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Agent';
			$data['user'] = $this->users->get_user($this->input->post('main_id'))[0];
			$data['agent'] = $this->users->agent_detail($this->input->post('main_id'))[0];
			$this->load->template('agent/edit',$data);
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

					'proof_type'		  =>	$this->input->post('proof_type'),
					'proof_num'		      =>	strtoupper($this->input->post('proof_num')),
					
					'year'		          =>	$this->input->post('year'),
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
					'sex'		  	  =>	$this->input->post('sex'),
					'gur_type'			  => 	$this->input->post('gur_type'),
					'gur_name'			  => 	$this->input->post('gur_name')
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('agent_details', $agent_insert))
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
								$this->session->set_flashdata('msg', 'Agent Successfully Saved');
	        					redirect(base_url().'agent');
							}
							else
							{
								$this->session->set_flashdata('error', 'Agent Successfully Saved - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'agent');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Agent Successfully Saved - '.$this->upload->display_errors());
	        				redirect(base_url().'agent');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Agent Successfully Saved');
	        			redirect(base_url().'agent');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Agent Try Again');
	        		redirect(base_url().'agent');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Agent Try Again');
	        	redirect(base_url().'agent');
			}
		}
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								START ACTIVE / DEACTIVE
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/  



	public function active($id){

		$update = ['active' => 1];

		$this->db->where('agent_id', $id);
		if($this->db->update('binary', $update)){
			
			$this->session->set_flashdata('msg', 'Agent Successfully Deactivated');
        	redirect(base_url().'agent');
		}
	}

	public function deactive($agent_id){

		$update = ['active' => 0];
		
		$this->db->where('agent_id', $agent_id);
		if($this->db->update('binary', $update)){
			
			$this->session->set_flashdata('msg', 'Agent Successfully Activated');
        	redirect(base_url().'agent');

		}
	}





	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								DELETE AGENT 
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/  

	
	public function delete($id = false)
	{	
		if($id)
		{
			if($this->users->get_user_with_type($id,'agent')[0])
			{

				$this->db->where('id',$id);
				if($this->db->update('user',array('updated_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
				{

					$user = $this->auth->get_admin($id);

					if($user->image != 'user.png')
					{
						unlink('./uploads/'.$user->image);
					}

					$this->session->set_flashdata('msg', 'Agent Successfully Deleted');
	        		redirect(base_url().'agent');
				}
				else{
					$this->session->set_flashdata('error', 'Agent Not Deleted Try Again');
	        		redirect(base_url().'agent');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Agent Not Found');
	        	redirect(base_url().'agent');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Agent Not Found');
	        redirect(base_url().'agent');
		}
	}		



}