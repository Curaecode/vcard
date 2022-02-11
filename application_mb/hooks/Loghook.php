<?php
   class Loghook extends CI_Controller { 
     public function __construct()
    {
        parent::__construct();
 
    }
      public function index() { 
	  
       
		$controller=$this->router->class;
		$method=$this->router->method;
		 
		$insert_data=array();
		$insert_data['controller_name']= $controller;
		$insert_data['method_name']= $method;
		$insert_data['date_time']= date('Y-m-d H:i:s');
		 
		$insert_data['ip_address']= $_SERVER['REMOTE_ADDR'];
		if(isset($_SERVER['HTTP_REFERER'])){
			$insert_data['ref_url'] = $_SERVER['HTTP_REFERER'];
		}
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$insert_data['actual_link']= $actual_link;
		
		if(isset($_POST) && !empty($_POST)){
			$insert_data['post_arg'	]= $this->db->escape(json_encode($_POST)); 
		}
		if(isset($_GET) && !empty($_GET)){
			$insert_data['get_arg'	]= $this->db->escape(json_encode($_GET)); 
		}
		 
		$this->db->insert('rat_log_tbl',$insert_data);  
    }
  }
?>