<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $access_token = $_POST['access_token'];

    // Verify access token with Facebook Graph API
    $url = "https://graph.facebook.com/me?fields=id,name,email&access_token=$access_token";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['id'])) {
        $user_id = $data['id'];
        $email = $data['email'];
        $name = $data['name'];

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
        $_SESSION['error'] = "Invalid access token!";
        header("Location: register.php");
    }

    $conn->close();
}
?>
