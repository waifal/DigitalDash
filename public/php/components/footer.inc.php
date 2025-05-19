<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
	<footer id="footer">
		<div class="footer-content">
			<!-- Logo -->
			<div class="flex-1">
				<?php if ($_SESSION['index'] === true): ?>
					<a href="#"><img src="../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash logo"></a>
				<?php else: ?>
					<a href="../index.php"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash logo"></a>
				<?php endif; ?>
			</div>
			<!-- Links -->
			<div class="footer-grid">
				<div> <strong>Explore</strong>
					<ul>
						<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
							<?php if ($_SESSION['index'] === true): ?>
								<li><a href="#">Home</a></li>
								<li><a href="digital-walks.html">Digital Walks</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="about.html">About</a></li>
							<?php else: ?>
								<li><a href="../../index.html">Home</a></li>
								<li><a href="../../digital-walks.html">Digital Walks</a></li>
								<li><a href="../../contact.html">Contact</a></li>
								<li><a href="../../about.html">About</a></li>
							<?php endif; ?>
						<?php else: ?>
							<?php if ($_SESSION['index'] === true): ?>
								<li><a href="#">Home</a></li>
								<li><a href="pages/digital-walks.php">Digital Walks</a></li>
								<li><a href="pages/contact.php">Contact</a></li>
								<li><a href="pages/about.php">About</a></li>
							<?php else: ?>
								<li><a href="../index.php">Home</a></li>
								<li><a href="digital-walks.php">Digital Walks</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="about.php">About</a></li>
							<?php endif; ?>
						<?php endif; ?>
					</ul>
				</div>
				<div>
					<strong>Trails</strong>
					<ul>
						<li><a href="#">Bush Walks</a></li>
						<li><a href="#">Lake Walks</a></li>
						<li><a href="#">Mountain Trails</a></li>
					</ul>
				</div>
				<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
					<div>
						<strong>Account</strong>
						<ul>
							<li><a href="../pages/login.php">Login</a></li>
							<li><a href="../pages/signup.php">Sign Up</a></li>
						</ul>
					</div>
				<?php else: ?>
					<div>
						<strong>Account</strong>
						<ul>
							<li><a href="../pages/profile.php">Profile</a></li>
							<li><a href="../../../php/signout.inc.php">Sign out</a></li>
						</ul>
					</div>
				<?php endif; ?>
				<div>
					<strong>Follow Us</strong>
					<div class="social-links">
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
				<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
					<a href="../pages/privacy-policy.php"><small>Privacy Policy</small></a>
					<span></span>
					<a href="../pages/terms-and-conditions.php"><small>Terms &amp; Conditions</small></a>
				<?php else: ?>
					<a href="../pages/privacy-policy.php"><small>Privacy Policy</small></a>
					<span></span>
					<a href="../pages/terms-and-conditions.php"><small>Terms &amp; Conditions</small></a>
				<?php endif; ?>
			</div>
		</div>
	</footer>
<?php else : ?>
	<footer id="footer">
		<div class="footer-content">
			<!-- Logo -->
			<div class="flex-1">
				<?php if ($_SESSION['index'] === true): ?>
					<a href="#"><img src="../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash logo"></a>
				<?php else: ?>
					<a href="../index.php"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash logo"></a>
				<?php endif; ?>
			</div>
			<!-- Links -->
			<div class="footer-grid">
				<div> <strong>Explore</strong>
					<ul>
						<?php if ($_SESSION['index'] === true): ?>
							<li><a href="#">Home</a></li>
						<?php else: ?>
							<li><a href="../index.php">Home</a></li>
						<?php endif; ?>
						<?php if ($_SESSION['index'] === true): ?>
							<li><a href="pages/digital-walks.php">Digital Walks</a></li>
							<li><a href="pages/contact.php">Contact</a></li>
							<li><a href="pages/about.php">About</a></li>
						<?php else: ?>
							<li><a href="digital-walks.php">Digital Walks</a></li>
							<li><a href="contact.php">Contact</a></li>
							<li><a href="about.php">About</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<div>
					<strong>Trails</strong>
					<ul>
						<li><a href="#">Bush Walks</a></li>
						<li><a href="#">Lake Walks</a></li>
						<li><a href="#">Mountain Trails</a></li>
					</ul>
				</div>
				<?php if (isset($_SESSION['user_id']) && $_SESSION['logged_in'] === true): ?>
					<div>
						<strong>Account</strong>
						<ul>
							<li><a href="#">Account Settings</a></li>
							<?php if ($_SESSION['index'] === true): ?>
								<li><a href="../../php/signout.inc.php">Logout</a></li>
							<?php else: ?>
								<li><a href="../../../php/signout.inc.php">Logout</a></li>
							<?php endif; ?>
						</ul>
					</div>
				<?php else: ?>
					<div>
						<strong>Account</strong>
						<ul>
							<li><a href="../pages/signup.php">Sign Up</a></li>
							<li><a href="../pages/login.php">Login</a></li>
						</ul>
					</div>
				<?php endif; ?>
				<div>
					<strong>Follow Us</strong>
					<div class="social-links">
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
				<a href="../pages/privacy-policy.php"><small>Privacy Policy</small></a>
				<span></span>
				<a href="../pages/terms-and-conditions.php"><small>Terms &amp; Conditions</small></a>
			</div>
		</div>
	</footer>
<?php endif; ?>

<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
	<script src="../js/scripts.js" type="module"></script>
<?php elseif (isset($_SESSION['digital_walks']) && $_SESSION['digital_walks'] === true): ?>
	<script src="https://unpkg.com/video.js/dist/video.min.js"></script>
	<script src="../../js/scripts.js" type="module"></script>
	<script src="../../js/videohandler.js"></script>
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
	<script src="../js/scripts.js" type="module"></script>
<?php endif; ?>

</body>

</html>