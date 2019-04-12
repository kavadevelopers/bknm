<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ifsc extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('ifsc_model');
        $this->load->model('user_model');
    }


	public function index()
	{	
		$data['_title']			= "Manage Ifsc Code";
		$this->load->template('ifsc/ind',$data);
	}


	public function add()
	{	
		$data['_title']			= "Add Ifsc Code";
		$this->load->template('ifsc/add',$data);
	}

	public function view($id = false)
	{	
		if($id){
			if($this->ifsc_model->ifsc_id($id)){
				$data['_title']			= "Ifsc Code";
				$data['ifsc']			= $this->ifsc_model->ifsc_id($id)[0];
				$this->load->template('ifsc/view',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Ifsc Code Not Found Try Again');
		        redirect(base_url().'ifsc');
			}
		}else{
			$this->session->set_flashdata('error', 'Ifsc Code Not Found Try Again');
	        redirect(base_url().'ifsc');
		}
		
	}


	public function edit($id = false)
	{	
		if($id){
			if($this->ifsc_model->ifsc_id($id)){
				$data['_title']			= "Edit Ifsc Code";
				$data['ifsc']			= $this->ifsc_model->ifsc_id($id)[0];
				$this->load->template('ifsc/edit',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Ifsc Code Not Found Try Again');
		        redirect(base_url().'ifsc');
			}
		}else{
			$this->session->set_flashdata('error', 'Ifsc Code Not Found Try Again');
	        redirect(base_url().'ifsc');
		}
		
	}

	public function delete($id = false)
	{	
		if($id){
			if($this->ifsc_model->ifsc_id($id)){
					
				$this->db->where('id',$id);
				$this->db->delete('ifsc_detail');

				$this->session->set_flashdata('msg', 'Ifsc Code Successfully Deleted');
	        	redirect(base_url().'ifsc');

			}
			else{
				$this->session->set_flashdata('error', 'Ifsc Code Not Found Try Again');
		        redirect(base_url().'ifsc');
			}
		}else{
			$this->session->set_flashdata('error', 'Ifsc Code Not Found Try Again');
	        redirect(base_url().'ifsc');
		}
		
	}


	public function save()
	{	
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('ifsc', 'Ifsc Code', 'trim|required|min_length[11]|max_length[11]|is_unique[ifsc_detail.ifsc]',array('is_unique' => 'Ifsc Code Is Already Exists'));

		$this->form_validation->set_rules('branch', 'Branch Name', 'trim|required|min_length[2]|max_length[200]');

		$this->form_validation->set_rules('address', 'Address', 'trim|required');

		$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('district', 'District', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('bank', 'Bank', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('micr', 'Micr Code', 'trim|max_length[200]');
		$this->form_validation->set_rules('contact', 'Contact', 'trim|max_length[200]|numeric');
		$this->form_validation->set_rules('state', 'State', 'trim|required|max_length[200]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']			= "Add Ifsc Code";
			$this->load->template('ifsc/add',$data);
		}
		else
		{

			$ifsc = array(
		        'ifsc'           	=> 	strtoupper($this->input->post('ifsc')),
		        'branch'           	=> 	strtoupper($this->input->post('branch')),
		        'address'		    => 	strtoupper($this->input->post('address')),
		        'city'              => 	strtoupper($this->input->post('city')),
		        'district'          => 	strtoupper($this->input->post('district')),
		        'bank'              => 	strtoupper($this->input->post('bank')),
		        'micr'              => 	strtoupper($this->input->post('micr')),
		        'contact'           => 	strtoupper($this->input->post('contact')),
		        'state'             => 	strtoupper($this->input->post('state')),
		        'created_by'		=> 	$this->session->userdata('id'),
		        'updated_by'		=> 	$this->session->userdata('id'),
		        'created_at' 		=> 	date('Y-m-d H:i:s'),
		        'updated_at' 		=> 	date('Y-m-d H:i:s')
		        
			);

			if($this->db->insert('ifsc_detail', $ifsc)){

				$this->session->set_flashdata('msg', 'Ifsc Code Successfully Added');
	        	redirect(base_url().'ifsc');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add Ifsc Code Please Try Again');
	        	redirect(base_url().'ifsc/add');

			}

		}


	}

	public function update()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		
		$this->form_validation->set_rules('ifsc', 'Ifsc Code', 'trim|required|min_length[11]|max_length[11]|callback_ifsc_check['.$this->input->post('ifsc_id').']');

		$this->form_validation->set_rules('branch', 'Branch Name', 'trim|required|min_length[2]|max_length[200]');

		$this->form_validation->set_rules('address', 'Address', 'trim|required');

		$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('district', 'District', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('bank', 'Bank', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('micr', 'Micr Code', 'trim|max_length[200]');
		$this->form_validation->set_rules('contact', 'Contact', 'trim|max_length[200]|numeric');
		$this->form_validation->set_rules('state', 'State', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('ifsc_id', 'ifsc_id', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']			= "Edit Ifsc Code";
			$data['ifsc']			= $this->ifsc_model->ifsc_id($this->input->post('ifsc_id'))[0];
			$this->load->template('ifsc/edit',$data);
		}
		else
		{

			$ifsc = array(
		        'ifsc'           	=> 	strtoupper($this->input->post('ifsc')),
		        'branch'           	=> 	strtoupper($this->input->post('branch')),
		        'address'		    => 	strtoupper($this->input->post('address')),
		        'city'              => 	strtoupper($this->input->post('city')),
		        'district'          => 	strtoupper($this->input->post('district')),
		        'bank'              => 	strtoupper($this->input->post('bank')),
		        'micr'              => 	strtoupper($this->input->post('micr')),
		        'contact'           => 	strtoupper($this->input->post('contact')),
		        'state'             => 	strtoupper($this->input->post('state')),
		        'updated_by'		=> 	$this->session->userdata('id'),
		        'updated_at' 		=> 	date('Y-m-d H:i:s')
		        
			);

			$this->db->where('id',$this->input->post('ifsc_id'));
			if($this->db->update('ifsc_detail', $ifsc)){

				$this->session->set_flashdata('msg', 'Ifsc Code Successfully Save');
	        	redirect(base_url().'ifsc');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Ifsc Code Please Try Again');
	        	redirect(base_url().'ifsc');

			}

		}

	}


	public function ifsc_check($ifsc,$id)
	{
		if($this->db->get_where('ifsc_detail',['ifsc' => $ifsc , 'id !='  => $id])->result_array())
		{
			$this->form_validation->set_message(__FUNCTION__ , 'Ifsc Code Already Exists');
			return false;
		}
		else{
			return true;
		}

	}

	public function branch_check($branch,$id)
	{
		if($this->db->get_where('ifsc_detail',['branch' => $branch , 'id !='  => $id])->result_array())
		{
			$this->form_validation->set_message(__FUNCTION__ , 'Branch Name Already Exists');
			return false;
		}
		else{
			return true;
		}

	}


	public function fetch_ifsc(){  

       $fetch_data = $this->ifsc_model->make_datatables();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array 	 = array();  
            $sub_array[] = $row->ifsc;  
            $sub_array[] = $row->branch;  
            $sub_array[] = $row->bank;  
            $sub_array[] = $row->city;  
            $sub_array[] = $row->state;  
            $sub_array[] = $this->user_model->_user($row->created_by)[0]['name'];  
            $sub_array[] = _vdatetime($row->created_at);  
            $sub_array[] = '<a class="btn btn-sm btn-default" href="'.base_url('ifsc/view/').$row->id.'" title="View">
            					<i class="fa fa-search"></i>
                            </a> 
                            <a class="btn btn-sm btn-primary" href="'.base_url('ifsc/edit/').$row->id.'" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a> 
                            <a class="btn btn-sm btn-danger" href="'.base_url('ifsc/delete/').$row->id.'" onclick=\'return confirm("Are you Sure You Want to Delete this Ifsc Detail ?")\' title="Delete">
           	                    <i class="fa fa-trash"></i>
           	                </a>';  
            
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                    	=>     intval($_POST["draw"]),  
            "recordsTotal"          	=>     $this->ifsc_model->get_all_data(),  
            "recordsFiltered"     		=>     $this->ifsc_model->get_filtered_data(),  
            "data"                    	=>     $data  
       );  
       echo json_encode($output);  
    }  


}
?>