<?php
session_start();
include 'includes/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$profile_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE user_id='$profile_id'";
$result = $conn->query($sql);
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile - Matrimonial Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2><?php echo $profile['name']; ?></h2>
        <p>Age: <?php echo $profile['age']; ?></p>
        <p>Location: <?php echo $profile['location']; ?></p>
        <p>Religion: <?php echo $profile['religion']; ?></p>
        <p>Caste: <?php echo $profile['caste']; ?></p>
        <p>Interests: <?php echo $profile['interests']; ?></p>
        <?php if ($profile['profile_picture']) : ?>
            <img src="<?php echo $profile['profile_picture']; ?>" alt="Profile Picture" width="200">
        <?php endif; ?>
    </div>
</body>
</html>
