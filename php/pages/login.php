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
				<h2>Your Adventure Resumes Here</h2>
				<p>Sign in to access immersive trails, stunning landscapes, and a walking experience designed for clarity and wellbeing.</p>
				<form id="loginfrm" action="../includes/login.inc.php" method="POST">
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
					</div>
					<!-- Buttons -->
					<div class='button__container'>
						<a href="../includes/login.inc.php">Login</a>
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
</body>

</html>