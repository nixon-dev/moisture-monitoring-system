<?php
// Connect to database and fetch user data
include 'db_conn.php'; // Include your database connection file

$bedname = $_GET['bed'];

$sql = "SELECT * FROM logs WHERE bedname = '$bedname' ORDER BY logdate ASC"; // SQL query to fetch all bed1
$result = mysqli_query($link, $sql); // Execute query and store result

// Fetch user data into an array
$logs = array();
while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
}

// Close database connection
mysqli_close($link);
?>