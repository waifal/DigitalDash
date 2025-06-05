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

<style scoped>
	:root {
		--layout-width: 50vw;
		--image-overlay: linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgb(0, 0, 0, 0.75) 100%);
	}

	main {
		height: calc(100svh - var(--nav-height));
		background-image: var(--image-overlay), url("../../assets/images/backgrounds/pexels-larsmai-4815491.jpg");
		background-size: 100% 100%, cover;
		background-position: center;
		background-repeat: no-repeat;
	}

	div.text {
		text-align: left;
		width: 80%;
		margin-right: auto;
		margin-left: auto;
	}

	div.grid-container {
		height: 100%;
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		place-items: center;
	}

	div.grid-container a {
		font-size: 2em;
	}
</style>

<main>
	<div class="grid-container">
		<div class="text">
			<h2>Contact us </h2>
			<p>Ph: 022 123 4567</p>
			<p>Gmail: DigitalDashMediaNZ@gmail.com</p>
			<p>Location: Tristram Street, Whitiora, Hamilton 3204</p>
			<h2>Our Socials</h2>
			<p>Follow us on our social media platforms to stay updated with the latest news and offers.</p>

			<a href="https://github.com/DigitalDashNZ" target="_blank"><i class="bi bi-github"></i></a>
			<a href="https://www.youtube.com/@DigitalDashNZ" target="_blank"><i class="bi bi-youtube"></i></a>
			<a href="https://www.instagram.com/digitaldashnz/" target="_blank"><i class="bi bi-instagram"></i></a>
			<a href="https://x.com/DigitalDashNZ" target="_blank"><i class="bi bi-twitter-x"></i></a>
		</div>
		<div class="map">
			<iframe class="i-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1383.2633661852653!2d175.27847231132998!3d-37.78872900836372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d6d18a57fa16281%3A0x72b05e2e8812d179!2sWintec%20Hamilton%20City%20Campus!5e0!3m2!1sen!2snz!4v1747695286189!5m2!1sen!2snz" width="600" height="450" style="border:0; margin-right: auto; margin-left: auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>