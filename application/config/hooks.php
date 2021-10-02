<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
/* $hook['pre_controller'] = array(
    'class' => 'Loghook', 
    'function' => 'index', 
    'filename' => 'Loghook.php', 
    'filepath' => 'hooks', 
    'params' => array()
   );  */
   
 
$hook['post_controller'] = function(){
	$CI =& get_instance();
    $controller=$CI->router->class;
	$method=$CI->router->method;
	 
	$insert_data=array();
	$insert_data['controller_name']= $controller;
	$insert_data['method_name']= $method;
	$insert_data['date_time']= date('Y-m-d H:i:s');
	if($CI->session->userdata('adminId')){
		$insert_data['isadmin']= $CI->session->userdata('adminId');
	} 
	 
	$insert_data['ip_address']= $_SERVER['REMOTE_ADDR'];
	if(isset($_SERVER['HTTP_REFERER'])){
		$insert_data['ref_url'] = $_SERVER['HTTP_REFERER'];
	}
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$insert_data['actual_link']= $actual_link;
	
	if(isset($_POST) && !empty($_POST)){
		$insert_data['post_arg'	]= $CI->db->escape(json_encode($_POST)); 
	}
	if(isset($_GET) && !empty($_GET)){
		$insert_data['get_arg'	]= $CI->db->escape(json_encode($_GET)); 
	}
	 
	$CI->db->insert('rat_log_tbl',$insert_data);
};   