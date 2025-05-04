<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = validate_email($_POST['email'] ?? '');

	if (isset($_SESSION['user_id'])) {
		$_SESSION['email_is_correct'] = check_user_email($_SESSION['user_id'], $email);
	} else {
		$_SESSION['email_is_correct'] = false;
	}
}
