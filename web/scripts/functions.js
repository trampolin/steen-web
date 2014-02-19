$.fn.slideUpRemove = function (d, c) {
    var _this = this,
        duration = $.isNumeric(d) || $.isPlainObject(d) ? d : 300,
        callback = $.isFunction(c) ? c : d;

    return this.slideUp(duration).promise().done(function () {
        _this.remove();
        if ($.isFunction(callback)) callback.call();
    });
};

function removeQuicklink(aid) {
	if (confirm("delete quicklink "+aid+"?")) {
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
					if (response.result == "ok")
					{
						$("#quicklink-"+response.id).slideUpRemove()//slideUp(300);
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
}

function activateQuicklink(aid) {
	$.ajax(
		{
			url: "handler.php",
			data: {
				loggedin: 1,
				id: aid,
				action: "activate",
				mode: "quicklink"
			},
			dataType : "json",
			type: "POST",
			success: function (response) {
				if (response.result == "ok")
				{
					//$("#quicklink-"+response.id).slideUpRemove()//slideUp(300);
					//alert("success");
					updateItem("quicklink",response.items[0]);
				}
				else
				{
					alert(response.message);
				}
				//console.log(response);
			},			
			error: function( xhr, status ) {
					alert( "Sorry, there was a problem!" );
			}
		}
	)
}

function updateItem(itemtype,ql) {
	console.log(ql);
	var item = $('#'+itemtype+'-'+ql.id);
	
	if (ql.active == 1)
	{
		item.removeClass('inactive');
		item.addClass('active');
		
		var button = $('#adminbutton-'+itemtype+'-'+ql.id);
		
	}
	else
	{
		item.removeClass('active');
		item.addClass('inactive');
		
		var button = $('#adminbutton-'+itemtype+'-'+ql.id);
	}
	
}

function deactivateQuicklink(aid) {
	$.ajax(
		{
			url: "handler.php",
			data: {
				loggedin: 1,
				id: aid,
				action: "deactivate",
				mode: "quicklink"
			},
			dataType : "json",
			type: "POST",
			success: function (response) {
				if (response.result == "ok")
				{
					//$("#quicklink-"+response.id).slideUpRemove()//slideUp(300);
					//alert("success");
					updateItem("quicklink",response.items[0]);
				}
				else
				{
					alert(response.message);
				}
			},			
			error: function( xhr, status ) {
					alert( "Sorry, there was a problem!" );
			}
		}
	)
}

function addLocalQuicklink() {
	$('#quicklinkliste').append('<div class="adminkachel" id="quicklink-new"></div>');
	$('#quicklink-new').hide();
	$('#quicklink-new').slideDown(300);
	
}

function adminLogin(auser,apasswordmd5) {
	$.ajax(
		{
			url: "handler.php",
			data: {
				action: "login",
				loggedin: 0,
				user: auser,
				pass: apasswordmd5
			},
			dataType : "json",
			type: "POST",
			success: function (response) {
				if (response.result == "ok")
				{
					alert("logged in as: " +response.user);
				}
				else
				{
					alert(response.message);
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