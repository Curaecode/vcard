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
	public function download($filename=''){
		
		
		if(!empty($filename)){ 
			$query=$this->db->query("update `contacts` set imagecounts= imagecounts+1 where md5(id) ='".$this->db->escape_str($filename)."'");	
			$rec = $this->db->query("SELECT * FROM contacts where md5(id) ='".$this->db->escape_str($filename)."'")->row();
			if(!empty($rec) && !empty($rec->image)){
				
				$ip = get_client_ip();
				
				$new_arr= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
			  
				$insert_data= array();
				$insert_data['access_date']= date('Y-m-d H:i:s');
				$insert_data['user_id']= $rec->id;
				$insert_data['ipaddress']= $ip;
				$insert_data['cardid']= $rec->image;
				$insert_data['Latitude']= $new_arr['geoplugin_latitude'];
				$insert_data['Longitude']= $new_arr['geoplugin_longitude'];
				if(isset($_SERVER['HTTP_REFERER'])){
					$insert_data['ref_url'] = $_SERVER['HTTP_REFERER'];
				}
				$this->db->insert('card_access_log',$insert_data);
				  
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
