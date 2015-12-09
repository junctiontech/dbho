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
            <h3>Add Plan Type</h3>
          </div>
          <div class="title_right">
            <div class="input-group pull-right"> 
           <div class="nav toggle paddman12">  <button href="<?=base_url();?>manage_user_plan/Addplantypemodal" type="button" class="btn btn-success taright" data-toggle="modal" data-target=".bs-example-modal-lg">Add Plan</button> </div>
            
            <!-- <a id="menu_toggle2"><button class="btn btn-primary" type="button">Full Screen</button></a>-->
            </div>
          </div>
          
          <!--pop up start-->
          
          <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
		  <center><img src="<?=base_url();?>/images/loading.gif" id="loading-indicator" style="display:none" /></center>
                <div class="modal-dialog modal-lg">
                  <div class="modal-content moda-scrol">
                </div></div>
              </div>
              
           <!--pop up end-->    
              
              
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
		 <?php } if($this->session->flashdata('category_error')) { ?>
<div class="row" >
<div class="alert alert-danger" >
<strong><?=$this->session->flashdata('category_error')?></strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
</div>
</div>
<?php }?>
		 <!-- Alert section End-->
        
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Plan List</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a> </li>
                      <li><a href="#">Settings 2</a> </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                  <thead>
                    <tr>
                      <th>Plan Title</th>
                      <th>Plan priority</th>
                      <th>Create On</th>
                     </tr>
                  </thead>
                  <tbody>
				  <?php foreach($plantypelist as $plantypelists){?>
                    <tr>
                      <td><?=isset($plantypelists->planTypeTitle)?$plantypelists->planTypeTitle:''?></td>
                      <td><?=isset($plantypelists->Priority)?$plantypelists->Priority:''?></td>
                      <td><?=isset($plantypelists->createdOn)?$plantypelists->createdOn:''?></td>
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
        </script> 
<script type="text/javascript">
       
		$(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
        target.removeData('bs.modal')
              .find(".modal-content").html('');
    });
	
	$(document).ajaxSend(function(event, request, settings) {
    $('#loading-indicator').show();
});

$(document).ajaxComplete(function(event, request, settings) {
    $('#loading-indicator').hide();
});



function checkvalidation(){
	
	if(document.getElementById('plantitle').value == "" )
    	{
    			 document.getElementById('plantitle').focus() ;
				 document.getElementById('plantitle').placeholder="Please provide Plan Title!" ;
				 document.getElementById('plantitle').setAttribute('class',' form-control  parsley-error') ;
				 return false;
    	}
		
		if(document.getElementById('planpri').value == "" )
    	{
    			 document.getElementById('planpri').focus() ;
				 document.getElementById('planpri').placeholder="Please provide Plan Priority!" ;
				 document.getElementById('planpri').setAttribute('class',' form-control parsley-error') ;
				 return false;
    	}
		
	return( true );
	
}

function fill(){
	
	if(document.getElementById('plantitle').value != "" )
    	{
    			 document.getElementById('plantitlemes').setAttribute('class','required fa fa-check') ;
				 document.getElementById('plantitlemes').style.color='green' ;
				 document.getElementById('plantitle').setAttribute('class',' form-control ') ;
    	}
		
		if(document.getElementById('planpri').value != "" )
    	{
    			  document.getElementById('planmes').setAttribute('class','required fa fa-check') ;
				  document.getElementById('planmes').style.color='green';
				  document.getElementById('planpri').setAttribute('class',' form-control ') ;
    	}
}
    </script> 
