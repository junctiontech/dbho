
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Add Plan Type</h4>
                    </div>
					 <form method="post" action="<?=base_url();?>manage_user_plan/Insertplantype" class="form-horizontal form-label-left">
                    <div class="modal-body">
                      <div class="x_content">

                                    <div class="row">
                                    
                                    
                                    
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Plan Title</label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input required name="plantitle" type="text" placeholder="Enter Plan Title" class="form-control">
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Plan Priority</label>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select name="planpriority" class="select2_group form-control">
									<option>Select Priority</option>
                                    <option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
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
            });
        </script> 