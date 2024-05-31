<?php
require_once('database.php');

class User {
    public function get_all_users() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function create_user($username, $password) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password);");
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();
    }

    public function user_exists($username) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username;");
        $statement->bindParam(':username', $username);
        $statement->execute();
        return $statement->rowCount() > 0;
    }

    public function verify_user($username, $password) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username;");
        $statement->bindParam(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
?>