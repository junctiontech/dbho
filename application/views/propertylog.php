<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Property Log</h3>
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
                <h2>Logs</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table id="example" class="table table-striped jambo_table">
                  <thead>
                    <tr>
                      <th>Property</th>
                      <th>Edited By</th>
                      <th>Plan Type</th>
                      <th>Date &amp; Time</th>
                      <th>Action Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>XXXXXX</td>
                      <td>demo@gmail.com</td>
                      <td>Gold</td>
                      <td>18/12/2015 14:59:00</td>
                       <td>Refresh</td>
                     
                    </tr>
                    
                    <tr>
                      <td>XXXXXX</td>
                      <td>demo@gmail.com</td>
                      <td>Gold</td>
                      <td>18/12/2015 14:59:00</td>
                       <td>
                       Edit
                       <!--<div class="action-icons">
                       <a href="#" title="Pause" alt="Pause"><i class="fa fa-pause"></i></a>
                        <a href="#" title="Active" alt="Active"><i class="fa fa-lightbulb-o"></i></a>
                        <a href="#" title="Refresh" alt="Refresh"><i class="fa fa-refresh"></i></a>
                        <a href="#" title="Reactive" alt="Reactive"><i class="fa fa-lightbulb-o"></i></a>
                        <a href="#" title="Draft" alt="Draft"><i class="fa fa-save"></i></a>
                       </div> -->
                       </td>
                     
                    </tr>
                    
                    
                    
                    
                    

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
      
     