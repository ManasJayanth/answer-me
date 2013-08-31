function AjaxReq(){
	this.check = check;
	this.send = send;
}

function check(str) {
	$.ajax({
	   type: "POST",
	   url: "usernameajax.php",
	   data: {  'function': 'check',
				'data': str
				},
	   dataType: "json",
	
	   success: function(data){
	   	var failorsucc;
	   	var text;
	   	if (data.result) {
	   		failorsucc = 'alert-success';
	   		text = 'Username Available!';
	   	}
	   	else {
	   		failorsucc = 'alert-error';
	   		text = 'Username unavailable';
	   	}
	   	$("#availmesg").html('<span class="alert ' + failorsucc + ' help-block" id="availmesg">' +
	        							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	        							text +
	       						 	'</span>');
	   },
	   error: function(xhr, textStatus, errorThrown) {
				alert('An error occurred! ' + ( errorThrown ? errorThrown :
				xhr.status ));
	   }
	});
}

function send (str) {
	$.ajax({
	   type: "POST",
	   url: "usernameajax.php",
	   data: {  'function': 'send',
				'data': str
				},
	   dataType: "json",
	
	   success: function(data){
	   	var failorsucc;
	   	var text;
	   	if (data.result) {
	   		failorsucc = 'alert-success';
	   		text = 'Your registration has been successful! You can now close this modal window and proceed with signing in.';
	   	}
	   	else {
	   		failorsucc = 'alert-error';
	   		text = 'Some error occured';
	   	}
	   	$("#mesg").html('<span class="alert ' + failorsucc + ' help-block" id="availmesg">' +
	        							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	        							text +
	       						 	'</span>');
	   },
	   error: function(xhr, textStatus, errorThrown) {
				alert('An error occurred! ' + ( errorThrown ? errorThrown :
				xhr.status ));
	   }
	});	
}