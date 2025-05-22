<?php
include('db_conn.php');
$query = "SELECT * FROM beds";
$result = $link->query($query);
$beds = array();
while ($row = mysqli_fetch_assoc($result)) {
    $beds[] = $row;
}
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($beds, $row["bedname"]);
    $bedname = $row['bedname'];
  }
}
$link->close();
echo json_encode($beds);
?>
