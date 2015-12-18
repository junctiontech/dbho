<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?=base_url();?>images/favicon.ico">
<title>Homeonline</title>

<!-- Bootstrap core CSS -->

<link href="<?=base_url();?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url();?>fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?=base_url();?>css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?=base_url();?>css/custom.css" rel="stylesheet">
<link href="<?=base_url();?>css/icheck/flat/green.css" rel="stylesheet">
<!-- editor -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link href="<?=base_url();?>css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
<link href="<?=base_url();?>css/editor/index.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url();?>css/ion.rangeSlider.css" />
<!-- select2 -->
<link href="<?=base_url();?>css/select/select2.min.css" rel="stylesheet">
<!-- switchery -->
<link rel="stylesheet" href="<?=base_url();?>css/switchery/switchery.min.css" />
<script src="<?=base_url();?>js/jquery.min.js"></script>
<link rel="stylesheet" href="<?=base_url();?>css/datepicker.css" />
<link href="<?=base_url();?>css/smart_wizard.css" rel="stylesheet" type="text/css">

<link href="<?=base_url();?>css/calendar/fullcalendar.css" rel="stylesheet">
        <link href="<?=base_url();?>css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">
<!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;"> <a href="javascript:;" class="site_title"><i><img src="<?=base_url();?>images/logo.png"/></i> <span>Homeonline</span></a> </div>
        <div class="clearfix"></div>
        
        <!-- menu prile quick info -->
        <div class="profile">
          <div class="profile_pic"> <img src="<?=base_url();?>images/img.jpg" alt="..." class="img-circle profile_img"> </div>
          <div class="profile_info"> <span>Welcome,</span>
            <h2>Anthony Fernando</h2>
          </div>
        </div>
        <!-- /menu prile quick info --> 
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
				 <li><a><i class="fa fa-edit"></i> Manage Plan <span class="fa fa-chevron-down"></span></a>
				  <ul class="nav child_menu" style="display: none">
					<li><a href="<?=base_url();?>Manage_user_plan/AddPlanType"><i class="fa fa-user"></i>Add Plan Type</a></li>
					<li><a href="<?=base_url();?>Manage_user_plan"><i class="fa fa-user"></i> Manage Usar Plan </a></li>
				  </ul>
				 </li>
				 <li><a><i class="fa fa-edit"></i> Manage Inventory <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
					   <li><a href="<?=base_url();?>Inventory"><i class="fa fa-user"></i> Inventory </a></li>
					   <li><a href="<?=base_url();?>Inventory/AddInventoryType"><i class="fa fa-user"></i>Add Inventory Type</a></li>
					   <li><a href="<?=base_url();?>Inventory/Inventory_listing"><i class="fa fa-user"></i> Inventory Listing </a></li>
					   <li><a href="<?=base_url();?>Inventory/InventoryAvailability"><i class="fa fa-user"></i>Check Inventory Avialabilty </a></li>
					   <li><a href="<?=base_url();?>Inventory/InventoryConsumption"><i class="fa fa-user"></i> Inventory Consumption</a></li>
				    </ul>
				 </li>
				 <li><a><i class="fa fa-edit"></i> Manage Campaign <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=base_url();?>Campaign"><i class="fa fa-edit"></i> Creat Campaign </a></li>
						<li><a href="<?=base_url();?>Campaign/Campaign_listing"><i class="fa fa-edit"></i> Campaign Listing</a></li>
					</ul>
				</li>
				<li><a href="<?=base_url();?>AddProperty" ><i class="fa fa-edit"></i> Add Property </a>
					
				</li>
					
            </ul>
          </div>
        </div>
        <!-- /sidebar menu --> 
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small"> <a data-toggle="tooltip" data-placement="top" title="Settings"> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </a> <a data-toggle="tooltip" data-placement="top" title="FullScreen"> <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> </a> <a data-toggle="tooltip" data-placement="top" title="Lock"> <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> </a> <a href="<?=base_url();?>Login/logout" data-toggle="tooltip" data-placement="top" title="Logout"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> </a> </div>
        <!-- /menu footer buttons --> 
      </div>
    </div>
    
    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav class="" role="navigation">
          <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
          <ul class="nav navbar-nav navbar-right">
            <li class=""> <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?=base_url();?>images/img.jpg" alt="">John Doe <span class=" fa fa-angle-down"></span> </a>
              <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                <li><a href="javascript:;"> Profile</a> </li>
                <li> <a href="javascript:;"> <span class="badge bg-red pull-right">50%</span> <span>Settings</span> </a> </li>
                <li> <a href="javascript:;">Help</a> </li>
                <li><a href="<?=base_url();?>Login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a> </li>
              </ul>
            </li>
            <li role="presentation" class="dropdown"> <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-envelope-o"></i> <span class="badge bg-red">6</span> </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                <li> <a> <span class="image"> <img src="<?=base_url();?>images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li> <a> <span class="image"> <img src="<?=base_url();?>images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li> <a> <span class="image"> <img src="<?=base_url();?>images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li> <a> <span class="image"> <img src="<?=base_url();?>images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li>
                  <div class="text-center"> <a> <strong>See All Alerts</strong> <i class="fa fa-angle-right"></i> </a> </div>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->