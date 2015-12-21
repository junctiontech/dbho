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
					}else{
						document.getElementById('user_type').value="";
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
	
	function calculateexpirydate(duration,ids) 
	{	$("#loader").fadeIn();	
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

$(document).ready(function(){
	
	
$("#usertypeid").change(function(){
	
	var usertypeID = $("#"+($(this).attr('id'))).val();
	
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
				$("#showuserlabel").html(result);
             
            }
        });
	
});	


});