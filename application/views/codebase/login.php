<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

       <title><?php echo getSiteData('siteName')[0]->value; ?> | <?php echo @$title; ?></title>

        

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo res_url(); ?>codebase/assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo res_url(); ?>codebase/assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo res_url(); ?>codebase/assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="<?php echo res_url(); ?>codebase/assets/css/codebase.min.css">


        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="<?php echo res_url(); ?>codebase/assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        <style>
            .btn.btn-rounded {
    border-radius: 0px!important;
}
 
.bg-gd-dusk{
    background: linear-gradient( 
45deg
 , #19aae2, #e2e546) !important;
}
        </style>
    </head>
    <body>

        
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-gd-dusk">
                    <div class="fix_head_fit hero-static content content-full bg-white invisible" data-toggle="appear">
                        <!-- Header -->
                        <div class="py-30 px-5 text-center">
                            <a class="link-effect font-w700" href="<?php echo admin_url();?>">
                                <img src="<?php echo res_url();?>img/image_logo.png" style="width:116px;margin-top:-9px;">
                                <br>
                                <span class="font-size-xl text-primary-dark"><?php echo getSiteData('siteName')[0]->value; ?></span>
                            </a>
                            <h1 class="h2 font-w700 mt-50 mb-10">Welcome to Your Dashboard</h1>
                            <h2 class="h4 font-w400 text-muted mb-0">Please sign in</h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <div class="row justify-content-center px-5">
                            <div class="col-sm-8 col-md-6 col-xl-4">
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
								<?php 
								getMsg();
								echo isset($msg)?$msg:""; 
								
								?>
            
							   <form class="js-validation-signin" action="" method="post">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="login-username" name="email">
                                                <label for="login-username">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="password" class="form-control" id="login-password" name="password">
                                                <label for="login-password">Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row gutters-tiny">
                                        <div class="col-12 mb-10">
                                            <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                                <i class="si si-login mr-10"></i> Sign In
                                            </button>
                                        </div>
                                       
                                        <div class="col-sm-6 mb-5">
                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary"  href="<?php echo admin_url()."login/forgetPassword"; ?>">
                                                <i class="fa fa-warning text-muted mr-5"></i> Forgot password
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END Sign In Form -->
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!--
            Codebase JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out <?php echo res_url(); ?>codebase/assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the <?php echo res_url(); ?>codebase/assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            <?php echo res_url(); ?>codebase/assets/js/core/jquery.min.js
            <?php echo res_url(); ?>codebase/assets/js/core/bootstrap.bundle.min.js
            <?php echo res_url(); ?>codebase/assets/js/core/simplebar.min.js
            <?php echo res_url(); ?>codebase/assets/js/core/jquery-scrollLock.min.js
            <?php echo res_url(); ?>codebase/assets/js/core/jquery.appear.min.js
            <?php echo res_url(); ?>codebase/assets/js/core/jquery.countTo.min.js
            <?php echo res_url(); ?>codebase/assets/js/core/js.cookie.min.js
        -->
        <script src="<?php echo res_url(); ?>codebase/assets/js/codebase.core.min.js"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at <?php echo res_url(); ?>codebase/assets/_es6/main/app.js
        -->
        <script src="<?php echo res_url(); ?>codebase/assets/js/codebase.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?php echo res_url(); ?>codebase/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?php echo res_url(); ?>codebase/assets/js/pages/op_auth_signin.min.js"></script>

    </body>
</html>