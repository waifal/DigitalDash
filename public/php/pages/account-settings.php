<?php

session_start();

$_SESSION['index'] = false;
$_SESSION['digital_walks'] = false;

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
	header('Location: login.php'); // Change to index.html
	exit;
}
require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main>
	<section class="account-settings">
		<div class="center-div">
			<h1>Account Settings</h1>
			<form>
				<div class="flex">
					<label for="fname">First name:</label>
					<div class="split">
						<input type="text" id="fname" name="fname">
					</div>
				</div>
				<div class="flex">
					<label for="fname">Last Name</label>
					<div class="split">
						<input type="text" id="lname" name="lname">
					</div>
				</div>
				<div class="flex">
					<label for="femail">Email Address</label>
					<div class="split">
						<input type="text" id="Email" name="femail">
					</div>
				</div>
				<div class="flex">
					<label for="fpassword">Password</label>
					<div class="split">
						<input type="text" id="password" name="fpassword">
					</div>
				</div>
			</form>
			<div class="btn-div">
				<button class="save-btn">Save Settings</button>
				<button class="delete-btn">Delete Account</button>
				<button class="edit-btn">Edit</button>
			</div>
		</div>
	</section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>