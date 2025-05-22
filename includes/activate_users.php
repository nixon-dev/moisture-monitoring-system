<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
include ('../includes/db_conn.php');
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['editBtn'])) {
    $ids = mysqli_real_escape_string($link, $_POST['user_id']);
    $activated = mysqli_real_escape_string($link, $_POST['activated']);

    $query = "UPDATE users SET activated = COALESCE(NULLIF(?, activated)) WHERE ID = ?";
    $stmt = mysqli_prepare($link, $query);
    
    mysqli_stmt_bind_param($stmt, "si", $activated, $ids);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
      $message = "Activated Successfully!";
      header("Location: ../admin/activate.php?message=" . urlencode($message));
      exit();
    } else {
      $errors[] = "Failed to activate user.";
    }
    
    mysqli_stmt_close($stmt);
  }
}
?>
