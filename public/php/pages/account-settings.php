<?php
session_start();

$_SESSION['index'] = false;
$_SESSION['digital_walks'] = false;
$_SESSION['account-settings'] = true;

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
	header('Location: login.php');
	exit;
}

require_once(__DIR__ . '/../../../php/includes/connection.inc.php'); // Adjust path as needed

$message = '';
$messageType = '';

$stmt = mysqli_prepare($connection, "SELECT firstname, lastname, email FROM tbl_user WHERE user_id = ?");
if ($stmt) {
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$user = mysqli_fetch_assoc($result);
	mysqli_stmt_close($stmt);

	if (!$user) {
		header('Location: login.php');
		exit;
	}
} else {
	$message = "Error loading user data.";
	$messageType = "error";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case 'update':
				$firstname = trim($_POST['fname']);
				$lastname = trim($_POST['lname']);
				$email = trim($_POST['femail']);
				$password = $_POST['fpassword'] ?? '';

				$errors = [];

				if (empty($firstname)) {
					$errors[] = "First name is required.";
				}

				if (empty($lastname)) {
					$errors[] = "Last name is required.";
				}

				if (empty($email)) {
					$errors[] = "Email is required.";
				} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$errors[] = "Invalid email format.";
				}

				if (empty($errors)) {
					$stmt = mysqli_prepare($connection, "SELECT user_id FROM tbl_user WHERE email = ? AND user_id != ?");
					if ($stmt) {
						mysqli_stmt_bind_param($stmt, "si", $email, $_SESSION['user_id']);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						if (mysqli_fetch_assoc($result)) {
							$errors[] = "Email is already in use by another account.";
						}
						mysqli_stmt_close($stmt);
					} else {
						$errors[] = "Database error occurred.";
					}
				}

				if (empty($errors)) {
					if (!empty($password)) {
						$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
						$stmt = mysqli_prepare($connection, "UPDATE tbl_user SET firstname = ?, lastname = ?, email = ?, password = ? WHERE user_id = ?");
						if ($stmt) {
							mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $email, $hashedPassword, $_SESSION['user_id']);
							$success = mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						} else {
							$success = false;
						}
					} else {
						$stmt = mysqli_prepare($connection, "UPDATE tbl_user SET firstname = ?, lastname = ?, email = ? WHERE user_id = ?");
						if ($stmt) {
							mysqli_stmt_bind_param($stmt, "sssi", $firstname, $lastname, $email, $_SESSION['user_id']);
							$success = mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						} else {
							$success = false;
						}
					}

					if ($success) {
						$user['firstname'] = $firstname;
						$user['lastname'] = $lastname;
						$user['email'] = $email;

						$message = "Account settings updated successfully!";
						$messageType = "success";
					} else {
						$message = "Error updating account settings.";
						$messageType = "error";
					}
				} else {
					$message = implode(" ", $errors);
					$messageType = "error";
				}
				break;

			case 'delete':
				$confirmPassword = $_POST['confirm_password'] ?? '';

				if (empty($confirmPassword)) {
					$message = "Please enter your password to confirm account deletion.";
					$messageType = "error";
				} else {
					$stmt = mysqli_prepare($connection, "SELECT password FROM tbl_user WHERE user_id = ?");
					if ($stmt) {
						mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$userData = mysqli_fetch_assoc($result);
						mysqli_stmt_close($stmt);

						if ($userData && password_verify($confirmPassword, $userData['password'])) {
							$stmt = mysqli_prepare($connection, "DELETE FROM tbl_user WHERE user_id = ?");
							if ($stmt) {
								mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
								$success = mysqli_stmt_execute($stmt);
								mysqli_stmt_close($stmt);

								if ($success) {
									session_destroy();
									header('Location: login.php?account_deleted=1');
									exit;
								} else {
									$message = "Error deleting account.";
									$messageType = "error";
								}
							} else {
								$message = "Error deleting account.";
								$messageType = "error";
							}
						} else {
							$message = "Incorrect password. Account not deleted.";
							$messageType = "error";
						}
					} else {
						$message = "Error deleting account.";
						$messageType = "error";
					}
				}
				break;
		}
	}
}

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<style>
	.message {
		padding: 10px;
		margin: 10px 0;
		border-radius: 4px;
		text-align: center;
	}

	.message.success {
		background-color: #d4edda;
		color: #155724;
		border: 1px solid #c3e6cb;
	}

	.message.error {
		background-color: #f8d7da;
		color: #721c24;
		border: 1px solid #f5c6cb;
	}

	.form-disabled input {
		border: 1px solid #dee2e6;
		cursor: not-allowed;
	}

	.form-disabled input:focus {
		outline: none;
		box-shadow: none;
	}

	.modal {
		color: #111;
		display: none;
		position: fixed;
		z-index: 1000;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
	}

	.modal-content {
		background-color: #fefefe;
		margin: 15% auto;
		padding: 20px;
		border: 1px solid #888;
		border-radius: 8px;
		width: 400px;
		max-width: 90%;
	}

	.modal-buttons {
		display: flex;
		gap: 10px;
		justify-content: flex-end;
		margin-top: 20px;
	}

	.modal-buttons button {
		padding: 8px 16px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	.btn-confirm {
		background-color: #dc3545;
		color: white;
	}

	.btn-cancel {
		background-color: #6c757d;
		color: white;
	}
</style>

<main>
	<section class="account-settings">
		<div class="center-div">
			<h1>Account Settings</h1>

			<?php if ($message): ?>
				<div class="message <?php echo $messageType; ?>">
					<?php echo htmlspecialchars($message); ?>
				</div>
			<?php endif; ?>

			<form id="settingsForm" method="POST" class="form-disabled">
				<input type="hidden" name="action" value="update">

				<div class="flex">
					<label for="fname">First name:</label>
					<div class="split">
						<input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user['firstname']); ?>" readonly>
					</div>
				</div>

				<div class="flex">
					<label for="lname">Last Name:</label>
					<div class="split">
						<input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user['lastname']); ?>" readonly>
					</div>
				</div>

				<div class="flex">
					<label for="femail">Email Address:</label>
					<div class="split">
						<input type="email" id="femail" name="femail" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
					</div>
				</div>

				<div class="flex">
					<label for="fpassword">New Password:</label>
					<div class="split">
						<input type="password" id="fpassword" name="fpassword" placeholder="Leave blank to keep current password" readonly>
					</div>
				</div>
			</form>

			<div class="btn-div">
				<button type="button" class="save-btn" id="saveBtn" style="display: none;">Save Settings</button>
				<button type="button" class="delete-btn" id="deleteBtn">Delete Account</button>
				<button type="button" class="edit-btn" id="editBtn">Edit</button>
				<button type="button" class="edit-btn" id="cancelBtn" style="display: none;">Cancel</button>
			</div>
		</div>
	</section>
</main>

<div id="deleteModal" class="modal">
	<div class="modal-content">
		<h3>Confirm Account Deletion</h3>
		<p>Are you sure you want to delete your account? This action cannot be undone.</p>
		<form method="POST">
			<input type="hidden" name="action" value="delete">
			<div style="margin: 15px 0;">
				<label for="confirm_password">Enter your password to confirm:</label>
				<input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; margin-top: 5px; padding: 8px;">
			</div>
			<div class="modal-buttons">
				<button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
				<button type="submit" class="btn-confirm">Delete Account</button>
			</div>
		</form>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const form = document.getElementById('settingsForm');
		const editBtn = document.getElementById('editBtn');
		const saveBtn = document.getElementById('saveBtn');
		const cancelBtn = document.getElementById('cancelBtn');
		const deleteBtn = document.getElementById('deleteBtn');
		const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');

		let originalValues = {};

		inputs.forEach(input => {
			originalValues[input.name] = input.value;
		});

		editBtn.addEventListener('click', function() {
			form.classList.remove('form-disabled');
			inputs.forEach(input => {
				input.removeAttribute('readonly');
			});

			editBtn.style.display = 'none';
			saveBtn.style.display = 'inline-block';
			cancelBtn.style.display = 'inline-block';
		});

		saveBtn.addEventListener('click', function() {
			const fname = document.getElementById('fname').value.trim();
			const lname = document.getElementById('lname').value.trim();
			const email = document.getElementById('femail').value.trim();

			if (!fname || !lname || !email) {
				alert('Please fill in all required fields.');
				return;
			}

			if (!isValidEmail(email)) {
				alert('Please enter a valid email address.');
				return;
			}

			form.submit();
		});

		cancelBtn.addEventListener('click', function() {
			inputs.forEach(input => {
				if (originalValues[input.name] !== undefined) {
					input.value = originalValues[input.name];
				} else {
					input.value = '';
				}
			});

			form.classList.add('form-disabled');
			inputs.forEach(input => {
				input.setAttribute('readonly', true);
			});

			editBtn.style.display = 'inline-block';
			saveBtn.style.display = 'none';
			cancelBtn.style.display = 'none';
		});

		deleteBtn.addEventListener('click', function() {
			document.getElementById('deleteModal').style.display = 'block';
		});

		function isValidEmail(email) {
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return emailRegex.test(email);
		}
	});

	function closeDeleteModal() {
		document.getElementById('deleteModal').style.display = 'none';
		document.getElementById('confirm_password').value = '';
	}

	window.onclick = function(event) {
		const modal = document.getElementById('deleteModal');
		if (event.target === modal) {
			closeDeleteModal();
		}
	}
</script>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>