<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_investment extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
     	$this->load->model('partner_invest');
    }


	public function index()
	{
		$data['page_title']	= 'Manage Investment';
		$data['invest'] = $this->db->get_where('investment',array('delete_flag' => 0))->result_array();
		$this->load->template('partner_invest/index',$data);
	} 

	


	/*******************************************************************************************************
														Start Add 
	*******************************************************************************************************/


	public function add()
	{	
	    $data['page_title']	= 'Add Investment';
	    $data['users'] = $this->partner_invest->users('users');
		$this->load->template('partner_invest/add',$data);
	}

	public function business_part()
    {
    	redirect(base_url().'partner_investment/add_form/'.$_POST['business_part']);
    }

    public function add_form($id = FALSE)
    {
    	if($id)
    	{
    		if($this->partner_invest->business_detail($id))
    		{
    			$data['page_title']	= 'Add Investment';
    			$data['business_detail'] = $this->partner_invest->business_detail($id);
    			$data['main_id'] = $id;
    			$this->load->template('partner_invest/add_form',$data);
    		}
    		else
    		{
    			$this->session->set_flashdata('error', 'Investor Is Not Valid Please Try Again');
	        	redirect(base_url().'partner_investment/add');
    		}
    	}
    	else
    	{
    		$this->session->set_flashdata('error', 'Investor Is Not Valid Please Try Again');
	        redirect(base_url().'partner_investment/add');
    	}
    }

	public function save()
    {
    		$investment = array(
                'name'                  =>  $this->input->post('bs_prt_id'),
                'invest_amount'         =>  $this->input->post('invest_amount'),
                'pay_date'              =>  _ddate($this->input->post('pay_date')),
                'pay_mode'              =>  $this->input->post('pay_mode'),
                'pay_mode_detail'       =>  $this->input->post('pay_mode_detail'),
    			'created_by'            =>  $this->session->userdata('id'),
                'updated_by'            =>  $this->session->userdata('id'),
		 		'created_at'            =>  date('Y-m-d H:i:s'),
                'updated_at'            =>  date('Y-m-d H:i:s')
		    );

		    if($this->db->insert('investment', $investment))
		    {
                $insertId = $this->db->insert_id();

                $transaction = [
                    'type'              =>  'investment',
                    'credit'            =>  $this->input->post('invest_amount'),
                    'debit'             =>  0, 
                    'credit_by'         =>  $this->input->post('bs_prt_id'),
                    'date'              =>  _ddate($this->input->post('pay_date')),
                    'investment_id'     =>  $insertId,
                    'created_by'        =>  $this->session->userdata('id'),
                    'created_at'        =>  date('Y-m-d H:i:s')
                ];

                if($this->db->insert('transaction', $transaction))
                {
                    $this->session->set_flashdata('msg', 'Investment Added Successfully');
    	        	redirect(base_url().'partner_investment');
                }

		    }
		    else
		    {
		    	$this->session->set_flashdata('error', 'Problem In Add Investment Try Again');
	        	redirect(base_url().'partner_investment/add_form/'.$_POST['bs_prt_id']);
		    }
    }

    /*******************************************************************************************************
                                                Start Edit
    *******************************************************************************************************/
    public function edit($id = false)
    {   
        if($id)
        {
            if($this->partner_invest->investment_detail($id))
            {
                $data['page_title'] = 'Edit Investment';
                $data['investment'] = $this->partner_invest->investment_detail($id);
                $data['business_detail'] = $this->partner_invest->business_detail($data['investment'][0]['name']);
                $this->load->template('partner_invest/edit',$data);
            }   
            else
            {
                $this->session->set_flashdata('error', 'Investment Not Found');
                redirect(base_url().'partner_investment');
            }
            
        }
        else
        {
            $this->session->set_flashdata('error', 'Investment Not Found');
            redirect(base_url().'partner_investment');
        }
        
    }   

    public function update(){


        $data['page_title'] = 'Edit Investment';
        $data['investment'] = $this->partner_invest->investment_detail($id);
        $data['business_detail'] = $this->partner_invest->business_detail($data['investment'][0]['name']);
        $this->load->template('partner_invest/edit',$data);
    
        $update_investment = array(
            'name'                  =>  $this->input->post('name'),
            'invest_amount'         =>  $this->input->post('invest_amount'),
            'pay_date'              =>  _ddate($this->input->post('pay_date')),
            'pay_mode'              =>  $this->input->post('pay_mode'),
            'pay_mode_detail'       =>  $this->input->post('pay_mode_detail'),
            'updated_by'            =>  $this->session->userdata('id'),
            'updated_at'            =>  date('Y-m-d H:i:s')
        );

            $this->db->where('id', $this->input->post('id'));
        if($this->db->update('investment', $update_investment)){

            $update_transaction = array(
                'credit'           =>    $this->input->post('invest_amount'),
                'date'             =>    date('Y-m-d',strtotime($this->input->post('pay_date')))
            );

                $this->db->where('investment_id', $this->input->post('id'));
                $this->db->where('type','investment');
            if($this->db->update('transaction', $update_transaction)){

                $this->session->set_flashdata('msg', 'Investment Successfully Save');
                redirect(base_url().'partner_investment');
            }
            
        }
        else
        {
            $this->session->set_flashdata('error', 'Problem In Save Investment Try Again');
            redirect(base_url().'partner_investment');
        }
        
    }



    /*******************************************************************************************************
                                                Start Delete
    *******************************************************************************************************/
    public function delete($id)
    {
		$delete = ['delete_flag' => 1];

		$this->db->where('id', $id);
        if($this->db->update('investment',$delete))
   		{      
            $get_invest = $this->db->get_where('transaction',array('investment_id' => $id))->result_array()[0];
           

                $transaction = [
                    'type'              =>  'investment',
                    'credit'            =>  0,
                    'debit'             =>  $get_invest['credit'],
                    'debit_by'          =>  $get_invest['credit_by'],
                    'date'              =>  date('Y-m-d'),
                    'investment_id'     =>  $id,
                    'created_by'        =>  $this->session->userdata('id'),
                    'created_at'        =>  date('Y-m-d H:i:s')
                ];
           

                
                if($this->db->insert('transaction', $transaction))
                {
                    $this->session->set_flashdata('msg', 'Investment Successfully Deleted');
                	redirect(base_url().'partner_investment');
                }
   		}
   		else
   		{
   			$this->session->set_flashdata('error', 'Investment Not Deleted Pls Try Again Later.');
	        redirect(base_url().'partner_investment');
   		}
    }

}

?>