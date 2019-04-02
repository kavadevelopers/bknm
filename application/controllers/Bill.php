<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('bknmu');
    }


	public function index()
	{
		$data['page_title']	= 'Bills';
		$data['bills'] = $this->db->order_by('id', 'DESC')->get_where('bill')->result_array();
		$this->load->template('bill/index',$data);
	}

    public function add()
    {
        $data['page_title'] = 'Add Bills';
        $data['persons']    = $this->db->get('person')->result_array();
        $data['course']     = $this->db->get('cource')->result_array();
        $this->load->template('bill/add',$data);
    }


    public function save()
    {
        foreach ($this->input->post('person') as $key => $val) {

            $bill = [
                        'person'        =>   $this->input->post('person')[$key],
                        'cource'        =>   explode("-",$this->input->post('course')[$key])[0],
                        'tpc'           =>   $this->input->post('tpc')[$key],
                        'total'         =>   $this->input->post('total')[$key]
                    ];
            
            $this->db->insert('bill', $bill);
        }



        $this->session->set_flashdata('msg', 'Bill Successfully Added');
        redirect(base_url().'bill');
    }

}