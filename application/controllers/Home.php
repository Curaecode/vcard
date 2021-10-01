<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index()
	{
		redirect(admin_url());
	}
	
	public function hospital()
	{
		$result = $this->db->query("Select * from care_coordination where id='1'")->row();
		$data['url']=$result->embed;
		$this->load->view('qrcode/hospitals',$data);  
	}
	
}
