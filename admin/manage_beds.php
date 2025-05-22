<?php include '../includes/session_admin.php'; ?>
<?php include '../includes/beds.php'; ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Delete Beds - Vermicompost Monitoring System</title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">



  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/table.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/custom.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet" />

</head>

<body class="has-fixed-sidenav">
  <?php include('../includes/sidenav_admin.php') ?>
  <!--End of sidenav here-->
  <main>
    <div class="section no-pad-bot" id="index-banner">
      <div class="container">
        <h5 style="font-weight: bold;">Bed Management</h5>
        <span>Manage and delete beds</span><br>
        <div class="col s12 card">
          <div class="card-content z-depth-3">
            <div class="container">
              <table class="highlight responsive-table">
                <thead>
                  <tr>
                    <th>Bed Number</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($beds as $bed) { ?>
                    <tr>
                      <td data-id="<?php echo $bed['id']; ?>"><?php echo $bed['id']; ?></td>
                      <td data-name="<?php echo $bed['bedname']; ?>"><?php echo $bed['bedname']; ?></td>
                      <td><a class="red-text" href="../includes/delete_beds.php?id=<?php echo $bed['id']; ?>"><i
                            class="material-icons">delete</i></a></td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>







  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/materialize-custom.js"></script>
  <script src="../js/modal.js"></script>
  <script src="../js/setid.js"></script>
  <script src="../js/sidenav.js"></script>
</body>

</html>