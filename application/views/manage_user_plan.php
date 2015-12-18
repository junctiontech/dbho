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
            <h3>Manage User Plan</h3>
          </div>
          <div class="title_right">
           
              <div class="input-group pull-right">
              
                <button class="btn btn-success taright" type="button" href="<?=base_url();?>Manage_user_plan/loadmodal" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-plus"></i> Add User Plan</button>
                </div>
                
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<center><img src="<?=base_url();?>/images/ajax-loader2.gif" id="loading-indicator" style="display:none" /></center>
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                      <h4 class="modal-title" id="myModalLabel">Add User Plan</h4>
                    </div>
                    <div class="modal-body">
					
                      
                    </div>
					
                  </div>
                </div>
              </div>
			  
			
          </div>
        </div>
        <div class="clearfix"></div>
        
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
             
              <div class="x_content">
                <form action="<?=base_url();?>Manage_user_plan/index/search" method="post"  class="form-group form-label-left clearfix">
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Plan Title <span class="required">*</span> </label>
                    <input  type="text" id="first-name" required="required" name="plantitle" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">User Type <span class="required">*</span> </label>
                    <input  type="text" id="last-name"  required="required" name="username" class="form-control">
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Listing Type</label>
                    <input id="middle-name" class="form-control" type="text" name="listingtype">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3 martop20">
                  <button type="button" onclick="location.href = '<?=base_url();?>Manage_user_plan';" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
                   
                  </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        
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

            
                <h2>User Plan List</h2>
                <div class="clearfix"></div>
              </div>
              
              
              <div class="x_content paddbot">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                  <thead>
                    <tr class="headings">
                      <th> <input type="checkbox" class="tableflat">
                      </th>
                      <th>Plan Title </th>
                      <th>User Type </th>
                      <th>Plan Order </th>
                      <th>Listing Type </th>
                      <th>Created Date </th>
                      <th class=" no-link last"><span class="nobr">Action</span> </th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($userplans as $userplans){?>
                    <tr class="even pointer">
                      <td class="a-center "><input type="checkbox" class="tableflat"></td>
              
                      <td class=" "><?=isset($userplans->planTitle)?$userplans->planTitle:''?> </td>
                      <td class=" "><?=isset($userplans->userTypeName)?$userplans->userTypeName:''?> <i class="success fa fa-long-arrow-up"></i></td>
                      <td class=" "><input type="text" placeholder="<?=isset($userplans->planPrice)?$userplans->planPrice:''?>" disabled="disabled" class="form-control edt-form"></td>
                      <td class=" ">project</td>
                      <td class="a-right a-right "><?=isset($userplans->planDate)?$userplans->planDate:''?></td>
                      <td class=" last"><ul class="list-inline text-right">
                      <li><a title="Right" href="javascript:;"><i class="fa fa-check"></i></a></li>
                       <li><a title="Edit" data-toggle="modal" data-target=".bs-example-modal-lg" href="<?=base_url();?>Manage_user_plan/loadmodal/<?=isset($userplans->planID)?$userplans->planID:''?>"><i class="fa fa-pencil"></i></a></li>
                      </ul></td>
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
			
				
    $(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
        target.removeData('bs.modal')
              .find(".modal-content").html('');
    });
	
	/*$(document).ajaxSend(function(event, request, settings) {
    $('#loading-indicator').show();
});

$(document).ajaxComplete(function(event, request, settings) {
    $('#loading-indicator').hide();
});
*/
//validation start..........................................................................

function checkvalidation(){
	
	if(document.getElementById('plantittle').value == "" )
    	{
    			 document.getElementById('plantittle').focus() ;
				 document.getElementById('plantittle').placeholder="Please provide Plan Title!" ;
				 document.getElementById('plantittle').setAttribute('class',' form-control  parsley-error') ;
				 return false;
    	}
		
		if(document.getElementById('plantype').value == "" )
    	{
    			 document.getElementById('plantype').focus() ;
				 document.getElementById('plantype').placeholder="Please provide Plan Type!" ;
				 document.getElementById('plantype').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		
		if(document.getElementById('planorder').value == "" )
    	{
    			 document.getElementById('planorder').focus() ;
				 document.getElementById('planorder').placeholder="Please provide Plan Type!" ;
				 document.getElementById('planorder').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		if(document.getElementById('shownewtittle').value == "" )
    	{
    			 document.getElementById('shownewtittle').focus() ;
				 document.getElementById('shownewtittle').placeholder="Please provide Plan Type!" ;
				 document.getElementById('shownewtittle').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		
	return( true );
	
}

function fill(){
	
	if(document.getElementById('plantittle').value != "" )
    	{
    			 document.getElementById('plantitlemes').setAttribute('class','required fa fa-check') ;
				 document.getElementById('plantitlemes').style.color='green' ;
				 document.getElementById('plantittle').setAttribute('class',' form-control ') ;
    	}
		
		if(document.getElementById('plantype').value != "" )
    	{
    			  document.getElementById('plantypemes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('plantypemes').style.color='green';
				  document.getElementById('plantype').setAttribute('class',' form-control ') ;
    	}
		if(document.getElementById('planorder').value != "" )
    	{
    			  document.getElementById('planordermes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('planordermes').style.color='green';
				  document.getElementById('planorder').setAttribute('class',' form-control ') ;
    	}
		if(document.getElementById('shownewtittle').value != "" )
    	{
    			  document.getElementById('shownewtittlemes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('shownewtittlemes').style.color='green';
				  document.getElementById('shownewtittle').setAttribute('class',' form-control ') ;
    	}
}
	
        </script>
