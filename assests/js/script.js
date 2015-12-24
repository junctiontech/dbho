$(document).ready(function(){
	$('.propertytypeclass').click(function(){
		var propertyType = $("#demo-form2 input[type='radio']:checked").val();
		if(propertyType==1){
			$('.unitclass').css('display','block');
			$('.individualclass').css('display','none');
		}else{
			$('.unitclass').css('display','none');
		}
		
		/* $.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Property/getProperty',
            data: {},
             success:function(result){
            alert(result);
              
            }
        });*/
	});



	$(".radioID").change(function(){
		$("#userplanspan").empty();
		$("#userplanspan").hide();
	//$("#usertypeselectbox").empty();
        if( $(this).is(":checked") ){
            var userType = $(this).val();
			$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Users/getUserlistByType',
            data: {userType:userType},
			beforeSend: function() {
				$("#loader").fadeIn();
			},
             success:function(result){
            //alert(result);
            if(result=='error'){
            	////$("#usertypeselectbox").html(result);
            	//$("#editmodedropdown").css('display','none');
            }else{
				if(userType==4){
					$("#selectagency").append().html(result);
					$("#selectindividualspan").css('display','none');
					$("#selectbuilderspan").css('display','none');
					$("#selectagencyspan").css('display','block');
				}else if(userType==1){
					$("#selectindividual").append().html(result);
					$("#selectbuilderspan").css('display','none');
					$("#selectagencyspan").css('display','none');
					$("#selectindividualspan").css('display','block');
					
				}else if(userType==3){
					$("#selectbuilder").append().html(result);
					$("#selectindividualspan").css('display','none');
					$("#selectagencyspan").css('display','none');
					$("#selectbuilderspan").css('display','block');
				}
            	////$("#usertypeselectbox").html(result);
            	//$("#editmodedropdown").css('display','none');
            }
              $("#loader").fadeOut();
            }
        });
        }
    });
/*************************USER PLAN**********************************************/
$(".userplan").change(function(){
	//alert($("#"+($(this).attr('id'))).val());
	var userID = $("#"+($(this).attr('id'))).val();
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Users/getUserPlan',
            data: {userID:userID},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				$("#loader").fadeOut();
				$("#userplanspan").html(result);
				$("#userplanspan").show();
            //alert(result);
              
            }
        });
	
});
/************************END USER PLAN*******************************************/

	
	$(".property").change(function(){
		if( $(this).is(":checked") ){
			var propertyValue = $(this).val();
			$.ajax({
	            type: 'POST', 
	            url: AbsoluteURL+'Property/getAllProjects',
	            data: {},
	             success:function(result){
		            //alert(result);
		            if(propertyValue==1){
		            	$("#propertyUnderProjectselectbox").empty();
		            	$('.individualproperty').css('display','none');
		            }else{
		            	$('.individualproperty').css('display','block');
		            	$("#propertyUnderProjectselectbox").html(result);
		            }
	            
	            }
	        });
		}
	});

	$(".appsave").click(function(){
		var appointmentName = $("#appointmentName").val();
		var appointmentPhone = $("#appointmentPhone").val();
		var appointmentAddress = $("#appointmentAddress").val();
		//alert('sale or rent'+$("input[type='checkbox'][name='negotiable']:checked").length);
		if(appointmentName==''){
			alert("Please enter name!");
			$("#appointmentName").focus();
			return false;
		}else if($.isNumeric(appointmentName)){
			alert("Please enter correct name!");
			$("#appointmentName").val('');
			$("#appointmentName").focus();
			return false;
		}
		if(appointmentPhone==''){
			alert("Please enter phone!");
			$("#appointmentPhone").focus();
			return false;
		}else if(!($.isNumeric(appointmentPhone))){
			alert("Please enter correct phone no!");
			$("#appointmentPhone").val('');
			$("#appointmentPhone").focus();
			return false;
		}else if(appointmentPhone.length<10){
			alert("Please enter 10 digit phone no!");
			$("#appointmentPhone").val('');
			$("#appointmentPhone").focus();
			return false;
		}
		else if(appointmentAddress==''){
			alert("Please enter address!");
			$("#appointmentAddress").val('');
			$("#appointmentAddress").focus();
			return false;
		}else if($('input[name=usertype]:checked').length<=0){
			alert("Please select agency or individual or builder");
			$(".radioID").focus();
			return false;
		}else if($('input[name=usertype]:checked').length>0){
			var usertypeRadioButton = $('input[name=usertype]:checked').val();
			/*if(usertypeRadioButton==1){
				var selectindividual = $("#selectindividual").val();
				if(selectindividual==0){
					alert("Please select individual User !");
					$("#selectindividual").focus();
					return false;
				}
			}else*/ 
			if(usertypeRadioButton==3){
				var selectbuilder = $("#selectbuilder").val();
				if(selectbuilder==0){
					alert("Please select Builder User !");
					$("#selectbuilder").focus();
					return false;
				}
			}else if(usertypeRadioButton==4){
				var selectagency = $("#selectagency").val();
				if(selectagency==0){
					alert("Please select Agency User !");
					$("#selectagency").focus();
					return false;
				}
			}

		}
		if($("#AppointmentAssignee").val()==0){
			alert("Please assgin appointment");
			$("#AppointmentAssignee").focus();
			return false;
		}
		if(($('input[name=ptype]:checked').length<=0) && $('input[name=usertype]:checked').length>0){
			alert("Please select property type as Sale or Rent !");
			$(".qqptype").focus();
			return false;
		}
		if($("#price").val()==''){
			alert("Please enter price");
			$("#price").focus();
			return false;
		}
		if(!($.isNumeric(appointmentPhone))){
			alert("Please enter valid price!");
			$("#price").val('');
			$("#price").focus();
			return false;
		}

		//return false;
	});
	/*********************************edit appointment Validation*****************************************************/

	$(".editappsave").click(function(){
		var appointmentName = $("#appointmentName").val();
		var appointmentPhone = $("#appointmentPhone").val();
		var appointmentAddress = $("#appointmentAddress").val();
		//alert('sale or rent'+$("input[type='checkbox'][name='negotiable']:checked").length);
		if(appointmentName==''){
			alert("Please enter name!");
			$("#appointmentName").focus();
			return false;
		}else if($.isNumeric(appointmentName)){
			alert("Please enter correct name!");
			$("#appointmentName").val('');
			$("#appointmentName").focus();
			return false;
		}
		if(appointmentPhone==''){
			alert("Please enter phone!");
			$("#appointmentPhone").focus();
			return false;
		}else if(!($.isNumeric(appointmentPhone))){
			alert("Please enter correct phone no!");
			$("#appointmentPhone").val('');
			$("#appointmentPhone").focus();
			return false;
		}else if(appointmentPhone.length<10){
			alert("Please enter 10 digit phone no!");
			$("#appointmentPhone").val('');
			$("#appointmentPhone").focus();
			return false;
		}
		else if(appointmentAddress==''){
			alert("Please enter address!");
			$("#appointmentAddress").val('');
			$("#appointmentAddress").focus();
			return false;
		}else if($('input[name=usertype]:checked').length<=0){
			alert("Please select agency or individual or builder");
			$(".radioID").focus();
			return false;
		}else if($('input[name=usertype]:checked').length>0){
			var usertypeRadioButton = $('input[name=usertype]:checked').val();
			/*if(usertypeRadioButton==1){
				var selectindividual = $("#selectindividual").val();
				if(selectindividual==0){
					alert("Please select individual User !");
					$("#selectindividual").focus();
					return false;
				}
			}else*/ 
			if(usertypeRadioButton==3){
				var selectbuilder = $("#selectbuilder").val();
				if(selectbuilder==0){
					alert("Please select Builder User !");
					$("#selectbuilder").focus();
					return false;
				}
			}else if(usertypeRadioButton==4){
				var selectagency = $("#selectagency").val();
				if(selectagency==0){
					alert("Please select Agency User !");
					$("#selectagency").focus();
					return false;
				}
			}

		}
		if($("#AppointmentAssignee").val()==0){
			alert("Please assgin appointment");
			$("#AppointmentAssignee").focus();
			return false;
		}
		if(($('input[name=ptype]:checked').length<=0) && $('input[name=usertype]:checked').length>0){
			alert("Please select property type as Sale or Rent !");
			$(".qqptype").focus();
			return false;
		}
		if($("#price").val()==''){
			alert("Please enter price");
			$("#price").focus();
			return false;
		}
		if(!($.isNumeric(appointmentPhone))){
			alert("Please enter valid price!");
			$("#price").val('');
			$("#price").focus();
			return false;
		}

		//return false;
	});



	/****************Login***************************************************************************************/

	$("#loginan").click(function(){
		 var uname = $('#uname').val();
		 var upassword = $('#upassword').val();
		 if($('#uname').val()==''){
			$("#msg").text("Please enter Username!!").css('color',"red");
			$('#uname').focus();
			return false;
		 }
		 else if($('#upassword').val()==''){
			$('#msg').text("Please enter Password!!").css('color',"red");
			$('#upassword').focus();
			return false;
		 }
		 else{
		 //alert('here');           
		   $.ajax({
				type: 'POST', 
				url: AbsoluteURL+'Users/login',
				data: {uname :uname ,upassword:upassword},
				 success:function(result){
					//alert(result);
					if(result!='fail'){
						window.location.href= AbsoluteURL+'Appointment'
					}else{
						$("#msg").text("Please enter correct Username/Password!!").css('color',"red");
					}
				 }

			});
		}
	});
	/************************************END***************************************************************/
	/**************************************Enter key******************************************************/
	$("#uname").keyup(function(event){
		if(event.keyCode == 13){
			$("#loginan").click();
		}
	});

	$("#upassword").keyup(function(event){
		if(event.keyCode == 13){
			$("#loginan").click();
		}
	});
	
	// Campaign page user select
	$('#select-user-type').change(function(e){
		var user_type_id = $(this).val();
		var user_type_name = $('option:selected', this).text();
		
		//alert(user_type_name);
		$('#select-company-name optgroup').hide();
		$('#select-company-name optgroup [label="'+user_type_name+'"]').show();
	})
	
/****************Property sync************************************************/
	$("#synchan").click(function(){
		var propertyid = $("#propertyid").val();
		
		$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Property/synch',
            data: {propertyid :propertyid},
				success:function(result){
             	alert(result);
				if(result=='SUCCESS'){
             	 alert("Successfully Property Sync.");
				}
             }
		});


	});
/****************End Property sync************************************************/

/************************Edit Property Validation*****************************/
$("#editfrmsave").click(function (){
	var geocomplete = $("#geocomplete").val();
	if(geocomplete==''){
		$("#geocomplete").focus();
		$("#geocomplete").css('border','1px solid red');
		return false;
	}
	var sublocality = $("#sublocality").val();
	if(sublocality==''){
		$("#sublocality").focus();
		$("#sublocality").css('border','1px solid red');
		return false;
	}
	var country = $("#country").val();
	if(country==''){
		$("#country").focus();
		$("#country").css('border','1px solid red');
		return false;
	}
	var administrative_area_level_1 = $("#administrative_area_level_1").val();
	if(administrative_area_level_1==''){
		$("#administrative_area_level_1").focus();
		$("#administrative_area_level_1").css('border','1px solid red');
		return false;
	}
	var locality = $("#locality").val();
	if(locality==''){
		$("#locality").focus();
		$("#locality").css('border','1px solid red');
		return false;
	}
	var postal_code = $("#postal_code").val();
	if(postal_code==''){
		$("#postal_code").focus();
		$("#postal_code").css('border','1px solid red');
		return false;
	}
});

/* $("#geocomplete").keypress(function(){
	$("#geocomplete").css('border','1px solid #dde2e8');
}); */
/***********************************************END*************************************************************/

$(".imgtagclose").click(function(){
	$('.editmode').fadeOut();
});
});

function editImageTag(imageID,appointmentid){
	//alert(imageID);
	imagetagText = $("#imgtagedit_"+imageID).val();
	//alert(imagetagText);
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Property/editImageTag',
            data: {imageID:imageID,appointmentid :appointmentid,imagetagText:imagetagText},
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
				}
				
             }
		});
	return false;
}
function appImageEdit(imageID,appointmentid){
	//alert(imageID);
	$('#ajaxeditimg_'+imageID).fadeIn();
	/* 
	
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Property/appImageEdit',
            data: {imageID:imageID,appointmentid :appointmentid},
			beforeSend: function() {
				$("#loader").fadeIn();
			},
				success:function(result){
             	//alert(result);
             	if(result){
					$("#loader").fadeOut();
					$("#thumbnail_"+imageID).hide();
				}
				
             }
		});*/
		return false; 
	
}


function appImageDelete(imageID,appointmentid){
	
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Property/appImageDelete',
            data: {imageID:imageID,appointmentid :appointmentid},
			beforeSend: function() {
				$("#loader").fadeIn();
			},
				success:function(result){
             	//alert(result);
             	if(result){
					$("#loader").fadeOut();
					$("#thumbnail_"+imageID).hide();
				}
				
             }
		});
		return false;
	
}
function isCoverImage(imageID,appointmentid){
	
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Property/isCoverImage',
            data: {imageID:imageID,appointmentid :appointmentid},
			beforeSend: function() {
				$("#loader").fadeIn();
			},
				success:function(result){
             	if(result=="success"){
					$("#loader").fadeOut();
					$(".cover-img").css('display','none');
					$("#ajaxtimeimg_"+imageID).css('display','block');
				}
				
             }
		});
		return false;
	
}

function salesLeads(userID){
/*************************SALES LEADS**********************************************/

	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Users/setSalesLead',
            data: {userID:userID},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				$("#loader").fadeOut();
				$("#salesleadsspan").html(result);
				//$("#userplanspan").show();
            //alert(result);
              
            }
        });
	

}
/************************END SALES LEADS*******************************************/

function saveSalesLead(){
	var userID = $("#uid").val();
	//alert(userID);
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'Users/saveSalesLead',
            data: {userID:userID},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				$("#loader").fadeOut();
				//$("#salesleadsspan").html(result);
				//$("#userplanspan").show();
				if(result){
					alert("Sales Lead save successfully");
				}
              
            }
        });
	return false;
}