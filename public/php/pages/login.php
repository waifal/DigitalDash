<?php

session_start();

require(__DIR__ . '/../../../php/includes/connection.inc.php');

$query = "DELETE FROM password_resets WHERE token = ?";

if ($stmt = $connection->prepare($query)) {
	$stmt->bind_param("s", $_SESSION['token']);
	$stmt->execute();
	$stmt->close();
}
unset($_SESSION['token']);

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
	header('Location: ../index.php');
	exit;
}

$_SESSION['index'] = false;
$_SESSION['sign_in_page'] = false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');

?>
<main>
	<section class='auth__container col-2'>
		<!-- Background -->
		<div class='auth-col-bg'>
			<h2>Your Adventure Resumes Here</h2>
			<p>Sign in to access immersive trails, stunning landscapes, and a walking experience designed for clarity and wellbeing.</p>
		</div>
		<!-- Form -->
		<div>
			<?php
			if (isset($_GET['password'])) {
				if ($_GET['password'] === "success") {
					echo "<p class='success'>Password has been changed!</p>";
				}
			}
			?>
			<form id="loginfrm" action="../../../php/login.inc.php" method="POST" novalidate>
				<!-- CSRF Token -->
				<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
							<input type="password" name="password" id="password" autocomplete="current-password" placeholder="Enter your password" required>
							<button type="button" class="show_password" tabindex="-1"><i class="fa-solid fa-eye-low-vision"></i></button>
						</div>
					</label>
				</div>
				<div>
					<a href="../pages/reset-password.php">Forgot Password?</a>
				</div>
				<!-- Buttons -->
				<div class='button__container'>
					<button type="submit" class="button">Login</button>
					<a href="../pages/signup.php" class="button">Sign up</a>
				</div>
			</form>
		</div>
	</section>
</main>

<!-- Footer -->
<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>