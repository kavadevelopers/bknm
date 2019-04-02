<?php
class Dash_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_transaction_recent()
	{
		$this->db->order_by('id','desc');
		return $this->db->get('transaction')->result_array();
	}

	public function get_user_id_trans($credit,$debit)
	{
		if($credit != '')
		{
			if($credit == '0')
			{
				return 'Company';
			}
			else
			{
				$this->db->where('id',$credit);
				return $this->db->get('user')->result_array()[0]['user_type_id'];
			}
			
		}
		else
		{
			if($debit == '0')
			{
				return 'Company';
			}
			else
			{
				$this->db->where('id',$debit);
				return $this->db->get('user')->result_array()[0]['user_type_id'];
			}
		}
	}


	public function count_admins()
	{
		$this->db->where('user_type','subadmin');
		$this->db->where('delete_flag','0');
		$this->db->where('id !=','1');
		return $this->db->count_all_results('user');
	}

	public function count_agent()
	{
		$this->db->where('user_type','agent');
		$this->db->where('delete_flag','0');
		return $this->db->count_all_results('user');
	}


	public function count_parterner()
	{
		$this->db->where('user_type','business');
		$this->db->where('key_persons','0');
		$this->db->where('delete_flag','0');
		return $this->db->count_all_results('user');
	}

	public function count_keypersons()
	{
		$this->db->where('user_type','business');
		$this->db->where('key_persons','1');
		$this->db->where('delete_flag','0');
		return $this->db->count_all_results('user');
	}

	public function count_customers()
	{
		$this->db->where('user_type','customer');
		$this->db->where('delete_flag','0');
		return $this->db->count_all_results('user');
	}

	public function sold_products()
	{
		$this->db->where('status','1');
		$this->db->where('delete_flag','0');
		return $this->db->count_all_results('create_product');
	}

	public function unsold_products()
	{
		$this->db->where('status','0');
		$this->db->where('delete_flag','0');
		return $this->db->count_all_results('create_product');
	}

	public function get_company(){
		$this->db->where('user_type','business');
		$this->db->order_by('id','ASC');
		$company = $this->db->get('user',1)->result_array();	

		if($company){
			return $company[0]['id'];
		}
		else{
			return 0;
		}
	}


	public function Balance_Company()
	{	

		$get_company = 0;

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `debit_by` = '".$get_company."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}

		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND  `credit_by` = '".$get_company."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$cr = $credit[0]['all_credit'];
			}
			else
			{
				$cr = 0;
			}
			return $cr - $ar;
			
	}

	public function Balance_Company_Monthly()
	{	

		$get_company = 0;

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND `debit_by` = '".$get_company."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}

		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND  `credit_by` = '".$get_company."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$cr = $credit[0]['all_credit'];
			}
			else
			{
				$cr = 0;
			}
			return $cr - $ar;
			
	}

	public function total_debit()
	{	
		$get_company = 0;

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `debit_by` = '".$get_company."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function total_credit()
	{
		$get_company = 0;

		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND  `credit_by` = '".$get_company."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function monthly_debit()
	{
		$get_company = 0;

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND `debit_by` = '".$get_company."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function monthly_credit()
	{	
		$get_company = 0;

		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND  `credit_by` = '".$get_company."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function total_credit_partner()
	{
		$get_company = '0';

		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND `type` = 'investment' AND  `credit_by` != '".$get_company."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function total_remaining_partner()
	{
		$get_company = 0;

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND (`type` = 'purchase' OR `type` = 'expense' OR `type` = 'withdraw')  AND  `debit_by` != '".$get_company."'")->result_array();


		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND `type` = 'investment' AND  `credit_by` != '".$get_company."'")->result_array();

			if($credit){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			if($debit){
				$dir = $debit[0]['all_debit'];
			}
			else
			{
				$dir = 0;
			}
			return $ar - $dir;
	}

	public function total_purchase()
	{
		return $credit = $this->db->query("SELECT * FROM `purchase` WHERE `delete_flag` = '0'")->num_rows();


			
	}

	public function monthly_purchase()
	{
		return $credit = $this->db->query("SELECT * FROM `purchase` WHERE `delete_flag` = '0' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."')")->num_rows();


			
	}

	public function purchase_installment()
	{
		$today = strtotime(date('Y-m-d'));
		$plusone = date("Y-m-d", strtotime("+2 month", $today));
		$this->db->where('status','0');
		$this->db->where('date <=',$plusone);
		$this->db->group_by('saller_id');
		return $this->db->get('purchase_installment_detail')->result_array();
	}

	public function sale_installment()
	{
		$today = strtotime(date('Y-m-d'));
		$plusone = date("Y-m-d", strtotime("+2 month", $today));
		$this->db->where('status','0');
		$this->db->where('date <=',$plusone);
		$this->db->group_by('sell_product_id');
		return $this->db->get('sell_installment_detail')->result_array();
	}


	public function customer_sale_installment()
	{
		$this->db->where('coust_name',$this->session->userdata('id'));
		$sale = $this->db->get('sell_product')->result_array();

		foreach ($sale as $key => $value) {
			$this->db->or_where('sell_product_id',$value['id']);
		}

		$today = strtotime(date('Y-m-d'));
		$plusone = date("Y-m-d", strtotime("+2 month", $today));
		$this->db->where('status','0');
		$this->db->where('date <=',$plusone);
		$this->db->group_by('sell_product_id');
		return $this->db->get('sell_installment_detail')->result_array();
	}

	public function purchase_id_get($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('purchase')->result_array()[0];
	}

	public function GetSallerName($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('purchase_seller_dynamic')->result_array()[0];	
	}

	public function get_sale($id)
	{
		$this->db->where('id',$id);
		$sale = $this->db->get('sell_product')->result_array()[0]['coust_name'];
		return $this->get_customer($sale);
	}

	public function get_customer($id)
	{
		$this->db->where('id',$id);
		$user_type_id = $this->db->get('user')->result_array()[0]['user_type_id'];

		$this->db->where('user_id',$id);
		$name = $this->db->get('customer_detail')->result_array()[0]['fi_name'].' '.$this->db->get('customer_detail')->result_array()[0]['la_name'];
		$mobile = $this->db->get('customer_detail')->result_array()[0]['mobile'];
		return [$user_type_id,$name,$mobile];
	}


	public function new_customer()
	{
		$this->db->where('delete_flag','0');
		$this->db->where('user_type','customer');
		$this->db->order_by('id','desc');
		return $this->db->get('user')->result_array();
	}

	public function new_agent()
	{
		$this->db->where('delete_flag','0');
		$this->db->where('user_type','agent');
		$this->db->order_by('id','desc');
		return $this->db->get('user')->result_array();
	}

	public function new_partrner()
	{
		$this->db->where('delete_flag','0');
		$this->db->where('key_persons','0');
		$this->db->where('user_type','business');
		$this->db->order_by('id','desc');
		return $this->db->get('user')->result_array();
	}


	/*******************************************************************************************************************************************
															Agent Dash Board Transaction 
	*******************************************************************************************************************************************/


	public function agent_total_debit()
	{	
		
		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `debit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function agent_total_credit()
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND  `credit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}


	public function agent_balance()
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND  `credit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `debit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$dbt = $debit[0]['all_debit'];
			}
			else
			{
				$dbt = 0;
			}

			return $ar - $dbt;

	}

	/*******************************************************************************************************************************************
															Business Dash Board Transaction 
	*******************************************************************************************************************************************/


	public function business_total_debit()
	{	
		
		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `type` = 'withdraw' AND `debit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$ar = $debit[0]['all_debit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}

	public function business_total_credit()
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND `type` != 'investment' AND `credit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			return $ar;
	}


	public function business_balance()
	{
		
		$credit = $this->db->query("SELECT SUM(credit) AS `all_credit` FROM `transaction` WHERE `debit` = '0.00' AND `type` != 'investment' AND  `credit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($credit[0]['all_credit'])){
				$ar = $credit[0]['all_credit'];
			}
			else
			{
				$ar = 0;
			}
			

		$debit = $this->db->query("SELECT SUM(debit) AS `all_debit` FROM `transaction` WHERE `credit` = '0.00' AND `type` = 'withdraw' AND `debit_by` = '".$this->session->userdata('id')."'")->result_array();

			if(!empty($debit[0]['all_debit'])){
				$dbt = $debit[0]['all_debit'];
			}
			else
			{
				$dbt = 0;
			}

			return $ar - $dbt;

	}

	/********************************************************************************************************************
										FOR Total & Monthly
	********************************************************************************************************************/
	
	
	public function total_reffered($agent_id){
		
		return $query = $this->db->query("SELECT * FROM `user` WHERE `reference_id` = '".$agent_id."'")->num_rows();
	}

	public function monthly_reffered($agent_id){
		
		return $query = $this->db->query("SELECT * FROM `user` WHERE `reference_id` = '".$agent_id."' AND (`created_at` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."')")->num_rows();
	}

	public function total_sale($id){
		
		return $query = $this->db->query("SELECT * FROM `sell_product` WHERE `created_by` = '".$id."' AND `delete_flag` = '0'")->num_rows();
	}

	public function monthly_sale($id){
		
		return $query = $this->db->query("SELECT * FROM `sell_product` WHERE `created_by` = '".$id."' AND (`created_at` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND `delete_flag` = '0'")->num_rows();
	}

	public function total_direct_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`type` = 'direct_income' OR `type` = 'installment_direct_income')")->result_array()[0]['total'];
	}

	public function monthly_direct_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND (`type` = 'direct_income' OR `type` = 'installment_direct_income')")->result_array()[0]['total'];
	}

	public function total_indirect_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`type` = 'indirect_income' OR `type` = 'installment_indirect_income')")->result_array()[0]['total'];
	}

	public function monthly_indirect_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND (`type` = 'indirect_income' OR `type` = 'installment_indirect_income')")->result_array()[0]['total'];
	}

	public function total_bonus_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`type` = 'bonus_income'  OR `type` = 'installment_bonus_income')")->result_array()[0]['total'];
	}

	public function monthly_bonus_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND (`type` = 'bonus_income'  OR `type` = 'installment_bonus_income')")->result_array()[0]['total'];
	}

	public function total_promotion_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`type` = 'promotion' OR `type` = 'installment_promotion')")->result_array()[0]['total'];
	}

	public function monthly_promotion_income($id){
		
		return $query = $this->db->query("SELECT SUM(`credit`) AS `total` FROM `transaction` WHERE `credit_by` = '".$id."' AND (`date` BETWEEN '".date('Y-m-1')."' AND '".date('Y-m-t')."') AND (`type` = 'promotion' OR `type` = 'installment_promotion')")->result_array()[0]['total'];
	}




	public function get_agent_is_deactivated()
	{
		$data = []; 


		$date_for = date('Y-m-d', strtotime(date('Y-m-d').' - 15 days'));
        

        $result = $this->db->get_where('user',array('user_type' => 'agent','delete_flag' => '0','key_persons' => '0'))->result_array();
        
        foreach ($result as $key => $value) {
            $agent = $value['user_type_id'];

            $check_data = $this->db->get_where('agent_deactivation',array('id' => '1'))->result_array()[0];

            $agents = $this->db->query("SELECT * FROM `user` WHERE `user_type` = 'agent' AND `reference_id` = '".$agent."' AND (`created_at` BETWEEN '".$date_for."' AND '".date('Y-m-d')."')")->num_rows();

            $Sales = $this->db->query("SELECT * FROM `sell_product` WHERE `created_by` = '".$value['id']."' AND `delete_flag` = '0' AND (`date` BETWEEN '".$date_for."' AND '".date('Y-m-d')."')")->num_rows();
            
            if($agents >= $check_data['agent'] && $Sales >= $check_data['saller'])
            {
                
            }
            else
            {
            	if($this->get_active_from_binary($agent)['active'] == '0' )
            	{
	            	$agent_detail = $this->get_agent_details($value['id']);
	                $data[] = ['user_type_id' => $agent,'id' => $value['id'],'name' => $agent_detail['fi_name'].' '.$agent_detail['la_name'],'mobile' => $agent_detail['mobile']];
	            }
            }

        }

        return $data;
	}

	public function get_agent_details($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('agent_details');
    	return $query->result_array()[0];
	}

	public function get_active_from_binary($id)
	{
		$this->db->where('agent_id',$id);
		$query = $this->db->get('binary');
    	return $query->result_array()[0];
	}

	public function customer_detail_get($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('customer_detail');
    	return $query->result_array()[0];
	}

	public function get_plot_hold()
	{
		$data = [];
		$this->db->where('user_type','customer');
		$query = $this->db->get('user');
    	foreach ($query->result_array() as $key => $value) {
    		$customer = $this->customer_detail_get($value['id']);
    		if($customer['booking'] != '')
    		{
    			$data[] = ['id'  => $customer['user_id'],'name' => $customer['fi_name'].' '.$customer['la_name'],'mobile' => $customer['mobile'],'booking' => $customer['booking'],'hold_by' => $value['updated_by'],'plan_code' => $customer['plan']];
    		} 
    	}
    	return $data;
	}

	public function get_product_on_hold($pro_id)
	{
		$this->db->where('id',$pro_id);
		$query = $this->db->get('create_product');
    	return $query->result_array()[0];
	}


	public function product_status_change($id)
	{
		$this->db->where('id', $id);
		$this->db->update('create_product', ['status' => '0']);
	}

	public function remove_from_hold($id)
	{
		$this->db->where('user_id', $id);
		$this->db->update('customer_detail', ['booking' => '']);
	}

	public function plot_hold_by($user_id)
	{
		$this->db->where('id',$user_id);
		return $this->db->get('user')->result_array()[0];

	}
}
?>