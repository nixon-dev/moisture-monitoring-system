<?php

include('db_conn.php');
date_default_timezone_set('Asia/Manila');
$sql = "SELECT COUNT(*) FROM beds";

$result = $link->query($sql);
$row = $result->fetch_array();
$count = $row[0];
$totalcount = $count + 1;
$name = $totalcount;
$logdate = date("Y-m-d H:i:s");
$defaultSwitch = "Off";
$today = date('Y-m-d');


$insertStmt = $link->prepare("INSERT INTO beds (bedname, switch) VALUES (?, ?)");
$insertStmt->bind_param("ss", $name, $defaultSwitch);

if ($insertStmt->execute()) {

// This is for logs

  $logdate = date("Y-m-d H:i:s");
  $addlog = "INSERT INTO logs (bedname, gauge1, gauge2, gauge3, logdate) VALUES ('$name','0', '0', '0' ,'$logdate')";
  mysqli_query($link, $addlog);

// This is for Decomposing Days

  $decompSD = $today;
  $decompED = date('Y-m-d', strtotime($today . ' +14 day'));

  $decomp = "INSERT INTO bedschedules (bedname, startdate, enddate, sched_switch, harvest, name) 
  VALUES ('$name', '$decompSD', '$decompED', 'Off', 'No', 'Decomposing Period')";
  mysqli_query($link, $decomp);

  // This is for Monitoring Days

  $monitorSD = date('Y-m-d', strtotime($decompED . ' +1 day'));
  $monitorED = date('Y-m-d', strtotime($monitorSD . ' +29 day'));

  $monitor = "INSERT INTO bedschedules (bedname, startdate, enddate, sched_switch, harvest, name) 
  VALUES ('$name', '$monitorSD', '$monitorED', 'On', 'No', 'Monitoring Period')";
  mysqli_query($link, $monitor);

// This is for Harvesting Week
  $harvestSD = date('Y-m-d', strtotime($monitorED . ' +1 day'));
  $harvestED = date('Y-m-d', strtotime($harvestSD . ' +13 day'));

  $harvest = "INSERT INTO bedschedules (bedname, startdate, enddate, sched_switch, harvest, name) 
  VALUES ('$name', '$harvestSD', '$harvestED', 'Off', 'Yes', 'Harvesting Week')";
  mysqli_query($link, $harvest);


  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
  echo "Error";
}

$insertStmt->close();
$link->close();

?>
