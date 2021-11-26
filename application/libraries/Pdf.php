<?php

class Pdf {

    function Pdf() {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($params = NULL) {
        require_once APPPATH .'third_party/pdf/mpdf.php'; 
		if ($params == NULL) { 
			 $params=array("",'A4-L',0,"",0,0,0,0,0,0,"P");	
        }
      
		return new mPDF($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10]);
		
    }

}