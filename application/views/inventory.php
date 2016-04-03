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
           <form class="form-horizontal form-label-left" onsubmit="return(checkvalidation())" action="<?=base_url();?>Inventory/Add_inventory" method="post" enctype="multipart/form-data">
           
           
			<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Type</label>
			<div class="col-md-6 col-sm-10 col-xs-12">
                    <label class="control-label"><?php if(!empty($campaignid) ||!empty($inventoryupdate[0]->CampaignID)){ echo"Campaign";}else{echo"Free";}?> </label>
            </div>
			</div>
			
		   <?php if(!empty($inventoryconsumptionid)){?>
				<input type="hidden" name="inventoryconsumptionid" value="<?=isset($inventoryconsumptionid)?$inventoryconsumptionid:''?>" readonly />
		   <?php } ?>
		   
           <?php if(!empty($campaignid) ){?>
				<input type="hidden" name="campaignid" value="<?=$campaignid?>" readonly />
				<input type="hidden" name="user_id"  value="<?=isset($campaigndetails[0]->userID)?$campaigndetails[0]->userID:''?>" readonly />
				<input type="hidden" name="inventoryid"  value="<?=isset($campaigndetails[0]->inventoryID)?$campaigndetails[0]->inventoryID:''?>" readonly />
				<input type="hidden" name="cityid" value="<?=isset($campaigndetails[0]->cityID)?$campaigndetails[0]->cityID:''?>" readonly />
				
                <div class="form-group ">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Campaign Name</label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12"><?=isset($campaigndetails[0]->userCompanyName)?$campaigndetails[0]->userCompanyName:''?> <?=isset($campaigndetails[0]->created)?$campaigndetails[0]->created:''?></label>
                    </div>
                </div>
				
				<div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Company Name</label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12"><?=isset($campaigndetails[0]->userCompanyName)?$campaigndetails[0]->userCompanyName:''?> <?=isset($campaigndetails[0]->userEmail)?$campaigndetails[0]->userEmail:''?> </label>
                    </div>
                </div>
				
				<div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory</label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                       <label class="control-label col-md-2 col-sm-2 col-xs-12 " id="inventory"><?=isset($campaigndetails[0]->inventoryname)?$campaigndetails[0]->inventoryname:''?></label>
                    </div>
                </div>
				
				
		   <?php }else{ ?> 
		   
				<div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Company Name <span id="user_idmes"  aria-hidden="true"></span></label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();getprojectname();" id="user_id" class="select2_group form-control"  name="user_id" <?php if(!empty($inventoryupdate)){ echo"enable='true'";}?>>
                        <option value="">Select Company Name</option>
						<?php foreach($company_name as $company_name){?>
                        <option value="<?=isset($company_name->userID)?$company_name->userID:''?>" <?php if(!empty($inventoryupdate[0]->UserID)){ if($inventoryupdate[0]->UserID==$company_name->userID){ echo"selected";} } ?>><?=isset($company_name->userCompanyName)?$company_name->userCompanyName:''?> <?=isset($company_name->userEmail)?$company_name->userEmail:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
		   
				 <div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory <span id="inventoryidmes"  aria-hidden="true"></span></label>
                    <div  class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();getcityforcalendarinventory(this.value);getprojectname();" id="inventoryid"  class=" form-control inventory" name="inventoryid" >
                        <option value="">Select Inventory</option>
						<?php foreach($inventory as $inventory){?>
                        <option value="<?=isset($inventory->inventorytypeID)?$inventory->inventorytypeID:''?>" <?php if(!empty($inventoryupdateid[0]->inventorytypeID)){ if($inventoryupdateid[0]->inventorytypeID==$inventory->inventorytypeID){ echo"selected";} } ?>><?=isset($inventory->inventoryname)?$inventory->inventoryname:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
                  
		   <?php } ?> 
                  
                  
           
           <div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">City <span id="city_idmes"  aria-hidden="true"></span></label>
                    <div id="inventorycity" class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="city_id" class="select2_group form-control" name="cityid" <?php if(!empty($campaigndetails[0]->cityID)){ echo"disabled ='true'"; } ?> >
                        <option value="">Select City</option>
                       <?php foreach($cities as $cities){?>
                        <option value="<?=isset($cities->cityID)?$cities->cityID:''?>" <?php if(!empty($campaigndetails[0]->cityID)){ if($campaigndetails[0]->cityID==$cities->cityID){ echo"selected";} } ?> <?php if(!empty($inventoryupdate[0]->City)){ if($inventoryupdate[0]->City==$cities->cityID){ echo"selected";} } ?>><?=isset($cities->cityName)?$cities->cityName:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
           
           
           <div class="form-group pdbottom10 propertyprojectdiv">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name <span id="project_idmes"  aria-hidden="true"></span></label>
                    <div id="projectname" class="col-md-6 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="project_id" class="select2_group form-control" name="project_id">
                        <option value="">Select Project</option>
                         <?php foreach($projects as $projects){?>
                        <option value="<?=isset($projects->projectID)?$projects->projectID:''?>" <?php if(!empty($inventoryupdate[0]->ProjectID)){ if($inventoryupdate[0]->ProjectID==$projects->projectID){ echo"selected";} } ?>><?=isset($projects->projectName)?$projects->projectName:''?></option>
						<?php } ?>
                     </select>
                    </div>
                  </div>
           
		   
		   
                  <div class="form-group pdbottom10">
				  <input type="hidden" name="image1" id="imageshidden" value="<?=isset($inventoryupdate[0]->BannerImagePath)?$inventoryupdate[0]->BannerImagePath:''?>"/>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner Image <span id="inputImagemes"  aria-hidden="true"></span></label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                      <label class="btn btn-default btn-upload" for="inputImage" title="Upload image file">
                                        <input onchange="fill();" class="sr-only" id="inputImage" name="file" type="file" value="" accept="image/*">
                                        
                                          <span class="brous-bt"  id="inputImagemes1"><?php if(!empty($inventoryupdate[0]->BannerImagePath)){?><img style="height:100px;width:100px" src="http://staging.homeonline.com/public/uploads/projectOfMonth/<?=isset($inventoryupdate[0]->BannerImagePath)?$inventoryupdate[0]->BannerImagePath:''?>" alt="Banner Image"/> <?php }else{ ?>Browse<?php } ?></span>
                                       
                                      </label>
									 
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Start Date <span id="startdatemes"  aria-hidden="true"></span></label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input  readonly onchange="fill();"  <?php if(!empty($inventoryupdate)){ echo"readonly  id='start'";}else{echo"id='single_cal2'";}?> type="text" name="start_date" class="form-control has-feedback-left" value="<?=isset($inventoryupdate[0]->StartDate)?$inventoryupdate[0]->StartDate:''?>"   placeholder="Select Date" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                  
                  <div class="form-group pdbottom10">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Duration <span id="durationmes"  aria-hidden="true"></span></label>
                    <div class="col-md-6 col-sm-10 col-xs-12 contxt">
                     <input  onblur="fill();" id="duration" type="text" placeholder="" class="form-control" <?php if(!empty($campaigndetails[0]->duration)){ echo"readonly"; } ?> value="<?=isset($campaigndetails[0]->duration)?$campaigndetails[0]->duration:''?><?=isset($Duration)?$Duration:''?>" <?php if(!empty($inventoryupdate)){ echo"readonly";}?> name="duration">
                    </div>
                  </div>
                  
                  
				  <div class="form-group pdbottom10">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Weightage <span id="weightagemes"  aria-hidden="true"></span></label>
                                    <div class="col-md-6 col-sm-10 col-xs-12">
                                    <select onchange="fill();" id="weightage"  name="weightage" class=" form-control">
									<option value="">Select Weightage</option>
                                    <option value="100" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="100"){ echo"selected";} } ?>>100</option>
									<option value="200" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="200"){ echo"selected";} } ?>>200</option>
									<option value="300" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="300"){ echo"selected";} } ?>>300</option>
									<option value="400" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="400"){ echo"selected";} } ?>>400</option>
									<option value="500" <?php if(!empty($inventoryupdate[0]->Weightage)){ if($inventoryupdate[0]->Weightage=="500"){ echo"selected";} } ?>>500</option>
                                    </select>
                                    </div>
                                    </div>
                  
                  <div class="form-group ">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Remark</label>
                    <div class="col-md-6 col-sm-10 col-xs-12">
                     <textarea id="message"  class="form-control"  name="remark" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=isset($inventoryupdate[0]->Remark)?$inventoryupdate[0]->Remark:''?></textarea>
                    </div>
                  </div>
                  
                 <div class="form-group pdbottom10">
				 
				  <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
				   <div class="col-md-5 col-sm-10 col-xs-12">
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
			
			fill();
			
			$("#inputImage").change(function(e) {

     for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        
        var file = e.originalEvent.srcElement.files[i];
        
        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
             img.src = reader.result;
        }
        reader.readAsDataURL(file);
		$("#inputImagemes1").html('');
        $("#inputImagemes1").append(img);
		  $(img)
                    .width(100)
                    .height(100); 
    } 
	
	
	
});
             
        });
		
		
		//validation start..........................................................................

function checkvalidation(){
	
		if(document.getElementById('user_id')){
		if(document.getElementById('user_id').value == "" )
    	{
    			 document.getElementById('user_id').focus() ;
				 document.getElementById('user_id').placeholder="Please Select company!" ;
				 document.getElementById('user_id').setAttribute('class',' form-control  parsley-error') ;
				 return false;
    	}
		}
		
		if(document.getElementById('inventoryid')){
		if(document.getElementById('inventoryid').value == "" )
    	{
    			 document.getElementById('inventoryid').focus() ;
				 document.getElementById('inventoryid').placeholder="Please select Inventory!" ;
				 document.getElementById('inventoryid').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		}
		
		if(document.getElementById('city_id').value == "" )
    	{
    			 document.getElementById('city_id').focus() ;
				 document.getElementById('city_id').placeholder="Please select City!" ;
				 document.getElementById('city_id').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		if(document.getElementById('project_id').value == "" )
    	{
    			 document.getElementById('project_id').focus() ;
				 document.getElementById('project_id').placeholder="Please select Project!" ;
				 document.getElementById('project_id').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		if(document.getElementById('inputImage').value == "" )
    	{
			if($("#imageshidden").val()==""){
					
    			 
				
			if($("#inventoryid option:selected").text()=='Project Of Month'){
					
    			 document.getElementById('inputImage').focus() ;
				 document.getElementById('inputImage').placeholder="Please Choose Image!" ;
				 document.getElementById('inputImage').setAttribute('class','parsley-error sr-only') ;
				$('#inputImagemes1').html("Browse Your Image");
				document.getElementById('inputImagemes1').setAttribute('class','fa fa-times') ;
				document.getElementById('inputImagemes1').style.color='red';
				 return false;
				}
				
				if($.trim($("#inventory").text())=="Project Of Month"){
					
    			 document.getElementById('inputImage').focus() ;
				 document.getElementById('inputImage').placeholder="Please Choose Image!" ;
				 document.getElementById('inputImage').setAttribute('class','parsley-error sr-only') ;
				$('#inputImagemes1').html("Browse Your Image");
				document.getElementById('inputImagemes1').setAttribute('class','fa fa-times') ;
				document.getElementById('inputImagemes1').style.color='red';
				 return false;
				}
			}
				
    	}
		if(document.getElementById('single_cal2').value == "" )
    	{
    			 document.getElementById('single_cal2').focus() ;
				 document.getElementById('single_cal2').placeholder="Please Choose Date!" ;
				 document.getElementById('single_cal2').setAttribute('class',' form-control has-feedback-left parsley-error') ;
				 return false;
    	}
		if(document.getElementById('duration').value == "" )
    	{
    			 document.getElementById('duration').focus() ;
				 document.getElementById('duration').placeholder="Please Provide Duration!" ;
				 document.getElementById('duration').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		if(document.getElementById('weightage').value == "" )
    	{
    			 document.getElementById('weightage').focus() ;
				 document.getElementById('weightage').placeholder="Please Select Weightage!" ;
				 document.getElementById('weightage').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		
	return( true );
	
} 


function fill(){
	
		if(document.getElementById('user_id')){
		if(document.getElementById('user_id').value != "" )
    	{
    			 document.getElementById('user_idmes').setAttribute('class','required fa fa-check') ;
				 document.getElementById('user_idmes').style.color='green' ;
				 document.getElementById('user_id').setAttribute('class',' form-control ') ;
    	}
		}
		if(document.getElementById('inventoryid')){
		if(document.getElementById('inventoryid').value != "" )
    	{
    			  document.getElementById('inventoryidmes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('inventoryidmes').style.color='green';
				  document.getElementById('inventoryid').setAttribute('class',' form-control ') ;
    	}
		}
		if(document.getElementById('city_id')){
		if(document.getElementById('city_id').value != "" )
    	{
    			  document.getElementById('city_idmes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('city_idmes').style.color='green';
				  document.getElementById('city_id').setAttribute('class',' form-control ') ;
    	}
		}
		if(document.getElementById('project_id').value != "" )
    	{
    			  document.getElementById('project_idmes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('project_idmes').style.color='green';
				  document.getElementById('project_id').setAttribute('class',' form-control ') ;
    	}
		if(document.getElementById('inputImage').value != "" )
    	{
    			  document.getElementById('inputImagemes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('inputImagemes').style.color='green';
				  document.getElementById('inputImage').setAttribute('class',' sr-only ') ;
				  $('#inputImagemes1').html("Browse");
				  document.getElementById('inputImagemes1').setAttribute('class','brous-bt') ;
				  document.getElementById('inputImagemes1').style.color='#333';
    	}
		if(document.getElementById('single_cal2'))
    	{
			if(document.getElementById('single_cal2').value !="" ){
    			  document.getElementById('startdatemes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('startdatemes').style.color='green';
				  document.getElementById('single_cal2').setAttribute('class',' form-control has-feedback-left') ;
			}	  
    	}else{
					if(document.getElementById('start').value !="" ){
    			  document.getElementById('startdatemes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('startdatemes').style.color='green';
				
			}
			
		}
		if(document.getElementById('duration').value != "" )
    	{
    			  document.getElementById('durationmes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('durationmes').style.color='green';
				  document.getElementById('duration').setAttribute('class',' form-control ') ;
    	}
		if(document.getElementById('weightage').value != "" )
    	{
    			  document.getElementById('weightagemes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('weightagemes').style.color='green';
				  document.getElementById('weightage').setAttribute('class',' form-control ') ;
    	}
}
	
     

		
    </script> 
