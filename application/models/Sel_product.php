<?php

class Sel_product extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('setting_model');
		
	}

	// For Promotion League
	public function agent_promotion()
	{
		if($this->session->userdata('user_type') == 'agent'){
			$query = $this->db->query("SELECT SUM(`ploat_size_yrd`) AS `total_yard` FROM `sell_product` WHERE `created_by` = '".$this->session->userdata('id')."'");
	    	$yard = $query->result_array()[0]['total_yard'];

	    	$promotion = $this->setting_model->get_promotion();

	    	if($yard > $promotion['silver'] && $yard <= $promotion['gold']){

	    		$this->db->where('agent_id',$this->session->userdata('user_type_id'));
	    		$this->db->update('binary',['promotion' => 'silver_commission']);

	    	}
	    	else if($yard > $promotion['gold'] && $yard <= $promotion['diamond']){
	    		
	    		$this->db->where('agent_id',$this->session->userdata('user_type_id'));
	    		$this->db->update('binary',['promotion' => 'gold_commission']);
	    	}
	    	else if($yard > $promotion['diamond'] && $yard <= $promotion['super']){
	    		
	    		$this->db->where('agent_id',$this->session->userdata('user_type_id'));
	    		$this->db->update('binary',['promotion' => 'diamond_commission']);
	    	}
	    	else if($yard > $promotion['super']){
	    		
	    		$this->db->where('agent_id',$this->session->userdata('user_type_id'));
	    		$this->db->update('binary',['promotion' => 'super_commission']);
	    	}
	    	else{
	    		$this->db->where('agent_id',$this->session->userdata('user_type_id'));
	    		$this->db->update('binary',['promotion' => 'none']);
	    	}
	    }
	}

	//////////////////////////////
	


	public function get_sale_by_customer($id)
	{
		$this->db->where('delete_flag','0');
		$this->db->where('coust_name',$id);
		 	$this->db->order_by("id","desc");
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_repayments_all($id)
	{
		$repay = $this->db->query("SELECT SUM(amount) AS `all` FROM `repayment` WHERE `sale` = '".$id."'")->result_array();
		if($repay[0]['all'] == "")
		{
			return 0.00;
		}
		else{
			return $repay[0]['all'];	
		}
		
	}

	public function get_product_all($id)
	{

				$this->db->where('delete_flag','0');
				$this->db->where('type','0');
				$this->db->where('cancel','0');
				if($this->session->userdata('id') != '1'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
				}
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_cancle_plans()
	{

				$this->db->where('delete_flag','0');
				$this->db->where('type','0');
				$this->db->where('cancel','1');
				if($this->session->userdata('id') != '1'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
				}
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_booked_all()
	{

				$this->db->where('delete_flag','0');
				$this->db->where('cancel','0');
				$this->db->where('type','1');
				if($this->session->userdata('id') != '1'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
				}
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_cancle_booked_bookings()
	{

				$this->db->where('delete_flag','0');
				$this->db->where('cancel','1');
				$this->db->where('type','1');
				if($this->session->userdata('id') != '1'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
				}
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_product_for_dashboard()
	{

				$this->db->where('coust_name',$this->session->userdata('id'));
				$this->db->where('delete_flag','0');
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_product_data($id)
	{			
				
				 $this->db->where('id',$id);
		$query = $this->db->get('create_product')->result_array();
				$this->db->where('plan_code',$query[0]['plan_code']);
		$plan_code = $this->db->get('plan_code')->result_array();
    	return array($query,$plan_code);
	}


	public function get_product($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('sell_product');
    	
    	return $query->result_array();
    }

    public function installment_detail($id){
				$this->db->where('id',$id);
		 		$this->db->order_by("id","desc");
		$query = $this->db->get('sell_installment_detail');
    	return $query->result_array();
	}

	public function get_co_name($c_name){
				$this->db->where('user_id',$c_name);
		 		
		$query = $this->db->get('customer_detail');
    	return $query->result_array();	
	}

	public function get_product_row($id)
	{
			$this->db->where('id',$id);
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	public function installment_detail_asc($id){
				$this->db->where('sell_product_id',$id);
		 		$this->db->order_by("id","ASC");
		$query = $this->db->get('sell_installment_detail');
    	return $query->result_array();
	}

	public function installment_expire_date($id){
				$this->db->where('sell_product_id',$id);
		 		$this->db->order_by("id","DESC");
		$query = $this->db->get('sell_installment_detail',1);
    	return $query->result_array();
	}

	public function coust_detail($id){
				$this->db->where('user_id',$id);
		$query = $this->db->get('customer_detail');
    	return $query->result_array()[0];
	}

	public function product_detail($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}


	//Get Print Agent Id
	public function get_agent_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get('user');
    	return $query->result_array()[0];
	}

	public function get_agent_name($id){
		$this->db->where('id',$id);
		$query = $this->db->get('user');
    	$data = $query->result_array()[0];

    	if($data['user_type'] == 'subadmin')
    	{
    		$this->db->where('user_id',$id);
			$query = $this->db->get('subadmin_details');
	    	$data = $query->result_array()[0];
	    	return $data['first_name'].' '.$data['last_name'];
    	}
    	else if($data['user_type'] == 'agent')
    	{
    		$this->db->where('user_id',$id);
			$query = $this->db->get('agent_details');
	    	$data = $query->result_array()[0];
	    	return $data['fi_name'].' '.$data['la_name'];
    	}
    	else
    	{
    		return 'No Name Found';
    	}


	}
}

?>