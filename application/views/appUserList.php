<!-- page content -->
<?php //print_r($status);?>
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
			
		  <h3>
		  App Users Listing
		  </h3>
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
		 
		  <!--div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong></strong>  </div>
		 
		 <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
                <strong></strong>  </div>
		
<div class="row" >
<div class="alert alert-danger" >
<strong></strong>
</div-->
</div>
		 <!-- Alert section End-->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <!--div class="x_panel">
            <!--div class="x_title">
                <h2>Filter </h2>
                <div class="clearfix"></div>
              </div-->
				 <!--div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
					 </div>
                  </div>
                </div>
              </div>
        <!--div class="x_content">
                <form id="demo-form2" action="#" method="post" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
					<div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">User Name</label>
                    <input type="text" id="first-name" name="propertyName" value="" class="form-control">
                  </div>
					<div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">User Email</label>
                    <input type="text" id="first-name" name="propertykey" value="" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">User City</label>
					<select class="select2_group form-control" name="usertype">
                    <option value="">Select User City</option>
					<option value="Agent" >Agent</option>
					<option value="Builder" >Builder</option>
					<option value="Individual" >Individual</option>
					</select>
                  </div-->
                  <!--div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Account</label>
                    <input type="text" id="first-name" name="account" value="" class="form-control">
                  </div-->
                  <!--div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">Activated By</label>
                    <input type="text" id="first-name" name="activatedby" value="" class="form-control">
                  </div-->
                  <!--div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Plan</label>
                     
                  <select id="first-name" name="plan" class="form-control">
						<option value="">Select Plan</option>
						
						<option value=""></option>
						
					</select>
				  </div-->
                  
                  <!--div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Status</label>
                    <select class="select2_group form-control" name="status">
                    <option value="">Select Status</option>
					<option value="Active" >Active</option>
					<option value="Inactive" >Inactive</option>
					<option value="Draft" >Draft</option>
					<option value="Requested" >Requested</option>
					<option value="Deleted" >Deleted</option>
					</select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-4 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>AddProperty/PropertyListing';" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
				   <!--button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button-->
                  </div-->
                  </div-->
                </form-->
              </div-->
              </div-->
              </div-->
              </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Listing </h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				<style>
              </style>
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table id="example" class="table table-striped jambo_table">
                  <thead>
                    <tr>
                      <th>User Name</th>
                      <th>Name</th>
                      <th>User Email</th>
                      <th>City</th>
					   <th>Status</th>
					   <th>Action</th>
                    </tr>
                  </thead>
				  <?php //echo "<pre>";print_r($allAppUser);?>
				  
                  <tbody>
				  <?php foreach($allAppUser as $key=>$value){
					if ($value->status==1){
						$class = "";
						$an = 0;
					}
					else{
						$class = "text-decoration: line-through;";
						$an = 1;
					} 
					
				  ?>
                    <tr style="<?php echo $class; ?>">
                      <td><?php echo ucfirst($value->username);?></td>
                      <td><?php echo $value->name;?></td>
                      <td><?php echo $value->email;?></td>
                      <td>Bhopal</td>
                      <td>
						<?php if ($value->status==1)
					  {
						  echo "Active";
						  }
						else{
							echo"Inactive";
						} 
					  ?>
					  </td>
					  
                       <td>
                       <div class="action-icons">
                       <a href="<?=base_url();?>Addappusers/editAppUser/<?php echo $value->userID?>" title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
                       <!--a onclick="return confirm('Are You Sure To Delete This Property ?');" href="#" title="Delete" alt="Delete"><i class="fa fa-trash"></i></a><br-->
                       <!--a onclick="return confirm('Are You Sure To Activate This Property ?');" href=""  onclick="alert('This Property Is Already Active');" title="Active" alt="Active"><i class="fa fa-lightbulb-o"></i></a-->
                       </div>
                       </td>
                    </tr>
				  <?php }?>
                  </tbody>
                </table>
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
      <!-- /page content --> 
      
     