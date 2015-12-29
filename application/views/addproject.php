<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Add Project</h3>
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
              <div id="wizard" class="swMain">
			  <input type="hidden" id="project" value="3" />
                <ul>
                  <li><a href="#step-1">
                    <label class="stepNumber">1</label>
                    <span class="stepDesc"> Step 1<br/>
                    <small>Basic Information</small> </span> </a></li>
                  <li><a href="#step-2">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc"> Step 2<br />
                    <small>Detailed Information</small> </span> </a></li>
                  <li><a href="#step-3">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc"> Step 3<br />
                    <small>Unit Information</small> </span> </a></li>
                </ul>
                <div id="step-1">
                  <h2 class="StepTitle">Basic Information</h2>
                  <div class="x_content">
                    <form id="form-1" method="post" class="form-group form-label-left clearfix">
					<input type="hidden" name="projectID" value="<?php if(!empty($ProjectFilterData)){ echo $ProjectFilterData[0]->projectID; }?>" readonly id="form1_id"/>
                      <div class="row">
                       <div class="form-group col-xs-12 col-sm-2 martop20">
                          <label class="control-label" for="first-name">Project Type </label>
							<select class=" form-control" name="projectTypeID" onchange="ProjectType(this.value);">
                            <option value="0">Select</option>
                           <?php foreach ($ProjectType as $list){ ?>
                            <?php  if($list->propertyTypeDefault=='Yes'){ ?>
	                        <optgroup label="<?php echo $list->propertyTypeKey;  ?>"> <?php } else{ ?>
                              <option value="<?php echo $list->propertyTypeID; ?>" <?php if(!empty($ProjectFilterData) && $ProjectFilterData[0]->propertyTypeID=$list->propertyTypeID) { echo 'selected';}?> ><?php  echo ucwords(str_replace('_', ' ', $list->propertyTypeKey)); }?></option>
							</optgroup>
                            <?php } ?>
							</select>
                        </div>
						<div class="form-group col-xs-12 col-sm-2 martop20">
                          <label class="control-label" for="first-name">User Type </label>
						  <select id="usertype" class=" form-control" onchange="UserTypes(this.value)" >
                            <option value="0">Select</option>
                  			 <?php foreach ($UserType as $list){ ?> 
							 <option value="<?php echo $list->userTypeID;?>" <?php if(!empty($ProjectFilterData) && $ProjectFilterData[0]->userTypeID==$list->userTypeID){ echo 'selected'; } else{ if($list->userTypeID=='2'){ echo 'selected'; } }?> > <?php echo ucwords(str_replace('_', ' ', $list->userTypeName)); ?></option>
                         	 <?php } ?>
                          </select>
                        </div>
                        <div id="userTypeDetail"></div>
                       <!--  <div class="form-group col-xs-12 col-sm-3 martop20">
                          <label class="control-label" for="last-name">Agent</label>
                          <select class=" select2_group form-control">
                            <option value="0">Select</option>
                            <option value="1">Divine real estate Builders ( Rahul Singh)</option>
                            <option value="2">Divine real estate Builders ( Rahul Singh)</option>
                          </select>
                        </div> -->
                        <div class="form-group col-xs-12 col-sm-2 martop20">
                          <label style="display:block;" class="control-label" for="last-name">&nbsp;</label>
                          <label style="margin-top:10px;">
                            <input type="checkbox" name="FreeListing" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                            Free Listing </label>
                        </div>
						<div id="userPlane"></div>
                        <!--  <div class="form-group col-xs-12 col-sm-3 martop20">
                          <label class="control-label" for="last-name">User Plan</label>
                          <select class=" select2_group form-control">
                            <option value="0">Select</option>
                            <option value="1">Free Listing</option>
                            <option value="2">Silver Plan</option>
                            <option value="2">Gold Plan</option>
                            <option value="2">Platinum Plan</option>
                          </select>
                        </div>-->
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Project Name <span class="required">*</span> </label>
                          <input type="text" name="projectName" id="first-name" value="<?php if(!empty($ProjectFilterData)){ echo $ProjectFilterData[0]->projectName;} ?>" required="required" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-sm-3">
                          <label class="control-label" for="last-name">Current status</label>
                          <select name="projectCurrentStatus" class=" form-control" id="curuntStatus" onchange="StatusDatePicker(this.value,this.id)">
                           <!-- <option value="0">Select</option> -->
                            <option value="Upcoming" <?php  if(!empty($ProjectFilterData[0]->projectCurrentStatus) && $ProjectFilterData[0]->projectCurrentStatus=='Upcoming'){ echo 'selected'; }  ?> >Upcoming</option>
                            <option value="Redy To Move" <?php  if(!empty($ProjectFilterData[0]->projectCurrentStatus) && $ProjectFilterData[0]->projectCurrentStatus=='Redy To Move'){ echo 'selected'; }  ?> >Redy To Move</option>
                            <option value="under construction" <?php  if(!empty($ProjectFilterData[0]->projectCurrentStatus) && $ProjectFilterData[0]->projectCurrentStatus=='under construction'){ echo 'selected'; }  ?> >under construction</option>
                          </select>
                        </div>
                        <div id="datepckr"></div>
                        <!--  <div class="form-group col-xs-12 col-sm-3">
                          <label class="control-label" for="last-name">Date</label>
                          <div class="xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Select Date" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" style="left:5px;" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                        </div>-->
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
                          <div id="editor"><?php  if(!empty($ProjectFilterData[0]->projectDescription)){ echo $ProjectFilterData[0]->projectDescription; }  ?></div>
                          <textarea name="projectDescription" id="descr" style="display:none;"></textarea>
                          <br/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="x_content">
                        <div id="AttributesList"></div>
                          <!-- start accordion -->
                          <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                           <!-- <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                              <h4 class="panel-title StepTitle">Project Specification</h4>
                              </a>
                              <div id="collapseOne1" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body black-filed">
                                  <div class="form-group col-xs-12 col-sm-4 martop20">
                                    <label class="control-label" for="last-name">Gated Community </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Yes</option>
                                      <option value="HI">No</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 martop20">
                                    <label class="control-label" for="last-name">Registered Society </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Yes</option>
                                      <option value="HI">No</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 martop20">
                                    <label class="control-label" for="last-name">No of Floors </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      <option value="AK">3</option>
                                      <option value="HI">4</option>
                                      <option value="AK">5</option>
                                      <option value="HI">6</option>
                                      <option value="AK">7</option>
                                      <option value="HI">8</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Private Terrace </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Yes</option>
                                      <option value="HI">No</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Terrace </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Yes</option>
                                      <option value="HI">No</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Structure </label>
                                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Solar Water Heater </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">No of Lift </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      <option value="AK">3</option>
                                      <option value="HI">4</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Solar Water Heater </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Yes</option>
                                      <option value="HI">No</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Servant Room </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Yes</option>
                                      <option value="HI">No</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Water Supply </label>
                                    <div class="checkbox chkb21">
                                      <label>
                                        <input type="checkbox" value="">
                                        Municipal water </label>
                                      <label>
                                        <input type="checkbox" value="">
                                        Bore water </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <h4 class="floall-had">Flooring </h4>
                                  </div>
                                </div>
                                <div class="row black-filed">
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group col-xs-12 col-sm-4 martop20 ">
                                      <label class="control-label" for="last-name">Living-dining </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Common area </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Master bedroom </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Other bedroom </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Balcony </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Toilet/bathroom </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <h4 class="floall-had">Fittings </h4>
                                  </div>
                                </div>
                                <div class="row black-filed">
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group col-xs-12 col-sm-4 martop20 ">
                                      <label class="control-label" for="last-name">Main door </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Electrical </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Kitchen </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Internal door </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Toilet Bathroom Fittings </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Windows </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <h4 class="floall-had">Walls </h4>
                                  </div>
                                </div>
                                <div class="row black-filed">
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group col-xs-12 col-sm-3 martop20 ">
                                      <label class="control-label" for="last-name">Exterior </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-3 martop20">
                                      <label class="control-label" for="last-name">Interior </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-3 martop20">
                                      <label class="control-label" for="last-name">Toilet Bathroom Walls </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-3 martop20">
                                      <label class="control-label" for="last-name">Kitchen Walls </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>-->
                            <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                              <h4 class="panel-title StepTitle">Amenities </h4>
                              </a>
                              <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								 <div class="panel-body">
                                  <div class="form-group col-xs-12 col-sm-12 martop20">
									<?php $Attributeoption=$this->AddProject_model->GetAttributesoption(6);
									foreach($Attributeoption as $Attributeoptions){?>
								    <span class="checkbozsty">
                                    <input type="checkbox" value="<?=$Attributeoptions->attrOptionID?>" name="Amenities">
                                    <?=$Attributeoptions->attrOptName?></span>
									<?php } ?>
									. 
								  </div>
                                </div>
                               <!-- <div class="panel-body">
                                  <div class="form-group col-xs-12 col-sm-12 martop20"> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                    Security</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                    Reserved Parking</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                                    Visitor Parking</span> <span class="checkbozsty">
                                    <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                                    Gymnasium</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                                    Lift</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                                    Waste Disposal</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="338" name="multiselect_Amenities_Intercom_6">
                                    Power Back Up</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="360" name="multiselect_Amenities_PipeGas_6">
                                    R O Water System</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="373" name="multiselect_Amenities_CentralizedAC_6">
                                    Conference Room</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="448" name="multiselect_Amenities_24hourswatersupply_6">
                                    Fire fighting Equipments</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="449" name="multiselect_Amenities_CCTV_6">
                                    Laundary Service</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="450" name="multiselect_Amenities_DTHTVFacilities_6">
                                    Vaastu Compliant</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="451" name="multiselect_Amenities_Guestaccomadation_6">
                                    Intercom</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="452" name="multiselect_Amenities_LaundryService_6">
                                    Club House</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    WiFi</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Rain Water Harvesting</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Swimming Pool</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Landscape - Flower Garden</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Property Staff - Maintenace Staff</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    School</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    ATM</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Worship</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Water Plant</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Bank</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Pipe Gas</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Shopping Center - Retail Shop</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Banquet Hall</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    24 Hours Water Supply</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Aerobic Room</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Amphithreater</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Barbeque Pit</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Basketball-Tennis Court</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Day care center</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    DTH TV Facilities</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Early Learning Centre - Play Group</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Golf Course</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Guest Accomadation</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Indoor Games Room</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Indoor Squash - badminton Court</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Kids Club</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Kids Play Area</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Meditiation Center</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Multiporpose Hall</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Paved Compound</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Recreational Pool - Facilities</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Rentable Community Space</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Service - Goods Lift</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Sewage Treatment Plan</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Skating Court</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Strolling Cycling and Jogging Track</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Waiting Lounge</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    CCTV</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Centralized AC</span> . </div>
                                </div>-->
                              </div>
                            </div>
                          </div>
                          <!-- end of accordion -->
                          
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h4 class="StepTitle">Project Location </h4>
                              <div class="form-group col-xs-12 col-sm-4 martop20 ">
                                <label class="control-label" for="last-name">Location Info </label>
                                <input id="geocomplete"  class="form-control" type="text" value="<?php if(!empty($ProjectFilterData)){ echo $ProjectFilterData[0]->projectAddress1; } ?>" name="projectAddress1">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Locality </label>
                                <input id="sublocality" class="form-control" type="text" value="" name="sublocality">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Country </label>
                                <input id="country" class="form-control" type="text" name="country">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">State </label>
                                <input id="administrative_area_level_1" class="form-control" type="text" name="administrative_area_level_1">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">City / Area </label>
                                <input id="locality" class="form-control" type="text" name="locality">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4">
                                <label class="control-label" for="last-name">Zip / Postal Code </label>
                                <input id="postal_code" class="form-control" type="text" name="postal_code">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Latitude </label>
                                <input id="lat" class="form-control" type="text" name="lat" value="<?php if(!empty($ProjectFilterData[0]->projectLatitude)){ echo $ProjectFilterData[0]->projectLatitude; } ?> ">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Longitude </label>
                                <input id="lng" class="form-control" type="text" name="lng" value="<?php if(!empty($ProjectFilterData[0]->projectLongitude)){ echo $ProjectFilterData[0]->projectLongitude; } ?> ">
                              </div>
                              <div class="form-group col-xs-12 col-sm-12 mapinfo map_canvas" style="height: 400px"> </div>
                            </div>
                          </div>
                         <!-- <div class="col-md-4 col-sm-4 col-xs-12"> 
                            <label class="control-label" for="last-name">Status </label>
                                
                                <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="options" id="option1"> Active
                            </label>
                            
                             <label class="btn btn-default">
                                <input type="radio" name="options" id="option2"> Draft
                            </label>
                        </div> 
                          </div>--> 
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                              <h4 class="floall-had">Payment Info </h4>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="field_wrapper form-group fileld-manag" id="pay-info">
							 <?php $i=1;if(!empty($ProjectPaymentInfo)){ foreach($ProjectPaymentInfo as $list){ ?>
							 <div class="row">
								<div class="form-group col-xs-12 col-sm-3 martop20 ">
                                  <label class="control-label" for="last-name">Label </label>
                                  <input type="text" name="paymentInfoLable[]" value="<?=$list->paymentInfoLabel;?>" class="form-control"/>
                                </div>
                                <div class="form-group col-xs-12 col-sm-3 martop20 ">
                                  <label class="control-label" for="last-name">Value </label>
                                  <input type="text" name="paymentInfoValue[]" value="<?=$list->paymentInfoValue;?>" class="form-control"/>
                                </div>
								<?php if($i=='1') { ?>
								<div class="form-group col-xs-12 col-sm-6 martop20 "> <a href="javascript:;" class="add_button" id="add" title="Add field" onclick="createplantable()" ><img src="<?=base_url();?>images/add-icon.png"/></a> </div> <?php } else { ?><div class="form-group col-xs-12 col-sm-6 martop20 removediv"><a href="javascript:;" class="remove_button" title="Add field" ><img src="<?=base_url();?>images/remove-icon.png"/></a></div><?php } ?>
							</div>	
							<?php $i++; }  } else{ ?>
                              <div class="row">
                                <div class="form-group col-xs-12 col-sm-3 martop20 ">
                                  <label class="control-label" for="last-name">Label </label>
                                  <input type="text" name="paymentInfoLable[]" value="" class="form-control"/>
                                </div>
                                <div class="form-group col-xs-12 col-sm-3 martop20 ">
                                  <label class="control-label" for="last-name">Value </label>
                                  <input type="text" name="paymentInfoValue[]" value="" class="form-control"/>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 martop20 "> <a href="javascript:;" class="add_button" id="add" title="Add field" onclick="createplantable()" ><img src="<?=base_url();?>images/add-icon.png"/></a> </div>
							 </div>
							<?php } ?>
                          </div>
                           </div>
                          <!-- start accordion -->
                          <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                              <h4 class="panel-title StepTitle">Meta Details</h4>
                              </a>
                              <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body ">
                                  <div class="form-group col-xs-12 col-sm-12">
                                    <label class="control-label" for="last-name">Title </label>
                                    <input id="middle-name" class="form-control" type="text" value="<?php if(!empty($ProjectFilterData[0]->projectMetaTitle)){ echo $ProjectFilterData[0]->projectMetaTitle; } ?> " name="projectMetaTitle">
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-12">
                                    <label class="control-label" for="last-name">Meta Keywords </label>
                                    <textarea placeholder="" name="projectMetaKeyword" rows="2" class="form-control"><?php if(!empty($ProjectFilterData[0]->projectMetaKeyword)){ echo $ProjectFilterData[0]->projectMetaKeyword; } ?></textarea>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-12">
                                    <label class="control-label" for="last-name">Meta Description </label>
                                    <textarea placeholder="" name="projectMetaDescription" rows="2" class="form-control"><?php if(!empty($ProjectFilterData[0]->projectMetaDescription)){ echo $ProjectFilterData[0]->projectMetaDescription; } ?></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end of accordion -->
                          
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                              <h4 class="floall-had">Og Details</h4>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-12 martop20 ">
                            <label class="control-label" for="last-name">Title </label>
                            <input id="middle-name" class="form-control" type="text" 
							value="<?php if(!empty($ProjectFilterData[0]->projectOgTitle)){ echo $ProjectFilterData[0]->projectOgTitle; } ?> " name="projectOgTitle">
                          </div>
                          <div class="form-group col-xs-12 col-sm-12 martop20 ">
                            <label class="control-label" for="last-name">Description</label>
                            <textarea placeholder="" name="projectOgDescription" rows="2" class="form-control"><?php if(!empty($ProjectFilterData[0]->projectOgDescription)){ echo $ProjectFilterData[0]->projectOgDescription; } ?></textarea>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div id="step-2">
                  <div class="form-group col-xs-12 col-sm-12">
                    <h2 class="StepTitle">Detailed Information</h2>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <h4>Elevation Image</h4>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <form action="<?php echo base_url();?>AddProject/uploadimage" class="dropzone" style="border: 1px solid #e5e5e5;">
						<input type="hidden" name="projectID" value="" readonly class="form1_id" />
						<input type="hidden" name="ElevationImageCategory" value="1" readonly />
                    </form>
					<?php if(!empty($ProjectFilterData[0]->	projectElevationImage)){ ?>
						
						<img src="<?=base_url();?>projectImages/<?=$ProjectFilterData[0]->projectElevationImage?>" width="100px" height="100px" />	
					<?php } ?>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <h4>360<sup>0</sup> View</h4>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <form action="<?php echo base_url();?>AddProject/uploadimage" class="dropzone" style="border: 1px solid #e5e5e5;">
						<input type="hidden" name="projectID" value="" readonly  class="form1_id"/>
						<input type="hidden" name="ThreeSixtyImageCategory" value="2" readonly />
                    </form>
					<?php if(!empty($ProjectFilterData[0]->	projectThreeSixtyImage)){ ?>
						
						<img src="<?=base_url();?>projectImages/<?=$ProjectFilterData[0]->projectThreeSixtyImage?>" width="100px" height="100px" />
					<?php } ?>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <h4>Gallery</h4>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs allbar-tabs tabadjst" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Exterior View</a> </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Interior View</a> </li>
                        <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Master Plan</a> </li>
                        <!--<li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Location Map</a> </li>
                     <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Others</a> </li> -->
                        
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_panel marlemin col-md-12">
                                <div class="form-group col-md-12 col-xs-12 col-sm-12 martop15">
                                  <form action="<?php echo base_url();?>AddProject/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5;  ">
								    <input type="hidden" name="projectID" value="" readonly  class="form1_id"/>
									<input type="hidden" name="imagecategory" value="3" readonly />
                                  </form>
								  <?php if(!empty($ProjectImageInfo[0]->projectImageName)&& $ProjectImageInfo[0]->imageCatID=='3'){ ?>
						
									<img src="<?=base_url();?>projectImages/<?=$ProjectImageInfo[0]->projectImageName?>" width="100px" height="100px" />	
								<?php } ?>
                                </div>
                               <!-- <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                  <div class="phoadd">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                  </div>
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                  <div class="sample">
                                    <p>Sample Exterior View</p>
                                    <img src="images/sample.jpg"> </div>
                                </div>-->
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
                                  <form action="<?php echo base_url();?>AddProject/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
									<input type="hidden" name="projectID" value="" readonly class="form1_id" />
									<input type="hidden" name="imagecategory" value="4" readonly />
                                  </form>
								  <?php if(!empty($ProjectImageInfo[1]->projectImageName)&& $ProjectImageInfo[1]->imageCatID==4){ ?>
						
									<img src="<?=base_url();?>projectImages/<?=$ProjectImageInfo[1]->projectImageName?>" width="100px" height="100px" />	
									<?php } ?>
                                </div>
                                <!--<div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                  <div class="phoadd">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                  </div>
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                  <div class="sample">
                                    <p>Sample Exterior View</p>
                                    <img src="images/sample2.jpg"> </div>
                                </div>-->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_panel marlemin">
                                <div class="form-group col-md-12 col-xs-12 col-sm-2 martop15">
                                  <form action="<?php echo base_url();?>AddProject/uploadimage" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
									<input type="hidden" name="projectID" value="" readonly class="form1_id" />
									<input type="hidden" name="imagecategory" value="5" readonly />
                                  </form>
								  <?php if(!empty($ProjectImageInfo[2]->projectImageName) && $ProjectImageInfo[2]->imageCatID==5){ ?>
						
									<img src="<?=base_url();?>projectImages/<?=$ProjectImageInfo[2]->projectImageName?>" width="100px" height="100px" />	
								<?php } ?>
                                </div>
                                <!--<div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                  <div class="phoadd">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                  </div>
                                </div>
                                <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                  <div class="sample">
                                    <p>Sample Exterior View</p>
                                    <img src="images/sample.jpg"> </div>
                                </div>-->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12 martop20">
                    <h4>Videos</h4>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                    <form action="<?php echo base_url();?>AddProject/uploadvideo" class="dropzone video-upload" style="border:1px solid #e5e5e5;">
						<input type="hidden" name="projectID" value="" readonly class="form1_id" />
						<input type="hidden" name="videocategory" value="6" readonly />
                    </form>
					<?php if(!empty($ProjectVideoInfo[0]->projectVideo)){ ?>
					<video autoplay="autoplay" controls="controls" src="<?=base_url();?>projectVideos/<?=$ProjectVideoInfo[0]->projectVideo?>" type="video/wmv">
					</video>
					<?php } ?>
                  </div>
                  <div class="form-group col-xs-12 col-sm-12">
                  <label class="control-label" for="last-name" style="display:block;">Status </label>
                                
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="options" id="option1"> Active
                            </label>
                            
                             <label class="btn btn-default">
                                <input type="radio" name="options" id="option2"> Draft
                            </label>
                        </div>
                  
                  </div>
                </div>
                <div id="step-3">
                  <div class="x_panel"> 
                    
                    <!--<div class="pull-right filter-con">
              <a class="btn btn-primary" href="unit-price.html">Back</a>
              </div>-->
			 
                    <div class="row">
                      <div class="col-md-12">
					   <form id="form_3" method="post">
					  <div class="form-group col-xs-12 col-sm-4 martop20">
                          <label class="control-label" for="first-name">Property Type </label>
                          <select name="propertyTypeID" class="  form-control" id="propertytype" >
                            <option value="">Select</option>
                            <optgroup label="Residential Properties">
                           <?php foreach($propertytype as $propertytypes){?>
                        <option value="<?=isset($propertytypes->propertyTypeID)?$propertytypes->propertyTypeID:''?>" <?php if(!empty($inventoryupdate[0]->ProjectID)){ if($inventoryupdate[0]->ProjectID==$propertytypes->propertyTypeID){ echo"selected";} } ?>><?=isset($propertytypes->propertyTypeName)?$propertytypes->propertyTypeName:''?></option>
						<?php } ?>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 martop20 ">
                          <label for="last-name" class="control-label">Size</label>
                          <input type="text" name="middle-name" class="form-control" id="middle-name">
                          <span class="sqft">sq/ft</span> </div>
                        <div class="form-group col-xs-12 col-sm-4 martop20 ">
                          <label for="last-name" class="control-label">Price</label>
                          <input type="text" name="middle-names" class="form-control" id="middle-name">
                        </div>
						</form>
                        <div class="form-group col-xs-12 col-sm-12 martop20">
                          <label for="last-name" class="control-label">Floor Plan</label>
                          <form action="<?php echo base_url();?>AddProject/uploadimage" class="dropzone" style="border: 1px solid #e5e5e5; height: 300px; ">
                          </form>
                        </div>
                        <div class="row">
                          <div class="x_content"> 
                            
                            <!-- start accordion -->
                            <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                              <div class="panel"> <a class="panel-heading" role="tab" id="headingOne22" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne22" aria-expanded="false" aria-controls="collapseOne22">
                                <h4 class="panel-title StepTitle">Unit Specification</h4>
                                </a>
                                <div id="collapseOne22" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                  <div class="panel-body black-filed">
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Bed Rooms </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Bath Rooms </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 martop20">
                                      <label class="control-label" for="last-name">Balcony </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <!--<div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Wash Dry Area </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>-->
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Parking </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Structure </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Solar Water Heater </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Built Up Area </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Society Name </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Ownership Type </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                      <label class="control-label" for="last-name">Main Entrance Facing </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">North</option>
                                        <option value="HI">East</option>
                                        <option value="HI">West</option>
                                        <option value="HI">South</option>
                                        <option value="HI">North-East</option>
                                        <option value="HI">North-West</option>
                                        <option value="HI">South-East</option>
                                        <option value="HI">South-West</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Servant Room </label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Gated Community</label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Plot Area </label>
                                      <input id="middle-name" class="form-control" type="text" name="middle-name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Registered Society</label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Sale Status</label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Furnishing Status</label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 ">
                                      <label class="control-label" for="last-name">Carpet Area</label>
                                      <select class="  form-control">
                                        <optgroup label="Select">
                                        <option value="AK">1</option>
                                        <option value="HI">2</option>
                                        </optgroup>
                                      </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                      <label class="control-label" for="last-name">Age of Building</label>
                                      <input type="text" class="  form-control"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                      <label class="control-label" for="last-name" style="display:block;">Water Supply</label>
                                      <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                      Muncipal Corp</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                      Bore Well</span> </div>
                                  </div>
                                </div>
                              </div>
                              <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo33" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33">
                                <h4 class="panel-title StepTitle">Amenities </h4>
                                </a>
                                <div id="collapseTwo33" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                  <div class="panel-body">
                                    <div class="form-group col-xs-12 col-sm-12 martop20"> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                      Security</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                      Reserved Parking</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                                      Visitor Parking</span> <span class="checkbozsty">
                                      <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                                      Gymnasium</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                                      Lift</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                                      Waste Disposal</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="338" name="multiselect_Amenities_Intercom_6">
                                      Power Back Up</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="360" name="multiselect_Amenities_PipeGas_6">
                                      R O Water System</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="373" name="multiselect_Amenities_CentralizedAC_6">
                                      Conference Room</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="448" name="multiselect_Amenities_24hourswatersupply_6">
                                      Fire fighting Equipments</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="449" name="multiselect_Amenities_CCTV_6">
                                      Laundary Service</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="450" name="multiselect_Amenities_DTHTVFacilities_6">
                                      Vaastu Compliant</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="451" name="multiselect_Amenities_Guestaccomadation_6">
                                      Intercom</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="452" name="multiselect_Amenities_LaundryService_6">
                                      Club House</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      WiFi</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Rain Water Harvesting</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Swimming Pool</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Landscape - Flower Garden</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Property Staff - Maintenace Staff</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      School</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      ATM</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Worship</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Water Plant</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Bank</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Pipe Gas</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Shopping Center - Retail Shop</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Banquet Hall</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      24 Hours Water Supply</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Aerobic Room</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Amphithreater</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Barbeque Pit</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Basketball-Tennis Court</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Day care center</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      DTH TV Facilities</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Early Learning Centre - Play Group</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Golf Course</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Guest Accomadation</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Indoor Games Room</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Indoor Squash - badminton Court</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Kids Club</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Kids Play Area</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Meditiation Center</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Multiporpose Hall</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Paved Compound</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Recreational Pool - Facilities</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Rentable Community Space</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Service - Goods Lift</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Sewage Treatment Plan</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Skating Court</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Strolling Cycling and Jogging Track</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Waiting Lounge</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      CCTV</span> <span class="checkbozsty">
                                      <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                      Centralized AC</span> . </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- end of accordion --> 
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="button" class="btn btn-success" onclick="InsertPropertyDetail();">Save</button>
                          </div>
                        </div>
						 </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top:20px;">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4 class="panel-title StepTitle">Unit List</h4>
                        <div class="x_panel">
                          <div class="x_content">
                            <div class="pull-right filter-con">
                              <label>Filter by</label>
                              <select>
                                <option>Property Type</option>
                                <option>Villa</option>
                              </select>
                              <select>
                                <option>BHK</option>
                                <option>2BHK</option>
                              </select></div>
                            <table id="myTable" class="table table-bordered table-hover vert-aliins">
                              <thead>
                                <tr>
                                  <th>BHK</th>
                                  <th>Area Sq.Ft</th>
                                  <th>Price/Sq.Ft</th>
                                  <th>Price</th>
                                  <th>Floor Plan</th>
                                  <th><i class="fa fa-gear"></i></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>3BHK</td>
                                  <td>1000 Sq.Ft</td>
                                  <td><i class="fa fa-rupee"></i> 599</td>
                                  <td><i class="fa fa-rupee"></i> 5.99 lac</td>
                                  <td><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><img src="<?=base_url();?>images/floor.png"/></a></td>
                                  <td><a href="#" class="more-uni-pri"><i class="fa fa-plus"></i> More</a></td>
                                </tr>
                                <tr class="moreunits">
                                  <td colspan="6"><table id="myTable" class="table table-hover vert-aliins unit-sty">
                                      <tr>
                                        <td>Amenities<span>Security</span></td>
                                        <td>Ownership Type<span>Freehold</span></td>
                                        <td>Gated Community<span>Yes</span></td>
                                        <td>Registered Society<span>Yes</span></td>
                                        <td>Sales Status<span>New</span></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td>2BHK</td>
                                  <td>1000 Sq.Ft</td>
                                  <td><i class="fa fa-rupee"></i> 599</td>
                                  <td><i class="fa fa-rupee"></i> 5.99 lac</td>
                                  <td><img src="<?=base_url();?>images/floor.png"/></td>
                                  <td><a href="#" class="more-uni-pri1"><i class="fa fa-plus"></i> More</a></td>
                                </tr>
                                <tr class="moreunits1">
                                  <td colspan="6"><table id="myTable" class="table table-hover vert-aliins unit-sty">
                                      <tr>
                                        <td>Amenities<span>Security</span></td>
                                        <td>Ownership Type<span>Freehold</span></td>
                                        <td>Gated Community<span>Yes</span></td>
                                        <td>Registered Society<span>Yes</span></td>
                                        <td>Sales Status<span>New</span></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel2">Floor Plan</h4>
                                  </div>
                                  <div class="modal-body">
                                    <iframe src="gallery.html" style="border:0px; width:100%; height:430px;"></iframe>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                            <script>
							  $(document).ready(function(){
								  $(".more-uni-pri").click(function(){
									$('.moreunits').slideToggle();
									$('.fa-plus').toggleClass('fa-minus');
									  });
									  
									  $(".more-uni-pri1").click(function(){
									$('.moreunits1').slideToggle();
									
									  });
								  });
						  </script> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- /page content --> 

	<script type="text/javascript"> 
		window.onload = function()
		{
			//alert('hiiii');
			var userid="<?php if(!empty($ProjectFilterData[0]->userID)){ echo $ProjectFilterData[0]->userID; } ?>";//alert(userids);die;
			var UserTypeId=document.getElementById('usertype').value; //alert(UserTypeId);
			$.ajax({
			type: "POST",
			url : base_url+'AddProject/UserTypeDetail',
			data: {UserTypeId:UserTypeId,userid:userid},
			beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
			.done(function(msg){
				//alert(msg);//die;
				$("#loader").fadeOut();
				$('#userTypeDetail').html(msg);
			
				//return false;	
			});
			//return false;
			//alert('hiii');
			$.ajax({
			type: "POST",
			url : base_url+'AddProject/UserPlaneDetail',
			data: {UserId:''},
			})	
			.done(function(msg){
				//alert(msg);//die;
				$('#userPlane').html(msg);
			
			//	return false;	
			});
		//	return false;
			var StatusValue=document.getElementById('curuntStatus').value;
			//alert(curuntStatus);
			$.ajax({
			type: "POST",
			url : base_url+'AddProject/StatusDatePicker',
			data: {StatusValue:StatusValue},
			})	
			.done(function(msg){
				//alert(msg);//die;
				$('#datepckr').html(msg);
			
				return false;	
			});
	
			return false;
		} 
	 </script>
	  <script>
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
                $('#editor').keyup(function () { //alert('hii');
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
</script>
<script type="text/javascript">
    $(function() {
      $("#add").click(function() {
          div = document.createElement('div');
          $(div).addClass("row").html('<div class="form-group col-xs-12 col-sm-3 martop20"><label class="control-label" for="last-name">Label </label><input type="text" name="paymentInfoLable[]" value="" class="form-control"/></div><div class="form-group col-xs-12 col-sm-3 martop20 "><label class="control-label" for="last-name">Value </label><input type="text" name="paymentInfoValue[]" value="" class="form-control"/></div><div class="form-group col-xs-12 col-sm-6 martop20 removediv"><a href="javascript:;" class="remove_button" title="Add field" ><img src="<?=base_url();?>images/remove-icon.png"/></a></div>');
          $("#pay-info").append(div);
        });
		
		$('#pay-info').on('click','.removediv a',function(){
     $(this).closest('.row').remove();
	});
    });
</script>
<script>
function checktype()
{
			return 'project';
}
</script>