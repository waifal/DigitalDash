<?php

$isLoggedIn = !empty($_SESSION['user_id']) && $_SESSION['logged_in'] === true;
$isIndex = !empty($_SESSION['index']) && $_SESSION['index'] === true;

function getLinkPath($page, $isLoggedIn, $isIndex)
{
	$basePath = $isIndex ? 'pages/' : ($isLoggedIn ? '' : '../../');
	return $isLoggedIn ? $basePath . $page . '.php' : $basePath . $page . '.html';
}

$exploreLinks = [
	['digital-walks', 'Digital Walks'],
	['about', 'About'],
	['contact', 'Contact']
];

$trailsLinks = [
	['digital-walks#video__section', 'Bush Walks'],
	['digital-walks#lake-walks', 'Lake Walks']
];

$logoSrc = $isIndex ? '../assets/images/logo/logo_color_transparent_png.png' : '../../assets/images/logo/logo_color_transparent_png.png';
$logoHref = $isIndex ? 'index.html' : ($isLoggedIn ? '../index.php' : '../../index.html');
$signoutHref = $isLoggedIn ? ($isIndex ? '../../php/signout.inc.php' : '../../../php/signout.inc.php') : ($isIndex ? 'php/pages/login.php' : '../pages/login.php');
$profileHref = $isLoggedIn ? '../pages/account-settings.php' : '../pages/signup.php';
?>

<footer id="footer">
	<div class="footer-content">
		<div class="flex-1">
			<a href="<?= htmlspecialchars($logoHref) ?>">
				<img src="<?= htmlspecialchars($logoSrc) ?>" alt="DigitalDash logo">
			</a>
		</div>
		<div class="footer-grid">
			<div>
				<strong>Explore</strong>
				<ul>
					<li><a href="<?= htmlspecialchars($logoHref) ?>">Home</a></li>
					<?php foreach ($exploreLinks as [$link, $name]): ?>
						<li><a href="<?= htmlspecialchars(getLinkPath($link, $isLoggedIn, $isIndex)) ?>"><?= htmlspecialchars($name) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div>
				<strong>Trails</strong>
				<ul>
					<?php foreach ($trailsLinks as [$link, $name]): ?>
						<li><a href="<?= htmlspecialchars(getLinkPath($link, $isLoggedIn, $isIndex)) ?>"><?= htmlspecialchars($name) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div>
				<strong>Account</strong>
				<ul>
					<?php if ($isLoggedIn): ?>
						<li><a href="<?= htmlspecialchars($profileHref) ?>">Account Settings</a></li>
						<li><a href="<?= htmlspecialchars($signoutHref) ?>">Sign out</a></li>
					<?php else: ?>
						<li><a href="<?= htmlspecialchars($profileHref === 'php/pages/signup.php' ? 'php/pages/login.php' : $profileHref) ?>">Login</a></li>
						<li><a href="php/pages/signup.php">Sign Up</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div>
				<strong>Follow Us</strong>
				<div class="social-links">
					<a href="https://github.com/DigitalDashNZ" target="_blank"><i class="bi bi-github"></i></a>
					<a href="https://www.youtube.com/@DigitalDashNZ" target="_blank"><i class="bi bi-youtube"></i></a>
					<a href="https://www.instagram.com/digitaldashnz/" target="_blank"><i class="bi bi-instagram"></i></a>
					<a href="https://x.com/DigitalDashNZ" target="_blank"><i class="bi bi-twitter-x"></i></a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="footer-bottom">
		<div class="copyright">
			<small>&copy; <time datetime="2025">2025</time> DigitalDash. All Rights Reserved.</small>
		</div>
		<div class="footer-links">
			<a href="php/pages/privacy-policy.php"><small>Privacy Policy</small></a>
			<span></span>
			<a href="php/pages/terms-and-conditions.php"><small>Terms &amp; Conditions</small></a>
		</div>
	</div>
</footer>

<?php if (!$isLoggedIn): ?>
	<script src="../../js/scripts.js" type="module"></script>
<?php elseif (!empty($_SESSION['digital_walks'])): ?>
	<script src="../js/scripts.js" type="module"></script>
<?php else: ?>
	<script src="../../js/scripts.js" type="module"></script>
<?php endif; ?>