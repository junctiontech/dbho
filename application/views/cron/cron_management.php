 <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Cron Management</h3>
          </div>
          
        </div>
        <div class="clearfix"></div>
        <div class="ln_solid"></div>
         <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
			<?php 
				//----------------- Display Flash Messages -----------------//
				$message_data = $this->session->flashdata('message_data');
				if(!empty($message_data)) :
					if($message_data['type'] == 'success') :
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
					<strong><?php echo $message_data['message']; ?></strong>
				</div>
			<?php 
					endif;
				endif;
			//----------------- END Display Flash Messages -----------------//
			
			//----------------- Display Form -----------------//
			echo form_open('cron'); ?>
			
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Clear Inventory Data:</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <?php echo form_submit('action', 'clear_inv_data'); ?>
					  <br/>
					  <sub>This will delete all the inventory data on next cron run and update with fresh inventory data.<br><br></sub>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Manually Run Inventory Cron:</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <?php echo form_submit('action', 'run_inv_cron'); ?>
					  <br/>
					  <sub>This will run inventory cron manually on next cron run and update with fresh inventory data.<br><br></sub>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Manually Clear Cache:</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <?php echo form_submit('action', 'Clear Cache'); ?>
					  <br/>
					  <sub>Click this button to clear the cache.<br><br></sub>
                    </div>
                </div>
           
			<?php echo form_close(); 
			//----------------- END Display Form -----------------//
		?>
          
          </div>
          </div>
      </div>
      <!-- /page content --> 