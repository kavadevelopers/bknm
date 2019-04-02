<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
	var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }

    function promotion_level()
    {
        $agent = $this->CI->session->userdata('user_type_id');
        
        $this->CI->db->where('agent_id',$agent);
        $promotion = $this->CI->db->get('binary')->result_array();
        //print_r($promotion);
        $result = '';
        if($promotion[0]['promotion'] == 'none'){
            $result = 'Starter Personality';
        }
        else if($promotion[0]['promotion'] == 'silver_commission'){
            $result = '<span style="color:#d8d8d8; margin-right:4px; font-size:16px;"><i class="fa fa-trophy"></i></span> Silver Personality';
        }
        else if($promotion[0]['promotion'] == 'gold_commission'){
            $result = '<span style="color:#ECF549; margin-right:4px; font-size:16px;"><i class="fa fa-trophy"></i></span> Gold Personality';
        }
        else if($promotion[0]['promotion'] == 'diamond_commission'){
            $result = '<span style="color:#E0F0FF; margin-right:4px; font-size:16px;"><i class="fa fa-trophy"></i></span> Diamond Personality';
        }
        else if($promotion[0]['promotion'] == 'super_commission'){
            $result = '<span style="color:#fff; margin-right:4px; font-size:16px;"><i class="fa fa-trophy"></i></span> Superb Personality';
        }
        return $result;
    }

    function promotion_level_byid($agent)
    {
        
        
        $this->CI->db->where('agent_id',$agent);
        $promotion = $this->CI->db->get('binary')->result_array();
        //print_r($promotion);
        $result = '';
        if($promotion[0]['promotion'] == 'none'){
            $result = 'Starter Personality';
        }
        else if($promotion[0]['promotion'] == 'silver_commission'){
            $result = 'Silver Personality';
        }
        else if($promotion[0]['promotion'] == 'gold_commission'){
            $result = 'Gold Personality';
        }
        else if($promotion[0]['promotion'] == 'diamond_commission'){
            $result = 'Diamond Personality';
        }
        else if($promotion[0]['promotion'] == 'super_commission'){
            $result = 'Superb Personality';
        }
        return $result;
    }

    function check_session()
	{
        $admin = $this->CI->session->userdata('id');
        if(!$admin)
        {
        	$this->CI->session->set_flashdata('error', 'Your Session Is Expire Please Login Again.');
            redirect(base_url());
        }
        
        $date_for = date('Y-m-d', strtotime(date('Y-m-d').' - 30 days'));
        

        $result = $this->CI->db->get_where('user',array('user_type' => 'agent','delete_flag' => '0','key_persons' => '0'))->result_array();
        
        foreach ($result as $key => $value) {
            $agent = $value['user_type_id'];

            $check_data = $this->CI->db->get_where('agent_deactivation',array('id' => '1'))->result_array()[0];

            $agents = $this->CI->db->query("SELECT * FROM `user` WHERE `user_type` = 'agent' AND `reference_id` = '".$agent."' AND (`created_at` BETWEEN '".$date_for."' AND '".date('Y-m-d')."')")->num_rows();

            $Sales = $this->CI->db->query("SELECT * FROM `sell_product` WHERE `created_by` = '".$value['id']."' AND `delete_flag` = '0' AND (`date` BETWEEN '".$date_for."' AND '".date('Y-m-d')."')")->num_rows();
            
            if($agents >= $check_data['agent'] && $Sales >= $check_data['saller'])
            {
                $this->CI->db->where('agent_id',$agent);
                $this->CI->db->update('binary',['active' => '0']);
            }
            else
            {
                $this->CI->db->where('agent_id',$agent);
                $this->CI->db->update('binary',['active' => '1']);
            }

        }
	}



	function get_admin($id)
    {
        $this->CI->db->select('*');
        $this->CI->db->where('id', $id);
        $result = $this->CI->db->get('user');
        $result = $result->row();

        return $result;
    }  

    function get_user($id)
    {
        $this->CI->db->select('*');
        $this->CI->db->where('id', $id);
        $result = $this->CI->db->get('user');
        $result = $result->result_array();

        return $result;
    }  


    function count_notifi()
    {
        
        $this->CI->db->where('read', '0');
        $this->CI->db->where('for',$this->CI->session->userdata('id'));
        return $this->CI->db->get('notification')->num_rows();
    }  


    function get_notifi()
    {
        $this->CI->db->where('for',$this->CI->session->userdata('id'));
        $this->CI->db->order_by('id', 'desc');
        return $this->CI->db->get('notification',5)->result_array();
    }  

    function get_full_name()
    {

        $this->CI->load->model('users');

        if($this->CI->session->userdata('user_type') == 'agent')
        {
            $detail = $this->CI->users->agent_detail($this->CI->session->userdata('id'))[0];
            $full_name = $detail['fi_name'].' '.$detail['la_name'];
        }
        else if($this->CI->session->userdata('user_type') == 'subadmin')
        {
            $detail = $this->CI->users->subadmin_detail($this->CI->session->userdata('id'))[0];
            $full_name = $detail['first_name'].' '.$detail['last_name'];
        }
        else if($this->CI->session->userdata('user_type') == 'business')
        {
            $detail = $this->CI->users->business_detail($this->CI->session->userdata('id'))[0];
            $full_name = $detail['fi_name'].' '.$detail['la_name'];
        }
        else if($this->CI->session->userdata('user_type') == 'customer')
        {
            $detail = $this->CI->users->customer_detail($this->CI->session->userdata('id'))[0];
            $full_name = $detail['fi_name'].' '.$detail['la_name'];
        }
        else
        {
            $detail = $this->CI->users->subadmin_detail($this->CI->session->userdata('id'))[0];
            $full_name = $detail['first_name'].' '.$detail['last_name'];
        }

        return $full_name;
    }

}