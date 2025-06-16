<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if ($_SESSION['index'] === true): ?>
		<link rel="icon" href="../assets/images/logo/logo_color_transparent_logo.png">
	<?php else: ?>
		<link rel="icon" href="../../assets/images/logo/logo_color_transparent_logo.png">
	<?php endif; ?>
	<title>DigitalDash</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
		integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
	<?php if ($_SESSION['index'] === true): ?>
		<link rel="stylesheet" href="../css/homepage.css">
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="stylesheet" href="../css/rwd.css">
	<?php else: ?>
		<link rel="stylesheet" href="../../css/styles.css">
		<link rel="stylesheet" href="../../css/rwd.css">
		<link rel="stylesheet" href="../../css/account-settings.css">
	<?php endif; ?>
	<?php if ($_SESSION['index'] === true): ?>
		<script src="../js/scripts.js" type="module"></script>
	<?php else: ?>
		<script src="../../js/scripts.js" type="module"></script>
	<?php endif; ?>
</head>

<body>