<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surgery extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index(){
		if($this->session->userdata('hospitalcard')){
			$cols=array();
			$ip = get_client_ip();
			$cols['ipaddress']=$ip;
			$cols['linktype']=6;
			$cols['access_date']= date('Y-m-d H:i:s');
			$this->db->insert('care_coordination_access', $cols);
			$this->session->unset_userdata('hospitalcard'); 
			$result = $this->db->query("Select * from care_coordination where id='".$cols['linktype']."'")->row();
			$data['url']=$result->embed;
			$this->load->view('qrcode/hospitals',$data);
		}else{
			$data=array();
			$data['filename']=6;
			$this->load->view('qrcode/hospitalcard',$data);   
		} 
	} 
}
