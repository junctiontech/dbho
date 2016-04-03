<style type="text/css">
	#myTable span {
	background: none repeat scroll 0 0 #e74c3c;
	border-radius: 3px;
	color: #fff;
	cursor: pointer;
	padding: 5px 7px;
	text-align: center;
}
      
#loading-indicator { 
	left: 0;
	margin-top: 300px;
	bottom: 0;
	right: 0;
	background: white;
	z-index: 10000;
	zoom: 1;
	filter: alpha(opacity=100);
	-webkit-opacity: 1;
	-moz-opacity: 1;
	opacity: 1;
	-webkit-transition: all 800ms ease-in-out;
	-moz-transition: all 800ms ease-in-out;
	-o-transition: all 800ms ease-in-out;
	transition: all 800ms ease-in-out;
}
        </style>
<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
		  <div class="page-title">
			  <div class="title_left">
				  <h3>Users Requests</h3>
			  </div>
			  <div class="title_right">
				  
				  <!--div class="input-group pull-right">
					  <button class="btn btn-success taright" type="button" href="<?= base_url(); ?>Manage_user_plan/loadmodal" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i>Add User Plan</button>
				  </div>
					  
				  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
					  <div class="modal-dialog modal-lg">
						  <div class="modal-content">
							  <div class="modal-header">
								  <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">×</span> </button>
								  <h4 class="modal-title" id="myModalLabel">Add User Plan</h4>
							  </div>
							  <div class="modal-body"></div>
						  </div>
					  </div>
				  </div-->
					  
					  
			  </div>
		  </div>
        <div class="clearfix"></div>
        
         <!--div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
             
              <div class="x_content">
			  <?php //echo '<pre>'; var_dump($plandetails); echo '</pre>'; ?>
                <form action="<?=base_url();?>Manage_user_plan/index/search" method="post"  class="form-group form-label-left clearfix">
                <div class="row">
				
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Plan Title </label>
                    <select id="first-name" name="plantitle" class="form-control">
						<option value="">Select</option>
						<?php foreach($plandetails as $plandetails){?>
						<option value="<?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?>" <?php  if(!empty($updateplan[0]->planTitle)){   if($plantypeid==$plandetails->planTypeID
						){ echo"selected";} } ?>><?=isset($plandetails->planTypeTitle)?$plandetails->planTypeTitle:''?></option>
						<?php } ?>
					</select>
                  </div>
				  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">User Type </label>
                    <select id="last-name" name="username" class="form-control">
						<option value=''>Select</option>
						<option value='Agent'>Agent</option>
						<option value='Builder'>Builder</option>
						<option value='Individual'>Individual</option>
					</select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Listing Type</label>
					<select id="middle-name" class="form-control" name="listingtype">
						<option value=''>Select</option>
						<option value='project'>Project</option>
						<option value='property'>Property</option>
					</select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>Manage_user_plan';" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
                  <button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
                  </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div-->
        
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
					 <div class="x_title">
						 <h2>User Request List</h2>
						 <div class="clearfix"></div>
					 </div>
						 
					 <div class="x_content paddbot">
						 <table id="example" class="table table-striped responsive-utilities jambo_table">
							 <thead>
								 <tr class="headings">
									 <th>Req. ID </th>
									 <th>User </th>
									 <th>User Type </th>
									 <th>Req. Type </th>
									 <th>Req. Date </th>
									 <th class=" no-link last"><span class="nobr">Action</span> </th>
								 </tr>
							 </thead>
							 <tbody>
								 <?php foreach ($requests as $request) { ?>
									 <tr class="even pointer">										  
										 <td class=" "><?php echo isset($request->raiseRequestID) ? $request->raiseRequestID : '' ?> </td>
										 <td class=" "><?php echo isset($request->userDetail->userFirstName) ? ($request->userDetail->userFirstName .' '. $request->userDetail->userLastName) : '' ?> </td>
										 <td class=" "><?php echo $request->userDetail->userTypeName; ?></td>
										 <td class=" "><?php echo $request->type ?></td>
										 <td class=" "><?php echo date('d-M-Y', strtotime($request->createdDate)) ?></td>
										 <td class=" last">
											 <ul class="list-inline text-right">
												 <li><a title="Right" href="<?php echo base_url() . 'requests/view/' . $request->raiseRequestID ?>" target="_blank"><i class="fa fa-desktop"></i> View</a></li>
												 <!--li><a title="Edit" data-toggle="modal" data-target=".bs-example-modal-lg" href="<?= base_url(); ?>Manage_user_plan/loadmodal/<?= isset($request->planID) ? $request->planID : '' ?>"><i class="fa fa-pencil"></i></a></li-->
											 </ul>
										 </td>
									 </tr>
								 <?php } ?>
							 </tbody>
						 </table>
					 </div>
				 </div>
			 </div>
		 </div>
                    
        
        
        
        
      </div>
      <!-- /page content --> 
      
       


<!-- select2 --> 
<script>
	
	var asInitVals = new Array();
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
	
	
    $(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
        target.removeData('bs.modal')
		.find(".modal-content").html('');
    });
	
	$(document).ajaxSend(function(event, request, settings) {
		$("#loader").fadeIn();
	});
	
	$(document).ajaxComplete(function(event, request, settings) {
		$("#loader").fadeOut();
	});
	
</script>