<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curaechoice extends CI_Controller {
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
			if($this->input->post('card')){
				$filename=$this->db->escape_str($this->input->post('card'));
			}
			if(!empty($filename)){  
				if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
					$colsphone=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
				}
				if($colsphone=='3235696050'){
					$phonecodes = $colsphone;
				}else{
					$phonecodes = $colsphone;
				}
				$pcode=$this->db->escape_str($this->input->post('vcode'));
				$cols['vcode']=$pcode;
				$results = $this->db->query("Select * from card_image_codes where phone='$phonecodes' AND pcode='$pcode' AND isused= 0")->row();
				 
				if(!empty($results)){
					$query=$this->db->query("update `card_image_codes` set isused= 1 where id ='".$results->id."'");	
					
					$query=$this->db->query("update `contacts` set imagecounts= imagecounts+1 where md5(id) ='".$this->db->escape_str($filename)."'");	
					$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
					if(!empty($rec) && !empty($rec->image)){
						
						$ip = get_client_ip();  
						$insert_data= array();
						$insert_data['access_date']= date('Y-m-d H:i:s');
						$insert_data['user_id']= $rec->id;
						$insert_data['ipaddress']= $ip;
						$insert_data['cardid']= $rec->image; 
						if(isset($_SERVER['HTTP_REFERER'])){
							$insert_data['ref_url'] = $_SERVER['HTTP_REFERER'];
						}
						if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
							$insert_data['phone']=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
						}
						if($this->input->post('longitude')){
							$insert_data['Longitude']=$this->db->escape_str($this->input->post('longitude'));
						}
						if($this->input->post('latitude')){
							$insert_data['Latitude']=$this->db->escape_str($this->input->post('latitude'));
						}
						if($insert_data['phone']=='3235696050'){
							$insert_data['phone'] = '+92'.$insert_data['phone'];
						}else{
							$insert_data['phone'] = '+1'.$insert_data['phone'];
						}
						
						$pcode=$this->db->escape_str($this->input->post('vcode'));
						$insert_data['vcode']=$pcode;
						$this->db->insert('card_access_log',$insert_data);
						 $insert_id = $this->db->insert_id();
						$phonecodes = $insert_data['phone'];
						 
						$result = $this->db->query("Select * from contacts where phone='$phonecodes' AND md5(id)='$filename'")->row();
						
						if(!empty($result)){
							$this->db->where('id',$insert_id);
							$this->db->update('card_access_log',array('visible'=>1));
							
							$this->session->set_userdata(array('cardimage'=>$filename)); 
							echo json_encode(array('returned'=>true,'path'=>'curaechoice_'.$filename));
							exit;
						}
					}
				}  
			}
			echo json_encode(array('returned'=>false,'msg'=>'No card exist with your phone number.'));
		}
	}	
	public function download($filename=''){ 
		if($this->session->userdata('cardimage') && $this->session->userdata('cardimage')!=$filename){
			$this->session->unset_userdata('cardimage');
		}
		if($this->session->userdata('cardimage')){ 
			$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
			if(!empty($rec) && !empty($rec->image)){ 
				$path= "resources/cards/".$rec->image;
				$type = pathinfo($path, PATHINFO_EXTENSION);
				 $data['type']=$type;
				$data['image']=file_get_contents($path);
				$data['filename']=$filename;
				$this->session->unset_userdata('cardimage');
				$this->load->view('qrcode/cardimage',$data);
			}else{
				header("content-type: image/jpg");
				echo file_get_contents('resources/img/default.jpg');
			}  
		}else{
			if(!empty($filename)){  
				$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
				if(!empty($rec) && !empty($rec->image)){ 
					$data['filename']=$filename; 
					$this->load->view('qrcode/card',$data);
				}else{
					$type = pathinfo('resources/img/default.jpg', PATHINFO_EXTENSION);
					$data['type']=$type;
					$path = file_get_contents('resources/img/default.jpg');
					$data['image']=$path;
					$data['filename']=$filename; 
					$this->load->view('qrcode/nocardimage',$data);
				} 
			}else{
				$type = pathinfo('resources/img/default.jpg', PATHINFO_EXTENSION);
				$data['type']=$type;
				$path = file_get_contents('resources/img/default.jpg');
				$data['image']=$path;
				$this->load->view('qrcode/access404',$data);
			} 
			
		}
		
	} 
	function savecardview(){
		$filename='';
		if($this->input->post('card')){
			$filename=$this->db->escape_str($this->input->post('card'));
		}
		if(!empty($filename)){  
			$query=$this->db->query("update `contacts` set imagecounts= imagecounts+1 where md5(id) ='".$this->db->escape_str($filename)."'");	
			$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
			if(!empty($rec) && !empty($rec->image)){
				
				$ip = get_client_ip();  
				$insert_data= array();
				$insert_data['access_date']= date('Y-m-d H:i:s');
				$insert_data['user_id']= $rec->id;
				$insert_data['ipaddress']= $ip;
				$insert_data['cardid']= $rec->image; 
				if(isset($_SERVER['HTTP_REFERER'])){
					$insert_data['ref_url'] = $_SERVER['HTTP_REFERER'];
				}
				if($this->input->post('longitude')){
					$insert_data['longitude']=$this->db->escape_str($this->input->post('longitude'));
				}
				if($this->input->post('latitude')){
					$insert_data['latitude']=$this->db->escape_str($this->input->post('latitude'));
				}
				$this->db->insert('card_access_log',$insert_data);
				 
			}else{
				header("content-type: image/jpg");
				echo file_get_contents('resources/img/default.jpg');
			} 
		}
		
	}
	public function views($filename='')
	{
		if(!admin())
		{
			redirect(base_url().'admin/login');
		} 
		$path= "resources/cards/".$filename;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		header("content-type: image/". $type);
		echo file_get_contents($path); 
	}
	
}
