<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function vcarddownload($filename='')
	{
		$file=explode('_',$filename);
		$id=preg_replace('/[^0-9.]/','',$file[count($file)-1]);
		$query=$this->db->query("update `contacts` set carddownload = carddownload+1 where id=".$id."");
		
		$data = file_get_contents('vcards/'.$filename);
		force_download($filename, $data);
		
	}
	public function download($filename=''){
		$file=explode('_',$filename);
		$id=$file[1];
		$query=$this->db->query("update `contacts` set imagecounts= imagecounts+1 where id=".$id."");	
		
		$path= "resources/cards/".$filename;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		header("content-type: image/". $type);
		echo file_get_contents($path);  
		
	} 
	public function views($filename='')
	{
		 
		$path= "resources/cards/".$filename;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		header("content-type: image/". $type);
		echo file_get_contents($path); 
	}
	
}
