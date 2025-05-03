<?php

session_start();

/* 
 * Ensure session login state is properly set:
 * - Check if 'user_id' is unset
 * - Verify if 'logged_in' is explicitly set to false
 * - Ensure 'logged_in' is not empty
 * - Default to false for consistency
 */

if (empty($_SESSION["user_id"]) || empty($_SESSION["logged_in"])) {
	$_SESSION["logged_in"] = false;
}

/* 
 * Handle user authentication state:
 * - Redirect authenticated users to the homepage
 * - Allow unauthenticated users to proceed with signup
 * - Ensure consistency with a fallback default case
 */

switch ($_SESSION["logged_in"]) {
	case true:
		header("Location: ../public/php/index.php");
		exit;
	case false:
		break;
	default:
		$_SESSION["logged_in"] = false;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DigitalDash</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
	<link rel="stylesheet" href="../../css/styles.css">
</head>

<body>
	<!-- Navigation -->
	<?php require_once(__DIR__ . '/../components/nav.inc.php'); ?>

	<main>
		<section class='auth__container'>
			<!-- Form -->
			<div>
				<h2>Explore the Wild, Anywhere.</h2>
				<p>Join today to unlock breathtaking views and immersive trails, experiencing the beauty of nature like never before - right from your screen.</p>
				<form id="signupfrm" action="../../../php/signup.php" method="POST" novalidate>
					<!-- Names -->
					<div>
						<label>First Name
							<input type="text" name="fname" id="fname" autocomplete="given-name" placeholder="Enter your First Name" required>
						</label>
						<label>Last Name
							<input type="text" name="lname" id="lname" autocomplete="family-name" placeholder="Enter your Last Name" required>
						</label>
					</div>
					<!-- Email Address -->
					<div>
						<label>Email Address
							<input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your Email Address" required>
						</label>
					</div>
					<!-- Password -->
					<div>
						<label>Your Password
							<input type="password" name="password" id="password" autocomplete="new-password" placeholder="Enter your Password" required>
						</label>
						<label>Confirm Password
							<input type="password" name="pwd_confirm" id="pwd_confirm" autocomplete="new-password" placeholder="Confirm your Password" required>
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
						<button type="submit">Sign up</button>
						<a href="../pages/login.php">Login</a>
					</div>
				</form>
			</div>
			<!-- Background -->
			<div class='auth-col-bg'></div>
		</section>
	</main>

	<!-- Footer -->
	<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>
</body>

</html>