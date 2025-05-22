<?php
  if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
    session_destroy(); // Destroy the session
    header("Location: ../login.php"); // Redirect to login page or any other page after logout
    exit;
?>
