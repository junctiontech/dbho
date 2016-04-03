<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
<h4 class="modal-title" id="myModalLabel"><?=isset($campaignname[0]->userCompanyName)?$campaignname[0]->userCompanyName:''?> <?=isset($campaignname[0]->created)?$campaignname[0]->created:''?>    <a class="btn btn-success"   href="<?=base_url();?>Inventory/Inventorylog/Campaign/<?=isset($campaignname[0]->campaignID)?$campaignname[0]->campaignID:''?>" >View Inventory Log</a>  <a class="btn btn-success"   href="<?=base_url();?>Manage_user_plan/PlanConsumptionLog/Campaign/<?=isset($campaignname[0]->campaignID)?$campaignname[0]->campaignID:''?>" >View Listing Log</a>
						
</h4>
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
<th>Schedule Inventory</th>
</tr>
</thead>
<tbody>
<?php $exdate=''; $currentdate=''; if(!empty($campaignname[0]->expiry_date_campaign)){ $exdate=strtotime($campaignname[0]->expiry_date_campaign); $currentdate=strtotime(date("m/d/Y"));} foreach ($inventorylist as $inventorylists){ ?>
<tr>
<?php if(!empty($inventorylists->inventoryID)&&!empty($inventorylists->campaignID)&&!empty($inventorylists->userID)){
	//$campaigninventorydetails=$this->inventory_model->campaigninventory_availablityquantity($inventorylists->inventoryID,$inventorylists->campaignID,$inventorylists->userID);
	//if(!empty($campaigninventorydetails)){
		
		$remain=$inventorylists->quantity-$inventorylists->UnitsConsumed;
		
	//}
	}?>
<td><a <?php if(!empty($inventorylists)){if($remain==0){ ?> onclick="confirm('This Inventory Is Consumued!!');" href="javascript:;" <?php }elseif($exdate<$currentdate){ ?> onclick="confirm('This Campaign Is Expired!!');" href="javascript:;" <?php }else{?>  href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>"  <?php }}else{?>  href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>" <?php }
?>><?=isset($inventorylists->inventoryname)?$inventorylists->inventoryname:''?></a></td>
<td><?=isset($inventorylists->cityName)?$inventorylists->cityName:''?></td>
<td><?=isset($inventorylists->quantity)?$inventorylists->quantity:''?></td>
<td><?=isset($inventorylists->duration)?$inventorylists->duration:''?></td>
<td><?=isset($remain)?$remain:$inventorylists->quantity?></td>
<td><div class="action-icons">
                       <a <?php if(!empty($inventorylists)){if($remain==0){ ?> onclick="confirm('This Inventory Is Consumued!!');" href="javascript:;" <?php }elseif($exdate<$currentdate){ ?> onclick="confirm('This Campaign Is Expired!!');" href="javascript:;" <?php }else{?>  href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>"  <?php }}else{?>  href="<?=base_url();?>Inventory/index/<?=isset($inventorylists->inventoryID)?$inventorylists->inventoryID:''?>/<?=isset($inventorylists->campaignID)?$inventorylists->campaignID:''?>" <?php }
?>><i class="fa fa-wrench"></i></a></div></td>
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
<?php if(!empty($planlists->Quantity)){
	$remainplan=$planlists->Quantity-$planlists->plan_unitconsumed;
	}?>
<td><?=isset($planlists->planTitle)?$planlists->planTitle:''?></td>
<td><?=isset($planlists->Quantity)?$planlists->Quantity:''?></td>
<td><?=isset($remainplan)?$remainplan:''?></td>
<td><?=isset($planlists->currentExpiry)?$planlists->currentExpiry:''?></td>

</tr>
<?php unset($remainplan); }?>



</tbody>
</table>
</div>
 

</div>

</div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
<span style="float: left;">Sales Person: <?=isset($campaignname[0]->soldBy)?$campaignname[0]->soldBy:''?></span>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>

<script type="text/javascript">
                        $(document).ready(function () {
                            $('#calender01').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
						
                    </script> 