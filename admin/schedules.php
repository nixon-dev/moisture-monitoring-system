<?php include '../includes/session_admin.php'; ?>
<?php $bedName = $_GET['id'];
include '../includes/db_conn.php';
$sql = "SELECT * FROM bedschedules WHERE bedname='$bedName' ORDER BY startdate ASC";
$result = mysqli_query($link, $sql);
$scheds = array();
while ($row = mysqli_fetch_assoc($result)) {
  $scheds[] = $row;
}
mysqli_close($link); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Schedules - Vermicompost Monitoring System</title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet" />
</head>

<body class="has-fixed-sidenav">
  <?php include('../includes/sidenav_admin.php') ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h5 style="font-weight: bold;">Schedules for Bed
        <?php echo $bedName; ?>
      </h5>
      <span>Overview of Scheduled Dates and Settings</span><br>
      <span>AWS stand for Automatic Watering System</span>
      <?php if (isset($_GET['msg'])): ?>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            M.toast({ html: '<?php echo $_GET['msg']; ?>' });
          });
        </script>
      <?php endif; ?>

      <div class="col s12 card">
        <div class="card-content z-depth-3">
          <table class="highlight responsive-table centered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Schedule Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>AWS Switch</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($scheds as $sched) { ?>
                <tr>
                  <td>
                    <?php echo $sched['id']; ?>
                  </td>
                  <td>
                    <?php echo $sched['name']; ?>
                  </td>
                  <td>
                    <?php echo date('M d, Y', strtotime($sched['startdate'])); ?>
                  </td>
                  <td>
                    <?php echo date('M d, Y', strtotime($sched['enddate'])); ?>
                  </td>
                  <td>
                    <?php echo $sched['sched_switch']; ?>
                  </td>
                  <td><a href="#modal2" class="modal-trigger green-text" onclick="getIdValues(this)"><i
                        class="material-icons">edit</i></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="center">
        <a class="green waves-effect waves-light btn modal-trigger" href="bed.php?id=<?php echo $_GET['id']; ?>"> <i
            class="left material-icons">computer</i>View Bed Gauges</a>
      </div>
    </div>
  </div>

  <!-- Edit form -->
  <div class="modal card" id="modal2">
    <div class="card-content z-depth-3">
      <h5 style="font-weight: bold;">Editing Schedule ID: <span id="editsched_name" name="editsched_name"></span> </h5>

      <span>Please select the desired date range for activating the automated watering system.</span><br><br>
      <form method="POST" action="../includes/edit_schedules.php">
        <div class="input-field">
          <input type="hidden" id="sched_id" name="sched_id">
        </div>
        <div class="input-field">
          <input type="hidden" id="bedname" name="bedname" value="<?php echo $_GET['id']; ?>">
        </div>
        <div class="input-field">
          <select id="editschedName" name="editschedName">
            <option value="unaltered">Choose Schedule Name (Unaltered)</option>
            <option value="Decomposing Period">Decomposing Period</option>
            <option value="Monitoring Period">Monitoring Period</option>
            <option value="Harvesting Week">Harvesting Week</option>
          </select>
          <label class="grey-text text-darken-3">Schedule Name</label>
        </div>
        <div class="input-field">
          <input type="text" id="startscheds" name="startscheds" class="datepicker3">
          <label class="grey-text text-darken-3" for="startscheds">Start</label>
        </div>
        <div class="input-field">
          <input type="text" id="endscheds" name="endscheds" class="datepicker4">
          <label class="grey-text text-darken-3" for="endscheds">End</label>
        </div>

        <div class="input-field">
          <select id="schedSwitch" name="schedSwitch">
            <option value="Off">Off</option>
            <option value="On">On</option>
          </select>
          <label class="grey-text text-darken-3">Automated Watering System</label>
        </div>
        <div class="center"><br>
          <button class="green btn waves-effect waves-light" type="submit" name="editschedBtn" id="editschedBtn">Submit
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
  </div>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/modal.js"></script>
  <script src="../js/materialize-custom.js"></script>
  <script>
    function getIdValues(button) {
      var row = button.parentNode.parentNode;
      var ids = row.cells[0].innerHTML;
      var trimmedIds = ids.trim();
      document.getElementById("sched_id").value = trimmedIds;
      document.getElementById("editsched_name").innerHTML = trimmedIds;
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var dp1Elem = document.querySelector('.datepicker1');
      var dp2Elem = document.querySelector('.datepicker2');
      var dp3Elem = document.querySelector('.datepicker3');
      var dp4Elem = document.querySelector('.datepicker4');
      var dp1Ins = M.Datepicker.init(dp1Elem, {
        // Options for the date picker
      });
      var dp2Ins = M.Datepicker.init(dp2Elem, {
        // Options for the date picker
      });
      var dp3Ins = M.Datepicker.init(dp3Elem, {
        // Options for the date picker
      });
      var dp4Ins = M.Datepicker.init(dp4Elem, {
        // Options for the date picker
      });
    });
  </script>
</body>

</html>