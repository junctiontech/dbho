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
            <h3>Campaign Listing</h3>
          </div>
          
        </div>
        <div class="clearfix"></div>
       
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Campaign Search</h2>
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
                <form action="<?=base_url();?>Campaign/Campaign_listing/search" method="post" class="form-group form-label-left clearfix">
                  <div class="row">
                    <div class="form-group col-xs-12 col-sm-2">
                      <label for="middle-name" class="control-label">Comapny name</label>
                      <input name="companyname" type="text" placeholder="Company" class="form-control">
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-2">
                     <label for="middle-name" class="control-label">Email</label>
                      <input name="email" type="text" placeholder="Enter Your Email" class="form-control">
                    </div>
                    <div class="form-group col-xs-12 col-sm-2">
                      <label for="middle-name" class="control-label">Mobile No</label>
                      <input name="mobileno" type="text" placeholder="Enter Your No" class="form-control">
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-2">
                      <label for="middle-name" class="control-label">Campaign Name</label>
                      <input name="campaignname" type="text" placeholder="Enter Your Campaign" class="form-control">
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-2">
                      <label class="control-label" for="last-name">User Type <span class="required">*</span> </label>
                      <select name="usertype" class="select2_group form-control">
                        <option value="">select user type</option>
                        <?php foreach($user_type as $user_type){?>
                        <option value="<?=$user_type->userTypeID?>" <?php if(!empty($updateplan[0]->userTypeID)){ if($updateplan[0]->userTypeID==$user_type->userTypeID){ echo"selected";} } ?>><?=$user_type->userTypeName?></option>
						<?php } ?>
                      </select>
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-2 martop20">                      
                    <button type="button" onclick="location.href = '<?=base_url();?>Campaign/Campaign_listing';" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success">Search</button>
          
                    </div>
                  </div>
                 <!-- <div class="ln_solid"></div>-->
                 
                  
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
                <h2>Campaign table </h2>
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
              <div class="x_content scor-bott">
                <table  class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Campaign Name </th>
                      <th>Company Name</th>
                      <th>Email ID </th>
                      <th>Mobile No</th>
                      
                      <th>UPED</th>
                      <th>Amount Rs </th>
                      <th></th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($campaignlist as $campaignlists){?>
                    <tr>
                      <td><?=isset($campaignlists->userCompanyName)?$campaignlists->userCompanyName:''?> <?=isset($campaignlists->created)?$campaignlists->created:''?></td>
                      <td><?=isset($campaignlists->userCompanyName)?$campaignlists->userCompanyName:''?></td>
                      <td><?=isset($campaignlists->userEmail)?$campaignlists->userEmail:''?></td>
                      <td><?=isset($campaignlists->userPhone)?$campaignlists->userPhone:''?></td>
                      
                       <td><?=isset($campaignlists->expiry_date_campaign)?$campaignlists->expiry_date_campaign:''?></td>
                       <td><?=isset($campaignlists->amount)?$campaignlists->amount:''?></td>
                       <td><button class="btn btn-success" type="button" data-toggle="modal" href="<?=base_url();?>campaign/campaign_modal/<?=isset($campaignlists->campaignID)?$campaignlists->campaignID:''?>" data-target=".bs-example-modal-lg">View</button></td>
                       
                     
                    </tr>
<?php } ?>
                  </tbody>
                </table>
              </div>
              
              
              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			 
			  <center><img src="<?=base_url();?>/images/loading.gif" id="loading-indicator" style="display:none" /></center>
                <div class="modal-dialog modal-lg">
				
                  <div class="modal-content moda-scrol">
				   
                  </div>
                </div>
              </div>
              
             <!-- <div class="valusho pull-left"> <h5>Campaign Amount :  Rs 335090 </h5></div>
              <div class="valusho pull-right"> <button class="btn btn-info btn-lg" type="button">Create</button></div>-->
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
</script>
