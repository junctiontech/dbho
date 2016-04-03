/* ***********************Rajesh Vishwakarma****************************** */

function validation()
{
             if($('#AppointmentAssignee').val()=='0'){
			 	 $("#AppointmentAssignee").css('border','2px').css('border-style','solid').css('border-color','red');
			 	 $('#AppointmentAssignee').focus();
			 	 return false;
			 }
			 if($('#datetimepicker').val()==''){
			 	 $("#datetimepicker").css('border','2px').css('border-style','solid').css('border-color','red');
			 	 $('#datetimepicker').focus();
			 	 return false;
			 }
			  if($('#selectstatus').val()=='0'){
			 	 $("#selectstatus").css('border','2px').css('border-style','solid').css('border-color','red');
			 	 $('#selectstatus').focus();
			 	 return false;
			 }
			  if($('#notes').val()==''){
			 	 $("#notes").css('border','2px').css('border-style','solid').css('border-color','red');
			 	 $('#notes').focus();
			 	 return false;
			 }
}	
$(document).ready(function(){
	$("#AppointmentAssignee").change(function(){
		 $("#AppointmentAssignee").css('border','0px').css('border-style','none').css('border-color','white');
	});
	$("#datetimepicker").change(function(){
		 $("#datetimepicker").css('border','0px').css('border-style','none').css('border-color','white');
	});
	$("#selectstatus").change(function(){
		 $("#selectstatus").css('border','0px').css('border-style','none').css('border-color','white');
	});
	$("#notes").keypress(function(){
		 $("#notes").css('border','0px').css('border-style','none').css('border-color','white');
	});	
	autoAppointmentNotification();
}); 
function autoAppointmentNotification(){	
	$.ajax({
		type:'POST',
		url: AbsoluteURL+'Appointment/getAppointmentStatus',
		success:function(result){
			//alert(result);
			$(".appnotification").html(result);
			setTimeout(autoAppointmentNotification,100000);	
			}
			})		 
}
setTimeout(autoAppointmentNotification,100000);	
function loadnotification(){
	 $.ajax({
		type:'POST',
		url: AbsoluteURL+'Appointment/getAppointmentNotification',
		success:function(result){			
			$(".completeapplist").html(result);
			}
	})
}
	 