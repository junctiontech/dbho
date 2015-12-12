<!-- footer content -->
      <footer>
        <div class="">
          <p class="pull-right">Copyright <a>Homeonline</a>. | <span class="lead"> <i><img src="<?=base_url();?>images/logo-f.png"/></i> Homeonline</span> </p>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content --> 
    </div>
  </div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
  <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
  </ul>
  <div class="clearfix"></div>
  <div id="notif-group" class="tabbed_notifications"></div>
</div>
<script src="<?=base_url();?>js/bootstrap.min.js"></script> 

<!-- chart js --> 
<script src="<?=base_url();?>js/chartjs/chart.min.js"></script> 
<!-- bootstrap progress js --> 
<script src="<?=base_url();?>js/progressbar/bootstrap-progressbar.min.js"></script> 
<script src="<?=base_url();?>js/nicescroll/jquery.nicescroll.min.js"></script> 
<!-- icheck --> 
<script src="<?=base_url();?>js/icheck/icheck.min.js"></script> 
<!-- tags --> 
<script src="<?=base_url();?>js/tags/jquery.tagsinput.min.js"></script> 
<!-- switchery --> 
<script src="<?=base_url();?>js/switchery/switchery.min.js"></script> 
<!-- daterangepicker --> 
<script type="text/javascript" src="<?=base_url();?>js/moment.min2.js"></script> 
<script type="text/javascript" src="<?=base_url();?>js/datepicker/daterangepicker.js"></script> 
<!-- richtext editor --> 
<script src="<?=base_url();?>js/editor/bootstrap-wysiwyg.js"></script> 
<script src="<?=base_url();?>js/editor/external/jquery.hotkeys.js"></script> 
<script src="<?=base_url();?>js/editor/external/google-code-prettify/prettify.js"></script> 
<!-- select2 --> 
<script src="<?=base_url();?>js/select/select2.full.js"></script> 
<!-- form validation --> 
<script type="text/javascript" src="<?=base_url();?>js/parsley/parsley.min.js"></script> 
<!-- textarea resize --> 
<script src="<?=base_url();?>js/textarea/autosize.min.js"></script> 
<!-- Datatables --> 
<script src="<?=base_url();?>js/datatables/js/jquery.dataTables.js"></script> 
<script src="<?=base_url();?>js/datatables/tools/js/dataTables.tableTools.js"></script> 

<!-- bootstrap progress js --> 
<script src="<?=base_url();?>js/progressbar/bootstrap-progressbar.min.js"></script> 
<script src="<?=base_url();?>js/nicescroll/jquery.nicescroll.min.js"></script> 
<script>
            autosize($('.resizable_textarea'));
        </script> 
<!-- Autocomplete --> 
<script type="text/javascript" src="<?=base_url();?>js/autocomplete/countries.js"></script> 
<script src="<?=base_url();?>js/autocomplete/jquery.autocomplete.js"></script>
<script src="<?=base_url();?>js/bootstrap-datepicker.js"></script> 
<script src="<?=base_url();?>js/custom.js"></script> 
<script src="<?=base_url();?>js/moment.min.js"></script>
        <script src="<?=base_url();?>js/calendar/fullcalendar.min.js"></script>
<script src="<?=base_url();?>js/common_functions.js"></script> 
<script src="<?=base_url();?>js/script.js"></script> 
<script type="text/javascript">
            $(function () {
                'use strict';
                var countriesArray = $.map(countries, function (value, key) {
                    return {
                        value: value,
                        data: key
                    };
                });
                // Initialize autocomplete with custom appendTo:
                $('#autocomplete-custom-append').autocomplete({
                    lookup: countriesArray,
                    appendTo: '#autocomplete-container'
                });
            });
        </script> 
</body>
</html>