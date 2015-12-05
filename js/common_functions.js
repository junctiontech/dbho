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
 
    function calculateSum() {
 
        var sum = 0;
        $(".txt").each(function() {
 
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        $("#sum").html(sum.toFixed(2));
    }