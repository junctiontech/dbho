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
        <div class="navbar nav_title" style="border: 0;"> <a href="index.html" class="site_title"><i><img src="<?=base_url();?>images/logo.png"/></i> <span>Homeonline</span></a> </div>
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
				<li><a href="<?=base_url();?>Manage_user_plan/AddPlanType"><i class="fa fa-user"></i>Add Plan Type</a></li>
              <li><a href="<?=base_url();?>"><i class="fa fa-user"></i> Manage Usar Plan </a></li>
               <li><a href="<?=base_url();?>Inventory"><i class="fa fa-user"></i> Inventory </a></li>
			   <li><a href="<?=base_url();?>Inventory/AddInventoryType"><i class="fa fa-user"></i>Add Inventory Type</a></li>
			   <li><a href="<?=base_url();?>Inventory/Inventory_listing"><i class="fa fa-user"></i> Inventory Listing </a></li>
               <li><a href="<?=base_url();?>Campaign"><i class="fa fa-edit"></i> Creat Campaign </a></li>
			    <li><a href="<?=base_url();?>Campaign/Campaign_listing"><i class="fa fa-edit"></i> Campaign Listing</a></li>
            </ul>
          </div>
        </div>
        <!-- /sidebar menu --> 
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small"> <a data-toggle="tooltip" data-placement="top" title="Settings"> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </a> <a data-toggle="tooltip" data-placement="top" title="FullScreen"> <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> </a> <a data-toggle="tooltip" data-placement="top" title="Lock"> <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> </a> <a data-toggle="tooltip" data-placement="top" title="Logout"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> </a> </div>
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
                <li><a href="javascript:;"><i class="fa fa-sign-out pull-right"></i> Log Out</a> </li>
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
    
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Inventory Listing</h3>
          </div>
          
        </div>
        <div class="clearfix"></div>
        <script type="text/javascript">
                        $(document).ready(function () {
                            $('#calender01').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>
        

        <div class="ln_solid"></div>
		<!-- Alert section For Message-->
		 <?php  if($this->session->flashdata('message_type')=='success') { ?>
		  <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('message')?></strong>  </div>
		 <?php } if($this->session->flashdata('message_type')=='error') { ?>
		 <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('message')?></strong>  </div>
		 <?php } if($this->session->flashdata('category_error')) { ?>
<div class="row" >
<div class="alert alert-danger" >
<strong><?=$this->session->flashdata('category_error')?></strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
</div>
</div>
<?php }?>
		 <!-- Alert section End-->
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Inventory Search</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a> </li>
                      <li><a href="#">Settings 2</a> </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form id="demo-form2" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Inventory Name <span class="required">*</span> </label>
                    <input type="text" id="first-name" required="required" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">Campaign Type <span class="required">*</span> </label>
                    <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Hawaii</option>
                        </optgroup>
                      </select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Status</label>
                    <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Hawaii</option>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Company Name</label>
                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Email ID</label>
                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Weightage</label>
                    <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Hawaii</option>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">City</label>
                    <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Hawaii</option>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3 martop20">
                  <button type="submit" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
                   
                  </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Inventory table </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li class="dropdown"> <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-wrench"></i></a>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="#">Settings 1</a> </li>
                      <li><a href="#">Settings 2</a> </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content table-responsive">
                <table class=" table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Campaign Name </th>
                      <th>Company Name</th>
                      <th>Email ID </th>
                      <th>Mobile No</th>
                      <th>IN</th>
                      <th>City</th>
                      <th>Project Name</th>
                      <th>Start Date</th>
                      <th>Duration</th>
                      <th>End Date</th>
                      <th>WGT</th>
                      <th></th>
					   <th>View</th>
                     
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($inventory_list as $inventory_list){?>
                    <tr>
                      <td><?php if(!empty($inventory_list->CampaignID)){ $campaign_name=$this->utilities->get_campaign_name($inventory_list->CampaignID); echo $inventory_list->userCompanyName; echo $campaign_name[0]->created;}?></td>
                      <td><?=isset($inventory_list->userCompanyName)?$inventory_list->userCompanyName:''?></td>
                      <td><?=isset($inventory_list->userEmail)?$inventory_list->userEmail:''?></td>
                      <td><?=isset($inventory_list->userPhone)?$inventory_list->userPhone:''?></td>
                      <td><?=isset($inventory_list->inventoryDescription)?$inventory_list->inventoryDescription:''?></td>
                      <td><?=isset($inventory_list->cityName)?$inventory_list->cityName:''?></td>
                      <td><?=isset($inventory_list->projectName)?$inventory_list->projectName:''?></td>
                      <td><?=isset($inventory_list->StartDate)?$inventory_list->StartDate:''?></td>
                       <td><?=isset($inventory_list->Duration)?$inventory_list->Duration:''?></td>
                       <td><?php if(!empty($inventory_list->StartDate) || !empty($inventory_list->Duration)){ $date=explode("/",$inventory_list->StartDate);$enddate=$date[1]+$inventory_list->Duration-1; $newendate="$date[0]/$enddate/$date[2]"; echo $newendate; }?></td>
                       <td><?=isset($inventory_list->Weightage)?$inventory_list->Weightage:''?></td>
                       <td>
                       <a class="btn btn-app paddpsush">
                       <i class="fa fa-pause"></i></a>
                       </td>
					   <td><a href="<?=base_url();?>Inventory/index/<?=isset($inventory_list->planinventoryconsumptionID)?$inventory_list->planinventoryconsumptionID:''?>" class="btn btn-app paddpsush"> <i class="fa fa-edit"></i></a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
              </div>
              
             <!-- <div class="valusho pull-left"> <h5>Compaign Amount :  Rs 335090 </h5></div>
              <div class="valusho pull-right"> <button class="btn btn-info btn-lg" type="button">Create</button></div>-->
            </div>
                  
          </div>
          
    
        </div>
      </div>
      <!-- /page content --> 
      
      <!-- footer content -->
      <footer>
        <div class="">
          <p class="pull-right">Copyright <a>Homeonline</a>. | <span class="lead"> <i><img src="<?=base_url();?>images/logo-f.png"/></i> Homeonline</span> </p>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content --> 
    </div>
  </div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
  <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
  </ul>
  <div class="clearfix"></div>
  <div id="notif-group" class="tabbed_notifications"></div>
</div>
<script src="<?=base_url();?>js/bootstrap.min.js"></script> 

<!-- chart js --> 
<script src="<?=base_url();?>js/chartjs/chart.min.js"></script> 
<!-- bootstrap progress js --> 
<script src="<?=base_url();?>js/progressbar/bootstrap-progressbar.min.js"></script> 
<script src="<?=base_url();?>js/nicescroll/jquery.nicescroll.min.js"></script> 
<!-- icheck --> 
<script src="<?=base_url();?>js/icheck/icheck.min.js"></script> 
<!-- tags --> 
<script src="<?=base_url();?>js/tags/jquery.tagsinput.min.js"></script> 
<!-- switchery --> 
<script src="<?=base_url();?>js/switchery/switchery.min.js"></script> 
<!-- daterangepicker --> 
<script type="text/javascript" src="<?=base_url();?>js/moment.min2.js"></script> 
<script type="text/javascript" src="<?=base_url();?>js/datepicker/daterangepicker.js"></script> 
<!-- richtext editor --> 
<script src="<?=base_url();?>js/editor/bootstrap-wysiwyg.js"></script> 
<script src="<?=base_url();?>js/editor/external/jquery.hotkeys.js"></script> 
<script src="<?=base_url();?>js/editor/external/google-code-prettify/prettify.js"></script> 
<!-- select2 --> 
<script src="<?=base_url();?>js/select/select2.full.js"></script> 
<!-- form validation --> 
<script type="text/javascript" src="<?=base_url();?>js/parsley/parsley.min.js"></script> 
<!-- textarea resize --> 
<script src="<?=base_url();?>js/textarea/autosize.min.js"></script> 
<!-- Datatables --> 
<script src="<?=base_url();?>js/datatables/js/jquery.dataTables.js"></script> 
<script src="<?=base_url();?>js/datatables/tools/js/dataTables.tableTools.js"></script> 

<!-- bootstrap progress js --> 
<script src="<?=base_url();?>js/progressbar/bootstrap-progressbar.min.js"></script> 
<script src="<?=base_url();?>js/nicescroll/jquery.nicescroll.min.js"></script> 
<script>
            autosize($('.resizable_textarea'));
        </script> 
<!-- Autocomplete --> 
<script type="text/javascript" src="<?=base_url();?>js/autocomplete/countries.js"></script> 
<script src="<?=base_url();?>js/autocomplete/jquery.autocomplete.js"></script> 
<script type="text/javascript">
            $(function () {
                'use strict';
                var countriesArray = $.map(countries, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // Initialize autocomplete with custom appendTo:
                $('#autocomplete-custom-append').autocomplete({
                    lookup: countriesArray,
                    appendTo: '#autocomplete-container'
                });
            });
        </script> 
<script src="<?=base_url();?>js/custom.js"></script> 

<!-- select2 --> 
<script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a state",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
            });
        </script> 
<!-- /select2 --> 
<!-- input tags --> 
<script>
            function onAddTag(tag) {
                alert("Added a tag: " + tag);
            }

            function onRemoveTag(tag) {
                alert("Removed a tag: " + tag);
            }

            function onChangeTag(input, tag) {
                alert("Changed a tag: " + tag);
            }

            $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
            });
        </script> 
<!-- /input tags --> 
<!-- form validation --> 
<script type="text/javascript">
            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form .btn').on('click', function () {
                    $('#demo-form').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });

            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form2 .btn').on('click', function () {
                    $('#demo-form2').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
        </script> 
<!-- /form validation --> 
<!-- editor --> 
<script>
            $(document).ready(function () {
                $('.xcxc').click(function () {
                    $('#descr').val($('#editor').html());
                });
            });

            $(function () {
                function initToolbarBootstrapBindings() {
                    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                    $.each(fonts, function (idx, fontName) {
                        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                    });
                    $('a[title]').tooltip({
                        container: 'body'
                    });
                    $('.dropdown-menu input').click(function () {
                            return false;
                        })
                        .change(function () {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function () {
                            this.value = '';
                            $(this).change();
                        });

                    $('[data-role=magic-overlay]').each(function () {
                        var overlay = $(this),
                            target = $(overlay.data('target'));
                        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                    });
                    if ("onwebkitspeechchange" in document.createElement("input")) {
                        var editorOffset = $('#editor').offset();
                        $('#voiceBtn').css('position', 'absolute').offset({
                            top: editorOffset.top,
                            left: editorOffset.left + $('#editor').innerWidth() - 35
                        });
                    } else {
                        $('#voiceBtn').hide();
                    }
                };

                function showErrorAlert(reason, detail) {
                    var msg = '';
                    if (reason === 'unsupported-file-type') {
                        msg = "Unsupported format " + detail;
                    } else {
                        console.log("error uploading file", reason, detail);
                    }
                    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                };
                initToolbarBootstrapBindings();
                $('#editor').wysiwyg({
                    fileUploadError: showErrorAlert
                });
                window.prettyPrint && prettyPrint();
            });
        </script> 
<script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script> 
<script type="text/javascript">
        $(document).ready(function () {
            
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
             
        });
    </script> 
<!-- /editor -->
</body>
</html>