<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico">
<title>Homeonline</title>

<!-- Bootstrap core CSS -->

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="css/custom.css" rel="stylesheet">
<link href="css/icheck/flat/green.css" rel="stylesheet">
<!-- editor -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link href="css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
<link href="css/editor/index.css" rel="stylesheet">
<link rel="stylesheet" href="css/ion.rangeSlider.css" />
<!-- select2 -->
<link href="css/select/select2.min.css" rel="stylesheet">
<!-- switchery -->
<link rel="stylesheet" href="css/switchery/switchery.min.css" />
<script src="js/jquery.min.js"></script>

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
        <div class="navbar nav_title" style="border: 0;"> <a href="index.html" class="site_title"><i><img src="images/logo.png"/></i> <span>Homeonline</span></a> </div>
        <div class="clearfix"></div>
        
        <!-- menu prile quick info -->
        <div class="profile">
          <div class="profile_pic"> <img src="images/img.jpg" alt="..." class="img-circle profile_img"> </div>
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
              <li><a href="<?=base_url();?>"><i class="fa fa-user"></i> Manage Usar Plan </a></li>
               <li><a href="<?=base_url();?>Inventory"><i class="fa fa-user"></i> Inventory </a></li>
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
            <li class=""> <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="images/img.jpg" alt="">John Doe <span class=" fa fa-angle-down"></span> </a>
              <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                <li><a href="javascript:;"> Profile</a> </li>
                <li> <a href="javascript:;"> <span class="badge bg-red pull-right">50%</span> <span>Settings</span> </a> </li>
                <li> <a href="javascript:;">Help</a> </li>
                <li><a href="javascript:;"><i class="fa fa-sign-out pull-right"></i> Log Out</a> </li>
              </ul>
            </li>
            <li role="presentation" class="dropdown"> <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-envelope-o"></i> <span class="badge bg-red">6</span> </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                <li> <a> <span class="image"> <img src="images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li> <a> <span class="image"> <img src="images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li> <a> <span class="image"> <img src="images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
                <li> <a> <span class="image"> <img src="images/img.jpg" alt="Profile Image" /> </span> <span> <span>John Smith</span> <span class="time">3 mins ago</span> </span> <span class="message"> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>
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
            <h3>inventory</h3>
          </div>
          <div class="title_right">
            <div class="input-group pull-right"> 
             <div class="nav toggle paddman12"> <a id="menu_toggle2"><button class="btn btn-primary" type="button">Full Screen</button></a> </div>
            </div>
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
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
		  <!-- Alert section For Message-->
		 <?php  if($this->session->flashdata('message_type')=='success') { ?>
		  <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('message')?></strong>  </div>
		 <?php } if($this->session->flashdata('message_type')=='error') { ?>
		 <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('message')?></strong>  </div>
		 <?php } ?>
		 <!-- Alert section End-->
           <form class="form-horizontal form-label-left" action="<?=base_url();?>Inventory/Add_inventory" method="post" enctype="multipart/form-data">
           <input type="hidden" name="inventory_id" value="" />
           <div class="form-group">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="radio mabott10">
                        <label>
                          <input type="radio" class="flat" checked name="type" value="Free">
                          Free </label>
                          <label>
                          <input type="radio" class="flat" name="type" value="Campaign">
                          Compaign </label>
                      </div>     
             </div>         
           
           </div>
           
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Campaign Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12">Sobha 16-09-2015 20:30:30</label>
                    </div>
                </div>
				  
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Company Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control" name="user_id">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="">Select Company Name</option>
						<?php foreach($company_name as $company_name){?>
                        <option value="<?=isset($company_name->userID)?$company_name->userID:''?>"><?=isset($company_name->userCompanyName)?$company_name->userCompanyName:''?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                    </div>
                  </div>
		   
				 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="text" name="inventory_des" value="" class="form-control" />
                    </div>
                </div>
                  
                  
                  
                  
           
           <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">City</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control" name="city_id">
                        <optgroup label="Alaskan/Hawaiian Time Zone" >
                        <option value="">Select City</option>
                       <?php foreach($cities as $cities){?>
                        <option value="<?=isset($cities->cityID)?$cities->cityID:''?>"><?=isset($cities->cityName)?$cities->cityName:''?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                    </div>
                  </div>
           
           
           <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control" name="project_id">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="">Select Project</option>
                         <?php foreach($projects as $projects){?>
                        <option value="<?=isset($projects->projectID)?$projects->projectID:''?>"><?=isset($projects->projectName)?$projects->projectName:''?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                    </div>
                  </div>
           
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner Image</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <label class="btn btn-default btn-upload" for="inputImage" title="Upload image file">
                                        <input class="sr-only" id="inputImage" name="file" type="file" accept="image/*">
                                        
                                          <span class="brous-bt">Brouse</span>
                                       
                                      </label>
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Start Date</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input type="text" name="start_date" class="form-control has-feedback-left"  id="single_cal2" placeholder="09/30/2015" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Duration</label>
                    <div class="col-md-10 col-sm-10 col-xs-12 contxt">
                     <input type="text" placeholder="4" class="form-control" name="duration">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Weightage</label>
                    <div class="col-md-10 col-sm-10 col-xs-12 contxt">
                     <input type="text" placeholder="40" class="form-control" name="weightage">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Remark</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                     <textarea id="message" required="required" class="form-control" name="remark" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                     <button class="btn btn-success btn-lg" type="submit" value="submit" name="submit">Save</button>
                    </div>
                  </div>
                  
                  
                  
                 </form>
          
          </div>
          </div>
      </div>
      <!-- /page content --> 
      
      <!-- footer content -->
      <footer>
        <div class="">
          <p class="pull-right">Copyright <a>Homeonline</a>. | <span class="lead"> <i><img src="images/logo-f.png"/></i> Homeonline</span> </p>
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
<script src="js/bootstrap.min.js"></script> 

<!-- chart js --> 
<script src="js/chartjs/chart.min.js"></script> 
<!-- bootstrap progress js --> 
<script src="js/progressbar/bootstrap-progressbar.min.js"></script> 
<script src="js/nicescroll/jquery.nicescroll.min.js"></script> 
<!-- icheck --> 
<script src="js/icheck/icheck.min.js"></script> 
<!-- tags --> 
<script src="js/tags/jquery.tagsinput.min.js"></script> 
<!-- switchery --> 
<script src="js/switchery/switchery.min.js"></script> 
<!-- daterangepicker --> 
<script type="text/javascript" src="js/moment.min2.js"></script> 
<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script> 
<!-- richtext editor --> 
<script src="js/editor/bootstrap-wysiwyg.js"></script> 
<script src="js/editor/external/jquery.hotkeys.js"></script> 
<script src="js/editor/external/google-code-prettify/prettify.js"></script> 
<!-- select2 --> 
<script src="js/select/select2.full.js"></script> 
<!-- form validation --> 
<script type="text/javascript" src="js/parsley/parsley.min.js"></script> 
<!-- textarea resize --> 
<script src="js/textarea/autosize.min.js"></script> 
<!-- Datatables --> 
<script src="js/datatables/js/jquery.dataTables.js"></script> 
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> 

<!-- bootstrap progress js --> 
<script src="js/progressbar/bootstrap-progressbar.min.js"></script> 
<script src="js/nicescroll/jquery.nicescroll.min.js"></script> 
<script>
            autosize($('.resizable_textarea'));
        </script> 
<!-- Autocomplete --> 
<script type="text/javascript" src="js/autocomplete/countries.js"></script> 
<script src="js/autocomplete/jquery.autocomplete.js"></script> 
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
<script src="js/custom.js"></script> 

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