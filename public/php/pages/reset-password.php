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
	<section class='auth__container'>
		<div>
			<h2>Reset Password</h2>

			<?php if (!isset($_GET['token'])): ?>
				<form id="resetpwdfrm" action="../../../php/check-email.inc.php" method="POST" novalidate>
					<?php if ($_GET['error'] ?? '' === "invalid_email"): ?>
						<p class="error">Invalid email address! Please try again.</p>
						<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
						<div>
							<label>Enter your email address
								<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
							</label>
						</div>
						<div class='button__container'>
							<button type="submit">Confirm</button>
						</div>
					<?php elseif ($_GET['error'] ?? '' === "invalid_token"): ?>
						<p class="error">Invalid or expired token! <a href="reset-password.php">Please request a new reset link.</a></p>
					<?php elseif ($_GET['success'] ?? '' === "email_sent"): ?>
						<p class="success">Email sent successfully! Click the link in your email to proceed.</p>
					<?php else: ?>
						<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
						<div>
							<label>Enter your email address
								<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
							</label>
						</div>
						<div class='button__container'>
							<button type="submit">Confirm</button>
						</div>
					<?php endif; ?>
				</form>
			<?php elseif (isset($_GET['token'], $user_id)): ?>
				<form id="resetpwdfrm" action="../../../php/reset-password.inc.php" method="POST" novalidate>
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
					<input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
					<div>
						<label>New Password
							<input type="password" name="new_password" id="new_password" autocomplete="new-password" placeholder="Enter your New Password" required>
						</label>
						<label>Confirm Password
							<input type="password" name="pwd_confirm" id="pwd_confirm" autocomplete="new-password" placeholder="Confirm your New Password" required>
						</label>
					</div>
					<div class='button__container'>
						<button type="submit">Change Password</button>
					</div>
				</form>
			<?php else: ?>
				<p class="error">Token validation failed. <a href="reset-password.php">Please request a new reset link.</a></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>