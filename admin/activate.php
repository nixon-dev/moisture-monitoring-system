<?php include '../includes/session_admin.php'; ?>
<?php
// Connect to database and fetch user data
include '../includes/db_conn.php'; // Include your database connection file

$sql = "SELECT * FROM users WHERE activated != 'Yes'"; // SQL query to fetch all users
$result = mysqli_query($link, $sql); // Execute query and store result

// Fetch user data into an array
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
  $users[] = $row;
}

// Close database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Activate - Vermicompost Monitoring System</title>
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


  <main>
    
    <div class="section no-pad-bot" id="index-banner">
      <div class="container">
        <h5 style="font-weight: bold;">Deactivate Account Management</h5>
        <span>Manage and overview of deactivated user accounts</span><br>
        <div class="col s12 card">
          <div class="card-content z-depth-3">
            <table class="highlight responsive-table">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Roles</th>
                  <th>Activated</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($users as $user) { ?>
                  <tr>
                    <td data-id="<?php echo $user['id']; ?>"><?php echo $user['id']; ?></td>
                    <td width="70"><img src="../images/profile/<?php echo $user['profilepfn']; ?>" alt=""
                        class="responsive-img circle" style="width: 40px;margin-left: 10px;"></td>
                    <td data-name="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></td>
                    <td data-email="<?php echo $user['email']; ?>"><?php echo $user['email']; ?></td>
                    <td data-username="<?php echo $user['username']; ?>"><?php echo $user['username']; ?></td>
                    <td data-roles="<?php echo $user['roles']; ?>"><?php echo $user['roles']; ?></td>
                    <td data-roles="<?php echo $user['activated']; ?>"><?php echo $user['activated']; ?></td>
                    <td><a href="#modal2" class="modal-trigger green-text" onclick="getIdValues(this)"><i
                          class="material-icons">edit</i></a></td>
                    <td><a class="red-text" href="../includes/delete_inactive_users.php?id=<?php echo $user['id']; ?>"><i
                          class="material-icons">delete</i></a></td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>




        <div class="row">
          <div class="col s12 m4 l2"> </div>
          <div class="col s12 m4 l8">


            <!-- Edit form -->
            <div class="modal card" id="modal2">
              <div class="card-content z-depth-3">
                <h4 class="teal-text text-darken-3 center">Activate User</h4>

                <form action="../includes/activate_users.php" method="POST">
                  <div class="input-field">
                    <input class="required" type="hidden" id="user_id" name="user_id">
                  </div>
                  <div class="input-field">
                    <select id="activated" name="activated">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                    <label for="activated">Activate?</label>
                  </div>
                  <div class="input-field center-align">
                    <!-- PHP codes -->

                    <?php include('../includes/activate_users.php'); ?> <br><br>
                    <button class="green lighten-0 btn waves-effect waves-light" type="submit" id="editBtn"
                      name="editBtn">Activate</button>
                  </div>
                </form>
              </div>
            </div>

          </div>
          <div class="col s12 m4 l2"></div>
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