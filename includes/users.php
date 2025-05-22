<?php
// Connect to database and fetch user data
include 'db_conn.php'; // Include your database connection file

$sql = "SELECT * FROM users WHERE activated = 'Yes'"; // SQL query to fetch all users
$result = mysqli_query($link, $sql); // Execute query and store result

// Fetch user data into an array
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Close database connection
mysqli_close($link);
?>