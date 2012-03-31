<?php

/*

	Initialization
	---------------

	@file 		init.php
	@version 	1.0.0b
	@date 		2012-03-30 16:14:38 -0400 (Fri, 30 Mar 2012)
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

define('PIE_VERSION', '0.1a');

// bring in all required classes
require_once('classes/database.class.php');
require_once('classes/page.class.php');
require_once('classes/user.class.php');
require_once('classes/session.class.php');

// database settings
require_once('db.php');

// database initialization
$db = new Database();

// bring in functions
require_once('functions.php');

// session initialization
session_start();
$session = new Session($db);

?>