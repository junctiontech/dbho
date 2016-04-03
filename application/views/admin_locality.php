<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Locality Filter</h3>
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
        <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs tabadjst" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Active Filters</a> </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Delete Filter</a> </li>
                   
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Compaign table </h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content scor-bott">
                <table id="morbt" class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Location </th>
                      <th>Budget Min</th>
                      <th>Budget Max</th>
                      <th>Type</th>
                      <th>Bedroom</th>
                      <th>Buy / Rent</th>
                      <th>Old Requirements</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Qty</th>
                      
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Jayanagar</td>
                      <td>40</td>
                      <td>50</td>
                      <td>Flate</td>
                      <td>2 BHK</td>
                      <td>Buy</td>
                      <td>Yes Dayes 15</td>
                      <td>10/31/2015</td>
                       <td>10/31/2015</td>
                       <td>100</td>
                       <td>
                                        
                                          <a href="#"><span class="fa fa-close"></span></a>
                                    
                                      </td>
                    </tr>
                    
                     <tr>
                      <td>Jayanagar</td>
                      <td>40 <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>50 <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>Flate <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>2 BHK <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>Buy <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>Yes Dayes 15</td>
                      <td>10/31/2015</td>
                       <td>10/31/2015</td>
                       <td>100</td>
                       <td><a href="#">  <span class="fa fa-close"></span></a> </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              
             
            </div>
            <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12">
                     <button type="submit" class="btn btn-success btn-lg">Save</button>
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-12 text-right">
                    <button type="submit" class="btn btn-success" onclick="createplantable2()">Add More</button>
                    </div>
          </div> 
          </div>
          
    
        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                     <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Compaign table </h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content scor-bott">
                <table  class="table table-bordered table-hover vert-aliins">
                  <thead>
                    <tr>
                      <th>Location </th>
                      <th>Budget Min</th>
                      <th>Budget Max</th>
                      <th>Type</th>
                      <th>Bedroom</th>
                      <th>Buy / Rent</th>
                      <th>Old Requirements</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Qty</th>
                      
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Jayanagar</td>
                      <td>40</td>
                      <td>50</td>
                      <td>Flate</td>
                      <td>2 BHK</td>
                      <td>Buy</td>
                      <td>Yes Dayes 15</td>
                      <td>10/31/2015</td>
                       <td>10/31/2015</td>
                       <td>100</td>
                       <td>
                                        
                                          <a href="#"><span>Recreate</span></a>
                                    
                                      </td>
                    </tr>
                    
                     <tr>
                      <td>Jayanagar</td>
                      <td>40 <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>50 <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>Flate <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>2 BHK <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>Buy <a href="#/caret-down"><i class="fa fa-caret-down"></i></a></td>
                      <td>Yes Dayes 15</td>
                      <td>10/31/2015</td>
                       <td>10/31/2015</td>
                       <td>100</td>
                       <td>
                                        
                                        <a href="#">  <span>Recreate</span></a>
                                        
                                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              
             <!-- <div class="valusho pull-left"> <h5>Compaign Amount :  Rs 335090 </h5></div>
              <div class="valusho pull-right"> <button class="btn btn-info btn-lg" type="button">Create</button></div>-->
            </div>
                  
          </div>
          
    
        </div>
                    </div>
                    
                  </div>
                </div>
              </div>

        
        
        <div class="clearfix"></div>
      </div>
      <!-- /page content --> 
	    <script type="text/javascript">
function createplantable2()
{
document.getElementById("morbt").insertRow(1).innerHTML = '<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td><p>Remove</p></td>';
}
$('#morbt').on('click','td p',function(){
$(this).closest('tr').remove();
});
</script>