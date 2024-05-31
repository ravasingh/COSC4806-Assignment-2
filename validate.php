<?php
require_once('user.php');

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if password and confirm password match
if ($password !== $confirm_password) {
    die('Passwords do not match.');
}

// Check if the username already exists
$user = new User();
$users = $user->get_all_users();

foreach ($users as $existing_user) {
    if ($existing_user['username'] === $username) {
        die('Username already exists.');
    }
}

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// Create the new user
$user->create_user($username, $hashed_password);

header("Location: login.php");
exit;
?>
