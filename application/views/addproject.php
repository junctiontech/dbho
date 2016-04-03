<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Add Project</h3>
          </div>
          <div class="title_right">
            <div class="col-md-6 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group"> </div>
            </div>
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
        
        <!-- <div class="ln_solid"></div>-->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div id="project_wizard" class="swMain">
			  <input type="hidden" id="project" value="3" />
                <ul>
                  <li><a href="#step-1">
                    <label class="stepNumber">1</label>
                    <span class="stepDesc"> Step 1<br/>
                    <small>Basic Information</small> </span> </a></li>
                  <li><a href="#step-2">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc"> Step 2<br />
                    <small>Detailed Information</small> </span> </a></li>
                  <li><a href="#step-3">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc"> Step 3<br />
                    <small>Unit Information</small> </span> </a></li>
                </ul>
                <div id="step-1">
                  <h2 class="StepTitle">Basic Information</h2>
			     <div class="x_content">
                    <form id="form-1" method="post" class="form-group form-label-left clearfix" novalidate>
					<?php if(!empty($ProjectFilterData) && $ProjectFilterData[0]->projectID!==''){ ?>
					<div align="right">
						<label class="control-label" for="last-name">Language</label>
                        <select  class="" id="language" name="languageID" onchange="">
                            <?php foreach($ProjectLanguages as $language){ ?>
							 <option value="<?=$language->languageID;?>" ><?=$language->languageName;?></option>
							<?php } ?>
                        </select>
					</div>
					<?php } ?>
					  <input type="hidden" name="projectID" value="<?php if(!empty($ProjectFilterData)){ echo $ProjectFilterData[0]->projectID; }?>" r