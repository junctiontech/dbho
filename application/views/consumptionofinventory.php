
<!-- page content -->
                <div class="right_col" role="main">
                    <div class="">

                       
        <div class="clearfix"></div>
        
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Check Inventory Consumption</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form action="<?=base_url();?>Inventory/InventoryConsumption" method="post"  class="form-group form-label-left clearfix">
                <div class="row">
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="first-name">Inventory Name <span class="required">*</span> </label>
                    <select required name="inventoryid" class="select2_group form-control" onchange="getcityforcalendarinventory(this.value);">
											<option value="">Select Inventory</option>
											<?php foreach($inventory as $inventory1){?>
											<option value="<?=isset($inventory1->inventorytypeID)?$inventory1->inventorytypeID:''?>" <?php if(!empty($inventorytypeid)){ if($inventorytypeid==$inventory1->inventorytypeID){ echo"selected";} } ?>><?=isset($inventory1->inventoryname)?$inventory1->inventoryname:''?></option>
											<?php } ?>
										    </select>
                  </div>
                  <div class="form-group col-xs-12 col-sm-3">
                    <label class="control-label" for="last-name">City <span class="required">*</span> </label>
					<div id="inventorycity" class="form-group col-xs-12 col-sm-12">
                   <select required name="cityid" class="select2_group form-control ">
											<option value="">Select City</option>
											<?php foreach($cities as $cities1){?>
											<option value="<?=isset($cities1->cityID)?$cities1->cityID:''?>" <?php if(!empty($cityid)){ if($cityid==$cities1->cityID){ echo"selected";} } ?>><?=isset($cities1->cityName)?$cities1->cityName:''?></option>
											<?php } ?>
											</select>
                  </div> </div>
                  
                  
                  <div class="form-group col-xs-12 col-sm-3 martop20">
                  <button class="btn btn-success" name="submit" value="submit" type="submit">Get!</button>
                   
                  </div>

                  </div>

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
		 <?php } ?>
		 <!-- Alert section End-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Calender View To See Inventory Consumption On Date </h2>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div id='calendar'></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
	  <script>
            $(window).load(function () {

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var started;
                var categoryClass;

                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        $('#fc_create').click();

                        started = start;
                        ended = end

                        $(".antosubmit").on("click", function () {
                            var title = $("#title").val();
                            if (end) {
                                ended = end
                            }
                            categoryClass = $("#event_type").val();

                            if (title) {
                                calendar.fullCalendar('renderEvent', {
                                        title: title,
                                        start: started,
                                        end: end,
                                        allDay: allDay
                                    },
                                    true // make the event "stick"
                                );
                            }
                            $('#title').val('');
                            calendar.fullCalendar('unselect');

                            $('.antoclose').click();

                            return false;
                        });
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        //alert(calEvent.title, jsEvent, view);

                        $('#fc_edit').click();
                        $('#title2').val(calEvent.title);
                        categoryClass = $("#event_type").val();

                        $(".antosubmit2").on("click", function () {
                            calEvent.title = $("#title2").val();

                            calendar.fullCalendar('updateEvent', calEvent);
                            $('.antoclose2').click();
                        });
                        calendar.fullCalendar('unselect');
                    },
                    editable: true,
                    events: [<?=isset($event)?$event:''?>]
                });
            });
        </script>
		
		<script>
            $(document).ready(function () {
                
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
            });
			
			$(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });
        </script> 