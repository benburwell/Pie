<?php

/*

	Initialization
	---------------

	@file 		init.php
	@version 	1.0.0b
	@date 		2012-03-28 12:36:38 -0400 (Wed, 28 Mar 2012)
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

// bring in all required classes
require_once('classes/database.class.php');
require_once('classes/page.class.php');
require_once('classes/settings.class.php');
require_once('classes/user.class.php');

// bring in functions
require_once('functions.php');

// database settings
require_once('db.php');

// site settings
$settings = new Settings();

// database initialization
$db = new Database();

// session initialization
session_start();

?>