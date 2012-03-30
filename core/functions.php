<?php

/*

	Site-wide functions
	--------------------

	@file 		functions.php
	@version 	1.0.0b
	@date 		2012-03-29 23:04:16 -0400 (Thu, 29 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

*/

################################################################################
##                                                                            ##
##  Copyright 2012 Ben Burwell                                                ##
##                                                                            ##
##  Licensed under the Apache License, Version 2.0 (the "License");           ##
##  you may not use this file except in compliance with the License.          ##
##  You may obtain a copy of the License at                                   ##
##                                                                            ##
##  http://www.apache.org/licenses/LICENSE-2.0                                ##
##                                                                            ##
##  Unless required by applicable law or agreed to in writing, software       ##
##  distributed under the License is distributed on an "AS IS" BASIS,         ##
##  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.  ##
##  See the License for the specific language governing permissions and       ##
##  limitations under the License.                                            ##
##                                                                            ##
################################################################################

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