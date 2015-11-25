function get_planpriority(plantypeid)
{ 
	$.ajax({
				type: "POST",
				url : 'common_functions/get_planpriority',
				data: {plantypeid: plantypeid  },
			})	
				.done(function(msg){
					document.getElementById('planorder').value=msg;
					return false;	
				});
		
		return false;
}


