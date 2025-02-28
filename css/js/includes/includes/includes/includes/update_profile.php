<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $religion = $_POST['religion'];
    $caste = $_POST['caste'];
    $interests = $_POST['interests'];

    // Handle profile picture upload
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
        $profile_picture = $target_file;
    }

    // Update user data
    $sql = "UPDATE users SET
            name='$name',
            age='$age',
            location='$location',
            religion='$religion',
            caste='$caste',
            interests='$interests'";

    if (!empty($profile_picture)) {
        $sql .= ", profile_picture='$profile_picture'";
    }

    $sql .= " WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating profile: " . $conn->error;
    }

    header("Location: ../profile.php");
    $conn->close();
}
?>
