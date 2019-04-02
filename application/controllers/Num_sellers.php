<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Num_sellers extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('purchase');
        $this->load->model('users');
        $this->load->model('transaction_model');
        $this->load->model('expense_model');
    }


	public function index()
	{
		
		$data['page_title']	= 'Manage Purchase';
		$data['purchase'] = $this->purchase->all_purchase();
		$this->load->template('agreement_detail/index',$data);
	}

	//  For Print Data
	public function purchase_print($id = false){
		if($id)
		{
			if($this->purchase->single_purchase($id)[0])
			{
				$data['page_title']	= 'Purchase';
						
						$data['all_seller_dynamic'] = $this->purchase->all_seller_dynamic($id);
						$data['all_purchaser_dynamic'] = $this->purchase->all_purchaser_dynamic($id);
						$data['purchase_land_detail'] = $this->purchase->purchase_land_detail($id);
						$data['single_purchase'] = $this->purchase->single_purchase($id);
						
						$data['installment_detail'] = $this->purchase->installment_detail_asc($id);
						
				$this->load->view('agreement_detail/print',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Purchase Not Found');
	        	redirect(base_url().'num_sellers');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Purchase Not Found');
	        redirect(base_url().'num_sellers');
		}
	}

	public function print_short($id = false){
		if($id)
		{
			if($this->purchase->single_purchase($id)[0])
			{
				$data['page_title']	= 'Purchase';
						
						$data['all_seller_dynamic'] = $this->purchase->all_seller_dynamic($id);
						$data['all_purchaser_dynamic'] = $this->purchase->all_purchaser_dynamic($id);
						$data['purchase_land_detail'] = $this->purchase->purchase_land_detail($id);
						$data['single_purchase'] = $this->purchase->single_purchase($id);
						
						$data['installment_detail'] = $this->purchase->installment_detail_asc($id);
						
				$this->load->view('agreement_detail/print_short',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Purchase Not Found');
	        	redirect(base_url().'num_sellers');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Purchase Not Found');
	        redirect(base_url().'num_sellers');
		}
	}


	//  For Pdf Data
	public function pdf($id = false){
		if($id)
		{
			if($this->purchase->single_purchase($id)[0])
			{
				$data['page_title']	= 'Purchase Pdf';
						
						$data['all_seller_dynamic'] = $this->purchase->all_seller_dynamic($id);
						$data['all_purchaser_dynamic'] = $this->purchase->all_purchaser_dynamic($id);
						$data['purchase_land_detail'] = $this->purchase->purchase_land_detail($id);
						$data['single_purchase'] = $this->purchase->single_purchase($id);
						$data['installment_detail'] = $this->purchase->installment_detail_asc($id);
						$this->load->library('pdf');
						$filename = "Document_name";
						$html = $this->load->view('agreement_detail/pdf', $data, TRUE);
						$this->pdf->create($html, $filename);
			}
			else{
				$this->session->set_flashdata('error', 'Purchase Not Found');
	        	redirect(base_url().'num_sellers');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Purchase Not Found');
	        redirect(base_url().'num_sellers');
		}
	}

	//  For View Data
	public function view($id = false){
		if($id)
		{
			if($this->purchase->single_purchase($id)[0])
			{
				$data['page_title']	= 'Purchase View';
						
						$data['all_seller_dynamic'] = $this->purchase->all_seller_dynamic($id);
						$data['all_purchaser_dynamic'] = $this->purchase->all_purchaser_dynamic($id);
						$data['purchase_land_detail'] = $this->purchase->purchase_land_detail($id);
						$data['single_purchase'] = $this->purchase->single_purchase($id);
						$data['installment_detail'] = $this->purchase->installment_detail_asc($id);
						
				$this->load->template('agreement_detail/view',$data);
			}
			else{
				$this->session->set_flashdata('error', 'Purchase Not Found');
	        	redirect(base_url().'num_sellers');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Purchase Not Found');
	        redirect(base_url().'num_sellers');
		}
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Add Seller
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function add()
	{
		$data['page_title']	= 'Add Purchase';
		$this->load->model('my_custom_func_model');
		$Parterners = [];
		$Parterners[] = ['id' => 0,'user_type_id' => 'company','fullname' => 'Champs'];
		foreach ($this->transaction_model->all_business() as $key => $value) {
			$Parterners[] = ['id' => $value['id'],'user_type_id' => $value['user_type_id'],'fullname' => $this->transaction_model->get_business_name($value['id'])];
		}

		$data['Parterners'] = $Parterners;


		$this->load->template('agreement_detail/add',$data);


	}

	public function save(){

		$purchase_insert = array(
	        'num_of_sellers'      => 	$this->input->post('num_of_saller'),
	        'num_of_purchaser'    => 	$this->input->post('num_of_purchaser'),
	        'purchase_id'		  =>	$this->input->post('purchase_id'),
			'date'		          =>	date('Y-m-d',strtotime($this->input->post('purchase_date'))),
	        'install_packges'	  =>	$this->input->post('install_packges'),
	        'no_of_installment'	  =>	$this->input->post('no_of_installment'),
	        'time_installment'	  =>	$this->input->post('time'),
	        'conditions'	      =>	$this->input->post('conditions'),
	        'purchase_amount'	  =>	$this->input->post('purchase_amount'),
	        'adva_payment'	      =>	$this->input->post('adva_payment'),
	        'bal_amount'	      =>	$this->input->post('bal_amount'),
	        
	        'rem_land_yrd'	      =>	$this->input->post('total_land_yrd'),
	        'rem_land_ht'	      =>	$this->input->post('total_land'),
	        'rem_land_sqft'	      =>	$this->input->post('lan_size'),
	        
	        'created_by'		  =>	$this->session->userdata('id'),
	        'updated_by'		  =>	$this->session->userdata('id'),
			'created_at'          => 	date('Y-m-d H:i:s'),
	        'updated_at'          => 	date('Y-m-d H:i:s'),
	        'w_name'         	  => 	$this->input->post('witness_name'),
	        'w_mobile'         	  => 	$this->input->post('witness_mobile'),
	        'w_address'           => 	$this->input->post('witness_address'),
	        'w2_name'         	  => 	$this->input->post('witness_name2'),
	        'w2_mobile'           => 	$this->input->post('witness_mobile2'),
	        'w2_add'          => 	$this->input->post('witness_address2')
		);

		$this->db->insert('purchase', $purchase_insert);
		$insert_id = $this->db->insert_id();

		foreach ($this->input->post('name') as $key => $val) {

			$path = $_FILES['my_image']['name'][$key];
			$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
			
			$_FILES['newfile']['name'] = $_FILES['my_image']['name'][$key];
			$_FILES['newfile']['type'] = $_FILES['my_image']['type'][$key];
			$_FILES['newfile']['tmp_name'] = $_FILES['my_image']['tmp_name'][$key];
			$_FILES['newfile']['error'] = $_FILES['my_image']['error'][$key];
			$_FILES['newfile']['size'] = $_FILES['my_image']['size'][$key];
			$config['upload_path'] = './uploads/';
			$config['file_name'] = $newName;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '800000000';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('newfile');

			$purchase_insert = array(
		        'name'           => 	$this->input->post('name')[$key],
				'gur_type'       => 	$this->input->post('gur_type')[$key],
				'gur_name'       => 	$this->input->post('gur_name')[$key],
		        'address'        => 	$this->input->post('address')[$key],
		        'state'          => 	$this->input->post('state')[$key],
		        'bank'           => 	$this->input->post('bank')[$key],
		        'ac_number'      => 	$this->input->post('ac_number')[$key],
		        'ifsc_code'      => 	$this->input->post('ifsc_code')[$key],
		        'email'		  	 => 	$this->input->post('email')[$key],
		        'mobile'		 =>		$this->input->post('mobile')[$key],
		        'proof_type'	 =>		$this->input->post('proof_type')[$key],
		        'proof_num'		 =>		$this->input->post('proof_num')[$key],
		        'my_image'		 =>		$newName,
		        'main_id' 		 =>		$insert_id,
		        'share'		 	 =>		$this->input->post('share_amount')[$key],
		        'advance'		 =>		$this->input->post('advance_pay')[$key],
		        'balance'		 =>		$this->input->post('share_amount')[$key] - $this->input->post('advance_pay')[$key],
		        'p_id'           =>		$this->input->post('purchase_id')
		    );

			$this->db->insert('purchase_seller_dynamic', $purchase_insert);
			$purchase_insert_id = $insert_id;
			$seller_id = $this->db->insert_id();
				//// installment
					
					$date = $this->input->post('purchase_date');
					$time = $this->input->post('time');	// Time(montyly, quertly etc..)
					$plus_time;
					if($time == 'Monthly')
					{
						$plus_time = '1';
					}
					else if($time == 'Quarterly')
					{
						$plus_time = '3';
					}
					else if($time == 'Half Yearly')
					{
						$plus_time = '6';
					}
					else if($time == 'Yearly')
					{
						$plus_time = '12';
					}

					$no_install = $this->input->post('no_of_installment');	
					$instal_pk = floatval($this->input->post('share_amount')[$key] - $this->input->post('advance_pay')[$key]);	

					if($instal_pk > 0)
					{
						$installment = $instal_pk / $no_install;

						$new_date = strtotime($date);
						$rem_amount = floatval($this->input->post('share_amount')[$key] - $this->input->post('advance_pay')[$key]);
						
						for($i=1; $i <= $no_install; $i++){
							
							$rem_amount -= $installment;
							$new_date = strtotime("+".$plus_time." months", $new_date);
							
							$instal_detail = array(
								'install_packges'   =>	$this->input->post('install_packges'),	
								'no_of_installment' =>	$i, 
								'time'   			=>	$this->input->post('time'),				
								'deal_amount'   	=>	$this->input->post('deal_amount'),		
								'adva_payment'   	=>	$this->input->post('adva_payment'),		
								'instal_amount'   	=>	$installment,				
								'remaining_amount'  =>	$rem_amount,				
								'instl_remaning'  	=>	$installment,				
								'date'   	        =>	date('Y-m-d',$new_date),				
								'purchase_main_id'  =>	$insert_id,
								'saller_id'   		=>	$seller_id
							);
							$this->db->insert('purchase_installment_detail', $instal_detail);
						}	
						
					}
			//// installment
		}


		foreach ($this->input->post('pu_name') as $key => $val) {

			$path = $_FILES['pu_my_image']['name'][$key];
			$newName = md5(microtime(true)).".".pathinfo($path, PATHINFO_EXTENSION); 
			
			$_FILES['newfile']['name'] = $_FILES['pu_my_image']['name'][$key];
			$_FILES['newfile']['type'] = $_FILES['pu_my_image']['type'][$key];
			$_FILES['newfile']['tmp_name'] = $_FILES['pu_my_image']['tmp_name'][$key];
			$_FILES['newfile']['error'] = $_FILES['pu_my_image']['error'][$key];
			$_FILES['newfile']['size'] = $_FILES['pu_my_image']['size'][$key];
			$config['upload_path'] = './uploads/';
			$config['file_name'] = $newName;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '800000000';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('newfile');

			$purchase_insert = array(
		        'pu_name'           => 	 $this->input->post('pu_name')[$key],
				'pu_gur_type'       => 	 $this->input->post('pu_gur_type')[$key],
				'pu_gur_name'       => 	 $this->input->post('pu_gur_name')[$key],
		        'pu_address'        => 	 $this->input->post('pu_address')[$key],
		        'pu_state'          => 	 $this->input->post('pu_state')[$key],
		        'pu_bank'           => 	 $this->input->post('pu_bank')[$key],
		        'pu_ac_number'      =>   $this->input->post('pu_ac_number')[$key],
		        'pu_ifsc_code'      => 	 $this->input->post('pu_ifsc_code')[$key],
		        'pu_email'		  	=> 	 $this->input->post('pu_email')[$key],
		        'pu_mobile'		 	=>	 $this->input->post('pu_mobile')[$key],
		        'pu_proof_type'	 	=>	 $this->input->post('pu_proof_type')[$key],
		        'pu_proof_num'		=>	 $this->input->post('pu_proof_num')[$key],
		        'pu_my_image'		=>	 $newName,
		        'main_id' 		 	=>	 $insert_id
		    );

				$this->db->insert('purchase_purchaser_dynamic', $purchase_insert);
		}



		$land_deail	= array(
			'purchase_id'		=>	$this->input->post('purchase_id'),
			'land_detail'		=>	$this->input->post('land_detail'),
			'mouza'				=>	$this->input->post('mouza'),	
			'tehsil'			=>	$this->input->post('tehsil'),	
			'district'			=>	$this->input->post('district'),	
			'khasra'			=>	$this->input->post('khasra'),	
			'land_type'			=>	$this->input->post('land_type'),	
			'land_location'		=>	$this->input->post('land_location'),	
			'ac_num_land'		=>	$this->input->post('ac_num_land'),
			'total_land_yrd'	=>	$this->input->post('total_land_yrd'),	
			'total_land'		=>	$this->input->post('total_land'),	
			'per_unit_share'	=>	$this->input->post('per_unit_share'),	
			'purchase_amount'	=>	$this->input->post('purchase_amount'),	
			'purchase_date'		=>	date('Y-m-d',strtotime($this->input->post('purchase_date'))),
			'lan_size'			=>	$this->input->post('lan_size'),	
			'adva_payment'		=>	$this->input->post('adva_payment'),	
			'adva_pay_date'		=>	date('Y-m-d',strtotime($this->input->post('adva_pay_date'))),
			'bal_amount'		=>	$this->input->post('bal_amount'),	
			'time_ward_land'	=>	$this->input->post('time_ward_land'),	
			'payment_mode'		=>	$this->input->post('payment_mode'),
			'payment_mode_detail'		=>	$this->input->post('payment_mode_detail'),	
			'purchase_main_id'	=>	$insert_id
		);
						
		$this->db->insert('purchase_land_detail', $land_deail);

							

								
									
								

			foreach ($this->input->post('parter_id') as $key => $value) {
				$transaction = [
					'type'		 	=>	 'purchase',
					'debit'		 	=>	 $this->input->post('paid')[$key],	
					'debit_by'   	=>	 $this->input->post('parter_id')[$key],	
					'date'   	 	=>	 date('Y-m-d',strtotime($this->input->post('purchase_date'))),
					'investment_id' =>	 $purchase_insert_id,	
					'created_by'   	=>	 $this->session->userdata('id'),	
					'created_at'   	=>	date('Y-m-d H:i:s')
				];
				$this->db->insert('transaction', $transaction);
			}

									
			$this->session->set_flashdata('msg', 'Purchase Successfully Added');
			redirect(base_url().'num_sellers');
								
							

			
		
						
	}

	
	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Delete Seller
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function delete($id = false)
	{	

		if($id)
		{
			if($this->purchase->single_purchase($id)[0])
			{

				$this->db->where('id',$id);
				$this->db->delete('purchase');

				$this->db->where('purchase_main_id',$id);
				$this->db->delete('purchase_installment_detail');

				$this->db->where('purchase_main_id',$id);
				$this->db->delete('purchase_land_detail');

					$seller = $this->purchase->all_seller_dynamic($id);
				    $purchase = $this->purchase->all_purchaser_dynamic($id);
					
					foreach($seller as $key => $value) {
						
						if(file_exists('./uploads/'.$value['my_image'])){
							
							unlink('./uploads/'.$value['my_image']);
						
						}
					}
					
					foreach($purchase as $key => $value) {
						
						if(file_exists('./uploads/'.$value['pu_my_image'])){
							
							unlink('./uploads/'.$value['pu_my_image']);

						}
					}

					$this->db->where('main_id',$id);
					$this->db->delete('purchase_purchaser_dynamic');

					$this->db->where('main_id',$id);
					$this->db->delete('purchase_seller_dynamic');

					$this->session->set_flashdata('msg', 'Purchase Successfully Deleted');
	        		redirect(base_url().'num_sellers');
				

		
			}
			else{
				$this->session->set_flashdata('error', 'Purchase Not Found');
	        	redirect(base_url().'num_sellers');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Purchase Not Found');
	        redirect(base_url().'num_sellers');
		}
	}				  								
}