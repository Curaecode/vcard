<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	function index(){
		header('HTTP/1.0 403 Forbidden');
		echo 'You are forbidden!';
		
	} 
	function card(){ 
		if($this->input->post()){
			$filename='';
			if($this->input->post('phone')){
				$phone=$this->db->escape_str($this->input->post('phone'));
				$query = $this->db->query("SELECT id,`first_name`,`last_name`,`phone`,`email`,'Contact' as ctype FROM contacts where phone LIKE '%".$phone."'");
				$contacts = $query->row_array();
				if(!empty($contacts)){
					echo json_encode(array('returned'=>true,'data'=>$contacts));
					exit;
				}else{
					$query = $this->db->query("SELECT id,`first_name`,`last_name`,`phone`,contract_number as pid,'Dependent' as ctype FROM contact_dependant where phone LIKE '%".$phone."'");
					$contacts = $query->row_array();
					if(!empty($contacts)){
						echo json_encode(array('returned'=>true,'data'=>$contacts));
						exit;
					}
				} 
			}
			 
			echo json_encode(array('returned'=>false,'msg'=>'No card exist with your phone number.'));
		}
	}
	 
}
