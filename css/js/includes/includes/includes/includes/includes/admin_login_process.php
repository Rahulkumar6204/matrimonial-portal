<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin credentials (for demonstration purposes)
    $admin_username = "admin";
    $admin_password = "admin123";

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: ../admin_dashboard.php");
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: ../admin_login.php");
    }
}
?>
