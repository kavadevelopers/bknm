<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Create_product extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->auth->check_session();
        $this->load->model('add_product');
        $this->load->model('setting_model');
        $this->load->model('transaction_model');
	}

	public function index(){
		$data['page_title']	= 'Products';
		$data['get_product_all'] = $this->add_product->get_product_for_index();
		$this->load->template('add_product/index',$data);
	}


	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								Crate / Add  Product
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/


	public function add()
	{
	    $data['page_title']	= 'Create / Add Product';
		$data['get_plan_code'] = $this->setting_model->get_plan_code();
		$data['get_purchase_id'] = $this->add_product->all_purchase();
		$data['location'] = $this->setting_model->get_locations();


		$Parterners = [];
		$Parterners[] = ['id' => 0,'user_type_id' => 'company','fullname' => 'Champs'];
		foreach ($this->transaction_model->all_business() as $key => $value) {
			$Parterners[] = ['id' => $value['id'],'user_type_id' => $value['user_type_id'],'fullname' => $this->transaction_model->get_business_name($value['id'])];
		}

		$data['Parterners'] = $Parterners;

		$this->load->template('add_product/add',$data);
		
		
	}

	public function lan_size()
	{
	    echo json_encode($this->add_product->get_purchase($_POST['id'])[0]);
	}



	/*


	$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

		$this->form_validation->set_rules('purchase_id', 'Purchase Id', 'trim|required|min_length[2]|max_length[240]');
		$this->form_validation->set_rules('total_land_yard', 'Total Land area (in Sq. Yd)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('total_land_ht', 'Total Land area (in Hectares)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('lan_size_sqft', 'Total Land area(in Sq. Ft)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('product_id', 'Product Id', 'trim|required|min_length[2]|max_length[240]|is_unique[create_product.product_id]');
		
		$this->form_validation->set_rules('ploat_land_yard', 'Ploat Size (in Sq. Yd)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('ploat_size_ht', 'Ploat Size (in Hectares)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('ploat_size_sqft', 'Ploat Size (in Sq. Ft)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		
		$this->form_validation->set_rules('rem_land_yrd', 'Reamining Land area (in Sq. Yd)', 'trim|required|max_length[240]');

		$this->form_validation->set_rules('rem_land_ht', 'Reamining Land area (in Hectares)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('rem_land_sqft', 'Reamining Land area(in Sq. Ft)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('ploat_code', 'Ploat Number', 'trim|required|min_length[1]|max_length[240]');
		$this->form_validation->set_rules('plan_code', 'Plan Name', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('selling_amount', 'Selling Amount', 'trim|required|max_length[240]');

		$this->form_validation->set_rules('direct_agent', 'Direct Agent', 'trim|required|decimal');
		$this->form_validation->set_rules('parent_direct_agent', 'Parent Of Direct Agent', 'trim|required|decimal');
		$this->form_validation->set_rules('other_parent', 'Other Parents', 'trim|required|decimal');

	

		
		if ($this->form_validation->run() == FALSE)
		{

				$data['page_title']	= 'Create / Add Product';
			$data['get_plan_code'] = $this->setting_model->get_plan_code();
			$data['get_purchase_id'] = $this->add_product->all_purchase();

			$this->load->template('add_product/add',$data);
		}
		else
		{


	*/

	public function save()
	{



		
		
			
			$insert_product = array(
				'purchase_id'  		 =>    $this->input->post('purchase_id'),
				'total_land_yard'  	 =>    $this->input->post('total_land_yard'),
				'total_land_ht'  	 =>    $this->input->post('total_land_ht'),
				'lan_size_sqft'  	 =>    $this->input->post('lan_size_sqft'),
				'product_id'  		 =>    strtoupper($this->input->post('product_id')),
				'ploat_land_yard'  	 =>    $this->input->post('ploat_land_yard'),
				'ploat_size_ht'  	 =>    $this->input->post('ploat_size_ht'),
				'ploat_size_sqft'  	 =>    $this->input->post('ploat_size_sqft'),
				'date'               =>    date('Y-m-d',strtotime($this->input->post('date'))),
				'rem_land_yrd'       =>    $this->input->post('rem_land_yrd'),
				'rem_land_ht'  		 =>    $this->input->post('rem_land_ht'),
				'rem_land_sqft'  	 =>    $this->input->post('rem_land_sqft'),
				'ploat_code'   		 =>    $this->input->post('ploat_code'),
				'plan_code'   		 =>    $this->input->post('plan_code'),
				'quantity'   		 =>    $this->input->post('quantity'),
				'selling_amount'     =>    $this->input->post('selling_amount'),
				
				'direct_agent'     	 =>    $this->input->post('direct_agent'),
				'parent_direct_agent'=>    $this->input->post('parent_direct_agent'),
				'other_parent'     	 =>    $this->input->post('other_parent'),

				'created_by'         =>    $this->session->userdata('id'),
				'updated_by'         =>    $this->session->userdata('id'),
				'gross'         	 =>    $this->input->post('gross_amount'),
				'location'			 =>    $this->input->post('location'),
				'type'			 	 =>    $this->input->post('type_pro')

			);

			if($this->db->insert('create_product', $insert_product)){
				$insert_id = $this->db->insert_id();
				$rem_lan = [

						'rem_land_yrd'  	 =>    $this->input->post('rem_land_yrd'),
						'rem_land_ht'  		 =>    $this->input->post('rem_land_ht'),
						'rem_land_sqft'  	 =>    $this->input->post('rem_land_sqft'),
				];

				$this->db->where('purchase_id', $this->input->post('purchase_id'));



				foreach ($this->input->post('parter_id') as $key => $value) {

					$parterner = [

							'parterner'  	 =>    $value,
							'amount'  		 =>    $this->input->post('share_amount')[$key],
							'percent'  	 	 =>    $this->input->post('share_per')[$key],
							'product_id'     =>    $insert_id
					];

					$this->db->insert('share_parterner',$parterner);
				}
					



				if($this->db->update('purchase', $rem_lan)){

					$this->session->set_flashdata('msg', 'Product Successfully Added');
	        		redirect(base_url().'create_product');
	        	}

			}
			else{
					$this->session->set_flashdata('error', 'Problem In Add Product Try Again');
	        		redirect(base_url().'create_product/add');
			}
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								START Edit Product
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/  

	
	public function edit($id = false)
	{	
		if($id)
		{
			$data['page_title']	= 'Edit Products';
			$data['get_product'] = $this->add_product->get_product($id)[0];
			$data['get_plan_code'] = $this->setting_model->get_plan_code();
			$data['get_purchase_id'] = $this->add_product->all_purchase();			
			$this->load->template('add_product/edit',$data);

			
		}
		else
		{
			$this->session->set_flashdata('error', 'Product Not Found');
	        redirect(base_url().'create_product');
		}
	    
	}

	public function update(){
		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

		$this->form_validation->set_rules('purchase_id', 'Purchase Id', 'trim|required|min_length[2]|max_length[240]');
		
		$this->form_validation->set_rules('total_land_yard', 'Total Land area (in Sq. Yd)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('total_land_ht', 'Total Land area (in Hectares)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('lan_size_sqft', 'Total Land area(in Sq. Ft)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('product_id', 'Product Id', 'trim|required|min_length[2]|max_length[240]');
		$this->form_validation->set_rules('ploat_land_yard', 'Ploat Size (in Sq. Yd)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('ploat_size_ht', 'Ploat Size (in Hectares)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('ploat_size_sqft', 'Ploat Size (in Sq. Ft)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('rem_land_yrd', 'Reamining Land area (in Sq. Yd)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('rem_land_ht', 'Reamining Land area (in Hectares)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('rem_land_sqft', 'Reamining Land area(in Sq. Ft)', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('ploat_code', 'Ploat Number', 'trim|required|min_length[2]|max_length[240]');
		$this->form_validation->set_rules('plan_code', 'Plan Name', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('selling_amount', 'Selling Amount', 'trim|required|max_length[240]');

		$this->form_validation->set_rules('direct_agent', 'Direct Agent', 'trim|required|decimal');
		$this->form_validation->set_rules('parent_direct_agent', 'Parent Of Direct Agent', 'trim|required|decimal');
		$this->form_validation->set_rules('other_parent', 'Other Parents', 'trim|required|decimal');

		if ($this->form_validation->run() == FALSE)
		{
			$data['page_title']	= 'Edit Products';
			$data['get_product'] = $this->add_product->get_product($_POST['id'])[0];
			$data['get_plan_code'] = $this->setting_model->get_plan_code();
			$data['get_purchase_id'] = $this->add_product->all_purchase();
			$this->load->template('add_product/edit',$data);
		}
		else
		{
			$update_product = array(
				'purchase_id'  		 =>    $this->input->post('purchase_id'),
				'total_land_yard'  	 =>    $this->input->post('total_land_yard'),
				'total_land_ht'  	 =>    $this->input->post('total_land_ht'),
				'lan_size_sqft'  	 =>    $this->input->post('lan_size_sqft'),
				'product_id'  		 =>    strtoupper($this->input->post('product_id')),
				'ploat_land_yard'  	 =>    $this->input->post('ploat_land_yard'),
				'ploat_size_ht'  	 =>    $this->input->post('ploat_size_ht'),
				'ploat_size_sqft'  	 =>    $this->input->post('ploat_size_sqft'),
				'date'               =>    date('Y-m-d',strtotime($this->input->post('date'))),
				'rem_land_yrd'       =>    $this->input->post('rem_land_yrd'),
				'rem_land_ht'  		 =>    $this->input->post('rem_land_ht'),
				'rem_land_sqft'  	 =>    $this->input->post('rem_land_sqft'),
				'ploat_code'   		 =>    $this->input->post('ploat_code'),
				'plan_code'   		 =>    $this->input->post('plan_code'),
				'quantity'   		 =>    $this->input->post('quantity'),
				'selling_amount'     =>    $this->input->post('selling_amount'),
				
				'direct_agent'     	 =>    $this->input->post('direct_agent'),
				'parent_direct_agent'=>    $this->input->post('parent_direct_agent'),
				'other_parent'     	 =>    $this->input->post('other_parent'),
				
				'updated_by'         =>    $this->session->userdata('id'),
				'updated_at'         =>    date('Y-m-d H:i:s')

			);
			
				$this->db->where('id', $this->input->post('id'));
			if($this->db->update('create_product', $update_product)){
				
				$rem_lan = [
						
						'rem_land_yrd'  	 =>    $this->input->post('rem_land_yrd'),
						'rem_land_ht'  		 =>    $this->input->post('rem_land_ht'),
						'rem_land_sqft'  	 =>    $this->input->post('rem_land_sqft'),
				];

					$this->db->where('purchase_id', $this->input->post('purchase_id'));

				if($this->db->update('purchase', $rem_lan)){

					$this->session->set_flashdata('msg', 'Product Successfully Save');
		        	redirect(base_url().'create_product');
		        }

			}
			else
			{
				$this->session->set_flashdata('error', 'Problem In Save Product Try Again');
	        	redirect(base_url().'create_product');
			}
		}
	}

	/*///////////////////////////////////////////////////////////////////////////////////////////////////////
		  								DELETE Product 
	///////////////////////////////////////////////////////////////////////////////////////////////////////*/

	public function delete($id = false)
	{	
		if($id)
		{
			$this->db->where('id',$id);
			if($this->db->update('create_product',array('created_by'  => 	$this->session->userdata('id'),'delete_flag' => '1','deleted_at' => date('Y-m-d H:i:s'))))
			{

				$product = $this->add_product->get_product_del($id)[0];
				$purchase = $this->add_product->get_purchase($product['purchase_id'])[0];

				$rem_lan = [
						
						'rem_land_yrd'  	 =>    $purchase['rem_land_yrd'] + $product['ploat_land_yard'],
						'rem_land_ht'  		 =>    $purchase['rem_land_ht'] + $product['ploat_size_ht'],
						'rem_land_sqft'  	 =>    $purchase['rem_land_sqft'] + $product['ploat_size_sqft']
				];



				$this->db->where('purchase_id', $product['purchase_id']);
				$this->db->update('purchase',$rem_lan);
				

				$this->session->set_flashdata('msg', 'Product Successfully Deleted');
        		redirect(base_url().'create_product');
			}
			else{
				$this->session->set_flashdata('error', 'Product Not Deleted Try Again');
        		redirect(base_url().'create_product');
			}

		}
		else{
			$this->session->set_flashdata('error', 'Product Not Found');
	        redirect(base_url().'create_product');
		}
	}		
}
?>