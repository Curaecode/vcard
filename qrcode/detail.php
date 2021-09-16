<?php 
session_start();
if(!isset($_SESSION['vcode'])){
	header('Location: index.php');
	exit;
}
?><!doctype html>
<html lang="en">
  <head>
  	<title>Curaechoice | Your Ally in Care Coordination</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	<link rel="stylesheet" href="css/style.css"> 
	</head>
	<body class="detail">
	<section class="ftco-section">
		<div class="container"> 
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-md-6 col-lg-7">
					<div class="detail-left-wrap py-5">
						<!--<img src="images/curae-logo.png" class="logo"/> -->
						<img src="images/curae-logo.svg" class="logo"/> 
						<h3 class="logo_text">Your Ally in Care Coordination</h3>
						<h1 class="hide-mobile">Welcome!</h1>
						<div class="sapp hide-mobile"></div>
						<p>Click on any specialty button to view the map of providers</p>
					</div>
				</div>	
				<div class="col-md-6 col-lg-5">
					<div class="detail-wrap ">
						<div class="row"> 
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(1)" target="_blank">
										<img src="images/Hospital.png" />
										Hospital & ER 
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(2)" target="_blank">
										<img src="images/Physical-Therapy.png" />
										Physical Therapy 
									</a>
								</div>
							</div> 
							<div class=" col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(3)" target="_blank">
										<img src="images/Radiology.png" />
										Radiology
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(4)" target="_blank">
									<img src="images/Cardiovascular.png" />
									Cardiovascular 
								</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card" >
									<a href="javascript:void(0)" onclick="return openlink(5)" target="_blank">
										<img src="images/Urology.png" />
										Urology 
									</a>
								</div>
							</div> 
							<div class=" col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(6)" target="_blank">
										<img src="images/Surgery.png" />
										Surgery
									</a>
								</div>
							</div> 
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(7)" target="_blank">
										<img src="images/Oncology.png" />
										Oncology
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(8)" target="_blank">
										<img src="images/Obgyn.png" />
										OB/Gyn 
									</a>
								</div>
							</div>
							
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(9)" target="_blank">
										<img src="images/Chiropractic.png" />
										Chiropractors
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="mailto:support@curaechoice.com" target="">
										<img src="images/customer-support.png" />
										Customer Service
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div style="display:none;">
		<form method="post" id="linkform" action="https://www.curaechoice.net/subscriptions/openlink">
			<input type="hidden" name="longitude" id="longitude" value="" />
			<input type="hidden" name="latitude" id="latitude" value="" />
			<input type="hidden" name="linktype" id="linktype" value="0" />
			<input type="hidden" name="phone" id="phone" value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone'];}?>" /> 
		</form>
	</div>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
	<script type="text/javascript"> 
		function openlink(linkid){
			$('#linktype').val(linkid); 
			document.getElementById("linkform").submit();
			return false
		}
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