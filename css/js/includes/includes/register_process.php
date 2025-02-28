<?php
session_start();
include 'db_connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $religion = $_POST['religion'];
    $caste = $_POST['caste'];
    $interests = $_POST['interests'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Handle profile picture upload
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
        $profile_picture = $target_file;
    }

    // Insert user into database
    $sql = "INSERT INTO users (name, email, password, gender, age, location, religion, caste, interests, profile_picture, ip_address)
            VALUES ('$name', '$email', '$password', '$gender', '$age', '$location', '$religion', '$caste', '$interests', '$profile_picture', '$ip_address')";

    if ($conn->query($sql) === TRUE) {
        // Send welcome email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@gmail.com';
            $mail->Password = 'your-email-password';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('your-email@gmail.com', 'Matrimonial Portal');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Matrimonial Portal';
            $mail->Body = "Hi $name,<br><br>Thank you for registering with us!<br><br>Best regards,<br>Matrimonial Portal Team";

            $mail->send();
            $_SESSION['message'] = "Registration successful! Please check your email.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Email could not be sent. Error: " . $mail->ErrorInfo;
        }
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }

    header("Location: ../register.php");
    $conn->close();
}
?>
