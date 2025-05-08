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
		$mail->SMTPDebug = 0; // Set to 0 for production, 2 for debugging

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
		$mail->Subject = "Password Reset Request - DigitalDash Account";
		$mail->Body = "
		<div style='font-family: Arial, sans-serif; color: #333;'>
			<p>Dear User,</p>
			<p>We have received a request to reset the password for your DigitalDash account. To proceed with this request, please click the secure link below:</p>
			<p style='margin: 25px 0;'>
				<a href='$reset_link' style='background-color: #2dc489; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block;'>Reset Your Password</a>
			</p>
			<p><strong>Important:</strong> If you did not initiate this request, please disregard this email. Your account security remains intact.</p>
			<p style='margin-top: 20px;'>
			Best regards,
			<br>
			<strong>DigitalDash Support Team</strong>
			</p>
			<hr style='border: none; border-top: 1px solid #eee; margin: 20px 0;'>
			<p style='color: #666; font-size: 12px;'>This is an automated message. Please do not reply to this email.</p>
			</div>";
		$mail->AltBody = "A password reset was requested for your DigitalDash account. To reset your password, please visit: $reset_link\n\nIf you did not request this change, please ignore this email.\n\nBest regards,\nThe DigitalDash Team";

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
