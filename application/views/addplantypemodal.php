
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
                                    <input required name="planpriority" type="text" placeholder="Enter Plan Priority" class="form-control">
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