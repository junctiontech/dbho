var base_url="http://"+window.location.hostname+':'+location.port+"/dbho/";
function get_planpriority(plantypeid)
{ 
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/get_planpriority',
				data: {plantypeid: plantypeid  },
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					$("#loader").fadeOut();
					document.getElementById('planorder').value=msg;
					return false;	
				});
		
		return false;
}

function get_usertype(userid)
{ 
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/get_usertype',
				data: {userid: userid  },
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					$("#loader").fadeOut();
					if(msg !=''){
					document.getElementById('user_type').value=msg;
					$( '#showhidden' ).css( "pointer-events", "auto" );
					if(msg=='Individual'){
						$('.inventorydiv1 tbody tr').remove();
						$('.inventorydiv').css("display","none");
						
						
					}else{
						$('.inventorydiv').css("display","block");
						
					}
					}else{
						document.getElementById('user_type').value="";
						$('.inventorydiv').css("display","block");
						$( '#showhidden' ).css( "pointer-events", "none" );
					}
					return false;	
				});
		
		return false;
}


function get_plans(userid,rowcount)
{	
	if(userid){
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/get_planbyusertype',
				data: {userid: userid , rowcount:rowcount },
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					//alert(msg);
					$("#loader").fadeOut();
					if(msg !=''){
					$('#user_plans').html(msg);
					}
					return false;	
				});
		
		return false;
}else{
					$('#user_plans').html("");	
					}
}


function getcityforinventory(inventoryid)
{	
	if(inventoryid){
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/getcityforinventory',
				data: {inventoryid: inventoryid  },
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					$("#loader").fadeOut();
					if(msg !=''){
					$('#inventorycity').html(msg);
					}
					return false;	
				});
		
		return false;
}
}

function getprojectname(userid)
{	
	var inventorytype=document.getElementById('inventoryid').value;
	var userid=document.getElementById('user_id').value;
	if(userid){
					$.ajax({
								type: "POST",
								url : base_url+'common_functions/getprojectname',
								data: {userid: userid,inventorytype:inventorytype  },
								beforeSend: function() {
								$("#loader").fadeIn();
							}
							})	
								.done(function(msg){
									$("#loader").fadeOut();
									if(msg !=''){
									$('.propertyprojectdiv').html(msg);
									}
									return false;	
								});
						
						return false;
		}
	
	
}

function getcityforcalendarinventory(inventoryid)
{	
	if(inventoryid){
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/getcityforcalendarinventory',
				data: {inventoryid: inventoryid  },
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})	
				.done(function(msg){
					$("#loader").fadeOut();
					
					if(msg !=''){
					$('#inventorycity').html(msg);
					}
					return false;	
				});
		
		return false;
}
}

$(document).ready(function(){
 
        $(".txt").each(function() {
 
            $(this).keyup(function(){
                calculateSum();
            });
        });
		
	 });
	
	function calculatepersqreft() 
	{
		$("#loader").fadeIn();
        var sum = 0;
		 var expect='';
		 var sizearea='';
		 if(document.getElementById('expectedprice') !=null){
			  var expect= document.getElementById('expectedprice').value;
		 }
       
		if(document.getElementById('coveredarea') !=null){
			var sizearea= document.getElementById('coveredarea').value;
		}
 
            if(!isNaN(expect) && expect.length!=0 && !isNaN(sizearea) && sizearea.length!=0) {
                sum = parseFloat(expect/sizearea);
            }
 
        
        $("#pricepersqrft").val(sum.toFixed(2));
		$(".showpriceas").html(expect);
		$("#loader").fadeOut();
    }
 
    function calculateSum() 
	{
		$("#loader").fadeIn();
        var sum = 0;
        $(".txt").each(function() {
 
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        $("#sum").html(sum.toFixed(2));
		$("#loader").fadeOut();
    }
	
	function flooringtypebedroom(floorvalue) 
	{
		
		$("#loader").fadeIn();
      
        $(".bedroom").each(function() {
			
			if(this.id==floorvalue) {
				var idcheck=this.id;
				
				$(this).attr('checked','checked');
				
            }
			
			if($(this).prop('checked') == true){
				
				var exit=false;
				var chkedvalue=this.id;
				 
				 $(".flooringbed").each(function() {
					if(chkedvalue==$(this).val()){
						
						 exit = true;
						return false;
						
					}
					
				});
				
				if (exit){
					
				}else{
					$(this).removeAttr('checked');
					
				}
				
			}
 
        });
       
		$("#loader").fadeOut();
    }
	
	function flooringtypelivingroom(floorvalue) 
	{
		
		$("#loader").fadeIn();
       
        $(".livingroom").each(function() {
			
			
			
 
            if(this.id==floorvalue) {
				var idcheck=this.id;
				
				$(this).attr('checked','checked');
				
            }else{
				$(this).attr('checked',false);
			}
 
        });
        
		$("#loader").fadeOut();
    }
	
	function flooringtypebathroom(floorvalue) 
	{
		
		$("#loader").fadeIn();
       
        $(".bathroom").each(function() {
			
			
			
            if(this.id==floorvalue) {
				var idcheck=this.id;
				
				$(this).attr('checked','checked');
				
            }
			
			if($(this).prop('checked') == true){
				
				var exit=false;
				var chkedvalue=this.id;
				 
				 $(".flooringbath").each(function() {
					if(chkedvalue==$(this).val()){
						
						 exit = true;
						return false;
						
					}
					
				});
				
				if (exit){
					
				}else{
					$(this).attr('checked',false);
				}
				
			}
 
        });
        
		$("#loader").fadeOut();
    }
	
	function flooringtypekitchen(floorvalue) 
	{
		
		$("#loader").fadeIn();
       
        $(".kitchen").each(function() {
 
            if(this.id==floorvalue) {
				var idcheck=this.id;
				
				$(this).attr('checked','checked');
				
            }else{
				$(this).attr('checked',false);
			}
 
        });
        
		$("#loader").fadeOut();
    }
	
	function flooringtypecommonarea(floorvalue) 
	{
		
		$("#loader").fadeIn();
       
        $(".commonarea").each(function() {
 
            if(this.id==floorvalue) {
				var idcheck=this.id;
				
				$(this).attr('checked','checked');
				
            }else{
				$(this).attr('checked',false);
			}
 
        });
        
		$("#loader").fadeOut();
    }
	
	function flooringtypebalcony(floorvalue) 
	{
		
		$("#loader").fadeIn();
       
        $(".balcony").each(function() {
 
            if(this.id==floorvalue) {
				var idcheck=this.id;
				
				$(this).attr('checked','checked');
				
            }else{
				$(this).attr('checked',false);
			}
 
        });
        
		$("#loader").fadeOut();
    }
	
	
	function checkfurnishing(furbishingvalue) 
	{
		
		$("#loader").fadeIn();
		
        var count=0;
		
        $("."+'_'+furbishingvalue).each(function() {
			
			if($(this).prop('checked') == true){
				
				count++;
			}
			
         });
			
		if(count !=0) {
			$('.'+'fur'+furbishingvalue).prop('checked',false);
			
			if(document.getElementById('5+_'+furbishingvalue) !=null){
				document.getElementById('5+_'+furbishingvalue).checked = false;
			}
			if(document.getElementById('10+_'+furbishingvalue) !=null){
				document.getElementById('10+_'+furbishingvalue).checked = false;
			}
				if(document.getElementById(count+'_'+furbishingvalue) !=null){
				
				$('.'+count+'_'+furbishingvalue).prop('checked',true);
				
				if(furbishingvalue){
					$('.'+'No_'+furbishingvalue).prop('checked',false);
				}
				
				}else{
					
					if(count>5){
						
						document.getElementById('5+_'+furbishingvalue).checked = true;
					}
					if(count>10){
						if(furbishingvalue=='Wardrobe'){
						document.getElementById('10+_'+furbishingvalue).checked = true;
					}
					}
					
					
					
					$('.'+furbishingvalue).prop('checked',true);
				}
            }else{
				$('.'+'fur'+furbishingvalue).prop('checked',false);
			}
        
		$("#loader").fadeOut();
    }
	
	
	
	function calculateexpirydate(duration,ids) 
	{	$("#loader").fadeIn();	
		var startdate=document.getElementById("single_cal2").value;
		if(startdate !=''){
		var someDate = new Date(startdate);
		var new1=someDate.setTime(someDate.getTime()-1 +  (duration * 24 * 60 * 60 * 1000));
		var d=new Date(new1);
		var datestring = (d.getMonth()+1) + "/" + d.getDate()  + "/" + d.getFullYear() ;
		
		var idsplit= ids.split('_') ;
		var newid = idsplit[1];
		
		
		document.getElementById('expira_'+newid).value=datestring;
		var dates=[];
		
		$(".currentexpiry").each(function() {
				
           dates.push(new Date(this.value))
			
        });
		
		var maxDate=new Date(Math.max.apply(null,dates));
		var currentexpiry=(maxDate.getMonth()+1) + "/" + maxDate.getDate()  + "/" + maxDate.getFullYear()
		
		//var minDate=new Date(Math.min.apply(null,dates));
		document.getElementById('currentexpiry').value=currentexpiry;
		campaignexpirydate();
	}
		$("#loader").fadeOut();
	}
	
	function campaignexpirydate() 
	{	$("#loader").fadeIn();	
		
		var startdate=document.getElementById("single_cal2").value;
		if(startdate !=''){
		var datestring='';
		var duration=[];
		var newexpirydate='';
		var datearray=[];
		
		$(".inventoryduration").each(function() {
				
           duration.push(this.value)
			
        });
		
		if(duration !=''){
			var maxduration=Math.max.apply(null,duration);
			var someDate = new Date(startdate);
			var new1=someDate.setTime(someDate.getTime()-1 +  (maxduration * 24 * 60 * 60 * 1000));
			var d=new Date(new1);
			var datestring = (d.getMonth()+1) + "/" + d.getDate()  + "/" + d.getFullYear() ;
			datearray.push(new Date(datestring))
			
		}
		
		var planexpirydate=document.getElementById('currentexpiry').value;
		
		if(planexpirydate !=''){
			datearray.push(new Date(planexpirydate))
		}
		
		if(datearray !=''){
			var maxDate=new Date(Math.max.apply(null,datearray));
			 newexpirydate=(maxDate.getMonth()+1) + "/" + maxDate.getDate()  + "/" + maxDate.getFullYear()
		}
		
		document.getElementById('enddate').value=newexpirydate;
	}
		$("#loader").fadeOut();
	}
	
	
	function checkplanavailable(planid,rowid)
{	
	var id=rowid.split("_");
	var userid=document.getElementById("userid").value;
	
	if(planid && userid)
	{
		$.ajax({
				type: "POST",
				url : base_url+'common_functions/checkplanavailable',
				data: {planid: planid , userid:userid },
				beforeSend: function() {
				$("#loader").fadeIn();
			}
			})
			
				.done(function(msg)
				{
					$("#loader").fadeOut();
					if(msg !='')
					{
						var topic = eval(msg);
						$.each(topic, function(i,v){
							document.getElementById('carrayforword_'+id[1]).value=(v.quantity);
							document.getElementById('lastexpiry_'+id[1]).value=(v.currentExpiry);
							
							});
					
					}else{
						document.getElementById("carrayforword_"+id[1]).setAttribute("readonly","true");
						document.getElementById("carrayforword_"+id[1]).value="";
					}	
				});
		
					
	}
}


function generatenameproperty() 
	{   
		$("#loader").fadeIn();
		if(document.getElementById('propertyname') !=null){
		//var purpose='';
		var propertytype='';
		var inproject='';
		var rooms='';
		
		/* if($('#sell').is(':checked')) { 
				var purpose=document.getElementById('sell').value;
		}
		if($('#rent').is(':checked')){
				var purpose=document.getElementById('rent').value;
		} */
		
		/* var projectid = $("#projectid option:selected").val();
		
		if(projectid !=''){
				var inproject= ' in ' + $("#projectid option:selected").text();
		} */
		
		var coveredareasize='';
		var coveredarea='';
		if(document.getElementById('coveredarea') !=null){
		var coveredarea = $("#coveredarea").val();
		if(coveredarea !=''){
		var coveredareasize = 'sq-ft';//$("#coveredareasize option:selected").text();
		}
		}
		if(document.getElementById("bedroom") != null) {
			if($("#bedroom option:selected").val() !=''){
			var rooms= $("#bedroom option:selected").text() + ' BHK ';
			}
		}
		var propertytypeid = $("#propertytype option:selected").val();
		if(propertytypeid !=''){
		var propertytype = $("#propertytype option:selected").text();
		}
		var newtittle = rooms + propertytype  + ' ' +  coveredarea +' '+  coveredareasize;
		document.getElementById('propertyname').value='';
		document.getElementById('propertyname').value=newtittle;
	}
		$("#loader").fadeOut();
}

function InsertProperty(id) 
	{   
		
		var data = $("#form-"+id).serialize();
		var formid=id;
		$.ajax({
         data: data,
         type: "post",
         url: base_url+'AddProperty/InsertProperty/'+formid,
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			// alert(result);
			 if(result){
			 $("#loader").fadeOut();
			  document.getElementById("form1_id").value=result;
			 // document.getElementById("form2_id").value=result;
			  document.getElementById("form3_id").value=result;
			  document.getElementById("form4_id").value=result;
			  document.getElementById("form5_id").value=result;
			  $('.form5_id').val(result);
			  var newurl=base_url+'AddProperty/index/'+result;
			  window.history.pushState("object or string", "Title",newurl);
			 }
         }
});
		
}

function getimagesafterupload(){
	
	var propertyID=$('.form5_id').val();
	
	if(propertyID !=''){
		
		$.ajax({
		data:{propertyID:propertyID},
         type: "post",
         url: base_url+'Common_functions/getimagesafterupload',
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			 $("#loader").fadeOut();
			 if(result){
			 
			 $('.afteruploadimagediv').html('');
			 $('.afteruploadimagediv').html(result);
			 }
         }
});

	}
}

function deleteiamge1(imageid,divid) 
	{   
		
		
		$.ajax({
         data: {imageid:imageid},
         type: "post",
         url: base_url+'AddProperty/Deletepropertyimage',
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			 $("#loader").fadeOut();
			document.getElementById(divid).style.display = "none";
			alert(result);
         }
});
		
}

function shownoofbedrooms(id) 
	{   
		
		var formid=id;
		var propertyid=document.getElementById("form3_id").value;
		if(propertyid !=''){  
		$.ajax({
         data: {propertyid:propertyid},
         type: "post",
         url: base_url+'AddProperty/Shownoofbedrooms/'+formid,
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			 $("#loader").fadeOut();
			
			  $('.showbedrooms').html(result);
         }
			});
		}else{
			alert("Property ID is not found!!");
		}	
}

function showpreview(id) 
	{   
		
		var formid=id;
		var propertyid=document.getElementById("form4_id").value;
		if(propertyid !=''){  
		$.ajax({
         data: {propertyid:propertyid},
         type: "post",
         url: base_url+'AddProperty/Showpreview/'+formid,
		 beforeSend: function() {
				$("#loader").fadeIn();
			},
         success: function(result){
			 $("#loader").fadeOut();
			//alert(result);
			  $('.showpreview').html(result);
         }
			});
		}else{
			alert("Property ID is not found!!");
		}	
}

/*Set AS Cover Image OF Property............................. End*/	

function isCoverImage(imageID,propertyid){
	
	$.ajax({
            type: 'POST', 
            url: AbsoluteURL+'AddProperty/isCoverImage',
            data: {imageID:imageID,propertyid :propertyid},
				success:function(result){
             	if(result=="success"){
					$(".cover-img").css('display','none');
					$("#ajaxtimeimg_"+imageID).css('display','block');
				}
				
             }
		});
		return false;
	
}
/*Set AS Cover Image OF Property............................. End*/	


$(document).ready(function(){
	
/*Get User For Add Property............................. Start*/	
$(".usertypeid").change(function(){
	
	var usertypeID = $("#"+($(this).attr('id'))).val();
	var usertypename = $("#"+($(this).attr('id'))).attr('id');
	
	$.ajax({
            type: 'POST', 
            url: base_url+'AddProperty/GetUser',
            data: {usertypeID:usertypeID},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				$("#loader").fadeOut();
				$(".showuserlabel").html(usertypename);
				$("#showuserlabel").html(result);
             
            }
        });
	
});	
/*Get User For Add Property............................. End*/	

/*Get UserPlan For Add Property............................. Start*/	
$("#showuserlabel").change(function(){
	var userID = $("#"+($(this).attr('id'))).val();
	$.ajax({
            type: 'POST', 
            url: base_url+'AddProperty/GetUserplan',
            data: {userID:userID},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				$("#loader").fadeOut();
				$("#userplan").html(result);
             
            }
        });
	
});	
/*Get UserPlan For Add Property............................. End*/	



/*Get Attributes For Add Property............................. Start*/	

$("#propertytype").change(function(){
	
	var propertytypeid = $("#"+($(this).attr('id'))).val();
	
	$.ajax({
            type: 'POST', 
            url: base_url+'AddProperty/Getattributes',
            data: {propertytypeid:propertytypeid},
			cache: false,
			beforeSend: function() {
				$("#loader").fadeIn();
			},
            success:function(result){
				//alert(result);
				$("#loader").fadeOut();
				$("#showattributes").html(result);
							
							if($('input[name=propertyPurpose]:checked')) { 
								
							if($('input[name=propertyPurpose]:checked').val()=='Sell'){
							$(".price_as").html("Show Price As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Price <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Price & Other Charges");
							$(".disablerent").css("display","none");
							$(".disablesell").css("display","block");
							$(".disablerentbro").css("display","none");
							//$(".ageofconstruction").css("display","none");
							$(".available").css("display","block");
							$(".dateshow").css("display","none");
							}
						
							if($('input[name=propertyPurpose]:checked').val()=='Rent'){
							$(".price_as").html("Show Rent As <i class='fa fa-rupee text-right'>");
							$(".expectedpricesellrent").html("Expected Rent <i class='fa fa-rupee text-right'>");
							$(".slowlabelheading").html("Rent & Other Charges");
							$(".disablesell").css("display","none");
							$(".disablerent").css("display","block");
							//$(".ageofconstruction").css("display","block");
							$(".dateshow").css("display","block");
							$(".available").css("display","none");
							if($("#usertypeid option:selected").val() !=''){
								var username= $("#usertypeid option:selected").text();
								if(username=="Agent"){
									$(".disablerentbro").css("display","block");
								}
								}
							
							}
							}
						
            }
        });
	
});	
/*Get Attributes For Add Property............................. End*/

$(".imgtagclose").click(function(){
	$('.editmode').fadeOut();
});

$(".imgtagclose").click(function(){
	$('.editmode1').fadeOut();
});

});



function appImageEdit(imageID){
	//alert(imageID);
	$('#ajaxeditimg_'+imageID).fadeIn();
	//$('#ajaxeditimg1_'+imageID).fadeIn();
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

function appImageEdit1(imageID){
	//alert(imageID);
	//$('#ajaxeditimg_'+imageID).fadeIn();
	$('#ajaxeditimg1_'+imageID).fadeIn();
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

function editImageTag(imageID,appointmentid){
	//alert(imageID);
	imagetagText = $("#imgtagedit_"+imageID).val();
	imagetagText1 = $("#imgtagedit1_"+imageID).val();
	//alert(imagetagText);
	//alert(imagetagText1);
	$.ajax({
            type: 'POST', 
            url: base_url+'AddProperty/editImageTag',
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