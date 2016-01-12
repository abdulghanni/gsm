$(document).ready(function (e) {
	$("#photo").on('change',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "../../users/upload/26",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});