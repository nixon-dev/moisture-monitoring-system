<?php
require_once 'db_conn.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $query = "SELECT * FROM users WHERE code = '$code' LIMIT 1";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $id = $user['id'];

        $query = "UPDATE users SET verified = 1 WHERE id = $id";
        mysqli_query($link, $query);

        // Clear the reset token from the database
        $query = "UPDATE users SET code = NULL WHERE code = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $stmt->close();

        $message = "Your email has been verified. You can now log in";
        header("Location: ../login.php?msg=" . urlencode($message));
    } else {
        $message = "Invalid verification code";
    }
} else {
    header("Location: index.php");
    exit();
}
?>