<header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <img src="<?php echo res_url();?>img/image_logo.png" style="width:116px;margin-top:-9px;">
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="font-w700 loadview" href="<?php if($this->session->userdata('adminType') > 0){?>#contacts<?php }else{ ?>#home<?php }?>">
                                    <img src="<?php echo res_url();?>img/image_logo.png" style="width:116px;margin-top:-9px;">
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>

                    
                    <div class="menubar">
                        <ul class="nav-main">
                            <?php if($this->session->userdata('adminType') == 0){?>
							<li>
                                <a class="loadview <?php echo @$active=='dashboard'?"active":"";?>" href="#home"><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                            </li>
							<?php } ?>
                            <li class="<?php echo @$active=='contacts'?"open":"";?>">
                                <a class="loadview" href="#contacts/" ><i class="fa fa-address-book"></i><span class="sidebar-mini-hide">Contacts</span></a>
                            </li>
							<?php if($this->session->userdata('adminType') == 1){?>
								 <li class="<?php echo @$active=='qrcodelogs'?"open":"";?>">
									<a class="loadview" href="#qrcodelogs/" ><i class="fa fa-user mr-5"></i><span class="sidebar-mini-hide">Subscription Logs</span></a>
								</li> 
							<?php } ?>
							<?php if($this->session->userdata('adminType') == 0){?>
                             <li class="<?php echo @$active=='upload_excel_ajax'?"open":"";?>">
                                <a class="loadview" href="#upload_excel_ajax/" ><i class="fa fa-address-book"></i><span class="sidebar-mini-hide">Import Contacts</span></a>
                            </li>
                           <?php  /* <li class="<?php echo @$active=='companies'?"open":"";?>">
                                <a class="loadview" href="#companies/" ><i class="fa fa-building-o" aria-hidden="true"></i><span class="sidebar-mini-hide">Companies</span></a>
                            </li> */ ?>
                             <li class="<?php echo @$active=='hospitals'?"open":"";?>">
                                <a class="loadview" href="#hospitals/" ><i class="fa fa-building-o" aria-hidden="true"></i><span class="sidebar-mini-hide">Providers</span></a>
                            </li> 
                            <li class="<?php echo @$active=='settings'?"open":"";?>">
                                <a class="loadview" href="#settings/" ><i class="fa fa-wrench"></i><span class="sidebar-mini-hide">Settings</span></a>
                            </li>
                            <li class="<?php echo @$active=='users'?"open":"";?>">
                                <a class="loadview" href="#users/" ><i class="fa fa-users"></i><span class="sidebar-mini-hide">Users</span></a>
                            </li>
							<?php } ?>	
                        </ul>
                    </div>

                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button id="hidedesktop" type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                     
                        <!-- Layout Options (used just for demonstration) -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                       <!-- END Layout Options -->
                    </div>
                    <!-- END Left Section -->
					<!-- Right Section -->
                   <?php if($this->session->userdata('adminType') == 0){?>
				   <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-logs-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">Logs</span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-logs-dropdown">
                                <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">User Logs</h5>
                                <a class="dropdown-item loadview" href="#maillogs/">
                                    <i class="fa fa-user mr-5"></i> Email Logs
                                </a>
								<a class="dropdown-item loadview" href="#qrcodelogs/">
                                    <i class="fa fa-user mr-5"></i> Subscription Logs
                                </a>
                                <a class="dropdown-item loadview" href="#detaillogs/">
                                    <i class="fa fa-lock mr-5"></i>	Providers Logs
                                </a> 
                                <a class="dropdown-item loadview" href="#cardlogs/">
                                    <i class="fa fa-lock mr-5"></i>	Card Access Logs
                                </a>
                                <a class="dropdown-item loadview" href="#urllogs/">
                                    <i class="fa fa-lock mr-5"></i>	Web Access Logs
                                </a>
                                <a class="dropdown-item loadview" href="#twillio/">
                                    <i class="fa fa-lock mr-5"></i>	Twillio Logs
                                </a> 
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div><!-- END Right Section -->
                    <!-- Right Section -->
				   <?php } ?>
                   <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block"><?php echo getCurrentData()->Name;?></span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase"><?php echo getCurrentData()->Name;?></h5>
                                <a class="dropdown-item loadview" href="#profile">
                                    <i class="fa fa-user mr-5"></i> Profile
                                </a>
                                 <a class="dropdown-item loadview" href="#changePassword">
                                    <i class="fa fa-lock mr-5"></i>	Change Password
                                </a>
                                
                                <!-- END Side Overlay -->

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo admin_url(); ?>login/logout">
                                    <i class="fa fa-sign-out mr-5"></i> Logout
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div><!-- END Right Section -->
                
					<div class="content-header content-header-fullrow px-15">
                         <?php 
						 $imageconfig=$this->model->getDatarow("config","where isVisible=1 AND name='image'");
						 ?>
                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden"> 
                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="font-w500 loadview" href="<?php if($this->session->userdata('adminType') > 0){?>#contacts<?php }else{ ?>#home<?php }?>">
                                    <img src="<?php echo res_url();?>admin/<?php echo $imageconfig->value;?>" style="width:100px;margin-top:-15px;">
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
				</div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Header -->
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
