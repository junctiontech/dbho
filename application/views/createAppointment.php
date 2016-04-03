<!-- ***********Rajesh Vishwakarma**************************************** -->
<!-- page content -->

<link href="<?=base_url();?>css/jquery.datetimepickerrj.css" rel="stylesheet">
<script src="<?=base_url();?>assests/js/script.js"></script>
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Appointment</h3>
          </div>
          
        </div>
        <div class="clearfix"></div>
        <div class="ln_solid"></div>
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
      <!-- Alert section For Message-->
     <!-- Alert section End-->
      <form class="form-horizontal form-label-left"  action="<?=base_url();?>Appointment/saveAppointment" method="post" enctype="multipart/form-data">
       <input type="hidden" value="<?php echo $pId;?>" name="pId" >
       <div class="appoint-detaion">
          <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6">
      	<div class="form-group">
		<label class="control-label"><big>Name :</big> <?php echo $getAppointment[0]->		userFirstName.' '.$getAppointment[0]->userLastName;?>
		</label>
		<input type="hidden" name="username" value="<?php echo $getAppointment[0]->userFirstName.' '.$getAppointment[0]->userLastName;?>" />
      </div>
      </div>
	  <div class="col-xs-12 col-sm-6 col-md-6">
      <div class="form-group">
			<label class="control-label"><big>PhoneNumber :</big> <?php echo $getAppointment[0]->userPhone;?></label>     
			<input type="hidden" name="phone" value="<?php echo $getAppointment[0]->userPhone;?>" />
      </div>
      </div>
      </div>
      <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6">
      
       <div class="form-group">
      <label class="control-label"><big>Address :</big> <?php echo $getAppointment[0]->userAddress1.' '.$getAppointment[0]->userAddress2;?></label>
      
		<input type="hidden" name="address" id="address" value="<?php echo $getAppointment[0]->userAddress1.' '.$getAppointment[0]->userAddress2;?>" />
      </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
      <div class="form-group">
      <label class="control-label"><big>Email :</big> <?php echo $getAppointment[0]->userEmail;?></label>
      <input type="hidden" name="email" value="<?php echo $getAppointment[0]->userEmail;?>" />
      </div>
      </div>
      </div>
      <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6">
	  <div class="form-group">
		<label class="control-label">
			<big>Property Purpose :</big> 
			<?php 

			if(isset($propertypurpose)){
				if(($propertypurpose[0]->propertyPurpose=='Sell'))
				{
					echo "sale";
				} 
			}
			?>
        </label>
      </div>
      </div>
      </div>
      
      </div>
       <!-- ************************rajesh***************************************** -->
                <?php 
                    if($getAppointment[0]->userTypeID==1){
                        $individualattribute = "checked";
                        if($individualattribute == "checked"){
                             $builderattribute_disabled = "disabled";
                             $agencyattribute_disabled = "disabled";
                             $agentattribute = "disabled";
                        }
                         
                    }else if($getAppointment[0]->userTypeID==3){
                          $builderattribute = "checked";
                          if($builderattribute == "checked"){
                             $individualattribute_disabled = "disabled";
                             $agencyattribute_disabled = "disabled";
                              $agentattribute = "disabled";
                        }
                          
                    }else if($getAppointment[0]->userTypeID==4){
                          $agencyattribute = "checked";
                          if($agencyattribute == "checked"){
                             $individualattribute_disabled = "disabled";
                             $builderattribute_disabled = "disabled";
                              $agentattribute = "disabled";
                        }
                          
                    }
                    else if($getAppointment[0]->userTypeID==2){
                          $agentattribute = "checked";
                          if($agentattribute == "checked"){
                             $individualattribute_disabled = "disabled";
                             $builderattribute_disabled = "disabled";
                              $agencyattribute_disabled = "disabled";
                        }
                          
                    }
                ?>
                <!--********************** End*********************************************** -->
				<input type="hidden" name="usertype" value="<?php echo $getAppointment[0]->userTypeID; ?>"  >
               
              <div class="form-group" >
                  <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                  <?php
                        $output = '';
                        if($getAppointment[0]->userTypeID==1){
                          $output .= '<label class="control-label" for="selectError">Individual</label><div class="controls"><select id="selectindividual" readonly name="selectindividual" data-rel="chosen" class="form-control">';
                         
                        }else if($getAppointment[0]->userTypeID==3){
                          $output .= '<label class="control-label" for="selectError">Builder</label><div class="controls"><select id="selectbuilder" readonly name="selectbuilder" data-rel="chosen" class="form-control">';
                          
                        }
                        else if($getAppointment[0]->userTypeID==2){
                          $output .= '<label class="control-label" for="selectError">Agent</label><div class="controls"><select id="selectagent" readonly name="selectagent" data-rel="chosen" class="form-control">';
                          
                        }
                        else{
                          $output .= '<label class="control-label" for="selectError">Agency</label><div class="controls"><select id="selectagency" readonly name="selectagency" data-rel="chosen" class="form-control">';
                          
                        }

                          $output .= '<option value="'.$getAppointment[0]->userID.'"';
                            $output .= "selected";
                          $output .= '>';
                          $output .= $getAppointment[0]->userFirstName.' '.$getAppointment[0]->userLastName.' ('.$getAppointment[0]->userEmail.')';
                          $output .=  '</option>'; 

              
                        $output .=  '</select>';
                        echo $output;
                  ?>
                  </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
				  <div class="form-group">
                <label class="control-label" for="selectError">Appointment Status</label><div class="controls">
                <select id="selectstatus" name="selectstatus" data-rel="chosen" class="form-control" >
                    <option value="0">Select Appointment Status</option>
                    
                    <!--option value="complete">Complete</option-->
					<option value="Open" >Open</option>                           
                  </select>
              </div>
              </div>
                  
              </div>
			  <?php 
			   if(isset($propertypurpose)){
				if($propertypurpose[0]->propertyPurpose=='Sell'){$sale = 1;}
				if($propertypurpose[0]->propertyPurpose=='Rent'){$sale = 2;}
			   }
			   ?>
			  <input type="hidden" name="ptype" value="<?php echo @$sale; ?>"  >
			  
              </div>
              
              <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">

                <div class="form-group">
                <label for="exampleInputEmail1" class="control-label">Select Date and Time</label>
				<input type="text" class="form-control" name="date" id="datetimepicker"/>
                </div>
                 
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
              
			  
			  <span id="appuserassign"> </span>
			  
			  
			  
              </div>
              <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group col-xs-12 col-sm-12 col-md-12">
      <label class="control-label">Notes</label>
      <textarea data-parsley-validation-threshold="10"  data-parsley-maxlength="100" data-parsley-minlength="20" data-parsley-trigger="keyup" name="notes" class="form-control" id="notes"></textarea>
      </div>
      </div>
      </div>
              </div> 
              <input type="submit" name="appointmentbut" value="Save" class="btn btn-success appsave" onclick="return validation();" />
           
<script src="<?=base_url();?>js/jqueryrj.js"></script>

<script src="<?=base_url();?>js/jquery.datetimepicker.fullrj.js"></script>
<script>
$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({
	value:'', format: $("#datetimepicker_format_value").val()
	
	});
$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
	
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
	
});
$('#datetimepicker').datetimepicker({value:'',step:60});

$('.some_class').datetimepicker();

$('#datetimepicker_dark').datetimepicker({theme:'dark'})
</script>
              <!-- <div class="clearfix"></div>
       -->

