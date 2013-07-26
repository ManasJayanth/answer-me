$(document).ready(function(){
	$("#noQ").bind('change',function() { 
		var choiceEle;
		var val = $(this).val();
		$("#choices").replaceWith('<div id="choices"> </div>');
		for(var i = 1; i <= val; ++i) {
			choiceEle = '<label>Choice ' + i + '</label>';
			$("#choices").append(choiceEle);
			choiceEle = '<textarea class="input-block-level" rows="4" placeholder="Enter your choice here..." name="C' + i + '"> </textarea>';
			$("#choices").append(choiceEle);
		}
		choiceEle = '<button class="btn btn-block btn-primary" type="submit" >Done</button>';
		$("#question").append(choiceEle);
	});
});