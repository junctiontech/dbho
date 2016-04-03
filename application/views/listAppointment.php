<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Appointment Listing</h3>
          </div>
         
        </div>
        
    <!-- Alert section For Message-->
    
     <!-- Alert section End-->
        
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
                      <th>#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Date/Time </th>
                      <th>Notes </th>
                      <th>Status</th> 
                      <th>Action</th>                     
                    </tr>
                  </thead>
                  <?php 
				  //echo"<pre>";print_r($allAppointments);die;
                    $i=1;
                    foreach ($allAppointments as $key => $value) {
                      if($i%2==0){ $class = "even pointer";}
                      if($i%2!=0){ $class = "odd pointer";}
                    ?>
                      <!--td class="a-center "><input type="checkbox" class="tableflat"></td-->
                      <td><?php echo $i;?></td>
                      <td ><?php echo ucfirst($value->name);?></td>
                      <td ><?php echo $value->phone?></td>
                      <td ><?php echo $value->email?></td>
                      <td ><?php echo $value->address?></td>
                      <td ><?php echo date("d-m-Y H:s",strtotime($value->appointmentTime));?></td>
                      <td><?php echo $value->note?></td>
                      <td ><?php echo $value->appointmentStatus?></td>
                      <!--td class="a-right a-right ">$7.45</td-->
                           <td>   <?php 
                              if(($value->appointmentStatus=='open' || $value->appointmentStatus==ucfirst('open'))||($value->appointmentStatus=='deferred' || $value->appointmentStatus==ucfirst('deferred'))||($value->appointmentStatus=='reschedule' || $value->appointmentStatus==ucfirst('reschedule'))){
                        ?>

                       <a href="<?=base_url();?>Appointment/CreateAppointment/<?= $value->userTypeID?>/<?= $value->LPID?>">Edit</a> 
                        <?php }
						else 
							{
						?>
								 <a href="<?=base_url();?>AddProperty/index/<?= $value->LPID?>">View Property</a> 
							
							<?php } ?>
							
					
                        
                      </td>
                    </tr>
                    <?php $i++;}?> 
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
      
     