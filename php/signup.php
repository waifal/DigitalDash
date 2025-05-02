<?php

session_start();

if (!isset($_SESSION["logged_in"]) || isset($_SESSION["logged_in"]) === false || empty($_SESSION["logged_in"])) {
	$_SESSION["logged_in"] = false;
}

switch ($_SESSION["logged_in"]) {
	case true:
		header("Location: ../public/php/index.php");
		exit;
	case false:
		break;
	default:
		$_SESSION["logged_in"] = false;
}
