<!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Property</h3>
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
              <!--<div class="reffresh-button"><a href="#" class="fa fa-refresh"> </a></div>-->
              <div id="wizard" class="swMain">
                <ul>
                  <li><a href="#step-1">
                    <label class="stepNumber">1</label>
                    <span class="stepDesc"> Step 1<br />
                    <small>Basic Information</small> </span> </a></li>
                  <li><a href="#step-2">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc"> Step 2<br />
                    <small>Detailed Information</small> </span> </a></li>
                  <li><a href="#step-3">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc"> Step 3<br />
                    <small>Other Information</small> </span> </a></li>
                  <li><a href="#step-4">
                    <label class="stepNumber">4</label>
                    <span class="stepDesc"> Step 4<br />
                    <small>preview page</small> </span> </a></li>
                </ul>
                <div id="step-1">
                  <h2 class="StepTitle">Basic Information</h2>
                  <div class="x_content">
                    <form id="demo-form2"  class="form-group form-label-left clearfix">
                      <div class="row">
                        <div class="form-group clearfix">
                          <div class="form-group col-xs-12 col-sm-3" style="padding-top:8px;">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default">
                                <input type="radio" name="propertypurpose" value="Sell" id="option1">
                                Sell </label>
                              <label class="btn btn-default">
                                <input type="radio" name="propertypurpose" value="Rent" id="option2">
                                Rent </label>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-5" style="padding-top:8px;">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-default">
                                <input type="radio" name="type" value="Unit" id="option1">
                                Individual Property </label>
                              <label class="btn btn-default" id="unit_project">
                                <input type="radio" name="type" value="Property" id="option2">
                                Property Under Project </label>
                            </div>
                          </div>
                          <div class="form-group col-xs-12 col-sm-4" style="padding-top:8px;"> <span id="unit1">
                            <select name="projectid" class="form-control select2_group project-uni">
                              <option value="">Select Project</option>
                              <option value="HI">KKV cold</option>
                              <option value="HI">The Homes</option>
                              <option value="HI">Pradhan Urban Live</option>
                            </select>
                            <style>
					   .parsley-errors-list {display:none;}
					   </style>
                            </span> </div>
                          <script type="text/javascript">
					$(function() {
						// disable all the input boxes
						$(".project-uni").attr("disabled", true);
				
						// add handler to re-enable input boxes on click
						$("#unit_project").click(function() {
							$(".project-uni").removeAttr("disabled");
						});
					});
				</script> 
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Property Type <span class="required">*</span> </label>
                          <select name="propertyTypeID" class="  form-control">
                            <option value="">Select</option>
                            <optgroup label="Residential Properties">
                            <option value="HI">Apartment</option>
                            <option value="HI">Builder Floor</option>
                            <option value="HI">Row House</option>
                            <option value="HI">Villas</option>
                            <option value="HI">Farm House</option>
                            <option value="HI">Service Apartment</option>
                            <option value="HI">Residential Plot</option>
                            <option value="HI">Studio Apartment</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                          <label class="control-label" for="first-name">Property Name <span class="required">*</span> </label>
                          <input name="propertyname" type="text" id="first-name" required="required" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                          <label style="display:block;" class="control-label">User Type</label>
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                              <input type="radio" name="usertype" value="" id="option1">
                              Agent </label>
                            <label class="btn btn-default">
                              <input type="radio" name="usertype" value="" id="option2">
                              Builder </label>
                            <label class="btn btn-default">
                              <input type="radio" name="usertype" value="" id="option3">
                              Individual </label>
                          </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                          <label for="middle-name" class="control-label">Agent</label>
                          <select name="userid" class=" select2_group form-control">
                            <option value="">Select</option>
                            <option value="1">Rajeshpal@homeonline.com</option>
                            <option value="2">sharad@homeonline.com</option>
                            <option value="3">anand@homeonline.com</option>
                            <option value="4">shailendra@homeonline.com</option>
                            <option value="5">rahjesh@homeonline.com</option>
                            </optgroup>
                          </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4 ">
                          <label for="middle-name" class="control-label">User Plan</label>
                          <select name="planid" class=" select2_group form-control">
                            <option value="">Select</option>
                            <option value="1">Free Listing Plan</option>
                            <option value="2">Silver Plan</option>
                            <option value="3">Gold Plan</option>
                            <option value="4">Platinum Plan</option>
                            </optgroup>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">
                          <label class="control-label">Description</label>
                          <div id="alerts"></div>
                          <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                            <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa icon-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              </ul>
                            </div>
                            <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li><a data-edit="fontSize 5">
                                  <p style="font-size:17px">Huge</p>
                                  </a> </li>
                                <li><a data-edit="fontSize 3">
                                  <p style="font-size:14px">Normal</p>
                                  </a> </li>
                                <li><a data-edit="fontSize 1">
                                  <p style="font-size:11px">Small</p>
                                  </a> </li>
                              </ul>
                            </div>
                            <div class="btn-group"> <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a> <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a> <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a> <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a> </div>
                            <div class="btn-group"> <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a> <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a> <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a> <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a> </div>
                            <div class="btn-group"> <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a> <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a> <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a> <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a> </div>
                            <div class="btn-group"> <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
                              <div class="dropdown-menu input-append">
                                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                <button class="btn" type="button">Add</button>
                              </div>
                              <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a> </div>
                            <div class="btn-group"> <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
                              <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                            </div>
                            <div class="btn-group"> <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a> <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a> </div>
                          </div>
                          <div id="editor"> </div>
                          <textarea name="description" id="descr" style="display:none;"></textarea>
                          <br />
                        </div>
                        <div class="form-group col-xs-12 col-sm-12"> </div>
                      </div>
                      <div class="row">
                        <div class="x_content"> 
                          
                          <!-- start accordion -->
                          <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                              <h4 class="panel-title StepTitle">Property Specification</h4>
                              </a>
                              <div id="collapseOne1" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body black-filed">
                                  <div class="form-group col-xs-12 col-sm-4 martop20">
                                    <label class="control-label" for="last-name">Bed Rooms </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 martop20">
                                    <label class="control-label" for="last-name">Bath Rooms </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 martop20">
                                    <label class="control-label" for="last-name">Balcony </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <!--<div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Wash Dry Area </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>-->
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Parking </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Society Name </label>
                                    <input id="middle-name" class="form-control" type="text" name="middle-name">
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Ownership Type </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4">
                                    <label class="control-label" for="last-name">Main Entrance Facing </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">North</option>
                                      <option value="HI">East</option>
                                      <option value="HI">West</option>
                                      <option value="HI">South</option>
                                      <option value="HI">North-East</option>
                                      <option value="HI">North-West</option>
                                      <option value="HI">South-East</option>
                                      <option value="HI">South-West</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Servant Room </label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Gated Community</label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Registered Society</label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Total Floor</label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4 ">
                                    <label class="control-label" for="last-name">Furnishing Status</label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4">
                                    <label class="control-label" for="last-name">Floor No.</label>
                                    <select class="  form-control">
                                      <optgroup label="Select">
                                      <option value="AK">Lower Basement</option>
                                      <option value="HI">Upper Basement</option>
                                      <option value="AK">Ground</option>
                                      <option value="AK">1</option>
                                      <option value="HI">2</option>
                                      <option value="AK">3</option>
                                      <option value="HI">4</option>
                                      <option value="AK">5</option>
                                      <option value="HI">6</option>
                                      <option value="AK">7</option>
                                      <option value="HI">8</option>
                                      </optgroup>
                                    </select>
                                  </div>
                                  <div class="form-group col-xs-12 col-sm-4">
                                    <label class="control-label" for="last-name" style="display:block;">Water Supply</label>
                                    <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                    Muncipal Corp</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                    Bore Well</span> </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne12" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne12" aria-expanded="false" aria-controls="collapseOne12">
                              <h4 class="panel-title StepTitle">Area</h4>
                              </a>
                              <div id="collapseOne12" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15" style="text-align:right">Covered Area</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input id="middle-name" placeholder="Covered Area" class="form-control" type="text" name="middle-name">
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="1">Sq-ft</option>
                                          <option value="2">Sq-yrd</option>
                                          <option value="3">Sq-m</option>
                                          <option value="3">Acre</option>
                                          <option value="4">Bigha</option>
                                          <option value="5">Hectare</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15" style="text-align:right">Plot Area</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input id="middle-name" placeholder="Plot Area" class="form-control" type="text" name="middle-name">
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="1">Sq-ft</option>
                                          <option value="2">Sq-yrd</option>
                                          <option value="3">Sq-m</option>
                                          <option value="3">Acre</option>
                                          <option value="4">Bigha</option>
                                          <option value="5">Hectare</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15" style="text-align:right">Carpet Area</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input id="middle-name" placeholder="Carpet Area" class="form-control" type="text" name="middle-name">
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="1">Sq-ft</option>
                                          <option value="2">Sq-yrd</option>
                                          <option value="3">Sq-m</option>
                                          <option value="3">Acre</option>
                                          <option value="4">Bigha</option>
                                          <option value="5">Hectare</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne13" data-toggle="collapse" data-parent="#accordion13" href="#collapseOne13" aria-expanded="false" aria-controls="collapseOne13">
                              <h4 class="panel-title StepTitle">Price & Other Charges </h4>
                              </a>
                              <div id="collapseOne13" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop20">Expected Price <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <label for="last-name" class="control-label">Crore</label>
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                          <option value="13">13</option>
                                          <option value="14">14</option>
                                          <option value="15">15</option>
                                          <option value="16">16</option>
                                          <option value="17">17</option>
                                          <option value="18">18</option>
                                          <option value="19">19</option>
                                          <option value="20">20</option>
                                          <option value="21">21</option>
                                          <option value="22">22</option>
                                          <option value="23">23</option>
                                          <option value="24">24</option>
                                          <option value="25">25</option>
                                          <option value="26">26</option>
                                          <option value="27">27</option>
                                          <option value="28">28</option>
                                          <option value="29">29</option>
                                          <option value="30">30</option>
                                          <option value="31">31</option>
                                          <option value="32">32</option>
                                          <option value="33">33</option>
                                          <option value="34">34</option>
                                          <option value="35">35</option>
                                          <option value="36">36</option>
                                          <option value="37">37</option>
                                          <option value="38">38</option>
                                          <option value="39">39</option>
                                          <option value="40">40</option>
                                          <option value="41">41</option>
                                          <option value="42">42</option>
                                          <option value="43">43</option>
                                          <option value="44">44</option>
                                          <option value="45">45</option>
                                          <option value="46">46</option>
                                          <option value="47">47</option>
                                          <option value="48">48</option>
                                          <option value="49">49</option>
                                          <option value="50">50</option>
                                          <option value="51">51</option>
                                          <option value="52">52</option>
                                          <option value="53">53</option>
                                          <option value="54">54</option>
                                          <option value="55">55</option>
                                          <option value="56">56</option>
                                          <option value="57">57</option>
                                          <option value="58">58</option>
                                          <option value="59">59</option>
                                          <option value="60">60</option>
                                          <option value="61">61</option>
                                          <option value="62">62</option>
                                          <option value="63">63</option>
                                          <option value="64">64</option>
                                          <option value="65">65</option>
                                          <option value="66">66</option>
                                          <option value="67">67</option>
                                          <option value="68">68</option>
                                          <option value="69">69</option>
                                          <option value="70">70</option>
                                          <option value="71">71</option>
                                          <option value="72">72</option>
                                          <option value="73">73</option>
                                          <option value="74">74</option>
                                          <option value="75">75</option>
                                          <option value="76">76</option>
                                          <option value="77">77</option>
                                          <option value="78">78</option>
                                          <option value="79">79</option>
                                          <option value="80">80</option>
                                          <option value="81">81</option>
                                          <option value="82">82</option>
                                          <option value="83">83</option>
                                          <option value="84">84</option>
                                          <option value="85">85</option>
                                          <option value="86">86</option>
                                          <option value="87">87</option>
                                          <option value="88">88</option>
                                          <option value="89">89</option>
                                          <option value="90">90</option>
                                          <option value="91">91</option>
                                          <option value="92">92</option>
                                          <option value="93">93</option>
                                          <option value="94">94</option>
                                          <option value="95">95</option>
                                          <option value="96">96</option>
                                          <option value="97">97</option>
                                          <option value="98">98</option>
                                          <option value="99">99</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <label for="last-name" class="control-label">Lac</label>
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                          <option value="13">13</option>
                                          <option value="14">14</option>
                                          <option value="15">15</option>
                                          <option value="16">16</option>
                                          <option value="17">17</option>
                                          <option value="18">18</option>
                                          <option value="19">19</option>
                                          <option value="20">20</option>
                                          <option value="21">21</option>
                                          <option value="22">22</option>
                                          <option value="23">23</option>
                                          <option value="24">24</option>
                                          <option value="25">25</option>
                                          <option value="26">26</option>
                                          <option value="27">27</option>
                                          <option value="28">28</option>
                                          <option value="29">29</option>
                                          <option value="30">30</option>
                                          <option value="31">31</option>
                                          <option value="32">32</option>
                                          <option value="33">33</option>
                                          <option value="34">34</option>
                                          <option value="35">35</option>
                                          <option value="36">36</option>
                                          <option value="37">37</option>
                                          <option value="38">38</option>
                                          <option value="39">39</option>
                                          <option value="40">40</option>
                                          <option value="41">41</option>
                                          <option value="42">42</option>
                                          <option value="43">43</option>
                                          <option value="44">44</option>
                                          <option value="45">45</option>
                                          <option value="46">46</option>
                                          <option value="47">47</option>
                                          <option value="48">48</option>
                                          <option value="49">49</option>
                                          <option value="50">50</option>
                                          <option value="51">51</option>
                                          <option value="52">52</option>
                                          <option value="53">53</option>
                                          <option value="54">54</option>
                                          <option value="55">55</option>
                                          <option value="56">56</option>
                                          <option value="57">57</option>
                                          <option value="58">58</option>
                                          <option value="59">59</option>
                                          <option value="60">60</option>
                                          <option value="61">61</option>
                                          <option value="62">62</option>
                                          <option value="63">63</option>
                                          <option value="64">64</option>
                                          <option value="65">65</option>
                                          <option value="66">66</option>
                                          <option value="67">67</option>
                                          <option value="68">68</option>
                                          <option value="69">69</option>
                                          <option value="70">70</option>
                                          <option value="71">71</option>
                                          <option value="72">72</option>
                                          <option value="73">73</option>
                                          <option value="74">74</option>
                                          <option value="75">75</option>
                                          <option value="76">76</option>
                                          <option value="77">77</option>
                                          <option value="78">78</option>
                                          <option value="79">79</option>
                                          <option value="80">80</option>
                                          <option value="81">81</option>
                                          <option value="82">82</option>
                                          <option value="83">83</option>
                                          <option value="84">84</option>
                                          <option value="85">85</option>
                                          <option value="86">86</option>
                                          <option value="87">87</option>
                                          <option value="88">88</option>
                                          <option value="89">89</option>
                                          <option value="90">90</option>
                                          <option value="91">91</option>
                                          <option value="92">92</option>
                                          <option value="93">93</option>
                                          <option value="94">94</option>
                                          <option value="95">95</option>
                                          <option value="96">96</option>
                                          <option value="97">97</option>
                                          <option value="98">98</option>
                                          <option value="99">99</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <label for="last-name" class="control-label">Thousand</label>
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                          <option value="13">13</option>
                                          <option value="14">14</option>
                                          <option value="15">15</option>
                                          <option value="16">16</option>
                                          <option value="17">17</option>
                                          <option value="18">18</option>
                                          <option value="19">19</option>
                                          <option value="20">20</option>
                                          <option value="21">21</option>
                                          <option value="22">22</option>
                                          <option value="23">23</option>
                                          <option value="24">24</option>
                                          <option value="25">25</option>
                                          <option value="26">26</option>
                                          <option value="27">27</option>
                                          <option value="28">28</option>
                                          <option value="29">29</option>
                                          <option value="30">30</option>
                                          <option value="31">31</option>
                                          <option value="32">32</option>
                                          <option value="33">33</option>
                                          <option value="34">34</option>
                                          <option value="35">35</option>
                                          <option value="36">36</option>
                                          <option value="37">37</option>
                                          <option value="38">38</option>
                                          <option value="39">39</option>
                                          <option value="40">40</option>
                                          <option value="41">41</option>
                                          <option value="42">42</option>
                                          <option value="43">43</option>
                                          <option value="44">44</option>
                                          <option value="45">45</option>
                                          <option value="46">46</option>
                                          <option value="47">47</option>
                                          <option value="48">48</option>
                                          <option value="49">49</option>
                                          <option value="50">50</option>
                                          <option value="51">51</option>
                                          <option value="52">52</option>
                                          <option value="53">53</option>
                                          <option value="54">54</option>
                                          <option value="55">55</option>
                                          <option value="56">56</option>
                                          <option value="57">57</option>
                                          <option value="58">58</option>
                                          <option value="59">59</option>
                                          <option value="60">60</option>
                                          <option value="61">61</option>
                                          <option value="62">62</option>
                                          <option value="63">63</option>
                                          <option value="64">64</option>
                                          <option value="65">65</option>
                                          <option value="66">66</option>
                                          <option value="67">67</option>
                                          <option value="68">68</option>
                                          <option value="69">69</option>
                                          <option value="70">70</option>
                                          <option value="71">71</option>
                                          <option value="72">72</option>
                                          <option value="73">73</option>
                                          <option value="74">74</option>
                                          <option value="75">75</option>
                                          <option value="76">76</option>
                                          <option value="77">77</option>
                                          <option value="78">78</option>
                                          <option value="79">79</option>
                                          <option value="80">80</option>
                                          <option value="81">81</option>
                                          <option value="82">82</option>
                                          <option value="83">83</option>
                                          <option value="84">84</option>
                                          <option value="85">85</option>
                                          <option value="86">86</option>
                                          <option value="87">87</option>
                                          <option value="88">88</option>
                                          <option value="89">89</option>
                                          <option value="90">90</option>
                                          <option value="91">91</option>
                                          <option value="92">92</option>
                                          <option value="93">93</option>
                                          <option value="94">94</option>
                                          <option value="95">95</option>
                                          <option value="96">96</option>
                                          <option value="97">97</option>
                                          <option value="98">98</option>
                                          <option value="99">99</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12 flo12"> <span>Or</span>
                                        <input id="middle-name" class="form-control pull-left" placeholder="Enter Total Price" type="text" name="middle-name">
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Price per Sq-ft <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input id="middle-name" class="form-control" type="text" name="middle-name">
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Show Rent as <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="radio mabott10">
                                          <label>
                                            <input type="radio" class="flat" checked name="iCheck">
                                            1 Lac </label>
                                          <label>
                                            <input type="radio" class="flat" name="iCheck">
                                            1 Lac Negotiable </label>
                                          <label>
                                            <input type="radio" class="flat" name="iCheck">
                                            Call For Price </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Price Includes </label>
                                      <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="checkbox cklabl">
                                          <label>
                                            <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                                            PLC </label>
                                          <label>
                                            <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                                            Car Parking </label>
                                          <label>
                                            <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2" required class="flat" />
                                            Club Membership </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Booking/Token Amount <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input id="middle-name" class="form-control" placeholder="Booking/Token Amount" type="text" name="middle-name">
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Maintenance Charges <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input id="middle-name" class="form-control" placeholder="Maintenance Charges" type="text" name="middle-name">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="0">Monthly</option>
                                          <option value="1">Quarterly</option>
                                          <option value="2">Yearly</option>
                                          <option value="3">One-Time</option>
                                          <option value="4">Per sq. Unit Monthly</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop15">Other Charges <i class="fa fa-rupee text-right"></i></label>
                                      <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input id="middle-name" class="form-control" placeholder="Other Charges" type="text" name="middle-name">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12"> </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading" role="tab" id="headingOne14" data-toggle="collapse" data-parent="#accordion14" href="#collapseOne14" aria-expanded="false" aria-controls="collapseOne14">
                              <h4 class="panel-title StepTitle">Transaction Type, Property Availability </h4>
                              </a>
                              <div id="collapseOne14" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop20">Transaction Type</label>
                                      <div class="col-md-10 col-sm-10 col-xs-12 martop15">
                                        <div class="radio mabott10">
                                          <label>
                                            <input type="radio" class="flat" checked name="iCheck">
                                            New Property </label>
                                          <label>
                                            <input type="radio" class="flat" name="iCheck">
                                            Resale </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Possession Status</label>
                                      <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="radio mabott10">
                                          <label>
                                            <input type="radio" class="flat" checked name="iCheck">
                                            Under Construction </label>
                                          <label>
                                            <input type="radio" class="flat" name="iCheck">
                                            Ready To Move </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Available From</label>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option value="-1">Month</option>
                                          <option value="1">January</option>
                                          <option value="2">February</option>
                                          <option value="3">March</option>
                                          <option value="4">April</option>
                                          <option value="5">May</option>
                                          <option value="6">June</option>
                                          <option value="7">July</option>
                                          <option value="8">August</option>
                                          <option value="9">September</option>
                                          <option value="10">October</option>
                                          <option value="11">November</option>
                                          <option selected="selected" value="12">December</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                      <div class="col-md-2 col-sm-2 col-xs-12">
                                        <select class="select2_group form-control">
                                          <optgroup label="Select">
                                          <option selected="selected" value="2015">Year</option>
                                          <option value="2014">2014</option>
                                          <option >2015</option>
                                          <option value="2016">2016</option
                                          >
                                          <option value="2017">2017</option>
                                          <option value="2018">2018</option>
                                          <option value="2019">2019</option>
                                          <option value="2020">2020</option>
                                          <option value="2021">2021</option>
                                          <option value="2022">2022</option>
                                          <option value="2023">2023</option>
                                          <option value="2024">2024</option>
                                          <option value="2025">2025</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group clearfix">
                                      <label class="control-label col-md-2 col-sm-2 col-xs-12 martop10">Age of Construction</label>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                        <select class="select2_group form-control">
                                          <option value="-1">Age of Construction</option>
                                          <option value="11651">New Construction</option>
                                          <option value="11652">Less than 5 years</option>
                                          <option value="11653">5 to 10 years</option>
                                          <option value="11654">10 to 15 years</option>
                                          <option value="11655">15 to 20 years</option>
                                          <option value="11656">Above 20 years</option>
                                          </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel"> <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                              <h4 class="panel-title StepTitle">Amenities </h4>
                              </a>
                              <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                  <div class="form-group col-xs-12 col-sm-12 martop20"> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                    Security</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                    Reserved Parking</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                                    Visitor Parking</span> <span class="checkbozsty">
                                    <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                                    Gymnasium</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                                    Lift</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                                    Waste Disposal</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="338" name="multiselect_Amenities_Intercom_6">
                                    Power Back Up</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="360" name="multiselect_Amenities_PipeGas_6">
                                    R O Water System</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="373" name="multiselect_Amenities_CentralizedAC_6">
                                    Conference Room</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="448" name="multiselect_Amenities_24hourswatersupply_6">
                                    Fire fighting Equipments</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="449" name="multiselect_Amenities_CCTV_6">
                                    Laundary Service</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="450" name="multiselect_Amenities_DTHTVFacilities_6">
                                    Vaastu Compliant</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="451" name="multiselect_Amenities_Guestaccomadation_6">
                                    Intercom</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="452" name="multiselect_Amenities_LaundryService_6">
                                    Club House</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    WiFi</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Rain Water Harvesting</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Swimming Pool</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Landscape - Flower Garden</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Property Staff - Maintenace Staff</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    School</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    ATM</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Worship</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Water Plant</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Bank</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Pipe Gas</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Shopping Center - Retail Shop</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Banquet Hall</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    24 Hours Water Supply</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Aerobic Room</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Amphithreater</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Barbeque Pit</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Basketball-Tennis Court</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Day care center</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    DTH TV Facilities</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Early Learning Centre - Play Group</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Golf Course</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Guest Accomadation</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Indoor Games Room</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Indoor Squash - badminton Court</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Kids Club</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Kids Play Area</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Meditiation Center</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Multiporpose Hall</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Paved Compound</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Recreational Pool - Facilities</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Rentable Community Space</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Service - Goods Lift</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Sewage Treatment Plan</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Skating Court</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Strolling Cycling and Jogging Track</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Waiting Lounge</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    CCTV</span> <span class="checkbozsty">
                                    <input type="checkbox" checked="" value="453" name="multiselect_Amenities_PowerBackup_6">
                                    Centralized AC</span> . </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end of accordion -->
                          
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h4 class="StepTitle">Property Location </h4>
                              <div class="form-group col-xs-12 col-sm-4 martop20 ">
                                <label class="control-label" for="last-name">Location Info </label>
                                <input id="geocomplete" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Locality </label>
                                <input id="sublocality" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 martop20">
                                <label class="control-label" for="last-name">Country </label>
                                <input id="country" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">State </label>
                                <input id="administrative_area_level_1" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">City / Area </label>
                                <input id="locality" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Zip / Postal Code </label>
                                <input id="postal_code" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Latitude </label>
                                <input id="middle-name" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-4 ">
                                <label class="control-label" for="last-name">Longitude </label>
                                <input id="middle-name" class="form-control" type="text" name="middle-name">
                              </div>
                              <div class="form-group col-xs-12 col-sm-12 mapinfo map_canvas" style="height: 400px"> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div id="step-2">
                  <h2 class="StepTitle">Add Photos</h2>
                  <div class="form-group col-xs-12 col-sm-12 martop20">
                    <p>Just click, Upload & Get upto 5 times higher response </p>
                    <div class="x_content">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs allbar-tabs tabadjst" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Exterior View</a> </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Living Room</a> </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Bedrooms</a> </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Bathrooms</a> </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Kitchen</a> </li>
                          <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Floor Plan</a> </li>
                          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Master Plan</a> </li>
                          <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Location Map</a> </li>
                          <li role="presentation" class=""><a href="#tab_content9" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Others</a> </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                  <div class="form-group col-md-12 col-xs-12 col-sm-12 martop15">
                                    <p>Accepted formats are .jpg, .gif, .bmp & .png. Maximum size allowed is 4 MB</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample2.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample2.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel marlemin">
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <form action="choices/add-property.html" class="dropzone" style="border: 1px dashed #e5e5e5; height: 131px; ">
                                    </form>
                                  </div>
                                  <div class="form-group col-md-8 col-xs-12 col-sm-8 martop15">
                                    <div class="phoadd">
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto .</p>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-2 col-xs-12 col-sm-2 martop15">
                                    <div class="sample">
                                      <p>Sample Exterior View</p>
                                      <img src="images/sample.jpg"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="x_content"> 
                    
                    <!-- start accordion -->
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                        <h4 class="panel-title StepTitle">Meta Details</h4>
                        </a>
                        <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Title </label>
                              <input id="middle-name" class="form-control" type="text" name="middle-name">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Meta Keywords </label>
                              <textarea placeholder="" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                              <label class="control-label" for="last-name">Meta Description </label>
                              <textarea placeholder="" rows="2" class="form-control"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion --> 
                    
                  </div>
                </div>
                <div id="step-3">
                  <div class="x_content head-sty"> 
                    
                    <!-- start accordion -->
                    <div class="accordion" id="accordion4" role="tablist" aria-multiselectable="true">
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion3" href="#collapseOne3" aria-expanded="false" aria-controls="collapseOne3">
                        <h4 class="panel-title StepTitle">Bed Room 1</h4>
                        </a>
                        <div id="collapseOne3" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="row">
                              <div class="form-group col-sm-2">
                                <label>Flooring Type</label>
                                <select class="form-control">
                                  <option>Marble</option>
                                  <option>Wood</option>
                                  <option>Ceramic</option>
                                  <option>Stone</option>
                                  <option>Laminate</option>
                                  <option>Anti Skid Tiles</option>
                                </select>
                              </div>
                            </div>
                            <div class=" clearfix"> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                              TV</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                              AC</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                              Bed</span> <span class="checkbozsty-1">
                              <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                              Dressing Table</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                              Wardrobe</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                              False Seiling</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="338" name="multiselect_Amenities_Intercom_6">
                              Attached Balcony</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="360" name="multiselect_Amenities_PipeGas_6">
                              Attached Bathroom</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="373" name="multiselect_Amenities_CentralizedAC_6">
                              Ventilation</span> </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                        <h4 class="panel-title StepTitle">Living Room 1</h4>
                        </a>
                        <div id="collapseOne4" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="row">
                              <div class="form-group col-sm-2">
                                <label>Flooring Type</label>
                                <select class="form-control">
                                  <option>Marble</option>
                                  <option>Wood</option>
                                  <option>Ceramic</option>
                                  <option>Stone</option>
                                  <option>Laminate</option>
                                  <option>Anti Skid Tiles</option>
                                </select>
                              </div>
                            </div>
                            <div class=" clearfix"> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                              Sofa</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                              Dining Table</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                              AC</span> <span class="checkbozsty-1">
                              <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                              Shoe Rack</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                              TV</span> <span class="checkbozsty-1">
                              <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                              False Seiling</span> </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion5" href="#collapseOne5" aria-expanded="false" aria-controls="collapseOne5">
                        <h4 class="panel-title StepTitle">Bath Room 1</h4>
                        </a>
                        <div id="collapseOne5" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Flooring Type</label>
                                  <select class="form-control">
                                    <option>Marble</option>
                                    <option>Wood</option>
                                    <option>Ceramic</option>
                                    <option>Stone</option>
                                    <option>Laminate</option>
                                    <option>Anti Skid Tiles</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                <div class="x_panel-1">
                                  <div class="x_title-1">
                                    <h4>Hot Water Supply</h4>
                                  </div>
                                  <div class="x_content-1">
                                    <div class="radio mabott10">
                                      <label>
                                        <input type="radio" class="flat" checked name="iCheck">
                                        Geyser </label>
                                      <label>
                                        <input type="radio" class="flat"  name="iCheck">
                                        Gas </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                <div class="x_panel-1">
                                  <div class="x_title-1">
                                    <h4>Toilet</h4>
                                  </div>
                                  <div class="x_content-1">
                                    <div class="radio mabott10">
                                      <label>
                                        <input type="radio" class="flat" checked name="iCheck">
                                        Indian </label>
                                      <label>
                                        <input type="radio" class="flat"  name="iCheck">
                                        Western </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="">
                              <div class="clearfix"> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                Glass Partition</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                Bath Tub</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                                Axhaust fan</span> <span class="checkbozsty-1">
                                <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                                Windows</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                                Shower Curtain</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                                Cabinet</span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel"> <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion6" href="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
                        <h4 class="panel-title StepTitle">kitchen 1</h4>
                        </a>
                        <div id="collapseOne6" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                  <label>Platform</label>
                                  <select class="form-control">
                                    <option>Simple</option>
                                    <option>Granite</option>
                                    <option>Marble</option>
                                    <option>Wooden</option>
                                    <option>Ceramic</option>
                                    <option>Kota Sin</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                <div class="x_panel-1">
                                  <div class="x_title-1">
                                    <h4>Cabinet</h4>
                                  </div>
                                  <div class="x_content-1">
                                    <div class="radio mabott10">
                                      <label>
                                        <input type="radio" class="flat" checked name="iCheck">
                                        Modular </label>
                                      <label>
                                        <input type="radio" class="flat"  name="iCheck">
                                        NA </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="">
                              <div class="clearfix"> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                                Refrigerator</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                                Water purifier</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                                Loft</span> <span class="checkbozsty-1">
                                <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                                Gas Pipline</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                                Microwave</span> <span class="checkbozsty-1">
                                <input type="checkbox" checked="" value="337" name="multiselect_Amenities_VaastuCompliant_6">
                                Chimaey</span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!--<div class="x_title-1">
                                  <h4>Toilet</h4>
                                </div> -->
                    
                    <h2 class="StepTitle">Other Information</h2>
                    <div class="row" style="margin-top:20px;"> </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="x_title-1">
                          <h4>Food</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" checked name="iCheck">
                              Veg</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              Non-Veg</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              No Preferences</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="x_title-1">
                          <h4>Pets Allowed</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" checked name="iCheck">
                              Yes</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              No</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="x_title-1">
                          <h4>Power Backup</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" checked name="iCheck">
                              Partial</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              Full</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              no backup</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Lease Type</label>
                          <select class="form-control">
                            <option>Family</option>
                            <option>Bachelors</option>
                            <option>Company</option>
                            <option>No Restriction</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>No of Lifts</label>
                          <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="x_title-1">
                          <h4>Boundary Wall</h4>
                        </div>
                        <div class="x_content-1">
                          <div class="radio mabott10">
                            <label>
                              <input type="radio" class="flat" checked name="iCheck">
                              Barbed Wire</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              Grill</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              Glass</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              Electric Wiring</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              brick wall</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              Cemented Wall</label>
                            <label>
                              <input type="radio" class="flat"  name="iCheck">
                              NA</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="x_title-1">
                          <h4>Water Backup</h4>
                        </div>
                        <div class="clearfix"> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="500" name="multiselect_Amenities_VaastuCompliant_6">
                          Grounded Tanks</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="501" name="multiselect_Amenities_Security_6">
                          Pterrace Tankse</span> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="x_title-1">
                          <h4>Miscellaneous</h4>
                        </div>
                        <div class="clearfix"> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="39" name="multiselect_Amenities_VaastuCompliant_6">
                          Servent Room</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="57" name="multiselect_Amenities_Security_6">
                          Private Terrace</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="58" name="multiselect_Amenities_ReservedParking_6">
                          Prayer Room</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="59" name="multiselect_Amenities_VisitorParking_6">
                          Terrace</span> <span class="checkbozsty-1">
                          <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                          Rent Negotiable</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="333" name="multiselect_Amenities_ROWaterSystem_6">
                          Security Deposit</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="338" name="multiselect_Amenities_VaastuCompliant_6">
                          Security Negotiable</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="39" name="multiselect_Amenities_VisitorParking_6">
                          Society OverHead Tank</span> <span class="checkbozsty-1">
                          <input type="checkbox" value="246" name="multiselect_Amenities_WiFi_6">
                          Smoke Detector</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="334" name="multiselect_Amenities_ROWaterSystem_6">
                          Fire Hydrant System</span> <span class="checkbozsty-1">
                          <input type="checkbox" checked="" value="339" name="multiselect_Amenities_VaastuCompliant_6">
                          Solar Water Heater</span> </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- end of accordion --> 
                  
                </div>
                <div id="step-4">
                  <h2 class="StepTitle">Basic Information</h2>
                  <div class="x_content">
                    <div style="margin-top:20px;" class="row labcol">
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label>Sell</label>
                          <p>Sell </p>
                        </div>
                      </div>
                      <div class="col-sm-3 ">
                        <div class="form-group botbott">
                          <label> Individual Property</label>
                          <p>Individual Property </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label>Select Project</label>
                          <p>Home Online</p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label>Property Type</label>
                          <p>Apartment </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> Property Name</label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> Current Status</label>
                          <p>Ready to Move </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> Date</label>
                          <p>25/12/2015 </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> User Type</label>
                          <p>Agent </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> Agent</label>
                          <p>pal@homeonline.com </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> User Plan</label>
                          <p>Silver Plan </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> Price</label>
                          <p>60000 </p>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group botbott">
                          <label> Negotiable </label>
                          <p>YES </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group botbott">
                          <label>Description</label>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Property Specification</h2>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Bed Rooms </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Bath Rooms </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Balcony </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Wash Dry Area </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Parking </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Structure </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Solar Water Heater </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Built Up Area </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Society Name </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Ownership Type </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Main Entrance Facing </label>
                          <p>North </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Servant Room </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Gated Community </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Plot Area </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Registered Society </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Sale Status </label>
                          <p>2 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Furnishing Status </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Carpet Area </label>
                          <p>1 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Age of Building </label>
                          <p>ABC </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Water Supply </label>
                          <p>Muncipal Corp </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Amenities</h2>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> Security </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Reserved Parking </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Visitor Parking </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Gymnasium </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> Lift </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Waste Disposal </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Power Back Up </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>R O Water System </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Conference Room </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Fire fighting Equipments </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Laundary Service </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Vaastu Compliant </label>
                          <p>YES </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Property Location </h2>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> Location Info </label>
                          <p>MP Nagar DB Mall </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Locality </label>
                          <p>MP Nagar </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Country </label>
                          <p>India </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>State </label>
                          <p>MP </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label> City / Area </label>
                          <p>Bhopal </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Zip / Postal Code </label>
                          <p>462011 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Latitude </label>
                          <p>12345678.32 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Longitude </label>
                          <p>12345678.32 </p>
                        </div>
                      </div>
                      <div class="col-sm-3 martop15">
                        <div class="form-group botbott">
                          <label>Status </label>
                          <p>Active </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Meta Details </h2>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Title </label>
                          <p>Xyz</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Meta Keywords </label>
                          <p>Xyz </p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Meta Description </label>
                          <p>Xyz </p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Bed Room 1</h2>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Flooring Type </label>
                          <p>Marble </p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>AC </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Bed </label>
                          <p>YES</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Dressing Table </label>
                          <p>YES</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Wardrobe </label>
                          <p>YES</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>False Seiling </label>
                          <p>YES</p>
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:20px;" class="row labcol">
                      <h2 class="StepTitle">Living Room 1</h2>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label> Flooring Type </label>
                          <p>Wood </p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Sofa </label>
                          <p>YES </p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Dining Table</label>
                          <p>YES</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>AC </label>
                          <p>YES</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>Shoe Rack </label>
                          <p>YES</p>
                        </div>
                      </div>
                      <div class="col-sm-4 martop15">
                        <div class="form-group botbott">
                          <label>TV </label>
                          <p>YES</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="last-name" style="display:block;">Status </label>
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="options" id="option1">
                            Active </label>
                          <label class="btn btn-default">
                            <input type="radio" name="options" id="option2">
                            Draft </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--<div id="step-4">
                  <h2 class="StepTitle">Step 4 Content</h2>
                </div>--> 
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /page content --> 
	
	
	 <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          blur: true,
          geocodeAfterResult: true
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
    </script>
	
	
   <script>
            function onAddTag(tag) {
                alert("Added a tag: " + tag);
            }

            function onRemoveTag(tag) {
                alert("Removed a tag: " + tag);
            }

            function onChangeTag(input, tag) {
                alert("Changed a tag: " + tag);
            }

            $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
            });
        </script> 
<!-- /input tags --> 
<!-- form validation --> 
<script type="text/javascript">
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
        $(document).ready(function () {
            
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
             
        });
    </script> 
<!-- /editor --> 

<script type="text/javascript">
    $(document).ready(function(){
    	// Smart Wizard 	
  		$('#wizard').smartWizard();
      
      function onFinishCallback(){
        $('#wizard').smartWizard('showMessage','Finish Clicked');
        alert('Finish Clicked');
      }     
		});
</script>
