<!doctype html>

<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title><?php echo getSiteData('siteName')[0]->value; ?> | <?php echo @$title; ?></title>

        <meta name="description" content="Upos - Point of Sale">
        <meta name="author" content="pixelcave">
      
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/css/font-awesome.min.css">
        <link rel="shortcut icon" href="<?php echo res_url(); ?>img/image_logo.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo res_url(); ?>img/image_logo.png">
       <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/slick/slick.css">
        <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/slick/slick.css">
        <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/slick/slick-theme.css">
        <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/sweetalert2/sweetalert2.min.css">
		
		 <!-- kendu schedular -->
		 <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/kendu/kendu.common.min.css"></link>
		 <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/kendu/kendu.default.min.css"></link>
		 <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/kendu/kendu.default.mobile.min.css"></link>
		 
		
        <!-- Fonts and Codebase framework 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        -->
		<link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" id="css-main" href="<?php echo res_url(); ?>codebase/assets/css/codebase.min.css">
        <link rel="stylesheet" id="css-main" href="<?php echo res_url(); ?>codebase/assets/js/plugins/datatables/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="<?php echo res_url(); ?>codebase/assets/js/plugins/select2/css/select2.min.css"></link>
		<link rel="stylesheet" id="css-main" href="<?php echo res_url(); ?>codebase/assets/css/style.css">
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
        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
            <!-- Side Overlay-->
            <!-- END Side Overlay -->

             
            <div id="overlay"></div>
        <div id="overlayContent">
        <img id="imgBig" src="" alt="" width="400" />
        </div>
            
            <!-- END Sidebar -->
