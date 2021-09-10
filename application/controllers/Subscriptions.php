<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index()
	{
		$data=array();	
		if($this->input->post()){
			$cols=array();
			if($this->input->post('first_name')){
				$cols['first_name']=$this->input->post('first_name');
			}
			if($this->input->post('last_name')){
				$cols['last_name']=$this->input->post('last_name');
			}
			if($this->input->post('email')){
				$cols['email']=$this->input->post('email');
			}
			if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
				$cols['phone']=$this->input->post('area_code').''.$this->input->post('phone_first').''.$this->input->post('phone_second');
			}
			if($this->input->post('day') && $this->input->post('month') && $this->input->post('year')){ 
				$cols['dob']=$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
			}
			if(!empty($cols)){
				$cols['addeddate']=date('Y-m-d H:i:s');
				$this->db->insert('subscriptions', $cols);
				$data['msg']="contact is added! successfully.";
				$data['return']=true;
			}else{
				$data['msg']="contact is not added successfully.";
				$data['return']=false;
			}
			echo json_encode($data);
			die;
		}else{
			redirect(admin_url());
		} 
	}
	
}
