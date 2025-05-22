<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  // Start the session
  session_start();
}
include ('../includes/db_conn.php');
$errors = array(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // PHP code to process the sign-up form and insert data into database
  // ...
  

  if (isset($_POST['editBtn'])) {
    // $id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : (isset($_GET['data-id']) ? $_GET['data-id'] : (isset($_POST['data-id']) ? $_POST['data-id'] : null)));
   
    $ids = mysqli_real_escape_string($link, $_POST['user_id']);
    $name = mysqli_real_escape_string($link, $_POST['name_user']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $roles = mysqli_real_escape_string($link, $_POST['roles']);
    
    if (count($errors) >= 1) {
      print_r(implode("<br>", $errors));
    } else {
      $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
      $result = mysqli_query($link, $user_check_query);
      $user = mysqli_fetch_assoc($result);
    
      if ($user) { 
        if ($user['username'] === $username) {
          array_push($errors, "Username already exists");
          print_r(implode("<br>", $errors));
        }
      } else {
        // $query = "UPDATE users SET name='$name', email='$email', username='$username', password='$password', roles='$roles' WHERE id='$ids'";
          $query = "UPDATE users SET 
          name = COALESCE(NULLIF('$name', ''), name),
          email = COALESCE(NULLIF('$email', ''), email),
          username = COALESCE(NULLIF('$username', ''), username),
          password = COALESCE(NULLIF('$password', ''), password),
          roles = COALESCE(NULLIF('$roles', ''), roles)
          WHERE ID = '$ids'";

        mysqli_query($link, $query);
        $message = "Edit Successfully!";
        header("Location: ../admin/users.php?message=" . urlencode($message));
        // Clear input fields using jQuery and refresh the page
        echo "<script>
          // Delay for 1 second (1000 milliseconds) and then clear input fields
          setTimeout(function() {
            document.getElementById('name').value = '';
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
            document.getElementById('roles').value = '';
            // Additional input fields can be cleared in a similar manner
          }, 1000);
          
          // Delay for 2 seconds (2000 milliseconds) and then refresh the page
          setTimeout(function() {
            location.reload();
          }, 2000);
        </script>";
      }
    }
  }
}

?>
