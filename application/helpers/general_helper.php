<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function pre_print($array)
{   
    echo count($array);
    echo "<pre>";
    print_r($array);
}


function _vdatetime($datetime)
{
	return date('d-m-Y h:i A',strtotime($datetime));
}



function year_db()
{

    $CI =& get_instance();
    $db = $CI->session->userdata('year');

	$config_app['hostname'] = 'localhost';
    $config_app['username'] = 'root';
    $config_app['password'] = '';
    $config_app['database'] = $db;
    $config_app['dbdriver'] = 'mysqli';
    $config_app['dbprefix'] = '';
    $config_app['pconnect'] = FALSE;
    $config_app['db_debug'] = TRUE;
    return $config_app;
}


function _checked($val1,$val2)
{
    if($val1 == $val2)
    {
        return 'checked';
    }
}

function moneyFormatIndia($amount): string {
    list ($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));

    $sign = $number < 0 ? '-' : '';

    $number = abs($number);

    for ($i = 3; $i < strlen($number); $i += 3)
    {
        $number = substr_replace($number, ',', -$i, 0);
    }

    return $sign . $number . '.' . $decimal;
}


function check_right($right)
{
    $CI =& get_instance();
    if($CI->session->userdata('id') != '1'){
        $counter = 0; 
        $user = $CI->db->get_where('user',['id' => $CI->session->userdata('id')])->result_array()[0];
        foreach (explode(',',$user['rights']) as $key => $value) {
            if($value == $right){
                $counter++;
            }
        }

        if($counter > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return true;
    }
}

function check_rights_column($rights)
{
    $CI =& get_instance();
    if($CI->session->userdata('id') != '1'){
        $counter = 0; 
        $user = $CI->db->get_where('user',['id' => $CI->session->userdata('id')])->result_array()[0];
        foreach (explode(',',$user['rights']) as $key => $value) {
            if(in_array($value, $rights)){
                $counter++;
            }
        }

        if($counter > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return true;
    }
}

function get_head_value_by_index($index,$head)
{
    $CI =& get_instance();
    return $CI->db->get_where('head_values',['index' => $index , 'head' => $head])->result_array()[0]['value'];
}

function remove_str($str,$strip_str)
{
    if (strpos($str,$strip_str) !== false) {
        return str_replace($strip_str,"",$str);
    }
    else{
        return $str;   
    }
}

    


?>