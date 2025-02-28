<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_id = $_POST['payment_id'];
    $amount = $_POST['amount'];
    $user_id = $_POST['user_id'];

    // Insert payment details into database
    $sql = "INSERT INTO payments (payment_id, amount, user_id) VALUES ('$payment_id', '$amount', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        // Activate premium features for the user
        $sql = "UPDATE users SET is_premium=1 WHERE user_id='$user_id'";
        $conn->query($sql);
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
}
?>
