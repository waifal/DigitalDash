<?php

session_start();

/* 
 * Verify session authentication state:
 * - Check if 'user_id' and 'logged_in' are both set
 * - Exit if authentication is confirmed 
 */

if (!empty($_SESSION["user_id"]) && !empty($_SESSION["logged_in"])) {
	exit;
}

/* 
 * Handle user authentication state:
 * - Exit for logged-in users
 * - Redirect unauthenticated users to the homepage
 * - Default to 'false' and enforce redirection for undefined states
 */

switch ($_SESSION["logged_in"]) {
	case true:
		exit;
	case false:
		header("Location: ../index.html");
		exit;
	default:
		$_SESSION["logged_in"] = false;
		header("Location: ../index.html");
		exit;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DigitalDash</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
	<link rel="stylesheet" href="../css/styles.css">
</head>

<body>
	<?php require_once(__DIR__ . '/components/nav.inc.php'); ?>

	<h1>Home Page</h1>
</body>

</html>