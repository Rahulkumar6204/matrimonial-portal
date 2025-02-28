<?php
session_start();
include 'db_connection.php';
require 'vendor/autoload.php';

use Google\Client;
use Google\Service\Oauth2;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_token = $_POST['id_token'];

    $client = new Client();
    $client->setClientId('YOUR_GOOGLE_CLIENT_ID');
    $client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');
    $payload = $client->verifyIdToken($id_token);

    if ($payload) {
        $user_id = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'];

        // Check if user already exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Log the user in
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            header("Location: dashboard.php");
        } else {
            // Register the user
            $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['name'] = $name;
                header("Location: dashboard.php");
            }
        }
    } else {
        $_SESSION['error'] = "Invalid ID token!";
        header("Location: register.php");
    }

    $conn->close();
}
?>
