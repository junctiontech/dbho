function UserTypes(UserTypeId,value)
{	//alert(UserTypeId);die;
	$.ajax({
				type: "POST",
				url : base_url+'AddProject/UserTypeDetail',
				data: {UserTypeId:UserTypeId},
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					$("#loader").fadeOut();
					//alert(msg);//die;
					$('#userTypeDetail').html(msg);
				
					return false;	
				});
		
		return false;
}

function UserPlane(UserId,value)
{	//alert(UserId);die;
	$.ajax({
				type: "POST",
				url : base_url+'AddProject/UserPlaneDetail',
				data: {UserId:UserId},
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					//alert(msg);//die;
					$("#loader").fadeOut();
					$('#userPlane').html(msg);
				
					return false;	
				});
		
		return false;
}

function StatusDatePicker(StatusValue,value)
{	//alert(StatusValue);die;
	$.ajax({
				type: "POST",
				url : base_url+'AddProject/StatusDatePicker',
				data: {StatusValue:StatusValue},
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					//alert(msg);//die;
					$("#loader").fadeOut();
					$('#datepckr').html(msg);
				
					return false;	
				});
		
		return false;
}

function ProjectType(projectTypeId)
{	//alert(projectTypeId);die;
	$.ajax({
				type: "POST",
				url : base_url+'AddProject/ProjectType',
				data: {projectTypeId:projectTypeId},
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					//alert(msg);	die;
					$("#loader").fadeOut();
					$('#AttributesList').html(msg);
				
					return false;	
				});
		
		return false;
}

function InsertProject(id)
{	//alert(projectTypeId);
		var data = $("#form-"+id).serialize();
		var formid=id;
		$.ajax({
         data: data,
         type: "post",
         url: base_url+'AddProject/InsertProject/'+formid,
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){	 
			 $("#loader").fadeOut();
			  document.getElementById("form1_id").value=result;	//alert(result);
			  $('.form1_id').val(result);
			 // $('.form1_id').val(result);
         }
});
	
}


function InsertPropertyDetail()
{	//alert('hiiiiii');die;
		var data=$("#form_3").serialize();//alert(data);die;
		//var data = $("").serialize();
		//var formid=id;
		$.ajax({
         data: data,
         type: "post",
         url: base_url+'AddProject/InsertPropertyDetail',
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){	 
			 $("#loader").fadeOut();alert(result);die;
			  document.getElementById("form1_id").value=result;	//
			  $('.form1_id').val(result);
			 // $('.form1_id').val(result);
         }
});
	
}

function GetAminitiesAtrribute(projectTypeId)
{	//alert(projectTypeId);die;
	$.ajax({
				type: "POST",
				url : base_url+'AddProject/GetAminitiesAtrribute',
				data: {projectTypeId:projectTypeId},
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					$("#loader").fadeOut();
					//alert(msg);	die;
					$('#AttributesList').html(msg);
				
					return false;	
				});
		
		return false;
}