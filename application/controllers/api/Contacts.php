<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Contacts extends REST_Controller {
     
    public function __construct() {
       parent::__construct(); 
	   if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit(0);
		}	
	   $this->load->model("admin/model");
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
		$data = array();
		if($_SERVER['REMOTE_ADDR']=='45.79.129.195'){
			
			$coloumns=array(
					"contacts.id as cid",
					"contacts.first_name",
					"contacts.last_name",
					"contacts.email",
					"contacts.dob",
					"contacts.secondaryemail", 
					"contacts.phone",     
					"contacts.dependent as dependents",
					"contacts.contract_number",
					"contacts.account_code", 
					"contacts.image", 
					"contacts.date as dated",
					"contacts.date as dttime" 
					);
			$searchFields=array();
			$fields=implode(",",$coloumns);
			$sql="select $fields from contacts  left join states on contacts.state_id=states.id left join country on contacts.country_id=country.id LEFT JOIN contact_dependant cd ON contacts.contract_number = cd.contract_number where contacts.id > 0 group by contacts.id";
			 
		 
			$results=$this->db->query($sql)->result();
			
			$values=array();
			foreach($results as $key){
				$contract_number= $key->contract_number;
				$sqlOcc = "SELECT contact_dependant.id as cid, contact_dependant.first_name, contact_dependant.last_name,contact_dependant.email, contact_dependant.dob, contact_dependant.relationship, contact_dependant.phone, contact_dependant.contract_number as pid,
									  @rownum := @rownum + 1 AS ROW_NUMBER
								FROM `contact_dependant`
								CROSS JOIN (SELECT @rownum := 0) r
								WHERE contract_number='$contract_number'
								ORDER BY CASE when relationship = 'Male Spouse' OR relationship = 'Female Spouse' THEN 1 ELSE 2 END  ASC";
									
							$dependant_data = $this->db->query($sqlOcc)->result_array();

				$value=(array)$key;
				$value['total_depend']=count($dependant_data);
				$value['dependents']=$dependant_data;
				$value['domain']=base_url();
				$values[]=$value;			
							
			}
			
			$data['success']=true;
			$data['data']=$values;
			$this->response($data, REST_Controller::HTTP_OK);
		}else{
			$data['success']=true;
			$data['data']=array();
			$this->response($data, REST_Controller::HTTP_OK);
		}
	}
      
     
    	
}