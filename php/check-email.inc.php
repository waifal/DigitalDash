<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = validate_email($_POST['email'] ?? '');

	var_dump($email);

	if (isset($_SESSION['user_id'])) {
		$_SESSION['email_is_correct'] = check_user_email($_SESSION['user_id'], $email) ?? false;

		var_dump($_SESSION['email_is_correct']);

		if (!$_SESSION['email_is_correct']) {
			header('Location: ../public/php/pages/reset-password.php?error=invalid_email');
			exit;
		}

		header('Location: ../public/php/pages/reset-password.php');
		exit;
	} else {
		$_SESSION['email_is_correct'] = false;
		header('Location: ../public/php/pages/reset-password.php?error=invalid_email');
		exit;
	}
}
