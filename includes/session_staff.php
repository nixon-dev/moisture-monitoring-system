<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
include('db_conn.php');

// Check if user is not logged in
// if (!isset($_SESSION['username'])) {
//     // Redirect to login page or show an error message
//     header("Location: ../index.php"); // Change the URL to your login page
//     exit();
// }
if (!isset($_SESSION['id'])) {
    // Redirect to login page if user is not logged in
    header('Location: ../login.php');
    exit;
}
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($link, $query);
if ($result && mysqli_num_rows($result) >= 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $roles = $row['roles'];
    $profile = $row['profilepfn'];
    $email = $row['email'];
} else {
    $name = 'Unknown';
    $roles = 'Unknown';
}

$staff = 'Staff';
if($roles != $staff) {
    session_destroy();
    header('Location: ../login.php');
    exit;
}

if(isset($_SESSION['username']) && isset($_SESSION['name'])) {
    // Update user activity
    $_SESSION['last_activity'] = time();
    
    // Add user to online list
    $online_users = json_decode(file_get_contents('../json/online_users.json'), true);
    $online_users[$_SESSION['username']] = array(
        'name' => $_SESSION['name'],
        'profile' => $_SESSION['profile'],
        'roles' => $_SESSION['roles'],
        'last_activity' => $_SESSION['last_activity']
    );
    file_put_contents('../json/online_users.json', json_encode($online_users));
}

// Get online users
$online_users = json_decode(file_get_contents('../json/online_users.json'), true);

// Remove inactive users (timeout set to 5 minute)
foreach($online_users as $username => $data) {
    if(time() -  $data['last_activity'] > 300) {
        unset($online_users[$username]);
    }
}
file_put_contents('../json/online_users.json', json_encode($online_users));



?>
