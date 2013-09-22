<?php
include("serverspecific.php");
$testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
$testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$sql = "select COUNT(*) from questions";
$pstatement = $testh->prepare($sql);
$success = $pstatement->execute();
$num = $pstatement->fetchColumn();

$sql = "select * from questions";
$pstatement = $testh->prepare($sql);
$success = $pstatement->execute();
$result = $pstatement->fetchAll();
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
<link href="../css/mycsslib.css" rel="stylesheet" media="screen">
<script type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../createtest.html">Create Test</a></li>
                    <li class="active"><a href="#">View Database</a></li>
                    <li><a href="../php/taketest.php">Take Test</a></li>
                </ul>
                </ul>
            </div>
        </div>
        <div id="details">
        <table class="table table-bordered table-striped table-condensed table-hover">
            <caption> </caption>
            <thead>
                <tr>
                    <th> Qid </th>
                    <th> Question </th>
                    <th> No. of choices </th>
                    <th> Correct Choice </th>
                </tr>
                </thead>
            <tbody>
                <?php
                    $i=0;
                    while ($i < $num) {
                ?>
                <tr>
                    <td> 
                        <?php echo $result[$i]['qno']; ?> 
                    </td>
                    <td> 
                        <?php echo $result[$i]['qtext']; ?> 
                    </td>
                    <td> 
                        <?php echo $result[$i]['nchoices']; ?> 
                    </td>
                    <td> 
                        <?php echo $result[$i]['answer']; ?> 
                    </td>
                </tr>
                
                <?php
                    $i++;
                    }
                ?>
            </tbody>
        </table>
        </div>
        <hr>
        <footer>
            <span class="pull-right"><a href="../index.php">Back Home</a></span>
            <span>© 2013 answerMe </span>
        </footer>
    </div>
<script data-main="../js/viewdbMain" src="../js/lib/require.js"></script>
</body>
</html>