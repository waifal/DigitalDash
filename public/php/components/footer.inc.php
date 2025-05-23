<?php
$isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['logged_in'] === true;
$isIndex = isset($_SESSION['index']) && $_SESSION['index'] === true;

if ($isIndex) {
	$homeLink = $isLoggedIn ? '#' : '#';
	$exploreLinks = $isLoggedIn
		? [
			['pages/digital-walks.php', 'Digital Walks'],
			['pages/about.php', 'About'],
			['pages/contact.php', 'Contact']
		]
		: [
			['digital-walks.html', 'Digital Walks'],
			['about.html', 'About'],
			['contact.html', 'Contact']
		];
	$logoSrc = '../assets/images/logo/logo_color_transparent_png.png';
	$logoHref = 'index.html';
	$signoutHref = $isLoggedIn ? 'php/signout.inc.php' : 'php/pages/login.php';
	$profileHref = $isLoggedIn ? 'php/pages/account-settings.php' : 'php/pages/signup.php';
	$privacyHref = 'php/pages/privacy-policy.php';
	$termsHref = 'php/pages/terms-and-conditions.php';
} else {
	$homeLink = $isLoggedIn ? '../index.php' : '../../index.html';
	$exploreLinks = $isLoggedIn
		? [
			['digital-walks.php', 'Digital Walks'],
			['about.php', 'About'],
			['contact.php', 'Contact']
		]
		: [
			['../../digital-walks.html', 'Digital Walks'],
			['../../about.html', 'About'],
			['../../contact.html', 'Contact']
		];
	$logoSrc = '../../assets/images/logo/logo_color_transparent_png.png';
	$logoHref = '../index.php';
	$signoutHref = $isLoggedIn ? '../../../php/signout.inc.php' : '../pages/login.php';
	$profileHref = $isLoggedIn ? '../pages/account-settings.php' : '../pages/signup.php';
	$privacyHref = '../pages/privacy-policy.php';
	$termsHref = '../pages/terms-and-conditions.php';
}
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
					<li><a href="<?= htmlspecialchars($homeLink) ?>">Home</a></li>
					<?php foreach ($exploreLinks as $link): ?>
						<li><a href="<?= htmlspecialchars($link[0]) ?>"><?= htmlspecialchars($link[1]) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div>
				<strong>Trails</strong>
				<ul>
					<li><a href="#">Bush Walks</a></li>
					<li><a href="#">Lake Walks</a></li>
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
			<small>
				&copy; <time datetime="2025">2025</time> DigitalDash. All Rights Reserved.
			</small>
		</div>
		<div class="footer-links">
			<a href="<?= htmlspecialchars($privacyHref) ?>"><small>Privacy Policy</small></a>
			<span></span>
			<a href="<?= htmlspecialchars($termsHref) ?>"><small>Terms &amp; Conditions</small></a>
		</div>
	</div>

	<!-- Mobile Footer -->
	<div id="mobile">
		<div class="footer-content">
			<div class="flex-1">
				<a href="<?= htmlspecialchars($logoHref) ?>">
					<img src="<?= htmlspecialchars($logoSrc) ?>" alt="DigitalDash logo">
				</a>
			</div>
			<div class="footer-grid">
				<div>
					<button data-accordion="true" onclick="initAccordion(this, 'link1', true, `<?= '<ul><li><a href=\'' . htmlspecialchars($homeLink) . '\'>Home</a></li>' . implode('', array_map(fn($l) => '<li><a href=\'' . htmlspecialchars($l[0]) . '\'>' . htmlspecialchars($l[1]) . '</a></li>', $exploreLinks)) . '</ul>' ?>`)"><strong>Explore</strong> <i class="fa-solid fa-chevron-down"></i></button>
				</div>
				<div>
					<button data-accordion="true" onclick="initAccordion(this, 'link2', true, `<ul><li><a href='#'>Bush Walks</a></li><li><a href='#'>Lake Walks</a></li></ul>`)"><strong>Trails</strong> <i class="fa-solid fa-chevron-down"></i></button>
				</div>
				<div>
					<button data-accordion="true" onclick="initAccordion(this, 'link3', true, `<?php if ($isLoggedIn): ?><ul><li><a href='<?= htmlspecialchars($profileHref) ?>'>Account Settings</a></li><li><a href='<?= htmlspecialchars($signoutHref) ?>'>Sign out</a></li></ul><?php else: ?><ul><li><a href='php/pages/login.php'>Login</a></li><li><a href='php/pages/signup.php'>Sign Up</a></li></ul><?php endif; ?>`)"><strong>Account</strong> <i class="fa-solid fa-chevron-down"></i></button>
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
				<small>
					&copy; <time datetime="2025">2025</time> DigitalDash. All Rights Reserved.
				</small>
			</div>
			<div class="footer-links">
				<a href="<?= htmlspecialchars($privacyHref) ?>"><small>Privacy Policy</small></a>
				<span></span>
				<a href="<?= htmlspecialchars($termsHref) ?>"><small>Terms &amp; Conditions</small></a>
			</div>
		</div>
	</div>
</footer>

<?php if (!$isLoggedIn): ?>
	<script src="js/scripts.js" type="module"></script>
<?php elseif (isset($_SESSION['digital_walks']) && $_SESSION['digital_walks'] === true): ?>
	<script src="https://unpkg.com/video.js/dist/video.min.js"></script>
	<script src="js/scripts.js" type="module"></script>
	<script src="js/videohandler.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const previews = document.querySelectorAll('.popular-content');
			async function handleVideoAction(video, action) {
				if (!video) return;
				try {
					if (action === 'play') {
						await video.play();
					} else {
						video.pause();
					}
				} catch (e) {
					if (e.name !== 'AbortError') {
						console.warn(`Video ${action} error:`, e);
					}
				}
			}
			previews.forEach((preview) => {
				preview.addEventListener('mouseover', () => {
					const video = preview.querySelector('video');
					handleVideoAction(video, 'play');
				});
				preview.addEventListener('mouseout', () => {
					const video = preview.querySelector('video');
					handleVideoAction(video, 'pause');
				});
			});
		});
	</script>
<?php else: ?>
	<script src="js/scripts.js" type="module"></script>
<?php endif; ?>