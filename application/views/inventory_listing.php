 <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Inventory Listing</h3>
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
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Inventory Name <span class="required"></span> </label>
                    <input type="text" id="first-name" name="inventoryname" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">Campaign Type <span class="required"></span> </label>
                    <select class="select2_group form-control">
                        <option>select Campaign Type</option>
                      </select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Status</label>
                    <select name="status" class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="">select status</option>
                        <option value="Created">Created</option>
						<option value="Started">Started</option>
						<option value="Paused">Paused</option>
						<option value="Postponed">Postponed</option>
						<option value="Completed">Completed</option>
						<option value="Cancelled">Cancelled</option>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Company Name</label>
                    <input id="middle-name" class="form-control" type="text" name="companyname">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Email ID</label>
                    <input id="middle-name" class="form-control" type="text" name="emailid">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Weightage</label>
                    <select name="weightage" class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="">select weightage</option>
                        <option value="100">100</option>
						<option value="200">200</option>
						<option value="300">300</option>
						<option value="400">400</option>
						<option value="500">500</option>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">City</label>
                    <select name="city" class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="">select city</option>
						<?php foreach($cities as $cities){?>
                        <option value="<?=isset($cities->cityID)?$cities->cityID:''?>" <?php if(!empty($campaigndetails[0]->cityID)){ if($campaigndetails[0]->cityID==$cities->cityID){ echo"selected";} } ?> <?php if(!empty($inventoryupdate[0]->City)){ if($inventoryupdate[0]->City==$cities->cityID){ echo"selected";} } ?>><?=isset($cities->cityName)?$cities->cityName:''?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>Inventory/Inventory_listing';" class="btn btn-primary">Reset</button>
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
                       <td><?php if(!empty($inventory_list->StartDate) && !empty($inventory_list->Duration)){ $duro=$inventory_list->Duration-1; $date = strtotime("$duro day", strtotime($inventory_list->StartDate));echo date("m/d/Y", $date); }?></td>
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

