<?php 
session_start();
if(isset($_POST['vcode'])){
	$_SESSION['vcode']=$_POST['vcode'];
}
if(isset($_POST['area_code']) && isset($_POST['phone_first']) && isset($_POST['phone_second'])){
	$_SESSION['phone']=$_POST['area_code'].$_POST['phone_first'].$_POST['phone_second'];
}
$data['msg']="contact is added! successfully.";
$data['returned']=true;
echo json_encode($data);
?>

