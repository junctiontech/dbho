<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Inventory Listing</h3>
          </div>
		  <style>
		  .modal99{z-index: 1000 !important;}
		  
		  </style>
          
		  <div class="modal modal99 fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Play Inventory</h4>
                    </div>
                    <div class="modal-body"></div>
                  </div>
                </div>
              </div>
		  
        </div>
        <div class="clearfix"></div>
        
        

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
              
              <div class="x_content">
                <form action="<?=base_url();?>Inventory/Inventory_listing/search" method="post" class="form-group form-label-left clearfix">
                <div class="row">
                 <!-- <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Campaign Name<span class="required"></span> </label>
                    <input type="text" id="first-name" placeholder="Enter Your Campaign Name" name="campaignname" class="form-control">
                  </div>-->
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">Inventory Type <span class="required"></span> </label>
                    <select class="select2_group form-control" name="inventoryname">
                    <option value="">Select Inventory Type</option>
					<option value="Project Gallery" <?php if(!empty($inventoryname)){ if($inventoryname=="Project Gallery"){ echo"selected";}}?>>Project Gallery</option>
					<option value="Project Of Month" <?php if(!empty($inventoryname)){ if($inventoryname=="Project Of Month"){ echo"selected";}}?>>Project Of Month</option>
					<option value="Hot Projects" <?php if(!empty($inventoryname)){ if($inventoryname=="Hot Projects"){ echo"selected";}}?>>Hot Projects</option>
					<option value="Featured Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="Featured Listing"){ echo"selected";}}?>>Featured Listing</option>
					<option value="RHS Project Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="RHS Project Listing"){ echo"selected";}}?>>RHS Project Listing</option>
					<option value="MLP Project Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="MLP Project Listing"){ echo"selected";}}?>>MLP Project Listing</option>
					<option value="MLP Property Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="MLP Property Listing"){ echo"selected";}}?>>MLP Property Listing</option>
					
                      </select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Status</label>
                    <select name="status" class="select2_group form-control">
                        
                        <option value="">Select status</option>
                        <option value="Created" <?php if(!empty($status)){ if($status=="Created"){ echo"selected";}}?>>Created</option>
						<option value="Started" <?php if(!empty($status)){ if($status=="Started"){ echo"selected";}}?>>Started</option>
						<option value="Paused" <?php if(!empty($status)){ if($status=="Paused"){ echo"selected";}}?>>Paused</option>
						<option value="Postponed" <?php if(!empty($status)){ if($status=="Postponed"){ echo"selected";}}?>>Postponed</option>
						<option value="Completed" <?php if(!empty($status)){ if($status=="Completed"){ echo"selected";}}?>>Completed</option>
						<option value="Cancelled" <?php if(!empty($status)){ if($status=="Cancelled"){ echo"selected";}}?>>Cancelled</option>
                       
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Company Name</label>
                    <input id="middle-name" class="form-control" type="text" name="companyname" value="<?=isset($companyname)?$companyname:''?>" placeholder="Enter Your Company Name">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Email ID</label>
                    <input id="middle-name" class="form-control" type="text" name="emailid" value="<?=isset($emailid)?$emailid:''?>" placeholder="Enter Your Email">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Weightage</label>
                    <select name="weightage" class="select2_group form-control">
                       
                        <option value="">Select weightage</option>
                        <option value="100" <?php if(!empty($weightage)){ if($weightage=="100"){ echo"selected";}}?>>100</option>
						<option value="200" <?php if(!empty($weightage)){ if($weightage=="200"){ echo"selected";}}?>>200</option>
						<option value="300" <?php if(!empty($weightage)){ if($weightage=="300"){ echo"selected";}}?>>300</option>
						<option value="400" <?php if(!empty($weightage)){ if($weightage=="400"){ echo"selected";}}?>>400</option>
						<option value="500" <?php if(!empty($weightage)){ if($weightage=="500"){ echo"selected";}}?>>500</option>
                        
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">City</label>
                    <select name="city" class="select2_group form-control">
                       
                        <option value="">Select city</option>
						<?php foreach($cities as $cities){?>
                        <option value="<?=isset($cities->cityID)?$cities->cityID:''?>" <?php if(!empty($city)){ if($city==$cities->cityID){ echo"selected";} } ?> <?php if(!empty($inventoryupdate[0]->City)){ if($inventoryupdate[0]->City==$cities->cityID){ echo"selected";} } ?>><?=isset($cities->cityName)?$cities->cityName:''?></option>
						<?php } ?>
                       
                      </select>
                  </div>
				  
				  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Project Name</label>
                    <input id="middle-name" class="form-control" type="text" name="projectname" value="<?=isset($projectname)?$projectname:''?>" placeholder="Enter Your Project Name">
                  </div>
				  
				  
				  
				  <div class="form-group col-xs-12 col-sm-3">
                          <label class="control-label" for="last-name">Start Date</label>
                          <div class="xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="startdate" value="<?=isset($startdate)?$startdate:''?>" id="calender01" placeholder="Enter Start Date" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" style="left:5px;" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                        </div>
				  
				  
				  <div class="form-group col-xs-12 col-sm-3">
                          <label class="control-label" for="last-name">End Date</label>
                          <div class="xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="enddate" value="<?=isset($enddate)?$enddate:''?>" id="calender02" placeholder="Enter End Date" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" style="left:5px;" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                        </div>
                  
                  <div class="form-group col-xs-12 col-sm-4 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>Inventory/Inventory_listing';" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
                   <button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
                  </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
                        $(document).ready(function () {
                            $('#calender01').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
								minDate: new Date() ,
								startDate: new Date()
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
						$(document).ready(function () {
                            $('#calender02').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script> 
        <div class="clearfix"></div>
        
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Inventory table </h2>
                
                <div class="clearfix"></div>
              </div>
			  <?php if(!empty($inventory_list)){?>
              <div class="x_content table-responsive">
                <table class=" table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Campaign Name </th>
                      <th>Company Name</br>Email ID</br>Mobile No</th>
                       <th>Inventory Type</th>
                      <th>City</th>
                      <th>Project/Property Name</th>
                      <th>Start-End</br>Date</th>
                      <th>Dur</th>
                      <th>WGT</th>
                      <th></th>
					  <th>View</th>
                     
                    </tr>
                  </thead>
                  <tbody>
				  <?php  foreach($inventory_list as $inventory_list){?>
                    <tr>
                      <td><?php if(!empty($inventory_list->CampaignID)){ $campaign_name=$this->utilities->get_campaign_name($inventory_list->CampaignID); echo $inventory_list->userCompanyName; echo isset($campaign_name[0]->created)?$campaign_name[0]->created:'';}?></td>
                      <td><?=isset($inventory_list->userCompanyName)?$inventory_list->userCompanyName:''?></br><?=isset($inventory_list->userEmail)?$inventory_list->userEmail:''?></br><?=isset($inventory_list->userPhone)?$inventory_list->userPhone:''?></td>
                      
                      <td><?=isset($inventory_list->inventoryname)?$inventory_list->inventoryname:''?></td>
                      <td><?=isset($inventory_list->cityName)?$inventory_list->cityName:''?></td>
					  
					  <?php  if(!empty($inventory_list->ProjectID)){
						 
						  if($inventory_list->inventoryname=='MLP Property Listing'){ 
							  $propertyname=$this->inventory_model->get_property(" and rp_properties.propertyID=$inventory_list->ProjectID"); ?>
							   <td><?=isset($propertyname[0]->propertyName)?$propertyname[0]->propertyName:''?></td>
						 <?php }else{ 
							   $projectname=$this->inventory_model->get_project(" and rp_projects.projectID=$inventory_list->ProjectID");
							   ?>
							   <td><?=isset($projectname[0]->projectName)?$projectname[0]->projectName:''?></td>
							   <?php
						  }
						  
					  }?>
                      
                      <td><?=isset($inventory_list->StartDate)?$inventory_list->StartDate:''?>-<?php if(!empty($inventory_list->StartDate) && !empty($inventory_list->Duration)){ $duro=$inventory_list->Duration-1; $date = strtotime("$duro day", strtotime($inventory_list->StartDate));echo date("m/d/Y", $date); }?></td>
                       <td><?=isset($inventory_list->Duration)?$inventory_list->Duration:''?></td>
                        <td><?=isset($inventory_list->Weightage)?$inventory_list->Weightage:''?></td>
                       <td>
					   <?php if(!empty($inventory_list->Status)){ 
					   if($inventory_list->Status=='Paused'){ ?>
                       <a href="<?=base_url();?>Inventory/PlayInventoryModal/<?=isset($inventory_list->planinventoryconsumptionID)?$inventory_list->planinventoryconsumptionID:''?>" data-toggle="modal" data-target=".bs-example-modal-lg"  class="btn btn-app paddpsush">
                       <i class="fa fa-play"></i></a>
					   <?php }elseif($inventory_list->Status=='Created' || $inventory_list->Status=='Started'){ ?>
                       <a href="<?=base_url();?>Inventory/PausedInventory/<?=isset($inventory_list->planinventoryconsumptionID)?$inventory_list->planinventoryconsumptionID:''?>" class="btn btn-app paddpsush">
                       <i class="fa fa-pause"></i></a>
					   <?php } } ?>
                       </td>
					   <td><?php if(!empty($inventory_list->Status)){ 
					   if($inventory_list->Status=='Completed'){ echo"Completed"; }else{ ?><a href="<?=base_url();?>Inventory/index/<?=isset($inventory_list->planinventoryconsumptionID)?$inventory_list->planinventoryconsumptionID:''?>" class="btn btn-app paddpsush"> <i class="fa fa-edit"></i></a><?php }}?></td>
                    </tr>
				  <?php }?>
                    </tbody>
                </table>
              </div>
             <?php  }else{ ?>
				 
				<div class="alert alert-danger" >
				<strong>No Result Found!!</strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
				</div>
				
				  <?php } ?>
             <!-- <div class="valusho pull-left"> <h5>Compaign Amount :  Rs 335090 </h5></div>
              <div class="valusho pull-right"> <button class="btn btn-info btn-lg" type="button">Create</button></div>-->
            </div>
                  
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
			
			
			$(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
        target.removeData('bs.modal')
              .find(".modal-content").html('');
    });
	
	 $(document).ajaxSend(function(event, request, settings) {
   
   $("#loader").fadeIn();
});

$(document).ajaxComplete(function(event, request, settings) {
   $("#loader").fadeOut();
});
        </script> 
<!-- /select2 --> 

