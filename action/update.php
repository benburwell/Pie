<?php

/*

	Default record updating template
	---------------------------------

	@file 		update.php
	@version 	1.0.0b
	@date 		2012-03-29 23:02:52 -0400 (Thu, 29 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

*/

require_once('../core/init.php');

$model = $_POST['_model'];
$id = $_POST['_id'];

// quit if no model provided or id not numeric
if (!$db->modelExists($model) || !is_numeric($id)) goToReferer();

$params = array();

foreach ($_POST as $key => $value) {
	if ($key != '_model' && $key != '_id') {
		$params[$key] = $value;
	}
}

$db->update($model, $id, $params);

goToReferer();

?>