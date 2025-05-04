<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$_SESSION['sign_in_page'] = false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');

?>
<main>
	<section class='auth__container'>
		<!-- Form -->
		<div>
			<h2>Your Adventure Resumes Here</h2>
			<p>Sign in to access immersive trails, stunning landscapes, and a walking experience designed for clarity and wellbeing.</p>
			<form id="loginfrm" action="../../../php/login.inc.php" method="POST">
				<!-- CSRF Token -->
				<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
				<!-- Email Address -->
				<div>
					<label>Email Address
						<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your Email Address" required>
					</label>
				</div>
				<!-- Password -->
				<div>
					<label>Your Password
						<input type="password" name="password" id="password" autocomplete="current-password" placeholder="Enter your Password" required>
					</label>
				</div>
				<div>
					<a href="../pages/reset-password.php">Forgot Password?</a>
				</div>
				<!-- Buttons -->
				<div class='button__container'>
					<button type="submit">Login</button>
					<a href="../pages/signup.php">Sign up</a>
				</div>
			</form>
		</div>
		<!-- Background -->
		<div class='auth-col-bg'></div>
	</section>
</main>

<!-- Footer -->
<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>