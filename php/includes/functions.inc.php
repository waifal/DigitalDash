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

/**
 * Checks if an input is empty and returns a JSON-encoded error response if so.
 *
 * @param string|null $input User input to validate.
 * @param string|null $message Error message if input is empty.
 *
 * @return string|null JSON error response or null if input is valid.
 */

function is_input_empty(?string $input, ?string $message): string|null {
	$errorResponse = ["status" => "error", "messages" => []];

	if (empty($input)) {
		$errorResponse["messages"][] = $message;
	}

	return !empty($errorResponse["messages"]) ? json_encode($errorResponse, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null;
}

/**
 * Validates user input and returns error messages if any validation fails.
 *
 * @param string $firstname The user's first name.
 * @param string $lastname The user's last name.
 * @param string $email The user's email address.
 * @param string $password The user's password.
 * @param string $pwd_confirm The password confirmation.
 * @param bool $terms_and_conditions Whether the user agreed to the terms and conditions.
 * @param bool $privacy_policy Whether the user accepted the privacy policy.
 *
 * @return string|bool JSON-encoded error response if validation fails, or true if input is valid.
 */

function validate_user_input(
	string $firstname,
	string $lastname,
	string $email,
	string $password,
	string $pwd_confirm,
	bool $terms_and_conditions,
	bool $privacy_policy
): string|bool {


	if (empty($firstname)) {
		$errorResponse["messages"][] = "Please enter your first name.";
	}

	if (empty($lastname)) {
		$errorResponse["messages"][] = "Please enter your last name.";
	}

	if (empty($email)) {
		$errorResponse["messages"][] = "Please enter your email address.";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errorResponse["messages"][] = "Invalid email format.";
	}

	if (empty($password)) {
		$errorResponse["messages"][] = "Please enter your password.";
	} elseif ($pwd_confirm !== $password) {
		$errorResponse["messages"][] = "Passwords do not match.";
	} elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
		$errorResponse["messages"][] = "Password must be at least 8 characters long and include letters, numbers, and special characters.";
	}

	if (!$terms_and_conditions) {
		$errorResponse["messages"][] = "You must agree to the terms and conditions.";
	}

	if (!$privacy_policy) {
		$errorResponse["messages"][] = "You must accept the privacy policy.";
	}

	return true;
}
