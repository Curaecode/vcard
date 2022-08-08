<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<?php 
	$imageconfig=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
?>
<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- User profile -->
		<div class="user-profile position-relative" style="background: url(<?php echo base_url();?>assets/images/background/user-info.jpg) no-repeat;">
			<!-- User profile image -->
			<div class="profile-img" style="overflow: hidden;"> <img src="<?php echo res_url();?>img/smalllogo.png" alt="user" class="w-100" width="100" /> </div>
			<!-- User profile text-->
			<div class="profile-text pt-1 dropdown"> 
				<a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><?php echo getCurrentData()->Name;?></a>
				<div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink"> 
					<a class="dropdown-item  loadview" href="#profile/"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My
							Profile</a>
						<a class="dropdown-item loadview" href="#changePassword/"><i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i>
							Change Password</a>
						 
						<div class="dropdown-divider"></div>
						<?php if($this->session->userdata('adminType') == 0){?>
						<a class="dropdown-item  loadview" href="#settings/"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
							Account Setting</a>
						<div class="dropdown-divider"></div>
						<?php } ?>
						<a class="dropdown-item" href="<?php echo admin_url(); ?>login/logout"><i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i> Logout</a>
					 
				</div>
			</div>
		</div>
		<!-- End User profile text-->
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-small-cap">
					<i class="mdi mdi-dots-horizontal"></i>
					<span class="hide-menu">Personal</span>
				</li>
				<li class="sidebar-item">
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
						aria-expanded="false">
						<i class="mdi mdi-gauge"></i>
						<span class="hide-menu">Main </span>
					</a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item">
							<a href="<?php if($this->session->userdata('adminType') > 0){?>#contacts<?php }else{ ?>#home<?php }?>" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Dashboard </span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="#contacts/" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Active Members </span>
							</a>
						</li> 
						<li class="sidebar-item">
							<a href="#deactivecontacts/" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Deactive Members </span>
							</a>
						</li> 
						<?php if($this->session->userdata('adminType') == 0){?>
						<li class="sidebar-item">
							<a href="#upload_excel_ajax/" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Import Contacts </span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="#hospitals/" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Providers </span>
							</a>
						</li> 
						<li class="sidebar-item">
							<a href="#settings/" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Settings </span>
							</a>
						</li> 
						<li class="sidebar-item">
							<a href="#users/" class="sidebar-link loadview">
								<i class="mdi mdi-adjust"></i>
								<span class="hide-menu"> Users </span>
							</a>
						</li> 
						<?php } ?>
					</ul>
				</li>
				<?php if($this->session->userdata('adminType') == 1){?>
					<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
						href="javascript:void(0)" aria-expanded="false"><i
							class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Logs </span></a>
						<ul aria-expanded="false" class="collapse  first-level">
							<li class="sidebar-item"><a href="#qrcodelogs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Subscription Logs
									</span></a></li> 
						</ul>
					</li>
				<?php } ?>
				<?php if($this->session->userdata('adminType') == 0){?>
						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
						href="javascript:void(0)" aria-expanded="false"><i
							class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Logs </span></a>
						<ul aria-expanded="false" class="collapse  first-level">
							<li class="sidebar-item"><a href="#maillogs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Email Logs
									</span></a></li> 
							<li class="sidebar-item"><a href="#qrcodelogs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Subscription Logs
									</span></a></li> 
							<li class="sidebar-item"><a href="#detaillogs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Providers Logs
									</span></a></li> 
							<li class="sidebar-item"><a href="#cardlogs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Card Access Logs
									</span></a></li>
							<li class="sidebar-item"><a href="#urllogs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Web Access Logs
									</span></a></li> 
							<li class="sidebar-item"><a href="#twilliologs/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> Twillio Logs
									</span></a></li> 
							<li class="sidebar-item"><a href="#twillio/" class="sidebar-link loadview"><i
										class="mdi mdi-book-multiple"></i><span class="hide-menu"> SMS Logs
									</span></a></li> 
						</ul>
					</li> 
				<?php } ?>
				 
				 
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
						href="<?php echo admin_url(); ?>login/logout" aria-expanded="false"><i
							class="mdi mdi-directions"></i><span class="hide-menu">Log Out</span></a></li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
	<!-- Bottom points-->
	<div class="sidebar-footer">
		<!-- item-->
		<a href="#profile" class="link loadview" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="#profile" class="link  loadview" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><i class="mdi mdi-gmail"></i></a>
		<!-- item-->
		<a href="<?php echo admin_url(); ?>login/logout" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><i class="mdi mdi-power"></i></a>
	</div>
	<!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->

<div class="page-wrapper">
<div class="container-fluid">
	<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
		<div id="overlay"></div>
		<div id="overlayContent">
			<img id="imgBig" src="" alt="" width="400" />
		</div>
		<!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
					
                    <div class="content page-content ">
					 </div>
                
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->