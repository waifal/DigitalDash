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