<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function getcode()
	{
		$data=array();	
		if($this->input->post()){
			if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
				$cols['phone']=$this->input->post('area_code').''.$this->input->post('phone_first').''.$this->input->post('phone_second');
			}
			$num_str = sprintf("%06d", mt_rand(100000,999999));
			$cols['pcode']=$num_str;
			$this->db->insert('subscription_codes', $cols);
			
			$this->load->library('twilio'); 
			$phone = $cols['phone'];
			if($cols['phone']=='3235696050'){
				$phone = '+92'.$cols['phone'];
			}else{
				$phone = '+1'.$cols['phone'];
			}
			$response = $this->twilio->sendCode($phone,$num_str);
			if(isset($response->sid)){
				$data['msg']="Security code sent.";
				$data['status']=true;
			}else{
				$response['status']=0;
				$response['message']=$response;
			}
			
			echo json_encode($data);
			die;
		}
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
				$phonecodes=$cols['phone'];
				$pcode=$this->input->post('vcode');
				$cols['vcode']=$pcode;
				$result = $this->db->query("Select * from subscription_codes where phone='$phonecodes' AND pcode='$pcode'")->row();
				if(!empty($result)){
					$cols['phone']='+1'.$cols['phone'];
					$cols['addeddate']=date('Y-m-d H:i:s');
					$this->db->insert('subscriptions', $cols);
					/* session_start();
					$_SESSION["vcode"] = $pcode;
					
					$data['vcode']=$_SESSION["vcode"]; */
					$data['msg']="contact is added! successfully.";
					$data['returned']=true;
					
				}else{
					$data['msg']="Please enter correct security code.";
					$data['returned']=false;
				} 
			}else{
				$data['msg']="contact is not added successfully.";
				$data['returned']=false;
			}
			echo json_encode($data);
			die;
		}else{
			redirect(admin_url());
		} 
	}
	
}
