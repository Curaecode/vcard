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
						 
						$result = $this->db->query("Select c.* from contacts c LEFT JOIN contact_dependant cd ON c.contract_number = cd.contract_number where (c.phone='$phonecodes' OR cd.phone='$phonecodes') AND md5(c.id)='$filename'")->row();
						
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
	function vcard(){
		
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
				$results = $this->db->query("Select * from qrcard_image_codes where phone='$phonecodes' AND pcode='$pcode' AND isused= 0")->row();
				 
				if(!empty($results)){
					$query=$this->db->query("update `qrcard_image_codes` set isused= 1 where id ='".$results->id."'");	
					 	
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
						$this->db->insert('qrcard_access_log',$insert_data);
						 $insert_id = $this->db->insert_id();
						$phonecodes = $insert_data['phone'];
						 
						/* $result = $this->db->query("Select * from contacts where phone='$phonecodes' AND md5(id)='$filename'")->row(); */
						$result = $this->db->query("Select c.* from contacts c LEFT JOIN contact_dependant cd ON c.contract_number = cd.contract_number where (c.phone='$phonecodes' OR cd.phone='$phonecodes') AND md5(c.id)='$filename'")->row();
						if(!empty($result)){
							$this->db->where('id',$insert_id);
							$this->db->update('qrcard_access_log',array('visible'=>1));
							
							$this->session->set_userdata(array('vcardimage'=>$filename)); 
							echo json_encode(array('returned'=>true,'path'=>'qrcode_'.$filename));
							exit;
						}
					}
				}  
			}
			echo json_encode(array('returned'=>false,'msg'=>'No card exist with your phone number.'));
		}
	}	
	
	function hospitalcard(){
		
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
				$results = $this->db->query("Select * from subscription_codes where phone='$phonecodes' AND pcode='$pcode' AND isused= 0")->row();
				 
				if(!empty($results)){
					$query=$this->db->query("update `subscription_codes` set isused= 1 where id ='".$results->id."'");	
					 	
					 
						
						$ip = get_client_ip();  
						$insert_data= array();
						$insert_data['access_date'] = date('Y-m-d H:i:s');
						 
						$insert_data['ipaddress']= $ip;
						$insert_data['linktype']= $filename; 
						 
						if($this->input->post('area_code') && $this->input->post('phone_first') && $this->input->post('phone_second')){
							$insert_data['phone']=$this->db->escape_str($this->input->post('area_code')).''.$this->db->escape_str($this->input->post('phone_first')).''.$this->db->escape_str($this->input->post('phone_second'));
						}
						if($this->input->post('longitude')){
							$insert_data['longitude']=$this->db->escape_str($this->input->post('longitude'));
						}
						if($this->input->post('latitude')){
							$insert_data['latitude']=$this->db->escape_str($this->input->post('latitude'));
						}
						if($insert_data['phone']=='3235696050'){
							$insert_data['phone'] = '+92'.$insert_data['phone'];
						}else{
							$insert_data['phone'] = '+1'.$insert_data['phone'];
						} 
						 
						$this->db->insert('care_coordination_access',$insert_data);
						 
						$insert_id = $this->db->insert_id();
						$phonecodes = $insert_data['phone']; 
						
						$this->session->set_userdata(array('hospitalcard'=>$filename)); 
						echo json_encode(array('returned'=>true));
						exit;  
						  
				} 
			}
			echo json_encode(array('returned'=>false,'msg'=>'No card exist with your phone number.'));
		}
	}	
	public function download($filename=''){ 
		    /* $this->session->set_userdata(array('cardimage'=>$filename)); */    
		if($this->session->userdata('cardimage') && $this->session->userdata('cardimage')!=$filename){
			$this->session->unset_userdata('cardimage'); 
		}  
		
		  if($this->session->userdata('cardimage')){ 
			$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
			if(!empty($rec) && !empty($rec->image)){ 
				$path= "resources/cards/".$rec->image;
				 
				$data['filename']=$filename;
				$data['id']=$rec->id; 
				$data['contactid']=$rec->id; 
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
					$data['id']=$rec->id; 
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
	
	public function qrcode($filename=''){ 
		if($this->session->userdata('vcardimage') && $this->session->userdata('vcardimage')!=$filename){
			$this->session->unset_userdata('vcardimage');
		}
		if($this->session->userdata('vcardimage')){ 
			$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
			if(!empty($rec) && !empty($rec->vcard_name)){  
				$this->session->unset_userdata('vcardimage');
				$filename=$rec->vcard_name;
				$this->load->helper('download'); 
				$data = file_get_contents('vcards/'.$filename);
				force_download($filename, $data); 
			}else{
				header("content-type: image/jpg");
				echo file_get_contents('resources/img/default.jpg');
			}  
		}else{
			if(!empty($filename)){  
				$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
				if(!empty($rec) && !empty($rec->image)){ 
					$data['filename']=$filename; 
					$this->load->view('qrcode/vcard',$data);
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
		/* $type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path); */
		/* header("content-type: image/". $type);
		echo file_get_contents($path); */
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-type: image/png");
		readfile($path);	
	}
	public function cardimage($filename='')
	{   
		$path= "resources/cards/".$filename; 
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-type: image/png");
		readfile($path);	
	}
	function getvcard($dat)
    {
        $datavcarddata = array();
        foreach($dat as $data)
        {
	        $datavcarddata['display_name'] = $data->first_name." ".$data->last_name; 
	        $datavcarddata['first_name'] = $data->first_name; 
	        $datavcarddata['last_name'] = $data->last_name;                                                 
	        $datavcarddata['cell_tel'] = $data->phone;                
	        $datavcarddata['email1'] = $data->email; 
	        //$datavcarddata['work_address'] = $data->address;
	        $datavcarddata['company'] = getcompanyById($data->company_id);
	       	if($data->image!="")
	       	{
			    $getPhoto = file_get_contents('resources/cards/'.$data->image);
			    $b64vcard  = base64_encode($getPhoto);
			    $b64mline   = chunk_split($b64vcard,74,"\n");
			    $b64final   = preg_replace('/(.+)/', ' $1', $b64mline);
			    $photo       = $b64final;
			}
	        $datavcarddata['photo'] =$photo;
	        if (is_array($datavcarddata))
	        {    
	            $this->vcard->vcard($datavcarddata);
	        }
	        else
	        {
	            $this->vcard->vcard();
	        }
        	$this->vcard->downloadfile(); 
        }
        return $datavcarddata;
    }
}
