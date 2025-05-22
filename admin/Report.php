<?php include '../includes/session_admin.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Report - Vermicompost Monitoring System</title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet"/>
</head>
<body class="has-fixed-sidenav">
   <?php include('../includes/sidenav_admin.php') ?>
 
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h1 class="header center orange-text">Write a Report</h1>
      <div class="row center">
      <div class="row">
      <form class="col s12 card">
        <div class="row">
          <div class="input-field col s6">
            <input id="report-title" type="text" data-length="10">
            <label for="report-title">Title</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12"">
            <textarea id="report-text" class="materialize-textarea validate s8" data-length="1500"></textarea>
         
          </div>
        </div>
        <button class="green lighten-0 waves-effect waves-light btn-small" onclick="printReport()" id="printBtn" name="printBtn">Print</button><br><br>

      </form>
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

  </body>
</html>
