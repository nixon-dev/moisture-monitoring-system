<?php
// Connect to the database
include '../includes/db_conn.php';

// Get the ID of the user to delete
$ids = $_GET['id'];

// Delete the user from the database
$query = "DELETE FROM users WHERE id = $ids";
mysqli_query($link, $query);


$message = "Deleted Successfully!";
header("Location: ../admin/activate.php?message=" . urlencode($message));
?>