<?php
// Get current page name for active class logic
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$current_path = $_SERVER['REQUEST_URI'];

// Function to determine if a link should be active
function isActive($page, $current_page, $current_path)
{
	// Handle special cases
	if ($page === 'home' && ($current_page === 'index' || strpos($current_path, 'index.php') !== false)) {
		return true;
	}
	if ($page === 'digital-walks' && ($current_page === 'digital-walks' || strpos($current_path, 'digital-walks') !== false)) {
		return true;
	}
	if ($page === 'about' && ($current_page === 'about' || strpos($current_path, 'about') !== false)) {
		return true;
	}
	if ($page === 'contact' && ($current_page === 'contact' || strpos($current_path, 'contact') !== false)) {
		return true;
	}
	return false;
}
?>

<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>

	<nav>
		<div>
			<a href="../../index.html"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
		</div>
		<ul>
			<li><a href="../../index.html" <?php echo isActive('home', $current_page, $current_path) ? 'class="active"' : ''; ?>>Home</a></li>
			<li><a href="../../digital-walks.html" <?php echo isActive('digital-walks', $current_page, $current_path) ? 'class="active"' : ''; ?>>Digital Walks</a></li>
			<li><a href="../../about.html" <?php echo isActive('about', $current_page, $current_path) ? 'class="active"' : ''; ?>>About</a></li>
			<li><a href="../../contact.html" <?php echo isActive('contact', $current_page, $current_path) ? 'class="active"' : ''; ?>>Contact</a></li>
		</ul>
		<div class="cta">
			<?php if (isset($_SESSION['sign_in_page']) && $_SESSION['sign_in_page']): ?>
				<a href="../pages/login.php" class="primary-btn secondary">Login</a>
			<?php else: ?>
				<a href="../pages/signup.php" class="primary-btn">Sign up</a>
			<?php endif; ?>
			<button id="theme-switcher" type="button"><i class="bi bi-brightness-low-fill"></i></button>
		</div>

		<!-- Hamburger Menu -->
		<div id="hamburger">
			<div class="overlay"></div>
			<button type="button" id="open-hbm"><i class="fa-solid fa-bars"></i></button>
			<div>
				<div class="hbm-content">
					<!-- Close Menu & Theme Switcher -->
					<div>
						<button type="button" id="theme-switcher"><i class="bi bi-brightness-low-fill"></i></button>
						<button type="button" class="close-hbm"><i class="fa-solid fa-xmark"></i></button>
					</div>
					<div class="links">
						<div>
							<ul>
								<li><a href="../../index.html" <?php echo isActive('home', $current_page, $current_path) ? 'class="active"' : ''; ?>>Home</a></li>
								<li><a href="../../digital-walks.html" <?php echo isActive('digital-walks', $current_page, $current_path) ? 'class="active"' : ''; ?>>Digital Walks</a></li>
								<li><a href="../../about.html" <?php echo isActive('about', $current_page, $current_path) ? 'class="active"' : ''; ?>>About</a></li>
								<li><a href="../../contact.html" <?php echo isActive('contact', $current_page, $current_path) ? 'class="active"' : ''; ?>>Contact</a></li>
							</ul>
						</div>
						<div>
							<hr>
						</div>
						<div>
							<ul>
								<li><a href="../pages/login.php" class="primary-btn secondary">Login</a></li>
								<li><a href="../pages/signup.php" class="primary-btn">Sign up</a></li>
							</ul>
						</div>
						<div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>

<?php else: ?>

	<nav>
		<div>
			<?php if ($_SESSION['index'] === true): ?>
				<a href="index.php"><img src="../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
			<?php else: ?>
				<a href="../index.php"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
			<?php endif; ?>
		</div>
		<ul>
			<?php if ($_SESSION['index'] === true): ?>
				<li><a href="#" <?php echo isActive('home', $current_page, $current_path) ? 'class="active"' : ''; ?>>Home</a></li>
				<li><a href="pages/digital-walks.php" <?php echo isActive('digital-walks', $current_page, $current_path) ? 'class="active"' : ''; ?>>Digital Walks</a></li>
				<li><a href="pages/about.php" <?php echo isActive('about', $current_page, $current_path) ? 'class="active"' : ''; ?>>About</a></li>
				<li><a href="pages/contact.php" <?php echo isActive('contact', $current_page, $current_path) ? 'class="active"' : ''; ?>>Contact</a></li>
			<?php else: ?>
				<li><a href="../index.php" <?php echo isActive('home', $current_page, $current_path) ? 'class="active"' : ''; ?>>Home</a></li>
				<li><a href="digital-walks.php" <?php echo isActive('digital-walks', $current_page, $current_path) ? 'class="active"' : ''; ?>>Digital Walks</a></li>
				<li><a href="about.php" <?php echo isActive('about', $current_page, $current_path) ? 'class="active"' : ''; ?>>About</a></li>
				<li><a href="contact.php" <?php echo isActive('contact', $current_page, $current_path) ? 'class="active"' : ''; ?>>Contact</a></li>
			<?php endif; ?>
		</ul>
		<div class="cta">
			<button type="button" class="profile__menu primary-btn"><i class="fa-solid fa-user"></i>
				<div class="user-content">
					<div>
						<?php if ($_SESSION['index'] === true): ?>
							<a href="pages/account-settings.php" class="primary-btn secondary">Account Settings</a>
							<a href="../../php/signout.inc.php" class="primary-btn">Sign out</a>
						<?php else: ?>
							<a href="account-settings.php" class="primary-btn secondary">Account Settings</a>
							<a href="../../../php/signout.inc.php" class="primary-btn">Sign out</a>
						<?php endif; ?>
					</div>
				</div>
			</button>
			<button id="theme-switcher" type="button"><i class="bi bi-brightness-low-fill"></i></button>
		</div>

		<!-- Hamburger Menu -->
		<div id="hamburger">
			<div class="overlay"></div>
			<button type="button" id="open-hbm"><i class="fa-solid fa-bars"></i></button>
			<div>
				<div class="hbm-content">
					<div>
						<button type="button" id="theme-switcher"><i class="bi bi-brightness-low-fill"></i></button>
						<button type="button" class="close-hbm"><i class="fa-solid fa-xmark"></i></button>
					</div>
					<div class="links">
						<div>
							<ul>
								<?php if ($_SESSION['index'] === true): ?>
									<li><a href="#" <?php echo isActive('home', $current_page, $current_path) ? 'class="active"' : ''; ?>>Home</a></li>
									<li><a href="pages/digital-walks.php" <?php echo isActive('digital-walks', $current_page, $current_path) ? 'class="active"' : ''; ?>>Digital Walks</a></li>
									<li><a href="pages/about.php" <?php echo isActive('about', $current_page, $current_path) ? 'class="active"' : ''; ?>>About</a></li>
									<li><a href="pages/contact.php" <?php echo isActive('contact', $current_page, $current_path) ? 'class="active"' : ''; ?>>Contact</a></li>
								<?php else: ?>
									<li><a href="../index.php" <?php echo isActive('home', $current_page, $current_path) ? 'class="active"' : ''; ?>>Home</a></li>
									<li><a href="digital-walks.php" <?php echo isActive('digital-walks', $current_page, $current_path) ? 'class="active"' : ''; ?>>Digital Walks</a></li>
									<li><a href="about.php" <?php echo isActive('about', $current_page, $current_path) ? 'class="active"' : ''; ?>>About</a></li>
									<li><a href="contact.php" <?php echo isActive('contact', $current_page, $current_path) ? 'class="active"' : ''; ?>>Contact</a></li>
								<?php endif; ?>
							</ul>
						</div>
						<div>
							<hr>
						</div>
						<div>
							<ul>
								<?php if ($_SESSION['index'] === true): ?>
									<li><a href="pages/account-settings.php" class="primary-btn secondary">Account Settings</a></li>
									<li><a href="../../php/signout.inc.php" class="primary-btn">Logout</a></li>
								<?php else: ?>
									<li><a href="account-settings.php" class="primary-btn secondary">Account Settings</a></li>
									<li><a href="../../../php/signout.inc.php" class="primary-btn">Logout</a></li>
								<?php endif; ?>
							</ul>
						</div>
						<div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>

<?php endif; ?>