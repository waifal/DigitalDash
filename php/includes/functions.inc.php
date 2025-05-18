<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

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
 * Returns a JSON error response.
 *
 * @param array $messages Error messages.
 * @return string JSON-formatted error response.
 */

function error_response(array $messages): string {
	return json_encode(["status" => "error", "messages" => $messages]);
}

/**
 * Checks if the input is empty and returns an error message if true.
 *
 * @param string|null $input The input to validate.
 * @param string $message The error message to return if empty.
 * @return string|null The error message or null if input is valid.
 */

function is_input_empty(?string $input, string $message): ?string {
	return empty($input) ? $message : null;
}

/**
 * Validates the email format.
 *
 * @param string|null $email The email to validate.
 * @param string $message The error message if invalid.
 * @return string|null The error message or null if the email is valid.
 */

function is_email_invalid(?string $email, string $message): ?string {
	return !filter_var($email, FILTER_VALIDATE_EMAIL) ? $message : null;
}

/**
 * Validates the email domain by checking DNS records.
 *
 * @param string $email The email address to validate.
 * @param string $message The error message if the domain is invalid.
 * @return string|null The error message or null if the domain is valid.
 */

function is_valid_email_domain(?string $email, string $message): ?string {
	$domain = strtolower(trim(substr(strrchr($email, "@"), 1)));
	return (!$domain || !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) ? $message : null;
}

/**
 * Checks if an email is already registered in the database.
 *
 * This function queries the `tbl_user` table to determine whether
 * the provided email exists, preventing duplicate registrations.
 *
 * @param string $email The email address to check.
 * @return bool Returns true if the email is registered, false otherwise.
 */

function is_email_registered(?string $email): bool {
	global $connection;

	if (!$connection) {
		error_log("Database connection error: " . $connection->error);
		return false;
	}

	$query = "SELECT user_id FROM tbl_user WHERE email = ? LIMIT 1";
	$stmt = $connection->prepare($query);

	if (!$stmt) {
		error_log("Failed to prepare email check statement: " . $connection->error);
		return false;
	}

	$stmt->bind_param("s", $email);

	if (!$stmt->execute()) {
		error_log("Failed to execute email check statement: " . $stmt->error);
		$stmt->close();
		return false;
	}

	$stmt->store_result();
	$isRegistered = $stmt->num_rows > 0;

	$stmt->close();

	return $isRegistered;
}

/**
 * Checks if the password matches the confirmation input.
 *
 * @param string $password The original password.
 * @param string $pwd_confirm The confirmation password.
 * @param string $message The error message if passwords do not match.
 * @return string|null The error message or null if the passwords match.
 */

function does_password_match(?string $password, ?string $pwd_confirm, string $message): ?string {
	return $pwd_confirm !== $password ? $message : null;
}

function does_password_meet_criteria(?string $password, string $message): ?string {
	$isValidPassword = preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);

	return !$isValidPassword ? $message : null;
}

/**
 * Validates whether the user has agreed to the terms and conditions.
 *
 * @param bool $terms_and_conditions Whether the user accepted the terms.
 * @param string $message The error message if not accepted.
 * @return string|null The error message or null if accepted.
 */

function does_user_agree_with_terms_and_conditions(bool $terms_and_conditions, string $message): ?string {
	return $terms_and_conditions ? null : $message;
}

/**
 * Validates whether the user has accepted the privacy policy.
 *
 * @param bool $privacy_policy Whether the user agreed to the privacy policy.
 * @param string $message The error message if not accepted.
 * @return string|null The error message or null if accepted.
 */

function does_user_accept_privacy_policy(bool $privacy_policy, string $message): ?string {
	return $privacy_policy ? null : $message;
}

/**
 * Validates user input for account registration.
 *
 * Checks for empty fields, email validity, password strength and matching,
 * agreement to terms and privacy policy, and CSRF token validation.
 *
 * @param string|null $firstname User's first name.
 * @param string|null $lastname User's last name.
 * @param string|null $email User's email address.
 * @param string|null $password User's password.
 * @param string|null $pwd_confirm Confirmation of the password.
 * @param bool $terms_and_conditions Whether user agreed to terms and conditions.
 * @param bool $privacy_policy Whether user accepted the privacy policy.
 *
 * @return void Outputs JSON error response and halts execution if validation fails.
 */

function validate_user_input(
	?string $firstname,
	?string $lastname,
	?string $email,
	?string $password,
	?string $pwd_confirm,
	bool $terms_and_conditions,
	bool $privacy_policy
): void {
	if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
		$_SESSION['error'] = "Oops! Something went wrong. Please refresh and try again.";
		header('Location: ../public/signup.php');
		exit;
	}

	if ($error = is_input_empty($firstname, "Please enter your first name")) {
		$_SESSION['errors'] = ['fname' => $error];
	} elseif ($error = is_input_empty($lastname, "Please enter your last name")) {
		$_SESSION['errors'] = ['lname' => $error];
	} elseif ($error = is_input_empty($email, "Please enter your email address")) {
		$_SESSION['errors'] = ['email' => $error];
	} elseif ($error = is_email_invalid($email, "Please enter a valid email address")) {
		$_SESSION['errors'] = ['email' => $error];
	} elseif ($error = is_valid_email_domain($email, "Please enter a valid domain name")) {
		$_SESSION['errors'] = ['email' => $error];
	} elseif (is_email_registered($email)) {
		$_SESSION['errors'] = ['email' => "This email is already registered. Please use a different email."];
	} elseif ($error = is_input_empty($password, "Please enter your password")) {
		$_SESSION['errors'] = ['password' => $error];
	} elseif ($error = does_password_meet_criteria($password, "Your password must be at least 8 characters long and include a letter, a number, and a special character")) {
		$_SESSION['errors'] = ['password' => $error];
	} elseif ($error = does_password_match($password, $pwd_confirm, "Passwords do not match")) {
		$_SESSION['errors'] = ['pwd_confirm' => $error];
	} elseif (!$terms_and_conditions) {
		$_SESSION['errors'] = ['terms_and_conditions' => "You must agree to the terms and conditions"];
	} elseif (!$privacy_policy) {
		$_SESSION['errors'] = ['privacy_policy' => "You must accept our privacy policy"];
	}

	if (isset($_SESSION['errors'])) {
		$_SESSION['form_data'] = [
			'fname' => $firstname,
			'lname' => $lastname,
			'email' => $email
		];
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
		header('Location: ../public/php/pages/signup.php');
		exit;
	}
}

/**
 * Adds a new user to the database and initializes the user session.
 *
 * Hashes the user's password, inserts their data into the `tbl_user` table, and sets session variables upon success.
 * Handles database connection issues, SQL preparation errors, and execution failures.
 * Redirects the user upon successful registration.
 *
 * @param string $firstname            User's first name.
 * @param string $lastname             User's last name.
 * @param string $email                User's email address.
 * @param string $password             User's plaintext password.
 * @param bool   $terms_and_conditions Whether the user agreed to the terms and conditions.
 * @param bool   $privacy_policy       Whether the user accepted the privacy policy.
 *
 * @return string|bool Returns false on success (due to redirection), or an error message string on failure.
 */

function add_new_user(
	string $firstname,
	string $lastname,
	string $email,
	string $password,
	bool $terms_and_conditions,
	bool $privacy_policy
): string|bool {
	global $connection;

	if (!$connection) {
		error_log("Database connection error: Connection not established.");
		return "Database connection error. Please try again later.";
	}

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO tbl_user (firstname, lastname, email, password, agreed_terms, agreed_privacy) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $connection->prepare($query);

	if (!$stmt) {
		error_log("Failed to prepare statement: " . $connection->error);
		return "An internal error occurred. Please try again.";
	}

	if (!$stmt->bind_param("ssssii", $firstname, $lastname, $email, $hashed_password, $terms_and_conditions, $privacy_policy)) {
		error_log("Binding parameters failed: " . $stmt->error);
		$stmt->close();
		return "Failed to process user data. Please try again.";
	}

	if ($stmt->execute()) {
		$user_id = $stmt->insert_id;
		$stmt->close();

		$_SESSION["user_id"] = $user_id;
		$_SESSION["logged_in"] = true;

		session_regenerate_id(true);

		header("Location: ../public/php/index.php");
		exit;
	} else {
		error_log("Insert failed: " . $stmt->error);
		$stmt->close();
		return "Failed to insert user data. Please try again later.";
	}
}

/**
 * Generates and stores a secure password reset token for a given email.
 *
 * This function checks if the email exists, retrieves the associated user ID,
 * deletes any previous reset tokens, generates a new secure token, and stores
 * it in the database with an expiration timestamp.
 *
 * @param string $email The email address of the user requesting a password reset.
 * @return bool Returns true if the reset token was successfully created, false otherwise.
 */

function send_reset_link($email) {
	global $connection;

	if (!$connection) {
		error_log("Database connection error.");
		return false;
	}

	$user_id = null;

	$query = "SELECT user_id FROM tbl_user WHERE email = ?";
	if ($stmt = $connection->prepare($query)) {
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows === 0) {
			error_log("Email not found.");
			$stmt->close();
			return false;
		}

		$stmt->bind_result($user_id);
		$stmt->fetch();
		$stmt->close();
	}

	if (!$user_id) {
		error_log("Failed to fetch user_id.");
		return false;
	}

	error_log("User ID retrieved: " . $user_id);

	$query = "DELETE FROM password_resets WHERE user_id = ?";
	if ($stmt = $connection->prepare($query)) {
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$stmt->close();
	}

	$token = bin2hex(random_bytes(32));

	$expires_at = time() + 3600;

	$query = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)";
	if ($stmt = $connection->prepare($query)) {
		$stmt->bind_param("iss", $user_id, $token, $expires_at);
		$stmt->execute();
		$stmt->close();
	}

	$_SESSION['token'] = $token;
	$_SESSION['user_id'] = $user_id;
	$_SESSION['logged_in'] = false;

	return true;
}


/**
 * Resets the user's password after validating the reset token.
 *
 * @param int $user_id The ID of the user whose password is being reset.
 * @param string $token The unique reset token associated with the user.
 * @param string|null $new_password The new password provided by the user.
 * @param string|null $pwd_confirmation The confirmation of the new password.
 * 
 * @return string|bool Returns a success message or an error message if validation fails.
 */

function reset_password(int $user_id, string $token, ?string $new_password, ?string $pwd_confirmation): string|bool {
	global $connection;

	if (!$connection) {
		return "Database connection failed.";
	}

	$validated_password = validate_password($new_password);

	if ($validated_password === null) {
		return "Password does not meet security requirements.";
	}

	if ($pwd_confirmation !== $new_password) {
		return "New password and confirmation do not match.";
	}

	$stmt = $connection->prepare("SELECT id FROM password_resets WHERE user_id = ? AND token = ? AND expires_at > ?");
	if (!$stmt) {
		return "Database error: " . $connection->error;
	}

	$current_time = time();
	$stmt->bind_param("isi", $user_id, $token, $current_time);
	$stmt->execute();

	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$reset_id = $row['id'] ?? null;
	$stmt->close();

	if (!$reset_id) {
		return "Invalid or expired token.";
	}

	$new_hash = password_hash($validated_password, PASSWORD_DEFAULT);

	$stmt = $connection->prepare("UPDATE tbl_user SET password = ? WHERE user_id = ?");
	if (!$stmt) {
		return "Database error: " . $connection->error;
	}

	$stmt->bind_param("si", $new_hash, $user_id);
	$stmt->execute();

	if ($stmt->affected_rows === 0) {
		return "Password update failed—no changes made.";
	}

	$stmt->close();

	$stmt = $connection->prepare("DELETE FROM password_resets WHERE id = ?");
	if (!$stmt) {
		return "Database error: " . $connection->error;
	}

	$stmt->bind_param("i", $reset_id);
	$stmt->execute();
	$stmt->close();

	return true;
}

/**
 * Authenticates a user using email and password.
 *
 * @param string $email The user's email address.
 * @param string $password The user's password.
 * 
 * @return string|bool Returns true if login succeeds, otherwise an error message.
 */

function login_user(string $email, string $password): void {
	global $connection;

	if (empty($email) && empty($password)) {
		$_SESSION['errors'] = ['login' => "Email and password are required."];
		header('Location: ../public/php/pages/login.php');
		exit;
	}

	if (empty($email)) {
		$_SESSION['errors'] = ['login' => "Please enter your email address."];
		header('Location: ../public/php/pages/login.php');
		exit;
	}

	if (empty($password)) {
		$_SESSION['errors'] = ['login' => "Please enter your password."];
		header('Location: ../public/php/pages/login.php');
		exit;
	}

	$stmt = $connection->prepare("SELECT user_id, password FROM tbl_user WHERE email = ?");
	if (!$stmt) {
		$_SESSION['errors'] = ['login' => "Database error. Please try again later."];
		header('Location: ../public/php/pages/login.php');
		exit;
	}

	$stmt->bind_param("s", $email);
	$stmt->execute();

	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$user_id = $row['user_id'] ?? null;
	$hashed_password = $row['password'] ?? null;

	$stmt->close();

	if (!$user_id) {
		$_SESSION['errors'] = ['login' => "Invalid email or password."];
		// Don't store email in session when email doesn't exist
		unset($_SESSION['form_data']);
		header('Location: ../public/php/pages/login.php');
		exit;
	}

	if (!password_verify($password, $hashed_password)) {
		$_SESSION['errors'] = ['login' => "Invalid password."];
		$_SESSION['form_data'] = ['email' => $email]; // Keep email only for valid email addresses
		header('Location: ../public/php/pages/login.php');
		exit;
	}

	$_SESSION['logged_in'] = true;
	$_SESSION['user_id'] = $user_id;
	$_SESSION['email'] = $email;

	header('Location: ../public/php/index.php');
	exit;
}
