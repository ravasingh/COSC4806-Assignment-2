<?php
session_start();
require_once('user.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

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
            header("Location: login.php?error=Invalid username or password.");
            exit;
        }
    } else {
        header("Location: login.php?error=Please enter both username and password.");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>