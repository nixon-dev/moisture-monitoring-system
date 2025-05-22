<?php
// Get online users
include '../includes/session_admin.php';
$online_users = json_decode(file_get_contents('../json/online_users.json'), true);

// Remove inactive users (timeout set to 5 minutes)
foreach($online_users as $username => $data) {
    if(time() -  $data['last_activity'] > 300) {
        unset($online_users[$username]);
    }
}

// Display online users
date_default_timezone_set('Asia/Manila');
if(count($online_users) > 0) {
    // echo "<table>";
    // echo "<tr><th>Username</th><th>Last Activity</th></tr>";
    foreach($online_users as $username => $data) {
       



        // echo "<tr><td>".$username."</td><td>".$data['name']."</td><td>".date('Y-m-d g:i:s A', $data['last_activity'])."</td></tr>";

        // $active_uname = $username;
        // $active_name = $data['name'];
        // $lact = date('Y-m-d g:i:s A', $data['last_activity']);
    
    // foreach($online_users as $username => $last_activity) {

    //     $uname = $username;
    //     $lact = date('Y-m-d g:i:s', $last_activity);
        // echo "<tr><td>".$username."</td><td>".date('Y-m-d g:i:s', $last_activity)."</td></tr>";
    }
    // echo "</table>";
} else {
    echo "No online users";
}
?>
