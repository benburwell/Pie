<?php

/*

	Error display page
	-------------------

	@file 		record.php
	@version 	1.0.0b
	@date 		2012-03-30 16:04:54 -0400 (Fri, 30 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

*/

$error = $this->getError();
$msg = "";

echo "<h1>Pie Error!</h1>";

switch ($error) {

	case ERROR_UNAUTHORIZED:
		$msg = "You do not have authorization to view this content.";
		break;
		
	case ERROR_NOMODEL:
		$msg = "No such object.";
		break;
	
	case ERROR_NORECORD:
		$msg = "No such record.";
		break;
	
	case ERROR_INTERNAL:
		$msg = "An internal error occurred. See the application log for more details.";
		break;
	
	case ERROR_DBERROR:
		$msg = "Database error occurred. See the application log for more details.";
		break;
	
	default:
		$msg = "Unexpected error code encountered. See the application log for more details.";
}

echo "<p>Unfortunately, Pie has encountered an error. The error code was: <code>$msg</code></p>";

?>