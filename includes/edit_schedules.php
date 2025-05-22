<?php

include('db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editschedBtn'])) {
    $si = $_POST['sched_id'];
    $sd = $_POST['startscheds'];
    $esd = date('Y-m-d', strtotime($sd));
    $ed = $_POST['endscheds'];
    $eed = date('Y-m-d', strtotime($ed));
    $ss = $_POST['schedSwitch'];
    $bn = $_POST['bedname'];
    $sn = $_POST['editschedName'];
    $limit = '1970-01-01';

    

    if ($sn == 'Harvesting Week' ){
        $hd = 'Yes';
    } elseif($sn == '') {
        $hd = '';
    } else {
        $hd = 'No';
    }

    // Retrieve existing schedules that overlap with the edited schedule
    $query = "SELECT * FROM bedschedules WHERE id <> '$si' AND bedname = '$bn' AND (startdate <= '$eed' AND enddate >= '$esd')";
    $result = mysqli_query($link, $query);

    if ($result && $result->num_rows > 0) {
        $existingSchedules = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $existingSchedules[] = $row;
        }

        // Sort existing schedules by their start dates
        usort($existingSchedules, function ($a, $b) {
            return strtotime($a['startdate']) - strtotime($b['startdate']);
        });

        $nextAvailableDate = date('Y-m-d', strtotime($eed . ' +1 day'));


        // Iterate through existing schedules to check for overlaps
        foreach ($existingSchedules as $existingSchedule) {
            $existingId = $existingSchedule['id'];
            $existingStart = $existingSchedule['startdate'];
            $existingEnd = $existingSchedule['enddate'];

            // Calculate new start and end dates for the existing schedule
            $newStart = $nextAvailableDate;
            $newEnd = date('Y-m-d', strtotime($newStart) + (strtotime($existingEnd) - strtotime($existingStart)));

            // Update the existing schedule with the new start and end dates
            $updateQuery = "UPDATE bedschedules SET startdate = '$newStart', enddate = '$newEnd' WHERE id = '$existingId'";
            $updateResult = mysqli_query($link, $updateQuery);

            if (!$updateResult) {
                $message = "Error: Failed to update existing schedules";
                header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
                exit();
            }
            $nextAvailableDate = date('Y-m-d', strtotime($newEnd) + 1);
        }
    }

    // Perform the update for the edited schedule
    $query = "UPDATE bedschedules SET
        sched_switch = COALESCE(NULLIF('$ss', ''), sched_switch),
        harvest = COALESCE(NULLIF('$hd', ''), harvest),
        name = COALESCE(NULLIF('$sn', 'unaltered'), name),
        startdate = COALESCE(NULLIF('$esd', '$limit'), startdate),
        enddate = COALESCE(NULLIF('$eed', '$limit'), enddate)
        WHERE id='$si'";
    $result = mysqli_query($link, $query);

    if ($result) {
        $message = "Schedule has been edited successfully";
        header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
    } else {
        $message = "Error: Schedule could not be edited";
        header("Location: ../admin/schedules.php?id=" . urlencode($bn) . "&msg=" . urlencode($message));
    }
}


?>