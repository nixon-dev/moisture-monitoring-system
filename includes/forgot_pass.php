<?php
include('db_conn.php');
define('SENDINBLUE_API_KEY', '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');
// Sendinblue API endpoint
define('SENDINBLUE_API_ENDPOINT', 'https://api.sendinblue.com/v3/smtp/email');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);

    if (!empty($email)){
        $stmt = $link->prepare("SELECT count(email) As email_count FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $emailCount = $row['email_count'];

        if ($emailCount > 0) {
            $resetToken = md5(uniqid(rand(), true));
            
            $stmt = $link->prepare("UPDATE users SET token = ? WHERE email = ?");
            $stmt->bind_param("ss", $resetToken, $email);
            $stmt->execute();
            $stmt->close();

            $to = $email;
            $resetlink = 'http://localhost/thesis/reset_password.php?token=' . $resetToken;
            $subject = 'Confirmation code';
            $message = 'To confirm ownership of the email address, kindly click on the link provided below: ' . $resetlink;
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

            $m1 = "Email verification has been sent. Please check your email";
            header("Location: ../forgot_password.php?message=" . urlencode($m1));
            exit();
        } else {
            $stmt->close();
            $m2 = "Invalid email";
            header("Location: ../forgot_password.php?message=" . urlencode($m2));
            exit();
        }
    } else {
        $m3 = "Please enter your email";
        header("Location: ../forgot_password.php?message=" . urlencode($m3));
        exit();
    }
}
?>
