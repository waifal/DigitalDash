<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$fname = validate_user($_POST['fname'] ?? '');
	$lname = validate_user($_POST['lname'] ?? '');
	$email = validate_email($_POST['email'] ?? '');
	$password = validate_password($_POST['password'] ?? '');
	$pwd_confirm = $_POST['pwd_confirm'];
	$terms_and_conditions = validate_checkbox('terms_and_conditions');
	$privacy_policy = validate_checkbox('privacy_policy');

	validate_user_input($fname, $lname, $email, $password, $pwd_confirm, $terms_and_conditions, $privacy_policy);
	add_new_user($fname, $lname, $email, $password, $pwd_confirm, $terms_and_conditions, $privacy_policy);
}
