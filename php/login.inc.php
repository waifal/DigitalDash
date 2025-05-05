<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';

	$result = login_user($email, $password);

	if ($result === true) {
		header("Location: ../public/php/index.php");
		exit;
	} else {
		die($result);
	}
}
