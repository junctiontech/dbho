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
{	//alert("jdfk");
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
			 $("#loader").fadeOut();//alert(result); 
			// alert(result);
			 if(result !=""){
			  document.getElementById("form1_id").value=result;
			 
			  $('.form1_id').val(result);
			 }
			 // $('.form1_id').val(result);
         }
});

}

/*Get Attributes For Add Property............................. Start*/	

$("#projectpropertytype").change(function(){
	//alert("fds");
	var propertytypeid = $("#"+($(this).attr('id'))).val();
	
	$.ajax({
            type: 'POST', 
            url: base_url+'AddProject/Getattributes',
            data: {propertytypeid:propertytypeid},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				//alert(result);
				$("#loader").fadeOut();
				$("#showattributes").html(result);
             
            }
        });
	
});	
/*Get Attributes For Add Property............................. End*/


function InsertPropertyproject(id) 
	{   
		
		var data = $("#form-3").serialize();
		var formid='3';
		$.ajax({
         data: data,
         type: "post",
         url: base_url+'AddProject/InsertProperty/'+formid,
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			 $("#loader").fadeOut();
		//alert(result);
			  
			  $('.showunits').html(result);
         }
});
		
}


	

