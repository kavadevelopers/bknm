<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('bknmu');
    }


    public function index()
    {
    	$data['page_title']	= 'Courses';
    	$data['courses'] = $this->db->order_by('id', 'DESC')->get('cource')->result_array();
		$this->load->template('course/index',$data);
    }

    public function add()
    {
        $data['page_title'] = 'Add Course';
        $this->load->template('course/add',$data);
    }


    public function save()
    {
        $this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
        
        $this->form_validation->set_rules(
                'course',
                'Course', 
                'trim|required|max_length[100]|is_unique[cource.cource]',
                    array(
                        'is_unique' => 'Course Is Already Exists',
                        'required' => 'Course Is Required',
                        'max_length' => 'Course Cannot Exceed 100 Numbers in Length'
                    )
        );

        $this->form_validation->set_rules(
                'amount',
                'Amount', 
                'trim|required|max_length[10]|decimal',
                    array(
                        'required' 		=> 'Amount Is Required',
                        'max_length' 	=> 'Amount Cannot Exceed 10 Characters in Length',
                        'decimal' 		=> 'Please Enter Valid Amount'
                    )
        );    

        if ($this->form_validation->run() == FALSE)
        {

            $data['page_title'] = 'Add Course';
        	$this->load->template('course/add',$data);

        }
        else
        { 

            $cource = array(
                'cource'              	=>    strtoupper($this->input->post('course')),
                'price'              	=>    $this->input->post('amount')
            );

            $this->db->insert('cource', $cource);
            $this->session->set_flashdata('msg', 'Course Successfully Added');
            redirect(base_url().'course');
            

        }
        
    }

}