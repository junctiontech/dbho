<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        
        <div class="clearfix"></div>
		<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <form action="<?=base_url();?>Manage_user_plan/PlanConsumptionLog/search<?php if(!empty($campaignid)){ echo"/"; echo $campaignid; }?>" method="post" class="form-group form-label-left clearfix">
                  <div class="row">
				  
				  <div class="form-group col-xs-12 col-sm-2">
                      <label for="middle-name" class="control-label">Campaign Name</label>
                      <input name="campaignname" type="text" placeholder="Enter Your Campaign" class="form-control" value="<?=isset($campaignname)?$campaignname:''?>">
                    </div>
					
                    <div class="form-group col-xs-12 col-sm-2">
                      <label for="middle-name" class="control-label">Comapny name</label>
                      <input name="companyname" type="text" placeholder="Company" class="form-control" value="<?=isset($companyname)?$companyname:''?>">
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-2">
                    <label for="middle-name" class="control-label">Listing Type</label>
					<select id="middle-name" class="form-control" name="listingtype">
						<option value=''>Select</option>
						<option value='project' <?php if(!empty($listingtype)){ if($listingtype=='project'){ echo"selected";}}?>>Project</option>
						<option value='property' <?php if(!empty($listingtype)){ if($listingtype=='property'){ echo"selected";}}?>>Property</option>
					</select>
                  </div>
					
					 
					<div class="form-group col-xs-12 col-sm-2">
                    <label class="control-label" for="first-name">Plan Name </label>
                    <select id="first-name" name="planname" class="form-control">
						<option value="">Select</option>
						<?php foreach($plandetails as $plandetails){?>
						<option value="<?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?>" <?php  if(!empty($planname)){   if($planname==$plandetails->planTypeTitle
						){ echo"selected";} } ?>><?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?></option>
						<?php } ?>
					</select>
                  </div>
                    
                    <div class="form-group col-xs-12 col-sm-2 martop20">
						
						<button type="button" onclick="location.href = '<?=base_url();?>Manage_user_plan/PlanConsumptionLog/<?php if(!empty($campaignid)){ echo"Campaign/"; echo $campaignid; }?>';" class="btn btn-primary">Reset</button>
						
						<button type="submit" name='submit' class="btn btn-success" value="Search">Search</button>
						
						<button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
          
                    </div>
                  </div>
                 <!-- <div class="ln_solid"></div>-->
                 
                  
                </form>
              </div>
            </div>
          </div>
        </div>
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
        
        <div class="clearfix"></div>
        
        
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Plan Consumption Log</h2>
                 
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table id="example" class="table table-striped jambo_table">
                  <thead>
                    <tr>
                      <th>Plan Name</th>
					  <th>Campaign Name</th>
					  <th>Project/Property</th>
					  <th>Object</th>
                      <th>Edited By</th>
                      <th>Date &amp; Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach($log_details as $log_detailss){?>
                    <tr>
                      <td><?=isset($log_detailss->planTitle)?$log_detailss->planTitle:''?> </td>
                      <td><?=isset($log_detailss->userCompanyName)?$log_detailss->userCompanyName:''?> <?=isset($log_detailss->created)?$log_detailss->created:''?></td>
                      <?php if(!empty($log_detailss->objectType) && !empty($log_detailss->objectID)){ 
								if($log_detailss->objectType=='project'){
									$filter=array('projectID'=>$log_detailss->objectID,'languageID'=>'1');
									$objectname=$this->manage_user_plan_model->get_object_name('rp_project_details','projectName',$filter);
								}elseif($log_detailss->objectType=='property'){
									$filter=array('propertyID'=>$log_detailss->objectID,'languageID'=>'1');
									$objectname=$this->manage_user_plan_model->get_object_name('rp_property_details','propertyName',$filter);
								}
					  } ?>
					  <td><?=isset($objectname[0]->name)?$objectname[0]->name:''?></td>
					  <td><?=isset($log_detailss->objectType)?$log_detailss->objectType:''?></td>
					  <td><?=isset($log_detailss->createdBy)?$log_detailss->createdBy:''?></td>
                      <td><?=isset($log_detailss->createdon)?$log_detailss->createdon:''?></td>
                       <td><?=isset($log_detailss->UnitconsumuedType)?$log_detailss->UnitconsumuedType:''?></td>
                      </tr>
                    <?php } ?>
                    
                    
                    
                    

                  </tbody>
                </table>
                </div>
              </div>
              
              
              
              
              
              
              
            </div>
                  
          </div>
          
    
        </div>
      </div>
	  
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
      <!-- /page content --> 
      
     