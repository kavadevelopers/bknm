<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class squad extends CI_Controller {
	public $year;
	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->auth->check_year();
        $this->load->model('general_model');
        $this->load->model('user_model');
        $this->load->model('professor_model');
        $this->year = $this->load->database(year_db(),TRUE);
    }


	public function index()
	{	
		$data['_title']				= "Squad Files";
		$data['files']				= $this->general_model->get_all_files('2',$this->session->userdata('year'));
		$this->load->template('squad/file',$data);
	}

	public function add_file_view()
	{
		if(!check_right('1')){
			redirect(base_url('error404'));
		}
		$data['_title']				= "Add New File - Squad";
		$this->load->template('squad/add_filee',$data);
	}

	public function add_file()
	{
		
		if($this->general_model->get_files('2'))
		{
			$no = count($this->general_model->get_files('2')) + 1;
		}
		else{
			$no = 1;
		}



		$data = [
						'no'			=> 	$no,
						'head'			=> 	'2',
						'file_name'		=> 	'squad_file'.$no,
						'title'			=>	$this->input->post('title'),
						'message'			=>	$this->input->post('message'),
						'year'			=>	$this->session->userdata('year'),
						'created_by'	=> 	$this->session->userdata('id'),
						'updated_by'	=> 	$this->session->userdata('id'),
						'created_at' 	=> 	date('Y-m-d H:i:s'),
		        		'updated_at' 	=> 	date('Y-m-d H:i:s')
				];

		if($this->db->insert('file', $data)){
			$file_id = $this->db->insert_id();
			$query = 'CREATE TABLE IF NOT EXISTS `squad_file'.$no.'` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
  						`bill_no` text NOT NULL,
  						`acc_code` text NOT NULL,
  						`name` text NOT NULL,
						`ac_no` text NOT NULL,
						`bank` text NOT NULL,
						`ifsc` text NOT NULL,
						`branch` text NOT NULL,
						`type` text NOT NULL,
						`date` text NOT NULL,
						`km` text NOT NULL,
						`session` text NOT NULL,
						`fule` text NOT NULL,
						`tra_allow` text NOT NULL,
						`tall_tax` text NOT NULL,
						`km_total` text NOT NULL,
						`session_total` text NOT NULL,
						`total` text NOT NULL,
						`message` text NOT NULL,
						`rcbook` text NOT NULL,
						PRIMARY KEY (`id`)
					)';
			if($this->year->query($query)){
				$this->session->set_flashdata('msg', 'File Successfully Added');
	        	redirect(base_url().'squad');
        	}
        	else{

        		$this->db->where('id',$file_id);
        		$this->db->delete('file');
        		$this->session->set_flashdata('error', 'Error In Add File Please Try Again');
        		redirect(base_url().'squad');
        	}
		}
		else{

			$this->session->set_flashdata('error', 'Error In Add File Please Try Again');
        	redirect(base_url().'squad');

		}

	}


	public function add_data($id = false)
	{
		if(!check_right('5')){
			redirect(base_url('error404'));
		}
		if($id){
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$data['_id']			= $id;
				$data['_title']			= 'Squad - File-'.$data['file']['no'];
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				
				if($data['old_data_num'] > 0){
					$this->load->template('squad/edit_data',$data);
				}else{
					$this->load->template('squad/add_data',$data);
				}
			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}
	}

	public function view_data($id = false)
	{
		if(!check_right('6')){
			redirect(base_url('error404'));
		}
		if($id){
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$data['_title']			= 'Squad - File-'.$data['file']['no'];
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit','acc_code !=' => ''])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				
				if($data['old_data_num'] > 0){
					$this->load->template('squad/view',$data);
				}else{
					$this->session->set_flashdata('error', 'No Data Found');
		        	redirect(base_url().'squad');
				}
			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}
	}

	public function view_data_print($id = false)
	{
		if($id){
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$data['_title']			= 'Squad - File-'.$data['file']['no'];
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit','acc_code !=' => ''])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				
				if($data['old_data_num'] > 0){
					$this->load->view('squad/view_user_print',$data);
				}else{
					$this->session->set_flashdata('error', 'No Data Found');
		        	redirect(base_url().'squad');
				}
			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}
	}





	public function acc_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->professor_model->acc_autocom($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label'         => $row->acc_code.' - '.$row->name.' - '.$row->acno,
                    'value'			=> $row->acc_code,
                    'name'         	=> $row->name,
                    'acno'         	=> $row->acno,
                    'bnk'         	=> $row->bank_short_name,
                    'ifsc'         	=> $row->ifsc,
                    'branch'         => $row->branch,
                    'fule'         => $row->fule,
                    'rcbook'         => $row->rcbook
             	);
                echo json_encode($arr_result);
            }
        }
    }

    public function course_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->professor_model->course_autocom($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label'         => $row->name,
                    'paprate'      	=> $row->squad_price
             	);
                echo json_encode($arr_result);
            }
        }
    }




    public function ajax_submit()
    {
    	


    	if($this->year->get($this->input->post('file_name'))->num_rows() > 0)
    	{
    		$this->year->query('TRUNCATE TABLE '.$this->input->post('file_name'));    	
    	}

    	
    	foreach ($this->input->post('bill_id') as $key => $value) {
    		
    		$data 	=	[
    						'bill_no'		=>	$this->input->post('bill_id')[$key],
    						'acc_code'		=>	$this->input->post('acc_code')[$key],
    						'name'			=>	$this->input->post('name')[$key],
    						'ac_no'			=>	$this->input->post('acno')[$key],
    						'bank'			=>	$this->input->post('bank')[$key],
    						'ifsc'			=>	$this->input->post('ifsc')[$key],
    						'branch'		=>	$this->input->post('branch')[$key],
    						'date'			=>	$this->input->post('date')[$key],
    						'km'			=>	$this->input->post('tot_km')[$key],
    						'session'		=>	$this->input->post('session')[$key],
    						'fule'			=>	$this->input->post('fule')[$key],
    						'tra_allow'		=>	$this->input->post('ta')[$key],
    						'tall_tax'		=>	$this->input->post('talltax')[$key],
    						'km_total'		=>	$this->input->post('km_total_amount')[$key],
    						'session_total'	=>	$this->input->post('session_total_amount')[$key],
    						'total'			=>	$this->input->post('row_total')[$key],
    						'type'			=>	$this->input->post('type')[$key],
    						'message'		=>	$this->input->post('message')[$key],
    						'rcbook'		=>	$this->input->post('rcbook')[$key]
    					];


    		$this->year->insert($this->input->post('file_name'),$data);

    	}




    }


    public function bank_download($id = false)
    {
    	if(!check_right('10')){
			redirect(base_url('error404'));
		}

    	if($id){

			if($this->general_model->get_original_file($id,'2'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$year_active  = $this->session->userdata('year');
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				$where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'";
				$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$data['file']['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows();

				if($dis_acc > 0){


			        $spreadsheet = new Spreadsheet();
			        $objDrawing = new Drawing();

			        $spreadsheet->getProperties()->setCreator('BKNMU - Powered By - Kava Developers')
				        ->setLastModifiedBy('BKNMU')
				        ->setTitle('Squad')
				        ->setSubject('File-'.$data['file']['no'])
				        ->setDescription('Squad - '.'File-'.$data['file']['no'])
				        ->setCategory('Bank Copy');

				    $sheet = $spreadsheet->getActiveSheet()->setTitle("Bank Copy");
			        
			        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);


			        $headers = ['A1' => 'C/D','B1' => 'Amt','C1' => 'Ifsc Code','D1' => 'Account No.','E1' => 'Saving Or Current','F1' => 'Name Of Person','G1' => 'Address','H1' => 'Message'];

			        foreach($headers as $clm => $head){

				        $sheet->setCellValue($clm, $head);
				        $sheet->getStyle($clm)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle($clm)->getFont()->setSize(12)->setBold(true);

				    }

				    $add_borders = ['A1','B1','C1','D1','E1','F1','G1','H1'];

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



				    $dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$data['file']['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->result_array();
				    

				    $main_total = 0;
				    $counter = 2;
				    foreach ($dis_acc as $single => $acc) {

				    	
				    	$Bills = $this->year->query("SELECT `bill_no` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where ORDER BY `id` ASC")->result_array(); 

                        $bill_all = "";
                        foreach ($Bills as $keya => $valuea) {
                            $bill_all .= $valuea['bill_no'].',';
                        } $bill_all = rtrim($bill_all,',');

                        
                        $res_rows = $this->year->query("SELECT * FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0]; 




         				$amount = $this->year->query("SELECT SUM(total) AS `bills_tot` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0];

         				$main_total +=  $amount['bills_tot'];


         				$sheet->setCellValue('A'.$counter,$res_rows['type']);
				        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('A'.$counter)->getFont()->setSize(10);

				        $sheet->setCellValue('B'.$counter,$amount['bills_tot']);
				        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
				        $sheet->getStyle('B'.$counter)->getFont()->setSize(10);

				        
				        $sheet->setCellValue('C'.$counter,$res_rows['ifsc']);
				        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('C'.$counter)->getFont()->setSize(10);

				        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
					    	->setValueExplicit(
					        $res_rows['ac_no'],
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
						);

				       
				        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
				        $sheet->getStyle('D'.$counter)->getFont()->setSize(10);
				        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
				      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
				      	//->getNumberFormat()
    					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
				        

				        $sheet->setCellValue('E'.$counter,'10');
				        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('E'.$counter)->getFont()->setSize(10);

				        $sheet->setCellValue('F'.$counter,$res_rows['name']);
				        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('F'.$counter)->getFont()->setSize(10);
                        
                        $sheet->setCellValue('G'.$counter,$res_rows['branch']);
				        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('G'.$counter)->getFont()->setSize(10);

				        $sheet->setCellValue('H'.$counter,$res_rows['message']);
				        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

				        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

				        for($i = 0;$i < count($brd_row);$i++){

					        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
					    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
							$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
					    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
							$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
					    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
							$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
			    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                        }

                        $counter++;
				    }

				    $debit_bank = $this->config->config["debit_bank"];
				   	

			        $sheet->setCellValue('A'.$counter,'D');
			        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('A'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('B'.$counter,$main_total);
			        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			        $sheet->getStyle('B'.$counter)->getFont()->setSize(10)->setBold(true);

			        
			        $sheet->setCellValue('C'.$counter,$debit_bank['ifsc']);
			        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('C'.$counter)->getFont()->setSize(10)->setBold(true);

			        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
				    	->setValueExplicit(
				        $debit_bank['acno'],
				        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
					);

			       
			        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			        $sheet->getStyle('D'.$counter)->getFont()->setSize(10)->setBold(true);
			        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
			      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
			      	//->getNumberFormat()
					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
			        

			        $sheet->setCellValue('E'.$counter,'11');
			        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('E'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('F'.$counter,$debit_bank['name']);
			        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('F'.$counter)->getFont()->setSize(10)->setBold(true);
                    
                    $sheet->setCellValue('G'.$counter,$debit_bank['branch']);
			        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('G'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('H'.$counter,"");
			        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

			        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

			        for($i = 0;$i < count($brd_row);$i++){

				        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
		    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
			        
			        $writer = new Xlsx($spreadsheet);
			 
			        $filename = 'Squad Bank Copy-File-'.$data['file']['no'].'('.$year_active.') '.date('d-M-y h i A');
			 
			        header('Content-Type: application/vnd.ms-excel');
			        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			        header('Cache-Control: max-age=0');
			        
			        $writer->save('php://output');


			    }else{
					$this->session->set_flashdata('error', 'No Data Found');
		        	redirect(base_url().'squad');
				}

		    }
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}

 
    }


    public function corp_download($id = false)
    {
    	if(!check_right('11')){
			redirect(base_url('error404'));
		}
    	if($id){
    		
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['file']			= $this->general_model->get_original_file($id,'2')[0];

				$year_active  = $this->session->userdata('year');
				$data['old_data_num']	= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->num_rows();
				$data['old_data']		= $this->year->get_where($data['file']['file_name'],['bill_no !=' => 'Credit'])->result_array();
				$data['last_row']		= $this->year->get_where($data['file']['file_name'],['bill_no' => 'Credit'])->result_array();
				$where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'";
				$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$data['file']['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows();

				if($dis_acc > 0){


			        $spreadsheet = new Spreadsheet();
			        $objDrawing = new Drawing();

			        $spreadsheet->getProperties()->setCreator('BKNMU - Powered By - Kava Developers')
				        ->setLastModifiedBy('BKNMU')
				        ->setTitle('Squad')
				        ->setSubject('File-'.$data['file']['no'])
				        ->setDescription('Squad - '.'File-'.$data['file']['no'])
				        ->setCategory('Corporation Bank Copy');

				    $sheet = $spreadsheet->getActiveSheet()->setTitle("Corporation Bank Copy");
			        
			        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
			        $spreadsheet->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);


			        $headers = ['A1' => 'C/D','B1' => 'Amt','C1' => 'Ifsc Code','D1' => 'Account No.','E1' => 'Saving Or Current','F1' => 'Name Of Person','G1' => 'Address','H1' => 'Message'];

			        foreach($headers as $clm => $head){

				        $sheet->setCellValue($clm, $head);
				        $sheet->getStyle($clm)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle($clm)->getFont()->setSize(12)->setBold(true);

				    }

				    $add_borders = ['A1','B1','C1','D1','E1','F1','G1','H1'];

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



				    $dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$data['file']['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->result_array();
				    

				    $main_total = 0;
				    $counter = 2;
				    foreach ($dis_acc as $single => $acc) {

				    	
				    	$Bills = $this->year->query("SELECT `bill_no` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where ORDER BY `id` ASC")->result_array(); 

                        $bill_all = "";
                        foreach ($Bills as $keya => $valuea) {
                            $bill_all .= $valuea['bill_no'].',';
                        } $bill_all = rtrim($bill_all,',');

                        
                        $res_rows = $this->year->query("SELECT * FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0]; 




         				$amount = $this->year->query("SELECT SUM(total) AS `bills_tot` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0];

         				$main_total +=  $amount['bills_tot'];


         				$sheet->setCellValue('A'.$counter,$res_rows['type']);
				        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('A'.$counter)->getFont()->setSize(10);

				        $sheet->setCellValue('B'.$counter,$amount['bills_tot']);
				        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
				        $sheet->getStyle('B'.$counter)->getFont()->setSize(10);

				        
				        $sheet->setCellValue('C'.$counter,$res_rows['ifsc']);
				        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('C'.$counter)->getFont()->setSize(10);

				        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
					    	->setValueExplicit(
					        $res_rows['ac_no'],
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
						);

				       
				        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
				        $sheet->getStyle('D'.$counter)->getFont()->setSize(10);
				        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
				      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
				      	//->getNumberFormat()
    					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
				        

				        $sheet->setCellValue('E'.$counter,'10');
				        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('E'.$counter)->getFont()->setSize(10);

				        $sheet->setCellValue('F'.$counter,$res_rows['name']);
				        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('F'.$counter)->getFont()->setSize(10);
                        
                        $sheet->setCellValue('G'.$counter,$res_rows['branch']);
				        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('G'.$counter)->getFont()->setSize(10);

				        $sheet->setCellValue('H'.$counter,$res_rows['message']);
				        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
				        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

				        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

				        for($i = 0;$i < count($brd_row);$i++){

					        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
					    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
							$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
					    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
							$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
					    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
							$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
			    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                        }

                        $counter++;
				    }

				    $debit_bank = $this->config->config["debit_bank"];
				   	

			        $sheet->setCellValue('A'.$counter,'D');
			        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('A'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('B'.$counter,$main_total);
			        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			        $sheet->getStyle('B'.$counter)->getFont()->setSize(10)->setBold(true);

			        
			        $sheet->setCellValue('C'.$counter,$debit_bank['ifsc']);
			        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('C'.$counter)->getFont()->setSize(10)->setBold(true);

			        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
				    	->setValueExplicit(
				        $debit_bank['acno'],
				        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
					);

			       
			        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			        $sheet->getStyle('D'.$counter)->getFont()->setSize(10)->setBold(true);
			        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
			      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
			      	//->getNumberFormat()
					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
			        

			        $sheet->setCellValue('E'.$counter,'11');
			        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('E'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('F'.$counter,$debit_bank['name']);
			        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('F'.$counter)->getFont()->setSize(10)->setBold(true);
                    
                    $sheet->setCellValue('G'.$counter,$debit_bank['branch']);
			        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('G'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('H'.$counter,"");
			        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

			        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

			        for($i = 0;$i < count($brd_row);$i++){

				        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
		    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
			        
			        $writer = new Xlsx($spreadsheet);
			 
			        $filename = 'Squad Corporation Bank Copy-File-'.$data['file']['no'].'('.$year_active.') '.date('d-M-y h i A');
			 
			        header('Content-Type: application/vnd.ms-excel');
			        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			        header('Cache-Control: max-age=0');
			        
			        $writer->save('php://output');


			    }else{
					$this->session->set_flashdata('error', 'No Data Found');
		        	redirect(base_url().'squad');
				}

		    }
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}

 
    }




    public function print_bank($id = false)
    {
    	if(!check_right('8')){
			redirect(base_url('error404'));
		}
    	if($id){
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['_title']				= "Print Bank Copy";
				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$this->load->view('squad/bank_print',$data);

			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}
    }

    public function view_bills($id = false)
    {
    	if(!check_right('7')){
			redirect(base_url('error404'));
		}
    	if($id){
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['_title']				= "View Bills";
				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$this->load->template('squad/view_bills',$data);

			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}
    }

    public function print_corp_bank($id = false)
    {
    	if(!check_right('9')){
			redirect(base_url('error404'));
		}
    	if($id){
			if($this->general_model->get_original_file($id,'2'))
			{

				$data['_title']				= "Print Bank Copy";
				$data['file']			= $this->general_model->get_original_file($id,'2')[0];
				$this->load->view('squad/corp_bank_print',$data);

			}
			else{
				$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
			}
		}
		else{
			
			$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
			
		}
    }


    public function view_all_bank()
    {
    	if(!check_right('4')){
			redirect(base_url('error404'));
		}
    	$data['_title']			= "View All Data";
    	$data['files']				= $this->general_model->get_all_files('1',$this->session->userdata('year'));
		$this->load->template('squad/view_all_bills',$data);
    }

    public function export_all_bank()
    {
    	if(!check_right('2')){
			redirect(base_url('error404'));
		}
    	$year_active  	= $this->session->userdata('year');
    	$data['files']	= $this->general_model->get_all_files('1',$this->session->userdata('year'));
    	if($data['files'])
    	{

    		$aa = 0;
	    	foreach ($data['files'] as $key => $file_row) {

	    		$where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'";
				$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$file_row['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows();

				if($dis_acc > 0){

					$aa++;

				}
	    	}



	    	if($aa > 0){

	    		$spreadsheet = new Spreadsheet();
		        $objDrawing = new Drawing();

		        $spreadsheet->getProperties()->setCreator('BKNMU - Powered By - Kava Developers')
			        ->setLastModifiedBy('BKNMU')
			        ->setTitle('Squad')
			        ->setSubject($this->session->userdata('year'))
			        ->setDescription('Squad - '.$this->session->userdata('year'))
			        ->setCategory('Bank Copy');

			    $sheet = $spreadsheet->getActiveSheet()->setTitle("Bank Copy");
		        
		        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);


		        $headers = ['A1' => 'C/D','B1' => 'Amt','C1' => 'Ifsc Code','D1' => 'Account No.','E1' => 'Saving Or Current','F1' => 'Name Of Person','G1' => 'Address','H1' => 'Message'];

		        foreach($headers as $clm => $head){

			        $sheet->setCellValue($clm, $head);
			        $sheet->getStyle($clm)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle($clm)->getFont()->setSize(12)->setBold(true);

			    }

			    $add_borders = ['A1','B1','C1','D1','E1','F1','G1','H1'];

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
		    	$main_total = 0;
		    	$counter = 2;
	    		foreach ($data['files'] as $key => $file_row) {

	    			$data['file']['file_name'] = $file_row['file_name'];

		    		$where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'";
					$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$file_row['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows();
					
					if($dis_acc > 0){

						$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$data['file']['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->result_array();
				    

				    
				    
					    foreach ($dis_acc as $single => $acc) {

					    	
					    	$Bills = $this->year->query("SELECT `bill_no` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where ORDER BY `id` ASC")->result_array(); 

	                        $bill_all = "";
	                        foreach ($Bills as $keya => $valuea) {
	                            $bill_all .= $valuea['bill_no'].',';
	                        } $bill_all = rtrim($bill_all,',');

	                        
	                        $res_rows = $this->year->query("SELECT * FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0]; 




	         				$amount = $this->year->query("SELECT SUM(total) AS `bills_tot` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0];

	         				$main_total +=  $amount['bills_tot'];


	         				$sheet->setCellValue('A'.$counter,$res_rows['type']);
					        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('A'.$counter)->getFont()->setSize(10);

					        $sheet->setCellValue('B'.$counter,$amount['bills_tot']);
					        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
					        $sheet->getStyle('B'.$counter)->getFont()->setSize(10);

					        
					        $sheet->setCellValue('C'.$counter,$res_rows['ifsc']);
					        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('C'.$counter)->getFont()->setSize(10);

					        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
						    	->setValueExplicit(
						        $res_rows['ac_no'],
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
							);

					       
					        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
					        $sheet->getStyle('D'.$counter)->getFont()->setSize(10);
					        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
					      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
					      	//->getNumberFormat()
	    					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
					        

					        $sheet->setCellValue('E'.$counter,'10');
					        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('E'.$counter)->getFont()->setSize(10);

					        $sheet->setCellValue('F'.$counter,$res_rows['name']);
					        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('F'.$counter)->getFont()->setSize(10);
	                        
	                        $sheet->setCellValue('G'.$counter,$res_rows['branch']);
					        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('G'.$counter)->getFont()->setSize(10);

					        $sheet->setCellValue('H'.$counter,$res_rows['message']);
					        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

					        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

					        for($i = 0;$i < count($brd_row);$i++){

						        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
						    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
								$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
						    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
								$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
						    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
								$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	                        }

	                        $counter++;
					    }


					}
		    	}



		    		$debit_bank = $this->config->config["debit_bank"];
				   	

			        $sheet->setCellValue('A'.$counter,'D');
			        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('A'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('B'.$counter,$main_total);
			        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			        $sheet->getStyle('B'.$counter)->getFont()->setSize(10)->setBold(true);

			        
			        $sheet->setCellValue('C'.$counter,$debit_bank['ifsc']);
			        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('C'.$counter)->getFont()->setSize(10)->setBold(true);

			        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
				    	->setValueExplicit(
				        $debit_bank['acno'],
				        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
					);

			       
			        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			        $sheet->getStyle('D'.$counter)->getFont()->setSize(10)->setBold(true);
			        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
			      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
			      	//->getNumberFormat()
					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
			        

			        $sheet->setCellValue('E'.$counter,'11');
			        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('E'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('F'.$counter,$debit_bank['name']);
			        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('F'.$counter)->getFont()->setSize(10)->setBold(true);
                    
                    $sheet->setCellValue('G'.$counter,$debit_bank['branch']);
			        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('G'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('H'.$counter,"");
			        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

			        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

			        for($i = 0;$i < count($brd_row);$i++){

				        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
		    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
			        
			        $writer = new Xlsx($spreadsheet);
			 
			        $filename = 'Squad Bank Copy-('.$year_active.') '.date('d-M-y h i A');
			 
			        header('Content-Type: application/vnd.ms-excel');
			        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			        header('Cache-Control: max-age=0');
			        
			        $writer->save('php://output');




	    	}
	    	else{
	    		$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
	    	}
    	}
    	else{
    		$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
    	}

    }


    public function export_all_corp()
    {
    	if(!check_right('3')){
			redirect(base_url('error404'));
		}
    	$year_active  	= $this->session->userdata('year');
    	$data['files']	= $this->general_model->get_all_files('1',$this->session->userdata('year'));
    	if($data['files'])
    	{

    		$aa = 0;
	    	foreach ($data['files'] as $key => $file_row) {

	    		$where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'";
				$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$file_row['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows();

				if($dis_acc > 0){

					$aa++;

				}
	    	}



	    	if($aa > 0){

	    		$spreadsheet = new Spreadsheet();
		        $objDrawing = new Drawing();

		        $spreadsheet->getProperties()->setCreator('BKNMU - Powered By - Kava Developers')
			        ->setLastModifiedBy('BKNMU')
			        ->setTitle('Squad')
			        ->setSubject($this->session->userdata('year'))
			        ->setDescription('Squad - '.$this->session->userdata('year'))
			        ->setCategory('Corporation Bank Copy');

			    $sheet = $spreadsheet->getActiveSheet()->setTitle("Corporation Bank Copy");
		        
		        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
		        $spreadsheet->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);


		        $headers = ['A1' => 'C/D','B1' => 'Amt','C1' => 'Ifsc Code','D1' => 'Account No.','E1' => 'Saving Or Current','F1' => 'Name Of Person','G1' => 'Address','H1' => 'Message'];

		        foreach($headers as $clm => $head){

			        $sheet->setCellValue($clm, $head);
			        $sheet->getStyle($clm)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle($clm)->getFont()->setSize(12)->setBold(true);

			    }

			    $add_borders = ['A1','B1','C1','D1','E1','F1','G1','H1'];

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
		    	$main_total = 0;
		    	$counter = 2;
	    		foreach ($data['files'] as $key => $file_row) {

	    			$data['file']['file_name'] = $file_row['file_name'];

		    		$where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'";
					$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$file_row['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows();
					
					if($dis_acc > 0){

						$dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$data['file']['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->result_array();
				    

				    
				    
					    foreach ($dis_acc as $single => $acc) {

					    	
					    	$Bills = $this->year->query("SELECT `bill_no` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where ORDER BY `id` ASC")->result_array(); 

	                        $bill_all = "";
	                        foreach ($Bills as $keya => $valuea) {
	                            $bill_all .= $valuea['bill_no'].',';
	                        } $bill_all = rtrim($bill_all,',');

	                        
	                        $res_rows = $this->year->query("SELECT * FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0]; 




	         				$amount = $this->year->query("SELECT SUM(total) AS `bills_tot` FROM `".$data['file']['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0];

	         				$main_total +=  $amount['bills_tot'];


	         				$sheet->setCellValue('A'.$counter,$res_rows['type']);
					        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('A'.$counter)->getFont()->setSize(10);

					        $sheet->setCellValue('B'.$counter,$amount['bills_tot']);
					        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
					        $sheet->getStyle('B'.$counter)->getFont()->setSize(10);

					        
					        $sheet->setCellValue('C'.$counter,$res_rows['ifsc']);
					        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('C'.$counter)->getFont()->setSize(10);

					        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
						    	->setValueExplicit(
						        $res_rows['ac_no'],
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
							);

					       
					        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
					        $sheet->getStyle('D'.$counter)->getFont()->setSize(10);
					        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
					      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
					      	//->getNumberFormat()
	    					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
					        

					        $sheet->setCellValue('E'.$counter,'10');
					        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('E'.$counter)->getFont()->setSize(10);

					        $sheet->setCellValue('F'.$counter,$res_rows['name']);
					        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('F'.$counter)->getFont()->setSize(10);
	                        
	                        $sheet->setCellValue('G'.$counter,$res_rows['branch']);
					        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('G'.$counter)->getFont()->setSize(10);

					        $sheet->setCellValue('H'.$counter,$res_rows['message']);
					        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
					        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

					        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

					        for($i = 0;$i < count($brd_row);$i++){

						        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
						    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
								$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
						    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
								$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
						    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
								$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	                        }

	                        $counter++;
					    }


					}
		    	}



		    		$debit_bank = $this->config->config["debit_bank"];
				   	

			        $sheet->setCellValue('A'.$counter,'D');
			        $sheet->getStyle('A'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('A'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('B'.$counter,$main_total);
			        $sheet->getStyle('B'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			        $sheet->getStyle('B'.$counter)->getFont()->setSize(10)->setBold(true);

			        
			        $sheet->setCellValue('C'.$counter,$debit_bank['ifsc']);
			        $sheet->getStyle('C'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('C'.$counter)->getFont()->setSize(10)->setBold(true);

			        $spreadsheet->getActiveSheet()->getCell('D'.$counter)
				    	->setValueExplicit(
				        $debit_bank['acno'],
				        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
					);

			       
			        $sheet->getStyle('D'.$counter)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			        $sheet->getStyle('D'.$counter)->getFont()->setSize(10)->setBold(true);
			        //$sheet->setCellValue('E'.$counter,"'".$res_rows['ac_no']);
			      	//$spreadsheet->getActiveSheet()->getStyle('E'.$counter)
			      	//->getNumberFormat()
					// ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
			        

			        $sheet->setCellValue('E'.$counter,'11');
			        $sheet->getStyle('E'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('E'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('F'.$counter,$debit_bank['name']);
			        $sheet->getStyle('F'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('F'.$counter)->getFont()->setSize(10)->setBold(true);
                    
                    $sheet->setCellValue('G'.$counter,$debit_bank['branch']);
			        $sheet->getStyle('G'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('G'.$counter)->getFont()->setSize(10)->setBold(true);

			        $sheet->setCellValue('H'.$counter,"");
			        $sheet->getStyle('H'.$counter)->getAlignment()->setHorizontal('center')->setVertical('center');
			        $sheet->getStyle('H'.$counter)->getFont()->setSize(10);

			        $brd_row = ['A'.$counter,'B'.$counter,'C'.$counter,'D'.$counter,'E'.$counter,'F'.$counter,'G'.$counter,'H'.$counter];

			        for($i = 0;$i < count($brd_row);$i++){

				        $spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
				    		->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$spreadsheet->getActiveSheet()->getStyle($brd_row[$i])
		    				->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
			        
			        $writer = new Xlsx($spreadsheet);
			 
			        $filename = 'Squad Corporation Bank Copy-('.$year_active.') '.date('d-M-y h i A');
			 
			        header('Content-Type: application/vnd.ms-excel');
			        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			        header('Cache-Control: max-age=0');
			        
			        $writer->save('php://output');




	    	}
	    	else{
	    		$this->session->set_flashdata('error', 'File Not Found');
		        redirect(base_url().'squad');
	    	}
    	}
    	else{
    		$this->session->set_flashdata('error', 'File Not Found');
	        redirect(base_url().'squad');
    	}

    }

}
