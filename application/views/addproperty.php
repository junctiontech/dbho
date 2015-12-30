<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Property</h3>
          </div>
          <div class="title_right">
            <div class="col-md-6 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group"> </div>
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
        
        <!-- <div class="ln_solid"></div>-->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel"> 
              <!--<div class="reffresh-button"><a href="#" class="fa fa-refresh"> </a></div>-->
              <div id="wizard" class="swMain">
                <ul>
                  <li><a href="#step-1">
                    <label class="stepNumber">1</label>
                    <span class="stepDesc"> Step 1<br />
                    <small>Basic Information</small> </span> </a></li>
                  <li><a href="#step-2">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc"> Step 2<br />
                    <small>Gallery & SEO</small> </span> </a></li>
                  <li><a href="#step-3">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc"> Step 3<br />
                    <small>Detailed Information</small> </span> </a></li>
                  <li><a href="#step-4">
                    <label class="stepNumber">4</label>
                    <span class="stepDesc"> Step 4<br />
                    <small>preview </small> </span> </a></li>
                </ul>
                <div id="step-1">
                  <h2 class="StepTitle">Basic Information</h2>
                  <div class="x_content">
                    <form id="form-1" method="post" class="form-group form-label-left clearfix">
					<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form1_id"/>
                      <div class="row">
                        <div class="form-group clearfix">
                          <div class="form-group col-xs-12 col-sm-3" style="padding-top:8px;">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default <?php if(!empty($purpose)){if($purpose=="sell"){echo" active";}}?>" id="checksell">
                                <input type="radio" <?php if(!empty($purpose)){if($purpose=="sell"){echo"checked";}}?> name="propertyPurpose" value="Sell" id="sell" onchange="generatenameproperty();">
                                Sell </label>
                              <label class="btn btn-default <?php if(!empty($purpose)){if($purpose=="Rent"){echo" active";}}?>" id="checkrent">
                                <input type="radio" <?php if(!empty($purpose)){if($purpose=="Rent"){echo"checked";}}?> name="propertyPurpose" value="Rent" id="rent" onchange="generatenameproperty();">
                                Rent </label>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-5" style="padding-top:8px;">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default <?php if(!empty($under)){if($under==2){echo" active";}}?>" id="unit_individual">
                                <input type="radio" name="type" <?php if(!empty($under)){if($under==2){echo" checked";}}?> value="Unit" id="type_individual">
                                Individual Property </label>
                              <label class="btn btn-default <?php if(!empty($under)){if($under==1){echo" active";}}?>" id="unit_project">
                                <input type="radio" name="type" <?php if(!empty($under)){if($under==1){echo" checked";}}?> value="Property" id="type_project">
                                Property Under Project </label>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-4" style="padding-top:8px;"> <span id="unit1">
                            <select name="projectID" class="form-control select2_group project-uni" id="projectid" onchange="generatenameproperty();">
                              <option value="" class="em">Select Project</option>
                              <?php foreach($projects as $projects){?>
                        <option value="<?=isset($projects->projectID)?$projects->projectID:''?>" <?php if(!empty($projectid)){ if($projectid==$projects->projectID){ echo"selected";} } ?>><?=isset($projects->projectName)?$projects->projectName:''?></option>
						<?php } ?>
                            </select>
                            <style>
					   .parsley-errors-list {display:none;}
					   </style>
                            </span> </div>
                          <script type="text/javascript">
					$(function() {
						// disable all the input boxes
						$(".project-uni").attr("disabled", true);
				
						// add handler to re-enable input boxes on click
						$("#unit_project").click(function() {
							$(".project-uni").removeAttr("disabled");
						});
						// add handler to re-disable input boxes on click
						$("#unit_individual").click(function() {
						$("#projectid").find("option:selected").prop("selected", false)
						$(".project-uni").attr("disabled", true);
						generatenameproperty();
						});
						
					});
				</script> 
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Property Type <span class="required">*</span> </label>
                          <select name="propertyTypeID" class="  form-control" id="propertytype" onchange="generatenameproperty();">
                            <option value="">Select</option>
                            <optgroup label="Residential Properties">
                           <?php foreach($propertytype as $propertytypes){?>
                        <option value="<?=isset($propertytypes->propertyTypeID)?$propertytypes->propertyTypeID:''?>" <?php if(!empty($propertytypeid)){ if($propertytypeid==$propertytypes->propertyTypeID){ echo"selected";} } ?>><?=isset($propertytypes->propertyTypeName)?$propertytypes->propertyTypeName:''?></option>
						<?php } ?>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Property Name <span class="required">*</span> </label>
                          <input name="propertyName" type="text" value="<?=isset($propertyname)?$propertyname:''?>" id="propertyname" readonly required="required" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                          <label style="display:block;" class="control-label">User Type</label>
                          <select id="usertypeid" class=" form-control" name="usertype" >
							<option value="">Select User Type</option>
							<?php foreach($user_type as $user_type){?>
							<option value="<?=$user_type->userTypeID?>" <?php if(!empty($usertypeid)){ if($usertypeid==$user_type->userTypeID){ echo"selected";} } ?>><?=$user_type->userTypeName?></option>
							<?php } ?>
							
						  </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                          <label for="middle-name" class="control-label showuserlabel" ><?=isset($usertype)?$usertype:''?></label>
                          <select name="userID" class=" select2_group form-control" id="showuserlabel" >
                            <option value="">Please Select Usertype First</option>
							<?php if(!empty($userID)){?>
                            <option value="<?=isset($userID)?$userID:''?>" selected><?=isset($useremail)?$useremail:''?></option>
							<?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 ">
                          <label for="middle-name" class="control-label">User Plan</label>
						 
                          <select name="planid" class=" select2_group form-control" id="userplan">
                            <option value="">Select</option>
                           </optgroup>
                          </select>
						  
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">
                          <label class="control-label">Description</label>
                          <div id="alerts"></div>
                          <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                            <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa icon-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              </ul>
                            </div>
                            <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li><a data-edit="fontSize 5">
                                  <p style="font-size:17px">Huge</p>
                                  </a> </li>
                                <li><a data-edit="fontSize 3">
                                  <p style="font-size:14px">Normal</p>
                                  </a> </li>
                                <li><a data-edit="fontSize 1">
                                  <p style="font-size:11px">Small</p>
                                  </a> </li>
                              </ul>
                            </div>
                            <div class="btn-group"> <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a> <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a> <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a> <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a> </div>
                            <div class="btn-group"> <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a> <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a> <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a> <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a> </div>
                            <div class="btn-group"> <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a> <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a> <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a> <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a> </div>
                            <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
                              <div class="dropdown-menu input-append">
                                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                <button class="btn" type="button">Add</button>
                              </div>
                              <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a> </div>
                            <div class="btn-group"> <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
                              <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                            </div>
                            <div class="btn-group"> <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a> <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a> </div>
                          </div>
                          <div id="editor"><?=isset($propertyDescription)?$propertyDescription:''?> </div>
                          <textarea name="propertyDescription" id="descr" style="display:none;"><?=isset($propertyDescription)?$propertyDescription:''?></textarea>
                          <br />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12"> </div>
                      </div>
                      <div class="row">
                        <div class="x_content"> 
                          
                          <!-- start accordion -->
                          <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                            <div id="showattributes">
							</div>
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne12" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne12" aria-expanded="false" aria-controls="collapseOne12">
                              <h4 class="panel-title StepTitle">Area</h4>
                              </a>
                              <div id="collapseOne12" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15" style="text-align:right">Covered Area</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input id="coveredarea" placeholder="Covered Area" class="form-control" onchange="generatenameproperty();" type="text" name="text-94">
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select id="coveredareasize" class="select2_group form-control" onchange="generatenameproperty();" name="coveredarea">
                                          <optgroup label="Select">
                                          <option value="Sq-ft">Sq-ft</option>
                                          <option value="Sq-yrd">Sq-yrd</option>
                                          <option value="Sq-m">Sq-m</option>
                                          <option value="Acre">Acre</option>
                                          <option value="Bigha">Bigha</option>
                                          <option value="Hectare">Hectare</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15" style="text-align:right">Plot Area</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input id="middle-name" placeholder="Plot Area" class="form-control" type="text" name="text-2">
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control" name="plotarea">
                                          <optgroup label="Select">
                                          <option value="Sq-ft">Sq-ft</option>
                                          <option value="Sq-yrd">Sq-yrd</option>
                                          <option value="Sq-m">Sq-m</option>
                                          <option value="Acre">Acre</option>
                                          <option value="Bigha">Bigha</option>
                                          <option value="Hectare">Hectare</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15" style="text-align:right">Carpet Area</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input id="middle-name" placeholder="Carpet Area" class="form-control" type="text" name="text-67">
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control" name="carpetarea">
                                          <optgroup label="Select">
                                          <option value="Sq-ft">Sq-ft</option>
                                          <option value="Sq-yrd">Sq-yrd</option>
                                          <option value="Sq-m">Sq-m</option>
                                          <option value="Acre">Acre</option>
                                          <option value="Bigha">Bigha</option>
                                          <option value="Hectare">Hectare</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne13" data-toggle="collapse" data-parent="#accordion13" href="#collapseOne13" aria-expanded="false" aria-controls="collapseOne13">
                              <h4 class="panel-title StepTitle">Price & Other Charges </h4>
                              </a>
                              <div id="collapseOne13" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15 expectedpricesellrent">Expected Price <i class="fa fa-rupee text-right"></i></label>
                                      
                                      
                                      <div class="col-md-8 col-sm-8 col-xs-12 "> 
                                        <input id="expectedprice" class="form-control pull-left" placeholder="Enter Total Price" value="<?=isset($propertyprice)?$propertyprice:''?>" type="text" name="propertyPrice" onchange="calculatepersqreft()">
                                      </div>
                                    </div>
                                    <div class="form-group clearfix disablesell">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Price per Sq-ft <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input readonly id="pricepersqrft" class="form-control" type="text" name="pricepersqft" value="">
                                      </div>
                                    </div>
									
									
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15 price_as"><i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="radio mabott10">
                                          <label>
                                            <input type="radio" class="flat"  name="showpriceas">
                                            <span class="showpriceas"></span> Lac </label>
                                          <label>
                                            <input type="radio" class="flat" name="showpriceas">
                                            <span class="showpriceas"></span> Lac Negotiable </label>
                                          <label>
                                            <input type="radio" class="flat" name="showpriceas">
                                            Call For Price </label>
                                        </div>
                                      </div>
                                    </div>
									<div class="form-group clearfix disablerent" style="display:none">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Security Deposit <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                       
                                        <select name="securitydeposite" class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">No Security Deposit</option>
                                          <option value="1">1 Month</option>
                                          <option value="2">2 Months</option>
                                          <option value="3">6 Months</option>
										  <option value="3">10 Months</option>
                                          <option value="4">Others</option>
                                          </optgroup>
                                        </select>
                                      
                                      </div>
                                    </div>
									
                                    <div class="form-group clearfix disablesell">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Price Includes </label>
                                      <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="checkbox cklabl">
                                          <label>
                                            <input type="checkbox" name="" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                                            PLC </label>
                                          <label>
                                            <input type="checkbox" name="" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                                            Car Parking </label>
                                          <label>
                                            <input type="checkbox" name="" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                                            Club Membership </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix disablesell">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Booking/Token Amount <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input id="middle-name" class="form-control" placeholder="Booking/Token Amount" type="text" name="">
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Maintenance Charges <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input id="middle-name" class="form-control" placeholder="Maintenance Charges" type="text" name="">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">Monthly</option>
                                          <option value="1">Quarterly</option>
                                          <option value="2">Yearly</option>
                                          <option value="3">One-Time</option>
                                          <option value="4">Per sq. Unit Monthly</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
									<div class="form-group clearfix disablerentbro" style="display:none">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Brokerage <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                       
                                        <select name="brokerage" class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">15 Days</option>
                                          <option value="1">30 Days</option>
                                          <option value="2">45 Days</option>
                                          <option value="3">60 Days</option>
										  
                                          </optgroup>
                                        </select>
                                      
                                      </div>
                                    </div>
                                    <div class="form-group clearfix disablesell">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Other Charges <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input id="middle-name" class="form-control" placeholder="Other Charges" type="text" name="">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12"> </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne14" data-toggle="collapse" data-parent="#accordion14" href="#collapseOne14" aria-expanded="false" aria-controls="collapseOne14">
                              <h4 class="panel-title StepTitle">Transaction Type, Property Availability </h4>
                              </a>
                              <div id="collapseOne14" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="form-group clearfix disablesell">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop20">Transaction Type</label>
                                      <div class="col-md-10 col-sm-10 col-xs-12 martop15">
                                        <div class="radio mabott10">
                                          <label>
                                            <input type="radio" class="flat" checked name="">
                                            New Property </label>
                                          <label>
                                            <input type="radio" class="flat" name="">
                                            Resale </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix disablesell">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Possession Status</label>
                                      <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="radio mabott10">
                                          <label >
                                            <input type="radio"  id="underconstruction" name="possessionstatus">
                                            Under Construction </label>
                                          <label >
                                            <input type="radio"  id="readytomove"  name="possessionstatus">
                                            Ready To Move </label>
                                        </div>
                                      </div>
                                    </div>
									
									<div class="form-group clearfix disablerent" style="display:none">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Available From</label>
                                      <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="radio mabott10">
                                          <label >
                                            <input type="radio"  id="selectdate" name="availablefromrent">
                                            Select Date </label>
                                          <label >
                                            <input type="radio"  id="immediately"  name="availablefromrent">
                                            Immediately </label>
                                        </div>
                                      </div>
                                    </div>
									
									<div class="form-group clearfix dateshow" style="display:none">
											<label class="control-label col-md-2 col-sm-2 col-xs-12 martop10" for="last-name">Date</label>
									<div class="col-md-8 col-sm-8 col-xs-12 xdisplay_inputx form-group has-feedback">
									<input type="text" name="Date" class="form-control has-feedback-left"  id="single_cal2"  placeholder="Select Date" aria-describedby="inputSuccess2Status2"  readonly >
									<span class="fa fa-calendar-o form-control-feedback left" style="left:5px;" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> 
									</div>
									</div>
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
									
                                    <div class="form-group clearfix available" style="display:none">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Available From</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="-1">Month</option>
                                          <option value="1">January</option>
                                          <option value="2">February</option>
                                          <option value="3">March</option>
                                          <option value="4">April</option>
                                          <option value="5">May</option>
                                          <option value="6">June</option>
                                          <option value="7">July</option>
                                          <option value="8">August</option>
                                          <option value="9">September</option>
                                          <option value="10">October</option>
                                          <option value="11">November</option>
                                          <option selected="selected" value="12">December</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option selected="selected" value="2015">Year</option>
                                          <option value="2014">2014</option>
                                          <option >2015</option>
                                          <option value="2016">2016</option
                                          >
                                          <option value="2017">2017</option>
                                          <option value="2018">2018</option>
                                          <option value="2019">2019</option>
                                          <option value="2020">2020</option>
                                          <option value="2021">2021</option>
                                          <option value="2022">2022</option>
                                          <option value="2023">2023</option>
                                          <option value="2024">2024</option>
                                          <option value="2025">2025</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix ageofconstruction" style="display:none">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Age of Construction</label>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control">
                                          <option value="">Age of Construction</option>
                                          <option value="11651">New Construction</option>
                                          <option value="11652">Less than 5 years</option>
                                          <option value="11653">5 to 10 years</option>
                                          <option value="11654">10 to 15 years</option>
                                          <option value="11655">15 to 20 years</option>
                                          <option value="11656">Above 20 years</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                              <h4 class="panel-title StepTitle">Amenities </h4>
                              </a>
                              <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                  <div class="form-group col-xs-12 col-sm-12 martop20">
									<?php $Attributeoption=$this->AddProperty_model->GetAttributesoption(6);
									foreach($Attributeoption as $Attributeoptions){?>
								    <span class="checkbozsty">
                                    <input type="checkbox" value="6-<?=$Attributeoptions->attrOptionID?>-<?=$Attributeoptions->attrOptName?>" name="Amenities[]">
                                    <?=$Attributeoptions->attrOptName?></span>
									<?php } ?>
									. 
								  </div>
                                </div>
                              </div>
                            </div>
							
							<div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo2" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                              <h4 class="panel-title StepTitle">Additional Information </h4>
                              </a>
                              <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                  <div class="row" style="margin-top:20px;"> </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="x_title-1">
                          <h4>Food</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" value="Veg" name="food">
                              Veg</label>
                            <label>
                              <input type="radio" class="flat" value="NonVeg" name="food">
                              Non-Veg</label>
                            <label>
                              <input type="radio" class="flat" value="NoPreferences" name="food">
                              No Preferences</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="x_title-1">
                          <h4>Pets Allowed</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" value="yes" name="petsallowed">
                              Yes</label>
                            <label>
                              <input type="radio" class="flat" value="no" name="petsallowed">
                              No</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="x_title-1">
                          <h4>Power Backup</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" value="Partial" name="powerbackup">
                              Partial</label>
                            <label>
                              <input type="radio" class="flat" value="Full" name="powerbackup">
                              Full</label>
                            <label>
                              <input type="radio" class="flat" value="nobackup"  name="powerbackup">
                              no backup</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Lease Type</label>
                          <select name="LeaseType" class="form-control">
						  <option value="">select</option>
                            <option value="Family">Family</option>
                            <option value="Bachelors">Bachelors</option>
                            <option value="Company">Company</option>
                            <option value="NoRestriction">No Restriction</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>No of Lifts</label>
                          <select name="nooflifts" class="form-control">
						  <option value="">select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="x_title-1">
                          <h4>Boundary Wall</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" value="BarbedWire" name="boundarywall">
                              Barbed Wire</label>
                            <label>
                              <input type="radio" class="flat" value="Grill" name="boundarywall">
                              Grill</label>
                            <label>
                              <input type="radio" class="flat" value="Glass"  name="boundarywall">
                              Glass</label>
                            <label>
                              <input type="radio" class="flat" value="ElectricWiring" name="boundarywall">
                              Electric Wiring</label>
                            <label>
                              <input type="radio" class="flat" value="brickwall"  name="boundarywall">
                              brick wall</label>
                            <label>
                              <input type="radio" class="flat" value="CementedWall"  name="boundarywall">
                              Cemented Wall</label>
                            <label>
                              <input type="radio" class="flat" value="NA"  name="boundarywall">
                              NA</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="x_title-1">
                          <h4>Water Backup</h4>
                        </div>
                        <div class="clearfix"> <span class="checkbozsty-1">
                          <input type="checkbox"  value="GroundTanks" name="waterbackup">
                          Grounded Tanks</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="terracetanks" name="waterbackup">
                          Pterrace Tankse</span> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="x_title-1">
                          <h4>Miscellaneous</h4>
                        </div>
                        <div class="clearfix"> <span class="checkbozsty-1">
                          <input type="checkbox"  value="serventroom" name="Miscellaneous[]">
                          Servent Room</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="privateterrace" name="Miscellaneous[]">
                          Private Terrace</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="prayerroom" name="Miscellaneous[]">
                          Prayer Room</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="terrace" name="Miscellaneous[]">
                          Terrace</span> <span class="checkbozsty-1">
                          <input type="checkbox" value="rentnegotiable" name="Miscellaneous[]">
                          Rent Negotiable</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="securitydeposit" name="Miscellaneous[]">
                          Security Deposit</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="securitynegotiable" name="Miscellaneous[]">
                          Security Negotiable</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="societyoverheadtank" name="Miscellaneous[]">
                          Society OverHead Tank</span> <span class="checkbozsty-1">
                          <input type="checkbox" value="smokedetector" name="Miscellaneous[]">
                          Smoke Detector</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="firehydrantsystem" name="Miscellaneous[]">
                          Fire Hydrant System</span> <span class="checkbozsty-1">
                          <input type="checkbox"  value="solarwaterheater" name="Miscellaneous[]">
                          Solar Water Heater</span> </div>
                      </div>
                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end of accordion -->
                          
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h4 class="StepTitle">Property Location </h4>
                              <div class="form-group col-xs-12 col-sm-4 martop20 ">
                                <label class="control-label" for="last-name">Location Info </label>
                                <input id="geocomplete" class="form-control" value="<?=isset($propertyAddress1)?$propertyAddress1:''?>" type="text" name="propertyAddress1">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Locality </label>
                                <input id="sublocality" class="form-control" type="text" name="sublocality" value="<?=isset($propertyLocality)?$propertyLocality:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Country </label>
                                <input id="country"  class="form-control" type="text" name="country">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">State </label>
                                <input id="administrative_area_level_1" class="form-control" type="text" name="administrative_area_level_1">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">City / Area </label>
                                <input id="locality" class="form-control" type="text" name="locality">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Zip / Postal Code </label>
                                <input id="postal_code" class="form-control" type="text" name="postal_code" value="<?=isset($propertyZipCode)?$propertyZipCode:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Latitude </label>
                                <input id="lat" class="form-control" type="text" name="lat" value="<?=isset($propertyLatitude)?$propertyLatitude:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Longitude </label>
                                <input id="lng" class="form-control" type="text" name="lng" value="<?=isset($propertyLongitude)?$propertyLongitude:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-12 mapinfo map_canvas" style="height: 400px"> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div id="step-2">
                  <h2 class="StepTitle">Add Photos</h2>
                  <div class="form-group col-xs-12 col-sm-12 martop20">
                    <p>Just click, Upload & Get upto 5 times higher response </p>
                    <div class="x_content">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs allbar-tabs tabadjst" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Exterior View</a> </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Living Room</a> </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Bedrooms</a> </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Bathrooms</a> </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Kitchen</a> </li>
                          <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Floor Plan</a> </li>
                          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Master Plan</a> </li>
                          <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Location Map</a> </li>
                          <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Others</a> </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
								   <form  action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
                                    <input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form5_id" />
									 <input type="hidden" name="imagecategory" value="1" readonly />
								   </form>
                                  </div>
								  <?php if(!empty($propertyimages)){ ?>
                                  <div class="x_content">
									<div class="row">
									<?php foreach($propertyimages as $propertyimagess){ ?>
										<div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="<?=base_url();?>propertyImages/<?=isset($propertyimagess->propertyImageName)?$propertyimagess->propertyImageName:''?>" alt="image" />
                                                    <div class="mask">
                                                        <div class="tools tools-bottom">
                                                            
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><?php if(!empty($propertyimagess->imageCatID)){ if($propertyimagess->imageCatID==1){ echo"Exterior View";} if($propertyimagess->imageCatID==2){ echo"Living Room";} if($propertyimagess->imageCatID==3){ echo"Bed Room";} if($propertyimagess->imageCatID==4){ echo"Bath Room";} if($propertyimagess->imageCatID==5){ echo"Kitchen";} if($propertyimagess->imageCatID==6){ echo"Floor Plan";} if($propertyimagess->imageCatID==7){ echo"Master Plan";} if($propertyimagess->imageCatID==8){ echo"Location Map";} if($propertyimagess->imageCatID==9){ echo"Others ";} } ?></p>
                                                </div>
                                            </div>
                                        </div>
										<?php }  ?>
										</div>
										</div>
                                  <?php  } ?>
                                  <div class="form-group col-md-12 col-xs-12 col-sm-12 martop15">
                                    <p>Accepted formats are .jpg, .gif, .bmp & .png. Maximum size allowed is 4 MB</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="2" readonly />
                                    </form>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="3" readonly />
                                    </form>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="4" readonly />
                                    </form>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="5" readonly />
                                    </form>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="6" readonly />
                                    </form>
                                  </div>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="7" readonly />
                                    </form>
                                  </div>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5; ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="8" readonly />
                                    </form>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                    <form action="<?php echo base_url();?>AddProperty/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
									<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly  class="form5_id"/>
									 <input type="hidden" name="imagecategory" value="9" readonly />
                                    </form>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="x_content"> 
                    
                    <!-- start accordion -->
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                        <h4 class="panel-title StepTitle">Meta Details</h4>
                        </a>
                        <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
						  <form id="form-2" method="post" class="form-group form-label-left clearfix">
						  <input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form2_id"/>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Title </label>
                              <input id="middle-name" class="form-control" type="text" name="propertyMetaTitle" value="<?=isset($propertyMetaTitle)?$propertyMetaTitle:''?>">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Meta Keywords </label>
                              <textarea placeholder="" name="propertyMetaKeyword" rows="2" class="form-control"><?=isset($propertyMetaKeyword)?$propertyMetaKeyword:''?></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Meta Description </label>
                              <textarea placeholder="" name="propertyMetaDescription" rows="2" class="form-control"><?=isset($propertyMetaDescription)?$propertyMetaDescription:''?></textarea>
                            </div>
							</form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion --> 
                    
                  </div>
                </div>
                <div id="step-3">
                  <div class="x_content head-sty"> 
                    
                    <!-- start accordion -->
					<form id="form-3" method="post" class="form-group form-label-left clearfix">
					<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form3_id"/>
                    <div class="accordion" id="accordion4" role="tablist" aria-multiselectable="true">
					
                      <div class="showbedrooms"></div>
					  
                      
                      
                      
                    </div>
                    
                    <!--<div class="x_title-1">
                                  <h4>Toilet</h4>
                                </div> -->
                    
                    
					</form>
                  </div>
                  
                  <!-- end of accordion --> 
                  
                </div>
                <div id="step-4">
                  <h2 class="StepTitle">Basic Information</h2>
                  <div class="x_content">
                    <div class="showpreview"></div>
                    <div class="row">
					<form id="form-4" method="post" class="form-group form-label-left clearfix">
					<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form4_id"/>
                      <div class="col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="last-name" style="display:block;">Status </label>
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="propertystatus" value="Active" id="option1">
                            Active </label>
                          <label class="btn btn-default">
                            <input type="radio" name="propertystatus" value="Draft" id="option2">
                            Draft </label>
                        </div>
                      </div>
					  </form
                    </div>
                  </div>
                </div>
              </div>
              <!--<div id="step-4">
                  <h2 class="StepTitle">Step 4 Content</h2>
                </div>--> 
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /page content --> 
	
	
	 <script>
	 
	
	 /*Coding start for sell/rent */
	 
	 $(function() 
	 {
						// add handler to re-enable input boxes on click
						$("#checksell").click(function() {
							$(".price_as").html("Show Price As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Price <i class='fa fa-rupee text-right'>");
							$(".disablerent").css("display","none");
							$(".disablesell").css("display","block");
							$(".disablerentbro").css("display","none");
							$(".ageofconstruction").css("display","none");
						});
						
						$("#checkrent").click(function() {
							$(".price_as").html("Show Rent As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Rent <i class='fa fa-rupee text-right'>");
							$(".disablesell").css("display","none");
							$(".disablerent").css("display","block");
							$(".ageofconstruction").css("display","block");
							if($("#usertypeid option:selected").val() !=''){
								var username= $("#usertypeid option:selected").text();
								if(username=="Agent"){
									$(".disablerentbro").css("display","block");
								}
								}
							
						});
						
						$("#underconstruction").click(function() {
							
							$(".available").css("display","block");
							$(".ageofconstruction").css("display","none");
						});
						
						$("#readytomove").click(function() {
							$(".ageofconstruction").css("display","block");
							$(".available").css("display","none");
						});
						
						$("#selectdate").click(function() {
							
							$(".dateshow").css("display","block");
							
						});
						
						$("#immediately").click(function() {
							$(".dateshow").css("display","none");
						});
						
						
						
					});
	 
	 /*Coding start for sell/rent */
	 
	 
	 

      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          blur: true,
          geocodeAfterResult: true
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
    </script>
	
	
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

<!-- editor --> 
<script>
            $(document).ready(function () {
                $('#editor').keyup(function () {
					
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

<script type="text/javascript">
    $(document).ready(function(){
    	// Smart Wizard 	
  		$('#wizard').smartWizard();
      
      function onFinishCallback(){
        $('#wizard').smartWizard('showMessage','Finish Clicked');
        alert('Finish Clicked');
      }     
		
		});
		
		function checktype(){
			
			return 'property';
		}
		
</script>

