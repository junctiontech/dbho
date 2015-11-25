function get_planpriority(plantypeid)
{ alert(base_url);
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


