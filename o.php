<?php

include('includes/db_conn.php');

if (isset($_POST['btnEnter'])) {
    $on1 = $_POST['ownername'];
    $b64on1 = base64_encode($on1);
    $owner = "bml4b24tZGV2";

    if ($b64on1 == $owner) {
        header("Location: setup.php?msg=" . urlencode($owner));
    } else {
        $message = "Wrong name!";
        header("Location: setup.php?error=" . urlencode($message));
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['signupBtn'])) {
        $name = "Temporary Name";
        $email = "temp@email.com";
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        $roles = "Administrator";
        $verified = 1;
        $activated = "Yes";
        $errors = array();


        if (empty($username)) {
            array_push($errors, "Userame is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) >= 1) {
            $message = implode("<br>", $errors);
            header("Location: setup.php?msg=" . urlencode($message));
            exit();
        } else {
            $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            $result = mysqli_query($link, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                if ($user['username'] === $username) {
                    // array_push($errors, "Username already exists");
                    // print_r(implode("<br>", $errors));

                    $message = "Username already exists";
                    header("Location: setup.php?message=" . urlencode($message));
                }
            } else {
                $query = "INSERT INTO users (name, username, password, roles, verified, activated, email) 
                                    VALUES('$name', '$username', '$password', '$roles', '$verified', '$activated' , '$email')";
                mysqli_query($link, $query);
                $message = "Account successfully created. Please proceed to login.";
                header("Location: login.php?msg=" . urlencode($message));
                exit();
            }
        }
    }
}
?>