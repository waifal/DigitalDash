<?php

session_start();

/* 
 * Ensure session login state is properly set:
 * - Check if 'user_id' is unset
 * - Verify if 'logged_in' is explicitly set to false
 * - Ensure 'logged_in' is not empty
 * - Default to false for consistency
 */

if (!isset($_SESSION["user_id"]) || isset($_SESSION["logged_in"]) === false || empty($_SESSION["logged_in"])) {
	$_SESSION["logged_in"] = false;
}

/* 
 * Handle user authentication state:
 * - Redirect authenticated users to the homepage
 * - Allow unauthenticated users to proceed with signup
 * - Ensure consistency with a fallback default case
 */

switch ($_SESSION["logged_in"]) {
	case true:
		header("Location: ../public/php/index.php");
		exit;
	case false:
		break;
	default:
		$_SESSION["logged_in"] = false;
}

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$fname = validate_user($_POST['fname'] ?? '');
	$lname = validate_user($_POST['lname'] ?? '');
	$email = validate_email($_POST['email'] ?? '');
	$password = validate_password($_POST['password'] ?? '');
	$pwd_confirm = $_POST['pwd_confirm'];
	$terms_and_conditions = validate_checkbox('terms_and_conditions');
	$privacy_policy = validate_checkbox('privacy_policy');
}
