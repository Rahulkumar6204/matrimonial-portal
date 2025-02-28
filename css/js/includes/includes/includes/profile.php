<?php
session_start();
include 'includes/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Matrimonial Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Profile</h2>
        <form action="includes/update_profile.php" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required readonly>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo $user['age']; ?>" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $user['location']; ?>" required>

            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion" value="<?php echo $user['religion']; ?>" required>

            <label for="caste">Caste:</label>
            <input type="text" id="caste" name="caste" value="<?php echo $user['caste']; ?>" required>

            <label for="interests">Interests:</label>
            <textarea id="interests" name="interests"><?php echo $user['interests']; ?></textarea>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            <?php if ($user['profile_picture']) : ?>
                <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="100">
            <?php endif; ?>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
