<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo getSiteData('siteName')[0]->value; ?> | <?php echo @$title; ?></title>
	<meta name="description" content="Upos - Point of Sale">
    <meta name="author" content="pixelcave">
		  
    <link rel="canonical" href="<?php echo base_url();?>" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/apexcharts/dist/apexcharts.css">
	
	 <link href="<?php echo base_url();?>assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
	 
	<!-- Page JS Plugins CSS -->
	<link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/slick/slick.css">
	<link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/slick/slick.css">
	<link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/slick/slick-theme.css"> 
	<link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/select2/css/select2.min.css"></link>
	<link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">	
	
		
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

		<script>
			var enable_loader=<?php echo getSiteData('enable_loader')[0]->value; ?>;
			var line_loader=<?php echo getSiteData('line_loader')[0]->value; ?>;
			var admin_url = '<?php echo admin_url(); ?>';
			var base_url='<?php echo base_url();?>';
		</script>
		
</head>
<body>
	<div class="pace">
		<div class="pace-progress" data-progress-text="100%" data-progress="99" style="">
		  <div class="pace-progress-inner"></div>
		</div>
		<div class="pace-activity"></div>
	</div>
	<div class="loader" style="display:none;">
		<div class="loader2"></div>
	</div>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#1e88e5" stroke-width="2"></path>
          <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#1e88e5" stroke-width="2"></path>
          <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
          <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
          <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
	
	<div id="main-wrapper">
	
		<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand loadview" href="<?php if($this->session->userdata('adminType') > 0){?>#contacts<?php }else{ ?>#home<?php }?>">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo res_url();?>img/smalllogo.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo res_url();?>img/smalllogo.png" alt="homepage" class="light-logo" />
                        </b>
						<span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="<?php echo res_url();?>img/logo.png" alt="homepage" class="dark-logo">
                            <!-- Light Logo text -->
                            <img src="<?php echo res_url();?>img/logo.png" class="light-logo" alt="homepage">
                        </span>
                        <!--End Logo icon --> 
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                       
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">  
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
						<?php 
						 $imageconfig=$this->model->getDatarow("config","where isVisible=1 AND name='image'");
						 ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark loadview" href="#" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo res_url();?>admin/<?php echo $imageconfig->value;?>" alt="user" width="30" class="profile-pic rounded-circle" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                                    <div class=""><img src="<?php echo res_url();?>admin/<?php echo $imageconfig->value;?>" alt="user" class="rounded-circle" width="60"></div>
                                    <div class="ms-2">
                                        <h4 class="mb-0 text-white"><?php echo getCurrentData()->Name;?></h4> 
                                    </div>
                                </div>
                                <a class="dropdown-item loadview" href="#profile"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My Profile</a>
                                <a class="dropdown-item loadview" href="#changePassword"><i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i>	Change Password</a>
                                <?php if($this->session->userdata('adminType') == 0){?> 
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item loadview" href="#settings/"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i> Account Setting</a>
								<?php } ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo admin_url(); ?>login/logout"><i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i> Logout</a> 
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
		
		
		