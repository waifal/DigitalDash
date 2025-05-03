<?php

require_once(__DIR__ . '/connection.inc.php');

/**
 * Sanitizes and cleans user input, allowing only letters, spaces, apostrophes, and hyphens.
 *
 * @param string|null $userInput The input string to sanitize.
 * @return string|null The sanitized string or null if input is empty.
 */


function validate_user(?string $userInput): ?string {
	if ($userInput === null) {
		return null;
	}

	$sanitizedInput = preg_replace('/[^a-zA-Z\' -]/', '', trim($userInput));

	return stripslashes(trim(htmlspecialchars($sanitizedInput, ENT_QUOTES, 'UTF-8')));
}

/**
 * Sanitizes and validates an email address, ensuring it has a valid format and domain.
 *
 * @param string|null $email The email input to validate.
 * @return string|null The sanitized and verified email, or null if invalid.
 */


function validate_email(?string $email): ?string {
	if ($email === null) {
		return null;
	}

	$sanitizedEmail = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
	$validatedEmail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);

	if ($validatedEmail && checkdnsrr(substr(strrchr($validatedEmail, "@"), 1), "MX")) {
		return $validatedEmail;
	}

	return null;
}

/**
 * Validates a password based on security requirements.
 *
 * Password must be at least 8 characters long and include:
 * - At least one letter
 * - At least one number
 * - At least one special character (@$!%*?&)
 *
 * @param string|null $password The password to validate.
 * @return string|null Valid password or null if invalid.
 */

function validate_password(?string $password): ?string {
	if ($password === null) {
		return null;
	}

	$isValidPassword = preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);

	return $isValidPassword ? $password : null;
}

/**
 * Validates whether a checkbox has been checked in the submitted form.
 *
 * This function checks if a specified checkbox exists in the $_POST array
 * and verifies if its value matches "agree".
 *
 * @param string $checkboxName The name attribute of the checkbox input field.
 * @return bool Returns true if the checkbox is checked and its value is "agree", otherwise false.
 */

function validate_checkbox($checkboxName) {
	return isset($_POST[$checkboxName]) && strtolower($_POST[$checkboxName]) === "agree";
}

function error_response(array $messages): string {
	return json_encode(["status" => "error", "messages" => $messages]);
}

function is_input_empty(?string $input, string $message): ?string {
	return empty($input) ? $message : null;
}

function is_email_invalid(?string $email, string $message): ?string {
	return !filter_var($email, FILTER_VALIDATE_EMAIL) ? $message : null;
}

function is_valid_email_domain(string $email, string $message): ?string {
	$domain = strtolower(trim(substr(strrchr($email, "@"), 1)));
	return (!$domain || !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) ? $message : null;
}

function does_password_match(string $password, string $pwd_confirm, string $message): ?string {
	return $pwd_confirm !== $password ? $message : null;
}

function validate_user_input(
	?string $firstname,
	?string $lastname,
	?string $email,
	?string $password,
	?string $pwd_confirm,
	bool $terms_and_conditions,
	bool $privacy_policy
): void {

	$errors = [];

	// Handle Empty Inputs
	if ($error = is_input_empty($firstname, "Please enter your first name")) $errors[] = $error;
	if ($error = is_input_empty($lastname, "Please enter your last name")) $errors[] = $error;
	if ($error = is_input_empty($email, "Please enter your email address")) $errors[] = $error;
	if ($error = is_input_empty($password, "Please enter your password")) $errors[] = $error;

	// Handle Email Validation
	if ($error = is_email_invalid($email, "Please enter a valid email address")) $errors[] = $error;
	if ($error = is_valid_email_domain($email, "Please enter a valid domain name")) $errors[] = $error;

	// Handle Password Match
	if ($error = does_password_match($password, $pwd_confirm, "Passwords do not match.")) $errors[] = $error;

	if (!empty($errors)) {
		echo error_response($errors);
		exit;
	}
}
