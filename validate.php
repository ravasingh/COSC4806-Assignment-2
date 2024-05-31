<?php
require_once('user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if password and confirm password match
if ($password !== $confirm_password) {
    die('Passwords do not match.');
}

// Check if the password meets minimum security standards
if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    die('Password must be at least 8 characters long and include at least one letter and one number.');
}

// Check if the username already exists
$user = new User();
if ($user->user_exists($username)) {
    die('Username already exists.');
}

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Create the new user
$user->create_user($username, $hashed_password);

header("Location: login.php");
exit;
?>