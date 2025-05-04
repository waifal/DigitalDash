<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// if ($_SESSION['logged_in'] === false) {
// 	header('Location: login.php');
// 	exit;
// }

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
