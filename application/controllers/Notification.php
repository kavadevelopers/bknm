<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }


    public function index()
    {
    	$data['page_title']	= 'Notifications';
    	$this->db->order_by('id','desc');
		$data['nofication'] = $this->db->get_where('notification',['for' => $this->session->userdata('id')])->result_array();
		$this->load->template('notification.php',$data);
    }

    public function read()
    {
    	$this->db->where('for',$this->session->userdata('id'));
    	$read = ['read' => '1'];
    	$this->db->update('notification',$read);
    }
}