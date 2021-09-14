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
		if(!empty($filename)){ 
			$query=$this->db->query("update `contacts` set imagecounts= imagecounts+1 where md5(id) ='".$this->db->escape_str($filename)."'");	
			$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
			if(!empty($rec) && !empty($rec->image)){
				$path= "resources/cards/".$rec->image;
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				header("content-type: image/". $type);
				echo file_get_contents($path);
			}else{
				header("content-type: image/jpg");
				echo file_get_contents('resources/img/default.jpg');
			} 
		}else{
			header('HTTP/1.0 403 Forbidden');
			echo 'You are forbidden!';
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
