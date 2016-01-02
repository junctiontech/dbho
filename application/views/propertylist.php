<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Property Listing</h3>
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
		 <?php } if($this->session->flashdata('category_error')) { ?>
<div class="row" >
<div class="alert alert-danger" >
<strong><?=$this->session->flashdata('category_error')?></strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
</div>
</div>
<?php }?>
		 <!-- Alert section End-->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
                <h2>Filter </h2>
                
                <div class="clearfix"></div>
              </div>
            
            
        <div class="x_content">
                <form id="demo-form2" action="<?=base_url();?>AddProperty/PropertyListing/search" method="post" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-2">
                    <label class="control-label" for="first-name">User Type</label>
                    <input type="text" id="first-name" name="usertype" value="<?=isset($usertype)?$usertype:''?>"  class="form-control">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-2">
                    <label class="control-label" for="first-name">Account</label>
                    <input type="text" id="first-name" name="account" value="<?=isset($account)?$account:''?>" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-2">
                     <label class="control-label" for="first-name">Activated By</label>
                    <input type="text" id="first-name" name="activatedby" value="<?=isset($activatedby)?$activatedby:''?>" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-2">
                    <label for="middle-name" class="control-label">Plan</label>
                     <input id="middle-name" class="form-control" value="<?=isset($plan)?$plan:''?>" name="plan" type="text" >
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-2">
                    <label for="middle-name" class="control-label">Status</label>
                    <input id="middle-name" class="form-control" value="<?=isset($status)?$status:''?>"  type="text" name="status">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-2 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>AddProperty/PropertyListing';" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
                  </div>

                  </div>

                </form>
              </div>
              </div>
              </div>
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
                      <th>S.No.</th>
                      <th>User Type</th>
                      <th>Property Name/Plan</th>
                      <th>Posted By/Activated By</th>
                      <th>Account</th>
                      <th>Date</th>
                      <th>Action</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php $i=1; foreach($propertylisting as $propertylistings){ ?>
                    <tr>
                      <td><?=isset($i)?$i:''?></td>
                      <td><?=isset($propertylistings->userTypeName)?$propertylistings->userTypeName:''?></td>
                      <td><?=isset($propertylistings->propertyName)?$propertylistings->propertyName:''?><br>Silver Plan</td>
                      <td><?=isset($propertylistings->userEmail)?$propertylistings->userEmail:''?></td>
                      <td><?=isset($propertylistings->userEmail)?$propertylistings->userEmail:''?></td>
                      <td><?=isset($propertylistings->propertyAddedDate)?$propertylistings->propertyAddedDate:''?></td>
                       <td>
                       <div class="action-icons">
                       <a href="<?=base_url();?>AddProperty/index/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
                       <a href="<?=base_url();?>AddProperty/PropertyLog/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Log" alt="Log"><i class="fa fa-archive"></i></a>
                       <a onclick="return confirm('Are You Sure To Delete This Property ?');" href="<?=base_url();?>AddProperty/PropertyAction/Delete/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Delete" alt="Delete"><i class="fa fa-trash"></i></a><br>
                       <a href="javascript:;" title="Pause" alt="Pause"><i class="fa fa-pause"></i></a>
                       <a <?php if($propertylistings->propertyStatus=="Draft"){ ?> href="<?=base_url();?>AddProperty/propertyPreview/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" <?php }else{?> onclick="alert('Property With Status Draft Can Only Be See Preview');"<?php }?> target="_blank" title="Preview" alt="Refresh"><i class="fa fa-refresh"></i></a>
                       <a <?php if($propertylistings->propertyStatus!="Active"){ ?> onclick="return confirm('Are You Sure To Activate This Property ?');" href="<?=base_url();?>AddProperty/PropertyAction/Active/<?=$propertylistings->propertyID?>" <?php }else{?> onclick="alert('This Property Is Already Active');"<?php }?> title="Active" alt="Active"><i class="fa fa-lightbulb-o"></i></a>
                       </div>
                       </td>
                       <td><i  <?php if($propertylistings->propertyStatus=="Active"){ echo 'title="Active" class="fa fa-check"'; }elseif($propertylistings->propertyStatus=="Draft"){ echo 'title="Draft" class="fa fa-archive"';}else{echo 'title="refresh" class="fa fa-refresh"';}?>></i></td>
                     
                    </tr>
				  <?php $i++; }?>
                    
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
        </script> 
      <!-- /page content --> 
      
     