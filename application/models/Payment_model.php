<?php

class Payment_model extends CI_Model
{


	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_installment_yes_all()
	{

		$this->db->where('install_packges','Yes');
		$this->db->where('cancel','0');
		$this->db->where('delete_flag','0');

		if($this->session->userdata('user_type') == 'agent'){
		 	$this->db->where('created_by',$this->session->userdata('id'));
		}
		$this->db->where('rem_amount >','0.00');
		$query = $this->db->get('sell_product');
    	$data = $query->result_array();
    	
    	$result = [];
    	foreach ($data as $key => $value) {
    		$this->db->where('user_id',$data[$key]['coust_name']);
    		$query = $this->db->get('customer_detail')->result_array();


    		$this->db->where('id',$data[$key]['product_id']);
    		$product = $this->db->get('create_product')->result_array();

    		$result[] = [$data[$key]['id'],$query[0]['fi_name'].' '.$query[0]['la_name'].' - '.$product[0]['product_id']];
    	}
    	return $result;
	}

	public function get_sell_for_payment($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('sell_product');
    	return $query->result_array();
	}

	public function get_sell_paid_installment($id)
	{
		$query = $this->db->query("SELECT SUM(instal_amount) AS `sum_paid` FROM `sell_installment_detail` WHERE `sell_product_id` = '".$id."' AND `status` =  '1'");

		if(empty($query->result_array()[0]['sum_paid']))
		{
			return 0.00;
		}
		else
		{
    		return $query->result_array()[0]['sum_paid'];
		}
	}

	public function get_sell_installment($id)
	{
		$query = $this->db->query("SELECT * FROM `sell_installment_detail` WHERE `sell_product_id` = '".$id."' AND `status` =  '0' ORDER BY `id` ASC LIMIT 1");

    	return $query->result_array()[0];
	}

	public function get_sell_installment_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM `sell_installment_detail` WHERE `id` = '".$id."'");

    	return $query->result_array()[0];
	}

	public function get_sell_payments($type)
	{
		$this->db->order_by('id','DESC');
		$this->db->where('type',$type);
		if($this->session->userdata('id') != '1')
		{
			$this->db->where('created_by',$this->session->userdata('id'));			
		}
		$query = $this->db->get('payment');
    	return $query->result_array();
	}

	public function get_sell_payment($id)
	{
		$this->db->where('id',$id);

		

		$query = $this->db->get('payment');
    	return $query->result_array();
	}

	public function get_sell_payments_byid($id)
	{
		$this->db->order_by('id','DESC');
		$this->db->where('type','sales');
		$this->db->where('created_by',$id);		
		$query = $this->db->get('payment');
    	return $query->result_array();
	}


	public function get_sell($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('sell_product');
    	return $query->result_array()[0];
	}

	public function get_customer($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('customer_detail');
    	$data = $query->result_array()[0];
    	return $data['fi_name'].' '.$data['mi_name'].' '.$data['la_name'];
	}

	public function get_product($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('create_product');
    	$data = $query->result_array()[0];
    	return $data['product_id'];
	}

	public function get_product_row($sell_id)
	{
		$id = $this->get_sell($sell_id)['product_id'];
		$this->db->where('id',$id);
		$query = $this->db->get('create_product');
    	return $query->result_array()[0];
	}


	public function get_next_due($sell_id,$install_id)
	{
		$this->db->where('sell_product_id',$sell_id);
		$this->db->where('id >',$install_id);
		$this->db->order_by('id','ASC');
		$this->db->limit(1);
		$query = $this->db->get('sell_installment_detail');
		if($query->result_array())
		{
			return _vdate($query->result_array()[0]['date']);
		}
		else
		{
			return 'This Is Last Installment';
		}
	}



	

	/*************************************************************************************************************
									Start Purchase Payment
	*************************************************************************************************************/


	public function get_purchase($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('purchase');
    	return $query->result_array()[0];
	}

	public function get_purchase_saller($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('purchase_seller_dynamic');
    	return $query->result_array()[0];
	}

	public function get_pruchase_install_yes_all()
	{

		
		$this->db->where('balance >','0.00');
		$query = $this->db->get('purchase_seller_dynamic');
    	return $data = $query->result_array();
    	
	}

	public function get_purchase_for_payment($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('purchase');
    	return $query->result_array();
	}

	public function find_saleer($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('purchase_seller_dynamic');
    	return $query->result_array();
	}

	public function get_purchase_paid_installment($id)
	{
		$query = $this->db->query("SELECT SUM(instal_amount) AS `sum_paid` FROM `purchase_installment_detail` WHERE `saller_id` = '".$id."' AND `status` =  '1'");

		if(empty($query->result_array()[0]['sum_paid']))
		{
			return 0.00;
		}
		else
		{
    		return $query->result_array()[0]['sum_paid'];
		}
	}

	public function get_purchase_installment($id)
	{
		$query = $this->db->query("SELECT * FROM `purchase_installment_detail` WHERE `saller_id` = '".$id."' AND `status` =  '0' ORDER BY `id` ASC LIMIT 1");

    	return $query->result_array()[0];
	}

	public function get_purchase_installment_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM `purchase_installment_detail` WHERE `id` = '".$id."'");

    	return $query->result_array()[0];
	}




	/*************************************************************************************************************
									Edit Purchase Payment
	*************************************************************************************************************/

	



	public function _payment($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('payment');
    	return $query->result_array()[0];
	}


	public function sale_delete_off($payment_id,$type)
	{
		$payment = $this->_payment($payment_id);
		$this->db->where('main_id',$payment['main_id']);
		$this->db->where('type',$type);
		$a = 0;
		foreach($this->db->get('payment')->result_array() as $key => $value)
		{
			if($value['id'] > $payment['id'])
			{
				$a++;
			}
		}

		if($a > 0)
		{
			return false;
		}
		else
		{
			return true;			
		}
	}



}

?>