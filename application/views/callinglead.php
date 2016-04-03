 <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Calling Lead Creation</h3>
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
        

        <div class="ln_solid"></div>
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
           <form class="form-horizontal form-label-left">

           <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Project 2</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
           
           
           <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="text" class="form-control" placeholder="Enter Your Name" data-parsley-id="8526">
                    </div>
                  </div>
           
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="text" class="form-control" placeholder="Enter Your Email" data-parsley-id="8526">
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Contact No</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="text" class="form-control" placeholder="Enter Your no" data-parsley-id="8526">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Property Type</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Property 2</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">BHK</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">2 BHK</option>
                        <option value="HI">3 BHK</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Budget</label>
                    <div class="col-md-10 col-sm-10 col-xs-12 budg-smal">
                    <div class="row">
                    <div class="col-sm-3">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Min</option>
                        <option value="HI">20000</option>
                        </optgroup>
                      </select>
                      </div>
                       <div class="col-sm-3">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Max</option>
                        <option value="HI">50000</option>
                        </optgroup>
                      </select>
                      </div>
                       <div class="col-sm-6"></div>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                     <button class="btn btn-success btn-lg" type="submit">Create Lead</button>
                    </div>
                  </div>
                  
                  
                  
                 </form>
          
          </div>
          </div>
      </div>
      <!-- /page content --> 