<footer id="footer">
	<div class="footer-content">
		<!-- Logo -->
		<div class="flex-1">
			<a href="index.html">
				<img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash logo">
			</a>
		</div>
		<!-- Links -->
		<div class="footer-grid">
			<div>
				<strong>Explore</strong>
				<ul>
					<li><a href="../../index.html">Home</a></li>
					<li><a href="../../digital-walks.html">Digital Walks</a></li>
					<li><a href="../../contact.html">Contact</a></li>
					<li><a href="../../about.html">About</a></li>
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
			<div>
				<strong>Account</strong>
				<ul>
					<li><a href="signup.php">Sign Up</a></li>
					<li><a href="login.php">Login</a></li>
				</ul>
			</div>
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
<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>
	<script src="../../js/scripts.js" type="module"></script>
<?php else: ?>
	<script src="../js/scripts.js" type="module"></script>
<?php endif; ?>
</body>

</html>