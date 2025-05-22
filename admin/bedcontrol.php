<?php include '../includes/session_admin.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Administrator - Vermicompost Monitoring System</title>
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
      <div class="row center">
        <div class="col12 s6 m4">


          <!-- Switch -->
          <div class="switch">
            <label>
              Off
              <input type="checkbox">
              <span class="lever"></span>
              On
            </label>
          </div>

          <!-- Disabled Switch -->
          <div class="switch">
            <label>
              Off
              <input type="checkbox">
              <span class="lever"></span>
              On
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>





  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/materialize-custom.js"></script>

</body>

</html>