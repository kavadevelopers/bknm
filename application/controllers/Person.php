<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }


	public function index()
	{
		$data['page_title']	= 'Manage Person';
		$data['persons'] = $this->db->order_by('id', 'DESC')->get_where('person')->result_array();
		$this->load->template('person/index',$data);
	}


    public function add()
    {
        $data['page_title'] = 'Add Person';
        $this->load->template('person/add',$data);
    }


    public function save()
    {
        $this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
        
        $this->form_validation->set_rules(
                'code',
                'Acc Code', 
                'trim|required|min_length[4]|max_length[6]|numeric|is_unique[person.code]',
                    array(
                        'is_unique' => 'Acc Code Is Already Exists',
                        'required' => 'Acc Code Is Required',
                        'numeric' => 'Acc Code Must Contain Only Numbers',
                        'min_length' => 'Acc Code Must Be At Least 4 Numbers',
                        'max_length' => 'Acc Code Cannot Exceed 6 Numbers in Length'
                    )
        );

        $this->form_validation->set_rules(
                'name',
                'Full Name', 
                'trim|required|min_length[4]|max_length[200]',
                    array(
                        'required' => 'Full Name Is Required',
                        'min_length' => 'Full Name Must Be At Least 4 Characters',
                        'max_length' => 'Full Name Cannot Exceed 200 Characters in Length'
                    )
        );

        $this->form_validation->set_rules(
                'mobile',
                'Mobile No.', 
                'trim|required|min_length[10]|max_length[10]|numeric|is_unique[person.mobile]',
                    array(
                        'is_unique' => 'Mobile No. Is Already Exists',
                        'required' => 'Mobile No. Is Required',
                        'numeric' => 'Mobile No. Must Contain Only Numbers',
                        'min_length' => 'Mobile No. Must Be At Least 10 Numbers',
                        'max_length' => 'Mobile No. Cannot Exceed 10 Numbers in Length'
                    )
        );

        $this->form_validation->set_rules(
                'address',
                'Address', 
                'trim|required|min_length[10]',
                    array(
                        'required' => 'Address Is Required',
                        'min_length' => 'Address Must Be At Least 10 Characters'
                    )
        );

        $this->form_validation->set_rules(
                'account',
                'Bank Account No.', 
                'trim|required|max_length[100]|numeric|is_unique[person.acno]',
                    array(
                        'is_unique' => 'Bank Account No. Is Already Exists',
                        'required' => 'Bank Account No. Is Required',
                        'numeric' => 'Bank Account No. Must Contain Only Numbers',
                        'max_length' => 'Bank Account No. Cannot Exceed 100 Numbers in Length'
                    )
        );     

        $this->form_validation->set_rules(
                'ifsc',
                'Ifsc Code', 
                'trim|required|max_length[100]',
                    array(
                        'required' => 'Ifsc Code Is Required',
                        'max_length' => 'Ifsc Code Cannot Exceed 100 Numbers in Length'
                    )
        ); 

        $this->form_validation->set_rules(
                'bank',
                'Bank Name', 
                'trim|required|max_length[200]',
                    array(
                        'required' => 'Bank Name Is Required',
                        'max_length' => 'Bank Name Cannot Exceed 200 Numbers in Length'
                    )
        );        

        if ($this->form_validation->run() == FALSE)
        {

            $data['page_title'] = 'Add Person';
            $this->load->template('person/add',$data);

        }
        else
        { 

            $person = array(
                'code'              =>    $this->input->post('code'),
                'name'              =>    $this->input->post('name'),
                'mobile'            =>    $this->input->post('mobile'),
                'bank'              =>    $this->input->post('bank'),
                'ifsc'              =>    strtoupper($this->input->post('ifsc')),
                'acno'              =>    $this->input->post('account'),
                'address'           =>    $this->input->post('address')
            );

            if($this->db->insert('person', $person)){
                $this->session->set_flashdata('msg', 'Person Successfully Added');
                redirect(base_url().'person');
            }
            else{
                $this->session->set_flashdata('error', 'Problem In Add Person Please Try Again');
                redirect(base_url().'person/add');
            }

        }
        
    }






}