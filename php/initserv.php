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
?>