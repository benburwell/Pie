<?php

/*

	Initialization
	---------------

	@file 		init.php
	@version 	1.0.0b
	@date 		2012-03-28 12:36:38 -0400 (Wed, 28 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

*/


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