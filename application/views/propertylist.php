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
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
                <h2>Filter </h2>
                
                <div class="clearfix"></div>
              </div>
            
            
        <div class="x_content">
                <form id="demo-form2" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-2">
                    <label class="control-label" for="first-name">User Type</label>
                    <input type="text" id="first-name" required="required" class="form-control">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-2">
                    <label class="control-label" for="first-name">Account</label>
                    <input type="text" id="first-name" required="required" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-2">
                     <label class="control-label" for="first-name">Activated By</label>
                    <input type="text" id="first-name" required="required" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-2">
                    <label for="middle-name" class="control-label">Plan</label>
                     <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-2">
                    <label for="middle-name" class="control-label">Status</label>
                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-2 martop20">
                  <button type="submit" class="btn btn-primary">Reset</button>
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
                       <a href="<?=base_url();?>AddProperty/Deleteproperty/<?=isset($propertylistings->propertyID)?$propertylistings->propertyID:''?>" title="Delete" alt="Delete"><i class="fa fa-trash"></i></a><br>
                       <a href="#" title="Pause" alt="Pause"><i class="fa fa-pause"></i></a>
                       <a href="#" title="Refresh" alt="Refresh"><i class="fa fa-refresh"></i></a>
                       <a <?php if($propertylistings->propertyStatus!="Active"){ echo "href='/AddProperty/ActivateProperty/$propertylistings->propertyID'";}?> title="Active" alt="Active"><i class="fa fa-lightbulb-o"></i></a>
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
      
     