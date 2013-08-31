<?php
$raiseAlert = "false";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require_once('serverspecific.php');
	$loginid = $_POST['loginid'];
	$pword = $_POST['password'];
	$testid = $_POST['testid'];

	$testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
	$testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql = "SELECT COUNT(*) FROM student WHERE loginid = :loginid AND password = md5(:pword)";
	$pstatement = $testh->prepare($sql);
	try {
		$success = $pstatement->execute(array(':loginid' => $loginid,':pword' => $pword));
		$num = $pstatement->fetchColumn();
		if ($num == 1) {
			session_start();
			$_SESSION['login'] = "1";
			$_SESSION['loginid'] = $loginid;
			$_SESSION['testid'] = $testid;
			// echo "success";
			header ("Location: taketest.php");
		}
		else
		{
			session_start();
			$_SESSION['login'] = "";
			// echo "fail";
			$raiseAlert = "true";
		}
	} catch (PDOException $e) {
		echo "Following error was encountered <br />";
		echo $e->getMessage();
	}
}
?>
<html lang="en">
<html>
<head>
<title>answerMe &middot; Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/login.css" rel="stylesheet" media="screen">
<link href="../css/mycsslib.css" rel="stylesheet" media="screen">
<script type="text/javascript">
</script>
</head>
<body>
    <div class="container">
    	<form class="form-signin" method="POST" action="login.php">
	        <h1 style="font-weight: bolder"> AnswerMe </h1>
	        <input class="input-block-level" id="loginId" placeholder="Login ID" type="text" name="loginid">
	        <input class="input-block-level" id="testid" placeholder="Test ID" type="text" name="testid">
	        <input class="input-block-level" id="pass" placeholder="Password" type="password" name="password">
	        <button class="btn btn-block btn-primary" type="submit" id="starttest">Take Test</button>
	        <br />
	        <a href="#myModal" role="button" data-toggle="modal">Dont have a Login ID yet?</a>
	    </form>

		<!-- Modal -->
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h2 id="myModalLabel">Sign Up!</h2>
			</div>
			<div class="modal-body">
				<form class="form-signin" method="POST" action="login.php">
		        <input class="input-block-level" id="modalloginId" placeholder="Preferred Login ID (consisting of characters and numbers)" type="text" name="loginid">
		        <span class="help-block" id="availmesg">
		        </span>
		        <input class="input-block-level" id="name" placeholder="Your Full Name" type="text" name="testid">
		        <input class="input-block-level" id="password" placeholder="Desired Password" type="password" name="password">
		        <input class="input-block-level" id="rpassword" placeholder="Re-enter password for verification" type="password" name="password">
		        <button class="btn btn-block btn-primary" type="button" id="register">Register</button>
		    </form>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<div id="mesg" class="pull-left">
		    	</div>
			</div>
		</div>

	    <div id="errmesg">
	    </div>
	    <footer>
	    	<hr> 
	        <span class="pull-right"><a href="../index.php">Back Home</a></span>
	        <span>© 2013 answerMe </span>
	    </footer>
    </div>
<script src="../js/jquery1.10.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/usernameajax.js"></script>
<script type="text/javascript">
//var idok = false;
var nameok = false;
var passok = false;

$(document).ready(function () {
	/*** Empty all modal fields ***/
	$('#modalloginId').val('');
	$('#name').val('');
	$('#password').val('');
	$('#rpassword').val('');

	var newReq = new AjaxReq();
	$('#modalloginId').on('change',function(){
		newReq.check($('#name').val());
	});
	$('#register').on('click',function(){
		if ($('#password').val() == $('#rpassword').val()) {
			if ($('#name').val() != '') {
				if ($('#password').val() != '') {
					var data = '';
					data += $('#modalloginId').val() + ';';
					data += $('#name').val() + ';';
					data += $('#password').val();
					newReq.send(data);
				}
				else {
				$('#mesg').html('<div class="alert-error">' + 
	    								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	    								'Password field mustnot be empty' +
	    							'</div>');
				}
			}
			else {
				$('#mesg').html('<div class="alert-error">' + 
	    								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
	    								'Name field mustnot be empty' +
	    							'</div>');
			}
		}
		else {
			$('#mesg').html('<div class="alert-error">' + 
    								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
    								'Passwords don\'t match' +
    							'</div>');
		}
	});
});
</script>
<script type="text/javascript">
var rAlert = <?php echo $raiseAlert ?>;
if (rAlert) {
	$("#errmesg").append('<div class="alert alert-block alert-error fade in"> Invalid Pasword! </div>');
};
</script>
</body>
</html>