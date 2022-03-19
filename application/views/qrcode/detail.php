<?php $this->load->view('qrcode/widgets/header'); ?>
	<body class="detail">
	<section class="ftco-section">
		<div class="container"> 
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-md-6 col-lg-7">
					<div class="detail-left-wrap py-5">
						<!--<img src="images/curae-logo.png" class="logo"/> -->
						<img src="<?php echo base_url();?>resources/assets/images/curae-logo.svg" class="logo"/> 
						<h3 class="logo_text">Your Ally in Care Coordination</h3>
						<h1 class="hide-mobile">Welcome!</h1>
						<div class="sapp hide-mobile"></div>
						<p>Thank you for registering your card!</p>
						<p>Your registration is complete once you receive your V-card.</p>
						<?php /* <p>Click on any specialty button to view the map of providers</p> */ ?>
					</div>
				</div>	
				<div class="col-md-6 col-lg-5">
					<div class="detail-wrap ">
						<div class="row"> 
							<?php  
								$query = $this->db->get( 'care_coordination' );
								$result = $query->result();
								foreach( $result as $row ){
									?>
									<div class="col-sm-6 col-xs-6">
										<div class="card">
											<a href="javascript:void(0)" <?php if($row->comingsoon==0){ ?> onclick="return openlink(<?php echo $row->id;?>)" target="_blank" <?php } ?>  <?php if($row->comingsoon==1){?>style="background: gray;"<?php }?>>
												<img src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>" />
												<?php echo $row->linkname;?>  <?php if($row->comingsoon==1){echo '(Coming soon)';}?>
											</a>
										</div>
									</div>
							<?php   } ?>
							
							
						<?php	/* <div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(2)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Physical-Therapy.png" />
										Physical Therapy 
									</a>
								</div>
							</div> 
							<div class=" col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(3)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Radiology.png" />
										Radiology
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(4)" target="_blank">
									<img src="<?php echo base_url();?>resources/assets/images/Cardiovascular.png" />
									Cardiovascular 
								</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card" >
									<a href="javascript:void(0)" onclick="return openlink(5)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Urology.png" />
										Urology 
									</a>
								</div>
							</div> 
							<div class=" col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(6)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Surgery.png" />
										Surgery
									</a>
								</div>
							</div> 
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(7)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Oncology.png" />
										Oncology
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(8)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Obgyn.png" />
										OB/Gyn 
									</a>
								</div>
							</div>
							
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return openlink(9)" target="_blank">
										<img src="<?php echo base_url();?>resources/assets/images/Chiropractic.png" />
										Chiropractors
									</a>
								</div>
							</div>
							
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="javascript:void(0)" onclick="return false" target="_blank">  
										<img src="<?php echo base_url();?>resources/assets/images/Dental.png" />
										Dentists (Coming Soon)
									</a>
								</div>
							</div> */ ?>
							<div class="col-sm-6 col-xs-12" >
							<div class="card" style="padding: 9px;"><p style="margin-bottom: 0px;">Click on any specialty button to view the map of providers</p></div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="mailto:support@curaechoice.com" target="">
										<img src="<?php echo base_url();?>resources/assets/images/customer-support.png" />
										Customer Service
									</a>
								</div>
							</div>
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="tel:+1-800-646-9823" target="">
										<img src="<?php echo base_url();?>resources/assets/images/phone.png" />
										800-646-9823
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
		<form method="post" id="linkform" action="<?php echo base_url();?>subscriptions/openlink">
			<input type="hidden" name="longitude" id="longitude" value="" />
			<input type="hidden" name="latitude" id="latitude" value="" />
			<input type="hidden" name="linktype" id="linktype" value="0" />
			<input type="hidden" name="phone" id="phone" value="<?php if($this->session->userdata('phone')){ echo $this->session->userdata('phone');}?>" /> 
		</form>
	</div>

<?php $this->load->view('qrcode/widgets/footer'); ?>

	<script type="text/javascript"> 
		var returned = true;
		function openlink(linkid){
			/* if(returned==false){
				 Swal.fire({
					title: 'CuraeChoiceCard',
					text: 'Please enable your location to view detail.',
					type: 'error'
				});
				return false;
			} */
			$('#linktype').val(linkid); 
			document.getElementById("linkform").submit();
			return false
		}
		 $(document).ready(function() {
			 navigator.permissions.query({
				 name: 'geolocation'
			 }).then(function(result) {
				 if (result.state == 'granted') {
					 report(result.state);
					  
					navigator.geolocation.getCurrentPosition(function (p) { 
						 $('#latitude').val(p.coords.latitude);
						 $('#longitude').val(p.coords.longitude);
					});
				 } else if (result.state == 'prompt') {
					 report(result.state);
					  

					 navigator.geolocation.getCurrentPosition(function (p) { 
						 $('#latitude').val(p.coords.latitude);
						 $('#longitude').val(p.coords.longitude);
					});
					returned = false;
				 } else if (result.state == 'denied') {
					 report(result.state);
					 returned = false;
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
			}  */
		 });
	   </script>
	    
	</body>
</html> 