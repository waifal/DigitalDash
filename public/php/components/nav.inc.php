<?php if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true): ?>

	<nav>
		<div>
			<a href="../../index.html"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
		</div>
		<ul>
			<li><a href="../../index.html">Home</a></li>
			<li><a href="../../digital-walks.html">Digital Walks</a></li>
			<li><a href="../../about.html">About</a></li>
			<li><a href="../../contact.html">Contact</a></li>
		</ul>
		<div class="cta">
			<?php if (isset($_SESSION['sign_in_page']) && $_SESSION['sign_in_page']): ?>
				<a href="../pages/login.php" class="primary-btn secondary">Login</a>
			<?php else: ?>
				<a href="../pages/signup.php" class="primary-btn">Sign up</a>
			<?php endif; ?>
			<button id="theme-switcher" type="button"><i class="fa-solid fa-moon"></i></button>
		</div>

		<!-- Hamburger Menu -->
		<div id="hamburger">
			<div class="overlay"></div>
			<button type="button" id="open-hbm"><i class="fa-solid fa-bars"></i></button>
			<div>
				<div class="hbm-content">
					<!-- Close Menu & Theme Switcher -->
					<div>
						<button type="button" id="theme-switcher"><i class="fa-solid fa-moon"></i></button>
						<button type="button" class="close-hbm"><i class="fa-solid fa-xmark"></i></button>
					</div>
					<div class="links">
						<div>
							<ul>
								<li><a href="../../index.html">Home</a></li>
								<li><a href="../../digital-walks.html">Digital Walks</a></li>
								<li><a href="../../about.html">About</a></li>
								<li><a href="../../contact.html">Contact</a></li>
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
				<li><a href="#">Home</a></li>
				<li><a href="pages/digital-walks.php">Digital Walks</a></li>
				<li><a href="pages/about.php">About</a></li>
				<li><a href="pages/contact.php">Contact</a></li>
			<?php else: ?>
				<li><a href="../index.php">Home</a></li>
				<li><a href="digital-walks.php">Digital Walks</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
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
			<button id="theme-switcher" type="button"><i class="fa-solid fa-moon"></i></button>
		</div>

		<!-- Hamburger Menu -->
		<div id="hamburger">
			<div class="overlay"></div>
			<button type="button" id="open-hbm"><i class="fa-solid fa-bars"></i></button>
			<div>
				<div class="hbm-content">
					<div>
						<button type="button" id="theme-switcher"><i class="fa-solid fa-moon"></i></button>
						<button type="button" class="close-hbm"><i class="fa-solid fa-xmark"></i></button>
					</div>
					<div class="links">
						<div>
							<ul>
								<?php if ($_SESSION['index'] === true): ?>
									<li><a href="#">Home</a></li>
									<li><a href="pages/digital-walks.php">Digital Walks</a></li>
									<li><a href="pages/about.php">About</a></li>
									<li><a href="pages/contact.php">Contact</a></li>
								<?php else: ?>
									<li><a href="../index.php">Home</a></li>
									<li><a href="digital-walks.php">Digital Walks</a></li>
									<li><a href="about.php">About</a></li>
									<li><a href="contact.php">Contact</a></li>
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