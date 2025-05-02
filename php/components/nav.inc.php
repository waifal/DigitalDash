<?php

session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['logged_in'])):

?>

	<nav>
		<div>
			<img src="" alt="DigitalDash Logo">
		</div>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Virtual Walks</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
		<div>
			<a href="#">Sign in</a>
			<button type="button"><i class="fa-solid fa-moon"></i></button>
		</div>
	</nav>

<?php else: ?>

	<nav>
		<div>
			<img src="" alt="DigitalDash Logo">
		</div>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Virtual Walks</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
		<div>
			<button type="button"><i class="fa-solid fa-user"></i></button>
			<button type="button"><i class="fa-solid fa-moon"></i></button>
		</div>
	</nav>

<?php endif; ?>