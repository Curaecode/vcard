<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
class M_pdf {  
	public $param;  
	public $pdf;  
	public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3') { 
		$CI = & get_instance(); 
	} 
	function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($param == NULL)
        {
			//'mode,format,font size,font family,margin_left,margin right,margin top,margin bottom,margin header,margin footer,LOrP';
            $param = '"","A4-L",0,"",5,5,5,5,6,3,"L"';         
        }
         $params = explode(',',$param); 
		 if(count($params)<11){
			 $param = '"","A4-L",0,"",5,5,5,5,6,3,"L"'; 
			 $params = explode(',',$param); 
		 }
		 /* print_r($params);
		 exit; */
        /* return new mPDF("en-GB-x","A4","","",5,5,5,5,6,3,'L'); */
        
		return new mPDF($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10]);
		 
        //return new mPDF("en-GB-x","A4",36,"",6,6,6,6,3,1,'L');
    }
}
?>