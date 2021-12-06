<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('rasterize_wrapper'))
{
	function rasterize_wrapper($url='', $output=''){
	  if($url=='' || $output=='')
	    {
	      show_error('URL or Output file name not defined correctly');	
	      log_message('error','rasterize_wrapper: not initialized');
	      exit;
	    } 
	 
	 $phantomjs=exec('which phantomjs'); 
	 $response = exec($phantomjs.' --ssl-protocol=any  '.dirname(dirname(dirname(__FILE__))).'/js/rasterizecard.js '.$url.' '.$output,$output_status, $return_status);
	 	
	 if($return_status=='0'){ return true;}
		return false; 
	} 
} 

