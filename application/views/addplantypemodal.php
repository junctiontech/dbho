<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Add Listing Type</h4>
                    </div>
					 <form method="post" onsubmit="return(checkvalidation())" action="<?=base_url();?>manage_user_plan/Insertplantype" class="form-horizontal form-label-left">
                    <div class="modal-body">
                      <div class="x_content">

                                    <div class="row">
                                    
                                    <input type="hidden" value="<?=isset($updateplantype[0]->planTypeID)?$updateplantype[0]->planTypeID:''?>" name="plantypeid"/>
                                    
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Plan Title <span id="plantitlemes"  aria-hidden="true"></span></label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="plantitle" onblur="fill()" name="plantitle" value="<?=isset($updateplantype[0]->planTypeTitle)?$updateplantype[0]->planTypeTitle:''?>" type="text" placeholder="Enter Plan Title" class="form-control ">
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Plan Priority <span id="planmes" aria-hidden="true"></span></label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select onchange="fill()" id="planpri" name="planpriority" class=" form-control">
									<option value="">Select Priority</option>
                                    <option value="100" <?php if(!empty($updateplantype)){ if($updateplantype[0]->Priority==100){ echo"selected";}}?>>100</option>
									<option value="200" <?php if(!empty($updateplantype)){ if($updateplantype[0]->Priority==200){ echo"selected";}}?>>200</option>
									<option value="300" <?php if(!empty($updateplantype)){ if($updateplantype[0]->Priority==300){ echo"selected";}}?>>300</option>
									<option value="400" <?php if(!empty($updateplantype)){ if($updateplantype[0]->Priority==400){ echo"selected";}}?>>400</option>
									<option value="500" <?php if(!empty($updateplantype)){ if($updateplantype[0]->Priority==500){ echo"selected";}}?>>500</option>
                                    </select>
                                    </div>
                                    </div>
                                    
                                   </div>

                                </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <input type="submit" class="btn btn-primary" value="Save changes" name="submit"/>
                    </div>
                  </form>
				  
				  
				  <script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a priority",
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