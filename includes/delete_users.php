<?php
// Connect to the database
include '../includes/db_conn.php';

// Get the ID of the user to delete
$ids = $_GET['id'];

// Delete the user from the database
$query = "UPDATE users SET activated='No' WHERE id = $ids";
mysqli_query($link, $query);


$message = "Deleted Successfully!";
header("Location: ../admin/users.php?message=" . urlencode($message));
?>