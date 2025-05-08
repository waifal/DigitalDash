<?php

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);

session_start();

require_once(__DIR__ . '/../../../php/includes/connection.inc.php');

$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));

if (!empty($_SESSION['logged_in'])) {
	header('Location: ../index.php');
	exit;
}

$token = $_GET['token'] ?? null;
$current_time = time();

$user_id = null;

if ($token) {
	$query = "SELECT user_id FROM password_resets WHERE token = ? AND expires_at > ?";
	if ($stmt = $connection->prepare($query)) {
		$stmt->bind_param("si", $token, $current_time);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows === 0) {
			header("Location: reset-password.php?error=invalid_token");
			exit;
		}

		$stmt->bind_result($user_id);
		$stmt->fetch();
		$stmt->close();
	}
}

$_SESSION['index'] = false;
$_SESSION['email_is_correct'] = $_SESSION['email_is_correct'] ?? false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main>
	<section class='auth__container col-2'>
		<div class="auth-col-bg"></div>
		<div>
			<?php if (!isset($_GET['token'])): ?>
				<form id="resetpwdfrm" action="../../../php/check-email.inc.php" method="POST" novalidate>
					<h2 id="form-heading" class="visually-hidden">Reset Password</h2>
					<p>Verify your identity using your email address to regain access to your account and resume your immersive experience.</p>
					<?php if ($_GET['error'] ?? '' === "invalid_email"): ?>
						<p class="error">We couldn't find an account with that email address. Please try again.</p>
						<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
						</div>
						<div class='button__container'>
							<button type="submit" class="primary-btn">Confirm</button>
							<a href="login.php">Go back</a>
						</div>
					<?php elseif ($_GET['error'] ?? '' === "invalid_token"): ?>
						<p class="error">Invalid or expired token! <a href="reset-password.php">Please request a new reset link.</a></p>
					<?php elseif ($_GET['success'] ?? '' === "email_sent"): ?>
						<p class="success">Email sent successfully! Please check your spam folder.</p>
					<?php else: ?>
						<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
						</div>
						<div class='button__container'>
							<button type="submit" class="primary-btn">Confirm</button>
							<a href="login.php">Go back</a>
						</div>
					<?php endif; ?>
				</form>
			<?php elseif (isset($_GET['token'], $user_id)): ?>
				<form id="resetpwdfrm" action="../../../php/reset-password.inc.php" method="POST" novalidate>
					<h2 id="form-heading" class="visually-hidden">Reset Password</h2>
					<p>Verify your identity using your email address to regain access to your account and resume your immersive experience.</p>
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
					<input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
					<div class="form-group">
						<label for="new_password">New Password</label>
						<div class="password__container">
							<input type="password" name="new_password" id="new_password" autocomplete="new-password" placeholder="Enter your new password" required>
							<button type="button" class="show_password" tabindex="-1"><i class="fa-solid fa-eye-low-vision"></i></button>
						</div>
					</div>
					<div class="form-group">
						<label for="pwd_confirm">Confirm Password</label>
						<div class="password__container">
							<input type="password" name="pwd_confirm" id="pwd_confirm" autocomplete="new-password" placeholder="Confirm your new password" required>
							<button type="button" class="show_password" tabindex="-1"><i class="fa-solid fa-eye-low-vision"></i></button>
						</div>
					</div>
					<div class='button__container'>
						<button type="submit" class="button">Change Password</button>
						<input type="hidden" hidden></input>
					</div>
				</form>
			<?php else: ?>
				<p class="error">Token validation failed. <a href="reset-password.php">Please request a new reset link.</a></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>