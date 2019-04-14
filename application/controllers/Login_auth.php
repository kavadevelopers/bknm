<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_auth extends CI_Controller {

	
	public function login()
	{

		$this->load->helper('cookie');

		$user = trim($this->input->post("user"));
		
		$pass = trim($this->input->post("pass"));
		$this->load->model('login_model');
		$return = $this->login_model->login_Ath( $user , md5($pass));
 
		if($return[0] == 0){
			$this->session->set_userdata( array( 'id' => $return[3]) );
			$year = $this->db->get_where('financial_year',['active' => '1'])->result_array()[0];
			$this->session->set_userdata( array( 'year' => $year['name']) );
			
			if($this->input->post("check") == '1'){

	    		$this->input->set_cookie(array("name" => "username", "value" => $user, "expire" => time()+(60*60*24*30))); 
	    		$this->input->set_cookie(array("name" => "password", "value" => $pass, "expire" => time()+(60*60*24*30)));

	    	}
	    	else
	    	{
	    		delete_cookie("username");
	    		delete_cookie("password");
	    	}
		}
		echo json_encode($return);
	}
}
