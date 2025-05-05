<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$new_password = validate_password($_POST['new_password'] ?? '');
	$pwd_confirm = $_POST['pwd_confirm'] ?? '';

	if (!isset($_SESSION['user_id']) || !isset($_SESSION['token'])) {
		die("Unauthorized request.");
	}

	$result = reset_password($_SESSION['user_id'], $_SESSION['token'], $new_password, $pwd_confirm);

	if ($result === true) {
		$_SESSION['password_reset'] = true;
		header('Location: ../public/php/pages/login.php?password=success');
		exit;
	} else {
		echo $result;
	}
}
