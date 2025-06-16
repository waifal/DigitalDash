<?php

session_start();

$_SESSION['index'] = true;
$_SESSION['digital_walks'] = false;

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
	header('Location: pages/login.php'); // Change to index.html
	exit;
}

require_once(__DIR__ . '/components/header.inc.php');
require_once(__DIR__ . '/components/nav.inc.php');
?>

<main>
	<section class="home-page">
		<div class="container">
			<div class="flex">
				<div class="txt">
					<h1>Digital<span>Dash</span></h1>
					<p>Immerse yourself in breathtaking destinations, cultural wonders, and serene escapes, all
						through virtual tours designed to enrich your well-being.</p>
					<div class="btn-div">
						<button>
							<?php if ($_SESSION['index'] === true): ?>
								<a href="pages/digital-walks.php">Take a walk</a>
							<?php else: ?>
								<a href="digital-walks.php">Take a walk</a>
							<?php endif; ?>
						</button>
						<button>
							<?php if ($_SESSION['index'] === true): ?>
								<a href="pages/about.php">Learn more</a>
							<?php else: ?>
								<a href="about.php">Learn more</a>
							<?php endif; ?>
						</button>
					</div>
				</div>
				<div class="video">
					<iframe width="560" height="315"
						src="https://www.youtube.com/embed/zcxXi3F9UOg?si=ytRSUT43_PF_eJlo"
						title="YouTube video player" frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</section>
</main>

<?php require_once(__DIR__ . '/components/footer.inc.php'); ?>