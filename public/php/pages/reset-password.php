<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['logged_in'])) {
	$_SESSION['logged_in'] = false;
}

if ($_SESSION['logged_in'] === true) {
	header('Location: ../index.php');
	exit;
}

$_SESSION['sign_in_page'] = true;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
