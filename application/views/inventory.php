<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Inventory</h3>
          </div>
          
        </div>
        <div class="clearfix"></div>
        
        

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
           
           
			<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Type</label>
			<div class="col-md-10 col-sm-10 col-xs-12">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"> <label class="control-label col-md-2 col-sm-2 col-xs-12"><?php if(!empty($campaignid) ||!empty($inventoryupdate[0]->CampaignID)){ echo"Campaign";}else{echo"Fee";}?> </label></label>
            </div>
			</div>
			
		   <?php if(!empty($inventoryconsumptionid)){?>
				<input type="hidden" name="inventoryconsumptionid" value="<?=isset($inventoryconsumptionid)?$inventoryconsumptionid:''?>" readonly />
		   <?php } ?>
		   
           <?php if(!empty($campaignid) ){?>
				<input type="hidden" name="campaignid" value="<?=$campaignid?>" readonly />
				<input type="hidden" name="user_id" value="<?=isset($campaigndetails[0]->userID)?$campaigndetails[0]->userID:''?>" readonly />
				<input type="hidden" name="inventoryid" value="<?=isset($campaigndetails[0]->inventoryID)?$campaigndetails[0]->inventoryID:''?>" readonly />
				<input type="hidden" name="city_id" value="<?=isset($campaigndetails[0]->cityID)?$campaigndetails[0]->cityID:''?>" readonly />
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Campaign Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12"><?=isset($campaigndetails[0]->userCompanyName)?$campaigndetails[0]->userCompanyName:''?> <?=isset($campaigndetails[0]->created)?$campaigndetails[0]->created:''?></label>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Company Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12"><?=isset($campaigndetails[0]->userCompanyName)?$campaigndetails[0]->userCompanyName:''?> </label>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12"><?=isset($campaigndetails[0]->inventoryDescription)?$campaigndetails[0]->inventoryDescription:''?> </label>
                    </div>
                </div>
				
				
		   <?php }else{ ?> 
		   
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Company Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control" required name="user_id" <?php if(!empty($inventoryupdate)){ echo"enable='true'";}?>>
                        <option value="">Select Company Name</option>
						<?php foreach($company_name as $company_name){?>
                        <option value="<?=isset($company_name->userID)?$company_name->userID:''?>" <?php if(!empty($inventoryupdate[0]->UserID)){ if($inventoryupdate[0]->UserID==$company_name->userID){ echo"selected";} } ?>><?=isset($company_name->userCompanyName)?$company_name->userCompanyName:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
		   
				 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select required  class="select2_group form-control" name="inventoryid" >
                        <option value="">Select Inventory</option>
						<?php foreach($inventory as $inventory){?>
                        <option value="<?=isset($inventory->inventorytypeID)?$inventory->inventorytypeID:''?>" <?php if(!empty($inventoryupdateid[0]->inventorytypeID)){ if($inventoryupdateid[0]->inventorytypeID==$inventory->inventorytypeID){ echo"selected";} } ?>><?=isset($inventory->inventoryDescription)?$inventory->inventoryDescription:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
                  
		   <?php } ?> 
                  
                  
           
           <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">City</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select required class="select2_group form-control" name="city_id" <?php if(!empty($campaigndetails[0]->cityID)){ echo"disabled ='true'"; } ?> >
                        <option value="">Select City</option>
                       <?php foreach($cities as $cities){?>
                        <option value="<?=isset($cities->cityID)?$cities->cityID:''?>" <?php if(!empty($campaigndetails[0]->cityID)){ if($campaigndetails[0]->cityID==$cities->cityID){ echo"selected";} } ?> <?php if(!empty($inventoryupdate[0]->City)){ if($inventoryupdate[0]->City==$cities->cityID){ echo"selected";} } ?>><?=isset($cities->cityName)?$cities->cityName:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
           
           
           <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select required class="select2_group form-control" name="project_id">
                        <option value="">Select Project</option>
                         <?php foreach($projects as $projects){?>
                        <option value="<?=isset($projects->projectID)?$projects->projectID:''?>" <?php if(!empty($inventoryupdate[0]->ProjectID)){ if($inventoryupdate[0]->ProjectID==$projects->projectID){ echo"selected";} } ?>><?=isset($projects->projectName)?$projects->projectName:''?></option>
						<?php } ?>
                     </select>
                    </div>
                  </div>
           
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner Image</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <label class="btn btn-default btn-upload" for="inputImage" title="Upload image file">
                                        <input required class="sr-only" id="inputImage" name="file" type="file" value="<?=isset($inventoryupdate[0]->BannerImagePath)?$inventoryupdate[0]->BannerImagePath:''?>" accept="image/*">
                                        
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
                              <input  readonly required <?php if(!empty($inventoryupdate)){ echo"readonly";}else{echo"id='single_cal2'";}?> type="text" name="start_date" class="form-control has-feedback-left" value="<?=isset($inventoryupdate[0]->StartDate)?$inventoryupdate[0]->StartDate:''?>"   placeholder="Select Date" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Duration</label>
                    <div class="col-md-10 col-sm-10 col-xs-12 contxt">
                     <input  required type="text" placeholder="" class="form-control" <?php if(!empty($campaigndetails[0]->duration)){ echo"readonly"; } ?> value="<?=isset($campaigndetails[0]->duration)?$campaigndetails[0]->duration:''?><?=isset($inventoryupdate[0]->Duration)?$inventoryupdate[0]->Duration:''?>" <?php if(!empty($inventoryupdate)){ echo"readonly";}?> name="duration">
                    </div>
                  </div>
                  
                  
				  <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Weightage</label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select required="required" name="weightage" class="select2_group form-control">
									<option>Select Weightage</option>
                                    <option value="100" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="100"){ echo"selected";} } ?>>100</option>
									<option value="200" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="200"){ echo"selected";} } ?>>200</option>
									<option value="300" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="300"){ echo"selected";} } ?>>300</option>
									<option value="400" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="400"){ echo"selected";} } ?>>400</option>
									<option value="500" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="500"){ echo"selected";} } ?>>500</option>
                                    </select>
                                    </div>
                                    </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Remark</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                     <textarea id="message" required="required" class="form-control"  name="remark" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=isset($inventoryupdate[0]->Remark)?$inventoryupdate[0]->Remark:''?></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                     <button class="btn btn-success btn-lg" type="submit" value="submit" name="submit"><?php if(!empty($inventoryupdate)){echo"Update";}else{echo"Save";}?></button>
                    </div>
                  </div>
                  
                  
                  
                 </form>
          
          </div>
          </div>
      </div>
      <!-- /page content --> 
      
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


<script type="text/javascript">
        $(document).ready(function () {
            
            $('#single_cal2').datepicker({
                singleDatePicker: true,
				startDate: new Date(),
				calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
             
        });
		
    </script> 
