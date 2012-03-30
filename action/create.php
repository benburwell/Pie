<?php

/*

	Default record creation template
	---------------------------------

	@file 		create.php
	@version 	1.0.0b
	@date 		2012-03-29 23:02:52 -0400 (Thu, 29 Mar 2012)
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