function AjaxReq(){
	this.sendSuccess = false;
	this.recSuccess = false;
	this.send = sendData;
	this.rec = recData;
}

function sendData(str) {
	$.ajax({
	   type: "POST",
	   url: "php/ajax.php",
	   data: {  'function': 'sendData',
				'data': str
				},
	   dataType: "json",
	
	   success: function(data){
	   	this.sendSuccess = true;
	   	$("#details").replaceWith("<div id='details'></div>");
		// $("#details").append(data.result);
		$("#details").append("<h3 style='text-align:center'> Test Created! </h3>");
	   	$("#details").append("<div style='text-align:center'>" + data.result + "</div>");
	   },
	   error: function(xhr, textStatus, errorThrown) {
				alert('An error occurred! ' + ( errorThrown ? errorThrown :
				xhr.status ));
	   }
	});
}
function recData() {
	$.ajax({
		type: "POST",
		url: "php/ajax.php",
		data: {'function': 'recData'},
		dataType: "json",

		success: function(data){
			this.recSuccess = true;			
		},
		error: function(xhr, textStatus, errorThrown) {
				alert('An error occurred! ' + ( errorThrown ? errorThrown :
				xhr.status ));
		}
	});
}
