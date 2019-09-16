<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

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

	public function change_sem($sem)
	{
		$this->session->set_userdata('sem',$sem);
		$this->session->set_flashdata('msg', 'Sem Changed');
		redirect(base_url('dashboard'));
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


	public function download()
    {

        $spreadsheet = new Spreadsheet();
        $objDrawing = new Drawing();

        $objDrawing->setName('BKNMU LOGO');
		$objDrawing->setDescription('BKNMU LOGO');
		$objDrawing->setPath('./image/logo.png');
		$objDrawing->setCoordinates('A1');                      
		              
		$objDrawing->setWidth(70); 
		$objDrawing->setHeight(70); 
		$objDrawing->setOffsetX(7);
		$objDrawing->setOffsetY(7);
		$objDrawing->setWorksheet($spreadsheet->getActiveSheet());

        $sheet = $spreadsheet->getActiveSheet()->setTitle("Title")->mergeCells('B1:I1')->mergeCells('B2:I2');

        $spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(50);
        
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);

        $add_borders = ['B1:I1','A1','A2','B2:I2','A3','B3','C3','D3','E3','F3','G3','H3','I3'];

        for($i = 0;$i < count($add_borders);$i++){

	        $spreadsheet->getActiveSheet()->getStyle($add_borders[$i])
	    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$spreadsheet->getActiveSheet()->getStyle($add_borders[$i])
	    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$spreadsheet->getActiveSheet()->getStyle($add_borders[$i])
	    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$spreadsheet->getActiveSheet()->getStyle($add_borders[$i])
    			->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    	}
    	


    	$sheet->setCellValue('B1', 'BHAKTA KAVI NARSINH MEHTA UNIVERSITY, JUNAGADH');
        $sheet->getStyle('B1')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('B1')->getFont()->setSize(16)->setBold(true);

        $sheet->setCellValue('A2', 'File-1');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A2')->getFont()->setSize(14)->setBold(true);

        $sheet->setCellValue('B2', 'PAPER SETTING PAYMENT SEM 1 - 3 - 5 (2018-19)');
        $sheet->getStyle('B2')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('B2')->getFont()->setSize(14)->setBold(true);

        $headers = ['A3' => 'Bill No.','B3' => 'C/D','C3' => 'Amt','D3' => 'Ifsc Code','E3' => 'Account No.','F3' => 'Saving Or Current','G3' => 'Name Of Person','H3' => 'Address','I3' => 'Message'];

        foreach($headers as $clm => $head){

	        $sheet->setCellValue($clm, $head);
	        $sheet->getStyle($clm)->getAlignment()->setHorizontal('center')->setVertical('center');
	        $sheet->getStyle($clm)->getFont()->setSize(12)->setBold(true);

	    }


	    


        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }


}
