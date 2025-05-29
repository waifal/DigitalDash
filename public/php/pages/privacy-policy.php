<?php
session_start();

$_SESSION['index'] = false;
$_SESSION['privacy_policy'] = true;
$_SESSION['terms_and_conditions'] = false;
$_SESSION['sign_in_page'] = false;
$_SESSION['digital_walks'] = false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main class="privacy-page">
	<div class="content-wrapper">
		<h1>Privacy Policy</h1>
		<p class="last-updated">Last Updated: <?php echo date('F d, Y'); ?></p>
		<hr>
		<br>
		<br>
		<section class="privacy-section">
			<h2>1. Introduction</h2>
			<p>This privacy policy explains how we collect, use, disclose and protect your personal information in accordance with the Privacy Act 2020.</p>
		</section>
		<section class="privacy-section">
			<h2>2. Information We Collect</h2>
			<p>We collect personal information directly from you when you:</p>
			<ul>
				<li>Create an account</li>
				<li>Use our services</li>
				<li>Contact us</li>
			</ul>
		</section>
		<section class="privacy-section">
			<h2>3. Purpose of Collection</h2>
			<p>We collect and use your personal information for lawful purposes, including:</p>
			<ul>
				<li>Providing and improving our services</li>
				<li>Communicating with you</li>
				<li>Ensuring security of our services</li>
				<li>Meeting our legal obligations</li>
			</ul>
		</section>
		<section class="privacy-section">
			<h2>4. Storage and Security</h2>
			<p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, loss, or misuse.</p>
		</section>
		<section class="privacy-section">
			<h2>5. Your Rights</h2>
			<p>Under the Privacy Act 2020, you have the right to:</p>
			<ul>
				<li>Access your personal information</li>
				<li>Request correction of your information</li>
				<li>Be informed of data breaches that may cause serious harm</li>
				<li>Know how your information is being used</li>
			</ul>
		</section>
		<section class="privacy-section">
			<h2>6. Cookies and Tracking</h2>
			<p>We use cookies to enhance your browsing experience. You can control cookie preferences through your browser settings.</p>
		</section>
		<section class="privacy-section">
			<h2>7. Overseas Transfers</h2>
			<p>If we transfer your information overseas, we ensure that appropriate safeguards are in place to protect your information.</p>
		</section>
		<section class="privacy-section">
			<h2>8. Contact Us</h2>
			<p>For privacy-related inquiries or to exercise your rights under the Privacy Act 2020, please contact our Privacy Officer at <a href="mailto:Digitaldashmedianz@gmail.com">Digitaldashmedianz@gmail.com</a>.</p>
		</section>
	</div>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>