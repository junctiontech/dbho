<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Users Request</h3>
			</div>
			<div class="title_right">

			</div>
		</div>

        <div class="clearfix"></div>
		<!-- Alert section For Message-->
		<?php if ($this->session->flashdata('message_type') == 'success') { ?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
				<strong><?= $this->session->flashdata('message') ?></strong>  </div>
		<?php } if ($this->session->flashdata('message_type') == 'error') { ?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
				<strong><?= $this->session->flashdata('message') ?></strong>  </div>
		<?php } ?>
		<!-- Alert section End-->
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Request <?php echo $request[0]->raiseRequestID ?></h2>
						<div class="clearfix"></div>
					</div>

					<div class="x_content paddbot">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>User</label></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><?php echo $request[0]->firstName .' '. $request[0]->lastName; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>Date</label></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><?php echo date('d-M-Y', strtotime($request[0]->createdDate)); ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>Email</label></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><?php echo $request[0]->email; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>Mobile</label></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><?php echo $request[0]->phoneNumber; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>Request Type</label></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><?php echo $request[0]->type; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>Comment</label></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><?php echo $request[0]->comment; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /page content -->