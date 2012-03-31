<?php

/*

	Page Assembler
	---------------

	@file 		assembler.php
	@version 	1.0.0b
	@date 		2012-03-28 13:15:38 -0400 (Wed, 28 Mar 2012)
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

// start timer
$time_start = microtime(true);

require_once('../core/init.php');

$page = new Page($db);

// create local vars
$model = $_GET['model'];																								$page->log("model=$model");
$id = $_GET['id'];																										$page->log("id=$id");
$create = ($_GET['create']==1)? true : false;																			$page->log("create=$create");
$update = ($_GET['update']==1)? true : false;																			$page->log("update=$update");

// set defaults
$page->setHeaderFile(ROOT.'view/_default/header.php');																	$page->log("header set to default");
$page->setFooterFile(ROOT.'view/_default/footer.php');																	$page->log("footer set to default");
$page->setContentFile(ROOT.'view/home.php');																			$page->log("content set to home");

if (isset($model) && !$db->modelExists($model)) {
	$page->setError(ERROR_NOMODEL);																						$page->log("no model '$model'");
} else {
	if ($model != "") {
		$page->setModel($model);																						$page->log("page model set to '$model'");
		$page->setContentFile(ROOT.'view/_default/default.php');														$page->log("content set to default/default");
	}
}

// override default header and footer if applicable
if (file_exists(ROOT.'view/'.$model.'/header.php')) { $page->setHeaderFile(ROOT.'view/'.$model.'/header.php');			$page->log("header set to custom"); }
if (file_exists(ROOT.'view/'.$model.'/footer.php')) { $page->setFooterFile(ROOT.'view/'.$model.'/footer.php');			$page->log("footer set to custom"); }


if (is_numeric($id)) {																									$page->log("id is numeric");
	
	$page->setRecordId($id);
	
	// should custom view be used?
	if (file_exists(ROOT.'view/'.$model.'/record.php')) {
		$page->setContentFile(ROOT.'view/'.$model.'/record.php');														$page->log("content set to custom/record");
	} else {
		$page->setContentFile(ROOT.'view/_default/record.php');															$page->log("content set to default/record");
	}
	
	
} else {																												$page->log("id not numeric");
	
	// no id has been specified, use default view
	if (file_exists(ROOT.'view/'.$model.'/default.php')) { $page->setContentFile(ROOT.'view/'.$model.'/default.php');	$page->log("content set to custom/default"); }
}

if ($create) {																											$page->log("page is create");
	if (file_exists(ROOT.'view/'.$model.'/create.php')) {
		$page->setContentFile(ROOT.'view/'.$model.'/create.php');														$page->log("content set to custom/create");
	} else {
		$page->setContentFile(ROOT.'view/_default/create.php');															$page->log("content set to default/create");
	}
}

if ($update) {
	if (file_exists(ROOT.'view/'.$model.'/update.php')) {																$page->log("page is update");
		$page->setContentFile(ROOT.'view/'.$model.'/update.php');														$page->log("content set to custom/update");
	} else {
		$page->setContentFile(ROOT.'view/_default/update.php');															$page->log("content set to default/update");
	}
}

																														$page->log("query count ".$db->getQueryCount());
$time_end = microtime(true);
$time = $time_end - $time_start;																						$page->log("page generated in ".$time);
																														$page->log("writing page . . .");
// write page
$page->write();

?>