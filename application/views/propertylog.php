<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Property Log</h3>
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
        
        <div class="clearfix"></div>
        
		<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
                <h2>Filter </h2>
                
                <div class="clearfix"></div>
              </div>
				 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                       
                    </div>
                    <div class="modal-body">
					 </div>
					
                  </div>
                </div>
              </div>
            
        <div class="x_content">
                <form id="demo-form2" action="<?=base_url();?>AddProperty/PropertyLog/search" method="post" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
				<input type="hidden" readonly value="<?=isset($propertyID)?$propertyID:''?>" name="propertyID"/>
				
				<div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">Property Name</label>
                    <input type="text" id="first-name" name="propertyName" value="<?=isset($propertyName)?$propertyName:''?>" class="form-control">
                  </div>
				  
					<div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">Property Key</label>
                    <input type="text" id="first-name" name="propertykey" value="<?=isset($propertykey)?$propertykey:''?>" class="form-control">
                  </div>
				
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">User Type</label>
                    
					<select class="select2_group form-control" name="usertype">
                    <option value="">Select User Type</option>
					<option value="Agent" <?php if(!empty($usertype)){ if($usertype=="Agent"){ echo"selected";}}?>>Agent</option>
					<option value="Builder" <?php if(!empty($usertype)){ if($usertype=="Builder"){ echo"selected";}}?>>Builder</option>
					<option value="Individual" <?php if(!empty($usertype)){ if($usertype=="Individual"){ echo"selected";}}?>>Individual</option>
					</select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Property Name</label>
                    <input type="text" id="first-name" name="account" value="<?=isset($account)?$account:''?>" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">Edit By</label>
                    <input type="text" id="first-name" name="activatedby" value="<?=isset($activatedby)?$activatedby:''?>" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Plan</label>
                     
                  <select id="first-name" name="plan" class="form-control">
						<option value="">Select Plan</option>
						<?php foreach($plandetails as $plandetails){?>
						<option value="<?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?>" <?php  if(!empty($plan)){   if($plan==$plandetails->planTypeTitle
						){ echo"selected";} } ?>><?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?></option>
						<?php } ?>
					</select>
				  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Status</label>
                    <select class="select2_group form-control" name="status">
                    <option value="">Select Status</option>
					<option value="Active" <?php if(!empty($status1)){ if($status1=="Active"){ echo"selected";}}?>>Active</option>
					<option value="Inactive" <?php if(!empty($status1)){ if($status1=="Inactive"){ echo"selected";}}?>>Inactive</option>
					<option value="Draft" <?php if(!empty($status1)){ if($status1=="Draft"){ echo"selected";}}?>>Draft</option>
					<option value="Requested" <?php if(!empty($status1)){ if($status1=="Requested"){ echo"selected";}}?>>Requested</option>
					<option value="Deleted" <?php if(!empty($status1)){ if($status1=="Deleted"){ echo"selected";}}?>>Deleted</option>
					<option value="Edit" <?php if(!empty($status1)){ if($status1=="Edit"){ echo"selected";}}?>>Edit</option>
					<option value="Refresh" <?php if(!empty($status1)){ if($status1=="Refresh"){ echo"selected";}}?>>Refresh</option>
					<option value="Admin Refresh" <?php if(!empty($status1)){ if($status1=="Admin Refresh"){ echo"selected";}}?>>Admin Refresh</option>
					</select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-4 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>AddProperty/PropertyLog';" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
				   <button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
                  </div>

                  </div>

                </form>
              </div>
              </div>
              </div>
              </div>
        
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Logs</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table id="example" class="table table-striped jambo_table">
                  <thead>
                    <tr>
                      <th>Property</th>
                      <th>Edited By</th>
                      <th>Plan Type</th>
                      <th>Date &amp; Time</th>
                      <th>Action Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach($log_details as $log_detailss){
						$userId=$log_detailss->userID;
						if($log_detailss->userAccessType=='Admin'){ 
						$select="adminUserEmail as useremail";
						$from="rp_admin_users";$where="adminUserId=$userId";
						$userdetails=$this->AddProperty_model->Getuserdetails($select,$from,$where); 
						}elseif($log_detailss->userAccessType=='Normal'){
						$select="userEmail as useremail";
						$from="rp_users";$where="userID=$userId";
						$userdetails=$this->AddProperty_model->Getuserdetails($select,$from,$where);	
						}
						?>
                    <tr>
                      <td><?=isset($log_detailss->propertyName)?$log_detailss->propertyName:''?></td>
					  <td><?=isset($userdetails[0]->useremail)?$userdetails[0]->useremail:''?></td>
                      <td><?=isset($log_detailss->planTitle)?$log_detailss->planTitle:''?></td>
                      <td><?=isset($log_detailss->createdOn)?$log_detailss->createdOn:''?></td>
                       <td> <?=isset($log_detailss->actionType)?$log_detailss->actionType:''?></td>
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
      
     