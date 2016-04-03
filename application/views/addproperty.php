<!-- page content -->
<style>
.editmode {
    background: #ccc none repeat scroll 0 0;
    bottom: -10px;
    left: 0;
    padding: 5px 10px;
    position: absolute;
    right: 0;
}
</style>
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
              <div id="property_wizard" class="swMain">
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
                    <form id="form-1" method="post" class="form-group form-label-left clearfix form" novalidate>
					 <input type="hidden" name="type" value="Property" >
					<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form1_id"/>
                      <div class="row">
                        <div class="form-group clearfix">
                          <div class="form-group col-xs-12 col-sm-3" style="padding-top:8px;">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default <?php if(!empty($purpose)){if($purpose=="Sell"){echo" active";}}?>" id="checksell">
                                <input  type="radio" class="purpose " <?php if(!empty($purpose)){if($purpose=="Sell"){echo"checked";}}?> name="propertyPurpose" value="Sell" id="sell" onchange="generatenameproperty();">
                                Sell </label>
                              <label class="btn btn-default <?php if(!empty($purpose)){if($purpose=="Rent"){echo" active";}}?>" id="checkrent">
                                <input  type="radio" class="purpose " <?php if(!empty($purpose)){if($purpose=="Rent"){echo"checked";}}?> name="propertyPurpose" value="Rent" id="rent" onchange="generatenameproperty();">
                                Rent </label>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-5" style="padding-top:8px;">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default <?php if(!empty($under)){if($under==2){echo" active";}}?>" id="unit_individual">
                                <input  type="radio" name="individual" <?php if(!empty($under)){if($under==2){echo" checked";}}?> value="Unit" id="type_individual" class="typechecking">
                                Individual Property </label>
                              <label class="btn btn-default <?php if(!empty($under)){if($under==1){echo" active";}}?>" id="unit_project">
                                <input  type="radio" name="individual" <?php if(!empty($under)){if($under==1){echo" checked";}}?> value="Property" id="type_project" class="typechecking">
                                Property Under Project </label>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-4" style="padding-top:8px;"> <span id="unit1">
                            <select name="projectID" class="form-control select2_single  project-uni" id="projectid" onchange="generatenameproperty();">
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
						
						// add handler to re-enable input boxes on click allowClear: true
						$("#unit_project").click(function() {
							$(".project-uni").removeAttr("disabled");
							$(".hidemap").css("display","none");
						});
						// add handler to re-disable input boxes on click select2-selection__clear
						$("#unit_individual").click(function() {
						$("#projectid").find("option:selected").prop("selected", false)
						
						$(".project-uni").attr("disabled", true);
						$(".hidemap").css("display","block");
						generatenameproperty();
						});
						
					});
				</script> 
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Property Type <span class="required">*</span> </label>
                          <select  name="propertyTypeID" class="  form-control propertytype" id="propertytype" onchange="generatenameproperty();">
                            <option value="">Select</option>
                            
                           <?php foreach($propertytype as $propertytypes){?>
                        <option value="<?=isset($propertytypes->propertyTypeID)?$propertytypes->propertyTypeID:''?>" <?php if(!empty($propertytypeid)){ if($propertytypeid==$propertytypes->propertyTypeID){ echo"selected";} } ?>><?=isset($propertytypes->propertyTypeName)?$propertytypes->propertyTypeName:''?></option>
						<?php } ?>
                            
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Property Name <span class="required">*</span> </label>
                          <input name="propertyName" type="text" value="<?=isset($propertyname)?$propertyname:''?>" id="propertyname" readonly  class="form-control ">
                        </div>
                       <!-- <div class="form-group col-xs-12 col-sm-4">
                          <label style="display:block;" class="control-label">User Type</label>
                          <select id="usertypeid" class=" form-control" name="usertype" >
							<option value="">Select User Type</option>
							 <?php //foreach($user_type as $user_type){?>
							<option value="<?php//=$user_type->userTypeID?>" <?php //if(!empty($usertypeid)){ if($usertypeid==$user_type->userTypeID){ echo"selected";} } ?>><?php //=$user_type->userTypeName?></option>
							<?php //} ?> 
							
						  </select>
                        </div> -->
						
						<div class="form-group col-xs-12 col-sm-4">
                          <label style="display:block;" class="control-label">User Type</label>
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default <?php if(!empty($usertypeid)){ if($usertypeid=="4"){ echo"active";} } ?>">
                              <input  type="radio" name="usertype" value="4" <?php if(!empty($usertypeid)){ if($usertypeid=="4"){ echo"checked";} } ?> id="Agent" class="usertypeid">
                              Agent </label>
                            <label class="btn btn-default <?php if(!empty($usertypeid)){ if($usertypeid=="3"){ echo"active";} } ?>">
                              <input  type="radio" name="usertype" value="3" <?php if(!empty($usertypeid)){ if($usertypeid=="3"){ echo"checked";} } ?> id="Builder" class="usertypeid">
                              Builder </label>
                            <label class="btn btn-default <?php if(!empty($usertypeid)){ if($usertypeid=="1"){ echo"active";} } ?>">
                              <input  type="radio" name="usertype" value="1" <?php if(!empty($usertypeid)){ if($usertypeid=="1"){ echo"checked";} } ?> id="Individual" class="usertypeid">
                              Individual </label>
                          </div>
                        </div>
						
                        <div class="form-group col-xs-12 col-sm-4">
                          <label for="middle-name" class="control-label showuserlabel" ><?=isset($usertype)?$usertype:''?></label>
						  <input type="hidden" name="" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form1_id"/>
                          <select required="required" name="userID" class=" select2_group form-control" id="showuserlabel" >
                            <option value="">Please Select Usertype First</option>
							<?php if(!empty($userID)){?>
                            <option value="<?=isset($userID)?$userID:''?>" selected><?=isset($useremail)?$useremail:''?></option>
							<?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 ">
                          <label for="middle-name" class="control-label">User Plan</label>
						 
                          <select name="planid" class="  form-control" onchange="PropertyConsumePlanID(this.value);" id="userplan">
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
                          <textarea  name="propertyDescription" id="descr" style="display:none;"><?=isset($propertyDescription)?$propertyDescription:''?></textarea>
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
                          
                            <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                              <h4 class="panel-title StepTitle">Amenities </h4>
                              </a>
                              <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                  <div class="form-group col-xs-12 col-sm-12 martop20">
									<?php $Attributeoption=$this->AddProperty_model->GetAttributesoption(6);
									function cmp($a, $b)
									{
											return strcmp($a->attrOptName, $b->attrOptName);
									}
									usort($Attributeoption, "cmp");


									
									if(!empty($propertyid)){
									$getamenities=$this->AddProperty_model->Getotherdata('rp_property_attribute_values',array('propertyID'=>$propertyid,'attributeID'=>6));
									if(!empty($getamenities)){
										$amenitiescheckvalues=explode("#|#",$getamenities[0]->attrOptionID);
									}
									
									}
									
									
									
									foreach($Attributeoption as $Attributeoptions){ 
									 ?>
								    <span class="checkbozsty">
                                    <input type="checkbox" value="6#<?=$Attributeoptions->attrOptionID?>#<?=$Attributeoptions->attrOptName?>" <?php if(!empty($amenitiescheckvalues)){ if(in_array($Attributeoptions->attrOptionID,$amenitiescheckvalues)){echo"checked";} } ?> name="Amenities[]">
                                    <?=$Attributeoptions->attrOptName?></span>
									<?php } ?>
									. 
								  </div>
                                </div>
                              </div>
                            </div>
							
							
                          </div>
                          <!-- end of accordion -->
                          <?php $lochide=''; if(!empty($under)){
							  if($under==1){ $lochide='style="display:none"'; } } ?>
                          <div class="row hidemap" <?=$lochide?>>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h4 class="StepTitle">Property Location </h4>
                              <div class="form-group col-xs-12 col-sm-4 martop20 ">
                                <label class="control-label" for="last-name">Location Info </label>
                                <input id="geocomplete" onblur="initialize();" class="form-control hidemap" value="" type="text" name="propertyAddress3">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Locality </label>
                                <input id="sublocality" class="form-control hidemap" type="text" name="sublocality" value="<?=isset($propertyLocality)?$propertyLocality:''?>"> 
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Country </label>
                                <input id="country"  class="form-control showvalidation hidemap" type="text" name="country" value="<?=isset($countryname)?$countryname:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">State </label>
                                <input id="administrative_area_level_1" class="form-control showvalidation hidemap" type="text" name="administrative_area_level_1" value="<?=isset($statename)?$statename:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">City / Area </label>
                                <input id="locality" class="form-control showvalidation hidemap" type="text" name="locality" value="<?=isset($cityname)?$cityname:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Zip / Postal Code </label>
                                <input id="postal_code" class="form-control hidemap" type="text" name="postal_code" value="<?=isset($propertyZipCode)?$propertyZipCode:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Latitude </label>
                                <input id="lat" class="form-control showvalidation hidemap" type="text" name="lat" value="<?=isset($propertyLatitude)?$propertyLatitude:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Longitude </label>
                                <input id="lng" class="form-control showvalidation hidemap" type="text" name="lng" value="<?=isset($propertyLongitude)?$propertyLongitude:''?>">
                              </div>
							  <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Address1 </label>
                                <input  class="form-control showvalidation hidemap" type="text" name="propertyAddress1" value="<?=isset($propertyAddress1)?$propertyAddress1:''?>">
                              </div>
							  <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Address2 </label>
                                <input  class="form-control hidemap" type="text" name="propertyAddress2" value="<?=isset($propertyAddress2)?$propertyAddress2:''?>">
                              </div>
                              <div class="form-group col-xs-12 col-sm-12 mapinfo map_canvas" id="map-canvas" style="height: 400px"> </div>
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
                                    <input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form5_id" class="form5_id" />
									 <input type="hidden" name="imagecategory" value="2" readonly />
									 <input type="hidden" name="propertyImageTitle" value="Exterior View" readonly />
								   </form>
                                  </div>
								  
                                  <div class="form-group col-md-12 col-xs-12 col-sm-12 martop15">
                                    <p>Accepted formats are .jpg, .gif, .bmp & .png. Maximum size allowed is 2 MB</p>
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
									 <input type="hidden" name="propertyImageTitle" value="Living Room" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Bedrooms" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Bathrooms" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Kitchen" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Floor Plan" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Master Plan" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Location Map" readonly />
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
									 <input type="hidden" name="imagecategory" value="2" readonly />
									  <input type="hidden" name="propertyImageTitle" value="Others" readonly />
                                    </form>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
						<style>
					.cover-img {position:absolute; top:0; left:0; z-index:999; width:90px;}
					.cover-img img {max-width:100%;}
					</style>
					<div class="afteruploadimagediv">
						<?php if(!empty($propertyimages)){ ?>
                                  <div class="x_content ">
									<div class="row">
									<?php $i=1; foreach($propertyimages as $propertyimagess){ ?>
										<div class="col-md-55 imagediv_<?=$i?>" id="imagediv_<?=$i?>">
                                            <div class="thumbnail">
                                                <div class="image view view-first" style="relative">
												<?php if($propertyimagess->isCoverImage=="Yes"){?>
												<div class="cover-img" id="firsttimeimg_<?php echo $propertyimagess->propertyImageID?>"><img src="<?php echo base_url()?>assests/images/cover.png"/></div>
												<?php }?>
												<div class="cover-img" id="ajaxtimeimg_<?php echo $propertyimagess->propertyImageID?>" style="display:none;"><img src="<?php echo base_url()?>assests/images/cover.png"/></div>
                                                    <img style="width: 100%; display: block;" src="http://<?=isset($severname)?$severname:''?>/public/uploads/property/images/medium/<?=isset($propertyimagess->propertyImageName)?$propertyimagess->propertyImageName:''?>" alt="image" />
                                                    <div class="mask">
                                                        <div class="tools tools-bottom">
														
														<a href="javascript:;" onclick="return isCoverImage(<?php echo $propertyimagess->propertyImageID?>,<?php echo $propertyimagess->propertyID?>)">Set as Cover Image</a> 
                                                            <a href="javascript:;" onClick="ConfirmDelete(<?=isset($propertyimagess->propertyImageID)?$propertyimagess->propertyImageID:''?>,'imagediv_<?=$i?>')"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
												<script>function ConfirmDelete(aa,bb)
												{
												  var x = confirm("Are you sure you want to delete?");
												  if (x)
													 deleteiamge1(aa,bb);
												  else
													return false;
												}</script>
                                                <div class="caption">
                                                    <p><span id="textspan_<?php echo $propertyimagess->propertyImageID?>"><?php echo $propertyimagess->propertyImageTitle;?></span><span id="newtextspan_<?php echo $propertyimagess->propertyImageID?>"> </span><a href="javascript:void(0);" onclick="return appImageEdit(<?php echo $propertyimagess->propertyImageID?>)"><i class="fa fa-edit"></i></a></p>
													<p><span id="textspan1_<?php echo $propertyimagess->propertyImageID?>">Priority- <?php echo $propertyimagess->propertyImagePriority;?></span><span id="newtextspan1_<?php echo $propertyimagess->propertyImageID?>"> </span><a href="javascript:void(0);" onclick="return appImageEdit1(<?php echo $propertyimagess->propertyImageID?>)"><i class="fa fa-edit"></i></a></p>
										
										
										
										
											<div class="form-group editmode" style="display:none;" id="ajaxeditimg_<?php echo $propertyimagess->propertyImageID?>">											
												 <input type="text" class="form-control" value="<?php echo $propertyimagess->propertyImageTitle;?>" id="imgtagedit_<?php echo $propertyimagess->propertyImageID;?>">
												 <button type="button" class="btn btn-primary" onclick="return editImageTag(<?php echo $propertyimagess->propertyImageID?>);">Edit</button>
												  <button type="button" class="btn btn-primary imgtagclose">Close</button>
											</div>
											<div class="form-group editmode" style="display:none;" id="ajaxeditimg1_<?php echo $propertyimagess->propertyImageID?>">											
												 <input type="text" class="form-control" value="<?php echo $propertyimagess->propertyImagePriority;?>" id="imgtagedit1_<?php echo $propertyimagess->propertyImageID;?>">
												 <button type="button" class="btn btn-primary" onclick="return editImageTag(<?php echo $propertyimagess->propertyImageID?>);">Edit</button>
												  <button type="button" class="btn btn-primary imgtagclose">Close</button>
											</div>
										</div>
                                            </div>
                                        </div>
										<?php $i++; }  ?>
										</div>
										</div>
                                  <?php  } ?>
								  </div>
                      </div>
                    </div>
                  </div>
                  <div class="x_content"> 
                    
                    <!-- start accordion -->
					<?php if(!empty($propertyid)){?>
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                        <h4 class="panel-title StepTitle">Meta Details</h4>
                        </a>
                        <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
						  <form id="form-2" method="post" class="form-group form-label-left clearfix form">
						  <input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly class="form5_id"/>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Title </label>
                              <input id="middle-name" readonly class="form-control" type="text" name="propertyMetaTitle" value="<?=isset($propertyMetaTitle)?$propertyMetaTitle:''?>">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Meta Keywords </label>
                              <textarea placeholder="" readonly name="propertyMetaKeyword" rows="2" class="form-control"><?=isset($propertyMetaKeyword)?$propertyMetaKeyword:''?></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Meta Description </label>
                              <textarea placeholder="" readonly name="propertyMetaDescription" rows="2" class="form-control"><?=isset($propertyMetaDescription)?$propertyMetaDescription:''?></textarea>
                            </div>
							</form>
                          </div>
                        </div>
                      </div>
                    </div>
					<?php } ?>
                    <!-- end of accordion --> 
                    
                  </div>
                </div>
                <div id="step-3">
                  <div class="x_content head-sty"> 
                    
                    <!-- start accordion -->
					<form id="form-3" method="post" class="form-group form-label-left clearfix form">
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
					<form id="form-4" method="post" action="<?=base_url();?>AddProperty/PropertyAction/propertystatus/<?=isset($propertyid)?$propertyid:''?>" class="form-group form-label-left clearfix form">
					<input type="hidden" name="propertyID" value="<?=isset($propertyid)?$propertyid:''?>" readonly id="form4_id"/>
                      <div class="col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="last-name" style="display:block;">Status </label>
                        <div class="btn-group" data-toggle="buttons">
						 <input type="hidden" name="PlaneID" value="<?php if(isset($propertyid)){ $PlanDetail=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$propertyid)); if(isset($PlanDetail[0]->planID)){ echo $PlanDetail[0]->planID; } }?>" readonly class="ConsumePlaneID"/>
                          <label class="btn btn-default <?php if(!empty($propertyStatus)){if($propertyStatus=="Active"){echo" active";}}?>">
                            <input type="radio" name="propertystatus" value="Active" <?php if(!empty($propertyStatus)){if($propertyStatus=="Active"){echo" checked";}}?> id="option1">
                            Active </label>
                          <label class="btn btn-default <?php if(!empty($propertyStatus)){if($propertyStatus=="Draft"){echo" active";}}else{echo"active";}?>">
                            <input type="radio" name="propertystatus" checked value="Draft" <?php if(!empty($propertyStatus)){if($propertyStatus=="Draft"){echo" checked";}}?> id="option2">
                            Draft </label>
                        </div>
                      </div>
					  </form>
					  
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
		 <?php if(!empty($propertytypeid)){ ?>
		 var propertytypeid = $("#propertytype").val();
		 var propertyid= $("#form1_id").val();
		$.ajax({
            type: 'POST', 
            url: base_url+'AddProperty/Getattributes/'+propertyid,
            data: {propertytypeid:propertytypeid},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				//alert(result);
				$("#loader").fadeOut();
				$("#showattributes").html(result);
				generatenameproperty();
             <?php if(!empty($purpose)){
			 if($purpose=="Sell"){ ?>
			 
							$(".price_as").html("Show Price As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Price <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Price & Other Charges");
							$(".disablerent").css("display","none");
							$(".disablesell").css("display","block");
							$(".disablerentbro").css("display","none");
							$(".ageofconstruction").css("display","none");
			 
		 
			 <?php }
			 if($purpose=="Rent"){ ?>
			 
			 $(".price_as").html("Show Rent As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Rent <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Rent & Other Charges");
							$(".disablesell").css("display","none");
							$(".disablerent").css("display","block");
							$(".ageofconstruction").css("display","block");
							if($("#usertypeid option:selected").val() !=''){
								var username= $("#usertypeid option:selected").text();
								if(username=="Agent"){
									$(".disablerentbro").css("display","block");
								}
								}

			 <?php } }?>
            }
        });
		
		/* function call for plan code by ankit singh */
		 var PropertyID= $("#form1_id").val();
		 var userID= "<?=isset($userID)?$userID:''?>"; //alert(PropertyID);
		 
		 $.ajax({
				type: "POST",
				url : base_url+'AddProperty/GetUserplan',
				data: {PropertyID:PropertyID,userID:userID},
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(result){
					//alert(msg);	die;
					$("#loader").fadeOut();
					$('#userplan').html(result);
				});
		
		 <?php } ?>
		 
		 <?php if(!empty($purpose)){
			 if($purpose=="Sell"){ ?>
			 
							$(".price_as").html("Show Price As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Price <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Price & Other Charges");
							$(".disablerent").css("display","none");
							$(".disablesell").css("display","block");
							$(".disablerentbro").css("display","none");
							$(".ageofconstruction").css("display","none");
			 
		 
			 <?php }
			 if($purpose=="Rent"){ ?>
			 
			 $(".price_as").html("Show Rent As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Rent <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Rent & Other Charges");
							$(".disablesell").css("display","none");
							$(".disablerent").css("display","block");
							$(".ageofconstruction").css("display","block");
							if($("#usertypeid option:selected").val() !=''){
								var username= $("#usertypeid option:selected").text();
								if(username=="Agent"){
									$(".disablerentbro").css("display","block");
								}
								}

			 <?php } }?>
			 
			<?php if(!empty($propertyprice)){ ?>
				calculatepersqreft();
				<?php }?>
		 
		 
						// add handler to re-enable input boxes on click
						$("#checksell").click(function() {
							$("#loader").fadeIn();
							$(".price_as").html("Show Price As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Price <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Price & Other Charges");
							$(".disablerent").css("display","none");
							$(".dateshow").css("display","none");
							$(".available").css("display","none");
							$(".disablesell").css("display","block");
							$(".disablerentbro").css("display","none");
							$(".ageofconstruction").css("display","none");
							$(".calndr").css("display","none");
							$("#loader").fadeOut();
						});
						
						$("#checkrent").click(function() {
							$("#loader").fadeIn();
							$(".price_as").html("Show Rent As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Rent <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Rent & Other Charges");
							$(".disablesell").css("display","none");
							$(".dateshow").css("display","none");
							$(".available").css("display","none");
							$(".disablerent").css("display","block");
							$(".calndr").css("display","none");
							$(".ageofconstruction").css("display","block");
							if($("#usertypeid option:selected").val() !=''){
								var username= $("#usertypeid option:selected").text();
								if(username=="Agent"){
									$(".disablerentbro").css("display","block");
								}
								}
							$("#loader").fadeOut();
						});
						
						
						
						
						
					});
	 
	 /*Coding start for sell/rent */
	 
	 
	 
	
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
	<?php if(!empty($propertyLatitude)&& !empty($propertyLongitude)){ ?>
		function initialize() {
		var Lat= document.getElementById('lat').value; //alert(Lat); alert(Long);
		var Long= document.getElementById('lng').value; 
			 // var Lat=	Lats;		
			 //var Long=  longs;
			var mapCanvas = document.getElementById('map-canvas');
			var mapOptions = {
			  center: new google.maps.LatLng(Lat, Long),
			  zoom: 17,
			  mapTypeId: google.maps.MapTypeId.roadmap
			}
			 map = new google.maps.Map(mapCanvas, mapOptions);
			var latlng = new google.maps.LatLng(Lat,Long);
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				title: '',
				draggable: true
			});
			google.maps.event.addListener(marker, 'dragend', function (event) {
			document.getElementById("lat").value = this.getPosition().lat();
			document.getElementById("lng").value = this.getPosition().lng();
			});
		  }
		  google.maps.event.addDomListener(window, 'load', initialize);
		  <?php }else{ ?>
		  
		  function initialize() {
			var Lat= document.getElementById('lat').value; 
			var Long= document.getElementById('lng').value; 
			if(Lat=='' && Long=='')
			{
				var Lat='23.2326762';
				var Long='77.43004819999999';
			}
			 //alert(Lat); alert(Long);
			 // var Lat=	Lats;		
			 //var Long=  longs;
			var mapCanvas = document.getElementById('map-canvas');
			var mapOptions = {
			  center: new google.maps.LatLng(Lat, Long),
			  zoom: 17,
			  mapTypeId: google.maps.MapTypeId.roadmap
			}
			 map = new google.maps.Map(mapCanvas, mapOptions);
			var latlng = new google.maps.LatLng(Lat,Long);
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				title: '',
				draggable: true
			});
			google.maps.event.addListener(marker, 'dragend', function (event) {
			document.getElementById("lat").value = this.getPosition().lat();
			document.getElementById("lng").value = this.getPosition().lng();
			});
		  }
		  google.maps.event.addDomListener(window, 'load', initialize);
		  <?php }?>
		
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

<!-- /editor --> 

<script type="text/javascript">
//.attr("onclick","alert('fdgdg')").addClass("buttonFinish")
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
<script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a Project",
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
		
		

	
<script type="text/javascript">
  $(document).ready(function(){
        // Smart Wizard        
        $('#property_wizard').smartWizard({onLeaveStep:leaveAStepCallback});
  
      function leaveAStepCallback(obj){
		  
				var nextStepIdx= obj.attr('rel'); 
				var returntype=true;
				
				 
				
				var propertyPurpose = document.getElementsByName("propertyPurpose");
				
						var propertyPurposec = -1;

						for(var iiii=0; iiii < propertyPurpose.length; iiii++){
						   if(propertyPurpose[iiii].checked) {
							  propertyPurposec = iiii; 
							  
						   }
						}
						 
						if (propertyPurposec == -1){
							alert("Please Select Property Purpose");
							$(propertyPurposec).focus();
							return false;
						}
				
				
				
				
				var r = document.getElementsByName("individual");
				
				var c = -1;

						for(var i=0; i < r.length; i++){
						   if(r[i].checked) {
							  c = i; 
							  var typechekdval=$(".typechecking").val();
					
							if(typechekdval=='Property'){
								
								if($(".project-uni").val()==''){
									alert("Please Select Project");
									$(".project-uni").focus();
									returntype =false;
									return false;
								}
							}
						   }
						}
						 
						if (c == -1){
							alert("Please Select Property Is");
							return false;
						}
						
						
						var usertype = document.getElementsByName("usertype");
				
						var usertypec = -1;

						for(var ii=0; ii < usertype.length; ii++){
						   if(usertype[ii].checked) {
							  usertypec = ii; 
							  
						   }
						}
						 
						if (usertypec == -1){
							alert("Please Select User Type");
							$(usertype).focus();
							return false;
						}
				if($(".propertytype").val() == ''){
					
					alert("Please Select Property Type");
					$(".propertytype").focus();
					returntype =false;
					return false;
					
				}
				
				if($("#showuserlabel").val() == ''){
					
					alert("Please Select User");
					$("#showuserlabel").focus();
					returntype =false;
					return false;
					
				}
				
				if($("#userplan").val() == ''){
					
					alert("Please Select User Plan");
					$("#userplan").focus();
					returntype =false;
					return false;
					
				}
				
				if($("#descr").val() == ''){
					
					alert("Please Write Desciption");
					$("#descr").focus();
					returntype =false;
					return false;
					
				}
				
				if($("#bedroom")){
				if($("#bedroom").val() == ''){
					
					alert("Please Select Bedroom");
					$("#bedroom").focus();
					returntype =false;
					return false;
					
				}
				}
				
				
				
				if($("select[name=select-3]")){
					
				if($("select[name=select-3]").val() == ''){
					
					alert("Please Select Bathroom");
					$("select[name=select-3]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				if($("select[name=select-7]")){
					
				if($("select[name=select-7]").val() == ''){
					
					alert("Please Select Furnishing Status");
					$("select[name=select-7]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				
				if($("#coveredarea")){
				if($("#coveredarea").val() == ''){
					
					alert("Please Give BuildUp/Plot Area");
					$("#coveredarea").focus();
					returntype =false;
					return false;
					
				}
				}
				
				if($("input[name=text-154]")){
					
				if($("input[name=text-154]").val() == ''){
					
					alert("Please Give Carpet Area");
					$("input[name=text-154]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				
				if($("#expectedprice")){
				if($("#expectedprice").val() == ''){
					
					alert("Please Give Price");
					$("#expectedprice").focus();
					returntype =false;
					return false;
					
				}
				}
				
				if($("select[name=select-8]") !=''){
					
				if($("select[name=select-8]").val() == ''){
					
					alert("Please Select Sale Status");
					$("select[name=select-8]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				
				
				var currentstatus = document.getElementsByName("currentstatus");
				
						var currentstatusc = -1;
				if(currentstatus !=null){
						for(var iii=0; iii < currentstatus.length; iii++){
						   if(currentstatus[iii].checked) {
							  currentstatusc = iii; 
							  
						   }
						}
						 
						if (currentstatusc == -1){
							alert("Please Select Current Status");
							$(currentstatus).focus();
							return false;
						}
						
			}	
				
				if($('input[name=currentstatus]:checked').val() !='Under Construction'){
				
				if($("select[name=select-164]")){
					
				if($("select[name=select-164]").val() == ''){
					
					alert("Please Select Age Of Construction");
					$("select[name=select-164]").focus();
					returntype =false;
					return false;
					
				}
				}
				
	  }
				
				if($("select[name=year]").is(':visible')){
					
				if($("select[name=year]").val() == ''){
					
					alert("Please Select Year");
					$("select[name=year]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				if($("select[name=month]").is(':visible')){
					
				if($("select[name=month]").val() == ''){
					
					alert("Please Select Month");
					$("select[name=month]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				
				if($('input[name=propertyPurpose]:checked').val()=='Rent'){
				if($("select[name=select-165]")){
					
				if($("select[name=select-165]").val() == ''){
					
					alert("Please Select Food Preferences");
					$("select[name=select-165]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				if($("select[name=select-166]")){
					
				if($("select[name=select-166]").val() == ''){
					
					alert("Please Select Pets Allow");
					$("select[name=select-166]").focus();
					returntype =false;
					return false;
					
				}
				}
				
				if($("select[name=select-167]")){
					
				if($("select[name=select-167]").val() == ''){
					
					alert("Please Select Lease Type");
					$("select[name=select-167]").focus();
					returntype =false;
					return false;
					
				}
				}
				
	  }
				
				$(".showvalidation").each(function() {
				if($(this).is(':visible')){	
				if($(this).val() =='') {
						 
					$(this).focus() ;
					$(this).prop('class',' form-control parsley-error showvalidation') ;
					returntype =false;
					return false;
					   
				}else{
					$(this).prop('class',' form-control showvalidation') ;	
					returntype=true;
				}
				}	
				});
	 
				  
				  if(returntype==true){
					  InsertProperty(nextStepIdx); 
					 if(nextStepIdx==2){
				shownoofbedrooms(nextStepIdx);
					}
					if(nextStepIdx==3){
						showpreview(nextStepIdx);
					}
					 return returntype;
				  }
			  
       
      }
       
      /* function onFinishCallback(){
       if(validateAllSteps()){
        $('form').submit();
       }
      } */
       
               
      
  });
</script>