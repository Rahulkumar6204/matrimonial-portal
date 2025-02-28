<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Matrimonial Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="includes/register_process.php" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion" required>

            <label for="caste">Caste:</label>
            <input type="text" id="caste" name="caste" required>

            <label for="interests">Interests:</label>
            <textarea id="interests" name="interests"></textarea>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
