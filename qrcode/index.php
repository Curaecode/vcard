<!doctype html>
<html lang="en">
  <head>
  	<title>Curaechoice | Your Ally in Care Coordination</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	<link rel="stylesheet" href="css/style.css"> 
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
									<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0">Date of Birth:</label>
								<div class="col-4 pr-2">
									<select class="custom-select" name="day" id="day" required>
										<option value="">Date</option>
										<option value="01">1</option>
										<option value="02">2</option>
										<option value="03">3</option>
										<option value="04">4</option>
										<option value="05">5</option>
										<option value="06">6</option>
										<option value="07">7</option>
										<option value="08">8</option>
										<option value="09">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select>
								</div>
								<div class="col-4 pl-2 pr-2">
									<select class="custom-select" name="month" id="month" required>
										<option value="">Month</option>
										<option value="01">January</option>
										<option value="02">February</option>
										<option value="03">March</option>
										<option value="04">April</option>
										<option value="05">May</option>
										<option value="06">June</option>
										<option value="07">July</option>
										<option value="08">August</option>
										<option value="09">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
								</div>
								<div class="col-4 pl-2">
									<select class="custom-select" name="year" id="year" required>
										<option value="">Year</option> 
										<?php 
											$startyr=date('Y')-80;
											$endyr=date('Y');
										?>
										<?php for($yr=$startyr;$yr<=$endyr;$yr++){ ?>
											<option value="<?php echo $yr;?>"><?php echo $yr;?></option>
										<?php }?>
									</select>
								</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0 ">Verification Code</label>   
								<div class="col-sm-12">
								 	<input type="number" class="form-control" maxlength="6" id="vcode" name="vcode" placeholder="xxxxxx" required>
								</div> 
								</div> 
							</div> 
							<div class="form-group mb-0">
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
  <script src="js/main.js"></script>

	</body>
</html> 