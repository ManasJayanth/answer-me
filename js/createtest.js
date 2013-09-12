$(document).ready(function(){
	var reqTest = new AjaxReq();
	$("#done").bind('click',function(){
		if ($('#noq').val() == '') {
			alert('No of questions field cannot be empty');
		} else if ($('#tname').val() == ''){
			alert('Test Name field cannot be empty');
		}else if ($('#time').val() == '') {
			alert('Time field cannot be empty');
		} else{
			if (isNaN($('#noq').val())) {
				alert('No of questions is not a valid number');
			} else{
				if (isNaN($('#time').val())) {
					alert('Time specified is not a valid number');
				} else{
					var data = "";
					data += $("#tname").val();
					data += ';';
					data += $("#noq").val();
					data += ';';
					data += $("#negyes").is(':checked') ? 'on' : 'off';
					data += ';';
					data += $("#time").val();
					data += ';';
					reqTest.send(data);
				}
			}
		}
	});
});