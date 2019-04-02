<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('user_genaral');
        $this->load->model('add_product');
        $this->load->model('sel_product');
    }


	public function index()
	{	
		$this->load->model('users');
		$data['page_title']	= 'Manage Customer';
		$data['customer'] = $this->user_genaral->users('customer');
		$this->load->template('customer/index',$data);
	}

	public function view($id = false)
	{

		if($id)
		{
			if($this->users->get_user_with_type($id,'customer')[0])
			{
				$data['page_title']	= 'View Coustmer';
			    $data['user'] = $this->users->get_user($id)[0];
				$data['detail'] = $this->users->customer_detail($id)[0];
				$this->load->template('customer/view',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Coustmer Not Found');
	        	redirect(base_url().'customer');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Coustmer Not Found');
	        redirect(base_url().'customer');
		}
	    
	}
	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Coustmer Add
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	function add()
	{
	    $data['page_title']	= 'Add Customer';
	    $data['get_product_all'] = $this->add_product->get_product_all_sales('product');
	    $data['get_plan_code'] = $this->setting_model->get_plan_code();
		$this->load->template('customer/register',$data);
	}

	public function save(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		/******************************************************
					Login Details Set Rules
		******************************************************/
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[5]|max_length[30]|alpha_dash|is_unique[user.user_name]',array('is_unique' => 'Username Is Already Exists'));
		$this->form_validation->set_rules('pass', 'Password', 'min_length[5]|required');
		$this->form_validation->set_rules('c_pass', 'Confirm Password', 'required|matches[pass]');
		$this->form_validation->set_rules('agent_id', 'Agent Id','callback_Agent_id');
		$this->form_validation->set_rules('year', 'Year', 'trim');
		$this->form_validation->set_rules('nyear', 'Year', 'trim');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');
		$this->form_validation->set_rules('booking', 'booking', 'trim');
		$this->form_validation->set_rules('plan_code', 'plan_code', 'trim');
		/*****************************************************
					Personal Information Set Rules
		******************************************************/
		$this->form_validation->set_rules('fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		
		$this->form_validation->set_rules('bdate', 'Date of Birth', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('gur_type', 'Select Gurdian Type', 'trim|required');
		$this->form_validation->set_rules('gur_name', 'Gurdian Name', 'trim|required|min_length[2]|max_length[250]');


		
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
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
		/*****************************************************
					Nominee’s Details
		******************************************************/
		
		$this->form_validation->set_rules('no_fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('no_mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('no_la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('no_gur_type', 'Select Gurdian Type', 'trim|required');
		$this->form_validation->set_rules('no_gur_name', 'Gurdian Name', 'trim|required|min_length[2]|max_length[250]');

		$this->form_validation->set_rules('no_bdate', 'Date of Birth', 'trim|required|callback_date_valid');
		
		$this->form_validation->set_rules('relation', 'Relationship with customer ', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('no_address', 'Address ', 'trim|required|min_length[2]|max_length[30]');

		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Add Business Partner';
			$data['get_product_all'] = $this->add_product->get_product_all_sales('product');
			$this->load->template('customer/register',$data);
		}
		else
		{
			$this->load->model('my_custom_func_model');
			
			$user_type_id = $this->my_custom_func_model->get_user_type_id('customer'); 

			$user_insert = array(
		        'user_type'           => 	'customer',
				'user_type_id'        => 	$user_type_id,
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

				
				$update = ['coustmer' => $user_type_id];

				$this->db->where('agent_id',$this->input->post('agent_id'));
				$this->db->update('binary',$update);

				$customer_insert = array(
					'fi_name'    		  => 	$this->input->post('fi_name'),
					'mi_name'         	  => 	$this->input->post('mi_name'),
					'la_name'			  => 	$this->input->post('la_name'),
					'bdate'		          =>	date('Y-m-d',strtotime($this->input->post('bdate'))),
					'gur_type'			  => 	$this->input->post('gur_type'),
					'gur_name'			  => 	$this->input->post('gur_name'),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'pin_code'		      =>	$this->input->post('pin_code'),
					'state'	              =>	$this->input->post('state'),
					'no_fi_name'	      =>	$this->input->post('no_fi_name'),
					'no_mi_name'	      =>	$this->input->post('no_mi_name'),
					'no_la_name'  		  =>	$this->input->post('no_la_name'),
					'no_gur_type'  	  	  =>	$this->input->post('no_gur_type'),
					'no_gur_name'  	  	  =>	$this->input->post('no_gur_name'),
					'no_bdate'	          =>	date('Y-m-d',strtotime($this->input->post('no_bdate'))),
					'relation'	          =>	$this->input->post('relation'),
					'no_address'	      =>	$this->input->post('no_address'),
					'user_id'		      =>	$insert_id,
					'age'	      		  =>	$this->input->post('year'),
					'nage'	      		  =>	$this->input->post('nyear'),
					'sex'		  	  	  =>	$this->input->post('sex'),
					'booking'		  	  =>	$this->input->post('booking'),
					'remarks'		  	  =>	$this->input->post('remarks'),
					'plan'		  	  	  =>	$this->input->post('plan_code')

				);
				if($this->db->insert('customer_detail', $customer_insert))
				{


					if($this->input->post('booking') != '')
					{
						$add_p = ['status'	=>	2];
						$this->db->where('id', $this->input->post('booking'));
						$this->db->update('create_product', $add_p);
					}

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
								$this->session->set_flashdata('msg', 'Customer Successfully Added');
	        					redirect(base_url().'customer');
							}
							else
							{
								$this->session->set_flashdata('error', 'Customer Successfully Added - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'customer');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Customer Successfully Added - '.$this->upload->display_errors());
	        				redirect(base_url().'customer');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Customer Successfully Added');
	        			redirect(base_url().'customer');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Add Customer Try Again');
	        		redirect(base_url().'customer/add');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Add Customer Try Again');
	        	$this->db->delete('user', array('id' => $insert_id));
	        	redirect(base_url().'customer/add');
			}
		}
	
		


	}  //  Save Function

	// Check Agent Id
	function Agent_id($id){
		if($id != ''){
			if($this->users->get_agent_id($id)){
	            return true;
			}
			else{
				$this->form_validation->set_message(__FUNCTION__ , 'Please Enter Valid Agent Id');
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
		  							Edit Customer
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/		  
	public function edit($id = false){
		if($id)
		{
			
			if($this->users->get_user_with_type($id,'customer'))
			{
				$data['page_title']	= 'Edit Customer';
				$data['user'] = $this->users->get_user($id)[0];
				$data['customer'] = $this->users->customer_detail($id)[0];
				$data['get_product_all'] = $this->add_product->get_product_all_sales('product');
				$data['booked'] = $this->add_product->booked_product($data['customer']['booking']);
				if($data['booked'])
				{
					array_push($data['get_product_all'], $data['booked']);
				}
				
				$this->load->template('customer/edit',$data);
			}	
			else
			{
				$this->session->set_flashdata('error', 'Customer Not Found');
	        	redirect(base_url().'customer');
			}
			
		}
		else
		{
			$this->session->set_flashdata('error', 'Customer Not Found');
	        redirect(base_url().'customer');
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
		
		$this->form_validation->set_rules('bdate', 'Date of Birth', 'trim|required|callback_date_valid');
		$this->form_validation->set_rules('gur_type', 'Select Gurdian Type', 'trim|required');
		$this->form_validation->set_rules('gur_name', 'Gurdian Name', 'trim|required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('remarks', 'remarks', 'trim');
		$this->form_validation->set_rules('booking', 'booking', 'trim');
		$this->form_validation->set_rules('plan_code', 'plan_code', 'trim');
		
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
		$this->form_validation->set_rules('year', 'Year', 'trim');
		$this->form_validation->set_rules('nyear', 'Year', 'trim');
		$this->form_validation->set_rules('sex', 'Sex', 'trim|required');
		/*****************************************************
					Nominee’s Details
		******************************************************/
		
		$this->form_validation->set_rules('no_fi_name', 'First Name', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('no_mi_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('no_la_name', 'Last Name', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('no_gur_type', 'Select Gurdian Type', 'trim|required');
		$this->form_validation->set_rules('no_gur_name', 'Gurdian Name', 'trim|required|min_length[2]|max_length[250]');

		$this->form_validation->set_rules('no_bdate', 'Date of Birth', 'trim|required|callback_date_valid');
		
		$this->form_validation->set_rules('relation', 'Relationship with customer ', 'trim|required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('no_address', 'Address ', 'trim|required|min_length[2]|max_length[500]');


		//	User Name 
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Business Partner';
			$data['user'] = $this->users->get_user($this->input->post('main_id'))[0];
			$data['customer'] = $this->users->customer_detail($this->input->post('main_id'))[0];
			$data['get_product_all'] = $this->add_product->get_product_all_sales('product');
			$data['booked'] = $this->add_product->booked_product($data['customer']['booking']);
			if($data['booked'])
			{
				array_push($data['get_product_all'], $data['booked']);
			}
			$this->load->template('customer/edit',$data);
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
					'gur_type'			  => 	$this->input->post('gur_type'),
					'gur_name'			  => 	$this->input->post('gur_name'),
					'mobile'		      =>	$this->input->post('mobile'),
					'mobile2'		      =>	$this->input->post('mobile2'),
					'address'		      =>	$this->input->post('address'),
					'city'		          =>	$this->input->post('city'),
					'pin_code'		      =>	$this->input->post('pin_code'),
					'state'	              =>	$this->input->post('state'),
					'no_fi_name'	      =>	$this->input->post('no_fi_name'),
					'no_mi_name'	      =>	$this->input->post('no_mi_name'),
					'no_la_name'  		  =>	$this->input->post('no_la_name'),
					'no_gur_type'  	  	  =>	$this->input->post('no_gur_type'),
					'no_gur_name'  	  	  =>	$this->input->post('no_gur_name'),
					'no_bdate'	          =>	date('Y-m-d',strtotime($this->input->post('no_bdate'))),
					'relation'	          =>	$this->input->post('relation'),
					'no_address'	      =>	$this->input->post('no_address'),
					'age'	      		  =>	$this->input->post('year'),
					'nage'	      		  =>	$this->input->post('nyear'),
					'sex'		  	  	  =>	$this->input->post('sex'),
					'booking'		  	  =>	$this->input->post('booking'),
					'remarks'		  	  =>	$this->input->post('remarks')
					
				);

					$this->db->where('user_id', $this->input->post('main_id'));
				if($this->db->update('customer_detail', $customer_insert))
				{

					if($this->input->post('booking') != '')
					{
						$add_p = ['status'	=>	2];
						$this->db->where('id', $this->input->post('booking'));
						$this->db->update('create_product', $add_p);
					}
					else
					{
						if($this->input->post('booked_last') != '')
						{
							$add_p = ['status'	=>	0];
							$this->db->where('id', $this->input->post('booked_last'));
							$this->db->update('create_product', $add_p);
						}
					}

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
								$this->session->set_flashdata('msg', 'Customer Successfully Saved');
	        					redirect(base_url().'customer');
							}
							else
							{
								$this->session->set_flashdata('error', 'Customer Successfully Saved - '.$this->upload->display_errors());
								unlink('./uploads/'.$newName);
	        					redirect(base_url().'customer');
							}
						}
						else
						{
							$this->session->set_flashdata('error', 'Customer Successfully Saved - '.$this->upload->display_errors());
	        				redirect(base_url().'customer');
						}


					}
					else
					{
						$this->session->set_flashdata('msg', 'Customer Successfully Saved');
	        			redirect(base_url().'customer');
		        	}
					
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Customer Try Again');
	        		redirect(base_url().'customer');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Customer Try Again');
	        	redirect(base_url().'customer');
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
			if($this->users->get_user_with_type($id,'customer'))
			{

				$this->db->where('id',$id);
				if($this->db->update('user',array('updated_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
				{

					$user = $this->auth->get_admin($id);

					if($user->image != 'user.png')
					{
						unlink('./uploads/'.$user->image);
					}
					$this->session->set_flashdata('msg', 'Customer Successfully Deleted');
	        		redirect(base_url().'customer');
				}
				else{
					$this->session->set_flashdata('error', 'Customer Not Deleted Try Again');
	        		redirect(base_url().'customer');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Customer Not Found');
	        	redirect(base_url().'customer');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Customer Not Found');
	        redirect(base_url().'customer');
		}
	}		



}
