<!-- page content -->
<?php //print_r($status);?>
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
			
		  <h3>
		  <?php 
		 	//echo "<li>".$RequestProperty;die;
			
			if(@$RequestProperties=='RequestProperties'){
			$action = 'RequestProperties';	
			?>
		Request Property Listing
			<?php } else { 
			$action = 'search'; 
			?>
			 Property Listing
			<?php } 
			?>
		  </h3>
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
                <form id="demo-form2" action="<?=base_url();?>AddProperty/PropertyListing/<?php echo $action;?>" method="post" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
				
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
                    <label class="control-label" for="first-name">Account</label>
                    <input type="text" id="first-name" name="account" value="<?=isset($account)?$account:''?>" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">Activated By</label>
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
					</select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-4 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>AddProperty/PropertyListing';" class="btn btn-primary">Reset</button>
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
                <h2>Listing </h2>
                
                <div class="clearfix"></div>
              </div>
              
              
              
              <div class="x_content">
				<style>
              
			  
              </style>
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table id="example" class="table table-striped jambo_table">
                  <thead>
                    <tr>
                      <th>Property Key</th>
                      <th>User Type</th>
                      <th>Property Name/Plan</th>
                      <th>Posted By/Activated By</th>
                      <th>Account</th>
                      <th>Date</th>
                      <th>Action</th>
                       <th>Appt</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
//echo "<pre>";print_r($propertylisting);

          $i=1; foreach($propertylisting as $propertylistings){ 
		  
		  $propertypostedbyId=$this->AddProperty_model->Getpropertylogdetails($propertylistings->propertyID,'Add');
		  
		  $propertyactivatedbyId=$this->AddProperty_model->Getpropertylogdetails($propertylistings->propertyID,'Active');
		 
		  $userIdpost=isset($propertypostedbyId[0]->userID)?$propertypostedbyId[0]->userID:'';$userIdactive=isset($propertyactivatedbyId[0]->userID)?$propertyactivatedbyId[0]->userID:'';
		  
						if(!empty($propertypostedbyId[0]->userAccessType)){ 
						if($propertypostedbyId[0]->userAccessType=='Admin'){
						$select="adminUserEmail as useremail";
						$from="rp_admin_users";$where="adminUserId=$userIdpost";
						$propertypostedby=$this->AddProperty_model->Getuserdetails($select,$from,$where); 
						
						}elseif($propertypostedbyId[0]->userAccessType=='Normal'){
						
						$select="userEmail as useremail";
						$from="rp_users";$where="userID=$userIdpost";
						$propertypostedby=$this->AddProperty_model->Getuserdetails($select,$from,$where);	
						}
						}
						
						if(!empty($propertyactivatedbyId[0]->userAccessType)){
						if($propertyactivatedbyId[0]->userAccessType=='Admin'){ 
						$select="adminUserEmail as useremail";
						$from="rp_admin_users";$where="adminUserId=$userIdactive";
						$propertyactivatedby=$this->AddProperty_model->Getuserdetails($select,$from,$where); 
						}elseif($propertyactivatedbyId[0]->userAccessType=='Normal'){
							
						$select="userEmail as useremail";
						$from="rp_users";$where="userID=$userIdactive";
						$propertyactivatedby=$this->AddProperty_model->Getuserdetails($select,$from,$where);	
						}
						}			
						
		  ?>
                    <tr>
                      <td><a href="http://<?=isset($severname)?$severname:''?>/india/en/sale/apartment-for-sale.htm/<?=isset($propertylistings->propertyKey)?$propertylistings->propertyKey:''?>/srchdet/preview/" target="_blank" ><?=isset($propertylistings->propertyKey)?$propertylistings->propertyKey:''?></a></td>
                      <td><?=isset($propertylistings->userTypeName)?$propertylistings->userTypeName:''?></td>
                      <td><?=isset($propertylistings->propertyName)?$propertylistings->propertyName:''?><br><?=isset($propertylistings->planTitle)?strtok($propertylistings->planTitle,' '):''?></td>
                      <td><?=isset($propertypostedby[0]->useremail)?$propertypostedby[0]->useremail:''?><br><?=isset($propertyactivatedby[0]->useremail)?$propertyactivatedby[0]->useremail:''?></td>
                      <td><?=isset($propertylistings->userEmail)?$propertylistings->userEmail:''?></td>
                      <td><?=isset($propertylistings->propertyAddedDate)?$propertylistings->propertyAddedDate:''?></td>
                       <td>
                       <div class="action-icons">
					   <?php 
					   if(count($status[$propertylistings->propertyID])){
					   if(($status[$propertylistings->propertyID][0]->appointmentStatus=='complete') || ($status[$propertylistings->propertyID][0]->appointmentStatus=='Complete')){
					   ?>
                       <a href="<?=base_url();?>AddProperty/index/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
					   <?php }
					   }else{?>
					   <a href="<?=base_url();?>AddProperty/index/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
					   <?php }?>
                       <a href="<?=base_url();?>AddProperty/PropertyLog/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Log" alt="Log"><i class="fa fa-archive"></i></a>
                       <a onclick="return confirm('Are You Sure To Delete This Property ?');" href="<?=base_url();?>AddProperty/PropertyAction/Delete/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Delete" alt="Delete"><i class="fa fa-trash"></i></a><br>
                       <a onclick="confirm('Refreshing Property Will Consumued Your One Listing. Are You Sure To Proceed ?');" href="<?=base_url();?>AddProperty/Propertyrefreshmodal/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>/Refresh/property" data-toggle="modal" data-target=".bs-example-modal-lg" title="Refresh" alt="Refresh"><i class="fa fa-refresh"></i></a>
                       <a <?php if($propertylistings->propertyStatus!="Active"){ ?> onclick="return confirm('Are You Sure To Activate This Property ?');" href="<?=base_url();?>AddProperty/PropertyAction/Active/<?=$propertylistings->propertyID?>" <?php }else{?> onclick="alert('This Property Is Already Active');"<?php }?> title="Active" alt="Active"><i class="fa fa-lightbulb-o"></i></a>
                       </div>
                       </td>
                       <td>
					   <?php
					   if($propertylistings->isVerified !=1){
					  ?>
					   
					   <a href="<?=base_url();?>Appointment/CreateAppointment/<?=isset($propertylistings->propertyID)?$propertylistings->userID:''?>/<?php echo $propertylistings->propertyID?>" title="Create Appointment">
                       <button type='button' value ='AddAppointment'><i class="fa fa-pencil-square-o"></i></button></a>
					   <?php } ?>
					   </td>
                       <td><i  <?php if($propertylistings->propertyStatus=="Active"){ echo 'title="Active" class="fa fa-check"'; }elseif($propertylistings->propertyStatus=="Draft"){ echo 'title="Draft" class="fa fa-archive"';}else{echo 'title="refresh" class="fa fa-refresh"';}?>></i></td>
                     
                    </tr>
				  <?php $i++; }?>
                    
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
      <!-- /page content --> 
      
     