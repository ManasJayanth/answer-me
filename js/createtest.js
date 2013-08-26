$(document).ready(function(){
	var reqTest = new AjaxReq();
	$("#done").bind('click',function(){
		var data = "";
		data += $("#tname").val();
		data += ';';
		data += $("#noq").val();
		data += ';';
		data += $("#negyes").checked ? 'on' : 'off';
		data += ';';
		data += $("#time").val();
		data += ';';
		reqTest.send(data);
	});
});