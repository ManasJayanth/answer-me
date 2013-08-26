<?php 
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header ("Location: login.php");
}
require_once('serverspecific.php');
$testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
$testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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
/********* Retrieving Questions *******/
$result = array();
$timelimit = 4;
for ($i=1; $i <= 10; $i++) { 
    $result[$i]['q'] = "Question " . $i;
    $result[$i]['c1'] = 'Food ,Travel &amp; Photography';
    $result[$i]['c2'] = 'Marketing';
    $result[$i]['c3'] = 'Content Writing';
    $result[$i]['c4'] = 'Meeting and communicating with new people';
}
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
<script type="text/javascript">
</script>
</head>
<body>
    <div class="container">
    <h1> Welcome <?php echo $name; ?><button type="button" class="btn btn-primary pull-right" data-loading-text="Submitting...">Submit Answer</button> </h1>
    <div class="container" id="containerId">
      <div id="clock">
        <div id="text"> Time left </div>
        <div id="time">--</div>
      </div>
      <form class="form-signin" id="test" action="collectdoublebass.php" method="post">
        <?php
        $i = 1;
        while($i <= 10) {
        ?>

        <hr>
        <label> <?php echo $result[$i]['q']; ?> </label>
        <label class="radio radioOptions">
        <input type="radio" name="Q1" value="1" checked>
        <?php echo $result[$i]['c1']; ?>
        </label>
        <label class="radio radioOptions">
        <input type="radio" name="Q1" value="2">
        <?php echo $result[$i]['c2']; ?>
        </label>
        <label class="radio radioOptions">
        <input type="radio" name="Q1" value="3">
        <?php echo $result[$i]['c3']; ?>
        </label>
        <label class="radio radioOptions">
        <input type="radio" name="Q1" value="4">
        <?php echo $result[$i]['c4']; ?>
        </label>

        <?php
        ++$i;
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
var sec = <?php echo $timelimit; ?>;
</script>
<script src="../js/taketest.js"></script>
</body>
</html>