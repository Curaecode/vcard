<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress; 
}
function generateIDOLD($id = null)
{
    $generated_id = '';
    if($id!=null)
    {
    	$CI =& get_instance();
    	$data = $CI->db->query("SELECT * FROM contacts WHERE id=$id")->row();
    	$company_name = isset($data->company_id) ? getCompanyName($data->company_id):'';
    	$location_id = isset($data->location_id) ? getLocationsPlace($data->location_id,$data->company_id) :'';
    	$industry_name = isset($data->industry_id) ? getIndustryName($data->industry_id):'';
    	$parts = isset($company_name) ? explode(' ',$company_name):'';
    	$first_part = isset($parts[0]) ? $parts[0]:'';
    	$second_part = isset($parts[1]) ? $parts[1]:'';

    	$dependent = isset($data->dependent) ? $data->dependent:'';
    	$state_id = isset($data->state_id) ? sprintf("%02d",$data->state_id):'';
    	$group_id = isset($data->group_id) ? sprintf("%03d",$data->group_id):'';
    	if($first_part)
    	{
    		$generated_id.= strtoupper(substr($first_part,0,1));
    	}
    	if($second_part)
    	{
    		$generated_id.= strtoupper(substr($second_part,0,1));
    	}
    	if($location_id)
    	{
    		$generated_id.=$location_id;
    	}
    	 
    	if($state_id)
    	{
    		$generated_id.='-'.$state_id;
    	}
    	if($group_id)
    	{
    		$generated_id.='-'.$group_id;
    	}
    	if($industry_name)
    	{
    		$generated_id.='-'.strtoupper(substr($industry_name,0,1));
    	}
    	$generated_id.='-'.$id;
    }
	return $generated_id;
}

function generateID($id = null)
{
    $generated_id = '';
    if($id!=null)
    {
    	$CI =& get_instance();
    	$data = $CI->db->query("SELECT * FROM contacts WHERE id=$id")->row();
    	$company_name = isset($data->company_id) ? getCompanyName($data->company_id):'';
		$imageconfig=$CI->model->getDatarow("config","where isVisible=1 AND name='siteName'");
		$company_name = $imageconfig->value;
    	$location_id = isset($data->location_id) ? getLocationsPlace($data->location_id,$data->company_id) :'';
    	$industry_name = isset($data->industry_id) ? getIndustryName($data->industry_id):'';
    	$parts = isset($company_name) ? explode(' ',$company_name):'';
    	$first_part = isset($parts[0]) ? $parts[0]:'';
    	$second_part = isset($parts[1]) ? $parts[1]:'';

    	 
    	if($first_part)
    	{
    		$generated_id.= strtoupper(substr($first_part,0,1));
    	}
    	if($second_part)
    	{
    		$generated_id.= strtoupper(substr($second_part,0,1));
    	}
    	if(isset($data->first_name) && isset($data->last_name)){
			$full_name = $data->first_name.' '.$data->last_name;
			
			$parts = isset($full_name) ? explode(' ',$full_name):'';
			$first_part = isset($parts[0]) ? $parts[0]:'';
			$second_part = isset($parts[1]) ? $parts[1]:'';
			
			if($first_part){
				if(!empty($generated_id)){
					$generated_id.= '-'.strtoupper(substr($first_part,0,1));
				}else{
					$generated_id.= strtoupper(substr($first_part,0,1));
				} 
			}
			if($second_part){
				if(!empty($generated_id)){
					if($first_part){
						$generated_id.= strtoupper(substr($second_part,0,1));
					}else{
						$generated_id.= '-'.strtoupper(substr($second_part,0,1));
					}
				}else{
					$generated_id.= strtoupper(substr($second_part,0,1));
				} 
			} 
		}  
		
		$unique = uniquestring($data->phone);
		
		
		if(empty($generated_id)){
			$generated_id.= $unique;
		}else{
			$generated_id.= '-'.$unique;
		}
    	$contract_number= $data->contract_number;
		$dependant_data=$CI->model->getdependents("contact_dependant",$contract_number);
		
		$spouse=0;
		$dependent=0;
		if(isset($dependant_data))
		{
			 
			if(!empty($dependant_data))
			{
				$i = 0; 
				 
				foreach($dependant_data as $key => $value) 
				{
					$dependent_data = '';
					$dependent_data2 = '';
					if(!empty($value->relationship) || !empty($value->first_name) || !empty($value->last_name)){
						$dependent_data =(isset($value->relationship) && !empty($value->relationship)) ? $value->relationship.':':'';
						$datadependent = explode(' ',trim($dependent_data)); 
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
						
						if(strtolower($dependent_datas)=='s'){
							$spouse=$spouse+1;
						}else{
							$dependent +=1;
						}	
					} 
				} 
			}
		}
		if(!empty($generated_id)){
			$generated_id.= '-'.$spouse.''.$dependent;
		}else{
			$generated_id.= $spouse.''.$dependent;
		}
		
    }
	return $generated_id;
}


function getCompanyName($id=null)
{
	$CI =& get_instance();
	$imageconfig=$CI->model->getDatarow("config","where isVisible=1 AND name='siteName'");
	$company_name = $imageconfig->value;
	/* $company_name = '';
	if($id!=null)
	{
		$data = $CI->db->query("SELECT * FROM companies WHERE id=$id")->row();
		$company_name = isset($data->company_name) ? $data->company_name:'';
	} */
	return $company_name;
}
function getIndustryName($id=null)
{
	$CI =& get_instance();
	$industry_name = '';
	if($id!=null)
	{
		$data = $CI->db->query("SELECT * FROM industries WHERE id=$id")->row();
		$industry_name = isset($data->industry_name) ? $data->industry_name:'';
	}
	return $industry_name;
}
function getLocationsPlace($id=null,$company_id=null)
{
	$CI =& get_instance();
	$location_id = '';
	if($id!=null)
	{
		$counts = $CI->db->query("SELECT COUNT(id) AS total FROM locations WHERE id < $id AND company_id = $company_id")->row();
		$locations_total = isset($counts->total) ? $counts->total:'';
		$location_id = $locations_total + 1;
	}
	return $location_id;
}
function genrate_qrcode($id=null,$lastid=0)
{
	$CI =& get_instance();
	$CI->load->library('phpqrcode/qrlib'); 
	$qrtext = $id;		
	if(isset($qrtext))
	{ 
		$SERVERFILEPATH = 'resources/qrimage/';
		$text = $qrtext;
		$text1= substr($text, 0,2);
		$folder = $SERVERFILEPATH;
		$file_name1 = "qrcode_" . md5($lastid) . ".png";
		if (file_exists($folder.$file_name1)) {
			 unlink($folder.$file_name1);
		}
		
		$file_name = $folder.$file_name1;
		QRcode::png($text,$file_name);
		$qrimage_new_name = $file_name1;
	}
	return $qrimage_new_name;

}
function genrate_image($id=null){
	if($id>0){
		$CI =& get_instance();
		$CI->load->helper('phantomjs');
		$CI->load->helper('url');
		$filename="cc_ex_f_".md5($id).".png";
		$url =  base_url()."card/front/$id/".md5($id);
		$filenamepath="/resources/cards/".$filename;
		
		if(!rasterize_wrapper($url,  dirname(dirname(dirname(__FILE__))).$filenamepath)){
			 
		} 
		$filename="cc_ex_b_".md5($id).".png";
		$url =  base_url()."card/back/$id/".md5($id);
		$filenamepath="/resources/cards/".$filename;
		
		if(!rasterize_wrapper($url,  dirname(dirname(dirname(__FILE__))).$filenamepath)){
			 
		} 
		
		return "cc_ex_f_".md5($id).".png";
	}
	
}
function genrateimage($id=null)
{
	ini_set('max_execution_time', 180000);
	ini_set('fastcgi_read_timeout', 99999999);
	ini_set('memory_limit', "-1"); 
		 
	$CI =& get_instance();
	$last_data=$CI->model->getLastData2("contacts",$id);
	$company_id= $last_data->company_id;
	$contract_number= $last_data->contract_number;
	$dependant_data=$CI->model->getdependents("contact_dependant",$contract_number);
	 
	/* $imagedata=$CI->model->getimageData("companies",$company_id); */
	
	$nameconfig=$CI->model->getDatarow("config","where isVisible=1 AND name='showname'");
 
	$dependconfig=$CI->model->getDatarow("config","where isVisible=1 AND name='showdependent'");
 
	$imageconfig=$CI->model->getDatarow("config","where isVisible=1 AND name='image'");
	
	$regdate=$CI->model->getDatarow("config","where isVisible=1 AND name='regdate'"); 
	
	$font=realpath('resources/font/Facit Regular.otf');
	$image=imagecreatefromjpeg("resources/img/formate.jpg");
	$color=imagecolorallocate($image, 50, 51, 50);
	$fname=ucwords($last_data->first_name." ".$last_data->last_name);
	$heightdependimg = 300;
	if($nameconfig->value==1){
		imagettftext($image, 15, 0, 15, $heightdependimg, $color,$font, $fname);
	}
	
	
	if($dependconfig->value==1){
		if(isset($dependant_data))
		{
			 
			if(!empty($dependant_data))
			{
				$i = 0; 
				/* $heightdepend = 390;
				if(count($dependant_data) > 3){ */
					$heightdepend = 350;
				/* } */
				 
				foreach($dependant_data as $key => $value) 
				{
					$dependent_data = '';
					$dependent_data2 = '';
					if(!empty($value->relationship) || !empty($value->first_name) || !empty($value->last_name)){
						$dependent_data =(isset($value->relationship) && !empty($value->relationship)) ? $value->relationship.':':'';
						$datadependent = explode(' ',trim($dependent_data)); 
						if(count($datadependent) > 1){ 
							$dependent_datas=$datadependent[1];
						}else{
							$dependent_datas = $datadependent[0];
						}
						/* if(strtolower($dependent_datas)!='spouse' || $dependent_datas!='SPOUSE'){
							$dependent_datas='D';
						}else{
							$dependent_datas='S';
						} */
						$mystring = strtolower($dependent_datas);  
						$findme   = 'spouse';
						$pos = strpos($mystring, $findme);
						
						if ($pos === false){
							$dependent_datas = 'D';
						}else{
							$dependent_datas = 'S';
						}
						$dependent_datas=$dependent_datas.': ';
						imagettftext($image, 9, 0, 15, ($heightdepend+$i), $color,$font, strtoupper($dependent_datas));
					 
						$dependent_data = '';
						$dependent_data2 = '';
						
						$dependent_data2.=(isset($value->first_name) && !empty($value->first_name)) ? ucwords($value->first_name):'';
						$dependent_data2.=(isset($value->last_name)  && !empty($value->last_name)) ? ' '.ucwords($value->last_name):'';
						/* $dependent_data2.=(isset($value->ssn)  && !empty($value->ssn)) ? ' '.$value->ssn:''; */
						
						imagettftext($image, 9, 0, 26, ($heightdepend+$i), $color,$font, $dependent_data2);
						$i = $i+20;
					}
					
				}
				
			}
		}
	}
	
	$heightdependimg = 300;
	
	$main_image_width = imagesx($image); 	
	
	
	
	
	$image_url = 'resources/admin/'.$imageconfig->value;
	$watermark_image = imagecreatefromjpeg($image_url);
	
	$margin_right = 45; 
	$margin_bottom = 290;
	$watermark_image_width = imagesx($watermark_image); 
	$watermark_image_height = imagesy($watermark_image);  
	
	$centerwidth = $main_image_width - $watermark_image_width;
	$margin_right = ($centerwidth/2);
     /* imagecopy($image, $watermark_image, 15, imagesy($image) - $watermark_image_height - $margin_bottom, 0, 0, $watermark_image_width, $watermark_image_height); */
      imagecopy($image, $watermark_image, imagesx($image) - $watermark_image_width - $margin_right, imagesy($image) - $watermark_image_height - $margin_bottom, 0, 0, $watermark_image_width, $watermark_image_height); 
	  
	if($dependconfig->value==1){  
		$qrimage_url = 'resources/qrimage/'.$last_data->qrimage;
		$watermark_qr = imagecreatefrompng($qrimage_url);
		$margin_right = 10; 
		$margin_bottom = 95;
		$watermark_qr_width = imagesx($watermark_qr); 
		$watermark_qr_height = imagesy($watermark_qr);
		imagecopy($image, $watermark_qr, imagesx($image) - $watermark_qr_width - $margin_right, imagesy($image) - $watermark_qr_height - $margin_bottom, 0, 0, $watermark_qr_width, $watermark_qr_height);
		
		
		$date=date("M d,Y",strtotime($last_data->active_member));
		/* imagettftext($image, 12, 0, imagesx($image) - $watermark_qr_width - $margin_right, 468, $color,$font, $date); */
		imagettftext($image, 12, 0, ((imagesx($image) - $watermark_qr_width - $margin_right) +18), 460, $color,$font, $date);
	
	}else{
		$qrimage_url = 'resources/qrimage/'.$last_data->qrimage;
		$watermark_qr = imagecreatefrompng($qrimage_url);
		$margin_right = 145; 
		$margin_bottom = 95;
		$watermark_qr_width = imagesx($watermark_qr); 
		$watermark_qr_height = imagesy($watermark_qr);
		
		$centerwidth = $main_image_width - $watermark_qr_width;
		$margin_right = ($centerwidth/2);
	
		imagecopy($image, $watermark_qr, imagesx($image) - $watermark_qr_width - $margin_right, imagesy($image) - $watermark_qr_height - $margin_bottom, 0, 0, $watermark_qr_width, $watermark_qr_height);
		
		/* $date=date("M d,Y",strtotime($last_data->active_member)); */
		$date=date("M d, Y",strtotime($regdate->value));
		imagettftext($image, 12, 0, ((imagesx($image) - $watermark_qr_width - $margin_right) +18), 460, $color,$font, $date);
		
	}
	 
	if($nameconfig->value==1){
		$account_id=(!empty($last_data->account_code)?$last_data->account_code:'');
		imagettftext($image, 12, 0, 15, 325, $color,$font, $account_id);
	}else{
		if($dependconfig->value==1){
			$account_id=(!empty($last_data->account_code)?$last_data->account_code:'');
			imagettftext($image, 15, 0, 15, $heightdependimg, $color,$font, $account_id);
			
		}else{
			$account_id=(!empty($last_data->account_code)?$last_data->account_code:'');
			imagettftext($image, 15, 0, ((imagesx($image) - $watermark_qr_width - $margin_right)-18), $heightdependimg, $color,$font, $account_id);
		} 
	}
	
	$random = rand(99999,999999999); 
	if (file_exists("resources/cards/cc_ex_".md5($id).".jpg")) {
		 unlink("resources/cards/cc_ex_".md5($id).".jpg");
	} 
	if (file_exists("resources/cards/cc_ex_".md5($id).".png")) {
		 unlink("resources/cards/cc_ex_".md5($id).".png");
	}
	
	 /* imagejpeg($image,"resources/cards/cc_ex_".md5($id).".jpg", 100);  */  
	
	imagepng($image,"resources/cards/cc_ex_".md5($id).".png", 9); 
	imagedestroy($image);
	$image_new_name = "cc_ex_".md5($id).".png"; 
	/* $image_new_name = "cc_ex_".md5($id).".jpg";  */
	return $image_new_name;

}
function get_contacts_vcard($id="")
{
	
	$CI =& get_instance();
    $CI->load->library('vcard');           
   
    $vcard_information = $CI->model->getById("vcard_information",1);
    $data = $CI->model->getById("contacts",$id);
	$datavcarddata = [];
    $datavcarddata['id'] = $id; 
    $datavcarddata['display_name'] = md5($vcard_information->first_name."_".$vcard_information->last_name.'_'.$id); 
    $datavcarddata['first_name'] = $vcard_information->first_name; 
    $datavcarddata['last_name'] = $vcard_information->last_name;                                                 
    $datavcarddata['cell_tel'] = $vcard_information->phone;                
    $datavcarddata['email1'] = $vcard_information->email; 
    $datavcarddata['work_address'] = isset($vcard_information->address) ? $vcard_information->address:'';
    $datavcarddata['company'] = getcompanyById($data->company_id);
   	if($data->image!="")
   	{
	    $getPhoto = file_get_contents('resources/cards/'.$data->image);
	    $b64vcard  = base64_encode($getPhoto);
	    $b64mline   = chunk_split($b64vcard,74,"\n");
	    $b64final   = preg_replace('/(.+)/', ' $1', $b64mline);
	    $photo       = $b64final;
	    $datavcarddata['url'] = base_url('curaechoice_'.md5($id));
	}
	else
	{
		$getPhoto = file_get_contents(base_url('resources/img/default.jpg'));
	    $b64vcard  = base64_encode($getPhoto);
	    $b64mline   = chunk_split($b64vcard,74,"\n");
	    $b64final   = preg_replace('/(.+)/', ' $1', $b64mline);
	    $photo       = $b64final;
	    $datavcarddata['url'] = base_url('resources/img/default.jpg');
	}
    $datavcarddata['photo'] =$photo;
    if(is_array($datavcarddata))
    {    
        $CI->vcard->reload($datavcarddata);
    }
    else
    {
        $CI->vcard->vcard();
    }
	$CI->vcard->downloadfile($id);
	$newname= (md5($vcard_information->first_name."_".$vcard_information->last_name.'_'.$id).'_'.$id.'.vcf');
    return $newname;
}
function escapeArray($array)
{
    foreach ($array as $key => $val)
    {
		if(is_array($val)){
			$array[$key]=escapeArray($val);
		}
		else{
			$array[$key]=addslashes($val);
		}
    }
	return $array;
}
function admin(){
	$CI =& get_instance();
	return $CI->session->userdata('adminId')==''?false:true;
}
function getcompanyById($id=null){
	$CI =& get_instance();
	
	$CI->load->model("admin/model");
	$name = $CI->model->getByIdcompany($id);
	return isset($name->company_name) ? $name->company_name : '';
}
function getvcardname($id=null){
	$CI =& get_instance();
	$CI->load->model("admin/model");
	$vcard = $CI->model->getById('contacts',$id);
	return isset($vcard->vcard_name) ? $vcard->vcard_name : '';
}
function getlocationId($id=null){
	$CI =& get_instance();
	
	$CI->load->model("admin/model");
	$locationn = $CI->model->getlocation($id);
	return isset($locationn->id) ? $locationn->id : '';
}
function ordinal($num) {
     if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
}
function getRecords($sql,$formData,$coloumns,$searchFields=array(),$sortFields=array(),$groupBy="",$order=""){
	$CI =& get_instance();
	$CI->load->model("admin/model");
	$sql2=$sql;
	// $order="";
	if(empty($sortFields)){
		$sortFields=$coloumns;
	}
	unset($coloumns[0]);
	$coloumns=array_values($coloumns);
	if(empty($searchFields)){
		$searchFields=$coloumns;
	}
	
	$searchFields=(array_values($searchFields));
	$sortFields=(array_values($sortFields));
	$like="";
	// echo "<pre>";
	// print_r($sortFields);
	// echo "</pre>";
	// die;
	if(isset($formData['search']['value'])&&$formData['search']['value']!=="") // if datatable send POST for search
		{
			// echo "usman";
			// die;
			$search=$formData['search']['value'];
			for($i=0;$i<count($searchFields);$i++){
				if($i==0){
					$like.=" and ( ".$searchFields[$i]." like '%$search%' ";	
				}
				else if($i==count($searchFields)-1){
					$like.=" or ".$searchFields[$i]." like '%$search%' )";	
				}
				else{
					$like.=" or ".$searchFields[$i]." like '%$search%' ";	
				}
			}
			$sql.=$like;
			// echo $sql;
			// die;
		}
		for($i=0;$i<count($searchFields)-2;$i++){
			// echo $formData['columns'][$i]['search']['value'];
				if(isset($formData['columns'][$i])){
					if($formData['columns'][$i]['search']['value']!==""){
					$search=$formData['columns'][$i]['search']['value'];
					
					// if($i==6){
						
					// }
					// else{
						$sql.=" and ( ".$searchFields[$i]." like '%$search%' ) ";	
						
					// }
					
					}
				}
				
				
			}
			// echo $sql;die;
			// echo 
		if($groupBy!==""){
			$num_rows=$sql.$groupBy;
			$countFiltered=$CI->db->query($num_rows)->num_rows();
		}
		else{
			$countFiltered=$CI->db->query($sql)->num_rows();
		}
		if(isset($formData['order'])) // here order processing
		{
			$order=" order by ".$sortFields[$formData['order'][0]['column']]." ".$formData['order'][0]['dir'];
		}
		else{
			if(isset($sortFields[0])){
				$default_column=$sortFields[0];
				$default_column=explode(" as ",$sortFields[0]);
				$order=" order by ".$default_column[0]." DESC";
			}
			
		}
		
		$limit=$formData['length']!=-1?" limit ".$formData['start'].",".$formData['length']:"";
		
		$sql.=$groupBy;
		$sql.=$order;
		
		$sql.=$limit;
		// echo $sql;
		// die;
		
		return array("sql"=>$sql,"countFiltered"=>$countFiltered);
				
}
function addActions($active,$id){
	$html="<a data-toggle='Edit' title='Edit' href='#".$active."/edit/".$id."' data-title='Edit $active' class='btn btn-default loadview modalview edite'><i class='fa fa-edit'></i></a><a data-toggle='Delete' title='Delete' class='btn btn-danger delete swal ' href='".admin_url()."dashboard/".$active."/delete/$id'><i class='fas fa-trash'></i></a>";
	return $html;
}
function addActions_contact($active,$id){
	$html="<a data-toggle='Edit' title='Edit' href='#".$active."/edit/".$id."' data-company='".$id."' data-title='Edit $active' class='btn btn-default loadview modalview edite contact_edit_page'><i class='fa fa-edit'></i></a><a data-toggle='Delete' title='Delete' class='btn btn-danger delete swal ' href='".admin_url()."dashboard/".$active."/delete/$id'><i class='fas fa-trash'></i></a>";
	return $html;
}
function addActions2($active,$id){
	$html="<a href='#".$active."/edit/".$id."' data-title='Edit $active' class='loadview modalview btn btn-info'><i class='fa fa-edit'></i>Edit</a><a class='delete_customer btn btn-danger' href='".admin_url()."dashboard/".$active."/delete/$id'><i class='fas fa-trash'></i>Delete</a>";
	return $html;
}

 
 function addTransaction($payment,$type,$transaction_type,$c_id="",$s_id="",$description,$detail_id){
	$CI =& get_instance();
	
	$array=array(
		"payment"=>$payment,
		"type"=>$type,
		"payment_type"=>$transaction_type,
		"customer_id"=>$c_id,
		"supplier_id"=>$s_id,
		"description"=>$description,
		"detail_id"=>$detail_id,
	);
	$CI->model->addData("transaction",$array);
}




function validateData($table,$data,$id){
	$CI =& get_instance();
	$result=$CI->db->query("describe $table")->result();
	// echo "<pre>";
	// print_r($result);
	// echo "</pre>";
	// die;
	$keys=array_keys($data);
	foreach($result as $row){
		if(in_array($row->Field,$keys)){
			if($row->Null=="NO"){
				$CI->form_validation->set_rules($row->Field, ucfirst($row->Field), 'required');
			}
			if($row->Key=="UNI"){
				$newval=$data[$row->Field];
				if($id!==""){
					$oldval=$CI->db->query("select $row->Field from $table where id=$id")->result_array()[0][$row->Field];
					// print_r($oldval);
					// die;
					if($newval!==$oldval){
						$CI->form_validation->set_rules($row->Field, ucfirst($row->Field), "required|is_unique[$table.$row->Field]");
					}
				}
				else{
					$CI->form_validation->set_rules($row->Field, ucfirst($row->Field), "required|is_unique[$table.$row->Field]");
				}
			}
		}
	}
    return $CI->form_validation->run();
}

function cdate($date){
	return date('D M d Y h:i a', strtotime($date));
}
function customdate($date){
	return date('D, M d Y ', strtotime($date));
}
function usadate($date){
	return date('M d, Y ', strtotime($date));
}

function usadateformat($date){
	return date('m/d/Y', strtotime($date));
}
function usatimeformat($date){
	return date('h:i a', strtotime($date));
}
function isUser(){
	$CI =& get_instance();
	return $CI->session->userdata('userId')==''?false:true;
}
function currentAdmin(){
	$CI =& get_instance();
	return $CI->session->userdata('adminId');
}


function cprice($price){
	return ($price);
}
function getCurrentData(){
	$CI =& get_instance();
	$CI->load->model("admin/model");
	return $CI->model->getById("admin",$CI->session->userdata('adminId'));
}
function getSiteData($name,$visible=null){
	$CI =& get_instance();
	$CI->load->model("admin/model");
	$visibleCon=$visible==null?"":" and isVisible=1";
	return $CI->model->getData("config"," where name='$name' $visibleCon");
}

function encrypt($string) {
	$key="usmannnn";
	  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }

  return base64_encode($result);
}
function uploadFile($upload_path,$name,$extensions="gif|jpg|png|jpeg",$max_size="2048000"){
	$CI =& get_instance();
	$config = array(
	'upload_path' => $upload_path,
	'allowed_types' => $extensions,
	'overwrite' => TRUE,
	'file_name' => time(),
	'max_size' => $max_size
	// 'max_height' => "768",
	// 'max_width' => "1024"
	);
	$CI->load->library('upload', $config);
	if(isset($_FILES[$name])&&$_FILES[$name]['name']!==""){
		if(!$CI->upload->do_upload($name)){ 
			return $CI->upload->display_errors();
		}
		else{
			return $CI->upload->data();
		}
	}
	else{
		return "wrong file";
	}
}

function decrypt($string) {
	$key="usmannnn";
	  $result = '';
  $string = base64_decode($string);

  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }

  return $result;
}
function generateView($view,$data=null){
	$CI =& get_instance();
	$theme=getSiteData('theme')[0]->value;
	$CI->load->view("$theme/template/mainsidebar",$data);
	$CI->load->view("$theme/template/mainheader",$data);
	// $CI->load->view($theme."/".$view,$data);
	$CI->load->view("$theme/template/mainfooter",$data); 	
}
function generateViewOLD($view,$data=null){
	$CI =& get_instance();
	$theme=getSiteData('theme')[0]->value;
	$CI->load->view("$theme/template/sidebar",$data);
	$CI->load->view("$theme/template/header",$data);
	// $CI->load->view($theme."/".$view,$data);
	$CI->load->view("$theme/template/footer",$data); 	
}
function generatePageView($view,$data=null){
	$CI =& get_instance();
	$theme=getSiteData('theme')[0]->value;
	$CI->load->view($theme."/".$view,$data);
		
}
function generateFrontView($view,$data=null){
	$CI =& get_instance();
	$theme=getSiteData('theme')[0]->value;
	$CI->load->view("$theme/template/header",$data);
	// $CI->load->view($theme."/".$view,$data);
	$CI->load->view("$theme/template/footer",$data);
	
}
function generateCountdown($date,$catId){
	$totalSecDiffe=0;
	$diffPre=strtotime($date)-time();
	$totalSec=$diffPre;
	$totalhourShow =floor($diffPre/3600) . ' : ';
	$daysShow=floor($totalhourShow / 24) . ' : ';
	$hourShow=floor($totalhourShow % 24) . ' : ';
	$diffPre = $diffPre % 3600;
	$minuteShow = floor($diffPre / 60) . ' : ';
	$secondShow = $diffPre % 60;
	$timestamp = time() + (7 * 24 * 60 * 60);
	$totalSec; //<-Time of countdown in seconds.  ie. 3600 = 1 hr. or 86400 = 1 day.
	$totalhours =floor($totalSec / 3600) . ' : ';
	$days=floor($totalhours / 24) ;
	$hours=floor($totalhours % 24);
	$totalSec = $totalSec % 3600;
	$minutes = floor($totalSec / 60) ;
	$totalSec = $totalSec % 60;
	$seconds = $totalSec;
	echo "<script>timer.countdown($hours,$minutes,$seconds,$days,$catId);</script>";

}
function frontSidebar(){
	$CI =& get_instance();
		$CI->load->view("Bino/template/sidebar");
}

function cdate2($date){
	
	return date('D M d Y h:i:s a', strtotime($date) + (86400-60));
}
function allDay_date($date){
	
	return date("Y-m-d H:i:s",strtotime($date) + 86395);
}




function setMsg($msg,$class){
	$CI =& get_instance();
	$CI->session->set_flashdata('msg',"<div class='alert alert-$class'>$msg</div>");
}
function getMsg(){
	$CI =& get_instance();
	// echo validation_errors();
	// die;
	// echo "usman";
	echo validation_errors()!==""?"<div class='alert alert-danger'>".validation_errors()."</div>":"";
	echo $CI->session->flashdata('msg')?$CI->session->flashdata('msg'):"";
}


function sendEmail($to,$msg,$subject,$attach="") {
	$CI =& get_instance();
	$config = array(
	  // 'protocol' => 'smtp',
	  // 'smtp_host' => getSiteData("smtpHost")[0]->value,
	  // 'smtp_port' => getSiteData("smtpPort")[0]->value,
	  // 'smtp_user' => getSiteData("smtpUser")[0]->value, 
	  // 'smtp_pass' => getSiteData("smtpPass")[0]->value, 
	  'mailtype' => 'html',
	  'charset' => 'iso-8859-1',
	  'wordwrap' => TRUE
	);
	$data['msg']=$msg;
	$email_template=$CI->load->view(getSiteData("theme")[0]->value."/email-template",$data,true);
	
	$CI->load->library('email', $config);
	$CI->email->initialize($config); // Add 
	$CI->email->from(getSiteData("sendingEmail")[0]->value,getSiteData("siteName")[0]->value);
	$CI->email->to($to);
	$CI->email->subject($subject);
	$CI->email->message($email_template);
	if($attach!==""){
		$CI->email->attach($attach);
		// $CI->email->attach("resources/img/a1.jpg");
	}
  return  $CI->email->send();

  // print_r($CI->email->print_debugger());  
}
function uniquestring($phone){
	$CI =& get_instance();
	$string="";
	$CI->load->helper('string');
	$string=random_string('nozero', 6);
	$exist=false;
	$query = $CI->db->query("SELECT * FROM account_codes WHERE phone_number = '".$phone."'");
	$datafile= $query->row_array();
	if(!empty($datafile['acc_code'])){
		return $datafile['acc_code'];
	}
	do{
		$query = $CI->db->query("SELECT * FROM account_codes WHERE phone_number != '".$phone."' AND acc_code = '".$string."'");
		$datafile= $query->row_array();
		if(!empty($datafile)){
			$exist=true;
			$string=random_string('nozero', 6);
		}else{
			$exist=false;
		} 
	}while($exist);
	
	$dataarray=array();
	$dataarray['acc_code']=$string;
	$dataarray['phone_number']=$phone;
	$dataarray['created_date']=date('Y-m-d H:i:s');
	$CI->db->insert('account_codes',$dataarray);
	
	return $string;
}
function createpdfcard($id=0){
	$CI =& get_instance();
	$data['showname']=$CI->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
	$data['showdependent']=$CI->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
	$data['image']=$CI->model->getDatarow("config","where isVisible=1 AND name='image'"); 
   $data['regdate']=$CI->model->getDatarow("config","where isVisible=1 AND name='regdate'"); 
	$last_data=$CI->model->getLastData2("contacts",$id);
	$company_id= $last_data->company_id;
	$contract_number= $last_data->contract_number;
	$data['dependent']=$CI->model->getdependents("contact_dependant",$contract_number);
	$data['contact']=$last_data;
	
	$CI->db->select('*');
	$CI->db->where('is_card',1);
	$query = $CI->db->get( 'care_coordination' );
	$data['providers'] = $query->result();
	 
	$htmlfront =$CI->load->view('card/indexfront',$data,true);
	$htmlback =$CI->load->view('card/indexback',$data,true);
	$stylesheet =$CI->load->view('card/stylesheet',[],true);   
	 
	$html =$CI->load->view('card/indexmpdf',$data,true);
	$stylesheet =$CI->load->view('card/stylesheet',[],true);   
	
	$file_name='card_'.md5($id).'.pdf';		
	if (file_exists('vcardpdf/'.$file_name)) {
		 unlink('vcardpdf/'.$file_name);
	}
	
	$CI->load->library('m_pdf'); 
	$params=array("",array(54,85),0,"",0,0,0,0,0,0,"P");
	$pdf = $CI->m_pdf->load($params);
	$pdf->debug = true; 
	$pdf->dpi = 300;
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);  
	$file_name='card_'.md5($id).'.pdf';	 
	$pdf->Output('vcardpdf/'.$file_name,'F');
	return $file_name;
}
?>