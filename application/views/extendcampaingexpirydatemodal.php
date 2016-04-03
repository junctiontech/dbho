<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel"><center>Extend Campaign</center><div class="alert alert-danger" >
	<strong>Extending Campaign Expiry Date Will Only Extend Inventory Expiry Date, It Has No Impact On Plan Expiry Date.</strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
	</div></h4>
                    </div>
<div class="modal-body">
					<form class="form-horizontal form-label-left" action="<?=base_url();?>/Campaign/Insertnewexpirydate" method="post">
					<input type="hidden" name="campaignID" value="<?=isset($campaignID)?$campaignID:''?>" />
                  
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">New Expiry Date <span id="planordermes"  aria-hidden="true"></span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input required readonly id="single_cal2" type="text" name="newexpirydate" class="form-control has-feedback-left" value=""   placeholder="Select Date" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
					  </div>
                  </div>
                  
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Confirm" name="submit"/>
					  
                    </div>
					
					</form>
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