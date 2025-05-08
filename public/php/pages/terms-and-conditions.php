<?php
    $_SESSION['index'] = false;
    $_SESSION['sign_in_page'] = false;

    require_once(__DIR__ . '/../components/header.inc.php');
    require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main class="terms-page">
    <div class="content-wrapper">
        <h1>Terms and Conditions</h1>
        <p class="last-updated">Last Updated: <?php echo date('F d, Y'); ?></p>
        <hr>
        <br>
        <br>
        <section class="terms-section">
            <h2>1. Agreement to Terms</h2>
            <p>By accessing and using DigitalDash, you agree to be bound by these Terms and Conditions. If you disagree with any part of these terms, you may not access our services.</p>
        </section>
        <section class="terms-section">
            <h2>2. Intellectual Property Rights</h2>
            <p>All content on this website, including but not limited to text, graphics, logos, images, and software, is the property of DigitalDash and is protected by intellectual property laws.</p>
        </section>
        <section class="terms-section">
            <h2>3. User Account</h2>
            <p>To access certain features of our service, you must create an account. You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.</p>
        </section>
        <section class="terms-section">
            <h2>4. Acceptable Use</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Use the service for any illegal purpose</li>
                <li>Submit false or misleading information</li>
                <li>Interfere with the proper functioning of the service</li>
                <li>Attempt to gain unauthorized access to our systems</li>
            </ul>
        </section>
        <section class="terms-section">
            <h2>5. Privacy Policy</h2>
            <p>Your use of DigitalDash is also governed by our Privacy Policy. Please review our Privacy Policy to understand our practices.</p>
        </section>
        <section class="terms-section">
            <h2>6. Limitation of Liability</h2>
            <p>DigitalDash and its employees shall not be held liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use or inability to use the service.</p>
        </section>
        <section class="terms-section">
            <h2>7. Changes to Terms</h2>
            <p>We reserve the right to modify these terms at any time. We will notify users of any material changes via email or through our website.</p>
        </section>
        <section class="terms-section">
            <h2>8. Contact Information</h2>
            <p>If you have any questions about these Terms and Conditions, please contact us at <a href="mailto:Digitaldashmedianz@gmail.com">Digitaldashmedianz@gmail.com</a>.</p>
        </section>
    </div>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>