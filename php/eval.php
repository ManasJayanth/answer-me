<?php
session_start();
session_destroy();
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
        	<h2> Times Up!</h2>
        	<p> Your answer has been submitted and is under evaluation </p>
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