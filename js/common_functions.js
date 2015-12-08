function get_planpriority(plantypeid)
{ 
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/get_planpriority',
				data: {plantypeid: plantypeid  },
			})	
				.done(function(msg){
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
			})	
				.done(function(msg){
					if(msg !=''){
					document.getElementById('user_type').value=msg;
					$( '#showhidden' ).css( "pointer-events", "auto" );
					}else{
						document.getElementById('user_type').value="";
						$( '#showhidden' ).css( "pointer-events", "none" );
					}
					return false;	
				});
		
		return false;
}


function get_plans(userid)
{
	if(userid){
	$.ajax({
				type: "POST",
				url : base_url+'common_functions/get_planbyusertype',
				data: {userid: userid  },
			})	
				.done(function(msg){
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
			})	
				.done(function(msg){
					
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
 
    function calculateSum() 
	{
 
        var sum = 0;
        $(".txt").each(function() {
 
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        $("#sum").html(sum.toFixed(2));
    }
	
	function calculateexpirydate(duration,ids) 
	{		
		var startdate=document.getElementById("single_cal2").value;
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
	}
	
	
	function checkplanavailable(planid)
{	
	var userid=document.getElementById("userid").value;
	
	if(planid && userid)
	{
		$.ajax({
				type: "POST",
				url : base_url+'common_functions/checkplanavailable',
				data: {planid: planid , userid:userid },
			})
			
				.done(function(msg)
				{
					if(msg !='')
					{
						var topic = eval(msg);
						$.each(topic, function(i,v){
							document.getElementById('carrayforword_0').value=(v.quantity);
							document.getElementById('lastexpiry_0').value=(v.currentExpiry);
							
							});
					
					}else{
						//$( '#carrayforword_0' ).setAttribute( "readonly");
						document.getElementById("carrayforword_0").setAttribute("readonly","true");
					}	
				});
		
					
	}
}
	