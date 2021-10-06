<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function openlink()
	{ 
		if($this->input->post()){
			$cols=array();
			if($this->input->post('longitude')){
				$cols['longitude']=$this->db->escape_str($this->input->post('longitude'));
			}
			if($this->input->post('latitude')){
				$cols['latitude']=$this->db->escape_str($this->input->post('latitude'));
			}
			if($this->input->post('linktype')){
				$cols['linktype']=$this->db->escape_str($this->input->post('linktype'));
			}
			if($this->input->post('phone')){
				$cols['phone']=$this->db->escape_str($this->input->post('phone'));
			} 
			$ip = get_client_ip();
			$cols['ipaddress']=$ip;
			$cols['access_date']= date('Y-m-d H:i:s');
			$this->db->insert('care_coordination_access', $cols);
			
			
			if(isset($cols['linktype'])){
				$result = $this->db->query("Select * from care_coordination where id='".$cols['linktype']."'")->row();
				/* redirect($result->url);  */ 
				
				$data['url']=$result->embed;
				$this->load->view('qrcode/hospitals',$data);  
			}
		}else{
			redirect(admin_url());
		}
	}
	public function getcode()
	{
		$data=array();	
		if($this->input->post()){
			if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
				$cols['phone']=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
			}
			
			$num_str = sprintf("%06d", mt_rand(100000,999999));
			$cols['pcode']=$num_str;
			$cols['addeddate']=date('Y-m-d H:i:s'); 
			$ip = get_client_ip();  
			$insert_data['ipaddress']= $ip;
			$this->db->insert('subscription_codes', $cols);
			
			
			
			$this->load->library('twilio'); 
			$phone = $cols['phone'];
			if($cols['phone']=='3235696050'){
				$phone = '+92'.$cols['phone'];
			}else{
				$phone = '+1'.$cols['phone'];
			}
			$response = $this->twilio->sendCode($phone,$num_str);  
			
			
			$colstwillio=array();
			$ip = get_client_ip();
			$colstwillio['ipaddress']=$ip;
			$colstwillio['logtype']='Subscription Access';
			$colstwillio['access_date']= date('Y-m-d H:i:s');
			if(isset($phone)){
				$colstwillio['phone']=$phone;
			}
			$colstwillio['code']=$num_str;
			$this->db->insert('twillio_logs', $colstwillio);
			
			
			
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
	public function getimagecode()
	{
		$data=array();	
		if($this->input->post()){
			if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
				$cols['phone']=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
			}
			if($this->input->post('card')){
				$cols['filename']=$this->db->escape_str($this->input->post('card'));
			}
			if($this->input->post('longitude')){
				$cols['longitude']=$this->db->escape_str($this->input->post('longitude'));
			}
			if($this->input->post('latitude')){
				$cols['latitude']=$this->db->escape_str($this->input->post('latitude'));
			}
			$ip = get_client_ip();  
			$insert_data['ipaddress']= $ip;
			if(isset($cols['phone'])){
				$num_str = sprintf("%06d", mt_rand(100000,999999));
				$cols['pcode']=$num_str;
				$this->db->insert('card_image_codes', $cols);
				 
				
				$this->load->library('twilio'); 
				$phone = $cols['phone'];
				if($cols['phone']=='3235696050'){
					$phone = '+92'.$cols['phone'];
				}else{
					$phone = '+1'.$cols['phone'];
				}
				$response = $this->twilio->sendCode($phone,$num_str);
				
				$colstwillio=array();
				$ip = get_client_ip();
				$colstwillio['ipaddress']=$ip;
				$colstwillio['logtype']='Card Image Access';
				$colstwillio['access_date']= date('Y-m-d H:i:s');
				if(isset($phone)){
					$colstwillio['phone']=$phone;
				}
				$colstwillio['code']=$num_str;
				$this->db->insert('twillio_logs', $colstwillio);
				
				
				if(isset($response->sid)){
					$data['msg']="Security code sent.";
					$data['status']=true;
				}else{
					$response['status']=0;
					$response['message']=$response;
				}
			}else{
				$data['msg']="Please enter phone number.";
				$data['status']=0;
			}
			echo json_encode($data);
			die;
		}
	}
	public function getqrimagecode()
	{
		$data=array();	
		if($this->input->post()){
			if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
				$cols['phone']=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
			}
			if($this->input->post('card')){
				$cols['filename']=$this->db->escape_str($this->input->post('card'));
			}
			if($this->input->post('longitude')){
				$cols['longitude']=$this->db->escape_str($this->input->post('longitude'));
			}
			if($this->input->post('latitude')){
				$cols['latitude']=$this->db->escape_str($this->input->post('latitude'));
			}
			$ip = get_client_ip();  
			$insert_data['ipaddress']= $ip;
			$cols['addeddate']=date('Y-m-d H:i:s'); 
			 
			
			if(isset($cols['phone'])){
				$num_str = sprintf("%06d", mt_rand(100000,999999));
				$cols['pcode']=$num_str;
				$this->db->insert('qrcard_image_codes', $cols);
				 
				
				$this->load->library('twilio'); 
				$phone = $cols['phone'];
				if($cols['phone']=='3235696050'){
					$phone = '+92'.$cols['phone'];
				}else{
					$phone = '+1'.$cols['phone'];
				}
				$response = $this->twilio->sendCode($phone,$num_str);
				
				
				$colstwillio=array();
				$ip = get_client_ip();
				$colstwillio['ipaddress']=$ip;
				$colstwillio['logtype']='QR Code Link Access';
				$colstwillio['access_date']= date('Y-m-d H:i:s');
				if(isset($phone)){
					$colstwillio['phone']=$phone;
				}
				$colstwillio['code']=$num_str;
				$this->db->insert('twillio_logs', $colstwillio);
				
				if(isset($response->sid)){
					$data['msg']="Security code sent.";
					$data['status']=true;
				}else{
					$response['status']=0;
					$response['message']=$response;
				}
			}else{
				$data['msg']="Please enter phone number.";
				$data['status']=0;
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
				$cols['first_name']=$this->db->escape_str($this->input->post('first_name'));
			}
			if($this->input->post('last_name')){
				$cols['last_name']=$this->db->escape_str($this->input->post('last_name'));
			}
			if($this->input->post('email')){
				$cols['email']=$this->db->escape_str($this->input->post('email'));
			}
			if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
				$cols['phone']=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
			}
			/* if($this->input->post('dob') && $this->input->post('month') && $this->input->post('year')){ 
				$cols['dob']=$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
			} */
			if($this->input->post('dob')){ 
				$dateofbirth = $this->db->escape_str($this->input->post('dob'));
				$dob= explode('/',$dateofbirth);
				$cols['dob']=$dob[2].'-'.$dob[0].'-'.$dob[1];
			}
			if(!empty($cols)){
				$phonecodes=$cols['phone'];
				$pcode=$this->db->escape_str($this->input->post('vcode'));
				$cols['vcode']=$pcode;
				$result = $this->db->query("Select * from subscription_codes where phone='$phonecodes' AND pcode='$pcode'  AND isused= 0")->row();
				if(!empty($result)){
					$this->db->query("update `subscription_codes` set isused= 1 where id ='".$result->id."'");
					
					$cols['phone']='+1'.$cols['phone'];
					$phonecodes=$cols['phone'];
					$email=$cols['email'];
					$result = $this->db->query("Select * from subscriptions where phone='$phonecodes' AND email='$email'")->row();
					if(empty($result)){
						$cols['addeddate']=date('Y-m-d H:i:s'); 
						$this->db->insert('subscriptions', $cols);
					}else{
						$this->db->where('id', $result->id);	
						$this->db->update('subscriptions', $cols);	
					}
					
					if($this->input->post('latitude')){
						$cols['latitude']=$this->db->escape_str($this->input->post('latitude'));
					}
					if($this->input->post('longitude')){
						$cols['longitude']=$this->db->escape_str($this->input->post('longitude'));
					} 
					$ip = get_client_ip();
					$cols['ipaddress']=$ip;
					$this->db->insert('subscription_access', $cols);
					
					$usedata=$cols;
					$this->session->set_userdata($usedata); 
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
