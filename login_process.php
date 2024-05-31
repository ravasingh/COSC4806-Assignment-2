<?php
session_start();
require_once('user.php');

$username = $_POST['username'];
$password = $_POST['password'];

$user = new User();
$users = $user->get_all_users();
$authenticated = false;

foreach ($users as $existing_user) {
    if ($existing_user['username'] === $username && password_verify($password, $existing_user['password'])) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $authenticated = true;
        break;
    }
}

if ($authenticated) {
    header("Location: index.php");
    exit;
} else {
    if (isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts']++;
    } else {
        $_SESSION['login_attempts'] = 1;
    }
    header("Location: login.php");
    exit;
}
?>