<?php

require_once('../core/init.php');

$username = $_POST['username'];
$password = $_POST['password'];
$reset = ($_POST['reset'] != null)? true : false;

if ($reset && $user_id = $db->userExists($username)) {
	$user = new User($db, $user_id);
	$user->generatePasswordResetKey();
	$session->flash("Password reset link sent to your email");
	$session->logout();
} else {
	if ($session->login($username, $password)) {
		$session->flash("Welcome, $username");
		header("Location: ".WEBROOT);
		exit();
	} else {
		$session->flash("Invalid username or password");
	}
}

header("Location: ".WEBROOT."login");

?>