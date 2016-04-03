<div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Play Inventory</h4>
                    </div>
					
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
		 
                    <div class="modal-body">
					<form class="form-horizontal form-label-left" action="<?=base_url();?>/Inventory/PlayInventoryCreation" method="post">
					<input type="hidden" name="planinventoryconsumptionID" value="<?=isset($planinventoryconsumptionID)?$planinventoryconsumptionID:''?>" />
                  
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date <span id="planordermes"  aria-hidden="true"></span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input  readonly id="single_cal2" type="text" name="start_date" class="form-control has-feedback-left" value=""   placeholder="Select Date" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
					  </div>
                  </div>
                  
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Play Inventory" name="submit"/>
                    </div>
					
					</form>
                    </div>
					
                  </div>
                
             <script type="text/javascript">
        $(document).ready(function () {
            
            $('#single_cal2').datepicker({
                singleDatePicker: true,
				startDate: new Date(),
				calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
			
			
             
        });
        </script>  