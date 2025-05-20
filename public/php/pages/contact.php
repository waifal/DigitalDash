<?php

session_start();

$_SESSION['index'] = false;
$_SESSION['digital_walks'] = false;

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
	header('Location: login.php'); // Change to index.html
	exit;
}

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main>
	<section class="col-2">
		<h2>Contact us </h2>
		<p>
			<li>Ph: 022 123 4567</li>
			<li> Gmail: DigitalDashMediaNZ@gmail.com</li>
			<li>Location: Tristram Street, Whitiora, Hamilton 3204</li>
		</p>
		<h2>Our Socials</h2>
		p>Follow us on our social media platforms to stay updated with the latest news and offers.</p>
		<img src="  " alt="Logo" class="logo">
		<div class="socials">
			<a href="https://www.facebook.com/digitaldashmedia" target="_blank"><i
					class="fa-brands fa-facebook"></i></a>
			<a href="https://www.instagram.com/digitaldashmedia/" target="_blank"><i
					class="fa-brands fa-instagram"></i></a>
			<a href="https://www.linkedin.com/company/digitaldashmedia/" target="_blank"><i
					class="fa-brands fa-linkedin"></i></a>
			<a href="https://www.tiktok.com/@digitaldashmedia" target="_blank"><i
					class="fa-brands fa-tiktok"></i></a>


	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>