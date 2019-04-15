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

?>