<?php

require_once(__DIR__ . '/includes/functions.inc.php');
require_once(__DIR__ . '/send_reset_email.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = validate_email($_POST['email'] ?? '');

	if (send_reset_link($email)) {
		ob_start();
		sendResetEmail($email, $_SESSION['token']);
		ob_end_clean();
		header('Location: ../public/php/pages/reset-password.php?success=email_sent');
		exit;
	} else {
		header('Location: ../public/php/pages/reset-password.php?error=invalid_email');
		exit;
	}
}
