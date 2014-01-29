function removeQuicklink(aid) {
	$.ajax(
		{
			url: "handler.php",
			data: {
				loggedin: 1,
				id: aid,
				action: "remove",
				mode: "quicklink"
			},
			dataType : "json",
			type: "POST",
			success: function (response) {
				if (response.result = "ok")
				{
					$("#quicklink-"+response.id).hide("slow");
				}
				else
				{
					alert(response);
				}
				//console.log(response);
			},			
			error: function( xhr, status ) {
					alert( "Sorry, there was a problem!" );
			}
		}
	
	)
}


function handleRequest(aloggedin,aid,aaction,mode) {
	// Using the core $.ajax() method
	$.ajax({
			// the URL for the request
			url: "handler.php",
	 
			// the data to send (will be converted to a query string)
			data: {
					loggedin: aloggedin,
					id: aid,
					action: aaction,
					json: ajson
			},
	 
			// whether this is a POST or GET request
			type: "POST",
			
			//dataType : "json",
	 
			// code to run if the request succeeds;
			// the response is passed to the function
			success: function( response ) {
				console.log(response);
			},
	 
			// code to run if the request fails; the raw request and
			// status codes are passed to the function
			error: function( xhr, status ) {
					alert( "Sorry, there was a problem!" );
			}
	});

}