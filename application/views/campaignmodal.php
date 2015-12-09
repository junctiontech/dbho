<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
<h4 class="modal-title" id="myModalLabel">Campaign</h4>
</div>
<div class="modal-body">
<div class="x_content">

<div class="row">

<div class="x_content">
<table id="myTable" class="table table-bordered table-hover vert-aliins">
<thead>
<tr>
<th>Inventory</th>
<th>City</th>
<th>Qty</th>
<th>Duration </th>
<th>Remaining</th>
 
</tr>
</thead>
<tbody>
<?php foreach ($inventorylist as $inventorylists){ ?>
<tr>
<?php if(!empty($inventorylists->inventoryID)&&!empty($inventorylists->campaignID)&&!empty($inventorylists->userID)){
	$campaigninventorydetails=$this->inventory_model->campaigninventory_availablityquantity($inventorylists->inventoryID,$inventorylists->campaignID,$inventorylists->userID);
	if(!empty($campaigninventorydetails)){
		
		$remain=$inventorylists->duration-count($campaigninventorydetails);
		
	}
	}?>
<td><a <?php if(!empty($campaigninventorydetails)){if($remain==0){ ?> onclick="confirm('This Inventory Is Booked!!');" href="javascript:;" <?php }else{?>  href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>"  <?php }}else{?>  href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>" <?php }
?>><?=isset($inventorylists->inventoryDescription)?$inventorylists->inventoryDescription:''?></a></td>
<td><?=isset($inventorylists->cityName)?$inventorylists->cityName:''?></td>
<td><?=isset($inventorylists->quantity)?$inventorylists->quantity:''?></td>
<td><?=isset($inventorylists->duration)?$inventorylists->duration:''?></td>
<td><?=isset($remain)?$remain:$inventorylists->quantity?></td>
</tr>
<?php unset($remain);} ?>



 
 

</tbody>
</table>
</div>



<div class="x_content">
<table class="table table-bordered table-hover vert-aliins">
<thead>
<tr>
<th>Plan</th>
<th>Total QTY</th>
<th> Remaining Qty</th>
<th>Current Expiry Date</th>
 


</tr>
</thead>
<tbody>
<?php foreach ($planlist as $planlists){?>
<tr>
<td><?=isset($planlists->planTitle)?$planlists->planTitle:''?></td>
<td><?=isset($planlists->Quantity)?$planlists->Quantity:''?></td>
<td><?=isset($planlists->Quantity)?$planlists->Quantity:''?></td>
<td><?=isset($planlists->currentExpiry)?$planlists->currentExpiry:''?></td>

</tr>
<?php }?>



</tbody>
</table>
</div>
 

</div>

</div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
