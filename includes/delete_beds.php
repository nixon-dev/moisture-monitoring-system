<?php
// Connect to the database
include '../includes/db_conn.php';

// Get the latest bedname from the beds table
$findbedname = "SELECT * FROM beds ORDER BY bedname DESC LIMIT 1";
$result = mysqli_query($link, $findbedname);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $bedname = $row['bedname'];

    // Delete the latest bed from the beds table
    $deletebed = "DELETE FROM beds WHERE bedname = '$bedname'";
    $result = mysqli_query($link, $deletebed);

    // Delete related records from logs and bedschedules tables
    $deletelogs = "DELETE FROM logs WHERE bedname = '$bedname'";
    mysqli_query($link, $deletelogs);
    $deletescheds = "DELETE FROM bedschedules WHERE bedname = '$bedname'";
    mysqli_query($link, $deletescheds);

    if ($result) {
        $message = "Deleted successfully!";
        header("Location: ../admin/index.php?message=" . urlencode($message));
    } else {
        $message = "Error deleting the record.";
        header("Location: ../admin/index.php?message=" . urlencode($message));
    }
} else {
    $message = "No records found to delete";
    header("Location: ../admin/index.php?message=" . urlencode($message));
}
?>
