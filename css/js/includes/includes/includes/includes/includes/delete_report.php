<?php
session_start();
include 'includes/db_connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$report_id = $_GET['id'];
$sql = "DELETE FROM reports WHERE report_id='$report_id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Report deleted successfully!";
} else {
    $_SESSION['error'] = "Error deleting report: " . $conn->error;
}

header("Location: admin_dashboard.php");
$conn->close();
?>
