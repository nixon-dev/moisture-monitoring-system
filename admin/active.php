<?php include '../includes/session_admin.php'; ?>
<?php include '../includes/online_users.php'; ?>

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
      <h5 style="font-weight: bold;">Who's Online</h5>
      <span>Real-time monitoring of online users</span><br>
      <div class="col s12 card">
        <div class="card-content z-depth-3">
          <table class="highlight">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Roles</th>
                <th>Last Activity</th>

              </tr>
            </thead>

            <tbody>
              <?php foreach ($online_users as $username => $data) {
                $active_roles = $data['roles'];
                $active_name = $data['name'];
                $active_profile = $data['profile'];
                $last_activity_time = $data['last_activity'];
                $current_time = time();
                $time_diff = $current_time - $last_activity_time;

                $last_activity = '';

                if ($time_diff < 60) {
                  $last_activity = '<img src="../images/active.png">&nbsp;&nbsp;&nbsp;Active';
                } else if ($time_diff < 120) {
                  $last_activity = round($time_diff / 60) . ' minutes ago';
                } else if ($time_diff < 300) {
                  $last_activity = round($time_diff / 60) . ' minutes ago';
                }
                ?>
                <tr>
                  <!-- START Profile PHP Code -->
                  <?php if ($active_profile == null): ?>
                    <td width="70"><img src="../images/default_profile.png" alt="" class="responsive-img circle"
                        style="width: 40px;margin-left: 10px;"></td>
                  <?php else: ?>
                    <td width="70"><img src="../images/profile/<?php echo $active_profile; ?>" alt=""
                        class="responsive-img circle" style="width: 40px;margin-left: 10px;"></td>
                  <?php endif; ?>
                  <!-- END Profile PHP Code -->
                  <td>
                    <?php echo $active_name ?>
                  </td>
                  <td>
                    <?php echo $active_roles; ?>
                  </td>
                  <td>
                    <?php echo $last_activity; ?>
                  </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
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