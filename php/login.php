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
	    </form>
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
<script type="text/javascript">
var rAlert = <?php echo $raiseAlert ?>;
if (rAlert) {
	$("#errmesg").append('<div class="alert alert-block alert-error fade in"> Invalid Pasword! </div>');
};
</script>
</body>
</html>