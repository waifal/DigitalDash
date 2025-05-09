<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/logo/logo_color_transparent_logo.png">
	<title>DigitalDash</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
	<?php
	if (isset($_SESSION['index'])):
		if ($_SESSION['index'] === true):
			echo '<link rel="stylesheet" href="../css/styles.css">';
		else:
			echo '<link rel="stylesheet" href="../../css/styles.css">';
		endif;
	endif;
	?>
</head>

<body>