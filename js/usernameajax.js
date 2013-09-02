function AjaxReq(){
	this.check = check;
	this.send = send;
}

function check(str) {
	$("#availmesg").html('<img style="margin-left: 50%" src="../img/ajax-loader.gif"  alt="Checking..." />');
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
	   	if (data.result == 'success') {
	   		failorsucc = 'alert-success';
	   		text = 'Username Available!';
	   	}
	   	else if (data.result == 'failure') {
	   		failorsucc = 'alert-error';
	   		text = 'This username is already taken. Please try another';
	   	}
	   	else{
	   		failorsucc = 'alert-error';
	   		text = data;	
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
	$("#mesg").html('<img src="../img/ajax-loader.gif"  alt="" /> <i>Registering...</i>');
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
	   	if (data.result == 'success') {
	   		failorsucc = 'alert-success';
	   		text = 'Your registration has been successful! You can now close this modal window and proceed with signing in.';
	   	}
	   	else {
	   		failorsucc = 'alert-error';
	   		text = 'Error occured: ' + data.result;
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