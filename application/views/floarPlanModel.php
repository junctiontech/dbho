<div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
	  <h4 class="modal-title" id="myModalLabel">Floar Plan Image</h4>
	</div>
	<!-- Alert section For Message-->
	 <?php  if($this->session->flashdata('message_type')=='success') { ?>
	  <div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
			<strong><?=$this->session->flashdata('message')?></strong>  </div>
	 <?php } if($this->session->flashdata('message_type')=='error') { ?>
	 <div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button>
			<strong><?=$this->session->flashdata('message')?></strong>  </div>
	 <?php } if($this->session->flashdata('category_error')) { ?>
	<div class="row" >
	<div class="alert alert-danger" >
	<strong><?=$this->session->flashdata('category_error')?></strong> <?php echo"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";?>
	</div>
	</div>
	<?php }?>
	<!-- Alert section End-->
	<div class="modal-body">
		
		<img style="width: 100%; display: block;" src="http://staging.homeonline.com/public/uploads/property/images/lightbox/<?=isset($floarPlaneImages[0]->propertyImageName)?$floarPlaneImages[0]->propertyImageName:''?>" alt="image" />
		 <div class="modal-footer">
		    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<script>
	$(document).on('hidden.bs.modal', function (e) {
		var target = $(e.target);
        target.removeData('bs.modal')
              .find(".modal-content").html('');
    });
</script>
          