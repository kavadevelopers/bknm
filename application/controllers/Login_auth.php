<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_auth extends CI_Controller {

	
	public function login()
	{

		$this->load->helper('cookie');

		$user = trim($this->input->post("user"));
		// $user = trim("admin");
		$pass = trim($this->input->post("pass"));
		$code = trim($this->input->post("code"));
		// $pass = trim("admin");
		$this->load->model('login_model');
		$return = $this->login_model->login_Ath( $user , md5($pass),$code );
 
		if($return[0] == 0){
			$this->session->set_userdata( array( 'id' => $return[3],'user_type'=>$return[4],'user_type_id' => $return[5],'user_type' => $return[6]) );
			
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
