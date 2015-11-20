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
            <h2> Anthony Fernando </h2>
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
            <h3>Creat Compaign</h3>
          </div>
          <div class="title_right">
            <div class="input-group pull-right"> 
             <div class="nav toggle paddman12"> <a id="menu_toggle2"><button class="btn btn-primary" type="button">Full Screen</button></a> </div>
             <button data-target=".bs-example-modal-lg" data-toggle="modal" type="button" class="btn btn-success taright">Export</button>
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
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Compaign</h2>
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
                      <label class="control-label" for="first-name">Compaign Start Date <span class="required">*</span> </label>
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="09/30/2015" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                    <div class="form-group col-xs-12 col-sm-3">
                      <label class="control-label" for="last-name">User Type <span class="required">*</span> </label>
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Hawaii</option>
                        </optgroup>
                      </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-3">
                      <label for="middle-name" class="control-label">Comapny name</label>
                      <input type="text" placeholder="Company" class="form-control">
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-3 martop20">
                      
                    <button type="submit" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success">Search</button>
          
                    </div>
                  </div>
                 <!-- <div class="ln_solid"></div>-->
                 
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
                <h2>Compaign table </h2>
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
                <table class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Inventory</th>
                      <th>Qty</th>
                      <th>Amount (Rs)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Home page project gallery</td>
                      <td><input type="text" placeholder="3" class="form-control"></td>
                      <td><input type="text" placeholder="10000" class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Home page Hot deals</td>
                      <td><input type="text" placeholder="4" class="form-control"></td>
                      <td><input type="text" placeholder="50000" class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Real estate project of the month</td>
                      <td><input type="text" placeholder="2" class="form-control"></td>
                      <td><input type="text" placeholder="25000" class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Real estate project Gallery</td>
                      <td><input type="text" placeholder="2" class="form-control col-xs-1"></td>
                      <td><input type="text" placeholder="50000" class="form-control col-xs-2"></td>
                    </tr>
                    <tr>
                      <td>Real estate Hot Deals</td>
                      <td><input type="text" placeholder="4" class="form-control"></td>
                      <td><input type="text" placeholder="50000" class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Real estate Button Banner</td>
                      <td><input type="text" placeholder="3" class="form-control"></td>
                      <td><input type="text" placeholder="50000" class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Real estate Sponsred Project</td>
                      <td><input type="text" placeholder="1" class="form-control"></td>
                      <td><input type="text" placeholder="50000" class="form-control"></td>
                    </tr>
                    <tr>
                      <td>Real estate Sponsred Properties</td>
                      <td><input type="text" placeholder="2" class="form-control"></td>
                      <td><input type="text" placeholder="50000" class="form-control"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="valusho pull-right"> <h5>Compaign Amount :  Rs 335090 </h5></div>
              
              <div class="x_content">
                <table class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Plan</th>
                      <th>Qty</th>
                      <th>Duration (Days)</th>
                      <th>Amount (Rs)</th>
                      <th>Carry forward (days)</th>
                      <th>Last Expiry</th>
                      <th>Current Expiry Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Platinum (Projects)</td>
                      <td><input type="text" placeholder="10" class="form-control"></td>
                      <td><input type="text" placeholder="30" class="form-control"></td>
                      <td><input type="text" placeholder="20000" class="form-control"></td>
                      <td><input type="text" placeholder="3" class="form-control"></td>
                      <td>12/17/2015</td>
                      <td>12/17/2014</td>
                    </tr>
                    <tr>
                      <td>Platinum (Projects)</td>
                      <td><input type="text" placeholder="300" class="form-control"></td>
                      <td><input type="text" placeholder="45" class="form-control"></td>
                      <td><input type="text" placeholder="15000" class="form-control"></td>
                      <td><input type="text" placeholder="2" class="form-control"></td>
                      <td>12/17/2015</td>
                      <td>12/17/2014</td>
                    </tr>
                    <tr>
                      <td>Platinum (Projects)</td>
                      <td><input type="text" placeholder="150" class="form-control"></td>
                      <td><input type="text" placeholder="40" class="form-control"></td>
                      <td><input type="text" placeholder="50000" class="form-control"></td>
                      <td><input type="text" placeholder="6" class="form-control"></td>
                      <td>12/17/2015</td>
                      <td>12/17/2014</td>
                    </tr>
                    <tr>
                      <td>Platinum (Projects)</td>
                      <td><input type="text" placeholder="200" class="form-control"></td>
                      <td><input type="text" placeholder="60" class="form-control"></td>
                      <td><input type="text" placeholder="10000" class="form-control"></td>
                      <td><input type="text" placeholder="6" class="form-control"></td>
                      <td>12/17/2015</td>
                      <td>12/17/2014</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <div class="valusho pull-left"> <button class="btn btn-info btn-lg" type="button">Create</button></div>
              <div class="valusho pull-right"> <h5> Compaign Amount :  Rs 335090 </h5></div>
              
            </div>
                  
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