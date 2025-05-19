<?php

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true):

?>

	<nav>
		<div>
			<a href="#"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
		</div>
		<ul>
			<li><a href="../../index.html">Home</a></li>
			<li><a href="../../digital-walks.html">Digital Walks</a></li>
			<li><a href="../../about.html">About</a></li>
			<li><a href="../../contact.html">Contact</a></li>
		</ul>
		<div>
			<?php if (isset($_SESSION['sign_in_page']) && $_SESSION['sign_in_page']): ?>
				<a href="../pages/login.php" class="primary-btn">Login</a>
			<?php else: ?>
				<a href="../pages/signup.php" class="primary-btn">Sign up</a>
			<?php endif; ?>
			<button type="button"><i class="fa-solid fa-moon"></i></button>
		</div>
	</nav>

<?php else: ?>

	<nav>
		<div>
			<?php if ($_SESSION['index'] === true): ?>
				<a href="index.php"><img src="../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
			<?php else: ?>
				<a href="../index.php"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
			<?php endif; ?>
		</div>
		<ul>
			<!-- Index -->
			<?php if ($_SESSION['index'] === true): ?>
				<li><a href="#">Home</a></li>
			<?php else: ?>
				<li><a href="../index.php">Home</a></li>
			<?php endif; ?>
			<!-- Digital Walks -->
			<?php if ($_SESSION['index'] === true): ?>
				<li><a href="pages/digital-walks.php">Digital Walks</a></li>
			<?php else: ?>
				<li><a href="digital-walks.php">Digital Walks</a></li>
			<?php endif; ?>
			<!-- About -->
			<?php if ($_SESSION['index'] === true): ?>
				<li><a href="pages/about.php">About</a></li>
			<?php else: ?>
				<li><a href="about.php">About</a></li>
			<?php endif; ?>
			<!-- Contact -->
			<?php if ($_SESSION['index'] === true): ?>
				<li><a href="pages/contact.php">Contact</a></li>
			<?php else: ?>
				<li><a href="contact.php">Contact</a></li>
			<?php endif; ?>
		</ul>
		<div>
			<button type="button" class="profile__menu"><i class="fa-solid fa-user"></i></button>
			<button type="button"><i class="fa-solid fa-moon"></i></button>
		</div>
	</nav>

<?php endif; ?>