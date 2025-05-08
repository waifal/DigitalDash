<?php
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}

if ($_SESSION['logged_in'] === true) {
    header('Location: ../index.php');
    exit;
}

$_SESSION['index'] = false;
$_SESSION['sign_in_page'] = true;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main id="main-content" role="main">
    <section class="auth__container col-2" aria-labelledby="signup-heading">
        <!-- Form -->
        <div class="signup-form-container">
            <form id="signupfrm" 
                  action="../../../php/signup.inc.php" 
                  method="POST" 
                  novalidate 
                  aria-labelledby="form-heading">
                  
                <h2 id="form-heading" class="visually-hidden">Sign up</h2>
                <p>Join today to unlock breathtaking views and immersive trails, experiencing the beauty of nature like never before - right from your screen.</p>
                
                <!-- Error Messages -->
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="error">
                        <?php 
                        foreach ($_SESSION['errors'] as $field => $error) {
                            echo "<p>$error</p>";
                        }
                        unset($_SESSION['errors']);
                        ?>
                    </div>
                <?php endif; ?>

                <!-- CSRF Token -->
                <input type="hidden" 
                       name="csrf_token" 
                       value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <!-- Names -->
                <div class="form-group names-group">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" 
                               name="fname" 
                               id="fname" 
                               autocomplete="given-name" 
                               placeholder="Enter your first name" 
                               value="<?php echo isset($_SESSION['form_data']['fname']) ? htmlspecialchars($_SESSION['form_data']['fname']) : ''; ?>"
                               required 
                               aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" 
                               name="lname" 
                               id="lname" 
                               autocomplete="family-name" 
                               placeholder="Enter your last name" 
                               value="<?php echo isset($_SESSION['form_data']['lname']) ? htmlspecialchars($_SESSION['form_data']['lname']) : ''; ?>"
                               required 
                               aria-required="true">
                    </div>
                </div>
                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           autocomplete="email" 
                           placeholder="Enter your email address" 
                           required 
                           aria-required="true">
                </div>
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Your Password</label>
                    <div class="password__container">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               autocomplete="new-password" 
                               placeholder="Enter your password" 
                               required 
                               aria-required="true">
                        <button type="button" 
                                class="show_password" 
                                tabindex="-1" 
                                aria-label="Toggle password visibility">
                            <i class="fa-solid fa-eye-low-vision" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd_confirm">Confirm Password</label>
                    <div class="password__container">
                        <input type="password" 
                               name="pwd_confirm" 
                               id="pwd_confirm" 
                               autocomplete="new-password" 
                               placeholder="Confirm your password" 
                               required 
                               aria-required="true">
                        <button type="button" 
                                class="show_password" 
                                tabindex="-1" 
                                aria-label="Toggle password visibility">
                            <i class="fa-solid fa-eye-low-vision" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <!-- Agreements -->
                <div class="form-group agreements">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" 
                               name="terms_and_conditions" 
                               id="terms_and_conditions" 
                               value="agree" 
                               required 
                               aria-required="true">
                        <label for="terms_and_conditions">
                            I agree to the <a href="terms-and-conditions.php" target="_blank">Terms & Conditions</a>
                        </label>
                    </div>
                    <div class="checkbox-wrapper">
                        <input type="checkbox" 
                               name="privacy_policy" 
                               id="privacy_policy" 
                               value="agree" 
                               required 
                               aria-required="true">
                        <label for="privacy_policy">
                            I agree to the <a href="privacy-policy.php" target="_blank">Privacy Policy</a>
                        </label>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="button__container">
                    <button type="submit" class="button">Sign up</button>
                    <a href="../pages/login.php" class="button" role="button">Login</a>
                </div>
            </form>
        </div>
    </section>
</main>

<?php 
unset($_SESSION['form_data']); // Clean up session data
require_once(__DIR__ . '/../components/footer.inc.php'); 
?>