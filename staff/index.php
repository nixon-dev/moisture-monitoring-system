<?php include '../includes/session_staff.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Staff - Vermicompost Monitoring System</title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet"/>
  <link href="../css/custom.css" type="text/css" rel="stylesheet"/>
  
</head>
<body class="has-fixed-sidenav">
<?php include('../includes/sidenav_staff.php') ?>
  
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h1 class="header center orange-text">Welcome <?php echo $name; ?></h1>
      <div class="row center">
        <!-- START Profile PHP Code -->
        <?php if($profile == null): ?>
              <div class="center"><img class="circle" height="250" width="auto" src="../images/default_profile.png"></img></div>
            <?php else: ?>
              <div class="center"><img class="circle" height="250" width="auto" src="../images/profile/<?php echo $profile;?>"></img></div>
            <?php endif; ?>
            <!-- END Profile PHP Code -->
      </div>
     
      <br><br>

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
