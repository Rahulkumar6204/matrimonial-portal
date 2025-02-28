<?php
session_start();
include 'db_connection.php';

// Load the trained model
$model = joblib.load('matchmaking_model.pkl');

// Fetch all users except the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id != '$user_id'";
$result = $conn->query($sql);

// Predict compatibility scores
$matches = [];
while ($row = $result->fetch_assoc()) {
    $predicted_score = $model.predict($user_id, $row['user_id']).est;
    $matches[] = [
        'user_id' => $row['user_id'],
        'name' => $row['name'],
        'age' => $row['age'],
        'location' => $row['location'],
        'score' => $predicted_score,
    ];
}

// Sort matches by score
usort($matches, function ($a, $b) {
    return $b['score'] <=> $a['score'];
});

// Display top 10 matches
foreach (array_slice($matches, 0, 10) as $match) {
    echo "<div class='match'>
            <h3>{$match['name']}</h3>
            <p>Age: {$match['age']}</p>
            <p>Location: {$match['location']}</p>
            <p>Compatibility: {$match['score']}%</p>
          </div>";
}
?>
