<?php

require_once('../core/init.php');

$session->logout();

header('Location: '.WEBROOT);

?>