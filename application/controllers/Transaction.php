<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('transaction_model');
    }

    public function credit_id(){
    	pre_print($this->transaction_model->balance());
    } 


    public function get_balance()
    {
    	echo json_encode($this->transaction_model->get_parterner_balance($_POST['id']));
    }

}
?>