    <?php ?>
    <html lang="en">
    <html>
    <head>
    <title>answerMe &middot; Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/mycss.css" rel="stylesheet" media="screen">
    <link href="css/mycsslib.css" rel="stylesheet" media="screen">
    <script type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <div class="navbar-inner">
                    <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    </ul>
                </div>
            </div>
            <form id="question" method="post" action="php/getquestion.php" enctype='multipart/form-data'>
                <legend>
                Question
                </legend>
                <label>Text</label>
                <textarea class="input-block-level" rows="4" placeholder="Enter your question here..." name="question"> </textarea>
                <label>Image?</label>
                <label class="radio inline">
                <input id="imgyes" type="radio" name="img" value="yes">
                <span class="radioOptions">Yes</span>
                </label>
                <label class="radio inline">
                <input id="imgno" type="radio" name="img" value="no" checked>
                <span class="radioOptions">No</span>
                </label>
                <div id="imgsource">
                    
<!-- <div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
<div>
<span class="btn btn-file">
    <span class="fileupload-new">Select image</span>
    <span class="fileupload-exists">Change</span>
    <input type="file" />
</span>
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div> -->


                </div>
                <label>Number of options
                <span>
                    <select class="span1 btn" name="nChoices" id="noQ">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    </select>
                </span>
                </label>
                <div id="choices">
                    <label>Choice 1</label>
                    <textarea class="input-block-level" rows="4" placeholder="Enter your choice here..." name="C1"> </textarea>
                </div>
                <div id="answer-label"></div>
            </form>
            <hr> 
            <footer>
                <span class="pull-right"><a href="index.php">Back Home</a></span>
                <span>© 2013 answerMe </span>
            </footer>
        </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/myscripts.js"></script>
    </body>
    </html>