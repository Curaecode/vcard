<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Providers extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	} 
	public function index(){
		$data=array();  
		$this->load->view('qrcode/providerdetail',$data);
	}  
}
