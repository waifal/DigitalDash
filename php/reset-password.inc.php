<?php

require_once(__DIR__ . '/includes/functions.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = validate_password($_POST['new_password'] ?? '');
    $pwd_confirm = $_POST['pwd_confirm'] ?? '';
    $token = $_POST['token'] ?? '';

    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized request.");
    }

    $result = reset_password($_SESSION['user_id'], $token, $new_password, $pwd_confirm);

    if ($result === true) {
        $_SESSION['password_reset'] = true;
        header('Location: ../public/php/pages/login.php?password=success');
        exit;
    } else {
        echo $result;
    }
}
