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

require_once('../core/init.php');

$page = new Page();

$name = $_GET['model'];
$id = $_GET['id'];

$page->setHeaderFile('_default/header.php');
$page->setFooterFile('_default/footer.php');

if (file_exists($name.'/header.php')) $page->setHeaderFile($name.'/header.php');
if (file_exists($name.'/footer.php')) $page->setFooterFile($name.'/footer.php');


if ($id != null) {
	$page->setContentFile('_default/record.php');
	if (file_exists($name.'/record.php')) $page->setContentFile($name.'/record.php');
} else {
	$page->setContentFile('_default/default.php');
	if (file_exists($name.'/default.php')) $page->setContentFile($name.'/default.php');
}

$page->write();

?>