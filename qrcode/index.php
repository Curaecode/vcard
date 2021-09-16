<?php 
	 session_start(); 
	if(isset($_SESSION['vcode'])){
		header('Location: detail.php');
		exit;
	} 
?><!doctype html>
<html lang="en">
  <head>
  	<title>Curaechoice | Your Ally in Care Coordination</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="css/style.css">  
	<link href="css/bootstrap-datepicker.standalone.css" rel="stylesheet">
	<style>
	.btn.disabled, .btn:disabled,.btn.disabled{
	  border: 1px solid #999999 !important;
	  background-color: #cccccc !important;
	  color: #666666 !important;
	}
	</style>
	</head>
	<body class="login">
	<section class="ftco-section d-flex align-items-center">
		<div class="container"> 
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-md-6 col-lg-7">
					<div class="login-left-wrap py-5"> 
						<img src="images/curae-logo.svg" class="logo"/>  
						<h3 class="logo_text">Your Ally in Care Coordination</h3>
						<h1 class="hide-mobile">Empowering Employers Employees and Providers</h1>
						<div class="hide-mobile sapp"></div>
						<p class="hide-mobile">Services provided by our radiology, surgery, oncology, physical therapy, chiropractic and dental providers</p>
					</div>
				</div>	
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap py-3">
						<h3 class="vcard_title">vCard Sign up</h3>
						<form action="detail.html" id="subscriptionform" class="login-form">
						
							<div class="row"> 
								<div class="col-6">
									<div class="form-group">
										<label class="pb-0">First Name</label>
										<input type="text" class="form-control" name="first_name" placeholder="" required>
									</div>
								</div>
								<div class="col-6 ">
									<div class="form-group">
										<label class="pb-0">Last Name</label>
										<input type="text" class="form-control" name="last_name" placeholder="" required>
									</div>
								</div> 
							</div> 
							<div class="form-group">
								<label class="pb-0" for="exampleInputPassword1">Email</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="" required>
							</div> 
							<div class="form-group">
								<div class="row">
									<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0">Mobile Number</label>  
									<div class="col-3 pr-2">
										<input type="number" class="form-control" maxlength="3" id="area_code" name="area_code" placeholder="xxx" required>
									</div>
									<div class="col-3 pl-2 pr-2">
										<input type="number" class="form-control" maxlength="3" id="phone_first" name="phone_first" placeholder="xxx" required>
									</div>
									<div class="col-3 pl-2">
										<input type="number" class="form-control" maxlength="4" id="phone_second" name="phone_second" placeholder="xxxx" required>
									</div>
									<div class="col-3 pl-1"> 
									<button type="button" onclick="getcode();" class="btn btn-sm form-control btn-primary rounded submit px-3 ">Send Code</button>
									</div>  
								</div> 
							</div>  
							
							<div class="form-group">
								<div class="row">
									<div class="col-5 pr-2">
										<div class="row">
											<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0 ">Verification Code</label>   
											<div class="col-sm-12">
												<input type="number" class="form-control" maxlength="6" id="vcode" name="vcode" placeholder="xxxxxx" required>
											</div> 
										</div>
									</div>
									<div class="col-7">
										<div class="row">
											<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0">Date of Birth:</label> 
											<div class="col-12 pl-2 pr-2"> 
												<input type="text" name="dob" id="dob" class="form-control" required  type="text" data-mask="00/00/0000" data-mask-selectonfocus="true" placeholder="mm/dd/yyyy"> 
											</div>
										</div>  
									</div>
								</div>
							</div> 
							<div class="form-group mt-4">
							<input type="hidden" name="longitude" id="longitude" value="" />
							<input type="hidden" name="latitude" id="latitude" value="" />
								<button id="submitbtn" type="submit" class="btn form-control btn-primary rounded submit px-3">Get Started</button>
							</div>
						</form> 
					</div>
				</div>
			</div>
		</div>
	</section>

	  <script src="js/jquery.min.js"></script>
	  <script src="js/popper.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <script src="js/bootstrap-datepicker.min.js"></script>
	  <script src="js/main.js"></script>
	  <script type="text/javascript" src="js/jquery.mask.js"></script>
	   <script type="text/javascript">
		 		 
		 $(document).ready(function() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (p) { 
					 $('#latitude').val(p.coords.latitude);
					 $('#longitude').val(p.coords.longitude);
				});
			} 
		 });
	   </script>
	</body>
</html> 