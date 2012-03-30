<?php

/*

	Page Assembler
	---------------

	@file 		assembler.php
	@version 	1.0.0b
	@date 		2012-03-28 13:15:38 -0400 (Wed, 28 Mar 2012)
	@author 	Ben Burwell <bburwell1@gmail.com>

	Copyright (c) 2012 Ben Burwell <http://www.benburwell.com/>

*/

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