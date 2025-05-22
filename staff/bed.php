<?php include '../includes/session_staff.php'; ?>
<!-- PHP Code -->
<?php include '../includes/db_conn.php';
if (isset($_GET['id'])) {
  $bedNumber = $_GET['id'];
}
$sql = "SELECT * FROM logs WHERE bedname='$bedNumber' ORDER BY logdate DESC LIMIT 1";
$result = mysqli_query($link, $sql);
$logs = array();
while ($row = mysqli_fetch_assoc($result)) {
  $logs[] = $row;
  $gauge1 = $row['gauge1'];
  $gauge2 = $row['gauge2'];
  $gauge3 = $row['gauge3'];
}
$bedquery = "SELECT * FROM beds WHERE bedname=$bedNumber";
$bedresult = mysqli_query($link, $bedquery);
if ($bedresult && mysqli_num_rows($bedresult) >= 0) {
  $row = mysqli_fetch_assoc($bedresult);
  $manualSwitch = $row['manualswitch'];
} else {
  $manualSwitch = 'Off';
} ?>




<!-- End of PHP code -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Bed
    <?php echo $bedNumber; ?> - Vermicompost Monitoring System
  </title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/custom.css" type="text/css" rel="stylesheet" />
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet" />
</head>

<body class="has-fixed-sidenav">
  <?php include('../includes/sidenav_staff.php') ?>
  <input id="bednum" type="hidden" value="<?php echo $bedNumber; ?>">

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h5 style="font-weight: bold;">Bed
        <?php echo $bedNumber; ?>
      </h5>
      <span>Controls and Indicators for Bed</span>
      <div id="bed" class="col s12 card z-depth-3 ">

        <?php include('../includes/get_bed_gauges_values.php'); ?>

      </div>
    </div>
    <div class="center">
      <div class="container">
        <div class="row">
          <div class="col s6">
            <div class="switch">
              <h6 style="font-weight: bold;">Automatic Watering System</h6>
              <label>
                <input type="checkbox" id="bedSwitch"  <?php 
 if (!empty($bedSwitch)){
    if ($bedSwitch == 'On') {
        echo 'checked'; 
    } else {
        echo '';
    }
}    
    
    ?>  disabled>
                Off<span class="lever"></span>On
              </label>
            </div>
          </div>
          <div class="col s6">
            <div class="switch">
              <h6 style="font-weight: bold;">Manual Watering System</h6>
              <label>
                <input type="checkbox" id="manualSwitch" <?php 

if (!empty($manualSwitch)){
    if ($manualSwitch == 'On') {
        echo 'checked';
    } else {
        echo '';
    }
}

?><?php
                  // Manual Switch Conditions
                  if (!empty($currentScheduleToday)) {
                    if ($currentScheduleToday == 'Decomposing Period') {
                      
                    } elseif ($currentScheduleToday == 'Monitoring Period') {
                      echo "disabled";
                    } elseif ($snTodayArray == 'Harvesting Week') {
                      
                    } else {
                      echo "disabled";
                    }
                  } else {
                    echo "";
                  }
                  ?>>
                Off<span class="lever"></span>On
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  

  




  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/gauges.js"></script>
  <script src="../js/warning.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/materialize-custom.js"></script>
  <script>
    $(document).ready(function () {
      $('#bedSwitch').on('change', function () {
        var isChecked = $(this).is(':checked');
        var switchValue = isChecked ? 'On' : 'Off';

        // Send AJAX request to update the switch value in the database
        $.ajax({
          url: '../includes/update_switch.php', // Change to the appropriate PHP script file
          method: 'POST',
          data: {
            bedNumber: <?php echo $bedNumber; ?>,
            switchValue: switchValue
          },
          success: function (response) {
            // Handle the response from the PHP script if needed
            console.log(response);
          },
          error: function (xhr, status, error) {
            // Handle any errors if necessary
            console.log(error);
          }
        });
      });
      $('#manualSwitch').on('change', function () {
        var manualisChecked = $(this).is(':checked');
        var manualSwitchValue = manualisChecked ? 'On' : 'Off';

        // Send AJAX request to update the switch value in the database
        $.ajax({
          url: '../includes/update_switch.php', // Change to the appropriate PHP script file
          method: 'POST',
          data: {
            bedNumber: <?php echo $bedNumber; ?>,
            manualSwitchValue: manualSwitchValue
          },
          success: function (response) {
            // Handle the response from the PHP script if needed
            console.log(response);
          },
          error: function (xhr, status, error) {
            // Handle any errors if necessary
            console.log(error);
          }
        });
      });
    });
  </script>
  <script>
    const bedSwitch = document.getElementById('bedSwitch');
    const manualSwitch = document.getElementById('manualSwitch');

    bedSwitch.addEventListener('change', () => {
      setTimeout(reloadPage, 500);
    });

    manualSwitch.addEventListener('change', () => {
      setTimeout(reloadPage, 500);
    });


    function reloadPage() {
      location.reload();
    }
  </script>

  <script>
    window.onload = function () {
      setInterval(function () {
        checkRange1Value();
        checkRange2Value();
        checkRange3Value();
      }, 1000);
    }

    setTimeout(function () {
      location.reload();
    }, 60000); // 60000 milliseconds = 1 minute

  </script>


  <script>
    // Function to reload the PHP include file
    var bednumValue = document.getElementById("bednum").value;
    var url = "../includes/get_bed_gauges_values.php?id=" + bednumValue;
    function reloadInclude() {
      $("#bed").load(url);
    }

    // Reload the PHP include file every 5 seconds
    setInterval(reloadInclude, 5000);
  </script>



</body>

</html>