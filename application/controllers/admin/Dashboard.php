<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct()
	{
		 parent::__construct();		 
		 ini_set('max_execution_time', 180000);
		ini_set('fastcgi_read_timeout', 99999999);
		 ini_set('memory_limit', "-1");
		$this->load->model("admin/model");
		//$this->load->helper(array('url','html','form'));
		if(!admin())
		{
			redirect(base_url().'admin/login');
		}
		
	}
	public function index()
	{
	    
		// genrate_image(67);die();
		$data['title']="Dashboard";
		$data['active']="dashboard";
		//$data['controller']="dashboard";
		generateView('index',$data);
	}
	public function home($page="index")
	{
	   // echo "string";
	   // die();
		//$_GET=escapeArray($this->input->get());
		//$formData=escapeArray($this->input->post());
		//$data['controller']="dashboard";
		//switch($page){
			//case "index":
			$data['title']="Dashboard";
			$data['active']="dashboard";
			$data['groups']=count($this->model->getData("groups"));
			$data['contacts']=count($this->model->getData("contacts"));
			$data['companies']=count($this->model->getData("companies"));
			
			generatePageView('index',$data);
			//break;
		//}
	}
	public function getlocations(){
		$id=$_POST['id'];
		$location=$this->model->getByIdvcard_company("locations",$id);
		$location_select='';
		if(!empty($location)){
			$location_select .="<option value=''>--Select location name--</option>";
			foreach($location as $val){
				$location_select .="<option value='".$val->id."' >".$val->location_name."</option>";
			}
		}
		echo json_encode($location_select);
	}
	public function getlocations_edit(){
		$id_con=$_POST['id'];
		$edit=$this->model->getById("contacts",$id_con);
		$id=$edit->location_id;
		$location=$this->model->getByIdvcard("locations",$id);
		$location_select='';
		if(!empty($location)){
			$location_select .="<option value=''>--Select location name--</option>";
			foreach($location as $val){
				$selected=isset($edit->location_id)&&$val->id==$edit->location_id?"selected":"";
				$location_select .="<option value='".$val->id."' ".$selected.">".$val->location_name."</option>";
			}
		}
		echo json_encode($location_select);
	}
	public function getcountry(){
		$id=$_POST['id'];
		$states=$this->model->getByIdCountry("states",$id);
		$state_select='';
		if(!empty($states)){
			$state_select .="<option value=''>--Select State name--</option>";
			foreach($states as $val){
				$state_select .="<option value='".$val->id."' >".$val->state_name."</option>";
			}
		}
		echo json_encode($state_select);
	}
	public function getcountry_edit(){
		$id_con=$_POST['id'];
		$edit=$this->model->getById("contacts",$id_con);
		$id=$edit->state_id;
		$state=$this->model->getByIdvcard("states",$id);
		$state_select='';
		if(!empty($state)){
			$state_select .="<option value=''>--Select state name--</option>";
			foreach($state as $val){
				$selected=isset($edit->state_id)&&$val->id==$edit->state_id?"selected":"";
				$state_select .="<option value='".$val->id."' ".$selected.">".$val->state_name."</option>";
			}
		}
		echo json_encode($state_select);
	}
	
	
	public function profile()
	{
		$data['title']="Profile Setting";
		$data['controller']="dashboard";
		$formData=escapeArray($this->input->post());
		if(isset($formData['submit']))
		{
			unset($formData['submit']);
			$upload_path="resources/admin";
			$res2=uploadFile($upload_path,"fileToUpload");
			if(isset($res2['file_name']))
			{
				$formData['image'] =  $res2['file_name'];
				$res['return']=true;
			}
			else
			{
				$res['fileError'] =  "<div class='alert alert-danger'>".$res2."</div>";
				$res['return']=false;
			}
			if($this->model->updateData("admin",$this->session->userdata('adminId'),$formData))
			{
				$this->model->updateData("vcard_information",1,array('address'=>$formData['address']));
				$res['msg']="Your Profile has been updated successfully.";
				$res['return']=true;
			}
			else
			{
				$res['msg']="Your Profile has not been updated successfully.";
				$res['return']=false;
			}
			echo json_encode($res);
			die;
		}
		$data['edit']=(array)$this->model->getById("admin",$this->session->userdata('adminId'));
		generatePageView("profile",$data);
	}
	public function changePassword(){
		$data['title']="Change Password";
		$data['controller']="dashboard";
		$formData=escapeArray($this->input->post());
		if(isset($formData['submit'])){
			unset($formData['submit']);
			$hash=$this->model->getById("admin",$this->session->userdata('adminId'));
			if(!empty($hash)){
				if(password_verify($formData['oldPassword'],$hash->password)){
					if($formData['password']==$formData['cpassword']){
						if($this->model->updateData("admin",$this->session->userdata('adminId'),array("password"=>password_hash($formData['password'],PASSWORD_DEFAULT)))){
							$data['msg']="Your Password is updated successfully.";
							$data['return']=true;
						}
					}
					else{
						$data['msg']="Your New password does not match.";
						$data['return']=false;
					}
				}
				else{
					$data['msg']="Your Old Password is wrong.";
					$data['return']=false;
					
				}
			}
			else{
				$data['msg']="<div class='alert alert-danger'>Wrong Username or Email.</div>";
				$data['return']=false;
					
			}
			echo json_encode($data);
			die;
		}
		generatePageView('changePassword',$data);
	}
	public function companies($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="companies";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Company Name",
					"Industry Name",
					"Contact person",
					"Phone",
					"Address",
					"Image",
					"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Companies";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "companies.id",
				"companies.company_name",
				"industries.industry_name as i_name",
				"companies.contact_person",
				"companies.phone",
				"companies.address",
				"companies.image",
				"companies.date"
				
				);
				$searchFields=array(
			    "companies.id",
				"companies.company_name",
				"companies.contact_person",
				"companies.phone",
				"companies.address"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from companies inner join industries on companies.industry_id=industries.id where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->date=cdate($key->date);
					if($key->image==""){
						$key->image="<img src='".res_url()."admin/default.jpg' width='100' height='80' class='img-responsive rounded-circle' >";
					}else{
						$key->image="<img src='".res_url()."admin/".$key->image."' width='100' height='80' class='img-responsive rounded-circle' >";
					}
					    
					$value=array_values((array)$key);
					// print_r($key);die;
					array_push($value,addActions("companies",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add company";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
					$upload_path="resources/admin";
			
			$admin = array(
			'upload_path' => $upload_path,
			'allowed_types' => "jpg|jpeg",
			'overwrite' => TRUE,
			'file_name' => time(),
			'max_size' => "2048000"
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);
			$this->load->library('upload', $admin);
			$config['image_library'] = 'gd2';//this loads the library for image resize where upload is successful
						
			if($_FILES['fileToUpload']['name']!==""){
				if(!$this->upload->do_upload('fileToUpload')){ 
					$data['imageError'] =  "<div class='alert alert-danger'>".$this->upload->display_errors()."</div>";
				
				}
				else{
					$imageDetailArray = $this->upload->data();
					$formData['image'] =  $imageDetailArray['file_name'];
				}
			}
				if(validateData("companies",$formData,$id)){
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;//path to the image we want to resize which is the image we just uploaded
						$config['create_thumb'] = TRUE;
						//$config['thumb_marker'] = false;
						$config['maintain_ratio'] = FALSE;
						$config['width'] = 235;//the width to resize to;
						$config['height'] = 125;//height to resize to;
						// echo "<pre>";
						// print_r ($config);
						// echo "</pre>";
						// die();
		                $this->load->library('image_lib', $config);//this loads the image resize library
		                $this->image_lib->resize();//the resize function
		               //check if the resize succeeds
		                $formData['image'] =   $this->upload->file_name;
		                $formData['image'] = str_ireplace('.', '_thumb.',$formData['image']);
		                // echo "<pre>";
		                // print_r ($formData);
		                // echo "</pre>";
		                // die();
						if($this->model->addData("companies",$formData)){
						$data['msg']="Company is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="Company is not added successfully.";
							$data['return']=false;
						}
					}
					else{
							//$data['msg']="User is already exist.";
							$data['edit']=$formData;
					}
					echo json_encode($data);
					die;
				}
				$data['industries']=($this->model->getData("industries"));
				generatePageView('addcompanies',$data);
				break;
			case "edit":
				$data['title']="Update company";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 $upload_path="resources/admin";
					
			$admin = array(
			'upload_path' => $upload_path,
			'allowed_types' => "jpg|jpeg",
			'overwrite' => TRUE,
			'file_name' => time(),
			'max_size' => "2048000"
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);
			$this->load->library('upload', $admin);
			if($_FILES['fileToUpload']['name']!==""){
				if(!$this->upload->do_upload('fileToUpload')){ 
					$data['imageError'] =  "<div class='alert alert-danger'>".$this->upload->display_errors()."</div>";
				
				}
				else{
					$imageDetailArray = $this->upload->data();
					$formData['image'] =  $imageDetailArray['file_name'];
				}
			}
			if(validateData("companies",$formData,$id)){
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;//path to the image we want to resize which is the image we just uploaded
						$config['create_thumb'] = TRUE;
						//$config['thumb_marker'] = false;
						$config['maintain_ratio'] = FALSE;
						$config['width'] = 235;//the width to resize to;
						$config['height'] = 125;//height to resize to;
						// echo "<pre>";
						// print_r ($config);
						// echo "</pre>";
						// die();
		                $this->load->library('image_lib', $config);//this loads the image resize library
		                $this->image_lib->resize();//the resize function
		               //check if the resize succeeds
		                $formData['image'] =   $this->upload->file_name;
		                $formData['image'] = str_ireplace('.', '_thumb.',$formData['image']);
			if($this->model->updateData("companies",$id,$formData))
				$data['msg']="company updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
				$data['industries']=($this->model->getData("industries"));		
				$data['edit']=(array)$this->model->getById("companies",$id);
				generatePageView('addcompanies',$data);
				break;
			    case "delete":
					if($this->model->deleteData("companies",$id))
					{
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="Company is deleted! successfully.</div>";
					}
					else
					{
						$msg['error']="Company is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function locations_old($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="locations";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Location Name",
					"company Name",
					"Contact person",
					"Address",
					"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Locations";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "locations.id",
				"locations.location_name",
				"companies.company_name as c_name",
				"locations.contact_person",
				"locations.address",
				"locations.date"
				
				);
				$searchFields=array(
			    "locations.id",
				"locations.location_name",
				"compaanies.company_name",
				"locations.contact_person",
				"locations.address"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from locations inner join companies on locations.company_id=companies.id where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->date=cdate($key->date);
					$value=array_values((array)$key);
					// print_r($key);die;
					array_push($value,addActions("locations",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add Location";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
				if(validateData("locations",$formData,$id)){
					if($this->model->addData("locations",$formData)){
						$data['msg']="Location is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="Location is not added successfully.";
							$data['return']=false;
						}
					}
					else{
							//$data['msg']="User is already exist.";
							$data['edit']=$formData;
					}
					echo json_encode($data);
					die;
				}
				$data['companies']=($this->model->getData("companies"));
				generatePageView('addlocation',$data);
				break;
			case "edit":
				$data['title']="Update Location";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
			if(validateData("locations",$formData,$id)){
				
			if($this->model->updateData("locations",$id,$formData))
				$data['msg']="Location updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
				$data['companies']=($this->model->getData("companies"));
		$data['edit']=(array)$this->model->getById("locations",$id);
		generatePageView('addlocation',$data);
				break;
			case "delete":
					if($this->model->deleteData("locations",$id)){
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="Location is deleted! successfully.</div>";
					}
					else{
						$msg['error']="Location is not deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function subscriptions($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="subscriptions";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"First Name",
					"Last Name", 
					"Email",  
					"Phone", 
					"DOB" 
				);
				$data['id']=$id;
				$data['title']="Subscriptions";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "subscriptions.id",
				"subscriptions.first_name",
				"subscriptions.last_name",
				"subscriptions.email",
				"subscriptions.phone",
				"subscriptions.dob" 
				
				);
				$searchFields=array(
			    "subscriptions.id",
				"subscriptions.first_name",
				"subscriptions.last_name",
				"subscriptions.phone",
				"subscriptions.email"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from subscriptions where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->dob=usadate($key->dob);
					 
					    
					$value=array_values((array)$key);
					// print_r($key);die;
					array_push($value,addActions("subscriptions",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				 
			case "edit":
				$data['title']="Update company";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 $upload_path="resources/admin";
					
			$admin = array(
			'upload_path' => $upload_path,
			'allowed_types' => "jpg|jpeg",
			'overwrite' => TRUE,
			'file_name' => time(),
			'max_size' => "2048000"
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);
			$this->load->library('upload', $admin);
			if($_FILES['fileToUpload']['name']!==""){
				if(!$this->upload->do_upload('fileToUpload')){ 
					$data['imageError'] =  "<div class='alert alert-danger'>".$this->upload->display_errors()."</div>";
				
				}
				else{
					$imageDetailArray = $this->upload->data();
					$formData['image'] =  $imageDetailArray['file_name'];
				}
			}
			if(validateData("companies",$formData,$id)){
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;//path to the image we want to resize which is the image we just uploaded
						$config['create_thumb'] = TRUE;
						//$config['thumb_marker'] = false;
						$config['maintain_ratio'] = FALSE;
						$config['width'] = 235;//the width to resize to;
						$config['height'] = 125;//height to resize to;
						// echo "<pre>";
						// print_r ($config);
						// echo "</pre>";
						// die();
		                $this->load->library('image_lib', $config);//this loads the image resize library
		                $this->image_lib->resize();//the resize function
		               //check if the resize succeeds
		                $formData['image'] =   $this->upload->file_name;
		                $formData['image'] = str_ireplace('.', '_thumb.',$formData['image']);
			if($this->model->updateData("companies",$id,$formData))
				$data['msg']="company updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
				$data['industries']=($this->model->getData("industries"));		
				$data['edit']=(array)$this->model->getById("companies",$id);
				generatePageView('addcompanies',$data);
				break;
			    case "delete":
					if($this->model->deleteData("companies",$id))
					{
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="Company is deleted! successfully.</div>";
					}
					else
					{
						$msg['error']="Company is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function locations($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="locations";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Location Name",
					"company Name",
					"Contact person",
					"Address",
					"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Locations";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "locations.id",
				"locations.location_name",
				"companies.company_name as c_name",
				"locations.contact_person",
				"locations.address",
				"locations.date"
				
				);
				$searchFields=array(
			    "locations.id",
				"locations.location_name",
				"compaanies.company_name",
				"locations.contact_person",
				"locations.address"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from locations inner join companies on locations.company_id=companies.id where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->date=cdate($key->date);
					$value=array_values((array)$key);
					// print_r($key);die;
					array_push($value,addActions("locations",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add Location";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
				if(validateData("locations",$formData,$id)){
					if($this->model->addData("locations",$formData)){
						$data['msg']="Location is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="Location is not added successfully.";
							$data['return']=false;
						}
					}
					else{
							//$data['msg']="User is already exist.";
							$data['edit']=$formData;
					}
					echo json_encode($data);
					die;
				}
				$data['companies']=($this->model->getData("companies"));
				generatePageView('addlocation',$data);
				break;
			case "edit":
				$data['title']="Update Location";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
			if(validateData("locations",$formData,$id)){
				
			if($this->model->updateData("locations",$id,$formData))
				$data['msg']="Location updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
				$data['companies']=($this->model->getData("companies"));
		$data['edit']=(array)$this->model->getById("locations",$id);
		generatePageView('addlocation',$data);
				break;
			case "delete":
					if($this->model->deleteData("locations",$id)){
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="Location is deleted! successfully.</div>";
					}
					else{
						$msg['error']="Location is not deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function salesgroups($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="salesgroups";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Group Name",
					"Contact Person",
					"Phone",
					"address",
					"Group Number",
					"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Sales groups";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "id",
				"group_name",
				"contact_person",
				"phone",
				"address",
				"group_number",
				"date"
				
				
				);
				$searchFields=array(
			    "id",
				"group_name",
				"contact_person",
				"phone"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from groups where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->date=cdate($key->date);
					$value=array_values((array)$key);
					
					array_push($value,addActions("salesgroups",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add group";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
				if(validateData("groups",$formData,$id)){
					
						if($this->model->addData("groups",$formData)){
						$data['msg']="Group is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="Group is not added successfully.";
							$data['return']=false;
						}
					}
					else{
							//$data['msg']="User is already exist.";
							$data['edit']=$formData;
					}
					echo json_encode($data);
					die;
				}
				
				generatePageView('add_sales_group',$data);
				break;
			case "edit":
				$data['title']="Update group";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 
			if(validateData("groups",$formData,$id)){
				
			if($this->model->updateData("groups",$id,$formData))
				$data['msg']="Group updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
		$data['edit']=(array)$this->model->getById("groups",$id);
		generatePageView('add_sales_group',$data);
				break;
			case "delete":
					if($this->model->deleteData("groups",$id)){
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="Group is deleted! successfully.</div>";
					}
					else{
						$msg['error']="Group is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function industries($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="industries";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Industry Name",
					"Contact Person",
					"Phone",
					"address",
					"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Industries";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "id",
				"industry_name",
				"contact_person",
				"phone",
				"address",
				"date"
				
				
				);
				$searchFields=array(
			    "id",
				"industry_name",
				"contact_person",
				"phone"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from industries where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->date=cdate($key->date);
					$value=array_values((array)$key);
					
					array_push($value,addActions("industries",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add industry";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
				if(validateData("industries",$formData,$id)){
					
						if($this->model->addData("industries",$formData)){
						$data['msg']="industry is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="industry is not added successfully.";
							$data['return']=false;
						}
					}
					else{
							//$data['msg']="User is already exist.";
							$data['edit']=$formData;
					}
					echo json_encode($data);
					die;
				}
				
				generatePageView('addindustries',$data);
				break;
			case "edit":
				$data['title']="Update industry";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 
			if(validateData("industries",$formData,$id)){
				
			if($this->model->updateData("industries",$id,$formData))
				$data['msg']="industry updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
		$data['edit']=(array)$this->model->getById("industries",$id);
		generatePageView('addindustries',$data);
				break;
			case "delete":
					if($this->model->deleteData("industries",$id)){
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="industry is deleted! successfully.</div>";
					}
					else{
						$msg['error']="industry is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function states($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="states";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Stat name",
					"country",
					"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="State";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			   "states.id",
				"states.state_name",
				"country.country_name as c_name",
				"states.date"
				
				
				
				);
				$searchFields=array(
			    "states.id",
				"states.state_name"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from states inner join country on states.country_id=country.id where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					//unset($key->id); //we cant get id in datatable cause its unset if u remove unset u can get id in datatable 
					$key->date=cdate($key->date);
					$value=array_values((array)$key);
					
					array_push($value,addActions("states",$id));
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add state";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					
				if(validateData("states",$formData,$id)){
					
						if($this->model->addData("states",$formData)){
						$data['msg']="state is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="state is not added successfully.";
							$data['return']=false;
						}
					}
					else{
							//$data['msg']="User is already exist.";
							$data['edit']=$formData;
					}
					echo json_encode($data);
					die;
				}
				$data['countries']=($this->model->getData("country"));
				generatePageView('addstate',$data);
				break;
			case "edit":
				$data['title']="Update state";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 
			if(validateData("states",$formData,$id)){
				
			if($this->model->updateData("states",$id,$formData))
				$data['msg']="state updated! successfully.";
							$data['return']=true;
						}
					echo json_encode($data);
					die;
		
				}
		$data['countries']=($this->model->getData("country"));		
		$data['edit']=(array)$this->model->getById("states",$id);
		generatePageView('addstate',$data);
				break;
			case "delete":
					if($this->model->deleteData("states",$id)){
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="state is deleted! successfully.</div>";
					}
					else{
						$msg['error']="state is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	
	public function contacts($action="view",$id=""){
		// if(is_developer()){
		// 	redirect(base_url());
		// }
		$formData=escapeArray($this->input->post());
		$data['active']="contacts";
		switch($action){
			case "view":
			$data['companies']=($this->model->getData("companies"));
			$data['groups']=($this->model->getData("groups"));
				$coloumns=array(
					"<label><input type='checkbox' class='form-control' name='showhide' id='select_all' onchange='selectall(this)'> Select All</label>",
					"ID",
					"First name",
					"Last name",
					"Email",
					"Phone",
					"company name",
					//"industry name",
					"Location",
					//"Group name",
					"state",
					//"country",
					"Dependent",
					"Account code",
					"image",
					//"Date",
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Contact";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "contacts.id",
				"contacts.first_name",
				"contacts.last_name",
				"contacts.email",
				"contacts.phone", 
				"companies.company_name as c_name",
				//"contacts.industry_id",
				"locations.location_name as l_name ",
				//"groups.group_name as g_name",
				"states.state_name as s_name",
				//"country.country_name as cun_name",
				"contacts.dependent",
				"contacts.contract_number",
				"contacts.account_code",
				"contacts.cardsend",
				"contacts.cardemail",
				"contacts.image"
				//"contacts.date"
				);
				$searchFields=array(
			    "contacts.id",
				"contacts.account_code",
				"contacts.contract_number",
				"contacts.first_name",
				"contacts.last_name",
				"contacts.email",
				"contacts.phone"
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from contacts left join companies on contacts.company_id=companies.id left join groups on contacts.group_id=groups.id left join locations on contacts.location_id=locations.id left join states on contacts.state_id=states.id left join country on contacts.country_id=country.id where 1=1 ";
			if($formData['company_id']!=="all"){
					$sql.= " and contacts.company_id='".$formData['company_id']."'";
				}
				if($formData['group_id']!=="all"){
					$sql.= " and contacts.group_id='".$formData['group_id']."'";
				}
			if($id!==""){
				$sql.=" and id=$id";	
			}
			  //die($sql);
				$fields=implode(",",$coloumns);
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					$dependent_data = '';
					if(isset($key->dependent))
					{
						$dependents = json_decode($key->dependent);
						if(!empty($dependents))
						{
							foreach($dependents as $key1 => $value1) 
							{
								if(!empty($value->dependent) || !empty($value->dependant_name) || !empty($value->dep_f_name)){
									$dependent_data.=(isset($value1->dependent) && !empty($value1->dependent)) ? $value1->dependent.': ':'';
									$dependent_data.=(isset($value1->dependant_name) && !empty($value->dependant_name)) ? $value1->dependant_name:'';
									$dependent_data.=(isset($value1->dep_f_name) && !empty($value->dep_f_name)) ? ' '.$value1->dep_f_name:'';
									
									$dependent_data.='<br>';
								}
							}
						}
					}
					$key->dependent = $dependent_data;
					
					$contract_number = $key->contract_number;
					 unset($key->contract_number);  
					$filename=$key->image;
					$vcard_name=getvcardname($id);
					$key->image="<img src='".res_url()."cards/".$key->image."?v=".time()."' width='80' height='100' class='imgSmall img-responsive rounded-circle' >";
					if($key->cardsend==1){
						$key->image ='<i class="fa fa-check" aria-hidden="true" style="    color: green;position: absolute;"></i>'.$key->image;
					}
					if($key->cardemail==1){
						$key->email ='<i class="fa fa-check" aria-hidden="true" style="    color: green;"></i>'.$key->email;
					}
					unset($key->cardsend);
					unset($key->cardemail);  
					$value=array_values((array)$key);
					// print_r($key);die;
					$down="<a data-toggle='Download Image' class='download' style='color:#6bad1f;' title='Download Image' href='".base_url().'admin/dashboard/download/'.$filename."' class='' target='_blank'><i class='fa fa-download'></i></a> <a data-toggle='Download vCard'class='download-card' title='Download vCard' href='".base_url().'admin/dashboard/download2/'.$vcard_name."' class='' target='_blank'><i class='fa fa-id-card'></i> </a>
					<a data-toggle='Send vCard' class='send send_contacts_email_vcard' title='Send vCard' href='".base_url()."admin/dashboard/send_contacts_email_vcard/".$id."'><i class='fa fa-paper-plane'></i> </a>
					<a data-toggle='View Dependent' class='loadview modalview edite dependant_edit_page' data-title='View Dependent' data-company='".$contract_number."' title='View Dependent' href='#contacts/dependents/".$contract_number."'><i class='fa fa-users'></i></a> <a data-toggle='Add Dependent' title='Add Dependent' href='#contacts/adddependent/".$contract_number."' data-company='".$contract_number."' data-title='Add Dependent' class='loadview modalview edite contact_edit_page'><i class='fa fa-plus-square'></i></a>";
					
					
					$up="<input type='checkbox' value='".$id."' class='checkbox form-control'>";
					array_unshift($value,$up);
					array_push($value,$down.addActions_contact("contacts",$id));
					
					$values[]=$value;
				}
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $this->db->query("$sql")->num_rows(),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($values)?$values:array(),
				);
				echo json_encode($output);
				break;
				case "add":
				$data['title']="Add Contact";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 	$formData['dependent'] = isset($formData['dependent']) ? json_encode($formData['dependent']):'';
						if($this->model->addData("contacts",$formData)){
							$last_id = $this->db->insert_id();							
							$account_id = generateID($last_id);
							$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id=".$last_id."");
							
							$qrimage_new_name = genrate_qrcode($account_id,$last_id);
							$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id=".$last_id."");
							$image_new_name = genrate_image($last_id);
							$query=$this->db->query("update `contacts` set image= '".$image_new_name."' where id='".$last_id."'"); 
							
							
							$qrimage_new = genrate_qrcode(base_url()."vcards/".$down,$last_id);
							$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new."' where id=".$last_id."");
								
							
							$image_new = genrate_image($last_id);
							$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$last_id."'");
							
							$down = get_contacts_vcard($last_id);
							$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id=".$last_id."");
							
							$this->db->query("update `contacts` set contract_number= '".$last_id."' where id='".$last_id."'");
							
							
							//header("Location: ".$_SERVER['PHP_SELF']);
        					$data['msg']="contact is added! successfully.";
							$data['return']=true;
      					}
      					else{
							$data['msg']="contact is not added successfully.";
							$data['return']=false;
						}
					
					echo json_encode($data);
					die;
				}
				$data['groups']=($this->model->getData("groups"));
				$data['companies']=($this->model->getData("companies"));
				$data['locations']=($this->model->getData("locations"));
				$data['states']=($this->model->getData("states"));
				$data['countries']=($this->model->getData("country"));
				$data['industries']=($this->model->getData("industries"));
				$data['dependent']=($this->model->getData("dependent"));
				generatePageView('addcontact',$data);
				break;
			case "dependents":
				$contract_number=$id;  
				$data['contactdependent']=$this->model->getdependents("contact_dependant",$contract_number);
				generatePageView('contactdependant',$data);
			
				break;
			case "adddependent":  
				$contract_number=$id;
				if(isset($formData['submit'])){
					$dependent = isset($formData['dependent']) ? $formData['dependent']:'';
					$added = false;
					if(!empty($dependent)){
						foreach($dependent as $row){
							if(!empty($row['dependent']) || !empty($row['dependant_name']) || !empty($row['dep_f_name'])){
								$recdata=array();
								$recdata['relationship']=$row['dependent'];
								$recdata['first_name']=$row['dependant_name'];
								$recdata['last_name']=$row['dep_f_name'];
								$recdata['contract_number']=$contract_number;
								$this->model->addData("contact_dependant",$recdata); 
								$added = true;
							}
						}
						$last_id=0;
						if($added){
							$result = $this->model->getLastData4($contract_number);
							if(!empty($result)){
								$last_id = $result->id;
							}
						}
						if($last_id > 0){
							$last_data=$this->model->getLastData2("contacts",$last_id);
							$this->load->library('phpqrcode/qrlib');
							$qrtext = isset($last_data->ssn) ? $last_data->ssn:'';
							if(isset($qrtext)){
								$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/resources/qrimage/';
								$text = $qrtext;
								$text1= substr($text, 0,2);
								$folder = $SERVERFILEPATH;
								$file_name1 = $text1."-Qrcode" . $last_id . ".png";
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
							if (file_exists($_SERVER['DOCUMENT_ROOT']."/resources/cards/itv_".$last_id.'_'.$last_id.".jpg")) {
								 unlink($_SERVER['DOCUMENT_ROOT']."/resources/cards/itv_".$last_id.'_'.$last_id.".jpg");
							}
							imagejpeg($image,"resources/cards/itv_".$last_id.'_'.$last_id.".jpg");
							imagedestroy($image);
							$image_new_name = 'itv_'.$last_id.''.$last_id.'.jpg';
							
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
				$data['dependent']=($this->model->getData("dependent"));
				$data['contactdependent']=$this->model->getdependents("contact_dependant",$contract_number);
				generatePageView('addcontactdependant',$data);
			
				break;
			case "edit":
				$data['title']="Update Contact";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					 // print_r($formData);die;
				$formData['dependent'] = isset($formData['dependent']) ? json_encode($formData['dependent']):'';
			//if(validateData("contacts",$formData,$id)){
			if($this->model->updateData("contacts",$id,$formData)){
				$account_id = generateID($id);
				$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id='".$id."'");
				$last_data=$this->model->getLastData2("contacts",$id);
				$qrimage_new_name = genrate_qrcode($account_id,$last_id);
				$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id='".$id."'");
				 
				$image_new_name = genrate_image($id);
				$query=$this->db->query("update `contacts` set image= '".$image_new_name."' where id='".$id."'");
				$down = get_contacts_vcard($id);
				$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id=".$id."");
				$qrimage_new = genrate_qrcode(base_url()."vcards/".$down,$last_id);
				$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new."' where id=".$id."");
					
				
				$image_new = genrate_image($id);
				$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$id."'");
				
				if(empty($last_data->contract_number)){
					$this->db->query("update `contacts` set contract_number= '".$id."' where id='".$id."'");
				}
				
				$data['msg']="contact updated! successfully.";
				$data['dependent']='Child';
				$data['return']=true;
			}else{
				$data['msg']="contact is not updated successfully.";
				$data['return']=false;
			}
		// }else{
		// 					$data['msg']="contact is not updated successfully.";
		// 					$data['return']=false;
						
		// 					$data['edit']=$formData;
		// 			}
					echo json_encode($data);
					die;
		
				}
		$data['edit']=(array)$this->model->getById("contacts",$id);
		$data['groups']=($this->model->getData("groups"));
		$data['companies']=($this->model->getData("companies"));
		$data['locations']=($this->model->getLocation_byid("locations",$data['edit']['company_id']));
		$data['states']=($this->model->getState_byid("states",$data['edit']['country_id']));
		
		$data['countries']=($this->model->getData("country"));
		$data['industries']=($this->model->getData("industries"));
		$data['dependent']=($this->model->getData("dependent"));
		generatePageView('addcontact',$data);
				break;
			case "delete":
					if($this->model->deleteData("contacts",$id)){
						$msg['success']="contact is deleted! successfully.</div>";
					}
					else{
						$msg['error']="contact is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	function download($filename = NULL) {
    // load download helder
    $this->load->helper('download');
    // read file contents
    $data = file_get_contents(base_url('resources/cards/'.$filename));
    force_download($filename, $data);
}
function download2($filename = NULL) {
    // load download helder
    $this->load->helper('download');
    // read file contents
    $data = file_get_contents(base_url('vcards/'.$filename));
    force_download($filename, $data);
}
	public function settings($action="update",$id=null){
		$formData=escapeArray($this->input->post());
		$data['active']="settings";
		$data['controller']="dashboard";
		switch($action){
			case "update":
				$data['title']="Setting";
				if(isset($formData['submit'])){
					$i=0;
					foreach($formData as $name=>$value){
						$i++;
						$this->db->where('name',$name)->update('config', array("value"=>$value));
					}
					if($i>0){
						$data['msg']="Setting has been updated successfully</div>";
						$data['return']=true;
					}
					echo json_encode($data);
					die;
				}
				$data['config']=$this->model->getData("config","where isVisible=1 order by id asc");
				generatePageView('settings',$data);
				break;
		}
	}
	
    
    
    public function upload_excel_ajax() {
        generatePageView('upload_excel_ajax');
    }
	public function upload_file_ajax(){
      if ($this->input->post('validation')) {
                $path = 'resources/uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);       
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                   		$import_xls_file = $data['upload_data']['file_name'];
	                } else {
	                    $import_xls_file = 10;
	                }
				}
				echo $import_xls_file;
			}
		}
		public function delete_excel_file(){
			if(isset($_POST['delete'])){
				$path = 'resources/uploads/';
			  	$file=$_POST['change_file_name'];
			  	if (file_exists($path.$file)) {
			        unlink($path.$file);
			        echo 'Successfully';
			    } else {
			       echo 'UnSuccessfully'; 
			    }
		    }
		}
	public function upload_validation(){
  
      if ($this->input->post('bulk_booking')) {
                  $path = 'resources/uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php"; 
                $import_xls_file =$_POST['change_file_name'];     
                $inputFileName = $path . $import_xls_file;
                 
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    unset($allDataInSheet[1]);
                    
                    foreach ($allDataInSheet as $value) {
                     
                     $inserdata[$i]['group_number'] = $value['A'];
                          $inserdata[$i]['account_code'] = $value['B'];
                           $inserdata[$i]['company_name'] = $value['C'];
                           $inserdata[$i]['relationship'] = $value['D'];
                           $inserdata[$i]['patient_id'] = $value['B'];
                          $inserdata[$i]['birth_date'] = $value['E'];
                          $inserdata[$i]['gender'] = $value['F'];
                          $inserdata[$i]['first_name'] = $value['G'];
                      $inserdata[$i]['last_name'] = $value['H'];
                          $inserdata[$i]['dependant_name'] = $value['I'];
                          $inserdata[$i]['dep_f_name'] = $value['J'];
                          $inserdata[$i]['email'] = $value['K'];
                           $inserdata[$i]['phone'] = $value['L'];
                           $inserdata[$i]['city'] = $value['M'];
                           $inserdata[$i]['state_name'] = $value['N'];
                            $inserdata[$i]['group_name'] = $value['O'];
                          $inserdata[$i]['active_member'] = $value['P'];
                       $query="Select * from `contacts` WHERE patient_id='".$value['B']."'";
                       $getIdRows = $this->db->query($query);
      
                       $validation=10;
                      $i++;
                    }      
                   echo $validation;  
        }
       
    }
	public function upload_file_excel(){ 
		error_reporting(1);
		if ($this->input->post('save_booking')){
			$path = 'resources/uploads/';
			 
			$import_xls_file =$_POST['change_file_name'];
			$inputFileName = $path . $import_xls_file;
			
			$this->load->library('excel');
		 
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection(); 
			foreach ($cell_collection as $cell) {
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				 
				if ($objPHPExcel->getActiveSheet()->getCell($cell)->getValue() instanceof PHPExcel_RichText){
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue()->getPlainText();
				}else{
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
				} 
				if ($row == 1) {
					$header[$row][$column] = $data_value;
				} else {
					$arr_data[$row][$column] = $data_value;
				}
			}
			
			$data=array(); 
			$data['header'] = $header;
			$data['values'] = $arr_data;
			 
			date_default_timezone_set('Australia/Canberra');  
			define('MIN_DATES_DIFF', 25569);
			define('SEC_IN_DAY', 86400);
			$userids= array();
			if(is_array($data['values']) && !empty($data['values'])){ 
				foreach($data['values'] as $value){
					$datas=array();
					$phonenumber1='';
					$phonenumber2='';
					foreach ($value as $key => $values){
						if($values==null){$newvalues='';}else{$newvalues=$values;}
						
						if(strtolower($data['header'][1][$key]) == 'group number/division' ){
							$getIdQuery = "SELECT * from groups where group_name = '".$newvalues."'";
							$getIdRows = $this->db->query($getIdQuery);
							if ($getIdRows->num_rows() > 0){
								$getgroupId = $getIdRows->row()->id;
							}else{
								$addArray = array(
									'group_number'=>$newvalues,
									'group_name'=>$newvalues
								);
								$getgroupId = $this->model->add('groups',$addArray);
							}
							
							$datas['group_number']=$newvalues;
							$datas['group_id']=$getgroupId;
						}
						if(strtolower($data['header'][1][$key]) == 'company' ){
							$getIdQuery = $this->db->query("SELECT * from companies where company_name = '".$newvalues."'")->row(); 
							if (!empty($getIdQuery)) {
								$getId = $getIdQuery->id;
							}else{
								$addArray = array(
									'company_name'=>$newvalues,
									'image'=>'1618835016_thumb.jpg',
								);
								$getId = $this->model->add('companies',$addArray);
							}
							
							$datas['company_id']=$getId;
							
							$getindustryid=0;
							$getIdQuery = "SELECT * from companies where company_name = '".$newvalues."'";
							$getIdRows = $this->db->query($getIdQuery);
							if ($getIdRows->num_rows() > 0){
								$getindustryid = $getIdRows->row()->industry_id;
							}
							$datas['industry_id']=$getindustryid;
						  
						}
						
						if(strtolower($data['header'][1][$key]) == 'contract number' || strtolower($data['header'][1][$key]) == 'contract number 1' ){
							if(!empty($newvalues)){$datas['contract_number']=$newvalues;}
						}
						if(strtolower($data['header'][1][$key]) == 'first name'){
							$datas['first_name']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'last name'){
							$datas['last_name']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'mi'){
							$datas['miname']=$newvalues;
						}
						 
						if(strtolower($data['header'][1][$key]) == 'ssn'){
							$datas['ssn']=$newvalues; 
						}
						if(strtolower($data['header'][1][$key]) == 'relation'){
							$datas['relationship']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'dob'){
							$datas['dob']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'address'){
							$datas['address']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'city'){
							$datas['city']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'state'){
							$datas['state_name']=$newvalues;
							/*
							states
							*/
							$getindustryid=0;
							$getIdQuery = "SELECT * from states where iso2 = '".$newvalues."'";
							$getIdRows = $this->db->query($getIdQuery);
							if ($getIdRows->num_rows() > 0){
								$getindustryid = $getIdRows->row();
								$state_id = $getindustryid->id;
								$datas['state_id']=$state_id;
								$country_id = $getindustryid->country_id;
								$datas['country_id']=$country_id;
							}
						}
						if(strtolower($data['header'][1][$key]) == 'zip code'){
							$datas['zipcode']=$newvalues;
						}
						if(strtolower($data['header'][1][$key]) == 'phone' || strtolower($data['header'][1][$key]) == 'mobile (cell) number' || strtolower($data['header'][1][$key]) == 'phone number' || strtolower($data['header'][1][$key]) == 'Phone - CELL'){
							/* $newvalues = preg_replace("/[^0-9+]/", "", $newvalues);
							$mystring = $newvalues; 
							$findme   = '+1';
							$pos = strpos($mystring, $findme);
							
							if ($pos === false) {
								$newvalues = '+1'.$newvalues;
							}
							$datas['phone']=$newvalues; */
							if($newvalues!='DUPLICATE' || $newvalues!='duplicate'){
								$phonenumber2=$newvalues;
							}
							
						}
						if(strtolower($data['header'][1][$key]) == 'area code'){
							/* $newvalues = preg_replace("/[^0-9+]/", "", $newvalues);
							$mystring = $newvalues; 
							$findme   = '+1';
							$pos = strpos($mystring, $findme);
							
							if ($pos === false) {
								$newvalues = '+1'.$newvalues;
							}
							$datas['phone']=$newvalues; */
							$phonenumber1=$newvalues;
						}
						
						if(strtolower($data['header'][1][$key]) == 'email address' || strtolower($data['header'][1][$key]) == 'email'){
							$datas['email']=$newvalues;
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
						$datas['phone']=$newvalues;
					}
					if( $datas['dob'] <= MIN_DATES_DIFF) { 
						$datas['dob']='';	
					}else{
						$datetime= ( $datas['dob'] - MIN_DATES_DIFF) * SEC_IN_DAY;
						$datas['dob']=date('Y-m-d',$datetime);
					} 
					$newvalues = $datas['relationship'];
					$mystring = $newvalues; 
					$findme   = 'SUBSCRIBER';
					$pos = strpos($mystring, $findme);
					
					if ($pos === false) { 
						unset($datas['company_id']); 
						unset($datas['industry_id']);
						unset($datas['country_id']);
						unset($datas['state_id']);
						unset($datas['group_id']);
                      	$last_id = $this->model->add('contact_dependant',$datas); 
					}else{
						 
						$datas['location_id'] = 22;
						$datas['qrimage'] = '';
						$datas['patient_id'] = $datas['contract_number'];
						$datas['active_member'] = date('Y-m-d');
						$query="Select * from `contacts` WHERE patient_id='".$datas['contract_number']."'";
						$getIdRows = $this->db->query($query)->row();
						if($this->db->affected_rows()>0){
							if ($this->model->updateDataContact('contacts',$datas['contract_number'],$datas)){
								$last_id=$getIdRows->id;
							}
						}else{
							$last_id = $this->model->add('contacts',$datas);
						}
						$account_id = generateID($last_id);
						$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id=".$last_id.""); 
						array_push($userids,$last_id);
						 
					}  
				}
			}
			
			/* if(!empty($userids)){ 
				foreach($userids as $last_id){
					if($last_id > 0){
						$last_data=$this->model->getLastData2("contacts",$last_id);
						$this->load->library('phpqrcode/qrlib');
						$qrtext = isset($last_data->ssn) ? $last_data->ssn:'';
						if(isset($qrtext)){
							$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/resources/qrimage/';
							$text = $qrtext;
							$text1= substr($text, 0,2);
							$folder = $SERVERFILEPATH;
							$file_name1 = $text1."-Qrcode" . $last_id . ".png";
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
						if (file_exists($_SERVER['DOCUMENT_ROOT']."/resources/cards/itv_".$last_id.$last_id.".jpg")) {
							unlink($_SERVER['DOCUMENT_ROOT']."/resources/cards/itv_".$last_id.$last_id.".jpg");
						}						
						imagejpeg($image,"resources/cards/itv_".$last_id.$last_id.".jpg");
						imagedestroy($image);
						$image_new_name = 'itv_'.$last_id.''.$last_id.'.jpg';
						
						$query=$this->db->query("update `contacts` set image= '".$image_new_name."' where id=".$last_id."");
						if ($this->db->affected_rows() > 0) {
							
							$down = get_contacts_vcard($last_id);
							$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id=".$last_id."");
							
							$qrimage_new = genrate_qrcode(base_url()."vcards/".$down,$last_id);
							$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new."' where id=".$last_id."");
								
							
							$image_new = genrate_image($last_id);
							$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$last_id."'");
							
							
							
						}
					}
					
				}
				
			} */ 
			 
			 
			 
			 
				$result = true;
				if($result){
					$array = array(
						'successVal' => 'uploaded sussessfluy'
					);
				}
				$this->session->set_userdata( $array );
				echo json_encode($array);
			}
	}
	public function upload_excel(){
  
      if ($this->input->post('submit')) {
                 
                $path = 'resources/uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                       $getId = 0;
                      $companyName = trim($value['E']);
                      $getIdQuery = "SELECT * from companies where company_name = '$companyName'";
                      $getIdRows = $this->db->query($getIdQuery);
                      if ($getIdRows->num_rows() > 0) {
                      	$getId = $getIdRows->row()->id;
                      }else{
                      	// add the name into the group table with common add function
                      	$addArray = array(
                      		'company_name'=>$companyName,
                      		'image'=>'1618835016_thumb.jpg',
                      		'industry_id'=>$value['L']
                      	);
                      	$getId = $this->model->add('companies',$addArray);
                      }
                      $getlocationId = 0;
                      $locationName = trim($value['F']);
                      $getIdQuery = "SELECT * from locations where location_name = '$locationName'";
                      $getIdRows = $this->db->query($getIdQuery);
                      if ($getIdRows->num_rows() > 0) {
                      	$getlocationId = $getIdRows->row()->id;
                      }else{
                      	// add the name into the group table with common add function
                      	$addArray = array(
                      		'location_name'=>$locationName,
                      		'company'=>$value['E']
                      	);
                      	$getlocationId = $this->model->add('locations',$addArray);
                      }
                     $getgroupId = 0;
                      $groupName = trim($value['G']);
                      $getIdQuery = "SELECT * from groups where group_name = '$groupName'";
                      $getIdRows = $this->db->query($getIdQuery);
                      if ($getIdRows->num_rows() > 0) {
                      	$getgroupId = $getIdRows->row()->id;
                      }else{
                      	// add the name into the group table with common add function
                      	$addArray = array(
                      		'group_name'=>$groupName,
                      		
                      	);
                      	$getgroupId = $this->model->add('groups',$addArray);
                      }
                      $getstateid = 0;
                      $stateName = trim($value['I']);
                      $getIdQuery = "SELECT * from states where state_name = '$stateName'";
                      $getIdRows = $this->db->query($getIdQuery);
                      if ($getIdRows->num_rows() > 0) {
                      	$getstateid = $getIdRows->row()->id;
                      }else{
                      	// add the name into the group table with common add function
                      	$addArray = array(
                      		'state_name'=>$stateName,
                      		'country'=>$value['J']
                      	);
                      	$getstateid = $this->model->add('states',$addArray);
                      }
                      $getcountryid = 0;
                      $countryName = trim($value['J']);
                      $getIdQuery = "SELECT * from country where country_name = '$countryName'";
                      $getIdRows = $this->db->query($getIdQuery);
                      if ($getIdRows->num_rows() > 0) {
                      	$getcountryid = $getIdRows->row()->id;
                      }else{
                      	// add the name into the group table with common add function
                      	$addArray = array(
                      		'country_name'=>$countryName,
                      		
                      	);
                      	$getcountryid = $this->model->add('country',$addArray);
                      }
                      $getindustryid = 0;
                      $industryName = trim($value['L']);
                      $getIdQuery = "SELECT * from industries where industry_name = '$industryName'";
                      $getIdRows = $this->db->query($getIdQuery);
                      if ($getIdRows->num_rows() > 0) {
                      	$getindustryid = $getIdRows->row()->id;
                      }else{
                      	// add the name into the group table with common add function
                      	$addArray = array(
                      		'industry_name'=>$industryName,
                      		
                      	);
                      	$getindustryid = $this->model->add('industries',$addArray);
                      }
                      
                      $inserdata[$i]['first_name'] = $value['A'];
                      $inserdata[$i]['last_name'] = $value['B'];
                      $inserdata[$i]['email'] = $value['C'];
                      $inserdata[$i]['phone'] = $value['D'];
                       $inserdata[$i]['company_id'] = $getId;
                       $inserdata[$i]['location_id'] =$getlocationId; //$get_location_Id;
                       $inserdata[$i]['group_id'] = $value['G'];
                        $inserdata[$i]['address'] = $value['H'];
                         $inserdata[$i]['state_id'] = $getstateid;
                          $inserdata[$i]['country_id'] = $getcountryid;
                          $inserdata[$i]['dependent'] = $value['K'];
                          $inserdata[$i]['industry_id'] = $getindustryid;
                       //$inserdata[$i]['group_name_id'] = $getId;
                      $i++;
                      
                     
                    }               
                    // $result = $this->model->insert($inserdata);
                      
						$result=$this->model->insert($inserdata); 
                    if($result){
                      echo "Imported successfully";
                    }else{
                      echo "ERROR !";
                    }             
      
              } catch (Exception $e) {
                   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }else{
                  echo $error['error'];
                }
                 
                 
        }
        $array = array(
        	'successVal' => 'uploaded sussessfluy'
        );
        
        $this->session->set_userdata( $array );
        // generatePageView('import');
        redirect(base_url().'dashboard#upload_excel_ajax');
    }
   
    function send_contacts_email_vcard($id= "")
    {
        $this->load->library('vcard');                
        $datavcard = $this->sendVcard($this->model->getByIdvcard("contacts",$id),$id);
        if(isset($datavcard->sid))
        {
			
			$query=$this->db->query("update `contacts` set cardsend= '1' where id=".$id."");
	        $response['status']=1;
	        $response['message']='Sent successfully';
        }
        else
        {
        	$response['status']=0;
        	$response['message']=$datavcard;
        }
        echo json_encode($response);exit();
    } 
    function sendVcard($dat,$id=null)
    {
        $response = '';
        foreach($dat as $data)
        {
	        if(!empty($data->phone)){
				$this->load->library('twilio');
				$filename = isset($data->vcard_name) ? $data->vcard_name:'';
				$response = $this->twilio->sendSMS($data->phone,$filename);
			}
        }
        return $response;
    }
     function get_contacts_email_vcard($id= "")
    {
    	
    	//echo $id;die;
        $this->load->library('vcard');                
        $datavcard = $this->getvcard($this->model->getByIdvcard("contacts",$id));
    } 
    function getvcard($dat)
    {
        $datavcarddata = array();
        foreach($dat as $data)
        {
	        $datavcarddata['display_name'] = $data->first_name." ".$data->last_name; 
	        $datavcarddata['first_name'] = $data->first_name; 
	        $datavcarddata['last_name'] = $data->last_name;                                                 
	        $datavcarddata['cell_tel'] = $data->phone;                
	        $datavcarddata['email1'] = $data->email; 
	        //$datavcarddata['work_address'] = $data->address;
	        $datavcarddata['company'] = getcompanyById($data->company_id);
	       	if($data->image!="")
	       	{
			    $getPhoto = file_get_contents(base_url('resources/cards/'.$data->image));
			    $b64vcard  = base64_encode($getPhoto);
			    $b64mline   = chunk_split($b64vcard,74,"\n");
			    $b64final   = preg_replace('/(.+)/', ' $1', $b64mline);
			    $photo       = $b64final;
			}
	        $datavcarddata['photo'] =$photo;
	        if (is_array($datavcarddata))
	        {    
	            $this->vcard->vcard($datavcarddata);
	        }
	        else
	        {
	            $this->vcard->vcard();
	        }
        	$this->vcard->downloadfile(); 
        }
        return $datavcarddata;
    }
	function getdependants(){
		if($this->input->post('id')){
			$contract_number=$this->input->post('id');
		
			$data['groups']=($this->model->getData("groups"));
			$data['companies']=($this->model->getData("companies"));
			$data['locations']=($this->model->getData("locations"));
			$data['states']=($this->model->getData("states"));
			$data['countries']=($this->model->getData("country"));
			$data['industries']=($this->model->getData("industries"));
			$data['dependent']=($this->model->getData("dependent"));
			$data['contactdependent']=$this->model->getdependents("contact_dependant",$contract_number);
			generatePageView('contactdependant',$data);
		
		}
	}
	function deletedependent($id){
		if($this->model->deleteData("contact_dependant",$id)){
			$msg['success']="dependent is deleted! successfully.</div>";
		}
		else{
			$msg['error']="dependent is deleted! successfully";
		} 
		echo json_encode($msg); 
	}
	function sendvcards(){
		/*
		/send_contacts_email_vcard/92208
		*/
		if($this->input->post('id')){
			$response['status']=1;
			$response['message']='Sent successfully';
			$ids=$this->input->post('id');
			foreach($ids as $id){
				$datavcard = $this->sendVcard($this->model->getByIdvcard("contacts",$id),$id);
				if(isset($datavcard->sid))  {
					$query=$this->db->query("update `contacts` set cardsend= '1' where id=".$id."");
				}
			} 
			echo json_encode($response);exit(); 
			
		}else{ 
			$response['status']=0;
			$response['message']='Please select some contact to send card';
			echo json_encode($response);exit(); 
		} 
		
	}
	function sendemails(){
		 
		if($this->input->post('id')){
			$response['status']=1;
			$response['message']='Sent successfully';
			$ids=$this->input->post('id');
			foreach($ids as $id){
				$detail = $this->model->getByIdvcard("contacts",$id);
				$vcard_name=$detail[0]->vcard_name;
				$vcard_image=$detail[0]->image;
				$email=$detail[0]->email;
				$fullname=$detail[0]->first_name.' '.$detail[0]->last_name;
				if(!empty($email)){
					$returned = $this->sendmail($email,$fullname,$vcard_name,$vcard_image);
					if($returned['status']==true){
						$query=$this->db->query("update `contacts` set cardemail= '1' where id=".$id."");
					}
				} 
			} 
			echo json_encode($response);exit(); 
			
		}else{ 
			$response['status']=0;
			$response['message']='Please select some contact to send card';
			echo json_encode($response);exit(); 
		}  
	}
	function testmail(){
		$detail = $this->model->getByIdvcard("contacts",16);
		$vcard_name=$detail[0]->vcard_name;
		$vcard_image=$detail[0]->image;
		 /* Muhammad Sufian <sufian@ex3gen.com> */
		 /* Harsha Hatti <Harsha.Hatti@corelinq.com> */
		/* $returned = $this->sendmail('phyllisosby@gmail.com','phyllis osby',$vcard_name,$vcard_image);  */  
		 $returned = $this->sendmail('haroon@ex3gen.com','Harsha Hatti',$vcard_name,$vcard_image); 
		if($returned['status']==true){
			
		}
		print_r($returned);
	}
	function sendmail($tomail='',$toname='',$url='',$cardimage=''){
        $body = '<table width="100%" align="center" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="center" valign="top" style="margin: 0; padding: 0;">
							<table width="600" align="center" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0"
								   style="font-family:Arial, Helvetica, sans-serif;">
								

								<tr>
									<td style="text-align: left;">

										<h1 style="font-weight: bold; font-size: 1.375em; color: #D1AC50; line-height: 38px;">To Our Valued Curaechoice Members,</h1>

										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">Welcome to the Curaechoice program!  As most of you now know, the new Curaechoice benefits program is actively being rolled out to all team members.  As a part of this rollout, digital Curaechoice vCards are being sent to every team member that has an up to date cell number on file.</p>
										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">If you are receiving this email, it appears your cell number is not current.  To ensure that you receive your digital vCard, we have enclosed your Curaechoice vCard as an attachment within this email.  Please open up your attached vCard and save this vCard onto your phone.  Having your vCard on your phone will provide you with immediate access to your vCard when utilizing the Curaechoice program.   If you encounter an issue in accessing your vCard, please email us at support@curaechoice.com.  <br></p>
										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">We are excited to have you as a part of the Curaechoice member family.  We hope that you will find your participation in the Curaechoice program to be an incredibly positive and impactful experience for you and your loved ones. <br><br></p>
										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">We thank you for the opportunity to serve you as your ally in care coordination.<br><br> </p>
									</td>
								</tr>
								 
								<tr>
									<td align="left" valign="top" style="margin: 0; padding: 0;">
										 <p style="font-size: 1.375em; color: #162C53; line-height: 28px;">Sincerely, <br>
										Your Curaechoice Support Team </p>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top" style="margin: 0; padding: 0;">
										<img style="display: block;max-width:100%" src="'.base_url().'resources/img/image_logo.png" alt="" width="370" height="140">
									</td>
								</tr>
								 
								<tr>
									<td align="center" valign="top" style="margin: 0; padding: 0;">
										 <p style="font-size:10px;line-height:13px;letter-spacing:-0.01em;margin:0px;padding:0;color: #727272;">You are subscribed as '.$tomail.'. To ensure delivery of Curaehchoice vCard to your inbox, please add support@curaechoice.com to your address book.</p>
									</td>
								</tr>								
							</table>
						</td>
					</tr>
				</table>';
		$mainsubject="CuraeChoice vcard.";
        $message = 'This is test email.\nThis is test email.\nThis is test email.\n';
		$this->load->library('My_PHPMailer');
		 $mail = new PHPMailer(); 
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.elasticemail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
		$mail->SMTPDebug = 0;
        $mail->Username   = "support@curaechoice.com";  // user email address
        $mail->Password   = "AFE78A029B1CC384813FCA963E1296099635";            // password in GMail
        $mail->SetFrom('support@curaechoice.com', 'Curaechoice');  //Who is sending the email
        $mail->AddReplyTo("support@curaechoice.com","Curaechoice");  //email address that receives the response
        $mail->Subject    = $mainsubject;
        $mail->Body      = $body;
        $mail->AltBody    = strip_tags($body); 
        $mail->AddAddress($tomail, $toname);
        $mail->AddReplyTo('support@curaechoice.com', 'Curaechoice');
		$mail->AddAttachment('vcards/'.$url,basename($url)); 
		/* $mail->AddAttachment('resources/cards/'.$cardimage,basename($cardimage)); */
		
		
		/* $mail->AddAttachment('resources/cards/'.$cardimage); 
		$mail->AddAttachment =$_SERVER['DOCUMENT_ROOT'].'/vcards/'.$url;   
		 $mail->AddAttachment = $_SERVER['DOCUMENT_ROOT'].'/resources/cards/'.$cardimage; */
		
		
        if(!$mail->Send()) {
             $data["message"] = "Error: " . $mail->ErrorInfo;
             $data["status"] = false;
        } else {
             $data["message"] = "Message sent correctly!";
			 $data["status"] = true;
        }  
		return $data;
    }
}
