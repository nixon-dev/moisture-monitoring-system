<?php
include('db_conn.php');

$schedquery = "SELECT * FROM bedschedules ORDER BY startdate ASC";
$schedresult = mysqli_query($link, $schedquery);

$today = date('Y-m-d');

$existingSchedules = array(); // Initialize the array

if ($schedresult && $schedresult->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($schedresult)) {
        $existingSchedules[] = $row;
    }
}

if (empty($existingSchedules)) {
    echo "No schedules available.";
} else {
    $hasSchedules = false; // Flag to check if any schedules match the current date

    foreach ($existingSchedules as $row) {
        $startD = date('Y-m-d', strtotime($row['startdate']));
        $endD = date('Y-m-d', strtotime($row['enddate']));
        $schedSw = $row['sched_switch'];
        $harvestD = $row['harvest'];

        if ($today >= $startD && $today <= $endD) {
            echo "Starting Date: $startD<br>Today&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: $today<br>Ending Date&nbsp: $endD<br>Harvest Day : $harvestD<br>AWS Switch: $schedSw<br><br>";
            $hasSchedules = true;
        }
    }

    if (!$hasSchedules) {
        echo "No schedules available for today.";
    }
}
?>
