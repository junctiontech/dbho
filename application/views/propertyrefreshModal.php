<div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
	  <h4 class="modal-title" id="myModalLabel"><center>Refresh Property</center> <div class="alert alert-danger" >
	<strong>Refreshing Property Will Consumued Your One Listing.!!</strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
	</div></h4>
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
		<form class="form-horizontal form-label-left" action="<?=base_url();?>/AddProperty/PropertyAction/Refresh/<?=isset($propertyID)?$propertyID:''?>" method="post">
			
			<div class="row">
			
			<div class="form-group col-xs-12 col-sm-3 ">
				 <label class="control-label" for="last-name">User Plan</label>
					<select class="select2_group form-control" name="userplanID" >
								   <option value="">Select Plan</option>
									 <?php if(!empty($userplan)){ 
									 foreach($userplan as $list){ 
									 ?> 
									<option value="<?php echo $list->planID; ?>" <?php if(!empty($oldplan)){  if($oldplan==$list->planID){ echo 'selected'; } } ?> ><?php  echo ucwords(str_replace('_', ' ', $list->planTitle)); ?></option>
									<?php } }else{ ?> 
									<option value=''>No Active Plan Found</option>
									<?php } ?>
					</select>
							
			</div>
			
			<div class="form-group col-xs-12 col-sm-6 ">
                          <label style="display:block;" class="control-label" for="last-name">&nbsp;</label>
                          <label style="margin-top:10px;">
                            <input type="checkbox" name="withplan"  value="Yes"  class="flat" />
                            Admin Refresh( WithOut Consumption)</label>
                        </div>
			</div>
			
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <input type="submit" class="btn btn-primary" value="Refresh Property" name="submit"/>
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
			
			$(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });
        </script> 