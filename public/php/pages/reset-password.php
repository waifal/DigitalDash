<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// if ($_SESSION['logged_in'] === false) {
// 	header('Location: login.php');
// 	exit;
// }

$_SESSION['email_is_correct'] = $_SESSION['email_is_correct'] ?? false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main>
	<section class='auth__container'>
		<div>
			<h2>Reset Password</h2>
			<?php if (!$_SESSION['email_is_correct']): ?>
				<form id="resetpwdfrm" action="../../../php/check-email.inc.php" method="POST" novalidate>
					<?php
					if (isset($_GET['error']) && $_GET['error'] === "invalid_email") {
						echo "<span class='error'>Invalid email address. Please try again.</span>";
					}
					?>
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
					<div>
						<label>Enter your email address
							<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
						</label>
					</div>
					<div class='button__container'>
						<button type="submit">Confirm</button>
					</div>
				</form>
			<?php else: ?>
				<form id="resetpwdfrm" action="../../../php/reset-password.inc.php" method="POST" novalidate>
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
					<div>
						<label>Your Password
							<input type="password" name="password" id="password" autocomplete="current-password" placeholder="Enter your Password" required>
						</label>
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
			<?php endif; ?>
		</div>
		<div class='auth-col-bg'></div>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>