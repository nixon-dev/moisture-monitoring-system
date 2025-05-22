<?php

include('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the bed number and switch value from the AJAX request
    $bedNumber = $_POST['bedNumber'];
    $switchValue = $_POST['switchValue'];
    $manualSwitch = $_POST['manualSwitchValue'];



    if ($switchValue === 'On') {
        $manualSwitch = 'Off';

        $updateQuery = "UPDATE beds SET 
        switch = COALESCE(NULLIF('$switchValue', ''), switch), 
        manualswitch = COALESCE(NULLIF('$manualSwitch', ''), manualswitch) 
        WHERE bedname = '$bedNumber'";

        $result = mysqli_query($link, $updateQuery);

    } else {
        $switchValue = 'Off';
        
        $updateQuery = "UPDATE beds SET 
        switch = COALESCE(NULLIF('$switchValue', ''), switch), 
        manualswitch = COALESCE(NULLIF('$manualSwitch', ''), manualswitch) 
        WHERE bedname = '$bedNumber'";

        $result = mysqli_query($link, $updateQuery);

    }

   

}
?>