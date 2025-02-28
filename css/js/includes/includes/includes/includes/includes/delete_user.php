<?php
session_start();
include 'includes/db_connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$user_id = $_GET['id'];
$sql = "DELETE FROM users WHERE user_id='$user_id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "User deleted successfully!";
} else {
    $_SESSION['error'] = "Error deleting user: " . $conn->error;
}

header("Location: admin_dashboard.php");
$conn->close();
?>
