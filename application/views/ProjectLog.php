<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
			<div class="title_left">
				<h3>Project Log</h3>
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
		<?php // if(!isset($this->data['projectID'])&&empty($this->data['projectID'])){ ?>
        <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Filter </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="" method="post" action="<?=base_url();?>AddProject/ProjectLog/search" data-parsley-validate class="form-group form-label-left clearfix" >
							<input type="hidden" name="projectID" value="<?=isset($projectID)?$projectID:''?>"/>
							<div class="row">
								<div class="form-group col-xs-12 col-sm-2">
									<label class="control-label" for="first-name">Project Name</label>
									<input type="text" name="projectName" id="first-name" value="<?=isset($projectName)?$projectName:''?>" class="form-control">
								</div>
								<div class="form-group col-xs-12 col-sm-2">
									<label class="control-label" for="first-name">Project Key</label>
									<input type="text" name="projectKey" value="<?=isset($projectKey)?$projectKey:''?>" id="first-name" class="form-control">
								</div>
								<div class="form-group col-xs-12 col-sm-2">
									<label class="control-label" for="first-name">Plan</label>
									<select class="form-control" name="plan" >
										<option value="0">Select Plan</option>
										<option value="Diamond"<?php if(isset($plan)&& $plan=='Diamond'){ echo 'selected';}?>>Diamond</option>
										<option value="Gold"<?php if(isset($plan)&& $plan=='Gold'){ echo 'selected';}?>>Gold</option>
										<option value="Silver"<?php if(isset($plan)&& $plan=='Silver'){ echo 'selected';}?>>Silver</option>
										<option value="Platinum"<?php if(isset($plan)&& $plan=='Platinum'){ echo 'selected';}?>>Platinum</option>
										<option value="Free"<?php if(isset($plan)&& $plan=='Free'){ echo 'selected';}?>>Free</option>
									</select>
								</div>
								<div class="form-group col-xs-12 col-sm-3">
									<label for="middle-name" class="control-label">Status</label>
									<select class="form-control" name="status" >
										<option value="0">Select Status</option>
										<option value="Active"<?php if(isset($status)&& $status=='Active'){ echo 'selected';}?>>Active</option>
										<option value="Inactive"<?php if(isset($status)&& $status=='Inactive'){ echo 'selected';}?>>Inactive</option>
										<option value="Draft"<?php if(isset($status)&& $status=='Draft'){ echo 'selected';}?>>Draft</option>
										<option value="Admin Refresh"<?php if(isset($status)&& $status=='Admin Refresh'){ echo 'selected';}?>>Admin Refresh</option>
										<option value="Refresh"<?php if(isset($status)&& $status=='Refresh'){ echo 'selected';}?>>Refresh</option>
									</select>
								</div>
								<div class="form-group col-xs-12 col-sm-3 martop20">
									<button type="submit" onclick="location.href = '<?=base_url();?>AddProject/ProjectLog';" class="btn btn-primary">Reset</button>
									<button type="submit" class="btn btn-success">Search</button>
									<button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>
        </div>
        <?php // } ?>
        <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Logs</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div style="overflow-x:auto; overflow-y:hidden;">
							<table id="" class="table table-striped jambo_table">
								<thead>
									<tr>
									  <th>Project Key</th>
									  <th>Project</th>
									  <th>Edited By</th>
									  <th>Plan Type</th>
									  <th>Date &amp; Time</th>
									  <th>Action Type</th>
									</tr>
								</thead>
								<tbody id="pagination">
									<?php foreach( $ProjectLogFilterData as $list ){ 
									?>
									<tr>
										<td><?=isset($list->projectKey)?$list->projectKey:''?></td>
										<td><?=isset($list->projectName)?$list->projectName:''?></td>
										<td><?=isset($list->adminUserEmail)?$list->adminUserEmail:''?></td>
										<td><?=isset($list->planTitle)?$list->planTitle:''?></td>
										<td><?=isset($list->DateTime)?$list->DateTime:''?></td>
										<td><?=isset($list->Action)?$list->Action:''?></td>
									 <?php }  ?>
									</tr>
									<?php  ?>
								</tbody>	
							</table>
							<?php //echo count($ProjectLogFilterData);?>
							<div class="dypagination">
								<ul>
									<li><a href="#" >Previous</a></li> 
									<?php if(isset($ProjectLogDetails)){ if(in_array(count($ProjectLogDetails),range(0,20)) || count($ProjectLogDetails)>=20)
									{ ?>
									<li><a href="javascript:;" onclick="Pagination(0,20,1);" id="div1"  >1</a></li>
									<?php } if(in_array(count($ProjectLogDetails),range(21,40)) || count($ProjectLogDetails)>=40)
									{ ?>
									<li><a href="javascript:;" onclick="Pagination(21,40,2);" id="div2"  >2</a></li> 
									<?php } if(in_array(count($ProjectLogDetails),range(41,60)) || count($ProjectLogDetails)>=60)
									{ ?>
									<li><a href="javascript:;" onclick="Pagination(41,60,3);" id="div3"  >3</a></li>  
									<?php } } ?>
									<li><a href="#">Next</a></li>
								</ul>
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
                    'iDisplayLength': 20,
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
      
     