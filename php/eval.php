<?php
$h = '';
$p = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();
    $loginid = $_SESSION['loginid'];
    $testid = $_SESSION['testid'];
    session_destroy();
    $response = array();
    /*** Retrieving Test Details*/
    require_once('serverspecific.php');
    $testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
    $testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $h = 'Done!';
    $p = 'Your answers have been submitted. <br /> You scored ';
    $sql = "SELECT * FROM test WHERE testid = :testid";
    $pstatement = $testh->prepare($sql);
    $result = "";
    try {
        $success = $pstatement->execute(array(':testid' => $_SESSION['testid']));
        $test = $pstatement->fetchAll();
    } catch (PDOException $e) {
        echo "Following error was encountered <br />";
        echo $e->getMessage();
    }
    $Qs = explode(";", $test[0]['questions']);

    //// Responses
    $noQuestions = sizeof($Qs);
    $negmark = $test[0]['negmarking'];
    $responses = array();
    $answers = array();
    for ($i=0; $i < $noQuestions; $i++) { 
        $responses[$i] = $_POST['Q'.$i];
    }
    /// Incrementing
    for ($i=0; $i < $noQuestions; $i++) { 
        $responses[$i]++;
    }
    // Storing the responses
    $sql = "INSERT INTO answer VALUES (:loginid, :testid, :response)";
    $pstatement = $testh->prepare($sql);
    $result = "";
    try {
        $success = $pstatement->execute(array(':loginid' => $loginid, ':testid' => $testid, ':response' => implode(":", $responses)));
    } catch (PDOException $e) {
        echo "Following error was encountered <br />";
        echo $e->getMessage();
    }

    $sql = "SELECT * FROM questions WHERE qno = :qno";
    for ($i=0; $i < $noQuestions; $i++) { 
        $pstatement = $testh->prepare($sql);
        $result = "";
        try {
            $success = $pstatement->execute(array(':qno' => $Qs[$i]));
            $test = $pstatement->fetchAll();
        } catch (PDOException $e) {
            echo "Following error was encountered <br />";
            echo $e->getMessage();
        }
        $answers[$i] = $test[0]['answer'];
    }

    ////Evaluation
    $marks = 0;
    $AWARDED = 2;
    $PENALISED = 1;
    for ($i=0; $i < $noQuestions; $i++) {
        if ($responses[$i] == "*") {
             
        } 
        else if ($responses[$i] == $answers[$i]) {
            $marks += $AWARDED;
        }
        else {
            $marks -= $PENALISED;
        }
    }
    $p .= $marks . " marks";

    // Storing the marks
    $sql = "INSERT INTO marks VALUES (:loginid, :testid, :marks)";
    $pstatement = $testh->prepare($sql);
    $result = "";
    try {
        $success = $pstatement->execute(array(':loginid' => $loginid, ':testid' => $testid, ':marks' => $marks));
    } catch (PDOException $e) {
        echo "Following error was encountered <br />";
        echo $e->getMessage();
    }
}
else
{
    $h = 'Sorry!';
    $p = 'You tried to acccess this page directly (not supposed to do that)';
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
<link href="../css/mycss.css" rel="stylesheet" media="screen">
<link href="../css/eval.css" rel="stylesheet" media="screen">
<script type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../createtest.html">Create Test</a></li>
                    <li><a href="viewdb.php">View Database</a></li>
                    <li class="active"><a href="taketest.php">Take Test</a></li>
                </ul>
                </ul>
            </div>
        </div>
        <div class="box">
        	<h2> <?php echo $h;?></h2>
        	<p> <?php echo $p; ?> </p>
        </div>
        <hr>
        <footer>
            <span class="pull-right"><a href="../index.php">Back Home</a></span>
            <span>© 2013 answerMe </span>
        </footer>
    </div>
<script src="../js/jquery-1.6.2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/ajax.js"></script>
<script src="../js/createtest.js"></script>
</body>
</html>