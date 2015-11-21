
               
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Add User Plan</h4>
                    </div>
                    <div class="modal-body">
					<form class="form-horizontal form-label-left" action="<?=base_url();?>/manage_user_plan/adduserplan" method="post">
					<input id="nullall" type="hidden" name="planid" value="<?=isset($planid)?$planid:''?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan Title</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input id="nullall" type="text" placeholder="Plan title" name="plantitle" class="form-control" value="<?=isset($updateplan[0]->planTitle)?$updateplan[0]->planTitle:''?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan User Type</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <select id="nullall" class="select2_group form-control" name="planusertype">
                        <optgroup label="Plan User Type">
						<?php foreach($user_type as $user_type){?>
                        <option value="<?=$user_type->userTypeID?>" <?php if(!empty($updateplan[0]->userTypeID)){ if($updateplan[0]->userTypeID==$user_type->userTypeID){ echo"select";} } ?>><?=$user_type->userTypeName?></option>
						<?php } ?>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan Order</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input id="nullall" type="text" placeholder="order" class="form-control" name="planorder" value="<?=isset($updateplan[0]->planPrice)?$updateplan[0]->planPrice:''?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Plan Type</label>
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
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="planstatus" value="Active" <?php if(!empty($updateplan[0]->planStatus)){ if($updateplan[0]->planStatus=="Active"){ echo"checked";} } ?>>
                          &nbsp; Active &nbsp; </label>
                        <label class="btn btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input  type="radio" name="planstatus" value="Inactive" <?php if(!empty($updateplan[0]->planStatus)){ if($updateplan[0]->planStatus=="Inactive"){ echo"checked";} } ?>>
                          Inactive </label>
                    </div>
                      
                      
                      
                    </div>
                  </div>

                
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Save changes" name="submit"/>
                    </div>
					
					</form>
                    </div>
					
                  </div>
                
              