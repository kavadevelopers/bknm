<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('ifsc_model');
        $this->load->model('professor_model');
        $this->load->model('user_model');
    }


	public function index()
	{	
		
		$data['_title']		= "Manage Professor";
		$data['professors']	= $this->professor_model->professor_all();
		$this->load->template('professor/index',$data);

	}

	public function add()
	{	
		$data['_title']		= "Add Professor";
		$data['ifsc_all']	= $this->ifsc_model->ifsc_all();
		$this->load->template('professor/add',$data);
	}

	public function ifsc_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->ifsc_model->ifsc_autocom($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label'         => $row->ifsc,
                    'branch'   		=> $row->branch,
                    's_name'   		=> $row->short_name_bank,
             	);
                echo json_encode($arr_result);
            }
        }
    }


	public function view($id = false)
	{	
		if($id){
			if($this->professor_model->professor_df_id($id)){
				$data['_title']			= "Professor";
				$data['professor']		= $this->professor_model->professor_df_id($id)[0];
				$this->load->template('professor/view',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Professor Not Found Try Again');
		        redirect(base_url().'professor');
			}
		}else{
			$this->session->set_flashdata('error', 'Professor Not Found Try Again');
	        redirect(base_url().'professor');
		}
		
	}

	public function edit($id = false)
	{	
		if($id){
			if($this->professor_model->professor_df_id($id)){
				$data['_title']			= "Edit Professor";
				$data['ifsc_all']		= $this->ifsc_model->ifsc_all();
				$data['professor']		= $this->professor_model->professor_df_id($id)[0];
				$this->load->template('professor/edit',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Professor Not Found Try Again');
		        redirect(base_url().'professor');
			}
		}else{
			$this->session->set_flashdata('error', 'Professor Not Found Try Again');
	        redirect(base_url().'professor');
		}
		
	}

	public function delete($id = false)
	{
		if($id){
			if($this->professor_model->professor_df_id($id)){
				
				$this->db->where('id',$id);
				$this->db->update('professor', ['delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s')]);

				$this->session->set_flashdata('msg', 'Professor Successfully Deleted');
	        	redirect(base_url().'professor');

			}
			else{
				$this->session->set_flashdata('error', 'Professor Not Found Try Again');
		        redirect(base_url().'professor');
			}
		}else{
			$this->session->set_flashdata('error', 'Professor Not Found Try Again');
	        redirect(base_url().'professor');
		}
	}


	public function save()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('accountno', 'Bank Account No', 'trim|required|numeric|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('contact', 'Contact No', 'trim|required|min_length[10]|max_length[10]|numeric');
		$this->form_validation->set_rules('ifsc', 'Ifsc', 'trim|required|callback_chk_ifsc');
		$this->form_validation->set_rules('branch', 'branch', 'trim');
		$this->form_validation->set_rules('bank_short', 'Bank Short Name', 'trim');
		$this->form_validation->set_rules('rcbook', 'RC Book No.', 'trim');
		$this->form_validation->set_rules('fule', 'Fule Type', 'trim');
		$this->form_validation->set_rules('faculty', 'Faculty', 'trim');
		$this->form_validation->set_rules('reference', 'Reference', 'trim');
		$this->form_validation->set_rules('remarks', 'Remarks', 'trim');


		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Professor";
			$data['ifsc_all']	= $this->ifsc_model->ifsc_all();
			$this->load->template('professor/add',$data);
		}
		else
		{
			$this->db->order_by("id","DESC");
			$this->db->limit(1);
			$last_code = $this->db->get('professor')->result_array();


			if($last_code){
				$acc_code = $last_code[0]['acc_code'] + 1;
			}
			else{
				$acc_code = 1001;	
			}

			$professor = 	[

								'acc_code'				=> $acc_code,
								'name'					=> $this->input->post('name'),
								'acno'					=> $this->input->post('accountno'),
								'ifsc'					=> $this->input->post('ifsc'),
								'branch'				=> $this->input->post('branch'),
		        				'bank_short_name'   	=> strtoupper($this->input->post('bank_short')),
								'rcbook'				=> strtoupper($this->input->post('rcbook')),
								'fule'					=> $this->input->post('fule'),
								'faculty'				=> strtoupper($this->input->post('faculty')),
								'contact'				=> $this->input->post('contact'),
								'ref'					=> $this->input->post('reference'),
								'remark'				=> $this->input->post('remarks'),
								'created_by'		  	=> $this->session->userdata('id'),
						        'updated_by'		  	=> $this->session->userdata('id'),
						        'created_at' 		  	=> date('Y-m-d H:i:s'),
						        'updated_at' 		  	=> date('Y-m-d H:i:s')


							];

			if($this->db->insert('professor', $professor)){

				$this->session->set_flashdata('msg', 'Professor Successfully Added - Acc Code Is '.$acc_code);
	        	redirect(base_url().'professor');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Add Professor Please Try Again');
	        	redirect(base_url().'professor/add');

			}



		}
	}


	public function update()
	{

		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('accountno', 'Bank Account No', 'trim|required|numeric|min_length[5]|max_length[30]');
		$this->form_validation->set_rules('contact', 'Contact No', 'trim|required|min_length[10]|max_length[10]|numeric');
		$this->form_validation->set_rules('ifsc', 'Ifsc', 'trim|required|callback_chk_ifsc');
		$this->form_validation->set_rules('branch', 'branch', 'trim');
		$this->form_validation->set_rules('bank_short', 'Bank Short Name', 'trim');
		$this->form_validation->set_rules('rcbook', 'RC Book No.', 'trim');
		$this->form_validation->set_rules('fule', 'Fule Type', 'trim');
		$this->form_validation->set_rules('faculty', 'Faculty', 'trim');
		$this->form_validation->set_rules('reference', 'Reference', 'trim');
		$this->form_validation->set_rules('remarks', 'Remarks', 'trim');
		$this->form_validation->set_rules('prof_id', 'prof_id', 'trim');


		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']			= "Edit Professor";
			$data['ifsc_all']		= $this->ifsc_model->ifsc_all();
			$data['professor']		= $this->professor_model->professor_df_id($this->input->post('prof_id'))[0];
			$this->load->template('professor/edit',$data);
		}
		else
		{

			$professor = 	[

								'name'					=> $this->input->post('name'),
								'acno'					=> $this->input->post('accountno'),
								'ifsc'					=> explode(' - ', $this->input->post('ifsc'))[0],
								'branch'				=> $this->input->post('branch'),
		        				'bank_short_name'   	=> strtoupper($this->input->post('bank_short')),
								'rcbook'				=> strtoupper($this->input->post('rcbook')),
								'fule'					=> $this->input->post('fule'),
								'faculty'				=> strtoupper($this->input->post('faculty')),
								'contact'				=> $this->input->post('contact'),
								'ref'					=> $this->input->post('reference'),
								'remark'				=> $this->input->post('remarks'),
						        'updated_by'		  	=> $this->session->userdata('id'),
						        'updated_at' 		  	=> date('Y-m-d H:i:s')


							];
				$this->db->where('id',$this->input->post('prof_id'));
			if($this->db->update('professor', $professor)){

				$this->session->set_flashdata('msg', 'Professor Successfully Saved');
	        	redirect(base_url().'professor');

			}
			else{

				$this->session->set_flashdata('error', 'Error In Save Professor Please Try Again');
	        	redirect(base_url().'professor');

			}



		}

	}

	public function chk_ifsc($ifsc)
	{
		if($this->db->get_where('ifsc_detail',['ifsc' => $ifsc])->result_array())
		{
			return true;
		}
		else{
			$this->form_validation->set_message(__FUNCTION__ , 'Please Enter Valid IFSC Code');
			return false;
		}
	}


	public function fetch_professor(){  

       $fetch_data = $this->professor_model->make_datatables();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array 	 = array();  
            $sub_array[] = $row->acc_code;  
            $sub_array[] = $row->name;  
            $sub_array[] = $row->acno;  
            $sub_array[] = $row->contact;  
            $sub_array[] = $row->ifsc;  
            $sub_array[] = $this->user_model->_user($row->created_by)[0]['name'];  
            $sub_array[] = _vdatetime($row->created_at);  
            $sub_array[] = '<a class="btn btn-sm btn-default" href="'.base_url('professor/view/').$row->id.'" title="View">
            					<i class="fa fa-search"></i>
                            </a> 
                            <a class="btn btn-sm btn-primary" href="'.base_url('professor/edit/').$row->id.'" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a> 
                            <a class="btn btn-sm btn-danger" href="'.base_url('professor/delete/').$row->id.'" onclick=\'return confirm("Are you Sure You Want to Delete this Professor ?")\' title="Delete">
           	                    <i class="fa fa-trash"></i>
           	                </a>';  
            
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                    	=>     intval($_POST["draw"]),  
            "recordsTotal"          	=>     $this->professor_model->get_all_data(),  
            "recordsFiltered"     		=>     $this->professor_model->get_filtered_data(),  
            "data"                    	=>     $data  
       );  
       echo json_encode($output);  
    }  

}
?>