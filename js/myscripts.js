$(document).ready(function(){
	$("#noQ").bind('change',function() { 
		var choiceEle;
		var nChoices = $(this).val();
		$("#choices").replaceWith('<div id="choices"> </div>');
		for(var i = 1; i <= nChoices; ++i) {
			choiceEle = '<label>Choice ' + i + '</label>';
			$("#choices").append(choiceEle);
			choiceEle = '<textarea class="input-block-level" rows="4" placeholder="Enter your choice here..." name="C' + i + '"> </textarea>';
			$("#choices").append(choiceEle);
		}

		$("#answer-label").replaceWith('<label id="answer-label">Correct Answer </label>');
		choiceEle = '<span id="answer-span"> </span>';
		$("#answer-label").append(choiceEle);
		choiceEle = '<select class="span1 btn" name="correctAnswer" id="correctAnswer"> </select>';
		$("#answer-span").append(choiceEle);
		for(var i = 1; i <= nChoices; ++i) {
			choiceEle = '<option value="' + i + '">' + i + '</option>';
			$("#correctAnswer").append(choiceEle);
		}
	});	
	choiceEle = '<button class="btn btn-block btn-primary" type="submit" >Done</button>'; //reusing the variable
	$("#question").append(choiceEle);
});