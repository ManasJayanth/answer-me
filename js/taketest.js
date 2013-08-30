var noOfSeconds;

function probeCookie() {
	var cookies = document.cookie.split(';');
	var searchName = "timeLeft=";
	for(var i=0; i < cookies.length; i++) {
	    var cookie= cookies[i];
	    var ind = cookie.indexOf(searchName);
			if (ind != -1) {
				var val = cookie.substring(ind+9,cookie.length);
				return val;
			}
	}
	return 'noCookie';
}

function setCookie(name, value, path) { 
  document.cookie = name+"="+value+";path="+path; 
} 

function deleteCookie() { 
     document.cookie = "timeLeft"+"=;path=/"+";expires=Thu, 01-Jan-1970 00:00:01 GMT"; 
} 

function timer() {
    if(noOfSeconds >= 0) {
    	setCookie('timeLeft', noOfSeconds, '/');
        var mins = Math.floor(noOfSeconds / 60);
        var noOfSecondss_left = noOfSeconds % 60;
        var timetext = mins + ":" + noOfSecondss_left;
        var node = document.getElementById("time");
        while (node.firstChild)
        node.removeChild(node.firstChild);
        node.appendChild(document.createTextNode(timetext));
        noOfSeconds = noOfSeconds - 1;
        if(noOfSeconds == -1) {
        	  finishTest();
        }
    }
}

function startTest() {
	setInterval("timer();",1000);
}

function finishTest() {
	deleteCookie();
	var expires = new Date();
	expires.setTime(expires.getTime() + 1 * 24 * 60 * 60 * 1000);
	document.cookie = "tid=" + tid + "; expires=" + expires.toGMTString() + "; path=/";
	document.cookie = "loginid=" + logid + "; expires=" + expires.toGMTString() + "; path=/";
	var form = document.getElementsByTagName("form");
	form[0].submit();
}

function checkCookie() {
	var cookieEnabled=(navigator.cookieEnabled)? true : false;

	//if not IE4+ nor NS6+
	if (typeof navigator.cookieEnabled=="undefined" && !cookieEnabled){ 
	document.cookie="testcookie";
	cookieEnabled=(document.cookie.indexOf("testcookie")!=-1)? true : false;
	}

	if (!cookieEnabled) {
		return 'not-enabled';
	}
}

function requestCookieEnable() {
	var node = document.getElementById("containerId");
	node.removeChild(document.getElementById("clock"));
	$("#heading").html('<div class="navbar">' +
			            '<div class="navbar-inner">' +
			                '<ul class="nav">' +
			                    '<li><a href="../index.php">Home</a></li>' +
			                    '<li><a href="../createtest.html">Create Test</a></li>' +
			                    '<li><a href="viewdb.php">View Database</a></li>' +
			                    '<li class="active"><a href="taketest.php">Take Test</a></li>' +
			                '</ul>' +
			                '</ul>' +
			            '</div>' +
			        '</div>');
	node = document.getElementById("test");
	while (node.firstChild)
	node.removeChild(node.firstChild);
	var box = document.createElement("div");
	box.id = "box";
	node.appendChild(box);
	var h2 = document.createElement("h2");
	h2.appendChild(document.createTextNode("Cookies not enabled!"));
	box.appendChild(h2);
	var p = document.createElement("p");
	p.appendChild(document.createTextNode("Please enable cookies in you browser and refresh the page."));
	box.appendChild(p);
	p = document.createElement("p");
	p.appendChild(document.createTextNode("If you're not sure how this is done, Google \'enable cookies <your_browser_name>\'"));
	box.appendChild(p);
}

$(document).ready(function(){		
//******** Event handlers ***************//
	$("#done").bind('click',function(){
		finishTest();
	});
	window.onunload = function() {
        /*
		This could be used to prevent user from reloading. However, this couldbe inconvenient at times when images aren't loaded
		properly. Hence commented.

        finishTest();
        */

    }
    window.onbeforeunload = function() {
        return "Navigating away";
    }

//******** Test ***************//
	var timeLeft = probeCookie();
	var cookieEnabled = checkCookie();
	if (cookieEnabled == 'not-enabled') {
		requestCookieEnable();
	}
	else {
		if(timeLeft != 'noCookie') {
			noOfSeconds = timeLeft;
		}
		else {
			noOfSeconds = sec;
		}
		startTest();
	}
});