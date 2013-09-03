function addBRtags(node){
	var str = $(node).val();
	var arr = str.split('\n');
	str = arr.join('<br />');
	$(node).val(str);
}
$(document).ready(function(){
	var appendEle;
	$('#imgyes').bind('click',function(){
		appendEle = '<div class="fileupload fileupload-new" data-provides="fileupload">' +
						'<div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>' +
						'<div>' +
						'<span class="btn btn-file">' +
							'<span class="fileupload-new">Select image</span>' +
								'<span class="fileupload-exists">Change</span>' +
								'<input type="file" name="filename"/>' +
							'</span>' +
						'<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></div></div>';		
		$("#imgsource").append(appendEle);
	});
	$('#imgno').bind('click',function(){
		$("#imgsource").replaceWith('<div id="imgsource"> </div>');
	});
	$("#noQ").bind('change',function() { 
		var nChoices = $(this).val();
		if (nChoices < 2) {
			$("#errmesg").html('<div class="alert alert-block alert-error fade in"> There must atleast be two choices </div>');
			$("#placebutton").html('');
		}
		else {
			$("#errmesg").html('');
			$("#choices").replaceWith('<div id="choices"> </div>');
			for(var i = 1; i <= nChoices; ++i) {
				appendEle = '<label>Choice ' + i + '</label>';
				$("#choices").append(appendEle);
				appendEle = '<textarea class="input-block-level" rows="4" placeholder="Enter your choice here..." name="C' + i + '"  id="C' + i + '"> </textarea>';
				$("#choices").append(appendEle);
			}
			$("#answer-label").replaceWith('<label id="answer-label">Correct Answer </label>');
			appendEle = '<span id="answer-span"> </span>';
			$("#answer-label").append(appendEle);
			appendEle = '<select class="span1 btn" name="correctAnswer" id="correctAnswer"> </select>';
			$("#answer-span").append(appendEle);
			for(var i = 1; i <= nChoices; ++i) {
				appendEle = '<option value="' + i + '">' + i + '</option>';
				$("#correctAnswer").append(appendEle);
			}
			$("#placebutton").html('<button class="btn btn-block btn-primary" type="button" id="finish">Done</button>');
			$('#finish').bind('click',function() {
				if ($("#qtext").val() == '') {
					$("#errmesg").html('<div class="alert alert-block alert-error fade in"> Question text field cannot be empty </div>');
				}
				else
				{
					addBRtags('#qtext');
					$("#questionform").submit();
				}
			});
		}
	});
	$('#finish').bind('click',function() {
		addBRtags('#qtext');
		$("#questionform").submit();
	});
});