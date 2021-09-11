<?php 
session_start();
if(isset($_POST['vcode'])){
	$_SESSION['vcode']=$_POST['vcode'];
}
$data['msg']="contact is added! successfully.";
$data['returned']=true;
echo json_encode($data);
?>

