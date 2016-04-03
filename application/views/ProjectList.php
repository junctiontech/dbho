<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Project Listing</h3>
          </div>
		  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                       
                    </div>
                    <div class="modal-body">
					 </div>
					
                  </div>
                </div>
              </div>
        <!--  <div class="title_right">
            <div class="input-group pull-right"> 
             <button class="btn btn-primary" type="button">Download as CSV</button>
             <!--<button data-target=".bs-example-modal-lg" data-toggle="modal" type="button" class="btn btn-success taright">Export</button>
            </div>
          </div>-->
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
                <!--<ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a> </li>
                      <li><a href="#">Settings 2</a> </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>-->
                <div class="clearfix"></div>
              </div>
            
            
        <div class="x_content">
			<form id="" method="post" action="<?=base_url();?>AddProject/ProjectList/search" data-parsley-validate class="form-group form-label-left clearfix" >
				<div class="row">
                <div class="col-xs-12 col-md-9">
                <div class="row">
					<div class="form-group col-xs-12 col-sm-2">
						<label class="control-label" for="first-name">Project Key</label>
						<input type="text" name="projectKey" value="<?=isset($projectKey)?$projectKey:''?>" id="first-name" class="form-control">
					</div>
					<div class="form-group col-xs-12 col-sm-2">
						<label class="control-label" for="first-name">Project Name</label>
						<input type="text" name="projectName" value="<?=isset($projectName)?$projectName:''?>" id="first-name" class="form-control">
					</div>
					<div class="form-group col-xs-12 col-sm-3">
						<label class="control-label" for="first-name">User Type</label>
						<select class="form-control" name="usertype">
							<option value="0">Select User Type</option>
							<option value="Agency" <?php if(isset($usertype)&& $usertype=='Agency'){ echo 'selected';}?>>Agent</option>
							<option value="Builder" <?php if(isset($usertype)&& $usertype=='Builder'){ echo 'selected';}?>>Builder</option>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-3">
						<label class="control-label" for="first-name">Plan</label>
						<select class="form-control" name="plan" >
							<option value="0">Select Plan</option>
							<option value="Diamond" <?php if(isset($plan)&& $plan=='Diamond'){ echo 'selected';}?> >Diamond</option>
							<option value="Gold"<?php if(isset($plan)&& $plan=='Gold'){ echo 'selected';}?> >Gold</option>
							<option value="Silver"<?php if(isset($plan)&& $plan=='Silver'){ echo 'selected';}?> >Silver</option>
							<option value="Platinum"<?php if(isset($plan)&& $plan=='Platinum'){ echo 'selected';}?> >Platinum</option>
							<option value="Free"<?php if(isset($plan)&& $plan=='Free'){ echo 'selected';}?> >Free</option>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-2">
						<label for="middle-name" class="control-label">Status</label>
						<select class="form-control" name="status" >
							<option value="0">Select Status</option>
							<option value="Active" <?php if(isset($status)&& $status=='Active'){ echo 'selected';}?>>Active</option>
							<option value="Inactive" <?php if(isset($usertype)&& $status=='Inactive'){ echo 'selected';}?>>Inactive</option>
							<option value="Draft" <?php if(isset($status)&& $status=='Draft'){ echo 'selected';}?>>Draft</option>
						</select>
					</div>
                    </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-3 martop20">
						<button type="submit" onclick="location.href ='<?=base_url();?>AddProject/ProjectList';" class="btn btn-primary">Reset</button>
						<button type="submit" class="btn btn-success">Search</button>
						<button type="submit" name='submit' class="btn btn-success" value="Export to CSV">Export to CSV</button>
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
                <!--<ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a> </li>
                      <li><a href="#">Settings 2</a> </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
                </ul>-->
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
				
              <div style="overflow-x:auto; overflow-y:hidden;">
                <table id="example" class="table table-striped jambo_table">
					<thead>
						<tr>
						<th>Project Key</th>
						<th>User Type</th>
						<th>Project Name/Plan</th>
						<th>Posted By/Activated By</th>
						<th>Account</th>
						<th>Date</th>
						<th>Action</th>
						<th>&nbsp;</th>
						<th>Prievew</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($ProjectList as $list){ 
							$ProjectPostedby=$this->AddProject_model->GetProjectlogdetails($list->projectID,'Draft'); $ProjectActivatedby=$this->AddProject_model->GetProjectlogdetails($list->projectID,'Active');?>
							<tr>
								<td><?=$list->projectKey;?></td>
								<td><?php if($list->userTypeName=='Agency'){ echo 'Agent'; }else{ echo $list->userTypeName; }?></td>
								<td><?=$list->projectName;?><br><?php $plan=explode(' ',$list->planTitle); if(isset($plan)){ echo $plan[0]; }?></td>
								<td><?=isset($ProjectPostedby[0]->adminUserEmail)?$ProjectPostedby[0]->adminUserEmail:''?><br><?=isset($ProjectActivatedby[0]->adminUserEmail)?$ProjectActivatedby[0]->adminUserEmail:''?></td>
								<td><?=$list->userEmail;?></td>
								<td><?=$list->projectAddedDate;?></td>
								<td>
								   <div class="action-icons">
									<a href="<?=base_url();?>AddProject/index/<?=$list->projectID;?>" title="Edit" alt="Edit"><i class="fa fa-edit"></i></a>
									<a href="<?=base_url();?>AddProject/ProjectLog/<?=$list->projectID;?>" title="Log" alt="Log"><i class="fa fa-archive"></i></a>
									<a href="<?=base_url();?>AddProject/StatusUpdate/<?=$list->projectID;?>/Deleted/Project" title="Delete" alt="Delete" onClick="return confirm('Are you sure to delete this Project ? This will delete all the related records on this Project as well.') " ><i class="fa fa-trash"></i></a><br>
								   <!--<a href="#" title="Pause" alt="Pause"><i class="fa fa-pause"></i></a>-->
									<a href="<?=base_url();?>AddProject/PlanConsumptionModel/<?=$list->projectID;?>/Refresh/Project" data-toggle="modal" data-target=".bs-example-modal-lg" title="Refresh" alt="Refresh" onclick="return confirm('Are You Sure You Want To Refresh Your Project....');" ><i class="fa fa-refresh"></i></a>
									<a <?php if($list->projectStatus!=='Active'){ ?> onclick="return confirm('Do You Want To Activate This Project....');" title="Active" alt="Active" href="<?=base_url();?>AddProject/StatusUpdate/<?=$list->projectID;?>/Active/Project" <?php }else{ ?> href="<?=base_url();?>AddProject/StatusUpdate/<?=$list->projectID;?>/Inactive/Project" onclick="return confirm('Do You Want To Inactive This Project....');" title="Inactive" alt="Inactive" <?php }?> ><i class="fa fa-lightbulb-o"></i></a>
								   </div>
							   </td>
							   <td><?php if($list->projectStatus=='Active'){ ?><i class="fa fa-check" title="Active"></i><?php } ?> </td>
								<td><a href="http://<?=$this->data['global'];?>/india/en/sale/residential_project-for-sale.htm/<?=$list->projectKey;?>/pdet/preview/" class="btn btn-success taright" target="_blank" title="Project Preview">Preview</a></td>
							</tr>
						<?php $i++; } ?> 
                   </tbody>
                </table>
				
                </div>
              </div>
               </div>
                  
          </div>
          
		</div>
    </div>
	  
<script type="text/javascript">

	$(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
        target.removeData('bs.modal')
              .find(".modal-content").html('');
    });
            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form .btn').on('click', function () {
                    $('#demo-form').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });

            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form2 .btn').on('click', function () {
                    $('#demo-form2').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
        </script> 
<!-- /form validation --> 
<!-- editor --> 
<script>
            $(document).ready(function () {
                $('.xcxc').click(function () {
                    $('#descr').val($('#editor').html());
                });
            });

            $(function () {
                function initToolbarBootstrapBindings() {
                    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                    $.each(fonts, function (idx, fontName) {
                        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                    });
                    $('a[title]').tooltip({
                        container: 'body'
                    });
                    $('.dropdown-menu input').click(function () {
                            return false;
                        })
                        .change(function () {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function () {
                            this.value = '';
                            $(this).change();
                        });

                    $('[data-role=magic-overlay]').each(function () {
                        var overlay = $(this),
                            target = $(overlay.data('target'));
                        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                    });
                    if ("onwebkitspeechchange" in document.createElement("input")) {
                        var editorOffset = $('#editor').offset();
                        $('#voiceBtn').css('position', 'absolute').offset({
                            top: editorOffset.top,
                            left: editorOffset.left + $('#editor').innerWidth() - 35
                        });
                    } else {
                        $('#voiceBtn').hide();
                    }
                };

                function showErrorAlert(reason, detail) {
                    var msg = '';
                    if (reason === 'unsupported-file-type') {
                        msg = "Unsupported format " + detail;
                    } else {
                        console.log("error uploading file", reason, detail);
                    }
                    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                };
                initToolbarBootstrapBindings();
                $('#editor').wysiwyg({
                    fileUploadError: showErrorAlert
                });
                window.prettyPrint && prettyPrint();
            });
        </script> 
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
	<script type="text/javascript">
        $(document).ready(function () {
            
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
             
        });
    </script> 
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
		$(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
		target.removeData('bs.modal')
		.find(".modal-content").html('');
		});
	</script> 