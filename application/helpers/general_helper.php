<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function pre_print($array)
{   
    echo count($array);
    echo "<pre>";
    print_r($array);
}

function master_pass()
{
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('masterpass',['id' => '1']);
    return $query->result_array()[0]['pass'];
}

// Get Proof Data For All Module
    
function proof_type()
{
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->get('proof');
    return $query->result_array();
}

function get_agent_details($user_id){ 
    $ci=& get_instance();
    $ci->load->database(); 

   				 
		
				 $ci->db->where('user_id',$user_id);
    	$query = $ci->db->get('agent_details');
    	return $query->result_array()[0];
}

function get_subadmin_details($user_id){
    $ci=& get_instance();
    $ci->load->database(); 

   				 
		
				 $ci->db->where('user_id',$user_id);
    	$query = $ci->db->get('subadmin_details');
    	return $query->result_array()[0];
}

function get_business_details($user_id){
    $ci=& get_instance();
    $ci->load->database(); 

                 
        
                 $ci->db->where('user_id',$user_id);
        $query = $ci->db->get('business_partners');
        return $query->result_array()[0];
}

function get_customer_details($user_id){
    $ci=& get_instance();
    $ci->load->database(); 

                 
        
                 $ci->db->where('user_id',$user_id);
        $query = $ci->db->get('customer_detail');
        return $query->result_array()[0];
}

function _vdate($date){
    return date('d-m-Y',strtotime($date));
}

function _ddate($date){
    return date('Y-m-d',strtotime($date));
}

function _suffix($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        echo $number. 'th';
    else
        echo $number. $ends[$number % 10];
}

function getIndianCurrency_inwords($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ?  ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $_word = ($Rupees ? $Rupees . 'Rupees ' : '') ;
    if(!empty($paise))
    {
        return $_word. ' and '.$paise; 
    }
    else
    {
        return $_word;
    }
}


function moneyFormatIndia($num) {
    $fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::CURRENCY);
    return $fmt->format($num);
}



function binary_tree_row($id)
{
    $ci=& get_instance();
    $ci->load->database(); 

    $ci->db->where('agent_id',$id);
    return $ci->db->get('binary')->result_array()[0];
}

function _fuser($id)
{
    $ci=& get_instance();
    $ci->load->database();
            $ci->db->where('user_type_id',$id);
    return $ci->db->get('user')->result_array()[0];
    
}

function _fuserdt($id)
{
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->where('user_type_id',$id['agent_id']);
    $user = $ci->db->get('user')->result_array()[0];

    $ci->db->where('user_id',$user['id']);
    if($user['id'] != 1){
        $detail = $ci->db->get('agent_details')->result_array()[0];
        return $detail['fi_name'].' '.$detail['la_name'];
    }
    else
    {
        $detail = $ci->db->get('subadmin_details')->result_array()[0];
        return $detail['first_name'].' '.$detail['last_name'];
    }
}

function _Bparent($main)
{
    if(!empty($main['parent']))
    {
        return "<br><small> Parent - ".$main['parent']."</small>";
    }
}

function _more_tree($main)
{
    return '<br><span><a href="'.base_url("tree/get/").$main["agent_id"].'"><i class="fa fa-plus"></i>More</a></span>';
}

function _whole_tree($main)
{
    return '<br><span><a href="'.base_url("tree/whole_tree/").$main["agent_id"].'"><i class="fa fa-plus"></i>More</a></span>';
}

function _Agstatus($status){
    if($status == '0')
    {
        return '</br><span class="badge badge-success">Active</span>';
    }
    else
    {
        return '</br><span class="badge badge-danger">In-Active</span>';
    }
} 


function read_more($string)
{
    if (strlen($string) > 15) {
        $trimstring = substr($string, 0, 15). '...';
    } else {
        $trimstring = $string;
    }
    return $trimstring;
}
?>