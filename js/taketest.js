var st_id = "XXX";
var pass = "";
function timer() {
	if(sec >= 0) {
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
			  document.getElementById('st_id').value = st_id;
			  form[0].submit();
			  var node = document.getElementById("containerId");
			  node.removeChild(document.getElementById("clock"));
			  node = document.getElementById("test");
			  while (node.firstChild)
				node.removeChild(node.firstChild);
			  var box = document.createElement("div");
			  node.appendChild(box);
			  var h2 = document.createElement("h2");
			  h2.appendChild(document.createTextNode("Time Up!"));
			  box.appendChild(h2);
			  var p = document.createElement("p");
			  p.appendChild(document.createTextNode("Your answer is being submitted"));
			  box.appendChild(p);
		}
	}
}
function startTest() {
	st_id = $("#loginId").val();
	pass = $("#pass").val();
	test_id = $("#testid").val();
	document.getElementById("loginbox").style.visibility = "hidden";
	document.getElementById("containerId").style.visibility = "visible";
	setInterval("timer();",1000);
}

$(document).ready(function(){
	$("#starttest").bind('click',startTest);
});