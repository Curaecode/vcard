<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class M_pdf {   
	public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3') { 
		$CI = & get_instance(); 
	} 
	function load($params=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL) { 
			 $params=array("",'A4-L',0,"",0,0,0,0,0,0,"P");	
        }
      
		return new mPDF($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10]);
		 
    }
}
?>