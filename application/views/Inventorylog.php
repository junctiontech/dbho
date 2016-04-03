<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        
        <div class="clearfix"></div>
		<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              
              <div class="x_content">
                <form action="<?=base_url();?>Inventory/Inventorylog/search<?php if(!empty($campaignid)){ echo"/"; echo $campaignid; }?>" method="post" class="form-group form-label-left clearfix">
                  <div class="row">
				  <div class="col-xs-12 col-md-8">
                  <div class="row">
				  <div class="form-group col-xs-12 col-sm-3">
                      <label for="middle-name" class="control-label">Campaign Name</label>
                      <input name="campaignname" type="text" placeholder="Enter Your Campaign" class="form-control" value="<?=isset($campaignname)?$campaignname:''?>">
                    </div>
					
                    <div class="form-group col-xs-12 col-sm-3">
                      <label for="middle-name" class="control-label">Comapany name</label>
                      <input name="companyname" type="text" placeholder="Company" class="form-control" value="<?=isset($companyname)?$companyname:''?>">
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-3">
                      <label class="control-label" for="last-name">Inventory Type  </label>
                    <select name="inventoryname" class="form-control">
					<option value="">select inventory</option>
					<option value="Project Gallery" <?php if(!empty($inventoryname)){ if($inventoryname=="Project Gallery"){ echo"selected";}}?>>Project Gallery</option>
					<option value="Project Of Month" <?php if(!empty($inventoryname)){ if($inventoryname=="Project Of Month"){ echo"selected";}}?>>Project Of Month</option>
					<option value="Hot Projects" <?php if(!empty($inventoryname)){ if($inventoryname=="Hot Projects"){ echo"selected";}}?>>Hot Projects</option>
					<option value="Featured Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="Featured Listing"){ echo"selected";}}?>>Featured Listing</option>
					<option value="RHS Project Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="RHS Project Listing"){ echo"selected";}}?>>RHS Project Listing</option>
					<option value="MLP Project Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="MLP Project Listing"){ echo"selected";}}?>>MLP Project Listing</option>
					<option value="MLP Property Listing" <?php if(!empty($inventoryname)){ if($inventoryname=="MLP Property Listing"){ echo"selected";}}?>>MLP Property Listing</option>
					</select>
					</div>
					
					<div class="form-group col-xs-12 col-sm-3">
                      <label for="middle-name" class="control-label">Project name</label>
                      <input name="projectname" type="text" placeholder="Project" class="form-control" value="<?=isset($projectname)?$projectname:''?>">
                    </div>
                    </div>
                    </div>
                    
                    <div class="form-group col-xs-12 col-md-4 martop20">                      
					<button type="button" onclick="location.href = '<?=base_url();?>Inventory/Inventorylog/<?php if(!empty($campaignid)){ echo"Campaign/"; echo $campaignid; }?>';" class="btn btn-primary">Reset</button>
					<button type="submit" class="btn btn-success">Search</button>
					<button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
                    </div>
                  </div>
                 <!-- <div class="ln_solid"></div>-->
                 
                  
                </form>
              </div>
            </div>
          </div>
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
        
        <div class="clearfix"></div>
        
        
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Inventory Logs</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table  class="table table-striped responsive-utilities jambo_table">
                  <thead>
                    <tr>
                      <th>Campaign Name</th>
					  <th>Project Name</th>
					  <th>Inventory</th>
					  <th>City</th>
                      <th>Edited By</th>
                      <th>Date &amp; Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
					
					
                    <?php foreach($log_details as $log_detailss){?>
                    <tr>
                      <td><?=isset($log_detailss->userCompanyName)?$log_detailss->userCompanyName:''?> <?=isset($log_detailss->campaigndate)?$log_detailss->campaigndate:''?></td>
                      <td><?=isset($log_detailss->projectName)?$log_detailss->projectName:''?></td>
                      <td><?=isset($log_detailss->inventoryname)?$log_detailss->inventoryname:''?></td>
					  <td><?=isset($log_detailss->cityName)?$log_detailss->cityName:''?></td>
					  <td><?=isset($log_detailss->createdBy)?$log_detailss->createdBy:''?></td>
                      <td><?=isset($log_detailss->createdon)?$log_detailss->createdon:''?></td>
                       <td> <?=isset($log_detailss->status)?$log_detailss->status:''?></td>
                      </tr>
                    <?php } ?>
                    
                    
                    
                    

                  </tbody>
                </table>
				
				<div class="dypagination">
               
                <!-- <li><a href="#">Previous</a></li>
                <li><a href="#" class="active">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">Next</a></li> -->
                <?php echo $links; ?>
                
               
                
                <style>
                .dypagination{margin:10px;text-align:right}
				.dypagination ul{}
    			.dypagination ul li{text-align:center;list-style:none;list-style-image:none;margin-right:4px;display:inline-block}
				.dypagination ul li a{display:inline-block;background:#DDDDDD;padding:6px 9px;color:#666;font-size:13px;text-decoration:none}
				.dypagination ul li a.active{background:#F47D17;color:#FFF}				
     			.dypagination ul li:last-child{margin-right:0}

                
                
                
                </style>
                
                
                
                
                </div>
                </div>
              </div>
              
              
              
              
              
              
              
            </div>
                  
          </div>
          
    
        </div>
      </div>
	  
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
      <!-- /page content --> 
      
     