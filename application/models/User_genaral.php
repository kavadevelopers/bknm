<?php
class User_genaral extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('add_product');
	}


	public function get_user($id)
	{

				$this->db->where('id',$id);
		$query = $this->db->get('user');
    	return $query->result_array()[0];
	}

	public function users($user_type)
	{
		
				 $this->db->order_by("id","desc");
				 $this->db->where('id !=','1');
				if($this->session->userdata('user_type') == 'agent'){
				 	$this->db->where('created_by',$this->session->userdata('id'));
				}
				 $this->db->where('delete_flag','0');
				 $this->db->where('user_type',$user_type);
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function customer_detail($id)
	{

				$this->db->where('user_id',$id);
		$query = $this->db->get('customer_detail');
    	return $query->result_array()[0];
	}



	public function commission_parterner($sales_id,$amount,$date,$type)
	{
		$commition = 0;
		if($this->get_partner())
		{
			foreach ($this->get_partner() as $key => $value) {
				if($this->get_percentage($value['id'])['persent'] != '0.00')
				{
					$persent = $this->get_percentage($value['id'])['persent'];
					$commission = $amount * $persent / 100;
					$commition += $commission;
					$transaction = [
	                    'type'              =>  $type.'commission',
	                    'credit'            =>  $commission,
	                    'debit'             =>  0, 
	                    'credit_by'         =>  $value['id'],
	                    'date'              =>  $date,
	                    'investment_id'     =>  $sales_id,
	                    'created_by'        =>  $this->session->userdata('id'),
	                    'created_at'        =>  date('Y-m-d H:i:s')
	                ];

               		$this->db->insert('transaction', $transaction);
				}
			}
		}
		return $commition;
	}

	public function commission_parterner_ins($sales_id,$amount,$date,$type,$payment_id)
	{
		$commition = 0;
		if($this->get_partner())
		{
			foreach ($this->get_partner() as $key => $value) {
				if($this->get_percentage($value['id'])['persent'] != '0.00')
				{
					$persent = $this->get_percentage($value['id'])['persent'];
					$commission = $amount * $persent / 100;
					$commition += $commission;
					$transaction = [
	                    'type'              =>  $type.'commission',
	                    'credit'            =>  $commission,
	                    'debit'             =>  0, 
	                    'credit_by'         =>  $value['id'],
	                    'date'              =>  $date,
	                    'investment_id'     =>  $payment_id,
	                    'created_by'        =>  $this->session->userdata('id'),
	                    'created_at'        =>  date('Y-m-d H:i:s')
	                ];

               		$this->db->insert('transaction', $transaction);
				}
			}
		}
		return $commition;
	}


	public function share_company_expence_etc($sales_id,$amount,$date)
	{
		$share = 0;
		if($this->get_share_product($sales_id))
		{
			foreach ($this->get_share_product($sales_id) as $key => $value) {
				
					
					$commission = $value['amount'];
					$share += $commission;
					$transaction = [
	                    'type'              =>  'sales',
	                    'credit'            =>  $commission,
	                    'debit'             =>  0, 
	                    'credit_by'         =>  $value['parterner'],
	                    'date'              =>  $date,
	                    'investment_id'     =>  $sales_id,
	                    'created_by'        =>  $this->session->userdata('id'),
	                    'created_at'        =>  date('Y-m-d H:i:s')
	                ];

               		$this->db->insert('transaction', $transaction);
				
			}
		}
		return $share;
	}

	public function share_company_after_all($sales_id,$amount,$date,$type)
	{
		$share = 0;
		if($this->get_share_product($sales_id))
		{
			foreach ($this->get_share_product($sales_id) as $key => $value) {
				
					$persent = $value['percent'];
					$commission = $amount * $persent / 100;

					$share += $commission;
					$transaction = [
	                    'type'              =>  $type.'profit',
	                    'credit'            =>  $commission,
	                    'debit'             =>  0, 
	                    'credit_by'         =>  $value['parterner'],
	                    'date'              =>  $date,
	                    'investment_id'     =>  $sales_id,
	                    'created_by'        =>  $this->session->userdata('id'),
	                    'created_at'        =>  date('Y-m-d H:i:s')
	                ];

               		$this->db->insert('transaction', $transaction);
				
			}
		}
		return $share;
	}

	public function share_company_after_all_ins($sales_id,$amount,$date,$type,$payment)
	{
		$share = 0;
		if($this->get_share_product($sales_id))
		{
			foreach ($this->get_share_product($sales_id) as $key => $value) {
				
					$persent = $value['percent'];
					$commission = $amount * $persent / 100;

					$share += $commission;
					$transaction = [
	                    'type'              =>  $type.'profit',
	                    'credit'            =>  $commission,
	                    'debit'             =>  0, 
	                    'credit_by'         =>  $value['parterner'],
	                    'date'              =>  $date,
	                    'investment_id'     =>  $payment,
	                    'created_by'        =>  $this->session->userdata('id'),
	                    'created_at'        =>  date('Y-m-d H:i:s')
	                ];

               		$this->db->insert('transaction', $transaction);
				
			}
		}
		return $share;
	}

	public function profit_company($sales_id,$amount,$date)
	{
		
				
					
					$transaction = [
	                    'type'              =>  'profit',
	                    'credit'            =>  $amount,
	                    'debit'             =>  0, 
	                    'credit_by'         =>  0,
	                    'date'              =>  $date,
	                    'investment_id'     =>  $sales_id,
	                    'created_by'        =>  $this->session->userdata('id'),
	                    'created_at'        =>  date('Y-m-d H:i:s')
	                ];

               		$this->db->insert('transaction', $transaction);
				
	}



	

	public function get_share_product($sales)
	{
		$this->db->where('id',$sales);
		$query = $this->db->get('sell_product');
    	$product = $query->result_array()[0]['product_id'];

    	$this->db->where('product_id',$product);
    	$query = $this->db->get('share_parterner');
    	return $query->result_array();
	}

	public function get_partner()
	{
		$this->db->where('delete_flag','0');
		$this->db->where('key_persons','1');
		$this->db->where('user_type','business');
		$query = $this->db->get('user');
    	return $query->result_array();
	}

	public function get_percentage($user_id)
	{
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('business_partners');
    	return $query->result_array()[0];
	}

	public function agent_id()
	{
				 $this->db->where('user_type_id',$this->session->userdata('user_type_id'));
		$query = $this->db->get('user');
    	return $query->result_array()[0]['id'];
	}

	public function promotion($column_name)
	{
				 $this->db->where('id','1');
				$percent = $this->db->get('agent_promotion');
    	return $percent->result_array()[0][$column_name];
	}

	public function promotion_agent($sales_id,$amount,$date,$type)
	{
		
		$promotion = 0;



		if($this->session->userdata('user_type') == 'agent')
		{

			if($this->get_agent($this->session->userdata('user_type_id'))['promotion'] != 'none')
			{

				
		    	$column_name = $this->get_agent($this->session->userdata('user_type_id'))['promotion'];

				$commission = ($amount * floatval($this->promotion($column_name))) / 100;
				$transaction = [
		            'type'              =>  $type.'promotion',
		            'credit'            =>  $commission,
		            'debit'             =>  0, 
		            'credit_by'         =>  $this->agent_id(),
		            'date'              =>  $date,
		            'investment_id'     =>  $sales_id,
		            'created_by'        =>  $this->session->userdata('id'),
		            'created_at'        =>  date('Y-m-d H:i:s')
		        ];

	            $this->db->insert('transaction', $transaction);
	            $promotion += $commission;
	        }
		}

		return $promotion;
	}

	public function promotion_agent_ins($sales_id,$amount,$date,$type,$payment_id)
	{
		
		$promotion = 0;

		$user_data = $this->get_user($this->get_sale($sales_id)['created_by']);
		
		if($user_data['user_type'] == 'agent')
		{

			if($this->get_agent($user_data['user_type_id'])['promotion'] != 'none')
			{

				
		    	$column_name = $this->get_agent($user_data['user_type_id'])['promotion'];

				$commission = ($amount * floatval($this->promotion($column_name))) / 100;
				$transaction = [
		            'type'              =>  $type.'promotion',
		            'credit'            =>  $commission,
		            'debit'             =>  0, 
		            'credit_by'         =>  $user_data['user_type_id'],
		            'date'              =>  $date,
		            'investment_id'     =>  $payment_id,
		            'created_by'        =>  $this->session->userdata('id'),
		            'created_at'        =>  date('Y-m-d H:i:s')
		        ];

	            $this->db->insert('transaction', $transaction);
	            $promotion += $commission;
	        }
		}

		return $promotion;
	}

	public function commission_agent($sales_id,$amount,$date,$type)
	{
		$remaining = 0;
		if($this->session->userdata('user_type') == 'agent')
		{
			$mainp = $this->get_agent_per($sales_id)['direct_agent']; 
			$parentp = $this->get_agent_per($sales_id)['parent_direct_agent']; 
			$otherp = $this->get_agent_per($sales_id)['other_parent']; 
			
			$commission = ($amount * $mainp) / 100;
			$transaction = [
	            'type'              =>  $type.'direct_income',
	            'credit'            =>  $commission,
	            'debit'             =>  0, 
	            'credit_by'         =>  $this->agent_id(),
	            'date'              =>  $date,
	            'investment_id'     =>  $sales_id,
	            'created_by'        =>  $this->session->userdata('id'),
	            'created_at'        =>  date('Y-m-d H:i:s')
	        ];

            $this->db->insert('transaction', $transaction);
            $remaining += $commission;
            ///  parent 
            if(!empty($this->get_agent($this->session->userdata('user_type_id'))['parent']) && $this->get_agent($this->session->userdata('user_type_id'))['parent'] != 'ADMIN'){
	            if($this->parent_commission($this->get_agent($this->session->userdata('user_type_id'))['parent']))
	            {
	            	$commission = ($amount * $parentp) / 100;
					$transaction = [
			            'type'              =>  $type.'indirect_income',
			            'credit'            =>  $commission,
			            'debit'             =>  0, 
			            'credit_by'         =>  $this->is_agent($this->get_agent($this->session->userdata('user_type_id'))['parent'])['id'],
			            'date'              =>  $date,
			            'investment_id'     =>  $sales_id,
			            'created_by'        =>  $this->session->userdata('id'),
			            'created_at'        =>  date('Y-m-d H:i:s')
			        ];
			        $remaining += $commission;
		            $this->db->insert('transaction', $transaction);
	            }

	            /// other
            
            $after_parent = $this->get_agent($this->get_agent($this->session->userdata('user_type_id'))['parent'])['parent'];
           
            $other_commision = $this->othe_commission($after_parent,$sales_id,$amount,$date,$type);	

            $remaining += $other_commision;

            /// other
	            
	        }

            ///  parent 


            



		}

		return $remaining;
	}

	public function commission_agent_ins($sales_id,$amount,$date,$type,$payment_id)
	{
		$remaining = 0;

		$user_data = $this->get_user($this->get_sale($sales_id)['created_by']);

		if($user_data['user_type'] == 'agent')
		{
			$mainp = $this->get_agent_per($sales_id)['direct_agent']; 
			$parentp = $this->get_agent_per($sales_id)['parent_direct_agent']; 
			$otherp = $this->get_agent_per($sales_id)['other_parent']; 
			
			$commission = ($amount * $mainp) / 100;
			$transaction = [
	            'type'              =>  $type.'direct_income',
	            'credit'            =>  $commission,
	            'debit'             =>  0, 
	            'credit_by'         =>  $user_data['id'],
	            'date'              =>  $date,
	            'investment_id'     =>  $payment_id,
	            'created_by'        =>  $this->session->userdata('id'),
	            'created_at'        =>  date('Y-m-d H:i:s')
	        ];

            $this->db->insert('transaction', $transaction);
            $remaining += $commission;
            ///  parent 
            if(!empty($this->get_agent($user_data['user_type_id'])['parent']) && $this->get_agent($user_data['user_type_id'])['parent'] != 'ADMIN'){
	            if($this->parent_commission($this->get_agent($user_data['user_type_id'])['parent']))
	            {
	            	$commission = ($amount * $parentp) / 100;
					$transaction = [
			            'type'              =>  $type.'indirect_income',
			            'credit'            =>  $commission,
			            'debit'             =>  0, 
			            'credit_by'         =>  $this->is_agent($this->get_agent($user_data['user_type_id'])['parent'])['id'],
			            'date'              =>  $date,
			            'investment_id'     =>  $payment_id,
			            'created_by'        =>  $this->session->userdata('id'),
			            'created_at'        =>  date('Y-m-d H:i:s')
			        ];
			        $remaining += $commission;
		            $this->db->insert('transaction', $transaction);
	            }

	            /// other
            
            $after_parent = $this->get_agent($this->get_agent($user_data['user_type_id'])['parent'])['parent'];
           
            $other_commision = $this->othe_commission_ins($after_parent,$sales_id,$amount,$date,$type,$payment_id);	

            $remaining += $other_commision;

            /// other
	            
	        }

            ///  parent 


            



		}

		return $remaining;
	}

	public function parent_commission($parent_agent)
	{
			if($this->is_agent($parent_agent)['user_type'] == 'agent')
			{
				if($this->get_agent($parent_agent)['coustmer'] != '')
				{
					if($this->get_agent($parent_agent)['active'] == '0')
					{
						if($this->get_twolags($parent_agent) >= 2)
						{
							return true;
						}
					}
				}
			}
	}

	public function is_agent($agent_id)
	{
		$this->db->where('user_type_id',$agent_id);
		$query = $this->db->get('user');
    	return $query->result_array()[0];
	}

	public function get_agent_per($sales_id)
	{
		$product_id = $this->get_sale($sales_id)['product_id'];
		$this->db->where('id',$product_id);
		$query = $this->db->get('create_product');
    	return $query->result_array()[0];
	} 

	public function get_sale($id)
	{

		$this->db->where('id',$id);
		$query = $this->db->get('sell_product');
    	return $query->result_array()[0];
    }



	public function othe_commission($agent,$sales_id,$amount,$date,$type)
	{
		$otherp = $this->get_agent_per($sales_id)['other_parent']; 
		
		$each_commission = 0;
		

		$array_ids = [];

		while($agent != '')
		{
			if($this->parent_commission($agent))
            {
            	$array_ids[] = $agent;
            	$agent = $this->get_agent($agent)['parent'];
            }
            else
            {
            	$agent = $this->get_agent($agent)['parent'];
            }
		}

		if(count($array_ids) > 0)
		{
			$each_commission = ($amount * $otherp) / 100;

			$each = $each_commission / floatval(count($array_ids));
			foreach ($array_ids as $key => $value) {
				$transaction = [
		            'type'              =>  $type.'bonus_income',
		            'credit'            =>  $each,
		            'debit'             =>  0, 
		            'credit_by'         =>  $this->is_agent($value)['id'],
		            'date'              =>  $date,
		            'investment_id'     =>  $sales_id,
		            'created_by'        =>  $this->session->userdata('id'),
		            'created_at'        =>  date('Y-m-d H:i:s')
		        ];

	            $this->db->insert('transaction', $transaction);
			}
		}
		return $each_commission;
	}

	public function othe_commission_ins($agent,$sales_id,$amount,$date,$type,$payment_id)
	{
		$otherp = $this->get_agent_per($sales_id)['other_parent']; 
		
		$each_commission = 0;
		

		$array_ids = [];

		while($agent != '')
		{
			if($this->parent_commission($agent))
            {
            	$array_ids[] = $agent;
            	$agent = $this->get_agent($agent)['parent'];
            }
            else
            {
            	$agent = $this->get_agent($agent)['parent'];
            }
		}

		if(count($array_ids) > 0)
		{
			$each_commission = ($amount * $otherp) / 100;

			$each = $each_commission / floatval(count($array_ids));
			foreach ($array_ids as $key => $value) {
				$transaction = [
		            'type'              =>  $type.'bonus_income',
		            'credit'            =>  $each,
		            'debit'             =>  0, 
		            'credit_by'         =>  $this->is_agent($value)['id'],
		            'date'              =>  $date,
		            'investment_id'     =>  $payment_id,
		            'created_by'        =>  $this->session->userdata('id'),
		            'created_at'        =>  date('Y-m-d H:i:s')
		        ];

	            $this->db->insert('transaction', $transaction);
			}
		}
		return $each_commission;
	}

	public function get_agent($agent_id)
	{
		$this->db->where('agent_id',$agent_id);
		$query = $this->db->get('binary');
    	return $query->result_array()[0];
	}

	public function get_twolags($agent_id){
		$this->db->where('parent',$agent_id);
		$query = $this->db->get('binary');
    	return $query->num_rows();
	}
}