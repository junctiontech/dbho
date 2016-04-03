<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
		<h4 class="modal-title" id="myModalLabel">Plan Consumption</h4>
		<div class="row" >
			<div class="alert alert-danger" >
				<div align="center"><strong>Refreshing project with selected plan will consume your one listing...</strong></div> <?php //echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
			</div>
		</div> 
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
		<form class="form-horizontal form-label-left" action="<?=base_url();?>/AddProject/StatusUpdate" method="post">
			<input type="hidden" name="PlanType" value="<?php if(isset($this->data['PlaneType'])){ echo $this->data['PlaneType']; }?>" />
			<input type="hidden" name="status" value="Refresh" />
			<input type="hidden" name="objectID" value="<?=isset($this->data['objectID'])?$this->data['objectID']:''?>" />
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12"> User Plan <span id="planordermes"  aria-hidden="true"></span></label>
				<div class="col-md-9 col-sm-9 col-xs-12"> 
					<fieldset>
						<div class="control-group">
							<div class="form-group col-xs-12 col-sm-6 martop20"> 
								<select class="select2_group form-control" name="UserPlaneDetail" >
								   <option value="0">Select</option>
									 <?php if(!is_null($PlanDetails)){ //print_r($PlanDetails);die;
									 foreach($PlanDetails as $list){ 
									 ?> 
									<option value="<?php echo $list->planID; ?>" <?php if(!empty($this->data['objectID'])){ $PlaneDetail=$this->AddProject_model->GetMultipleData('rp_dbho_plan_mapping',array('objectID'=>$this->data['objectID'],'objectType'=>$this->data['PlaneType'])); if(isset($PlaneDetail[0]->planID)&& $PlaneDetail[0]->planID==$list->planID){ echo 'selected'; } } ?> ><?php  echo ucwords(str_replace('_', ' ', $list->planTitle)); ?></option>
									<?php } }else{ ?> 
									<option>No Plan</option>
									<?php } ?>
							   </select>
							</div>
						</div>
						<div class="control-group">
							<div class="form-group col-xs-12 col-sm-6 martop20"> 
								<input type="checkbox" name="adminconsumption" >Admin Refresh(without Consumption)
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
			  <input type="submit" class="btn btn-primary" value="Consume Plan" name="submit" onclick="return confirm('If With Out Check Admin Refresh Click Ok Then One Plan Redused In Your Project...');"/>
			</div>
		</form>
	</div>
</div>
          