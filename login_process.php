<?php
session_start();
require_once('user.php');

$username = $_POST['username'];
$password = $_POST['password'];

$user = new User();
if ($user->verify_user($username, $password)) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $username;
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