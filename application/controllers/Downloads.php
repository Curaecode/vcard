<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function download($filename='')
	{
		 
		  
	}
	public function view($filename='')
	{
		$path = $_SERVER['DOCUMENT_ROOT']."/resources/cards/".$filename;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		echo $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	}
	
}
