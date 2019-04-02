<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('setting_model');
    }


	public function plan_codes()
	{
		//$this->load->model('users');
		$data['page_title']	= 'Product Plans';
		$data['plan_code'] = $this->setting_model->get_plan_code();
		$this->load->template('setting/plan_codes',$data);
	}

	
	/*//////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Add Paln Number
	//////////////////////////////////////////////////////////////////////////////////////////////////////*/


	public function add_plan_code()
	{	
	    $data['page_title']	= 'Add Plan';
		$this->load->template('setting/add_plan_code',$data);
	}

	public function plan_code_save(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

		$this->form_validation->set_rules('plan_code', 'Plan Name', 'trim|required|is_unique[plan_code.plan_code]|min_length[3]|max_length[240]');
		$this->form_validation->set_rules('month', 'Month', 'trim|required|integer|min_length[1]|max_length[240]');
		$this->form_validation->set_rules('year', 'Year', 'trim|required|max_length[240]');



		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Add Plan';
			$this->load->template('setting/add_plan_code',$data);
		}
		else
		{
			
			$plan_code_insert = array(
		        'plan_code'           => 	$this->input->post('plan_code'),
		        'month'               => 	$this->input->post('month'),
		        'year'        		  => 	$this->input->post('year'),
		        'created_by'		  => 	$this->session->userdata('id'),
		        'updated_by'		  => 	$this->session->userdata('id'),
		        'created_at' 		  => 	date('Y-m-d H:i:s'),
		        'updated_at' 		  => 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('plan_code', $plan_code_insert))
			{
				$this->session->set_flashdata('msg', 'Plan Successfully Saved');
	        	redirect(base_url().'setting/plan_codes');
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Plan Try Again');
	        	redirect(base_url().'setting/add_plan_code');
			}

		}	
	}

	/*/////////////////////////////////////////////////////////////////////////////////////////////////////
		  								 Edit Plan Number
	/////////////////////////////////////////////////////////////////////////////////////////////////////*/  

	
	public function plan_code_edit($id = false)
	{	
		if($id)
		{
			$data['page_title']	= 'Edit Plan';
			$data['plan_code'] = $this->setting_model->edit_plan_code($id);
			$this->load->template('setting/edit_plan_code',$data);

			
		}
		else
		{
			$this->session->set_flashdata('error', 'Plan Not Found Try Again');
	        redirect(base_url().'setting/plan_codes');
		}
	    
	}

	public function plan_code_update(){
			$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
			if($this->setting_model->get_plan_code_single($this->input->post('id'))['plan_code'] != $this->input->post('plan_code') )
			{
				$_is_unique = '|is_unique[plan_code.plan_code]';
			}
			else
			{
				$_is_unique = '';
			}
			$this->form_validation->set_rules('plan_code', 'Plan Name', 'trim'.$_is_unique.'|required|min_length[3]|max_length[240]');
			$this->form_validation->set_rules('month', 'Month', 'trim|required|integer|min_length[1]|max_length[240]');
			$this->form_validation->set_rules('year', 'Year', 'trim|required|max_length[240]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['page_title']	= 'Edit Plan';
				$data['plan_code'] = $this->setting_model->edit_plan_code($this->input->post('id'));
				$this->load->template('setting/edit_plan_code',$data);
			}
			else
			{
				$plan_code_update = array(
					'plan_code'  		 =>    $this->input->post('plan_code'),
					'month'   		     =>    $this->input->post('month'),
					'year'               =>    $this->input->post('year'),
					'updated_by'   		 =>    $this->session->userdata('id'),
					'updated_at'   	     =>    date('Y-m-d H:i:s')
				);

				$this->db->where('id', $this->input->post('id'));

				if($this->db->update('plan_code', $plan_code_update)){
					
					$this->session->set_flashdata('msg', 'Plan Successfully Updated');
		        	redirect(base_url().'setting/plan_codes');

		        }
		        else
		        {
		        	$this->session->set_flashdata('error', 'Problem In Edit Plan Try Again');
				    redirect(base_url().'setting/edit_plan_code');
		        }
		    }
    }

    /*/////////////////////////////////////////////////////////////////////////////////////////////////////
		  								DELETE Plan Number
	/////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function plan_code_delete($id = false)
	{	
		if($id)
		{
			$this->db->where('id',$id);
			if($this->db->update('plan_code',array('updated_by'  => $this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
			{
				$this->session->set_flashdata('msg', 'Plan Successfully Deleted');
        		redirect(base_url().'setting/plan_codes');
			}
			else{
				$this->session->set_flashdata('error', 'Plan Not Deleted Try Again');
        		redirect(base_url().'setting/plan_codes');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Plan Not Found');
	        redirect(base_url().'setting/plan_codes');
		}
	}		



	/*/////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Insert Bank
	/////////////////////////////////////////////////////////////////////////////////////////////////////*/




	public function bank(){
		$data['page_title']	= 'Bank Details';
		$data['bank'] = $this->setting_model->get_bank();
		$this->load->template('setting/bank',$data);
	}

	public function save_bank()
	{
				$bank = array(
					'bank'  		 =>    $this->input->post('bank'),
					'ac_name'   	 =>    $this->input->post('ac_name'),
					'ac_no'          =>    $this->input->post('ac_no'),
					'ifsc'   		 =>    strtoupper($this->input->post('ifsc'))
				);

				$this->db->where('id', '1');

				if($this->db->update('bank', $bank)){
					$this->session->set_flashdata('msg', 'Bank Successfully Save');
        			redirect(base_url().'setting/bank');
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Bank');
	        		redirect(base_url().'setting/bank');
				}

	} // End Insert Bank


	/*/////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Insert Agent Deactivation
	/////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function agent_deactivation()
	{
		$data['page_title']	= 'Agent Deactivation';
		$data['deactivation'] = $this->setting_model->get_agent_deactivation();
		$this->load->template('setting/agent_deactivation',$data);
	}



	public function save_agent_deactivation()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('agent', 'Number Of Agents', 'trim|required|is_natural|min_length[1]|max_length[240]');
		$this->form_validation->set_rules('saller', 'Number Of Sale', 'trim|required|is_natural|min_length[1]|max_length[240]');		

		if($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Agent Deactivation';
			$data['deactivation'] = $this->setting_model->get_agent_deactivation();
			$this->load->template('setting/agent_deactivation',$data);
		}
		else
		{

			$agent = array(
				'agent'  		 =>    $this->input->post('agent'),
				'saller'   	 	 =>    $this->input->post('saller'),
			);

			$this->db->where('id', '1');

			if($this->db->update('agent_deactivation', $agent)){
				$this->session->set_flashdata('msg', 'Agent Deactivation Successfully Save');
    			redirect(base_url().'setting/agent_deactivation');
			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Agent Deactivation');
        		redirect(base_url().'setting/agent_deactivation');
			}
		}

	} // End Agent Deactivation






	public function promotion(){
		$data['page_title']	= 'Agent Promotion';
		$data['percent'] = $this->setting_model->get_promotion();
		$this->load->template('setting/promotion',$data);
	}


	public function save_promotion()
	{
			$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
			
			$this->form_validation->set_rules('silver', 'Silver Personality', 'trim|required|numeric');
			$this->form_validation->set_rules('gold', 'Gold Personality', 'trim|required|numeric');
			$this->form_validation->set_rules('diamond', 'Diamond Personality', 'trim|required|numeric');
			$this->form_validation->set_rules('super', 'Superb Personality', 'trim|required|numeric');
			$this->form_validation->set_rules('silver_commission', 'Silver Commission', 'trim|required|decimal');
			$this->form_validation->set_rules('gold_commission', 'Gold Commission', 'trim|required|decimal');
			$this->form_validation->set_rules('diamond_commission', 'Diamond Commission', 'trim|required|decimal');
			$this->form_validation->set_rules('super_commission', 'Superb Commission', 'trim|required|decimal');
				
			if ($this->form_validation->run() == FALSE)
			{
				$data['page_title']	= 'Agent Promotion';
				$data['percent'] = $this->setting_model->get_promotion();
				$this->load->template('setting/promotion',$data);
			}
			else
			{
				$promotion = array(
					'silver'   	 		 =>    $this->input->post('silver') * 100,
					'gold'         		 =>    $this->input->post('gold') * 100,
					'diamond'         	 =>    $this->input->post('diamond') * 100,
					'super'         	 =>    $this->input->post('super') * 100,
					'silver_commission'  =>    $this->input->post('silver_commission'),
					'gold_commission'    =>    $this->input->post('gold_commission'),
					'diamond_commission' =>    $this->input->post('diamond_commission'),
					'super_commission' =>    $this->input->post('super_commission')
				);

				$this->db->where('id', '1');

				if($this->db->update('agent_promotion', $promotion)){
					$this->session->set_flashdata('msg', 'Partner Promotion Successfully Save');
        			redirect(base_url().'setting/promotion');
				}
				else
				{
					$this->session->set_flashdata('error', 'Problem In Save Partner Promotion');
	        		redirect(base_url().'setting/promotion');
				}
			}
	}




	public function location()
	{
		$data['page_title']	= 'Plot Locations';
		$data['location'] = $this->setting_model->get_locations();
		$this->load->template('setting/locations',$data);
	}

	public function add_location()
	{
		$data['page_title']	= 'Add Plot Locations';
		$this->load->template('setting/add_location',$data);
	}

	public function save_location()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
			
		$this->form_validation->set_rules('location', 'Location Name', 'trim|required|max_length[240]|is_unique[locations.name]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Add Plot Locations';
			$this->load->template('setting/add_location',$data);
		}
		else
		{
			$this->db->insert('locations',['name' => $this->input->post('location')]);
			$this->session->set_flashdata('msg', 'Location Successfully Saved');
        	redirect(base_url().'setting/location');
		}
	} 


	public function auth_code()
	{
		$data['page_title']	= 'Authentication Code';
		$data['code'] = $this->setting_model->get_authcode();
		
		$this->load->template('setting/authcode',$data);
	}

	public function save_code()
	{
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('admin', 'Admin Code', 'trim|required|numeric|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('investor', 'Investor Code', 'trim|required|numeric|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('agent', 'Agent Code', 'trim|required|numeric|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('customer', 'Customer Code', 'trim|required|numeric|min_length[4]|max_length[4]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Authentication Code';
			$data['code'] = $this->setting_model->get_authcode();
			
			$this->load->template('setting/authcode',$data);
		}
		else
		{
			$this->db->where('for','subadmin');
			$this->db->update('auth_key',['code' => $this->input->post('admin')]);

			$this->db->where('for','business');
			$this->db->update('auth_key',['code' => $this->input->post('investor')]);

			$this->db->where('for','agent');
			$this->db->update('auth_key',['code' => $this->input->post('agent')]);

			$this->db->where('for','customer');
			$this->db->update('auth_key',['code' => $this->input->post('customer')]);

			$this->session->set_flashdata('msg', 'Authentication Code Saved');
	       	redirect(base_url().'setting/auth_code');
	    }
	}

}	

?>