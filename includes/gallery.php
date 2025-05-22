<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
include('db_conn.php');

$id = 1;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['topBtn'])) {

        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $sessionquery = "SELECT * FROM images WHERE id = $id";
        $result = mysqli_query($link, $sessionquery);

        if (
            $_FILES["top_image"]["error"] == UPLOAD_ERR_OK &&
            is_uploaded_file($_FILES["top_image"]["tmp_name"]) &&
            in_array($_FILES["top_image"]["type"], $allowed_types) &&
            $_FILES["top_image"]["size"] <= 50000000
        ) {

            // Generate a unique file name
            $file_name = uniqid() . ".jpg";

            // Save the uploaded file to a temporary location
            $tmp_file = $_FILES["top_image"]["tmp_name"];
            $dest_file = "../images/bgs/" . $file_name;
            move_uploaded_file($tmp_file, $dest_file);

            // Update the user's profile with the new file name
            // $query = "UPDATE users SET profilepfn='$file_name' WHERE id = $session_id";
            $query = "UPDATE images SET 
                    topimage =  '$file_name'
                    WHERE ID = '$id'";

            $message = "Top Image has been updated successfully!";
            mysqli_query($link, $query);
            header("Location: ../admin/gallery.php?message=" . urlencode($message));

        } else {
            $message = "Invalid file. Please upload a JPEG image file of size up to 5MB.";
            header("Location: ../admin/gallery.php?message=" . urlencode($message));
        }
    }

    if (isset($_POST['bottomBtn'])) {

        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $sessionquery = "SELECT * FROM images WHERE id = $id";
        $result = mysqli_query($link, $sessionquery);

        if (
            $_FILES["bottom_image"]["error"] == UPLOAD_ERR_OK &&
            is_uploaded_file($_FILES["bottom_image"]["tmp_name"]) &&
            in_array($_FILES["bottom_image"]["type"], $allowed_types) &&
            $_FILES["bottom_image"]["size"] <= 50000000
        ) {

            // Generate a unique file name
            $file_name = uniqid() . ".jpg";

            // Save the uploaded file to a temporary location
            $tmp_file = $_FILES["bottom_image"]["tmp_name"];
            $dest_file = "../images/bgs/" . $file_name;
            move_uploaded_file($tmp_file, $dest_file);

            // Update the user's profile with the new file name
            // $query = "UPDATE users SET profilepfn='$file_name' WHERE id = $session_id";
            $query = "UPDATE images SET 
                    bottomimage =  '$file_name'
                    WHERE ID = '$id'";

            $message = "Bottom Image has been updated successfully!";
            mysqli_query($link, $query);
            header("Location: ../admin/gallery.php?message=" . urlencode($message));

        } else {
            $message = "Invalid file. Please upload a JPEG image file of size up to 5MB.";
            header("Location: ../admin/gallery.php?message=" . urlencode($message));
        }
    }

    if (isset($_POST['sliderBtn'])) {
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $sessionquery = "SELECT * FROM images WHERE id = $id";
        $result = mysqli_query($link, $sessionquery);
    
        // Loop through each slider image
        for ($i = 1; $i <= 7; $i++) {
            $sliderInputName = "slider{$i}_image"; // Input name for each slider image
    
            // Check if the current slider image needs to be updated
            if (
                isset($_FILES[$sliderInputName]) &&
                $_FILES[$sliderInputName]["error"] == UPLOAD_ERR_OK &&
                is_uploaded_file($_FILES[$sliderInputName]["tmp_name"]) &&
                in_array($_FILES[$sliderInputName]["type"], $allowed_types) &&
                $_FILES[$sliderInputName]["size"] <= 50000000
            ) {
                // Generate a unique file name
                $file_name = uniqid() . ".jpg";
    
                // Save the uploaded file to a temporary location
                $tmp_file = $_FILES[$sliderInputName]["tmp_name"];
                $dest_file = "../images/bgs/" . $file_name;
                move_uploaded_file($tmp_file, $dest_file);
    
                // Update the database with the new file name for the current slider
                $sliderColumnName = "slider{$i}";
                $query = "UPDATE images SET {$sliderColumnName} = '{$file_name}' WHERE ID = '$id'";
                mysqli_query($link, $query);
            }
        }
    
        // Redirect to the appropriate page after updating the slider images
        $message = "Slider Images have been updated successfully!";
        header("Location: ../admin/gallery.php?message=" . urlencode($message));
    }
    

}
?>