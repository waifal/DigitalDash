<?php

session_start();

$_SESSION['index'] = true;

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
	header('Location: pages/login.php'); // Change to index.html
	exit;
}

require_once(__DIR__ . '/components/header.inc.php');
require_once(__DIR__ . '/components/nav.inc.php');
?>

<main>
	<h1>Index.php</h1>
</main>

<?php require_once(__DIR__ . '/components/footer.inc.php'); ?>