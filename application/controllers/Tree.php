<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tree extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('validate');
        $this->load->model('users');
        $this->load->model('binary_model');
    }


	public function index()
	{	
		if($this->binary_model->find_agent($this->session->userdata('user_type_id')))
		{
			$data['page_title']	= 'Binary Tree';
			$data['agent_id']	= $this->session->userdata('user_type_id');
			$this->load->template('tree/tree',$data);
		}
		else
		{
			$this->session->set_flashdata('error', 'Agent Id Not Found Try Again');
	        redirect(base_url('dashboard'));
		}
	}

	public function get($id = FALSE)
	{
	
		if($id)
		{

			if($this->binary_model->find_agent($id))
			{
				$data['page_title']	= 'Binary Tree';
				$data['agent_id']	= $id;
				$this->load->template('tree/tree',$data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Agent Id Not Found Try Again');
		        redirect(base_url('dashboard'));
			}
		}	
		else
		{
			$this->session->set_flashdata('error', 'Agent Id Not Found Try Again');
	        redirect(base_url('dashboard'));
		}
		
	}

	public function whole_tree($id = FALSE)
	{
	
		if($id)
		{

			if($this->binary_model->find_agent($id))
			{
				$data['page_title']	= 'Binary Tree';
				$data['agent_id']	= $id;
				$this->load->template('tree/whole_tree',$data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Agent Id Not Found Try Again');
		        redirect(base_url('dashboard'));
			}
		}	
		else
		{
			$this->session->set_flashdata('error', 'Agent Id Not Found Try Again');
	        redirect(base_url('dashboard'));
		}
		
	}
	

	public function subadmin(){
		$data['page_title']	= 'Binary Tree';
		$data['agent'] = $this->users->all_agents('agent');
		$this->load->template('tree/agent',$data);
	}


	public function subadmin_get(){
		if(isset($_POST['whole'])){
			redirect(base_url('tree/whole_tree/').$_POST['agent_id']);
		}
		else
		{
			redirect(base_url('tree/get/').$_POST['agent_id']);
		}
	}
}
?>