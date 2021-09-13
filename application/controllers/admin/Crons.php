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
					$qrtext = isset($last_data->ssn) ? $last_data->ssn:'';
					if(isset($qrtext)){
						$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/resources/qrimage/';
						$text = $qrtext;
						$text1= substr($text, 0,2);
						$folder = $SERVERFILEPATH;
						$file_name1 = $text1."-Qrcode" . md5($last_id) . ".png";
						$file_name = $folder.$file_name1;
						QRcode::png($text,$file_name);
						$qrimage_new_name = $file_name1;
						$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id=".$last_id."");
					}
					$last_data=$this->model->getLastData2("contacts",$last_id);
					$company_id= $last_data->company_id;
					$imagedata=$this->model->getimageData("companies",$company_id);
					$imagename=$imagedata->image;
					$font=realpath('resources/font/Facit Regular.otf');
					$image=imagecreatefromjpeg("resources/img/formate.jpg");
					$color=imagecolorallocate($image, 50, 51, 50);
					$fname=$last_data->first_name." ".$last_data->last_name;
					imagettftext($image, 15, 0, 102, 300, $color,$font, $fname); 
					$account_id=$last_data->account_code;
					imagettftext($image, 12, 0, 128, 338, $color,$font, $account_id);
					$date="$last_data->ssn";
					imagettftext($image, 9, 0, 60, 485, $color,$font, $date);
					$image_url = 'resources/admin/'.$imagedata->image;
					$watermark_image = imagecreatefromjpeg($image_url);
					$margin_right = 70; 
					$margin_bottom = 310;
					$watermark_image_width = imagesx($watermark_image);
					$watermark_image_height = imagesy($watermark_image);
					imagecopy($image, $watermark_image, imagesx($image) - $watermark_image_width - $margin_right, imagesy($image) - $watermark_image_height - $margin_bottom, 0, 0, $watermark_image_width, $watermark_image_height);
					$qrimage_url = 'resources/qrimage/'.$last_data->qrimage;
					$watermark_qr = imagecreatefrompng($qrimage_url);
					$margin_right = 15;
					$margin_bottom = 110;
					$watermark_qr_width = imagesx($watermark_qr);
					$watermark_qr_height = imagesy($watermark_qr);
					imagecopy($image, $watermark_qr, imagesx($image) - $watermark_qr_width - $margin_right, imagesy($image) - $watermark_qr_height - $margin_bottom, 0, 0, $watermark_qr_width, $watermark_qr_height);
					$random = rand(99999,999999999); 
					if (file_exists($_SERVER['DOCUMENT_ROOT']."/resources/cards/cc_ex_".md5($last_id).".jpg")) {
						 unlink($_SERVER['DOCUMENT_ROOT']."/resources/cards/cc_ex_".md5($last_id).".jpg");
					}
					imagejpeg($image,"resources/cards/cc_ex_".md5($last_id).".jpg");
					imagedestroy($image);
					$image_new_name = 'cc_ex_'.md5($last_id).'.jpg';
					
					$query=$this->db->query("update `contacts` set image= '".$image_new_name."' where id=".$last_id."");
					 
						$down = get_contacts_vcard($last_id);
						$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id='".$last_id."'");
					
						$qrimage_new = genrate_qrcode(base_url()."vcards/".$down,$last_id);
						$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new."' where id='".$last_id."'");
						$image_new = genrate_image($last_id);
						$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$last_id."'");
					 
				}
			}
		}
	} 
}
