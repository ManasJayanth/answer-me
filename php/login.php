<?php
$invalidUID = "false";
$invalidTestID = "false";
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
		$numUID = $pstatement->fetchColumn();

		$sql = "SELECT COUNT(*) FROM test WHERE testid = :testid";
	    $pstatement = $testh->prepare($sql);
	    $success = $pstatement->execute(array(':testid' => $testid));
	    $numTID = $pstatement->fetchColumn();
		if ($numUID == 1 && $numTID == 1) {
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
			if ($numUID != 1) {
				$invalidUID = "true";
			}
			if ($numTID != 1) {
				$invalidTestID = "true";
			}
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
<title>answerMe &middot; Log In</title>
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
    	<form class="form-signin" method="POST" action="login.php" id="loginform">
	        <h1 style="font-weight: bolder"> AnswerMe </h1>
	        <input class="input-block-level" id="loginId" placeholder="Login ID" type="text" name="loginid">
	        <input class="input-block-level" id="testid" placeholder="Test ID" type="text" name="testid">
	        <input class="input-block-level" id="pass" placeholder="Password" type="password" name="password">
	        <button class="btn btn-block btn-primary" type="button" id="starttest">Take Test</button>
	        <br />
	        <a href="#signupModal" role="button" data-toggle="modal">Dont have a Login ID yet?</a>
	    </form>

		<!-- Modal -->
		<div id="signupModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				<div id="mesg">
		    	</div>
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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
<script data-main="../js/loginMain" src="../js/lib/require.js"> </script>
<script type="text/javascript">
	var rAlert = <?php echo $invalidUID ?>;
	var invalTID = <?php echo $invalidTestID ?>;
</script>
</body>
</html>
<!--
<script src="../js/lib/jquery1.10.js"></script>
<script src="../js/lib/bootstrap.min.js"></script>
<script src="../js/usernameajax.js"></script>
<script src="../js/login.js"></script>
<script type="text/javascript">
var rAlert = <?php echo $invalidUID ?>;
var invalTID = <?php echo $invalidTestID ?>;
if (rAlert) {
	$("#errmesg").html('<div class="alert alert-block alert-error fade in"> Invalid Username-Pasword combination! </div>');
}
if (invalTID) {
	$("#errmesg").append('<div class="alert alert-block alert-error fade in"> Invalid Test ID </div>');	
};
</script>
-->