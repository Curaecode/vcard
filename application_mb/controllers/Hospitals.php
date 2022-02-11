<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitals extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index($linktype=1){
		$dataconfig=$this->model->getDatarow("config","where isVisible=1 AND name='provider' order by id asc");
		if($dataconfig->value==0){
			$cols=array();
			$ip = get_client_ip();
			$cols['ipaddress']=$ip;
			$cols['linktype']=$linktype;
			$cols['access_date']= date('Y-m-d H:i:s');
			$this->db->insert('care_coordination_access', $cols);
			$this->session->unset_userdata('hospitalcard'); 
			$result = $this->db->query("Select * from care_coordination where id='".$cols['linktype']."'")->row();
			  
			$data['url']=$result->embed;
			$this->load->view('qrcode/hospitals',$data); 
		}else{
			if($this->session->userdata('hospitalcard')){
				$cols=array();
				$ip = get_client_ip();
				$cols['ipaddress']=$ip;
				$cols['linktype']=$linktype;
				$cols['access_date']= date('Y-m-d H:i:s');
				$this->db->insert('care_coordination_access', $cols);
				$this->session->unset_userdata('hospitalcard'); 
				$result = $this->db->query("Select * from care_coordination where id='".$cols['linktype']."'")->row();
				  
				$data['url']=$result->embed;
				$this->load->view('qrcode/hospitals',$data);   
			}else{
				$data=array();
				$data['filename']=$linktype;
				$this->load->view('qrcode/hospitalcard',$data);   
			}
		} 
	} 
}
