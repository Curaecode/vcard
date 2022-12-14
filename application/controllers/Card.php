<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Card extends CI_Controller{
	function __construct() { 
		parent::__construct();
		$this->load->model("admin/model");
	} 
	function index($id=0){ 
		if($id>0){
			$this->load->helper('phantomjs');
			$this->load->helper('url');
			$filename="cc_ex_f_".md5($id).".png";
			$url =  base_url()."card/front/$id/".md5($id);
			$filenamepath="/resources/cards/".$filename;
			
			if(!rasterize_wrapper($url,  dirname(dirname(dirname(__FILE__))).$filenamepath)){
				/* echo  'PNG Generation failed';
				exit; */
			} 
			$filename="cc_ex_b_".md5($id).".png";
			$url =  base_url()."card/back/$id/".md5($id);
			$filenamepath="/resources/cards/".$filename;
			
			if(!rasterize_wrapper($url,  dirname(dirname(dirname(__FILE__))).$filenamepath)){
				/* echo  'PNG Generation failed';
				exit; */
			} 
		}
		 
		
    } 
	/* function design($id=0,$enid=0){
		if(md5($id) == $enid){
			$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
			$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
			$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
			 
			$last_data=$this->model->getLastData2("contacts",$id);
			$company_id= $last_data->company_id;
			$contract_number= $last_data->contract_number;
			$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
			$data['contact']=$last_data;
			
			$this->db->select('*');
			$this->db->where('is_card',1);
			$query = $this->db->get( 'care_coordination' );
			$data['providers'] = $query->result(); 
			$this->load->view('card/indexpng',$data);
			
		} 
    } */
	function front($id=0,$enid=0){
		if($_SERVER['REMOTE_ADDR']=='45.79.129.195'){
			if(md5($id) == $enid){
				$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
				$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
				$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 				 
				$data['regdate']=$this->model->getDatarow("config","where isVisible=1 AND name='regdate'"); 
				 
				$last_data=$this->model->getLastData2("contacts",$id);
				$company_id= $last_data->company_id;
				$contract_number= $last_data->contract_number;
				$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
				$data['contact']=$last_data;
				
				$this->db->select('*');
				$this->db->where('is_card',1);
				$query = $this->db->get( 'care_coordination' );
				$data['providers'] = $query->result(); 
				$this->load->view('card/pngfront',$data);
				
			} 
		}
    }
	function frontdesign($id=0){
		 
			$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
			$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
			$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
			$data['regdate']=$this->model->getDatarow("config","where isVisible=1 AND name='regdate'"); 
			
			$last_data=$this->model->getLastData2("contacts",$id);
			$company_id= $last_data->company_id;
			$contract_number= $last_data->contract_number;
			$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
			$data['contact']=$last_data;
			
			$this->db->select('*');
			$this->db->where('is_card',1);
			$query = $this->db->get( 'care_coordination' );
			$data['providers'] = $query->result(); 
			$this->load->view('card/pngfront',$data);
			
		 
    }
	function back($id=0,$enid=0){
		if($_SERVER['REMOTE_ADDR']=='45.79.129.195'){
			if(md5($id) == $enid){
				$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
				$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
				$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
				
				$data['lineone']=$this->model->getDatarow("cardconfig","where isVisible=1 AND name='lineone'"); 
				$data['linetwo']=$this->model->getDatarow("cardconfig","where isVisible=1 AND name='linetwo'"); 
				$data['linethree']=$this->model->getDatarow("cardconfig","where isVisible=1 AND name='linethree'"); 
				 
				$last_data=$this->model->getLastData2("contacts",$id);
				$company_id= $last_data->company_id;
				$contract_number= $last_data->contract_number;
				$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
				$data['contact']=$last_data;
				
				$this->db->select('*');
				$this->db->where('is_card',1);
				$query = $this->db->get( 'care_coordination' );
				$data['providers'] = $query->result(); 
				$this->load->view('card/pngback',$data);
				
			}
		}			
    }
	function backdesign($id=0){
		 
			$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
			$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
			$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
			
			$data['lineone']=$this->model->getDatarow("cardconfig","where isVisible=1 AND name='lineone'"); 
			$data['linetwo']=$this->model->getDatarow("cardconfig","where isVisible=1 AND name='linetwo'"); 
			$data['linethree']=$this->model->getDatarow("cardconfig","where isVisible=1 AND name='linethree'"); 
			 
			$last_data=$this->model->getLastData2("contacts",$id);
			$company_id= $last_data->company_id;
			$contract_number= $last_data->contract_number;
			$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
			$data['contact']=$last_data;
			
			$this->db->select('*');
			$this->db->where('is_card',1);
			$query = $this->db->get( 'care_coordination' );
			$data['providers'] = $query->result(); 
			$this->load->view('card/pngback',$data);
		 
    }
}
?>