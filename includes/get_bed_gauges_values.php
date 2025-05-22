<html>
<?php
include('db_conn.php');
if (isset($_GET['id'])) {
  $bedNumber = mysqli_real_escape_string($link, $_GET['id']);

  $sql = "SELECT * FROM logs WHERE bedname = ? ORDER BY logdate DESC LIMIT 1";
  $stmt = mysqli_prepare($link, $sql);

  // Bind the parameter
  mysqli_stmt_bind_param($stmt, "s", $bedNumber);

  // Execute the query
  mysqli_stmt_execute($stmt);

  // Check for query errors
  if (mysqli_stmt_errno($stmt)) {
    // Handle the error, e.g., display an error message or log it
    $error = mysqli_stmt_error($stmt);
    // ...
  }

  // Get the result set
  $result = mysqli_stmt_get_result($stmt);

  // Fetch user data into an array
  $logs = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
    $gauge1 = $row['gauge1'];
    $gauge2 = $row['gauge2'];
    $gauge3 = $row['gauge3'];
  }

  // Clean up the prepared statement
  mysqli_stmt_close($stmt);
}

$bedquery = "SELECT * FROM beds WHERE bedname=$bedNumber";
$bedresult = mysqli_query($link, $bedquery);
if ($bedresult && mysqli_num_rows($bedresult) >= 0) {
  $row = mysqli_fetch_assoc($bedresult);
  $manualSwitch = $row['manualswitch'];
} else {
  $manualSwitch = 'Off';
}
?>

<?php
$schedquery = "SELECT * FROM bedschedules WHERE bedname = '$bedNumber' ORDER BY startdate ASC";
$schedresult = mysqli_query($link, $schedquery);

$today = date("Y-m-d");
$harvestingBeds = array(); // Initialize an array to store beds with harvesting days
$endingSchedules = array();

if ($schedresult && mysqli_num_rows($schedresult) > 0) {
  while ($row = mysqli_fetch_assoc($schedresult)) {
    $startD = date('Y-m-d', strtotime($row['startdate']));
    $endD = date('Y-m-d', strtotime($row['enddate']));
    $harvestD = $row['harvest'];
    $bedname = $row['bedname'];
    $schedName = $row['name'];

    if ($today >= $startD && $today <= $endD && $harvestD == 'Yes') {
      $harvestingBeds[] = "Harvesting Day";
    }

    if ($today == $endD) {
      $endingSchedules[] = "$schedName Ending Today";
    }
  }
}
?>


<?php
$snTodayArray = array();
$snquery = "SELECT * FROM bedschedules WHERE bedname = '$bedNumber' ORDER BY startdate DESC";
$snresult = mysqli_query($link, $snquery);
if ($snresult && mysqli_num_rows($snresult) > 0) {
  while ($snrow = mysqli_fetch_assoc($snresult)) {
    $snstartD = date('Y-m-d', strtotime($snrow['startdate']));
    $snendD = date('Y-m-d', strtotime($snrow['enddate']));
    $snToday = $snrow['name'];
    $snSwitch = $snrow['sched_switch'];

    if ($today >= $snstartD && $today <= $snendD) {
      $currentScheduleToday = $snToday;
      $bedSwitch = $snSwitch;
    } else {
      $currentScheduleToday = "";
    }
  }
}
?>




<div class="bed-bg gauge-container">
  <div class="col center" style="padding-top: 1px;padding-bottom: 20px;">
    <h4 style="font-weight: bold;" class="center yellow-text">
      <?php
      if (!empty($currentScheduleToday)) {
        if ($currentScheduleToday == 'Decomposing Period') {
          echo "Decomposing Period";
        } elseif ($currentScheduleToday == 'Monitoring Period') {
          echo "Monitoring Period";
        } elseif ($currentScheduleToday == 'Harvesting Week') {
          echo "Harvesting Week";
        } else {
          echo "Error";
        }
      } else {
        echo "No Existing Schedules Today";
      }


      ?>
    </h4>
    <span class="center yellow-text">
      <?php
      if ($currentScheduleToday == 'Harvesting Week') {
        echo "Ready for harvest";
      } else {
        echo "";
      }
      if (!empty($endingSchedules)) {
        foreach ($endingSchedules as $schedule) {



          if ($schedule == 'Harvesting Week Ending Today') {
            // echo "Ready for harvest";
          } else {
            echo $schedule;
          }
        }
      } else {
        echo "";
      }

      if (!empty($harvestingBeds)) {
        foreach ($harvestingBeds as $bed) {
          echo $bed;
        }
      } else {
        echo "";
      }

      if (empty($harvestingBeds) && empty($endingSchedules)) {
        // echo "<p style='margin-left: 20px;'>No new notification</p>";
        echo "&nbsp";
      }

      ?>
    </span><br>
    <span class="yellow-text">
      <?php 
      
      if (!empty($manualSwitch)) {
        if ($manualSwitch == 'On'){
          echo '(Manual Watering System is ON)';
        } else {
          echo '(Manual Watering System is OFF)';
        }
      }else {
        echo '(Manual Watering System is OFF)';
      }
      
      ?>

    </span><br>
    <span class="yellow-text">
      <?php
      if (!empty($bedSwitch)) {
        if ($bedSwitch == 'On') {
          echo '(Automatic Watering System is ON)';
        } else {
          echo '(Automatic Watering System is OFF)';
        }
      }else {
        echo '(Automatic Watering System is OFF)';
      }
      ?>
    </span>
    

  </div>
  <div class="row" style="margin-left: 25px;">
    <!--First Gauge -->
    <div class="col s4 l4">
      <div id="gauge">
        <div id="major-ticks">
          <span>0</span>
          <span>50</span>
          <span>100</span>
        </div>
        <div id="minor-ticks">
          <span title="--i:0"></span>
          <span title="--i:10"></span>
          <span title="--i:15"></span>
          <span title="--i:20"></span>
          <span title="--i:25"></span>
          <span title="--i:30"></span>
          <span title="--i:35"></span>
          <span title="--i:40"></span>
          <span title="--i:45"></span>
          <span title="--i:50"></span>
          <span title="--i:55"></span>
          <span title="--i:60"></span>
          <span title="--i:65"></span>
          <span title="--i:70"></span>
          <span title="--i:75"></span>
          <span title="--i:80"></span>
          <span title="--i:85"></span>
          <span title="--i:90"></span>
          <span title="--i:95"></span>
          <span title="--i:100"></span>
        </div>
        <div id="minor-ticks-bottom-mask"></div>
        <div id="bottom-circle"></div>
        <svg version="1.1" baseProfile="full" class="svg-size" xmlns="http://www.w3.org/2000/svg">

          <?php
          if ($gauge1 <= 40) {
            $gradientColorStart1 = '#ff0000'; // Color for values below or equal to 40
            $gradientColorStop1 = '#ff0000'; // Color for values below or equal to 40
          } else {
            $gradientColorStart1 = '#00FF00'; // Color for values below or equal to 40
            $gradientColorStop1 = '#00FF00'; // Color for values below or equal to 40
          }
          if ($gauge2 <= 40) {
            $gradientColorStart2 = '#ff0000'; // Color for values below or equal to 40
            $gradientColorStop2 = '#ff0000'; // Color for values below or equal to 40
          } else {
            $gradientColorStart2 = '#00FF00'; // Color for values below or equal to 40
            $gradientColorStop2 = '#00FF00'; // Color for values below or equal to 40
          }
          if ($gauge3 <= 40) {
            $gradientColorStart3 = '#ff0000'; // Color for values below or equal to 40
            $gradientColorStop3 = '#ff0000'; // Color for values below or equal to 40
          } else {
            $gradientColorStart3 = '#00FF00'; // Color for values below or equal to 40
            $gradientColorStop3 = '#00FF00'; // Color for values below or equal to 40
          }
          ?>

          <!-- Use the dynamic gradient colors in your linearGradient definition -->
          <linearGradient id="gradient1" x1="0" x2="1" y1="0" y2="0">
            <stop offset="0%" stop-color="<?php echo $gradientColorStart1; ?>" />
            <stop offset="100%" stop-color="<?php echo $gradientColorStop1; ?>" />
          </linearGradient>

          <path id="arc1" d="M5 95 A80 80 0 0 1 185 95" stroke=url(#gradient1) fill="none" stroke-width="10"
            stroke-linecap="round" stroke-dasharray="0 282.78" />
        </svg>
        <div id="center-circle">
          <span id="name">MOISTURE</span>
          <span class="tem" id="temperature1">
            <?php echo $gauge1; ?>
          </span>
        </div>
      </div>
    </div>

    <!--Second Gauge -->
    <div class="col s4 l4">

      <div id="gauge">
        <div id="major-ticks">
          <span>0</span>
          <span>50</span>
          <span>100</span>
        </div>
        <div id="minor-ticks">
          <span title="--i:0"></span>
          <span title="--i:10"></span>
          <span title="--i:15"></span>
          <span title="--i:20"></span>
          <span title="--i:25"></span>
          <span title="--i:30"></span>
          <span title="--i:35"></span>
          <span title="--i:40"></span>
          <span title="--i:45"></span>
          <span title="--i:50"></span>
          <span title="--i:55"></span>
          <span title="--i:60"></span>
          <span title="--i:65"></span>
          <span title="--i:70"></span>
          <span title="--i:75"></span>
          <span title="--i:80"></span>
          <span title="--i:85"></span>
          <span title="--i:90"></span>
          <span title="--i:95"></span>
          <span title="--i:100"></span>
        </div>
        <div id="minor-ticks-bottom-mask"></div>
        <div id="bottom-circle"></div>
        <svg version="1.1" baseProfile="full" class="svg-size" xmlns="http://www.w3.org/2000/svg">
          <linearGradient id="gradient2" x1="0" x2="1" y1="0" y2="0">
            <stop offset="0%" stop-color="<?php echo $gradientColorStart2; ?>" />
            <stop offset="100%" stop-color="<?php echo $gradientColorStop2; ?>" />
          </linearGradient>
          <path id="arc2" d="M5 95 A80 80 0 0 1 185 95" stroke=url(#gradient2) fill="none" stroke-width="10"
            stroke-linecap="round" stroke-dasharray="0 282.78" />
        </svg>
        <div id="center-circle">
          <span id="name">MOISTURE</span>
          <span class="tem" id="temperature2">
            <?php echo $gauge2; ?>
          </span>
        </div>

      </div>
    </div>


    <!--Third Gauge -->
    <div class="col s4 l4">
      <div id="gauge">
        <div id="major-ticks">
          <span>0</span>
          <span>50</span>
          <span>100</span>
        </div>
        <div id="minor-ticks">
          <span title="--i:0"></span>
          <span title="--i:10"></span>
          <span title="--i:15"></span>
          <span title="--i:20"></span>
          <span title="--i:25"></span>
          <span title="--i:30"></span>
          <span title="--i:35"></span>
          <span title="--i:40"></span>
          <span title="--i:45"></span>
          <span title="--i:50"></span>
          <span title="--i:55"></span>
          <span title="--i:60"></span>
          <span title="--i:65"></span>
          <span title="--i:70"></span>
          <span title="--i:75"></span>
          <span title="--i:80"></span>
          <span title="--i:85"></span>
          <span title="--i:90"></span>
          <span title="--i:95"></span>
          <span title="--i:100"></span>
        </div>
        <div id="minor-ticks-bottom-mask"></div>
        <div id="bottom-circle"></div>
        <svg version="1.1" baseProfile="full" class="svg-size" xmlns="http://www.w3.org/2000/svg">
          <linearGradient id="gradient3" x1="0" x2="1" y1="0" y2="0">
            <stop offset="0%" stop-color="<?php echo $gradientColorStart3; ?>" />
            <stop offset="100%" stop-color="<?php echo $gradientColorStop3; ?>" />
          </linearGradient>
          <path id="arc3" d="M5 95 A80 80 0 0 1 185 95" stroke=url(#gradient3) fill="none" stroke-width="10"
            stroke-linecap="round" stroke-dasharray="0 282.78" />
        </svg>
        <div id="center-circle">
          <span id="name">MOISTURE</span>
          <span class="tem" id="temperature3">
            <?php echo $gauge3; ?>
          </span>
        </div>

      </div>

    </div>
  </div>

  <!--This is where the range should be placed -->
  <div class="row center">
    <form action="../includes/log.php?bed=<?php echo $bedNumber; ?>" method="POST">
      <!--First Range -->
      <div class="col s4 range-field">
        <input type="range" class="ran invi" id="range1" name="range1" max="100" min="0" value="<?php echo $gauge1; ?>"
          onload="checkRange1Value()">
        <p id="warning1buffer" style="display:block;color:red;font-weight:bold;">&nbsp</p>
        <p id="warning1" class="warning">Warning:
          Moisture Level is low</p>

      </div>

      <!--Second Range -->
      <div class="col s4 range-field">

        <input type="range" class="ran invi" id="range2" name="range2" max="100" min="0" value="<?php echo $gauge2; ?>"
          onload="checkRange2Value()">
        <p id="warning2buffer" style="display:block;color:red;font-weight:bold;">&nbsp</p>
        <p id="warning2" class="warning">Warning:
          Moisture Level is low</p>
      </div>


      <!--Third Range -->
      <div class="col s4 range-field">

        <input type="range" class="ran invi" id="range3" name="range3" max="100" min="0" value="<?php echo $gauge3; ?>"
          onload="checkRange3Value()">
        <p id="warning3buffer" style="display:block;color:red;font-weight:bold;">&nbsp</p>
        <p id="warning3" class="warning">Warning:
          Moisture Level is low</p>

      </div>


    </form>
  </div>
  <!-- End of range -->
</div>


<script src="../js/gauges.js"></script>
<script src="../js/warning.js"></script>
<script src="../js/sidenav.js"></script>

</html>