<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

// Check if the user has completed their profile
$sql = "SELECT * FROM users WHERE user_id='$user_id' AND profile_picture IS NOT NULL AND interests IS NOT NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Award "Profile Completer" badge
    $badge_name = "Profile Completer";
    $sql = "INSERT INTO user_badges (user_id, badge_name) VALUES ('$user_id', '$badge_name')";
    $conn->query($sql);
}

// Check if the user has sent 10 messages
$sql = "SELECT COUNT(*) AS message_count FROM user_interactions WHERE user_id='$user_id' AND interaction_type='message'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['message_count'] >= 10) {
    // Award "Chatterbox" badge
    $badge_name = "Chatterbox";
    $sql = "INSERT INTO user_badges (user_id, badge_name) VALUES ('$user_id', '$badge_name')";
    $conn->query($sql);
}
?>
