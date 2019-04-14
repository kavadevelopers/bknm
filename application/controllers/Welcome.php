<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public $year;
	public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->year = $this->load->database(year_db(),TRUE);
    }


	public function index()
	{
		if($this->session->userdata('id')){
			redirect(base_url('dashboard'));
		}
		else
		{
			$this->load->helper('cookie');
			$this->load->view('login');
		}
	}




	public function db()
	{
		$tab = $this->year->list_tables();
		$tables = $this->db->list_tables();
		// print_r($tables);echo "<br>";
		// print_r($tab);echo "<br>";
		$this->year->query('CREATE TABLE IF NOT EXISTS `file1` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `acc_code` text NOT NULL,
		  `name` text NOT NULL,
		  `ac_no` text NOT NULL,
		  `bank` text NOT NULL,
		  `ifsc` text NOT NULL,
		  `branch` text NOT NULL,
		  `date` text NOT NULL,
		  `cource` text NOT NULL,
		  `nos` text NOT NULL,
		  `day` text NOT NULL,
		  `ta` text NOT NULL,
		  `tall_tax` text NOT NULL,
		  `paper_total` text NOT NULL,
		  `day_all` text NOT NULL,
		  `total` text NOT NULL,
		  PRIMARY KEY (`id`)
		)');
		// $this->myforge = $this->load->dbforge('2019-2020', TRUE);

		// $this->myforge->add_field('id');
		// $this->myforge->create_table('table_name');

	}
}
