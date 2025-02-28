<?php
session_start();
include 'includes/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all users except the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id != '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Matrimonial Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Search Profiles</h2>
        <form action="search.php" method="GET">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age">

            <label for="location">Location:</label>
            <input type="text" id="location" name="location">

            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion">

            <label for="caste">Caste:</label>
            <input type="text" id="caste" name="caste">

            <button type="submit">Search</button>
        </form>

        <div class="search-results">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="profile">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Age: <?php echo $row['age']; ?></p>
                    <p>Location: <?php echo $row['location']; ?></p>
                    <p>Religion: <?php echo $row['religion']; ?></p>
                    <p>Caste: <?php echo $row['caste']; ?></p>
                    <a href="view_profile.php?id=<?php echo $row['user_id']; ?>">View Profile</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
