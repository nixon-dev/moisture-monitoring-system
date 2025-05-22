<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
$message = '';

$sql = "SELECT * FROM users WHERE username = ? AND password = ? AND role = ?";


if (isset($_GET['login'])) {
    if (isset($_GET['username'])) {
        $un = $_GET['username'];
    }
    if (isset($_GET['password'])) {
        $pw = $_GET['password'];
    }


    if ((!$un) || (!$pw)) {
        $msg = 'Please enter your username and password';
        header("Location: ../login.php?msg=" . urlencode($msg));
    } else {

        include 'db_conn.php';

        $sql = "SELECT * FROM users WHERE username = '" . $un . "' AND password = '" . $pw . "'";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_assoc($result);
                $role = $row['roles'];
                $s_id = $row['id'];
                $email = $row['email'];
                $name = $row['name'];
                $verified = $row['verified'];
                $activated = $row['activated'];
                $profile = $row['profilepfn'];
                $username = $row['username'];
                $_SESSION['email'] = $email;
                $_SESSION['roles'] = $role;
                $_SESSION['id'] = $s_id;
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $name;
                $_SESSION['profile'] = $profile;


                if ($verified == 1) {
                    if ($role == 'Administrator') {
                        if ($activated == 'Yes') {
                            header("location:../admin/index.php ");
                        } else {
                            header("location:../activate.php ");
                        }
                    } elseif ($role == 'Staff') {

                        if ($activated == 'Yes') {
                            header("location:../staff/index.php ");
                        } else {
                            header("location:../activate.php ");
                        }
                    }
                } else {
                    header("location: ../verify.php");
                }



                mysqli_free_result($result);
            } else {
                if ($un != "") {
                    //   echo "<center>Your username or password is incorrect!</center><br>";
                    $msg = "Your username or password is incorrect!";
                    header("Location: ../login.php?msg=" . urlencode($msg));
                }
            }
        } else {
            echo "Error: Unable to execute $sql." . mysqli_error($link);
        }
        mysqli_close($link);
    }
}

?>