<?php 
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header ("Location: login.php");
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
<link href="../css/taketest.css" rel="stylesheet" media="screen">
<link href="../css/mycsslib.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="container" id="containerId">
<?php
require_once('serverspecific.php');
$testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
$testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
if (!($_COOKIE['tid'] == $_SESSION['testid'] && $_COOKIE['loginid'] == $_SESSION['loginid'])) {
    /********* Retrieving Questions *******/
    $sql = "SELECT name FROM student WHERE loginid = :loginid";
    $pstatement = $testh->prepare($sql);
    $name = "";
    try {
        $success = $pstatement->execute(array(':loginid' => $_SESSION['loginid']));
        $name = $pstatement->fetchColumn();
    } catch (PDOException $e) {
        echo "Following error was encountered <br />";
        echo $e->getMessage();
    }

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
?>
        <div id="heading">
            <h1> Welcome <?php echo $name; ?><button id="done" type="button" class="btn btn-primary pull-right" data-loading-text="Submitting...">Submit Answer</button> </h1>
        </div>
        <div id="clock">
        <div id="text"> Time left </div>
        <div id="time">--</div>
        </div>
        <form class="form-signin" id="test" action="eval.php" method="post">
        <?php
            try {
                for ($j=0; $j < sizeof($Qs); $j++) { 
                    $sql = "SELECT * FROM questions WHERE qno = :qno";
                    $pstatement = $testh->prepare($sql);
                    $success = $pstatement->execute(array(':qno' => $Qs[$j]));
                    $result = $pstatement->fetchAll();
        ?>
        <hr>
        <label>
        <?php
                    echo $result[0]['qtext'];
        ?>
        </label>
        <?php
                    /********** Checking for Images ******************/
                    $sql = "SELECT * FROM qImgs WHERE qno = :qno";
                    $pstatement = $testh->prepare($sql);
                    try {
                            $success = $pstatement->execute(array(':qno' => $Qs[$j]));
                            $img = $pstatement->fetchAll();
                    } catch (PDOException $e) {
                        echo "Following error was encountered <br />";
                        echo $e->getMessage();
                    }
                    for ($k=0; $k < sizeof($img); $k++) { 
        ?>
        <div id="img">
            <img class="img-polaroid" src= " <?php echo '../' . $img[$k]['imgname']; ?>" height="200" width="200"/>
        </div>
        <?php
                    }
                    /********** Retrieving all the choices ****************/
                    $sql = "SELECT * FROM choices WHERE qno = :qno";
                    $pstatement = $testh->prepare($sql);
                    try {
                            $success = $pstatement->execute(array(':qno' => $Qs[$j]));
                            $choices = $pstatement->fetchAll();
                    } catch (PDOException $e) {
                        echo "Following error was encountered <br />";
                        echo $e->getMessage();
                    }
                    for ($k=0; $k < sizeof($choices); $k++) { 
        ?>
        <label class="radio radioOptions">
        <input type="radio" name="Q<?php echo $j;?>" value="<?php echo $k; ?>">
        <?php 
                        echo $choices[$k]['choice']; 
        ?>
        </label>
        <?php
                    }
        ?>
        <input style='visibility: hidden' type='radio' name='Q<?php echo $j;?>' value='*' checked>
        <?php
                }
            } catch (PDOException $e) {
                echo "Following error was encountered <br />";
                echo $e->getMessage();
            }
        ?>
        <hr>
        <footer>
            <span class="pull-right"><a href="../index.php">Back Home</a></span>
            <span>© 2013 answerMe </span>
        </footer>
    </div>
<script src="../js/jquery1.10.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
var sec = <?php echo $test[0]['timelimit']; ?> * 60;
var tid = <?php echo $test[0]['testid']; ?>;
var logid = <?php echo $_SESSION['loginid']; ?>;

var qs = <?php echo sizeof($Qs) ?>;
</script>
<script src="../js/taketest.js"></script>
<?php
}
else
{
    session_destroy();
?>
         <div class="navbar">
                <div class="navbar-inner">
                    <ul class="nav">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../createtest.html">Create Test</a></li>
                        <li><a href="viewdb.php">View Database</a></li>
                        <li><a href="taketest.php">Take Test</a></li>
                    </ul>
                </div>
        </div>
        <div class="box">
            <h2> Invalid Attempt!</h2>
            <p> You have already attempted the test </p>
        </div>
        <hr>
        <footer>
            <span class="pull-right"><a href="../index.php">Back Home</a></span>
            <span>© 2013 answerMe </span>
        </footer>
    </div>
<?php
}
?>
</body>
</html>