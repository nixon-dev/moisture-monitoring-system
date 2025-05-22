<?php
include('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedBtn'])) {
    $sd = $_POST['startscheds'];
    $esd = date('Y-m-d', strtotime($sd));
    $ed = $_POST['endscheds'];
    $eed = date('Y-m-d', strtotime($ed));
    $ss = $_POST['schedSwitch'];
    $bn = $_POST['bedname'];
    $sn = $_POST['schedName'];
    $limit = '1970-01-01';
    $existingSchedules = [];

    if ($esd > $eed) {
        $message = "Error: Starting date cannot be higher than the end date";
        header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
        exit();
    }
    

    $query = "SELECT * FROM bedschedules WHERE bedname = '$bn'";
    $result = mysqli_query($link, $query);

    if ($result && $result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $existingSchedules[] = $row;
        }
    }

    foreach ($existingSchedules as $row) {
        $startD = date('Y-m-d', strtotime($row['startdate']));
        $endD = date('Y-m-d', strtotime($row['enddate']));
        $schedSw = $row['sched_switch'];
        $harvestD = $row['harvest'];

        if (($esd >= $startD && $esd <= $endD) || ($eed >= $startD && $eed <= $endD)) {
            $message = "Error: Schedule overlaps with an existing schedule";
            header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
            exit();
        }
    }

    if ($sn != 'Harvesting Week'){
        $hd = 'No';
    } else {
        $hd = 'Yes';
    }

    if ($esd != $limit && $eed != $limit) {
        $query = "INSERT INTO bedschedules (bedname, startdate, enddate, sched_switch, harvest, name) VALUES ('$bn', '$esd', '$eed', '$ss', '$hd' , '$sn')";
        $result = mysqli_query($link, $query);

        if ($result) {
            $message = "Schedule has been successfully added";
            header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
        } else {
            $message = "Error: Schedule could not be added";
            header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
        }
    } else {
        $message = "Error: Schedule could not be added";
        header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
    }
}
?>
