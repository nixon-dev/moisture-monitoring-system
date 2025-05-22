<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
 
  session_start();
}
include('db_conn.php');

$username = "";
$roles = "";
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['signupBtn'])) {
    $name = mysqli_real_escape_string($link, $_POST['name_user']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $roles = "Staff";
    $verified = 0;
    $activated = "Yes";

    if (empty($name)) {
      array_push($errors, "Name is required");
    }
    if (empty($email)) {
      array_push($errors, "Email is required");
    }
    if (empty($username)) {
      array_push($errors, "Userame is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }
   

    if (count($errors) >= 1) {
        $message = implode("<br>", $errors);
        header("Location: ../login.php?message=" . urlencode($message));
    } else {
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($link, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) {
        if ($user['username'] === $username) {
          // array_push($errors, "Username already exists");
          // print_r(implode("<br>", $errors));

          $message = "Username already exists";
          header("Location: ../login.php?message=" . urlencode($message));
          exit();
        } else if ($user['email'] === $email) {
          $message = "Email already exists";
          header("Location: ../login.php?message=" . urlencode($message));
          exit();
        }
      } else {
        $query = "INSERT INTO users (name,email, username, password, roles,verified, activated) 
        VALUES('$name', '$email', '$username', '$password', '$roles', '$verified', '$activated')";
        mysqli_query($link, $query);
        $message = "Account successfully created. Please proceed to login";
        header("Location: ../verify.php?email=" . urlencode($email));

        
      }
    }
  }

  if (isset($_POST['adminsignupBtn'])) {
    $name = mysqli_real_escape_string($link, $_POST['name_user']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $roles = mysqli_real_escape_string($link, $_POST['roles']);
    $verified = 1;
    $activated = "Yes";

    if (empty($name)) {
      array_push($errors, "Name is required");
    }
    if (empty($email)) {
      array_push($errors, "Email is required");
    }
    if (empty($username)) {
      array_push($errors, "Userame is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }
    if (empty($roles)) {
      array_push($errors, "Roles is required");
    }

    if (count($errors) >= 1) {
      $message = implode("<br>", $errors);
      header("Location: ../admin/users.php?message=" . urlencode($message));
    } else {
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($link, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) {
        if ($user['username'] === $username) {
          // array_push($errors, "Username already exists");
          // print_r(implode("<br>", $errors));

          $message = "Username already exists";
          header("Location: ../admin/users.php?message=" . urlencode($message));
          exit();
        } else if ($user['email'] === $email) {
          $message = "Email already exists";
          header("Location: ../admin/users.php?message=" . urlencode($message));
          exit();
        }
      } else {
        $query = "INSERT INTO users (name,email, username, password, roles,verified, activated) 
        VALUES('$name', '$email', '$username', '$password', '$roles', '$verified', '$activated')";
        mysqli_query($link, $query);

        $message = "Account Created Successfully!";
        header("Location: ../admin/users.php?message=" . urlencode($message));

      }
    }
  }
}


?>