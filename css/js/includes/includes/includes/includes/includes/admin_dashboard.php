<?php
session_start();
include 'includes/db_connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all users
$sql = "SELECT * FROM users";
$users = $conn->query($sql);

// Fetch all reports
$sql = "SELECT * FROM reports";
$reports = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Matrimonial Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>

        <h3>Users</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>IP Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $users->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['ip_address']; ?></td>
                        <td>
                            <a href="delete_user.php?id=<?php echo $row['user_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Reports</h3>
        <table>
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Reported User</th>
                    <th>Reporter User</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $reports->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['report_id']; ?></td>
                        <td><?php echo $row['reported_user_id']; ?></td>
                        <td><?php echo $row['reporter_user_id']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td>
                            <a href="delete_report.php?id=<?php echo $row['report_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
