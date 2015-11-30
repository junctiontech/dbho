<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
<h4 class="modal-title" id="myModalLabel">Inventory</h4>
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
<?php foreach ($inventorylist as $inventorylists){?>
<tr>
<td><a href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>"><?=isset($inventorylists->inventoryDescription)?$inventorylists->inventoryDescription:''?></a></td>
<td><?=isset($inventorylists->cityName)?$inventorylists->cityName:''?></td>
<td><?=isset($inventorylists->quantity)?$inventorylists->quantity:''?></td>
<td><?=isset($inventorylists->duration)?$inventorylists->duration:''?></td>
<td><?=isset($inventorylists->duration)?$inventorylists->duration:''?></td>
</tr>
<?php } ?>



 
 

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
<button type="button" class="btn btn-primary">Save changes</button>
</div>
