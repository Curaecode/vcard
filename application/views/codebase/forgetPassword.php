<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title><?php echo getSiteData("siteName")[0]->value."| ".$title; ?>  </title>

        

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo res_url()."codebase/";?>assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo res_url()."codebase/";?>assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo res_url()."codebase/";?>assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="<?php echo res_url()."codebase/";?>assets/css/codebase.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="<?php echo res_url()."codebase/";?>assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
         <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2143526509294260');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2143526509294260&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137233488-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137233488-1');
</script>
    </head>
    <body>

        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-gd-dusk">
                    <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                        <!-- Header -->
                        <div class="py-30 px-5 text-center">
							<a class="link-effect font-w700" href="<?php echo admin_url();?>">
                                <img src="<?php echo res_url();?>img/UPOS2.png" style="width:116px;margin-top:-9px;">
								<br>
								<span class="font-size-xl text-primary-dark"></span><span class="font-size-xl"><?php echo getSiteData("siteName")[0]->value; ?></span>
                            </a>
                            <h1 class="h2 font-w700 mt-50 mb-10">Welcome to <?php echo getSiteData("siteName")[0]->value; ?></h1>
                            <h2 class="h4 font-w400 text-muted mb-0">Please Enter Your Email</h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <div class="row justify-content-center px-5">
                            <div class="col-sm-8 col-md-6 col-xl-4">
							<?php echo isset($msg)?$msg:""; ?>
            
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin" action="" method="post">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="login-username" name="email" required="">
                                                <label for="login-username">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row gutters-tiny">
                                        <div class="col-12 mb-10">
                                            <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                                <i class="si si-login mr-10"></i>Submit
                                            </button>
                                        </div>
                                        
                                        <div class="col-sm-6 mb-5">
                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="<?php echo admin_url()."login/"; ?>">
                                                <i class="fa fa-warning text-muted mr-5"></i> Sign In
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
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/jquery.countTo.min.js
            assets/js/core/js.cookie.min.js
        -->
        <script src="<?php echo res_url()."codebase/";?>assets/js/codebase.core.min.js"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="<?php echo res_url()."codebase/";?>assets/js/codebase.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?php echo res_url()."codebase/";?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?php echo res_url()."codebase/";?>assets/js/pages/op_auth_signin.min.js"></script>

    </body>
</html>