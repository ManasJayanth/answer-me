function timer() {
		var mins = Math.floor(sec / 60);
		var secs_left = sec % 60;
		var timetext = mins + ":" + secs_left;
		var node = document.getElementById("time");
		while (node.firstChild)
		node.removeChild(node.firstChild);
		node.appendChild(document.createTextNode(timetext));
		sec = sec - 1;
		if(sec == -1) {
			var form = document.getElementsByTagName("form");
			//form[0].submit();
		}
}

$(document).ready(function(){
	setInterval("timer();",1000);
	$("#done").bind('click',function(){
		$("#test").submit();
	});
});