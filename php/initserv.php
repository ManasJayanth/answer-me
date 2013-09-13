<?php
function createDir($name) {
	@include('serverspecific.php');
	if(!file_exists($parentDir) || !is_dir($parentDir)) { // Check if the parent directory is a directory
	    die('Invalid path specified');
	}

	 if(!is_writable($parentDir)) { // Check if the parent directory is writeable
	     die('Unable to create directory, permissions denied.');
	 }

	if(mkdir($parentDir . $name,0766) === false) { // Create the directory
	    die('Problems creating directory. Maybe It already exists');
	}
	print('Directory ' . $name . ' created directory successfully'); // Success point
}

createDir('Qimgs');

require_once('serverspecific.php');
$testh = new PDO ("mysql:host=$server;dbname=$database", $db_user, $db_pass);
$testh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$testh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$sql = "create table questions(	qno int primary key,	qtext varchar(1000) not null,	nchoices int not null,	answer int);";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "QUESTIONS table created <br />";

$sql = "create table choices(	qno int,	cno int,	foreign key(qno) references questions(qno),	choice varchar(100) not null);";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "CHOICES table created. <br />";

$sql = "create table qImgs(	qno int,	foreign key(qno) references questions(qno),	imgname varchar(100));";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "QIMGS table created. <br />";

$sql = "create table test(	testid int primary key AUTO_INCREMENT,	testname varchar(50),	questions varchar(100),	testnos int,	timelimit int,	negmarking boolean);";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "TEST table created. <br />";

$sql = "create table student (	loginid varchar(10) primary key,	name varchar(50),	password varchar(32));";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "STUDENT table created. <br />";

$sql = "create table marks(	loginid varchar(10),	testid int,	marks int);";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "MARKS table created. <br />";

$sql = "create table answer(	loginid varchar(10),	testid int,	response varchar(500));";
$pstatement = $testh->prepare($sql);
try {
	$success = $pstatement->execute();
} catch (PDOException $e) {
	echo "Following error was encountered <br />";
	echo $e->getMessage();die();
}
echo "ANSWER table created. <br />";
?>