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
        $year = $this->CI->session->userdata('year');
        if(!$admin || !$year)
        {
        	$this->CI->session->set_flashdata('error', 'Your Session Is Expire Please Login Here.');
            redirect(base_url());
        }
	}

    function check_year()
    {
        $year           = $this->CI->session->userdata('year');
        $admin          = $this->CI->session->userdata('id');

        $counter = 0;

        foreach (explode(',',$this->CI->db->get_where('user',['id' => $admin])->result_array()[0]['year']) as $key => $value) {
            if($value == $year)
            {
                $counter++;
            }
        }

        if($counter == 0)
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


    function check_auth()
    {
        if($this->CI->session->userdata('id') != '1')
        {
            redirect(base_url('error404'));
        }
    }



}