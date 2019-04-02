<?php 

class Purchase extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function installment_purchase($id){

		$this->db->where('saller_id',$id);		 
		$query = $this->db->get('purchase_installment_detail');
    	return $query->result_array();
	}

	public function all_purchase(){

		 		$this->db->order_by("id","desc");
				$this->db->where('delete_flag','0');
				 
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}

	public function single_purchase($id){

		 		$this->db->order_by("id","desc");
		 		$this->db->where('id',$id);
				$this->db->where('delete_flag','0');
				 
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}

	public function seller_dynamic($id){
				$this->db->where('main_id',$id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('purchase_seller_dynamic',1);
    	return $query->result_array();
	}

	public function seller_dynamic_seller($id,$first_id){
				$this->db->where('main_id',$id);
				$this->db->where('id !=',$first_id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('purchase_seller_dynamic');
    	return $query->result_array();

	}
	
	/*------------------------------------------------ */
	public function purchaser_dynamic($id){
				$this->db->where('main_id',$id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('purchase_purchaser_dynamic',1);
    	return $query->result_array();
	}

	public function purchase_dynamic_purchaser($id,$first_id){
				$this->db->where('main_id',$id);
				$this->db->where('id !=',$first_id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('purchase_purchaser_dynamic');
    	return $query->result_array();
	}
	
	/*------------------------------------------------ */

	

	public function purchase_land_detail($id){
				$this->db->where('purchase_main_id',$id);
		$query = $this->db->get('purchase_land_detail');
    	return $query->result_array();
	}

	public function installment_detail($id){
				$this->db->where('purchase_main_id',$id);
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('purchase_installment_detail');
    	return $query->result_array();
	}

	// For View function	
	public function installment_detail_asc($id){
				$this->db->where('purchase_main_id',$id);
		 		$this->db->order_by("id","ASC");
		$query = $this->db->get('purchase_installment_detail');
    	return $query->result_array();
	}

	// For Print & Delete Iamge
	public function all_seller_dynamic($id){
				$this->db->where('main_id',$id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('purchase_seller_dynamic');
    	return $query->result_array();
	}

	public function all_purchaser_dynamic($id){
				$this->db->where('main_id',$id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('purchase_purchaser_dynamic');
    	return $query->result_array();
	}

	public function get_expenses($id){
				$this->db->where('purchase_id',$id);
				$this->db->order_by("id", "asc");
		$query = $this->db->get('expense');
    	return $query->result_array();
	}

	

}

?>