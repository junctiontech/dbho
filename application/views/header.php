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
<link rel="stylesheet" href="<?=base_url();?>css/datepicker.css" />
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
<!--<link rel="stylesheet" href="<?=base_url();?>css/datepicker.css" /> -->


<!--<script src="<?=base_url();?>js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>js/jquery.simple-dtpicker.js"></script>

<link type="text/css" href="<?=base_url();?>css/jquery.simple-dtpicker.css" rel="stylesheet" />-->

<link href="<?=base_url();?>css/smart_wizard.css" rel="stylesheet" type="text/css">
<!--<link type="text/css" href="<?=base_url();?>css/jquery.simple-dtpicker.css" rel="stylesheet" /> -->
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
<style type="text/css">
          
	 .loading-indicator { 
					position: fixed; 
					left: 0; 
					top: 0; 
					z-index: 999; 
					width: 100%; 
					height: 100%; 
					overflow: visible; 
					background: url('<?=base_url();?>/images/ajax-loader2.gif') no-repeat center center;
					
					}   
					.left_col {overflow:inherit !important; cursor:auto !important;}
					.sidebar-footer {display:none !important;}
					
        </style>
	<script type="text/javascript">
		var AbsoluteURL = '<?=base_url();?>';	
		$(document).ready(function(){
			loadnotification();
		});
</script>
<script type="text/javascript" src="<?=base_url();?>js/script.js"></script>
<!-- form validation -->
    <script src="<?=base_url();?>js/validator/validator.js"></script> 

<script>
/*$(document).click(function(e){
    if(!$(e.target).closest('.child_menu').length){
        $('.child_menu').slideUp();
    }
});*/
/*$('html').click(function(){
  if( $('.child_menu').is(':visible') ) {
     $('.child_menu').slideUp();
  }
});*/
</script>
</head>
<body class="nav-sm">
<div style="display: none;" id="loader" class="loading-indicator"></div>
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;"> <a href="javascript:;" class="site_title"><i><img src="<?=base_url();?>images/logo.png"/></i> <span>Homeonline</span></a> </div>
        <div class="clearfix"></div>
        
        <!-- menu prile quick info -->
       <!-- <div class="profile">
          <div class="profile_pic"> <img src="<?=base_url();?>images/img.jpg" alt="..." class="img-circle profile_img"> </div>
          <div class="profile_info"> <span>Welcome,</span>
            <h2>Anthony Fernando</h2>
          </div>
        </div>-->
        <!-- /menu prile quick info --> 
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>Navigation</h3>
            <ul class="nav side-menu">
				 <li><a><i class="fa fa-user"></i>User Plan Management<span class="fa fa-chevron-down"></span></a>
				  <ul class="nav child_menu" style="display: none">
					<li><a href="<?=base_url();?>Manage_user_plan/AddPlanType"><i class="fa fa-user"></i>Add Plan Type</a></li>
					<li><a href="<?=base_url();?>Manage_user_plan"><i class="fa fa-user"></i>Manage User Plan </a></li>
					<li><a href="<?=base_url();?>Manage_user_plan/PlanConsumptionLog"><i class="fa fa-user"></i>Plan Consumption Log</a></li>
				  </ul>
				 </li>
				 <li><a><i class="fa fa-sitemap"></i>Inventory Management<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=base_url();?>Inventory/Inventory_listing"><i class="fa fa-user"></i>Inventory Listing </a></li>
					   <li><a href="<?=base_url();?>Inventory"><i class="fa fa-user"></i>Add Inventory </a></li>
					   <li><a href="<?=base_url();?>Inventory/AddInventoryType"><i class="fa fa-user"></i>Add Inventory Type</a></li>
					   <li><a href="<?=base_url();?>Inventory/InventoryAvailability"><i class="fa fa-user"></i>Check Inventory Availiability </a></li>
					   <li><a href="<?=base_url();?>Inventory/InventoryConsumption"><i class="fa fa-user"></i>Inventory Consumption</a></li>
					   <li><a href="<?=base_url();?>Inventory/Inventorylog"><i class="fa fa-user"></i>Inventory Log</a></li>
				    </ul>
				 </li>
				 <li><a><i class="fa  fa-calendar-check-o"></i>Campaign Management<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=base_url();?>Campaign/Campaign_listing"><i class="fa fa-edit"></i>Campaign Listing</a></li>
						<li><a href="<?=base_url();?>Campaign"><i class="fa fa-edit"></i>Create Campaign </a></li>
						
					</ul>
				</li>
				
				<li><a><i class="fa fa-area-chart"></i>Property Management<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?=base_url();?>AddProperty/PropertyListing" ><i class="fa fa-edit"></i>Property Listing </a></li>
						<li><a href="<?=base_url();?>AddProperty/PropertyListing/RequestProperties" ><i class="fa fa-edit"></i>Requested Property List </a></li>
						<li><a href="<?=base_url();?>Appointment/listAppointment" ><i class="fa fa-edit"></i>Appointment Listing </a></li>
						<li><a href="<?=base_url();?>AddProperty" ><i class="fa fa-edit"></i>Add Property </a></li>
						<li><a href="<?=base_url();?>AddProperty/PropertyLog" ><i class="fa fa-edit"></i>Property Log </a></li>
						
						
					</ul>
				</li>
				
				<li><a><i class="fa fa-pie-chart"></i>Project Management<span class="fa fa-chevron-down"></span></a>
				  <ul class="nav child_menu" style="display: none">
					<li><a href="<?=base_url();?>AddProject/ProjectList"><i class="fa fa-user"></i>Project Listing </a></li>
					<li><a href="<?=base_url();?>AddProject" ><i class="fa fa-edit"></i>Add Project </a></li>
					<li><a href="<?=base_url();?>AddProject/ProjectLog" ><i class="fa fa-edit"></i>Project Log </a></li>
					
				  </ul>
				 </li>
				 
				 <li><a><i class="fa fa-users"></i>Lead Management<span class="fa fa-chevron-down"></span></a>
				  <ul class="nav child_menu" style="display: none">
					<li><a href="<?=base_url();?>Lead/Callingleadlisting" ><i class="fa fa-edit"></i>Calling Lead Listing</a></li>
					<li><a href="<?=base_url();?>Lead/Callingleadcreate"><i class="fa fa-user"></i>Calling Lead Create</a></li>
					<li><a href="<?=base_url();?>Lead/Leadmanagementlist" ><i class="fa fa-edit"></i>Lead Management Listing</a></li>
					<li><a href="<?=base_url();?>Lead/LeadLogs" ><i class="fa fa-edit"></i>Lead Log</a></li>
					<li><a href="<?=base_url();?>Lead/Enquirylist" ><i class="fa fa-edit"></i>Enquiry</a></li>
					<li><a href="<?=base_url();?>Lead/Adminlocality" ><i class="fa fa-edit"></i>Admin Locality</a></li>
				  </ul>
				 </li>
				  <li><a><i class="fa fa-user"></i>App User Management<span class="fa fa-chevron-down"></span></a>
				  <ul class="nav child_menu" style="display: none">
					<li><a href="<?=base_url();?>Addappusers/"><i class="fa fa-user"></i>User List</a></li>
					<li><a href="<?=base_url();?>Addappusers/addAppUser"><i class="fa fa-user"></i>Add App User</a></li>
				  </ul>
				 </li> 
				 <li><a><i class="fa fa-cog"></i>Portal Management<span class="fa fa-chevron-down"></span></a>
				  <ul class="nav child_menu" style="display: none">
					<li><a href="<?=base_url();?>cron/"><i class="fa fa-user"></i>Settings</a></li>
					<li><a href="<?=base_url();?>requests/"><i class="fa fa-user"></i>User Requests</a></li>
					</ul>
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
            <li class=""> <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?=base_url();?>images/img.jpg" alt="">Admin <span class=" fa fa-angle-down"></span> </a>
              <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                <li><a href="javascript:;"> Profile</a> </li>
                <li> <a href="javascript:;"> <span class="badge bg-red pull-right">50%</span> <span>Settings</span> </a> </li>
                <li> <a href="javascript:;">Help</a> </li>
                <li><a href="<?=base_url();?>Login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a> </li>
              </ul>
            </li>
			
            <li role="presentation" class="dropdown"> <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-envelope-o"></i> <span class="badge bg-red appnotification"> </span> </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown completeapplist" role="menu">
                
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->