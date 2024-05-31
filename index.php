<?php
require_once('header.php');
require_once('user.php');

$user = new User();
$user_list = $user->get_all_users();

echo "<pre>";
print_r($user_list);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ravanpreet Singh</title>
</head>
<body>
    <header>
        <h1>Assignment - 2</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p><a href="logout.php">Click here to Logout</a></p>
    </header>
    <main>
        <h2>Good Morning!</h2>
    </main>
</body>
</html>