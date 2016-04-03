var base_url="http://"+window.location.hostname+':'+location.port+"/dbho/";
function UserTypes(UserTypeId,value)
{	//alert(UserTypeId);die;;
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
{	//alert(id);
	if(id==1){ 
			var data = $("#form-"+id).serialize();
			var formid=id;
			$.ajax({
			 data: data,
			 type: "post",
			 url: base_url+'AddProject/InsertProject/'+formid,
			 beforeSend: function() {
					$("#loader").fadeIn();
				},
			 success: function(response){	 
				 $("#loader").fadeOut();//alert(response); return false;http://preprod.homeonline.com/
				//	alert(response);//die;
					var result=response.split("#--#");
					document.getElementById("form1_id").value=result['0']; // alert(result['0']); alert(result['1']);
					$('#Preview').html('<a href="http://staging.homeonline.com/india/en/sale/residential_project-for-sale.htm/'+result['1']+'/pdet/preview/" target="_blank" class="btn btn-success taright" title="Project Preview">Preview</a>');
				   $('.form1_id').val(result['0']);
				   $('#projectKey').val(result['1']);
				  
				}
			});
		
	}
	return true;
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


function InsertPropertyproject() 
{  
	if(document.getElementById('propertydetailss').value !=='64')
	{
		if(document.getElementById('bedroom').value=='')
		{
			alert('Please Select Bed Rooms');
			return false;
		}
	}
	var data = $("#form-3").serialize();//alert(data);
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
			$('.showunits').html(result);
			$('#size').val('');
					$('#price').val('');
					$('#bedroom').val('');
					$('#propertydetailss').val('');
					$('#propertyName').val(''); 
					$('#isNegotiable').prop('checked',false);
					$('#priceOnReq').prop('checked',false);
			 
		 } 
		
		});	
		
}

function InsertProjectVideo(id) 
{ 	// alert(return);return false;
	var data = $("#form-4").serialize();//alert(data);
	var formid='4';
	$.ajax({
	 data: data,
	 type: "post",
	 url: base_url+'AddProject/ProjectInsertYoutubeVideo/'+formid,
	 beforeSend: function() {
			$("#loader").fadeIn();
		},
	 success: function(result){	
		$("#loader").fadeOut();
		var data =result;
		if(data==="Please Enter Correct YouTube Video URL")
		{
			alert(result);return false;
		}
		$("#VideoShow").html(result);
		$("#VideoShow").show();
	} 
	
	});		
}

function freelistinguserplane(temp)
{	//alert(freelistingvalue);
		alert(temp);
	if(document.getElementById("freelisting").checked==true)
	{	
		
		var freelistingvalue='1';
		$.ajax({
				type: "POST",
				url : base_url+'AddProject/UserPlaneDetail',
				data: {freelistingvalue:freelistingvalue},
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
	else
	{
		var freelistingvalue='0';
		$.ajax({
				type: "POST",
				url : base_url+'AddProject/UserPlaneDetail',
				data: {freelistingvalue:freelistingvalue},
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
}


		/* function for plan id store */
function ConsumePlanID(PlanID)
{
	 $('.ConsumePlaneID').val(PlanID);
}

		/* function for Property Plan id store */
function PropertyConsumePlanID(PlanID)
{
	 $('.ConsumePlaneID').val(PlanID);
}

		/* Function For Update Unit Get View */
function projectUnit(propertyID,projectID)
{
	$.ajax({
	 data: {propertyID:propertyID,projectID:projectID},
	 type: "post",
	 url: base_url+'AddProject/ProjectUnit',
	 beforeSend: function() {
			$("#loader").fadeIn();
		},
	 success: function(result){
		
		$("#loader").fadeOut();
		// alert(result);
		 $('#FloarImages').show();
		$('.showunitsprojectdetail').html(result);
		$('#Propertyunit').val(propertyID);
		
	 } 
	
	});		
}

		/*........................Function For Update Unit Get View.................................*/
function projectUnitInsert(projectID)
{
	$.ajax({
	 data: {projectID:projectID},
	 type: "post",
	 url: base_url+'AddProject/ProjectUnitInsert',
	 beforeSend: function() {
			$("#loader").fadeIn();
		},
	 success: function(result){
		$("#loader").fadeOut();
		 $('.showunitsprojectdetail').html(result);
		 $('#FloarImages').hide();
	 } 
	
	});		
}

	/*.................................. Start Function For Delete Unit .........................................*/
	function ProjectDeleteUnit(propertyID,projectID)
	{
		var confirmation=confirm('Are You Sure You Want To This Unit...?');
		if(confirmation==true)
		{
			$.ajax({
				type: "post",
				data: {propertyID:propertyID,projectID:projectID},
				url:  base_url+'AddProject/ProjectDeleteUnit',
				beforeSend:function()
				{
					$("#loader").fadeIn();
				},
			success: function(result){
				$("#loader").fadeOut();
				$('.showunits').html(result);
				$('#FloarImages').hide();
				$('#size').val('');
				$('#price').val('');
				$('#bedroom').val('');
				$('#propertydetailss').val('');
				}
			});
		}
		else
		{
			return;
		}
	}
	/*.................................. End Function For Delete Unit .........................................*/
	
	/*................................... Start Function For Delete Project Galaery image .................................*/
	function DeleteProjectImage(projectID,divid) 
	{   
		var confirmation=confirm('Are You Sure You Want To Delete Image...?');
		if(confirmation==true)
		{
			$.ajax({
			 data: {projectID:projectID,divid:divid},
			 type: "post",
			 url: base_url+'AddProject/DeleteProjectImage',
			 beforeSend: function() {
					$("#loader").fadeIn();
				},
			 success: function(result){ 
				 $("#loader").fadeOut(); alert(result);
				document.getElementById(divid).style.display = "none";
				//alert(result);
			 }
			 });	
		}
		else
		{
			return;
		}	
	} 
/*................................... End Function For Delete Project Galaery image .................................*/

function DeleteProjectGalery(projectID,divid) 
	{   
		var confirmation=confirm('Are You Sure You Want To Delete Image...?'); 
		if(confirmation==true)
		{
			$.ajax({
			 data: {projectID:projectID},
			 type: "post",
			 url: base_url+'AddProject/DeleteProjectGalery',
			 beforeSend: function() {
					$("#loader").fadeIn();
				},
			 success: function(result){ 
				 $("#loader").fadeOut(); alert(result);
				document.getElementById(divid).style.display = "none";
				//alert(result);
			 }
			 });
		}
		else
		{
			return false;
		}
	}

	function ProjectCoverImage(projectID,projectImageID) 
	{   
		var confirmation=confirm('Are You Sure You Want To Set Cover Image...?'); 
		if(confirmation==true)
		{
			$.ajax({
			 data: {projectID:projectID,projectImageID:projectImageID},
			 type: "post",
			 url: base_url+'AddProject/ProjectCoverImage',
			 beforeSend: function() {
					$("#loader").fadeIn();
				},
			 success: function(result){	alert(result);//return false;
				 $("#loader").fadeOut();
				$(".cover-img").css('display','none');
				$("#ajaxtimeimg_"+projectImageID).css('display','block');
			 }
			 });
		}
		else
		{
			return false;
		}
	}
	
	function DeleteProjectVideo(projectVideoID,divid) 
	{   
		var confirmation=confirm('Are You Sure You Want To Delete This Video...?'); 
		if(confirmation==true)
		{
			$.ajax({
			 data: {projectVideoID:projectVideoID},
			 type: "post",
			 url: base_url+'AddProject/DeleteProjectVideo',
			 beforeSend: function() {
					$("#loader").fadeIn();
				},
			 success: function(result){ 
				 $("#loader").fadeOut(); alert(result);
				document.getElementById(divid).style.display = "none";
				//alert(result);
			 }
			 });
		}
		else
		{
			return false;
		}
	}
	
function ProjectImageName(imageID)
{
	
	$('#ajaxeditimg_'+imageID).show();
	
		return false; 
	
}

function ProjectImagePriority(imageID)
{
	
	$('#ajaxeditimg1_'+imageID).show();
	
		return false; 
	
}

function ProjectImageEdit(imageID,appointmentid)
{
	//alert(imageID);
	imagetagText = $("#imgtagedit_"+imageID).val();
	imagetagText1 = $("#imgtagedit1_"+imageID).val();
	//alert(imagetagText);
	$.ajax({
            type: 'POST', 
            url: base_url+'AddProject/editImageTag',
            data: {imageID:imageID,imagetagText:imagetagText,imagetagText1:imagetagText1},
			beforeSend: function() {
				$("#loader").fadeIn();
			},
				success:function(result){
             	//alert(result);
             	if(result){
					$("#textspan_"+imageID).hide();
					$("#newtextspan_"+imageID).text(imagetagText);
					$("#loader").fadeOut();
					$("#ajaxeditimg_"+imageID).hide();
					
					$("#textspan1_"+imageID).hide();
					$("#newtextspan1_"+imageID).text("Priority-"+imagetagText1);
					$("#ajaxeditimg1_"+imageID).hide();
				}
				
             }
		});
	return false;
}

function ProjectVideo(temp)
{
	if(temp=='YouTube')
	{
		$('#youtube').show();
		$('#custom').hide();
	}
	else
	{
		$('#youtube').hide();
		$('#custom').show();
	}
}

function PropertyUnitName()
{
	$("#loader").fadeIn();
		if(document.getElementById('propertyName') !=null){
		//var purpose='';
		var propertydetailss='';
		var inproject='';
		var bedroom='';
		var size='';
		var coveredarea='';
		if(document.getElementById('size') !=null){
		var coveredarea = $("#size").val();
		if(coveredarea !=''){
		var size = 'sq-ft';//$("#coveredareasize option:selected").text();
		}
		}
		if(document.getElementById("bedroom") != null) {
			if($("#bedroom option:selected").val() !=''){
			var bedroom= $("#bedroom option:selected").text() + ' BHK ';
			}
		}
		var propertytypeid = $("#propertydetailss option:selected").val();
		if(propertytypeid !=''){
		var propertydetailss = $("#propertydetailss option:selected").text();
		}
		var newtittle = bedroom + propertydetailss  + ' ' +  coveredarea +' '+  size;
		document.getElementById('propertyName').value='';
		document.getElementById('propertyName').value=newtittle;
	}
		$("#loader").fadeOut();
}

function CheckValidation(id)
{	
	var size= document.getElementById(id).value;
	if(isNaN(size))
	{
		alert('Please Enter Numeric Value Only');
		$('#'+id).val('');
		$('#bedroom').attr('required',true); 
	}
	else
	{
		$('#bedroom').attr('required',true);
		return;
	}
	
}

function CheckPlotArea(id)
{
	if(id=='64')
	{
		$('#bedroom').attr('disabled',true); 
		$('#bedroom').val('');
	}
	else
	{
		$('#bedroom').attr('disabled',false);
	}
}



function getprojectimagesafterupload(project)
{
	//alert(project);return false;
	var projectID=$('.form1_id').val();
	if(projectID !=''){
		
		$.ajax({
		data:{projectID:projectID},
         type: "post",
         url: base_url+'AddProject/getprojectimagesafterupload',
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			 $("#loader").fadeOut();//alert(result);
			 if(result){
			  $('.afteruploadprojectimagediv').html('');
			 $('.afteruploadprojectimagediv').html(result);
			 }
         }
		});

	}
}

function Pagination(offset,limit)
{	//alert(div); alert(offset); alert(limit); return false;
	$.ajax({
	//	data:{offset:offset,limit:limit},
		type:"post",
		url: base_url+'AddProject/ProjectLog/search/'+offset+'/'+limit,
		success: function(result){	alert(result);//return false;
		$('#pagination').html(result);
		
		//document.getElementById("div"+div).className = "active";
		}
	});
}