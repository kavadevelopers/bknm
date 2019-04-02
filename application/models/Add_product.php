<?php

class Add_product extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	// product dashboard
	public function get_product_dash($location)
	{
		$this->db->order_by('id','asc');
		return $this->db->get_where('create_product',['delete_flag' => '0','purchase_id' => $location])->result_array();
	}
	// product dashboard


	public function get_product_all($id)
	{

				//$this->db->where('id',$id);
				$this->db->where('delete_flag','0');
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	public function get_product_for_index()
	{

				$this->db->order_by('id','desc');
				$this->db->where('delete_flag','0');
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	// for Sales
	public function get_product_all_sales($id)
	{
				$this->db->where('status','0');
				$this->db->where('type','0');
				$this->db->where('delete_flag','0');
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	// for book
	public function get_product_all_book()
	{
				$this->db->where('status','0');
				$this->db->where('type','1');
				$this->db->where('delete_flag','0');
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	public function get_product_used()
	{
		$this->db->where('delete_flag','0');
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function booked_product($id)
	{
			$this->db->where('id',$id);
			$query = $this->db->get('create_product');
		    if($query->result_array())
		    {
		    	return $query->result_array()[0];
		    }
		    else
		    {
		    	return $query->result_array();	
		    }
		    
	}

	public function get_product($id)
	{

				$this->db->where('id',$id);
				$this->db->where('delete_flag','0');
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	/*************  Get Lan Size Hecter And Sq.Ft ***********/



	public function get_land_detail($id)
	{
				$this->db->where('purchase_id',$id);
				$this->db->where('rem_land_ht >',0.00);
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}

	public function get_purchase($id)
	{
				$this->db->where('purchase_id',$id);
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}

	/**************************************************/


	public function get_product_del($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('create_product');
    	return $query->result_array();
	}

	// Get Purchase Id
	
	public function all_purchase(){
			
		 		$this->db->where('delete_flag','0');
				$this->db->where('rem_land_sqft >',0.00);
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}
	
	
}


	
?>