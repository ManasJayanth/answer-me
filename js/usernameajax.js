function AjaxReq(){
	this.sendSuccess = false;
	this.recSuccess = false;
	this.check = check;

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