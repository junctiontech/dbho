
               
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Add User Plan</h4>
                    </div>
                    <div class="modal-body">
					<form class="form-horizontal form-label-left" action="<?=base_url();?>/manage_user_plan/adduserplan" method="post">
					<input type="hidden" name="planid" value="<?=isset($planid)?$planid:''?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan Type</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
                      <select onchange="get_planpriority(this.value);" id="plantittle" class="select2_group form-control" name="plantitle">
                        <optgroup label="Select Plan">
						<option>Select Plan</option>
						<?php foreach($plandetails as $plandetails){?>
                        <option value="<?=isset($plandetails->planTypeID)?$plandetails->planTypeID:''?>-<?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?>" <?php  if(!empty($updateplan[0]->planTitle)){   if($plantypeid==$plandetails->planTypeID
						){ echo"selected";} } ?>><?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan User Type</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <select id="plantype" class="select2_group form-control" name="planusertype" >
                        <optgroup label="Plan User Type">
						<option>Select User Type</option>
						<?php foreach($user_type as $user_type){?>
                        <option value="<?=$user_type->userTypeID?>" <?php if(!empty($updateplan[0]->userTypeID)){ if($updateplan[0]->userTypeID==$user_type->userTypeID){ echo"selected";} } ?>><?=$user_type->userTypeName?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan Order</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input id="planorder" type="text" readonly placeholder="order" class="form-control" name="planorder" value="<?=isset($updateplan[0]->planPrice)?$updateplan[0]->planPrice:''?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 ">Plan Type</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                     <div style="padding: 5px 0">
                      <ul class="list-inline">
                  <li>
                    <input  type="checkbox" name="plantype" id="hobby1" <?php if(!empty($updateplan[0]->plantype)){ if($updateplan[0]->plantype=="project"){ echo"checked";} } ?> value="project" data-parsley-mincheck="1"  class="flat" />
                    Project</li>
                    <li>
                    <input  type="checkbox" name="plantype" id="hobby2" <?php if(!empty($updateplan[0]->plantype)){ if($updateplan[0]->plantype=="property"){ echo"checked";} } ?> value="property" class="flat" />
                    Property</li>
                    
                    
                    </ul>
                    </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div id="gender" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default <?php if(!empty($updateplan[0]->planStatus)){ if($updateplan[0]->planStatus=="Active"){ echo"active";} } ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="planstatus" value="Active" <?php if(!empty($updateplan[0]->planStatus)){ if($updateplan[0]->planStatus=="Active"){ echo"checked";} } ?>>
                          &nbsp; Active &nbsp; </label>
                        <label class="btn btn btn-default <?php if(!empty($updateplan[0]->planStatus)){ if($updateplan[0]->planStatus=="Inactive"){ echo"active";} } ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input  type="radio" name="planstatus" value="Inactive" <?php if(!empty($updateplan[0]->planStatus)){ if($updateplan[0]->planStatus=="Inactive"){ echo"checked";} } ?>>
                          Inactive </label>
                    </div>
                      
                      
                      
                    </div>
                  </div>
					<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Auto Generated Plan Title</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input id="shownewtittle" type="text" readonly placeholder="New Plan Title" class="form-control"  value="<?=isset($updateplan[0]->planTitle)?$updateplan[0]->planTitle:''?>">
                    </div>
                  </div>
                <script>
$("#plantype").change(function(){    

    var plantype = $("#plantype option:selected").text();
	var plantittle = $("#plantittle option:selected").text();
	var newtittle = plantittle +' For '+ plantype;
	document.getElementById('shownewtittle').value=newtittle;
});

$("#plantittle").change(function(){    

    var plantype = $("#plantype option:selected").text();
	var plantittle = $("#plantittle option:selected").text();
	var newtittle = plantittle +' For '+ plantype;
	document.getElementById('shownewtittle').value=newtittle;
});
</script>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Save changes" name="submit"/>
                    </div>
					
					</form>
                    </div>
					
                  </div>
                
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