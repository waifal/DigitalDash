<?php

session_start();

/* 
 * Ensure session login state is properly set:
 * - Check if 'logged_in' is unset
 * - Verify if 'logged_in' is explicitly set to false
 * - Ensure 'logged_in' is not empty
 * - Default to false for consistency
 */

if (!isset($_SESSION["logged_in"]) || isset($_SESSION["logged_in"]) === false || empty($_SESSION["logged_in"])) {
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
