<?php //print_r($status);?>
<script src="<?=base_url();?>assests/js/appvalid.js"></script>
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
			
		  <h3>
		Edit App User
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
		
<div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ></span> </button>
                <strong></strong>  </div>
</div>

		 <!-- Alert section End-->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
                <h2>Edit App User </h2>
                
                <div class="clearfix"></div>
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
<form id="demo-form2" action="<?php echo base_url();?>Addappusers/saveEditAppuser/" method="post" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
				<?php //echo"<pre>";print_r($userInfo);?>
				
					<div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="first-name">User Name</label>
                    <input type="text" id="username" name="username" value="<?php echo $userInfo[0]->username?>" class="form-control">
                  </div>
				  <div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $userInfo[0]->name?>" class="form-control">
                  </div>
					<input type="hidden" id="userid" name="userid" value="<?php echo $userInfo[0]->userID?>" class="form-control">
					<div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="user-email">User Email</label>
                    <input type="text" id="user-email" name="email" value="<?php echo $userInfo[0]->email?>" class="form-control">
                  </div>
				  <div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php //echo $userInfo[0]->password?>" class="form-control">
                  </div>
				  <div class="form-group col-xs-12 col-sm-3">
                     <label class="control-label" for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" value="" class="form-control">
					<span id="confirmspan" style="color:red;"> </span>
                  </div>
				
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="user-city">User City</label>
                    
					<select class="select2_group form-control" name="usercity" id="usercity">
                    <option value="0">Select User City</option>
					
					<option value="5" selected><?php echo $getCity[0]->cityName?></option>
				
					</select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Status</label>
                    <select class="select2_group form-control" name="status" id="status">
                    <option value="Select Status">Select Status</option>
					<?php foreach($userInfo as $key=>$value){?>
					<option value="1"<?php if($value->status==1)
					{echo "selected";}?> > Active </option>
					<option value="0"<?php if($value->status==0)
					{echo "selected";}?> > Inactive </option>
					<?php }?>
					</select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-4 martop20">
                  <!--button type="button"  class="btn btn-primary">Reset</button-->
                  
				   <input type="submit" name="submit" value="Save" class="btn btn-success" onclick="return AppvalidationEdit();">
                  </div>

                  </div>

                </form>