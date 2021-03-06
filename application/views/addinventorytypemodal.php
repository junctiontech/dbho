<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Add Inventory Type</h4>
                    </div>
					
					<form method="post" onsubmit="return(checkvalidation())" action="<?=base_url();?>Inventory/Insertinventorytype" class="form-horizontal form-label-left">
<div class="modal-body">

<div class="x_content">
 
                                    <div class="row">
                                    
                                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory Name <span id="inventoryidmes"  aria-hidden="true"></span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="inventoryid" class="select2_group form-control" name="inventoryname">
                        <option value="">Select Name</option>
                       <?php foreach($inventoryname as $inventorynames){?>
                        <option value="<?=isset($inventorynames->inventorytypeID)?$inventorynames->inventorytypeID:''?>" ><?=isset($inventorynames->inventoryname)?$inventorynames->inventoryname:''?></option>
						<?php } ?>
                      </select>
                    </div>
                  </div>
                                    
									<div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Inventory Unit <span id="inventoryunitmes"  aria-hidden="true"></span></label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select onchange="fill();" id="inventoryunit" name="inventoryunit" class="select2_group form-control">
                                    <option value="Day">Day</option>
                                    </select>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Max (QTY) <span id="maxquanmes"  aria-hidden="true"></span></label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input onblur="fill();" id="maxquan" type="number" placeholder="Enter Quantity" name="maxquantity" value="" class="form-control">
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Overdrawing Allow <span id="overidmes"  aria-hidden="true"></span></label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select onchange="fill();" id="overid" name="overdrawingallow" class="select2_group form-control">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                    </select>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">City <span id="cityidmes"  aria-hidden="true"></span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select onchange="fill();" id="cityid" class="select2_group form-control" name="city_id">
                        <option value="">Select City</option>
                       <?php foreach($cities as $cities){?>
                        <option value="<?=isset($cities->cityID)?$cities->cityID:''?>" ><?=isset($cities->cityName)?$cities->cityName:''?></option>
						<?php } ?>
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
                    placeholder: "Select a state",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
				
				fill();
            });
        </script> 