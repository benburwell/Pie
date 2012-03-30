<?php

/*

	Default record creation template
	---------------------------------

	@file 		create.php
	@version 	1.0.0b
	@date 		2012-03-29 23:02:52 -0400 (Thu, 29 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

*/

require_once('../core/init.php');

$model = $_POST['_model'];

// quit if no model provided
if (!$db->modelExists($model)) goToReferer();

$params = array();

foreach ($_POST as $key => $value) {
	if ($key != '_model') {
		$params[$key] = $value;
	}
}

$db->create($model, $params);

goToReferer();

?>