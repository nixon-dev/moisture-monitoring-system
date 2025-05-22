<?php
// Connect to the database
include '../includes/db_conn.php';

// Get the ID of the user to delete
$ids = $_GET['id'];

// Delete the user from the database

$sql = "SELECT * FROM bedschedules WHERE id = $ids";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $bedname = $row['bedname'];


        $query = "DELETE FROM bedschedules WHERE id = $ids";
        $res = mysqli_query($link, $query);
        if ($res) {

            $message = "Deleted Successfully!";
            header("Location: ../admin/schedules.php?id=" . urlencode($bedname) . "&msg=" . urlencode($message));
        } 
    }
}else{
    $message = "Deleted Unsuccessfully!";
    header("Location: ../admin/schedules.php?id=" . urlencode($bedname) . "&msg=" . urlencode($message));
}

?>