<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?> - Krerum</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
        echo $this->Html->css('bootstrap.min');
    ?>
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->

    <?php
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('ionicons.min');
        echo $this->Html->css('select2.min');
        echo $this->Html->css('AdminLTE.min');
        echo $this->Html->css('_all-skins.min');
        echo $this->Html->css('bootstrap-datepicker3.min');
        echo $this->Html->css('angular-growl.min');
        echo $this->Html->css('loading-bar.min');
        echo $this->Html->css('style');

        echo $this->Html->script('jQuery/jquery-2.2.3.min');

        echo $this->Html->script('jquery-autogrow.min');

        //Angular
        echo $this->Html->script('angular.min');
        echo $this->Html->script('angular-growl.min');
        echo $this->Html->script('loading-bar.min');

        //-------------------------
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('slimScroll/jquery.slimscroll.min');
        echo $this->Html->script('fastclick/fastclick.min');

        echo $this->Html->script('select2.min');

        echo $this->Html->script('app.min');
        echo $this->Html->script('bootstrap-datepicker.min');
        echo $this->Html->script('my_func');


        //Base App
        echo $this->Html->script('app');

        //Controllers
        echo $this->Html->script('controllers/EditItemController');
        echo $this->Html->script('controllers/AddItemController');
        echo $this->Html->script('controllers/ViewMenuController');
        
    ?>
<script>
    var baseUrl = "<?php echo $this->webroot; ?>";

</script>
</head>
<body class="hold-transition skin-red-light sidebar-mini" ng-app="krerum">
<div growl></div>
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>KRM</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Krerum</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>


          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> -->
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li> -->
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li> -->
              <!-- User Account: style can be found in dropdown.less -->
              <!-- <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                    <ul class="dropdown-menu">
                       User image
                      <li class="user-header">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                          Alexander Pierce - Web Developer
                          <small>Member since Nov. 2012</small>
                        </p>
                      </li>
                      <li class="user-body">
                        <div class="row">
                          <div class="col-xs-4 text-center">
                            <a href="#">Followers</a>
                          </div>
                          <div class="col-xs-4 text-center">
                            <a href="#">Sales</a>
                          </div>
                          <div class="col-xs-4 text-center">
                            <a href="#">Friends</a>
                          </div>
                        </div>
                      </li>
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="#" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                </li> -->
                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li> -->
                    <li class="dropdown user user-menu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $this->webroot; ?>/img/no_avatar.png" class="user-image" alt="User Image">
                        <!-- <span class="hidden-xs" ng-bind="user.username"></span> -->
        								<?php echo $this->Session->read('Auth.User.username'); ?>
                      </a>
                      <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                          <img src="<?php echo $this->webroot; ?>/img/no_avatar.png" class="img-circle" alt="User Image">
                          <p>
                            <span><?php echo $this->Session->read('Auth.User.fname')." ".$this->Session->read('Auth.User.lname'); ?></span>
                          </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'change_password')); ?>" class="btn btn-default btn-flat">Change Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'logout')); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>
    </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <!-- <div class="pull-left image">
              <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div> -->
            <!-- <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div> -->
          </div>
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'index')); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>Admins</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'add')); ?>"><i class="fa fa-circle-o"></i> Add Admin</a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'view')); ?>"><i class="fa fa-circle-o"></i> View Admins</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-sitemap"></i> <span>Variants</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'variants', 'action' => 'add')); ?>"><i class="fa fa-circle-o"></i> Add Variant</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'variants', 'action' => 'view')); ?>"><i class="fa fa-circle-o"></i> View Variants</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-list-ul"></i> <span>Items</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'items', 'action' => 'add')); ?>"><i class="fa fa-circle-o"></i> Add Item</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'items', 'action' => 'view')); ?>"><i class="fa fa-circle-o"></i> View Items</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-tags"></i> <span>Item Categories</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'item_category', 'action' => 'add')); ?>"><i class="fa fa-circle-o"></i> Add Category</a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'item_category', 'action' => 'view')); ?>"><i class="fa fa-circle-o"></i> View Categories</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview">
				<a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'orders', 'action' => 'index')); ?>"><i class="fa fa-circle-o"></i> Pending Dispatch</a>
					</li>

					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'orders', 'action' => 'completed')); ?>"><i class="fa fa-circle-o"></i> Completed + Dispatched </a>
					</li>

					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'orders', 'action' => 'incomplete')); ?>"><i class="fa fa-circle-o"></i> Payment Incomplete</a>
					</li>

					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'orders', 'action' => 'cancel')); ?>"><i class="fa fa-circle-o"></i> Cancelled</a>
					</li>

                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-university"></i> <span>Sellers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'sellers', 'action' => 'add')); ?>"><i class="fa fa-circle-o"></i> Add Seller</a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'sellers', 'action' => 'view')); ?>"><i class="fa fa-circle-o"></i> View Sellers</a></li>
                </ul>
            </li>
            <!-- <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
            <!-- <li class="header">LABELS</li> -->
            <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li> -->
            <!-- <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li> -->
            <!-- <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <?php
            echo $this->Session->flash('error');
            echo $this->Session->flash('success');
            echo $this->Session->flash('notice');
        ?>
        <?php echo $this -> fetch('main-content'); ?>

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- <script>
        $(document).ready(function() {
            $('select').select2();
        });
      </script> -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> <a href="#">Krerum</a>.</strong> All rights
        reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript:void(0)">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <i class="menu-icon fa fa-user bg-yellow"></i>

                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>

                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript:void(0)">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>

                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>

                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>

                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>

                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul>
            <!-- /.control-sidebar-menu -->

          </div>
          <!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
          <!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>

                <p>
                  Some information about this general settings option
                </p>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>

                <p>
                  Other sets of options are available
                </p>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>

                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div>
              <!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div>
              <!-- /.form-group -->
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
      </aside>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <?php
        // echo $this->Html->script('jQuery/jquery-2.2.3.min');
        // echo $this->Html->script('bootstrap.min');
        // echo $this->Html->script('slimScroll/jquery.slimscroll.min');
        // echo $this->Html->script('fastclick/fastclick.min');
        // echo $this->Html->script('app.min');
        // echo $this->Html->script('bootstrap-datepicker.min');
        //
    ?>
    <!-- jQuery 2.2.3 -->
    <!-- <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script> -->
    <!-- Bootstrap 3.3.6 -->
    <!-- <script src="../../bootstrap/js/bootstrap.min.js"></script> -->
    <!-- SlimScroll -->
    <!-- <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script> -->
    <!-- FastClick -->
    <!-- <script src="../../plugins/fastclick/fastclick.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="../../dist/js/app.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js"></script> -->
    </body>
    </html>
