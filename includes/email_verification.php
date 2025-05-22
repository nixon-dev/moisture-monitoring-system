<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
  }
include('db_conn.php');




// Replace with your Sendinblue API key
define('SENDINBLUE_API_KEY', '#');

// Sendinblue API endpoint
define('SENDINBLUE_API_ENDPOINT', 'https://api.sendinblue.com/v3/smtp/email');

// Get user's email address from the form
if(!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = $id";
} else {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $query = "SELECT * FROM users WHERE email = '$email'";
}


$result = mysqli_query($link, $query);
if ($result && mysqli_num_rows($result) >= 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $roles = $row['roles'];
    $email = $row['email'];
    $profile = $row['profilepfn'];
} else {
    $name = 'Unknown';
    $roles = 'Unknown';
}


// Generate a unique verification code
$verification_code = md5(uniqid(rand(), true));

// Save the verification code and email address in your database

// ... (code to save to database)



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['verifyBtn'])) {

        $save_code =    "UPDATE users SET
        code = '$verification_code'
        WHERE email = '$email'";
        mysqli_query($link, $save_code);



// Send verification email to the user's email address
$to = $email;
$subject = 'Please verify your email address';
$message = 'Please click the following link to verify your email address: http://localhost/thesis/includes/verify-email.php?code=' . $verification_code;
$headers = array(
'api-key: ' . SENDINBLUE_API_KEY,
'Content-Type: application/json',
);
$data = array(
'sender' => array('email' => 'lelinaej@gmail.com'),
'to' => array(array('email' => $to)),
'subject' => $subject,
'htmlContent' => $message,
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, SENDINBLUE_API_ENDPOINT);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$message = "Email verification has been sent. Please check your email. <br> This page will automatically close in 20 seconds";
if (!empty($email)){
    header("Location: ../verify.php?message=" . urlencode($message) . "&email=" . urlencode($email));
} else {
    header("Location: ../verify.php?message=" . urlencode($message));
}

    }



}


?>