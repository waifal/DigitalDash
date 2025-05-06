<?php

if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true):

?>

	<nav>
		<div>
			<a href="#"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
		</div>
		<ul>
			<li><a href="../../index.html">Home</a></li>
			<li><a href="#">Virtual Walks</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
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
			<a href="#"><img src="../../assets/images/logo/logo_color_transparent_png.png" alt="DigitalDash Logo"></a>
		</div>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Virtual Walks</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
		<div>
			<button type="button" class="profile__menu"><i class="fa-solid fa-user"></i></button>
			<button type="button"><i class="fa-solid fa-moon"></i></button>
		</div>
	</nav>

<?php endif; ?>