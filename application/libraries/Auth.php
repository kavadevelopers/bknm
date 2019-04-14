<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
	var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }

    
    function check_session()
	{
        $admin = $this->CI->session->userdata('id');
        if(!$admin)
        {
        	$this->CI->session->set_flashdata('error', 'Your Session Is Expire Please Login Here.');
            redirect(base_url());
        }
	}

    function check_year()
    {
        $year           = $this->CI->session->userdata('year');
        $active_year    = $this->CI->db->get_where('financial_year',['active' => '1'])->result_array()[0]['name'];
        if($year != $active_year)
        {
            redirect(base_url('dashboard/retrive_flash'));
        }
    }


    function get_admin($id)
    {
        $this->CI->db->select('*');
        $this->CI->db->where('id', $id);
        $result = $this->CI->db->get('user');
        $result = $result->row();

        return $result;
    }  



}