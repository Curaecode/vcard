<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index(){
		$data=array(); 
		if($this->session->userdata('vcode')){
			redirect(base_url().'qrcode/detail');
		}
		$this->load->view('qrcode/index',$data);
	}
	public function detail(){
		$data=array(); 
		if(!$this->session->userdata('vcode')){
			redirect(base_url().'qrcode/index');
		} 
		$this->load->view('qrcode/detail',$data);
	} 
}
