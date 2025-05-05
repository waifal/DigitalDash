<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

define("SMTP_USERNAME", "teswize1@gmail.com");  // Use .env file
define("SMTP_PASSWORD", "janq ldpn guyx bujs"); // Use .env file
define("SMTP_HOST", "smtp.gmail.com");
define("SMTP_PORT", 465);

function sendResetEmail($email, $token) {
	$mail = new PHPMailer(true);
	$reset_link = "http://localhost/projects/DigitalDash/public/php/pages/reset-password.php?token=$token"; // Change URL on deployment

	try {
		$mail->SMTPDebug = 2; // Set to 0 for production, 2 for debugging

		$mail->CharSet = "UTF-8";
		$mail->isSMTP();
		$mail->Host       = SMTP_HOST;
		$mail->SMTPAuth   = true;
		$mail->Username   = SMTP_USERNAME;
		$mail->Password   = SMTP_PASSWORD;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = SMTP_PORT;

		$mail->setFrom("no-reply@digitaldash.com", "DigitalDash");
		$mail->addAddress($email);

		$mail->isHTML(true);
		$mail->Subject = "Password Reset";
		$mail->Body = "
		<p>Dear User,</p>
		<p>We received a request to reset your password. If this was you, please click the link below to proceed:</p>
		<p>
			<a href='$reset_link' style='color:#0d6efd; font-weight:bold; text-decoration-line: underline;'>Reset Password</a>
		</p>
		<p>If you did not request this change, you can safely ignore this email. Your account will remain secure.</p>
		<br>
		<p>Best regards,</p>
		<p><strong>DigitalDash Support Team</strong></p>";
		$mail->AltBody = "Click this link to reset your password: $reset_link";

		if ($mail->send()) {
			error_log("Email sent successfully to $email");
			return true;
		} else {
			error_log("Mailer Error: " . $mail->ErrorInfo);
			return false;
		}
	} catch (Exception $e) {
		error_log("Exception: " . $e->getMessage());
		return false;
	}
}
