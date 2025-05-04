<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$current_password = $_POST['password'];
	$new_password = validate_password($_POST['new_password'] ?? '');
	$pwd_confirm = $_POST['pwd_confirm'];
}
