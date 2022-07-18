<?php $this->load->view('qrcode/widgets/header'); ?> 
	<body class="detail">
	<style>
	.nav-tabs>li {
		float: left;
		margin-bottom: -1px;
	}
	.nav>li {
		position: relative;
		display: block;
	}
	.nav-tabs>li>a {
		margin-right: 2px;
		line-height: 1.42857143;
		border: 1px solid transparent;
		border-radius: 4px 4px 0 0;
		color: #fff;
	}
	.nav>li>a {
		position: relative;
		display: block;
		padding: 10px 15px;
	}
	.nav-tabs>li a.active, .nav-tabs>li>a.active:focus, .nav-tabs>li>a.active:hover {
		color: #555;
		cursor: default;
		background-color: #fff;
		border: 1px solid #ddd;
		border-bottom-color: transparent;
	}
	.provideriframe iframe {
		min-height: 940px !important;
	}
	.employeriframe iframe {
		min-height: 940px !important;
	}
	.employeeiframe iframe {
		min-height: 913px !important;
	} 
	ul.elementor-icon-list-items {
	  list-style-type: none;
	} 
	ul.elementor-icon-list-items li.elementor-icon-list-item {
	      display: inline-block;
		  width: 43%;
		  color: #fff;
	}
	.elementor-icon-list-text a,.elementor-icon-list-text a:focus,.elementor-icon-list-text a:hover{
		color: #fff;
	}
	</style>
	<section class="ftco-section">
		<div class="container"> 
			<div class="row d-flex <?php /* align-items-center */ ?> justify-content-center"> 
				<div class="col-md-5 col-lg-5">
					<div class="detail-wrap ">
						<div class="detail-left-wrap py-5">
						<p>Click on any specialty button to view the map of providers</p>
						</div>
						<div class="row"> 
							<?php  
								/* $query = $this->db->get( 'care_coordination' ); */
								$this->db->from('care_coordination' );
								$this->db->order_by("comingsoon", "asc");
								$query = $this->db->get(); 
								$result = $query->result();
								foreach( $result as $row ){
									?>
									<div class="col-sm-6 col-xs-6">
										<div class="card">
											<a href="javascript:void(0)" <?php if($row->comingsoon==0){ ?> onclick="return openlink(<?php echo $row->id;?>)" target="_blank" <?php } ?>  <?php if($row->comingsoon==1){?>style="background: gray;color:white;"<?php }?>>
												<img src="<?php echo base_url();?>resources/admin/<?php echo $row->image;?>" />
												<?php echo $row->linkname;?>  <?php if($row->comingsoon==1){echo '(Coming soon)';}?>
											</a>
										</div>
									</div>
							<?php   } ?> 
							<div class="col-sm-6 col-xs-6">
								<div class="card">
									<a href="mailto:support@curaechoice.com" target="">
										<img src="<?php echo base_url();?>resources/assets/images/customer-support.png" />
										Customer Service
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-7 col-lg-7">
					<div class="detail-left-wrap py-5" style="padding-left: 10px;padding-right: 0px;"> 
						<div class="elementor-widget-container">
						  <ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
							  <span class="elementor-icon-list-icon">
								<i aria-hidden="true" class="fas fa-phone-alt"></i>
							  </span>
							  <span class="elementor-icon-list-text"><a href="tel:18006469823">(800) 646-9823</a></span>
							</li>
							<li class="elementor-icon-list-item">
							  <span class="elementor-icon-list-icon">
								<i aria-hidden="true" class="fas fa-envelope"></i>
							  </span>
							  <span class="elementor-icon-list-text"><a href="mailto:support@curaechoice.com">support@curaechoice.com</a></span>
							</li> 
						  </ul>
						</div>
						<div class="tg-textwidget">
							 <div class="panel with-nav-tabs panel-default">
								<div class="panel-heading">
										<ul class="nav nav-tabs">
											<li><a  class="active" href="#tab1default" data-toggle="tab">Contact Us</a></li>
											<?php /* <li><a href="#tab2default" data-toggle="tab">Employer</a></li>
											<li><a href="#tab3default" data-toggle="tab">Provider</a></li>  */ ?>
										</ul>
								</div>
								<div class="panel-body">
									<div class="tab-content">
										<div class="tab-pane fade in active show employeeiframe" id="tab1default"><script type="text/javascript" src="https://form.jotform.com/jsform/220026142783044"></script></div>
										<?php /* <div class="tab-pane fade employeriframe" id="tab2default"><script type="text/javascript" src="https://form.jotform.com/jsform/220026401788148"></script></div>
										<div class="tab-pane fade provideriframe" id="tab3default"><script type="text/javascript" src="https://form.jotform.com/jsform/220027130419139"></script></div> */ ?>
									</div>
								</div>
							</div>
						</div>
					
					</div> 
					<?php /* <div class="detail-left-wrap py-5"> 
						<img src="<?php echo base_url();?>resources/assets/images/curae-logo.svg" class="logo"/> 
						<h3 class="logo_text">Your Ally in Care Coordination</h3>
						<h1 class="hide-mobile">Welcome!</h1>
						<div class="sapp hide-mobile"></div>
						<p>Click on any specialty button to view the map of providers</p>
					</div> */ ?>
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
		 });
	   </script>
	    
	</body>
</html> 