<?php $this->load->view('qrcode/widgets/header'); ?>
	<body class="login">
	<section class="ftco-section d-flex align-items-center">
		<div class="container"> 
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-md-6 col-lg-7">
					<div class="login-left-wrap py-5"> 
						<img src="<?php echo base_url();?>resources/assets/images/curae-logo.svg" class="logo"/>  
						<h3 class="logo_text">Your Ally in Care Coordination</h3>
						<h1 class="hide-mobile">Empowering Employers Employees and Providers</h1>
						<div class="hide-mobile sapp"></div>
						<p class="hide-mobile">Services provided by our radiology, surgery, oncology, physical therapy, chiropractic and dental providers</p>
					</div>
				</div>	
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap py-3">
						<h3 class="vcard_title">vCard Sign up</h3>
						<form action="" id="subscriptionform" class="login-form">
						<?php if($qrname->value == 1){?>
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
						<?php } ?>	
							<div class="form-group">
								<label class="pb-0" for="email">Email</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="" required>
							</div> 
							<?php if($cardno->value == 1){?>
							<div class="form-group">
								<label class="pb-0" for="cardno">Card #</label>
								<input class="form-control" name="cardno" id="cardno" placeholder="" required>
							</div> 
							<p style="color: #151515;">For help please email <a style="color: #151515;" href="mailto:suppport@curaechoice.com">suppport@curaechoice.com</a></p>
							<?php } ?>	
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
									<div class="col-<?php if($qrdob->value == 1){?>5<?php }else{ ?>12<?php }?> pr-2">
										<div class="row">
											<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0 ">Verification Code</label>   
											<div class="col-sm-12">
												<input type="number" class="form-control" maxlength="6" id="vcode" name="vcode" placeholder="xxxxxx" required>
											</div> 
										</div>
									</div>
									<?php if($qrdob->value == 1){?>
									<div class="col-7">
										<div class="row">
											<label for="exampleInputNumer" class="col-sm-12 col-form-label pb-0">Date of Birth:</label> 
											<div class="col-12 pl-2 pr-2"> 
												<input type="text" name="dob" id="dob" class="form-control" required  type="text" data-mask="00/00/0000" data-mask-selectonfocus="true" placeholder="mm/dd/yyyy"> 
											</div>
										</div>  
									</div>
									<?php } ?>
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
	 <script type="text/javascript">
		var qrfullname = '<?php echo $qrname->value;?>';
		var qrdob = '<?php echo $qrdob->value;?>';
	 </script>
 <?php $this->load->view('qrcode/widgets/footer'); ?>
 <script type="text/javascript">
		 	var locationenable = false; 	 
		 $(document).ready(function() {
			navigator.permissions.query({
				 name: 'geolocation'
			 }).then(function(result) {
				 if (result.state == 'granted') {
					 report(result.state);
					   locationenable = true; 
					navigator.geolocation.getCurrentPosition(function (p) { 
						 $('#latitude').val(p.coords.latitude);
						 $('#longitude').val(p.coords.longitude);
					});
				 } else if (result.state == 'prompt') {
					 report(result.state);
					 /* $('#submitbtn').addClass('d-none'); */
					locationenable = false; 
					 navigator.geolocation.getCurrentPosition(function (p) { 
						 $('#latitude').val(p.coords.latitude);
						 $('#longitude').val(p.coords.longitude);
						 locationenable = true; 
					});
				 } else if (result.state == 'denied') {
					 report(result.state);
					 /* $('#submitbtn').addClass('d-none'); */
					 locationenable = true; 
				 }
				 result.onchange = function() {
					 report(result.state);
				 }
			 }); 
			
			
			/* if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (p) { 
					 $('#latitude').val(p.coords.latitude);
					 $('#longitude').val(p.coords.longitude);
				});
			}else{
				alert('AAA');
			}  */
		 });
		 
		 

	   </script>
	</body>
</html> 