<?php include '../includes/session_staff.php'; ?>
<?php
include '../includes/db_conn.php';
$bednumber = $_GET['id'];

$sql = "SELECT * FROM logs WHERE bedname = '$bednumber' ORDER BY logdate ASC";
$result = mysqli_query($link, $sql);

$logs = array();
while ($row = mysqli_fetch_assoc($result)) {
  $logs[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Bed
    <?php echo $bednumber; ?>: Data Log - Vermicompost Monitoring System
  </title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">

  <!-- CSS  -->

  <link href="../css/print.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet" />
</head>

<body class="has-fixed-sidenav">
  <?php include '../includes/sidenav_staff.php'; ?>


  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h5 style="font-weight: bold;">Bed <?php echo $bednumber; ?> Logs</h5>
      <span>View logs for each bed</span><br>

      <div class="row">
        <div class="input-field col s11">
          <input type="text" id="datepicker" class="datepicker">
          <label for="datepicker">Filter Date</label>
        </div>
        <div class="input-field col s1">
          
          <button style="margin-top: 10px;" class="green waves-effect wave-light btn" onclick="printLog()">Print</button>
        </div>
      </div>

      <div class="col s12 card" id="print-area">
        <div class="card-content z-depth-3 center">
          <table class="highlight centered responsive-table" id="datalog1" data-filterable>
            <thead>
              <tr>
                <th>Gauge 1</th>
                <th>Gauge 2</th>
                <th>Gauge 3</th>
                <th data-filter="date">Date</th>
                <th>Time</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($logs as $log) { ?>
                <tr>
                  <td>
                    <?php echo $log['gauge1']; ?>
                  </td>
                  <td>
                    <?php echo $log['gauge2']; ?>
                  </td>
                  <td>
                    <?php echo $log['gauge3']; ?>
                  </td>
                  <td>
                    <?php echo date('M d, Y', strtotime($log['logdate'])); ?>
                  </td>
                  <td>
                    <?php echo date('h:i:s A', strtotime($log['logdate'])); ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <br><br>
    </div>
  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/print.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/materialize-custom.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Initialize the datepicker
      var datepicker = document.querySelector('.datepicker');
      var instance = M.Datepicker.init(datepicker);

      // Get the table and rows
      var table = document.getElementById('datalog1');
      var rows = table.getElementsByTagName('tr');

      // Add event listener for datepicker change
      datepicker.addEventListener('change', function () {
        var selectedDate = instance.date;

        // Iterate through the rows and hide/show based on selected date
        for (var i = 0; i < rows.length; i++) {
          var dateCell = rows[i].getElementsByTagName('td')[3]; // Assuming the date is in the fourth column

          if (dateCell) {
            var rowDate = new Date(dateCell.textContent || dateCell.innerText);

            // Compare the selected date to the row date
            if (
              selectedDate.getFullYear() === rowDate.getFullYear() &&
              selectedDate.getMonth() === rowDate.getMonth() &&
              selectedDate.getDate() === rowDate.getDate()
            ) {
              rows[i].style.display = '';
            } else {
              rows[i].style.display = 'none';
            }
          }
        }
      });
    });

  </script>
</body>

</html>