$(document).ready(function(){
	var reqTest = new AjaxReq();
	$("#done").bind('click',function(){
		if ($('#noq').val() == '') {
			$("#details").html('<div class="alert alert-block alert-error fade in"> No of questions field cannot be empty </div>');
		} else if ($('#tname').val() == ''){
			$("#details").html('<div class="alert alert-block alert-error fade in"> Test Name field cannot be empty </div>');
		}else if ($('#time').val() == '') {
			$("#details").html('<div class="alert alert-block alert-error fade in"> Time field cannot be empty </div>');
		} else{
			if (isNaN($('#noq').val())) {
				$("#details").html('<div class="alert alert-block alert-error fade in"> No of questions is not a valid number </div>');
			} else{
				if (isNaN($('#time').val())) {
					$("#details").html('<div class="alert alert-block alert-error fade in"> Time specified is not a valid number </div>');
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