<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Radiology extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index(){
		$cols=array();
		$ip = get_client_ip();
		$cols['ipaddress']=$ip;
		$cols['linktype']=3;
		$cols['access_date']= date('Y-m-d H:i:s');
		$this->db->insert('care_coordination_access', $cols);
		
		$result = $this->db->query("Select * from care_coordination where id='".$cols['linktype']."'")->row();
		redirect($result->url);  
	} 
}
