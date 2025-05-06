<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Secure random token
}

if (!isset($_SESSION['logged_in'])) {
	$_SESSION['logged_in'] = false;
}

if ($_SESSION['logged_in'] === true) {
	header('Location: ../index.php');
	exit;
}

$_SESSION['index'] = false;
$_SESSION['sign_in_page'] = true;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main>
	<section class='auth__container col-2'>
		<!-- Background -->
		<div class='auth-col-bg'>
			<h2>Explore the Wild, Anywhere.</h2>
			<p>Join today to unlock breathtaking views and immersive trails, experiencing the beauty of nature like never before - right from your screen.</p>
		</div>
		<!-- Form -->
		<div>
			<form id="signupfrm" action="../../../php/signup.inc.php" method="POST" novalidate>
				<!-- CSRF Token -->
				<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
				<!-- Names -->
				<div>
					<label>First Name
						<input type="text" name="fname" id="fname" autocomplete="given-name" placeholder="Enter your first name" required>
					</label>
					<label>Last Name
						<input type="text" name="lname" id="lname" autocomplete="family-name" placeholder="Enter your last name" required>
					</label>
				</div>
				<!-- Email Address -->
				<div>
					<label>Email Address
						<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
					</label>
				</div>
				<!-- Password -->
				<div>
					<label>Your Password
						<div class="password__container">
							<input type="password" name="password" id="password" autocomplete="new-password" placeholder="Enter your password" required>
							<button type="button" class="show_password" tabindex="-1"><i class="fa-solid fa-eye-low-vision"></i></button>
						</div>
					</label>
				</div>
				<div>
					<label>Confirm Password
						<div class="password__container">
							<input type="password" name="pwd_confirm" id="pwd_confirm" autocomplete="new-password" placeholder="Confirm your password" required>
							<button type="button" class="show_password" tabindex="-1"><i class="fa-solid fa-eye-low-vision"></i></button>
						</div>
					</label>
				</div>
				<!-- Agreements -->
				<div>
					<label>
						<input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" value="agree" required>
						<a href="#">Terms & Conditions</a>
					</label>
					<label>
						<input type="checkbox" name="privacy_policy" id="privacy_policy" value="agree" required>
						<a href="#">Privacy Policy</a>
					</label>
				</div>
				<!-- Buttons -->
				<div class='button__container'>
					<button type="submit" class="button">Sign up</button>
					<a href="../pages/login.php" class="button">Login</a>
				</div>
			</form>
		</div>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>