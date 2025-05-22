<?php
include('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resetToken = $_POST['resetToken'];
    $newPassword = $_POST['password1'];
    $confirmPassword = $_POST['password2'];

    $stmt = $link->prepare("SELECT count(token) As token_count FROM users WHERE token = ?");
    $stmt->bind_param("s", $resetToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $tokenCount = $row['token_count'];

    if ($tokenCount > 0 ) {
        if ($newPassword === $confirmPassword) {
            $query = "UPDATE users SET password = ? WHERE token = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("ss", $newPassword, $resetToken);
            $stmt->execute();
            $stmt->close();
    
            // Clear the reset token from the database
            $query = "UPDATE users SET token = NULL WHERE token = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("s", $resetToken);
            $stmt->execute();
            $stmt->close();
    
    
            $m1 = "Password has successfully updated";
            header("Location: ../login.php?msg=" . urlencode($m1));
            exit();
        } else {
            $m1 = "Password doesn't matched";
            header("Location: ../reset_password.php?message=" . urlencode($m1) . "&token=" . urlencode($resetToken));
            exit();
        }
    } else {
        $m1 = "Invalid Token";
        header("Location: ../reset_password.php?message=" . urlencode($m1) . "&token=" . urlencode($resetToken));
        exit();
    }
    

}


?>