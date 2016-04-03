<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Calling Lead List</h3>
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
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Compaign</h2>
              
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form id="demo-form2" data-parsley-validate class="form-group form-label-left clearfix">
                  <div class="row">
                    <div class="form-group col-xs-12 col-sm-4">
                      <label class="control-label" for="first-name">Compaign Start Date <span class="required">*</span> </label>
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="09/30/2015" aria-describedby="inputSuccess2Status2">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                    
                    
                    
                    <div class="form-group col-xs-12 col-sm-4 martop20">
                      
                    <button type="submit" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success">Search</button>
          
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-4 martop20">
                      
                   
          
                    </div>
                  </div>
                 <!-- <div class="ln_solid"></div>-->
                 
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Calling Lead Table </h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                  <thead>
                    <tr>
                      <th>Project Name</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact No</th>
                      <th>Property Type</th>
                      <th>Budget</th>
                      <th>Date - time Generation </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Shree Gold City</td>
                      <td>Aravind</td>
                      <td>raj@homeonline.com</td>
                      <td>8458809192</td>
                      <td>2BHK, 3BHK Flat</td>
                      <td>50Lac - 70Lac</td>
                      <td>10/12/2015</td>
                     
                    </tr>
                    
                    <tr>
                      <td>Shree Gold City</td>
                      <td>Aravind</td>
                      <td>raj@homeonline.com</td>
                      <td>8458809192</td>
                      <td>2BHK, 3BHK Flat</td>
                      <td>50Lac - 70Lac</td>
                      <td>10/12/2015</td>
                     
                    </tr>
                    
                    <tr>
                      <td>Shree Gold City</td>
                      <td>Aravind</td>
                      <td>raj@homeonline.com</td>
                      <td>8458809192</td>
                      <td>2BHK, 3BHK Flat</td>
                      <td>50Lac - 70Lac</td>
                      <td>10/12/2015</td>
                     
                    </tr>
                    
                    
                    <tr>
                      <td>Shree Gold City</td>
                      <td>Aravind</td>
                      <td>raj@homeonline.com</td>
                      <td>8458809192</td>
                      <td>2BHK, 3BHK Flat</td>
                      <td>50Lac - 70Lac</td>
                      <td>10/12/2015</td>
                     
                    </tr>

                  </tbody>
                </table>
              </div>
              
              
              
              
              
              
              
            </div>
                  
          </div>
          
    
        </div>
      </div>
      <!-- /page content --> 