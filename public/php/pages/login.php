<?php
session_start();

require(__DIR__ . '/../../../php/includes/connection.inc.php');

$query = "DELETE FROM password_resets WHERE token = ?";
if ($stmt = $connection->prepare($query)) {
    $stmt->bind_param("s", $_SESSION['token']);
    $stmt->execute();
    $stmt->close();
}
unset($_SESSION['token']);

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ../index.php');
    exit;
}

$_SESSION['index'] = false;
$_SESSION['sign_in_page'] = false;

require_once(__DIR__ . '/../components/header.inc.php');
require_once(__DIR__ . '/../components/nav.inc.php');
?>

<main id="main-content" role="main">
    <section class="auth__container col-2" aria-labelledby="login-heading">
        <!-- Form -->
        <div class="login-form-container">
            <form id="loginfrm" 
                  action="../../../php/login.inc.php" 
                  method="POST" 
                  novalidate 
                  aria-labelledby="form-heading">
                
                <h2 id="form-heading" class="visually-hidden">Login</h2>
                <p>Sign in to access immersive trails, stunning landscapes, and a walking experience designed for clarity and wellbeing.</p>
            
                <?php if (isset($_GET['password']) && $_GET['password'] === "success"): ?>
                    <p class="success" role="alert">Your password has been successfully updated!</p>
                <?php endif; ?>

                <!-- CSRF Token -->
                <input type="hidden" 
                       name="csrf_token" 
                       value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
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
                               autocomplete="current-password" 
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
                    <a href="../pages/reset-password.php" class="forgot-password">Forgot Password?</a>
                </div>
                <!-- Buttons -->
                <div class="button__container">
                    <button type="submit" class="button">Login</button>
                    <a href="../pages/signup.php" class="button" role="button">Sign up</a>
                </div>
            </form>
        </div>
    </section>
</main>

<?php require_once(__DIR__ . '/../components/footer.inc.php'); ?>