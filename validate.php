<?php
require_once('user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if password and confirm password match
if ($password !== $confirm_password) {
    header("Location: register.php?error=Passwords do not match.");
    exit;
}

// Check if the password meets minimum security standards
if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    header("Location: register.php?error=Password must be at least 8 characters long and include at least one letter and one number.");
    exit;
}

// Check if the username already exists
$user = new User();
if ($user->user_exists($username)) {
    header("Location: register.php?error=Username already exists.");
    exit;
}

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Create the new user
$user->create_user($username, $hashed_password);

header("Location: login.php?success=Account created successfully.");
exit;

?>