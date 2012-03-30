<?php

/*

	Site-wide functions
	--------------------

	@file 		functions.php
	@version 	1.0.0b
	@date 		2012-03-29 23:04:16 -0400 (Thu, 29 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

*/

function goToReferer() {
	$referer = $_SERVER['HTTP_REFERER'];
	
	if ($referer != "") {
		header("Location: $referer");
	} else {
		header("Location: ".APP_ROOT);
	}
	
	exit();
}

?>