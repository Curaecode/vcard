<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error403 extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
	}
	public function index()
	{
		$this->output->set_status_header('404'); 
		$data['title']="error 403";
		$data['active']="error 403";
		 $this->load->view('error403',$data);  
	}
	
}