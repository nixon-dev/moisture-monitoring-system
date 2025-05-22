<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
include('db_conn.php');
$session_id = $_SESSION['id'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['uploadBtn'])) {
        
        $name = mysqli_real_escape_string($link, $_POST['name_user']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $sessionquery = "SELECT * FROM users WHERE id = $session_id";
        $result = mysqli_query($link, $sessionquery);

        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];

            if ($session_id == $id) {
                // Validate the uploaded file
                if ($_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK &&
                    is_uploaded_file($_FILES["profile_picture"]["tmp_name"]) &&
                    in_array($_FILES["profile_picture"]["type"], $allowed_types) &&
                    $_FILES["profile_picture"]["size"] <= 5000000) {

                    // Generate a unique file name
                    $file_name = uniqid() . ".jpg";

                    // Save the uploaded file to a temporary location
                    $tmp_file = $_FILES["profile_picture"]["tmp_name"];
                    $dest_file = "../images/profile/" . $file_name;
                    move_uploaded_file($tmp_file, $dest_file);

                    // Update the user's profile with the new file name
                    // $query = "UPDATE users SET profilepfn='$file_name' WHERE id = $session_id";
                    $query = "UPDATE users SET 
                    name = '$name',
                    email = '$email',
                    username = '$username',
                    password = '$password',
                    profilepfn =  '$file_name'
                    WHERE ID = '$session_id'";

                    $message = "Profile picture updated successfully!";
                    if ($_SESSION['roles'] == 'Administrator') {
                        mysqli_query($link, $query);
                        header("Location: ../admin/settings.php?message=" . urlencode($message));
                        header ("Location: ../admin/settings.php");
                    } else if ($_SESSION['roles'] == 'Staff'){
                        mysqli_query($link, $query);
                        header("Location: ../staff/settings.php?message=" . urlencode($message));
                        header ("Location: ../staff/settings.php");
                    }
                } else {
                    $query = "UPDATE users SET 
                    name = COALESCE(NULLIF('$name', ''), name),
                    email = COALESCE(NULLIF('$email', ''), email),
                    username = COALESCE(NULLIF('$username', ''), username),
                    password = COALESCE(NULLIF('$password', ''), password)
                    WHERE ID = '$session_id'";
                    
                    // echo "Invalid file. Please upload a JPEG image file of size up to 5MB.";
                    $message = "Profile has updated successfully!";
                   
                    if ($_SESSION['roles'] == 'Administrator') {
                        mysqli_query($link, $query);
                        header("Location: ../admin/settings.php?message=" . urlencode($message));
                    } else if ($_SESSION['roles'] == 'Staff'){
                        mysqli_query($link, $query);
                        header("Location: ../staff/settings.php?message=" . urlencode($message));
                    }

                }
            } else {
                // echo 'Invalid ID';
                $message = "Invalid ID";
                if ($_SESSION['roles'] == 'Administrator') {
                    header("Location: ../admin/settings.php?message=" . urlencode($message));
                } else if ($_SESSION['roles'] == 'Staff'){
                            header("Location: ../staff/settings.php?message=" . urlencode($message));
                }
            }
        } else {
            // echo 'User not found.';
            $message = "User not found.";
            if ($_SESSION['roles'] == 'Administrator') {
                header("Location: ../admin/settings.php?message=" . urlencode($message));
            } else if ($_SESSION['roles'] == 'Staff'){
                        header("Location: ../staff/settings.php?message=" . urlencode($message));
            }
        }
    }
}
?>
