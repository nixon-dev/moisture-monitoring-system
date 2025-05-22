<?php
include('db_conn.php');

$beds = array(
    array(
        'name' => $_POST['bedname'] ?? '',
        'gauges' => array($_POST['gauge1'] ?? '', $_POST['gauge2'] ?? '', $_POST['gauge3'] ?? '')
    )
);

date_default_timezone_set('Asia/Manila');
$logdate = date("Y-m-d H:i:s");

foreach ($beds as $bed) {
    $bedname = $bed['name'];
    $gauges = $bed['gauges'];

    if (!empty($bedname)) {
        $bedquery = "SELECT * FROM beds WHERE bedname = ?";
        $bedstmt = $link->prepare($bedquery);
        $bedstmt->bind_param("s", $bedname);
        $bedstmt->execute();
        $bedresult = $bedstmt->get_result();

        if ($bedresult && $bedresult->num_rows > 0) {
            $row = $bedresult->fetch_assoc();

            $addlog = "INSERT INTO logs (bedname, gauge1, gauge2, gauge3, logdate) VALUES (?, ?, ?, ?, ?)";
            $stmt = $link->prepare($addlog);
            $stmt->bind_param("sssss", $bedname, $gauges[0], $gauges[1], $gauges[2], $logdate);
            $stmt->execute();

            echo "Bed $bedname Log added";


            $manualquery = "SELECT * FROM beds WHERE bedname = '$bedname'";
            $manualqueryresult = mysqli_query($link, $manualquery);
            $mrows = mysqli_fetch_all($manualqueryresult, MYSQLI_ASSOC);

            if (!empty($mrows)) {
                $manualSwitch = $mrows[0]['manualswitch'];
                echo "<br>Manual Switch: $manualSwitch";
            } else {
                echo "<br>Manual Switch: Off";
            }




            $schedquery = "SELECT * FROM bedschedules WHERE bedname = '$bedname' ORDER BY startdate ASC";
            $schedresult = mysqli_query($link, $schedquery);
            $today = date('Y-m-d');
            $existingSchedules = array();

            if ($schedresult && $schedresult->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($schedresult)) {
                    $existingSchedules[] = $row;
                }
            }

            if (empty($existingSchedules)) {
                echo "No schedules available.<br>";
            } else {
                $hasSchedules = false; // Flag to check if any schedules match the current date

                foreach ($existingSchedules as $row) {
                    $startD = date('Y-m-d', strtotime($row['startdate']));
                    $endD = date('Y-m-d', strtotime($row['enddate']));
                    $schedSw = $row['sched_switch'];
                    $harvestD = $row['harvest'];

                    if ($today >= $startD && $today <= $endD) {
                        if ($schedSw == 'On') {

                            echo "<br>AWS: On";
                        } else {
                            echo "<br>AWS: Off";
                        }

                        $hasSchedules = true;
                    }
                }

                if (!$hasSchedules) {
                    echo "<br>Schedules Today: None";
                }
            }
        } else {
            echo "Bed $bedname not found";
        }
    }
}



$link->close();


?>