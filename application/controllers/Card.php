<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Card extends CI_Controller{
	function __construct() { 
		parent::__construct();
		$this->load->model("admin/model");
	} 
	function index($id=1){
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
		 
		 $this->load->view('card/index',$data);
    }
}
?>