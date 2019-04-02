<?php

class Report_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	
	public function get_expense($id,$date1,$date2)
	{
		return $this->db->query("SELECT * FROM `expense` WHERE `purchase_id` = '{$id}' AND (`date` BETWEEN '".$date1."' AND '".$date2."')")->result_array();
		
	}


	public function get_sale($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('sell_product');
    	return $query->result_array()[0];
	} 

	public function get_product($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('create_product');
    	return $query->result_array()[0];
	} 


	public function sale_profit_report($sale_id)
	{
		$response = [];

		$commission = $this->db->query("SELECT SUM(credit) AS `commission_total` FROM `transaction` WHERE `type` = 'commission' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($commission['commission_total'] != ''){ $commission_res = $commission['commission_total']; }else{ $commission_res = 0; } 

		$response[] = ['type' => 'Key Persons','amount' => ($commission_res += $this->get_insalment('',$sale_id,'installment_commission'))];




		$direct_income = $this->db->query("SELECT SUM(credit) AS `direct_income_total` FROM `transaction` WHERE `type` = 'direct_income' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($direct_income['direct_income_total'] != ''){ $direct_res = $direct_income['direct_income_total']; }else{ $direct_res = 0; } 
		
		$response[] = ['type' => 'Direct Agent','amount' => ($direct_res += $this->get_insalment('',$sale_id,'installment_direct_income'))];




		$indirect_income = $this->db->query("SELECT SUM(credit) AS `indirect_income` FROM `transaction` WHERE `type` = 'indirect_income' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($indirect_income['indirect_income'] != ''){ $indirect_res = $indirect_income['indirect_income']; }else{ $indirect_res = 0; } 
		
		$response[] = ['type' => 'Indirect Agent','amount' => ($indirect_res += $this->get_insalment('',$sale_id,'installment_indirect_income'))];




		$bonus_income = $this->db->query("SELECT SUM(credit) AS `bonus_income` FROM `transaction` WHERE `type` = 'bonus_income' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($bonus_income['bonus_income'] != ''){ $bonus_res = $bonus_income['bonus_income']; }else{ $bonus_res = 0; } 
		
		$response[] = ['type' => 'Bonus Agent','amount' => ($bonus_res += $this->get_insalment('',$sale_id,'installment_bonus_income'))];



		$promotion = $this->db->query("SELECT SUM(credit) AS `promotion` FROM `transaction` WHERE `type` = 'promotion' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($promotion['promotion'] != ''){ $promotion_res = $promotion['promotion']; }else{ $promotion_res = 0; } 
		
		$response[] = ['type' => 'Promotion Agent','amount' => ($promotion_res += $this->get_insalment('',$sale_id,'installment_promotion'))];




		$profit_parterner = $this->db->query("SELECT SUM(credit) AS `profit_parterner` FROM `transaction` WHERE `type` = 'profit' AND `credit_by` != '0' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($profit_parterner['profit_parterner'] != ''){ $profit_par_res = $profit_parterner['profit_parterner']; }else{ $profit_par_res = 0; } 
		
		$response[] = ['type' => 'Investers Share','amount' => ($profit_par_res += $this->get_insalment('1',$sale_id,'installment_profit'))];




		$profit_company = $this->db->query("SELECT SUM(credit) AS `profit_company` FROM `transaction` WHERE `type` = 'profit' AND `credit_by` = '0' AND `investment_id` = '{$sale_id}'")->result_array()[0];
		if($profit_company['profit_company'] != ''){ $profit_company_res = $profit_company['profit_company']; }else{ $profit_company_res = 0; } 
		
		$response[] = ['type' => 'Company Share','amount' => ($profit_company_res += $this->get_insalment('0',$sale_id,'installment_profit'))];

		return $response;
		//return $this->db->query("SELECT * FROM `transaction` WHERE (`type` = 'direct_income' OR  `type` = 'indirect_income' OR  `type` = 'bonus_income' OR  `type` = 'promotion' OR  `type` = 'commission' OR  `type` = 'profit') AND `investment_id` = '{$sale_id}'")->result_array();
		
	}


	public function get_insalment($com,$sale,$type)
	{
		$sub_query = '';
		if($com == '0'){ $sub_query = ' AND `credit_by` = "0"'; }
		if($com == '1'){ $sub_query = ' AND `credit_by` != "0"'; }
		$amount = 0;
		$payments_rows = $this->db->get_where('payment',['type' => 'sales','main_id' => $sale])->result_array();
		foreach ($payments_rows as $key => $value) {
			$transaction = $this->db->query("SELECT SUM(credit) AS `total` FROM `transaction` WHERE `type` = '{$type}' {$sub_query} AND `investment_id` = '{$value['id']}'")->result_array()[0];
			if($transaction['total'] != ''){ $amount += $transaction['total']; }else{ $amount += 0; } 
		}
		return $amount;
	}


	public function get_admins()
	{
		return $this->db->get_where('user',['delete_flag' => '0','user_type' => 'subadmin','id!=' => '1'])->result_array();
	}

	public function get_total_sale($id,$date1,$date2)
	{
		$total = $this->db->query("SELECT SUM(adva_payment) AS `total_sale` FROM `sell_product` WHERE `delete_flag` = '0' AND `created_by` = '{$id}' AND (`date` BETWEEN '".$date1."' AND '".$date2."')")->result_array()[0];

		if($total['total_sale'] == '')
		{
			return '0';
		}
		else
		{
			return $total['total_sale'];
		}
	}

	public function get_total_installment($id,$date1,$date2)
	{
		$total = $this->db->query("SELECT SUM(amount_install) AS `total_sale` FROM `payment` WHERE `created_by` = '{$id}' AND (`date` BETWEEN '".$date1."' AND '".$date2."')")->result_array()[0];

		if($total['total_sale'] == '')
		{
			return '0';
		}
		else
		{
			return $total['total_sale'];
		}
	}

	public function get_sales_by_id($id,$date1,$date2)
	{
		return $this->db->query("SELECT * FROM `sell_product` WHERE `delete_flag` = '0' AND `created_by` = '{$id}' AND (`date` BETWEEN '".$date1."' AND '".$date2."')")->result_array();
	}


	public function get_sell_payments_byid($id,$date1,$date2)
	{
		return $this->db->query("SELECT * FROM `payment` WHERE `type` = 'sales' AND `created_by` = '{$id}' AND (`date` BETWEEN '".$date1."' AND '".$date2."')")->result_array();
	}
	

	public function get_transaction($date1,$date2)
	{
		return $this->db->query("SELECT * FROM `transaction` WHERE (`date` BETWEEN '".$date1."' AND '".$date2."')")->result_array();
	}
	
	
	
}


	
?>