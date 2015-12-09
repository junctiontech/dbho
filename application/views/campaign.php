<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Create Campaign</h3>
          </div>
          
        </div>
		 
        <div class="clearfix"></div>
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
        
        <div class="clearfix"></div>
		<!-- Alert section For Message-->
		 <?php  if($this->session->flashdata('message_type')=='success') { ?>
		  <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('message')?></strong>  </div>
		 <?php } if($this->session->flashdata('message_type')=='error') { ?>
		 <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong><?=$this->session->flashdata('message')?></strong>  </div>
		 <?php } ?>
		 <!-- Alert section End-->
        <div class="row">
        
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
             <form  method="post" action="<?=base_url();?>campaign/addcampaign"  class="form-group form-label-left clearfix">
            <div class="x_content">
               
                  <div class="row">
                    <div class="form-group col-xs-12 col-sm-3">
                      <label class="control-label" for="first-name">Campaign Start Date <span class="required">*</span> </label>
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input readonly name="campaignstartdate" required value="" type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Select Date" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
					
					 <div class="form-group col-xs-12 col-sm-3">
                      <label class="control-label" for="last-name">Company Name<span class="required">*</span> </label>
                      <select required class="select2_group form-control" id="userid" name="user_id" onchange="get_usertype(this.value);get_plans(this.value);">
                        
                        <option value="">Select Company Name</option>
						<?php foreach($company_name as $company_name){?>
                        <option value="<?=isset($company_name->userID)?$company_name->userID:''?>"><?=isset($company_name->userCompanyName)?$company_name->userCompanyName:''?></option>
						<?php } ?>
                       
                      </select>
                    </div>
					
                    <div class="form-group col-xs-12 col-sm-3">
                      <label class="control-label" for="last-name">User Type <span class="required">*</span> </label>
                      
					   <input id="user_type" readonly name=""   value="" type="text" class="form-control has-feedback-left" >
                    </div>
                   
                    <!--<div class="form-group col-xs-12 col-sm-3 martop20">
                      
                    <button type="submit" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success">Search</button>
          
                    </div>-->
                  </div>
                 <!-- <div class="ln_solid"></div>-->
                 
               
              </div>
              <div id="showhidden"  style="pointer-events:none">
              <div class="row" >
        
          <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="row">
         
            <div class="x_content">
                <table id="myTable" class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                     <th>Inventory</th>
                      <th>City</th>
                      <th>Qty</th>
                      <th>Duration (Days) </th>
                      <th>Amount (Rs)</th>
                      <th><button class="btn btn-success" type="button" onclick="displayResult()">Add</button></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <td><div class="form-group col-xs-12 col-sm-12">
                      <select required name="inventoryid[]" class="select2_group form-control" onchange="getcityforinventory(this.value);">
                        <option value="">Select Inventory</option>
                        <?php foreach($inventory as $inventory1){?>
                        <option value="<?=isset($inventory1->inventorytypeID)?$inventory1->inventorytypeID:''?>"><?=isset($inventory1->inventoryDescription)?$inventory1->inventoryDescription:''?></option>
						<?php } ?>
                       
                      </select>
                    </div></td>
                      <td>
                      <div id="inventorycity" class="form-group col-xs-12 col-sm-12">
                      <select required name="cityid[]" class="select2_group form-control">
                        <option value="">Select City</option>
                        <?php foreach($cities as $cities1){?>
                        <option value="<?=isset($cities1->cityID)?$cities1->cityID:''?>"><?=isset($cities1->cityName)?$cities1->cityName:''?></option>
						<?php } ?>
                      </select>
                    </div></td>
                      <td>
                      <div class="form-group col-xs-12 col-sm-4">
                      <input required name="inventoryquantity[]" type="text" placeholder="" class="form-control">
                    </div></td>
                      <td><div class="form-group col-xs-12 col-sm-6">
                      <input required name="inventoryduration[]" type="text" placeholder="" class="form-control">
                    </div></td>
                      <td>
                      <div class="form-group col-xs-12 col-sm-6">
                      <input required   name="inventoryamount[]" type="text" placeholder="" class="form-control txt">
                    </div>
                      </td>
                      
                      <td><p>Remove</p></td>
                      
                    </tr>
                    
                    
                    
                    
                   
                   
                    
                  </tbody>
                </table>
              </div>
          

    
          
              
              
    </div>
    
        </div>
    
      </div>
             
              <div class="x_content"  >
                <table id="myTable1" class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Plan</th>
                      <th>Qty</th>
                      <th>Duration (Days)</th>
                      <th>Amount (Rs)</th>
                      <th>Carry forward (Qty)</th>
                      <th>Last Expiry</th>
                      <th>Current Expiry Date</th>
					  <th><button class="btn btn-success" type="button" onclick="displayResult1();get_plans(document.getElementById('userid').value,document.getElementById('myTable1').rows.length);">Add</button></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div id="user_plans" class="form-group col-xs-12 col-sm-12">
                      <select onchange="checkplanavailable(this.value,this.id)" id="plan_0" required name="planid[]" class="select2_group form-control">
                        
                        <option value=""> Select Plan</option>
                        <?php foreach($plan as $plan1){?>
                        <option value="<?=isset($plan1->planID)?$plan1->planID:''?>"><?=isset($plan1->planTitle)?$plan1->planTitle:''?></option>
						<?php } ?>
                        
                      </select>
                    </div></td>
                      <td><input required name="planquantity[]" type="text" placeholder="" class="form-control"></td>
                      <td><input required onblur="calculateexpirydate(this.value,this.id)" id="dura_0" name="planduration[]" type="text" placeholder="" class="form-control"></td>
                      <td class="d"><input   required name="planamount[]" type="text" placeholder="" class="form-control txt"></td>
                      <td class="d"><input name="plancarryforwrd[]" id="carrayforword_0" type="text" placeholder="" class="form-control"></td>
                      <td><input readonly name="lastexpiryplan[]" id="lastexpiry_0" type="text" placeholder="" class="form-control lastexpiry"></td>
                      <td><input readonly name="currentexpiryplan[]" id="expira_0"  type="text" placeholder="" class="form-control currentexpiry"></td>
					  <td><p>Remove</p></td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
            
                
                <input readonly name="currentexpiry" id="currentexpiry" type="hidden" placeholder="" class="form-control">
                <div class="clearfix"></div>
         
               <div class="valusho pull-left"> <button class="btn btn-info btn-lg" type="submit" name="submit" value="submit">Create</button></div>
              <div class="valusho pull-right"> <h5> Compaign Amount :  Rs <span id="sum">0.00</span> </h5></div>
              </div>
           </form>
                  
          </div>
          
    
        </div>
      </div>
      
       <div class="clearfix"></div>
        
      </div></div>
      <!-- /page content --> 
      
    
<!-- select2 --> 
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
<!-- /select2 --> 

<script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script> 
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
	
	<script type="text/javascript">


function displayResult()
{
	
	if(document.getElementById("inventorycity") != null) {
	document.getElementById("inventorycity").setAttribute("id","old_inventorycity");}
document.getElementById("myTable").insertRow(-1).innerHTML = '<td><div  class="form-group col-xs-12 col-sm-12"><select onchange="getcityforinventory(this.value);" required name="inventoryid[]" class="select2_group form-control">  <option value="">Select Inventory</option><?php foreach($inventory as $inventory1){?><option value="<?=isset($inventory1->inventorytypeID)?$inventory1->inventorytypeID:''?>"><?=isset($inventory1->inventoryDescription)?$inventory1->inventoryDescription:''?></option><?php } ?> </select></div></td><td><div id="inventorycity" class="form-group col-xs-12 col-sm-12"><select required name="cityid[]" class="select2_group form-control"> <option value="">Select City</option><?php foreach($cities as $cities1){?> <option value="<?=isset($cities1->cityID)?$cities1->cityID:''?>"><?=isset($cities1->cityName)?$cities1->cityName:''?></option><?php } ?></select></div></td><td> <div class="form-group col-xs-12 col-sm-6"> <input required name="inventoryquantity[]" type="text" placeholder="" class="form-control"></div></td> <td><div class="form-group col-xs-12 col-sm-6"><input required name="inventoryduration[]" type="text" placeholder="" class="form-control"></div></td><td> <div class="form-group col-xs-12 col-sm-6"><input onkeyup="calculateSum();"  required name="inventoryamount[]" type="text" placeholder="" class="form-control txt"></div> </td><td><p>Remove</p></td>';
}
$('#myTable').on('click','td p',function(){
$(this).closest('tr').remove();
calculateSum();
});



</script>

<script type="text/javascript">


function displayResult1()
{
	
	if(document.getElementById("user_plans") != null) {
		
	document.getElementById("user_plans").setAttribute("id","old_user_plans");
	
}	
		
				var table=document.getElementById("myTable1");
    			var rowCount=table.rows.length;
    			var	last_row = rowCount+1;
    			
document.getElementById("myTable1").insertRow(-1).innerHTML = '<td><div id="user_plans" class="form-group col-xs-12 "><select required name="planid[]" class="select2_group form-control"> <option value=""> Select Plan</option><?php foreach($plan as $plan1){?><option value="<?=isset($plan1->planID)?$plan1->planID:''?>"><?=isset($plan1->planTitle)?$plan1->planTitle:''?></option><?php } ?> </select> </div></td><td><input required name="planquantity[]" type="text" placeholder="" class="form-control"></td> <td><input required onblur="calculateexpirydate(this.value,this.id)" id="dura_'+last_row+'" name="planduration[]" type="text" placeholder="" class="form-control"></td> <td class="d"><input onkeyup="calculateSum();"  required name="planamount[]" type="text" placeholder="" class="form-control txt"></td> <td class="d"><input name="plancarryforwrd[]" id="carrayforword_'+last_row+'" type="text" placeholder="" class="form-control"></td> <td><input readonly name="lastexpiryplan[]" id="lastexpiry_'+last_row+'" type="text" placeholder="" class="form-control lastexpiry"></td><td><input readonly name="currentexpiryplan[]" id="expira_'+last_row+'" type="text" placeholder="" class="form-control currentexpiry"></td><td><p>Remove</p></td>';

}

$('#myTable1').on('click','td p',function(){
		
$(this).closest('tr').remove();

calculateSum();
//calculateexpirydate();

});

</script>
