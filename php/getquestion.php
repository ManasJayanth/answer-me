<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
?>
<!DOCTYPE html><html>
<head>
<title>Question addition · answerMe</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/mycss.css" rel="stylesheet" media="screen">
<link href="../css/mycsslib.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                <li><a href="../index.php">Home</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                </ul>
            </div>
        </div>
		<div id="box">
		<h1>Stop!</h1>
		<p>You have tried to navigate to this page directly. Click on Home</p>
		</div>
		<br/>
		<hr class="featurette-divider">
		<footer>
	        <span class="pull-right"><a href="../index.php">Back Home</a></span>
	        <span>© 2013 answerMe </span>
	    </footer>
	</div>
</body>
</html>
?>
<?php exit();
}
//----------------------- Processing the POST request --------------------------------------- //
$question = $_POST["question"];
$noChoices = $_POST["nChoices"];
$choices = array('1' => '','2' => '','3' => '','4' => '','5' => '','6' => '');
for($i = 1; $i <= $noChoices; ++$i) {
	$choices[$i] = $_POST["C".$i];
}

$answer = $_POST["correctAnswer"];

$database = "answerMe"; 
$server = "127.0.0.1";
$db_user = "root";
$db_pass = "mysqlmypass";

try {
  $testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
  $testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $sql = "select COUNT(*) from questions";
  $pstatement = $testh->prepare($sql);
  $success = $pstatement->execute();
  $num = $pstatement->fetchColumn();
  $num++;
  $sql = "insert into questions values (:qno,:question,:nChoices,:answer)";
  $pstatement = $testh->prepare($sql);
  $success = $pstatement->execute(array(':qno' => $num,':question' => $question,':nChoices' => $noChoices, ':answer' => $answer));
  for($i = 1; $i <= $noChoices; ++$i) {
  	$sql = "insert into choices values (:qno,:cno,:choice)";
  	$pstatement = $testh->prepare($sql);
  	$param = array(':qno' => $num, ':cno' => $i, ':choice' => $choices[$i]);
  	$success = $pstatement->execute($param);
  }
}
catch(PDOException $e)
{
  echo "Following error was encountered <br />";
  echo $e->getMessage();
}
?>
<!DOCTYPE html><html>
<head>
<title>Question addition · answerMe</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/mycss.css" rel="stylesheet" media="screen">
<link href="../css/mycsslib.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                <li><a href="../index.php">Home</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                </ul>
            </div>
        </div>
		<div id="box">
		<h1>Question added</h1>
		<p>Your question has been successfully added to the database.</p>
		</div>
		<br/>
		<hr class="featurette-divider">
		<footer>
	        <span class="pull-right"><a href="../index.php">Back Home</a></span>
	        <span>© 2013 answerMe </span>
	    </footer>
	</div>
</body>
</html>