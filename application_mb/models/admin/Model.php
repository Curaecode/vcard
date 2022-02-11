<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
	 public function __construct()
    {
        parent::__construct(); 
    }
	public function add($table,$data){
		$this->db->insert($table,$data);
		if($this->db->insert_id() > 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function getPassword($email){
		return $this->db->query("Select id,password,type from admin where email='$email' or user_name='$email'")->row();
	}
	public function getById($table,$id){
		// echo "Select * from `$table` where id=$id";
		// die;
		return $this->db->query("SELECT * FROM `$table` where id=$id")->row();
	}
	public function getByIdvcard($table,$id){
		// echo "Select * from `$table` where id=$id";
		// die;
		return $this->db->query("SELECT * FROM `$table` WHERE id=$id")->result();
	}
	public function getLocation_byid($table,$id){
		// echo "Select * from `$table` where id=$id";
		// die;
		return $this->db->query("SELECT * FROM `$table` WHERE company_id=$id")->result();
	}
	public function getState_byid($table,$id){
		// echo "Select * from `$table` where id=$id";
		// die;
		return $this->db->query("SELECT * FROM `$table` WHERE country_id=$id")->result();
	}
	public function getByIdvcard_company($table,$id){
		return $this->db->query("Select * from `$table` where company_id=$id")->result();
	}
	public function getByIdCountry($table,$id){
		if($table=='states'){
			return $this->db->query("Select * from `$table` where country_id=$id ORDER BY state_name ASC")->result();
		}else{
			return $this->db->query("Select * from `$table` where country_id=$id")->result();
		} 
	}
	public function getByIdcompany($id){

		return $this->db->query("Select * from `companies` where id='$id'")->row();

	}
	public function getlocation($id){

		return $this->db->query("Select * from `locations` where company_id='$id'")->row();

	}
	public function getData($table,$where="where 1=1"){
		// echo "Select * from `$table` $where";
		// die;
		return $this->db->query("Select * from `$table` $where")->result();
	}
	public function getDatarow($table,$where="where 1=1"){
		// echo "Select * from `$table` $where";
		// die;
		return $this->db->query("Select * from `$table` $where")->row();
	}
	
	public function updateData($table,$id,$data)
	{
		return $this->db->where('id',$id)->update($table, $data);
	}
	public function updateDataContact($table,$id,$data)
	{
		return $this->db->where('patient_id',$id)->update($table, $data);
	}
	public function addData($table,$data)
	{
		return $this->db->insert($table, $data);
	}
	
	public function deleteData($table,$id)
	{
		return $this->db->query("delete from $table where id=$id");
	}
	public function deleteDatauser($table,$id)
	{
		return $this->db->query("delete from $table where group_name_id=$id");
	}
	public function getCustomData($col,$table,$where="where 1=1"){
		// echo "Select $col from `$table` $where";
		// die;
		return $this->db->query("Select $col from `$table` $where")->result();
	}
	function getLastData($table)
	{
		return $this->db->query("select * from $table order by id DESC LIMIT 1")->row();
	}
	function getLastData2($table,$id)
	{
		return $this->db->query("select * from $table where id=$id")->row();
	}
	function getLastData4($table,$contract_number)
	{
		return $this->db->query("select * from $table where contract_number='$contract_number'")->row();
	}
	function getLastData3($table,$contract_number)
	{
		return $this->db->query("select * from $table where contract_number='$contract_number'")->result();
	}
	function getdependents($table,$contract_number)
	{
		return $this->db->query("select * from contact_dependant where contract_number='$contract_number' ORDER BY CASE when relationship = 'Male Spouse' OR relationship = 'Female Spouse' THEN 1 ELSE 2 END  ASC")->result();
	}
	function getimageData($table,$id)
	{
		return $this->db->query("select * from $table where id=$id")->row();
	}
	function checkuser($email,$username,$id = 0)
	{
		if($id>0){
			return $this->db->query("Select * from admin where (email='$email' or user_name='$username') AND id <> $id ")->row();
		}else{
			return $this->db->query("Select * from admin where email='$email' or user_name='$username'")->row();
		}
		
	}
	
	
	public function insert($data) {
		$res = $this->db->insert_batch('user',$data);
		if($res){
		return TRUE;
		}else{
		return FALSE;
		}
	}

}
?>