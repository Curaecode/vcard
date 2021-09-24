
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
	function updateqrimages(){
		$query=$this->db->query("update `contacts` set qrimage=''");
		/* $results = $this->db->query("select * from contacts  order by id ASC")->result();
		if(!empty($results)){
			foreach($results as $row){
				$id=$row->id; 
				$query=$this->db->query("update `contacts` set qrimage='' where id='".$id."'");
			}
		} */
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
