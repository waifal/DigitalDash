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
	<section class="About">
		<h1>About us</h1>
		<div class="txt">
			<p>
				DigitalDash brings the experience of walking into the digital space, allowing people to move and connect
				from home. Our technology provides a clear, immersive way to walk, offering a sense of presence and
				wellbeing without needing to step outside
				<br><br>
				Whether exploring digital landscapes, joining virtual walks with friends, or using movement for
				relaxation, DigitalDash makes walking accessible in a new way. We believe that every step—physical or
				digital—should contribute to mental clarity and deeper connections.
			</p>
			<img src="../../assets/images/images/TheTeam.jpg">
		</div>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>