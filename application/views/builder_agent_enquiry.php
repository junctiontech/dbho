<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Lead Management</h3>
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
            <div class="x_panel">
              <div class="x_title">
                <h2>Manage User Form</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form id="demo-form2" data-parsley-validate class="form-group form-label-left clearfix">
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Lead ID <span class="required">*</span> </label>
                    <input type="text" id="first-name" required="required" class="form-control">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">Purpose <span class="required">*</span> </label>
                    <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Select</option>
                        <option value="HI">Hawaii</option>
                        </optgroup>
                      </select>
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Lead Scope</label>
                     <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name"> Project or Property ID <span class="required">*</span> </label>
                    <input type="text" id="first-name" required="required" class="form-control">
                  </div>
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Locality</label>
                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Budget</label>
                    <div class="row">
                    <div class="col-sm-6">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Min</option>
                        <option value="HI">20000</option>
                        </optgroup>
                      </select>
                      </div>
                       <div class="col-sm-6">
                      <select class="select2_group form-control">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                        <option value="AK">Max</option>
                        <option value="HI">50000</option>
                        </optgroup>
                      </select>
                      </div>
                      
                       
                      </div>
                  </div>
                  
                  
                  <div class="form-group col-xs-12 col-sm-3">
                    <label for="middle-name" class="control-label">Date Range</label>
                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                  </div>
                  
                  
                  
                  <div class="form-group col-xs-12 col-sm-3 martop20">
                  <button type="submit" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Search</button>
                   
                  </div>

                  </div>

                </form>
              </div>
              
              <div class="x_content scor-bott">
                <table class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Lead ID </th>
                      <th>Sharing Date - time</th>
                      <th>Buy / Rent</th>
                       <th>Project Name</th>
                       <th>Locality Name</th>
                        <th>Project / Propperty ID</th>
                      <th>Lead Scope</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact No</th>
                      <th>Property Type</th>
                      <th>Budget (Min - Max)</th>
                      <th> </th>
                      
                      
                     
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>AXBGH</td>
                      <td>10/31/2015</td>
                      <td>Buy</td>
                      <td>Shree Gold City</td>
                      <td>Jayanagar</td>
                      <td>XXXXXX</td>
                      <td>Project Lead</td>
                      <td>Sharad</td>
                      <td>san@ispg.in</td>
                       <td>1111100000</td>
                       <td>2BHK, 3BHK Flat</td>
                       <td>50Lac - 70Lac</td>
                       <td><a href="#"><i class="fa fa-twitch"></i></a></td>
                       
                    </tr>
                    
                    <tr>
                      <td>AXBGH</td>
                      <td>10/31/2015</td>
                      <td>Buy</td>
                      <td>Shree Gold City</td>
                      <td>Jayanagar</td>
                      <td>XXXXXX</td>
                      <td>Project Lead</td>
                      <td>Sharad</td>
                      <td>san@ispg.in</td>
                       <td>1111100000</td>
                       <td>2BHK, 3BHK Flat</td>
                       <td>50Lac - 70Lac</td>
                       <td><a href="#"><i class="fa fa-twitch"></i></a></td>
                       
                    </tr>
                    <tr>
                      <td>AXBGH</td>
                      <td>10/31/2015</td>
                      <td>Buy</td>
                      <td>Shree Gold City</td>
                      <td>Jayanagar</td>
                      <td>XXXXXX</td>
                      <td>Project Lead</td>
                      <td>Sharad</td>
                      <td>san@ispg.in</td>
                       <td>1111100000</td>
                       <td>2BHK, 3BHK Flat</td>
                       <td>50Lac - 70Lac</td>
                       <td><a href="#"><i class="fa fa-twitch"></i></a></td>
                       
                    </tr>
                    
                    
                    <tr>
                      <td>AXBGH</td>
                      <td>10/31/2015</td>
                      <td>Buy</td>
                      <td>Shree Gold City</td>
                      <td>Jayanagar</td>
                      <td>XXXXXX</td>
                      <td>Project Lead</td>
                      <td>Sharad</td>
                      <td>san@ispg.in</td>
                       <td>1111100000</td>
                       <td>2BHK, 3BHK Flat</td>
                       <td>50Lac - 70Lac</td>
                       <td><a href="#"><i class="fa fa-twitch"></i></a></td>
                       
                    </tr>
                    
                    
                    <tr>
                      <td>AXBGH</td>
                      <td>10/31/2015</td>
                      <td>Buy</td>
                      <td>Shree Gold City</td>
                      <td>Jayanagar</td>
                      <td>XXXXXX</td>
                      <td>Project Lead</td>
                      <td>Sharad</td>
                      <td>san@ispg.in</td>
                      <td>1111100000</td>
                      <td>2BHK, 3BHK Flat</td>
                      <td>50Lac - 70Lac</td>
                      <td><a href="#"><i class="fa fa-twitch"></i></a></td>
                      </tr>
                    
               </tbody>
                </table>
              </div>
              
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success btn-lg">Save</button>
            </div>
            </div>
          </div>
        </div>
        
        <div class="clearfix"></div>
        
        
      </div>
      <!-- /page content -->