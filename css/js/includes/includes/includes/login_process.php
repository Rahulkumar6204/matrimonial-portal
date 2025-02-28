<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            header("Location: ../profile.php");
        } else {
            $_SESSION['error'] = "Invalid password!";
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['error'] = "User not found!";
        header("Location: ../login.php");
    }

    $conn->close();
}
?>
