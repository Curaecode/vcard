
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class crons extends CI_Controller {
	public function __construct()
	{
		 parent::__construct();		 
		 ini_set('max_execution_time', 180000);
		ini_set('fastcgi_read_timeout', 99999999);
		 ini_set('memory_limit', "-1");
		$this->load->model("admin/model");
		 
		
	}
	function getrecords(){
		$boardconfig=$this->model->getDatarow("config","where isVisible=1 AND name='boardid'");
		$board_id = $boardconfig->value;
		if(empty($board_id)){
			$board_id = 2280948755;
		}
		$pageconfig=$this->model->getDatarow("monday_records");
		
		$page=$pageconfig->page_no;
		
		/* $board_id = 2280948755; */
		$id_group='Last Name';
		ini_set('max_execution_time', 30000);
		require 'vendor/autoload.php';
		$token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjEzODU5MzI0NSwidWlkIjoyNDE0NTk2NiwiaWFkIjoiMjAyMS0xMi0yOFQxNzo1NToyOS40OTNaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6OTc4MjkxNSwicmduIjoidXNlMSJ9.usqIE8tzY7jA7f4stNl24cK-ledYRITunNUiqIQr7Iw';
		$MondayBoard = new TBlack\MondayAPI\MondayBoard();
		$MondayBoard->setToken(new TBlack\MondayAPI\Token($token));
		
		
		$board = $MondayBoard->on($board_id)->getBoards();
		$query = '
			  boards (ids: '.$board_id.') {
				items(limit:200, page:'.$page.') {
				  id
				  name
				  column_values {
					id
					title
					text
					value
				  }
				}
			  }'; 
			
		$items = $MondayBoard->customQuery( $query );
		
		if(!empty($items['boards'][0]['items'])){
			$item= $items['boards'][0]['items'];
			$columnheader = $item[0]['column_values'];
			foreach($item as $critem){
				$phonenumber1='';
				$phonenumber2='';
				$col=array();
				$columnheader = $critem['column_values'];
				$col['last_name']=$critem['name'];
				$col['monday_id']=$critem['id'];
				/* $col['mondid']=$critem['id']; */
				print_r($col);
				foreach($columnheader as $cols){
					if(strtolower(trim($cols['title']))=='first name'){$col['first_name']=$cols['text'];} 
					if(strtolower(trim($cols['title']))=='dob'){$col['dob']=$cols['text'];}
					if(strtolower(trim($cols['title']))=='sex'){$col['gender']=$cols['text'];}
					if(strtolower(trim($cols['title']))=='mi'){$col['miname']=$cols['text'];}
					if(strtolower(trim($cols['title']))=='relation'){$col['relationship']=$cols['text'];}
					if(strtolower(trim($cols['title']))=='address' || strtolower(trim($cols['title']))=='address (#1)'){$col['address']=$cols['text'];}
					if(strtolower(trim($cols['title']))=='city'){$col['city']=$cols['text'];}
					  
					if(strtolower(trim($cols['title']))=='state'){
						$col['state_name']=$cols['text']; 
						$getindustryid=0;
						$getIdQuery = "SELECT * from states where iso2 = '".$cols['text']."' AND country_id = 233";
						$getIdRows = $this->db->query($getIdQuery);
						if ($getIdRows->num_rows() > 0){
							$getindustryid = $getIdRows->row();
							$state_id = $getindustryid->id;
							$col['state_id']=$state_id;
							$country_id = $getindustryid->country_id;
							$col['country_id']=$country_id;
						}else{
							$col['state_id']=$cols['text'];
							$col['country_id']=233;
						}
					}
					
					if(strtolower(trim($cols['title']))=='zip code'){$col['zipcode']=$cols['text'];} 
					if(strtolower(trim($cols['title']))=='contract number' || strtolower(trim($cols['title']))=='policy #'){$col['contract_number']=$cols['text'];} 
					if(strtolower(trim($cols['title'])) == 'phone' || strtolower(trim($cols['title'])) == 'mobile (cell) number' || strtolower(trim($cols['title'])) == 'phone number' || strtolower(trim($cols['title'])) == 'Phone - CELL' || strtolower(trim($cols['title'])) == 'ph #'){ 
						if($cols['text']!='DUPLICATE' || $cols['text']!='duplicate'){
							$phonenumber2=$cols['text'];
						} 
					}
					if(strtolower(trim($cols['title'])) == 'area code'){ 
						$phonenumber1=$cols['text'];
					} 
					if(strtolower(trim($cols['title'])) == 'email address' || strtolower(trim($cols['title'])) == 'email'){
						$col['email']=$cols['text'];
					} 	
				}
				
				$newvalues = preg_replace("/[^0-9+]/", "", $phonenumber1.''.$phonenumber2);
		 
				if(!empty($newvalues)){
					$mystring = $newvalues; 
					$findme   = '+1';
					$pos = strpos($mystring, $findme); 
					if ($pos === false) {
						$newvalues = '+1'.$newvalues;
					}
					$col['phone']=$newvalues;
				} 
				
				$newvalues = $col['relationship'];
				$mystring = $newvalues; 
				$findme   = 'SUBSCRIBER';
				$pos = strpos($mystring, $findme);
				$findme   = 'EMPLOYEE';
				$pos1 = strpos($mystring, $findme);
				
				if ($pos === false && $pos1 === false) { 
					unset($col['company_id']); 
					unset($col['industry_id']);
					unset($col['country_id']);
					unset($col['state_id']);
					unset($col['group_id']);
					unset($col['gender']);
					
					$col['last_name']=$critem['name'];
					$col['monday_id']=$critem['id'];
					$col['patient_id'] = $col['monday_id'];
					  $SQL='Select * from `contact_dependant` WHERE patient_id="'.$col['monday_id'].'"';
					/* $getIdRows = $this->db->query($SQL)->row(); */
					$query = $this->db->query($SQL);
					$getIdRows = $query->row();
					if(empty($getIdRows)){ 
						$col['last_name']=$critem['name'];
						$col['monday_id']=$critem['id'];
						$last_id = $this->model->add('contact_dependant',$col);
						$col['monday_id']=0;
					}
					 
				}else{
						if(!isset($col['company_id'])){
							$col['company_id']=1;
						}
						if(!isset($col['industry_id'])){
							$col['industry_id']=1;
						}
						if(!isset($col['group_id'])){
							$col['group_id']=1;
						} 
						$col['location_id'] = 22;
						$col['qrimage'] = '';
						$col['patient_id'] = $col['monday_id'];
						$col['active_member'] = date('Y-m-d');
						$col['last_name']=$critem['name'];
						$col['monday_id']=$critem['id'];
						if(isset($col['monday_id'])){
							/* $query='Select * from `contacts` WHERE monday_id="'.$col['monday_id'].'"';
							$getIdRows = $this->db->query($query)->row(); */
							echo $SQL='Select * from `contacts` WHERE patient_id="'.$col['monday_id'].'"';
							$query = $this->db->query($SQL);
							$getIdRows = $query->row();
					
							if(!empty($getIdRows)){
								/* if ($this->model->updateDataContact('contacts',$col['contract_number'],$col)){
									$last_id=$getIdRows->id;
								} */
								$last_id=$getIdRows->id;
							}else{
								$col['last_name']=$critem['name'];
								$col['monday_id']=$critem['id'];
								$last_id = $this->model->add('contacts',$col);
								$col['monday_id']=0;
								$account_id = generateID($last_id);
								$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id=".$last_id.""); 
							} 	
						}
						  
					}
				
			} 
			 $this->db->query("update `monday_records` set page_no= ".($page+1).", date_added='".date('Y-m-d H:i:s')."' "); 
		
		}else{
			/* $this->db->query("update `monday_records` set page_no= 1, date_added='".date('Y-m-d H:i:s')."'");  */
		}
		
	} 
	function updateunique(){
		$results = $this->db->query("select * from contacts where ssn = account_code  order by id ASC LIMIT 0,1000")->result();
		if(!empty($results)){
			foreach($results as $row){
				$id=$row->id;
				$account_id = generateID($id);
				$query=$this->db->query("update `contacts` set qrimage='', account_code= '".$account_id."' where id='".$id."'");
			}
		}
	}
	function updateimages(){
		$myfile = fopen($_SERVER['DOCUMENT_ROOT'].'/resources/newfile.txt', "w");
		 $txt = "Time: ".date('Y-m-d h:i A');
		fwrite($myfile, $txt);
		$results = $this->db->query("select * from contacts where qrimage is null OR qrimage=''  order by id DESC LIMIT 0,500")->result();
		$txt = "Total: ".count($results);
		fwrite($myfile, $txt);
		fclose($myfile);
		
		if(!empty($results)){
			foreach($results as $row){
				$last_id=$row->id;
				if($last_id > 0){
					$last_data=$this->model->getLastData2("contacts",$last_id);
					$this->load->library('phpqrcode/qrlib');
					 
					/* $down= (md5($last_data->first_name."_".$last_data->last_name.'_'.$last_id).'_'.$last_id.'.vcf');
					$qrimage_new = genrate_qrcode(base_url()."vcards/".$down,$last_id); */ 
					$qrimage_new = genrate_qrcode(base_url()."qrcode_".md5($last_id),$last_id);  
					$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new."' where id='".$last_id."'");
					
					$image_new = genrate_image($last_id);
					$query=$this->db->query("update `contacts` set image= '".$image_new."' where id=".$last_id."");  
					
					$down = get_contacts_vcard($last_id);
					$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id='".$last_id."'");
					
						/* $qrimage_new = genrate_qrcode(base_url()."vcards/".$down,$last_id);
						$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new."' where id='".$last_id."'");
						$image_new = genrate_image($last_id);
						$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$last_id."'"); */
					 
				}
			}
		}
	} 
}
