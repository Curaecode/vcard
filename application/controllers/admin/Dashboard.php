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
	    if($this->session->userdata('adminType') > 0){
			redirect(base_url().'admin/dashboard#contacts/');
		}
		// genrate_image(67);die();
		$data['title']="Dashboard";
		$data['active']="dashboard";
		//$data['controller']="dashboard";
		generateView('index',$data);
	}
	public function hospitals($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="hospitals";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Title", 
					"Slug",
					"URL",
					"Embeded URL",
					"Image", 
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Hospitals";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "id",
				"linkname", 
				"slug",
				"url",
				"embed", 
				"image" 
				
				);
				$searchFields=array(
			    "id",
				"linkname",
				"slug" 
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from care_coordination where 1=1";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id; 
					if($key->image==""){
						$key->image="<img src='".res_url()."admin/default.jpg' width='100' height='80' class='img-responsive rounded-circle' >";
					}else{
						$key->image="<img src='".res_url()."admin/".$key->image."' width='100' height='80' class='img-responsive rounded-circle' >";
					}
					    
					$value=array_values((array)$key);
					// print_r($key);die;
					array_push($value,addActions("hospitals",$id));
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
				$data['title']="Add Hosptal";
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
				if(validateData("care_coordination",$formData,$id)){
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
						if($this->model->addData("care_coordination",$formData)){
						$data['msg']="Hospital is added! successfully.";
							$data['return']=true;
						}
						else{
							$data['msg']="Hospital is not added successfully.";
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
				$data['industries']=array();
				generatePageView('addhospital',$data);
				break;
			case "edit":
				$data['title']="Update Hospital";
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
			if(validateData("care_coordination",$formData,$id)){
				if($_FILES['fileToUpload']['name']!==""){
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name; 
					$config['create_thumb'] = TRUE;
					//$config['thumb_marker'] = false;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 235;//the width to resize to;
					$config['height'] = 125;//height to resize to; 
					$this->load->library('image_lib', $config);//this loads the image resize library
					$this->image_lib->resize();//the resize function
				   //check if the resize succeeds
					$formData['image'] =   $this->upload->file_name;
					$formData['image'] = str_ireplace('.', '_thumb.',$formData['image']);
					if($this->model->updateData("care_coordination",$id,$formData)){
						$data['msg']="hospital updated! successfully."; 
						
					}
				}else{
					if($this->model->updateData("care_coordination",$id,$formData)){
						$data['msg']="Hospital updated! successfully."; 
						
					}
				}
							$data['return']=true;
							$data['formData']=$formData;
			}
					echo json_encode($data);
					die;
		
				}
				$data['industries']=array();		
				$data['edit']=(array)$this->model->getById("care_coordination",$id);
				generatePageView('addhospital',$data);
				break;
			    case "delete":
					if($this->model->deleteData("care_coordination",$id))
					{
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="hospital is deleted! successfully.</div>";
					}
					else
					{
						$msg['error']="hospital is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
	}
	public function users($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="users";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",
					"Name", 
					"User Name",
					"Email",
					"Address",
					"Image", 
					"Actions",
				);
				$data['id']=$id;
				$data['title']="Users";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "id",
				"Name", 
				"user_name",
				"email",
				"address", 
				"image" 
				
				);
				$searchFields=array(
			    "id",
				"Name",
				"user_name",
				"email"  
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from admin where type > 0";
			
			if($id!==""){
			$sql.=" and id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id; 
					if($key->image==""){
						$key->image="<img src='".res_url()."admin/default.jpg' width='100' height='80' class='img-responsive rounded-circle' >";
					}else{
						$key->image="<img src='".res_url()."admin/".$key->image."' width='100' height='80' class='img-responsive rounded-circle' >";
					}
					    
					$value=array_values((array)$key);
					// print_r($key);die;
					array_push($value,addActions("users",$id));
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
				$data['title']="Add User";
				if(isset($formData['submit'])){
					unset($formData['submit']); 
					$email=$formData['email'];
					$username=$formData['user_name'];
					$rec = $this->model->checkuser($email,$username);
					if(!empty($rec)){
						$data['msg']="User Name or Email already Exist. Please use another";
						$data['return']=false;
						echo json_encode($data);
						die;
						exit;
					}
					if(isset($formData['password'])){
						$formData['password'] = password_hash($formData['password'],PASSWORD_DEFAULT);
					}
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
						if(validateData("admin",$formData,$id)){
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
								if($this->model->addData("admin",$formData)){
									$data['msg']="User is added! successfully.";
									$data['return']=true;
								}
								else{
									$data['msg']="User is not added successfully.";
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
				$data['industries']=array();
				generatePageView('adduser',$data);
				break;
			case "edit":
				$data['title']="Update User";
				$data['form']="edit";
				if(isset($formData['submit'])){
					unset($formData['submit']);
					$email=$formData['email'];
					$username=$formData['user_name'];
					$rec = $this->model->checkuser($email,$username,$id);
					if(!empty($rec)){
						$data['msg']="User Name or Email already Exist. Please use another";
						$data['return']=false;
						echo json_encode($data);
						die;
						exit;
					}
					if(isset($formData['password']) && !empty($formData['password'])){
						$formData['password'] = password_hash($formData['password'],PASSWORD_DEFAULT);
					}else{
						unset($formData['password']);
					}
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
					if(validateData("admin",$formData,$id)){
						if($_FILES['fileToUpload']['name']!==""){
							$config['source_image'] = $this->upload->upload_path.$this->upload->file_name; 
							$config['create_thumb'] = TRUE;
							//$config['thumb_marker'] = false;
							$config['maintain_ratio'] = FALSE;
							$config['width'] = 235;//the width to resize to;
							$config['height'] = 125;//height to resize to; 
							$this->load->library('image_lib', $config);//this loads the image resize library
							$this->image_lib->resize();//the resize function
						   //check if the resize succeeds
							$formData['image'] =   $this->upload->file_name;
							$formData['image'] = str_ireplace('.', '_thumb.',$formData['image']);
							if($this->model->updateData("admin",$id,$formData)){
								$data['msg']="User updated! successfully."; 
								
							}
						}else{
							if($this->model->updateData("admin",$id,$formData)){
								$data['msg']="User updated! successfully."; 
								
							}
						}
								$data['return']=true;
								$data['formData']=$formData;
					}
					echo json_encode($data);
					die;
		
				}
				$data['industries']=array();		
				$data['edit']=(array)$this->model->getById("admin",$id);
				generatePageView('adduser',$data);
				break;
			    case "delete":
					if($this->model->deleteData("admin",$id))
					{
						//$this->model->deleteDatauser("user",$id);
						$msg['success']="hospital is deleted! successfully.</div>";
					}
					else
					{
						$msg['error']="hospital is deleted! successfully";
					}
					
				echo json_encode($msg);
				break;
		}
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
			
			$url = 'https://api.elasticemail.com/v4/statistics?from=2001-01-01T01:01:01&apikey=00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125'; 
			/* Init cURL resource */
			$ch = curl_init($url);
			 /* Array Parameter Data */
			$datakey = ['apikey'=>'00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125', 'from'=>'2001-01-01T01:01:01'];
			 /* pass encoded JSON string to the POST fields */
			/* curl_setopt($ch, CURLOPT_POSTFIELDS, $datakey); */ 	
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			/* set return type json */
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			/* execute request */
			$result = curl_exec($ch); 
			curl_close($ch);
			$jsonresult=json_decode($result);
			$data['emails']=$jsonresult;
			 
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
			$sql="select $fields from companies where 1=1";
			
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
					
					if(!isset($formData['showname'])){
						$formData['showname']=0;
					}
					if(!isset($formData['showdependent'])){
						$formData['showdependent']=0;
					}
					
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
					
					if(isset($formData['showname'])){
						$formData['showname']=1;
					}else{
						$formData['showname']=0;
					}
					if(isset($formData['showdependent'])){
						$formData['showdependent']=1;
					}else{
						$formData['showdependent']=0;
					}
					
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
				if($_FILES['fileToUpload']['name']!==""){
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name; 
					$config['create_thumb'] = TRUE;
					//$config['thumb_marker'] = false;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 235;//the width to resize to;
					$config['height'] = 125;//height to resize to; 
					$this->load->library('image_lib', $config);//this loads the image resize library
					$this->image_lib->resize();//the resize function
				   //check if the resize succeeds
					$formData['image'] =   $this->upload->file_name;
					$formData['image'] = str_ireplace('.', '_thumb.',$formData['image']);
					if($this->model->updateData("companies",$id,$formData)){
						$data['msg']="company updated! successfully.";
						$this->db->query("update `contacts` set qrimage='' where company_id='".$id."'");
						
					}
				}else{
					if($this->model->updateData("companies",$id,$formData)){
						$data['msg']="company updated! successfully.";
						$this->db->query("update `contacts` set qrimage='' where company_id='".$id."'");
						
					}
				}
							$data['return']=true;
							$data['formData']=$formData;
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
	
	public function qrcodelogs($action="view",$id=""){
		
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
					"DOB", 
					"IP",   
					"Access Date Time",
					"Address"	
				);
				$data['id']=$id;
				$data['title']="Subscriptions";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "id",
				"first_name",
				"last_name",
				"email",
				"phone",
				"dob",
				"ipaddress",
				"latitude",
				"longitude",
				"addeddate" 
				
				);
				$searchFields=array(
			    "id",
				"ipaddress",
				"first_name",
				"last_name",
				"phone",
				"email"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from subscription_access where 1=1";
			
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
					
					$key->address='<a href="https://www.google.com/maps/@'.$key->latitude.','.$key->longitude.',19z" target="_blank"> Latitude:'.$key->latitude.'  Longitude:'.$key->longitude.'</a>';
					if($key->addeddate=='0000-00-00 00:00:00'){
						$key->addeddate='';
					}else{
						$key->addeddate=cdate($key->addeddate);
					}
					
					
					unset($key->latitude);
					unset($key->longitude);
					 
					    
					$value=array_values((array)$key);
					 
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
	
	
	public function detaillogs($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="subscriptions";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",  
					"Phone", 
					"URL Title",  
					"IP",   
					"Access Date Time",
					"Address"	
				);
				$data['id']=$id;
				$data['title']="Providers Access Log";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "cc.id", 
				"cc.phone", 
				"cd.linkname",
				"cd.url", 
				"cc.ipaddress",
				"cc.latitude",
				"cc.longitude",
				"cc.access_date"  
				);
				$searchFields=array(
			    "cc.id", 
				"cc.ipaddress",
				"cc.phone",
				"cd.linkname"
				
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from care_coordination_access cc INNER JOIN care_coordination cd ON cc.linktype = cd.id where 1=1";
			 
			if($id!==""){
			$sql.=" and cc.id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id; 
					
					$key->linkname='<a href="'.$key->url.'" target="_blank">'.$key->linkname.'</a>';
					$key->address='<a href="https://www.google.com/maps/@'.$key->latitude.','.$key->longitude.',19z" target="_blank"> Latitude:'.$key->latitude.'  Longitude:'.$key->longitude.'</a>';
					if($key->access_date=='0000-00-00 00:00:00'){
						$key->access_date='';
					}else{
						$key->access_date=cdate($key->access_date);
					}
					
					
					unset($key->latitude);
					unset($key->longitude);
					unset($key->url);
					 
					    
					$value=array_values((array)$key);
					 
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
	public function twillio($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="subscriptions";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",  
					"Phone", 
					"Exist in Contact",   
					"IP",   
					"Access Date Time" 
				);
				$data['id']=$id;
				$data['title']="Twillio Access Log";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "cc.id", 
				"cc.phone",  
				"cd.id as exisitng",   
				"cc.ipaddress", 
				"cc.addeddate as access_date"  
				);
				$searchFields=array(
			    "cc.id", 
				"cc.ipaddress",
				"cc.phone"  
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from twillio_logs cc LEFT JOIN contacts cd ON cc.phone = cd.phone where 1=1";
			 
			if($id!==""){
			$sql.=" and cc.id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id; 
					if($key->access_date=='0000-00-00 00:00:00'){
						$key->access_date='';
					}else{
						$key->access_date=cdate($key->access_date);
					}
					 
					if(!is_null($key->exisitng)){
						$key->exisitng = 'Yes';
					}else{
						$key->exisitng = 'No';
					} 
					    
					$value=array_values((array)$key);
					 
					array_push($value);
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
		}
	}
	public function twilliologs($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="subscriptions";
		switch($action){
			case "view":
				$coloumns=array( 
					"Phone",     
					"Access Date Time" 
				);
				$data['id']=$id;
				$data['title']="Twillio Access Log";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
				$email = $formData['search']['value'];
				$limit=$formData['length'];
				$offset=$formData['start'];
				$this->load->library('twilio');
				$response = $this->twilio->readlog($offset,$limit);  
				$total = $this->twilio->readlog(0,0); 
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" =>count($total),
					"recordsFiltered" => $sql2['countFiltered'],
					"data" => isset($response)?$response:array(),
				);
				echo json_encode($output);
				break; 
		}
	}
	
	public function cardlogs($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="subscriptions";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",  
					"First Name", 
					"Last Name", 
					"Card",  
					"IP",   
					"Access Date Time",
					"Address"	
				);
				$data['id']=$id;
				$data['title']="Card Access Log";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "cc.id", 
				"cd.first_name", 
				"cd.last_name",
				"cd.image", 
				"cc.ipaddress",
				"cc.latitude",
				"cc.longitude",
				"cc.access_date"  
				);
				$searchFields=array(
			    "cc.id", 
				"cc.ipaddress",
				"cd.first_name", 
				"cd.last_name",
				"cc.ipaddress"
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from card_access_log cc INNER JOIN contacts cd ON cc.user_id = cd.id where 1=1";
	 
			if($id!==""){
			$sql.=" and cc.id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id; 
					
					$key->image="<img src='".base_url()."curaechoice/views/".$key->image."' width='80' height='100' class='imgSmall img-responsive rounded-circle' >";
					 
					$key->address='<a href="https://www.google.com/maps/@'.$key->latitude.','.$key->longitude.',19z" target="_blank"> Latitude:'.$key->latitude.'  Longitude:'.$key->longitude.'</a>';
					if($key->access_date=='0000-00-00 00:00:00'){
						$key->access_date='';
					}else{
						$key->access_date=cdate($key->access_date);
					}
					
					
					unset($key->latitude);
					unset($key->longitude);
					unset($key->url);
					 
					    
					$value=array_values((array)$key);
					 
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
	public function urllogs($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="subscriptions";
		switch($action){
			case "view":
				$coloumns=array(
					"ID",     
					"IP",    
					"Address",
					"Access Date Time"	
				);
				$data['id']=$id;
				$data['title']="URL Access Log";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			$coloumns=array(
			    "cc.id",  
				"cc.ip_address", 	
				"cc.actual_link",
				"cc.date_time" 
				);
				$searchFields=array(
			    "cc.id", 
				"cc.ip_address",
				"cc.actual_link" 
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from rat_log_tbl cc  where 1=1";
	 
			if($id!==""){
			$sql.=" and cc.id=$id";	
			}
			// die($sql);
			
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields);
				$results=$this->db->query($sql2['sql'])->result();
				$values=array();
				foreach($results as &$key){
					$id=$key->id; 
					 
					if($key->date_time=='0000-00-00 00:00:00'){
						$key->date_time='';
					}else{
						$key->date_time=cdate($key->date_time);
					}
					 
					 
					    
					$value=array_values((array)$key);
					 
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
	
	public function maillogs($action="view",$id=""){
		
		$formData=escapeArray($this->input->post());
		$data['active']="Email Logs";
		switch($action){
			case "view":
				$coloumns=array(
					"Email",
					"Subject",
					"Status", 
					"Date Sent",  
					"Date Opened" 
				);
				$data['id']=$id;
				$data['title']="Email Logs";
				$data['coloumns']=$coloumns;
				generatePageView('listview',$data);
				break;
			case "ajax":
			 /*
			 00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125
			 */
				$email = $formData['search']['value'];
				$url = 'https://api.elasticemail.com/v2/log/load'; 
				/* Init cURL resource */
				$ch = curl_init($url);
				 /* Array Parameter Data */
				$datakey = ['apikey'=>'00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125', 'statuses'=>0, 'from'=>'2001-01-01T01:01:01','includeEmail'=>'true', 'email'=>$email];
				 /* pass encoded JSON string to the POST fields */
				curl_setopt($ch, CURLOPT_POSTFIELDS, $datakey); 	
				/* set return type json */
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				/* execute request */
				$result = curl_exec($ch); 
				curl_close($ch);
				$jsonresult=json_decode($result);
				$totalrecord=count($jsonresult->data->recipients);
				/* print_r($jsonresult->data->recipients); */
				/*
				$limit=$formData['length']!=-1?" limit ".$formData['start'].",".$formData['length']:"";
				*/
				$limit=$formData['length'];
				$offset=$formData['start'];
				
				$url = 'https://api.elasticemail.com/v2/log/load'; 
				/* Init cURL resource */
				$ch = curl_init($url);
				 /* Array Parameter Data */
				if($formData['length']!=-1){
					$datakey = ['apikey'=>'00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125', 'statuses'=>0, 'limit'=>$limit, 'offset'=>$offset,'from'=>'2001-01-01T01:01:01','includeEmail'=>'true', 'email'=>$email];
				}else{
					$datakey = ['apikey'=>'00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125', 'statuses'=>0,'from'=>'2001-01-01T01:01:01','includeEmail'=>'true', 'email'=>$email]; 
				}
				
				 /* pass encoded JSON string to the POST fields */
				curl_setopt($ch, CURLOPT_POSTFIELDS, $datakey); 	
				/* set return type json */
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				/* execute request */
				$result = curl_exec($ch); 
				curl_close($ch);
				$jsonresult=json_decode($result);
			   
				 
				$maillogs=array();
			    $results=$jsonresult->data->recipients; 
				foreach($results as $key){
					 $maillogs=array(); 
					$maillogs['mail']=$key->to; 
					$maillogs['subject']=$key->subject;
					$maillogs['status']=$key->status;
					if($key->status == 'Bounced'){
						$maillogs['datesent']=cdate(str_replace('T',' ',$key->date)); 
					}else{
						$maillogs['datesent']=cdate(str_replace('T',' ',$key->datesent)); 
					}
					
					if($key->status == 'Opened'){
						$maillogs['dateopened']=cdate(str_replace('T',' ',$key->dateopened)); 
					}else{
						$maillogs['dateopened']=''; 
					}
					$value=array_values($maillogs);
					 
					$values[]=$value;
				} 
				$output = array(
					"draw" => $formData['draw'],
					"recordsTotal" => $totalrecord,
					"recordsFiltered" => $totalrecord,
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
				"cd.first_name",
				"cd.last_name",
				"contacts.first_name",
				"contacts.last_name",
				"contacts.email",
				"contacts.phone"
				);
			$fields=implode(",",$coloumns);
			$sql="select $fields from contacts left join companies on contacts.company_id=companies.id left join states on contacts.state_id=states.id left join country on contacts.country_id=country.id LEFT JOIN contact_dependant cd ON contacts.contract_number = cd.contract_number where 1=1 ";
			if($formData['company_id']!=="all"){
					$sql.= " and contacts.company_id='".$formData['company_id']."'";
			}
				 
			if($id!==""){
				$sql.=" and id=$id";	
			}
			  //die($sql);
				$fields=implode(",",$coloumns);
				$sql2=getRecords($sql,$formData,$coloumns,$searchFields,array(),'group by contacts.id');
				$results=$this->db->query($sql2['sql'])->result();
			 
				$values=array();
				foreach($results as &$key){
					$id=$key->id;
					$dependent_data = array();
					
					/* if(isset($key->dependent))
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
					} */
					$contract_number= $key->contract_number;
					$dependant_data=$this->model->getdependents("contact_dependant",$contract_number);
					if(!empty($dependant_data)){
						foreach($dependant_data as $value){
							$dependent_data2=''; 
							$dependent_data2.=(isset($value->first_name) && !empty($value->first_name)) ? ucwords($value->first_name):'';
							$dependent_data2.=(isset($value->last_name)  && !empty($value->last_name)) ? ' '.ucwords($value->last_name):'';
							
							$dependentdata =(isset($value->relationship) && !empty($value->relationship)) ? $value->relationship.'':'';
							$datadependent = explode(' ',$dependentdata); 
							if(count($datadependent) > 1){ 
								$dependent_datas=$datadependent[1];
							}else{
								$dependent_datas = $datadependent[0];
							}
							$mystring = strtolower($dependent_datas);  
							$findme   = 'spouse';
							$pos = strpos($mystring, $findme);
							
							if ($pos === false){
								$dependent_datas = 'D';
							}else{
								$dependent_datas = 'S';
							}
							$string = $dependent_datas.': '.$dependent_data2.' - '.count($datadependent);
							array_push($dependent_data,$string);
							/* $dependent_data .= $dependent_datas.': '.$dependent_data2.' <br />'; */
						}
					}
					$key->dependent = implode(' <br />',$dependent_data);
					
					$contract_number = $key->contract_number;
					 unset($key->contract_number);  
					$filename=$key->image;
					$vcard_name=getvcardname($id);
					$key->image="<img src='".base_url()."curaechoice/views/".$key->image."' width='80' height='100' class='imgSmall img-responsive rounded-circle' >";
					if($key->cardsend>=1){
						$key->image ='<i class="fa fa-check" aria-hidden="true" style="    color: green;position: absolute;"></i>'.$key->image;
					}
					if($key->cardemail>=1){
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
							
							$last_data=$this->model->getLastData2("contacts",$last_id);
							
							/* $down= (md5($last_data->first_name."_".$last_data->last_name.'_'.$last_id).'_'.$last_id.'.vcf');
							$qrimage_new_name = genrate_qrcode(base_url()."vcards/".$down,$last_id);  */
							$qrimage_new_name = genrate_qrcode(base_url()."qrcode_".md5($last_id),$last_id); 
							$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id=".$last_id."");
							  
							  
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
								$recdata['phone']=$row['phone']; 
								/* if(isset($row['dob']) && !empty($row['dob'])){ 
									$dateofbirth = $row['dob'];
									$dob= explode('/',$dateofbirth);
									$recdata['dob']=$dob[2].'-'.$dob[0].'-'.$dob[1];
								} */
								$recdata['contract_number']=$contract_number;
								$this->model->addData("contact_dependant",$recdata); 
								
								$lastrecord = $this->model->getLastData4('contacts',$contract_number);
								$last_id = $lastrecord->id; 
								
								
								 

								$added = true;
							}
						}
						$last_id=0;
						if($added){
							$result = $this->model->getLastData4("contacts",$contract_number);
							if(!empty($result)){
								$last_id = $result->id;
							}
						}
						if($last_id > 0){
							$last_data=$this->model->getLastData2("contacts",$last_id);
							$this->load->library('phpqrcode/qrlib');
							
							$account_id = generateID($last_id);
							$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id=".$last_id."");
								
								
							$last_data=$this->model->getLastData2("contacts",$last_id);
							  
							$qrimage_new_name = genrate_qrcode(base_url()."qrcode_".md5($last_id),$last_id); 
							$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id=".$last_id."");
							  
							  
							$image_new = genrate_image($last_id);
							$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$last_id."'");
							
							$down = get_contacts_vcard($last_id);
							$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id=".$last_id."");  
						}
					}
					
					$data['msg']="Dependent Add successfully.";
					$data['dependent']='Child';
					$data['return']=true; 
					echo json_encode($data);
					die;
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
					/* if(isset($formData['dob']) && !empty($formData['dob'])){ 
						$dateofbirth = $formData['dob'];
						$dob= explode('/',$dateofbirth);
						$formData['dob']=$dob[2].'-'.$dob[0].'-'.$dob[1];
					} */
					
					 // print_r($formData);die;
				$formData['dependent'] = isset($formData['dependent']) ? json_encode($formData['dependent']):'';
			//if(validateData("contacts",$formData,$id)){
				$formData['update_date'] = date('Y-m-d H:i:s');
			if($this->model->updateData("contacts",$id,$formData)){
				$last_id=$id;
				
				$account_id = generateID($id);
				$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id='".$id."'");
				$last_data=$this->model->getLastData2("contacts",$id);
				
				
				$last_data=$this->model->getLastData2("contacts",$id);
					
					
				/* $down= (md5($last_data->first_name."_".$last_data->last_name.'_'.$id).'_'.$id.'.vcf');
				$qrimage_new_name = genrate_qrcode(base_url()."vcards/".$down,$id);  */ 
				$qrimage_new_name = genrate_qrcode(base_url()."qrcode_".md5($id),$id); 
				$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id=".$id."");
				 
				
				
				$image_new_name = genrate_image($id);
				$query=$this->db->query("update `contacts` set image= '".$image_new_name."' where id='".$id."'");
				
				$down = get_contacts_vcard($id);
				$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id=".$id."");
				
				  
				
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
    $data = file_get_contents('vcards/'.$filename);
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
						 
						/* if(strtolower($data['header'][1][$key]) == 'ssn'){
							$datas['ssn']=$newvalues; 
						} */
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
			    $getPhoto = file_get_contents('resources/cards/'.$data->image);
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
		$dependent = $this->model->getimageData("contact_dependant",$id);
		if($this->model->deleteData("contact_dependant",$id)){ 
			$msg['success']="dependent is deleted! successfully.</div>";
		}
		else{
			$msg['error']="dependent is deleted! successfully";
		} 
		
		$result = $this->model->getLastData4("contacts",$dependent->contract_number);
		if(!empty($result)){
			$last_id = $result->id; 
			$account_id = generateID($last_id);
			$query=$this->db->query("update `contacts` set account_code= '".$account_id."' where id=".$last_id."");
			$qrimage_new_name = genrate_qrcode(base_url()."qrcode_".md5($last_id),$last_id); 
			$query=$this->db->query("update `contacts` set qrimage= '".$qrimage_new_name."' where id=".$last_id."");
			$image_new = genrate_image($last_id);
			$query=$this->db->query("update `contacts` set image= '".$image_new."' where id='".$last_id."'");

			$down = get_contacts_vcard($last_id);
			$query=$this->db->query("update `contacts` set vcard_name= '".$down."' where id=".$last_id."");
		}
		
		echo json_encode($msg); 
	}
	function sendtestcards(){
		$response['status']=1;
		$response['message']='Sent successfully';
		$id=15; 
		$datavcard = $this->sendtestVcard($this->model->getByIdvcard("contacts",$id),$id);
		if(isset($datavcard->sid))  {
			$query=$this->db->query("update `contacts` set cardsend= cardsend+1 where id=".$id."");
		}
		 
		echo json_encode($response);exit();
	}
	
	
    function sendtestVcard($dat,$id=null)
    {
        $response = '';
        foreach($dat as $data)
        {
	        if(!empty($data->phone)){
				$this->load->library('twilio');
				$filename = isset($data->vcard_name) ? $data->vcard_name:'';
				$response = $this->twilio->sendSMS('+923235696050',$filename); 
			}
        }
        return $response;
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
					$query=$this->db->query("update `contacts` set cardsend= cardsend+1 where id=".$id."");
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
						$query=$this->db->query("update `contacts` set cardemail= cardemail+1 where id=".$id."");
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
		$detail = $this->model->getByIdvcard("contacts",1);
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
		
		
		 $res = "";

		 $data = "username=".urlencode("support@curaechoice.com");
		 $data .= "&api_key=".urlencode("00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125");
		 

		$weburl = 'https://api.elasticemail.com/v2/email/send';
		
		$filename = basename($url);
		$file_name_with_full_path = /* base_url(). */'vcards/'.$url;
		$filetype = "application/vcard"; // Change correspondingly to the file type

		try{
			$post = array('from' => 'support@curaechoice.com',
			'fromName' => 'Curaechoice',
			'apikey' => '00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125',
			'subject' => $mainsubject,
			'to' => $tomail,
			'bodyHtml' => $body,
			'bodyText' => strip_tags($body),
			'file_1' => new CurlFile($file_name_with_full_path, $filetype, $filename),
			'isTransactional' => false);
			
			$ch = curl_init();
			curl_setopt_array($ch, array(
				CURLOPT_URL => $weburl,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $post,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
				CURLOPT_SSL_VERIFYPEER => false
			));
			
			$result=curl_exec ($ch);
			curl_close ($ch); 

			 $data["message"] = "Message sent correctly!";
			 $data["status"] = true;	
		} catch(Exception $ex){
			/* echo $ex->getMessage(); */
			 $data["message"] = "Error: " . $ex->getMessage(); ;
             $data["status"] = false;
		}
	

		 /* print_r( $errno);
		 print_r($errstr); */
		/* $this->load->library('My_PHPMailer');
		 
		$mail = new PHPMailer(); 
		$mail->IsSMTP(true); 
		$mail->SMTPAuth = true;  
		$mail->SMTPSecure = "ssl";  
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
		$mail->AddAttachment('vcards/'.$url,basename($url)); */   
		
		 
		
		 
		
		/* $mail->AddAttachment('resources/cards/'.$cardimage); 
		$mail->AddAttachment =$_SERVER['DOCUMENT_ROOT'].'/vcards/'.$url;   
		 $mail->AddAttachment = $_SERVER['DOCUMENT_ROOT'].'/resources/cards/'.$cardimage; */
		
		  
        /* if(!$mail->Send()) {
             $data["message"] = "Error: " . $mail->ErrorInfo;
             $data["status"] = false;
        } else {
             $data["message"] = "Message sent correctly!";
			 $data["status"] = true;
        } */ 	
		return $data;
    }
}
