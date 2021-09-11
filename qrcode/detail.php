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
									<a href="https://www.google.com/maps/d/edit?mid=1G8UzPewD67wneovOZwGWS2jf4Ix_FQOJ&usp=sharing" target="_blank">
										<img src="images/Hospital.png" />
										Hospital & ER 
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/edit?mid=1cbkJJ5DDSBWLalyd-UpGXd3R0iYkBq6I&usp=sharing" target="_blank">
										<img src="images/Physical-Therapy.png" />
										Physical Therapy 
									</a>
								</div>
							</div> 
							<div class=" col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/edit?mid=1liN4rua6182Pc6AyUQeqYNWP7PvVUhe_&usp=sharing" target="_blank">
										<img src="images/Radiology.png" />
										Radiology
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/viewer?mid=1mEQkvICm-Xc-4V8uP_YIFd872ly7PlSS&usp=sharing" target="_blank">
									<img src="images/Cardiovascular.png" />
									Cardiovascular 
								</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card" >
									<a href="https://www.google.com/maps/d/edit?mid=1qPmiV0HX6TH4s8pqs6ir0QKpnKsHyrcA&usp=sharing" target="_blank">
										<img src="images/Urology.png" />
										Urology 
									</a>
								</div>
							</div> 
							<div class=" col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/edit?mid=1bfH3TWDUVt6qqE8Q0zObsO9ltuz3q9Tf&usp=sharing" target="_blank">
										<img src="images/Surgery.png" />
										Surgery
									</a>
								</div>
							</div> 
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/edit?mid=1SYkZPSjFTUq41stL0vjVm2ijWuy0xBkm&usp=sharing" target="_blank">
										<img src="images/Oncology.png" />
										Oncology
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/u/0/viewer?mid=1kqdRfKlKE_2FRgVf21wjxr1vw9YiFlsa" target="_blank">
										<img src="images/Obgyn.png" />
										OB/Gyn 
									</a>
								</div>
							</div>
							
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="https://www.google.com/maps/d/u/0/viewer?mid=1FA9nYaPQsvm8bmByeWNeUcmSYH8BnHhs&ll=33.33683520115639%2C-87.10714970000001&z=10" target="_blank">
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

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

