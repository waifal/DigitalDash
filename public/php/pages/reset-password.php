<?php

session_start();

if (!isset($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// if ($_SESSION['logged_in'] === false) {
// 	header('Location: login.php');
// 	exit;
// }

$_SESSION['email_is_correct'] = false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main>
	<section class='auth__container'>
		<!-- Form -->
		<div>
			<h2>Reset Password</h2>
			<?php if (!$_SESSION['email_is_correct']): ?>
				<form id="resetpwdfrm" action="../../../php/check-email.inc.php" method="POST" novalidate>
					<!-- CSRF Token -->
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
					<!-- Password -->
					<div>
						<label>Enter your email address
							<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email address" required>
						</label>
					</div>
					<!-- Buttons -->
					<div class='button__container'>
						<button type="submit">Confirm</button>
					</div>
				</form>
			<?php else: ?>
				<form id="resetpwdfrm" action="../../../php/reset-password.php" method="POST" novalidate>
					<!-- CSRF Token -->
					<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
					<!-- Password -->
					<div>
						<label>Your Password
							<input type="password" name="password" id="password" autocomplete="current-password" placeholder="Enter your Password" required>
						</label>
						<label>New Password
							<input type="password" name="pwd_confirm" id="pwd_confirm" autocomplete="new-password" placeholder="Enter your New Password" required>
						</label>
						<label>Confirm Password
							<input type="password" name="pwd_confirm" id="pwd_confirm" autocomplete="new-password" placeholder="Confirm your New Password" required>
						</label>
					</div>
					<!-- Buttons -->
					<div class='button__container'>
						<button type="submit">Change Password</button>
					</div>
				</form>
			<?php endif; ?>
		</div>
		<!-- Background -->
		<div class='auth-col-bg'></div>
	</section>
</main>


<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>