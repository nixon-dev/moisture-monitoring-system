<?php include '../includes/session_admin.php'; ?>
<?php include '../includes/users.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Users - Vermicompost Monitoring System</title>
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
        <h5 style="font-weight: bold;">Users Management</h5>
        <span>Manage and overview user accounts</span>
        <div class="col s12 card">
          <div class="card-content z-depth-3">
            <table class="highlight responsive-table">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Roles</th>
                  <th>Edit</th>
                  <th>Deactivate</th>
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
                    <td data-password="<?php echo $user['password']; ?>"><?php echo $user['password']; ?></td>
                    <td data-roles="<?php echo $user['roles']; ?>"><?php echo $user['roles']; ?></td>
                    <td><a href="#modal2" class="modal-trigger green-text" onclick="getIdValues(this)"><i
                          class="material-icons">edit</i></a></td>
                    <td><a class="red-text" href="../includes/delete_users.php?id=<?php echo $user['id']; ?>"><i
                          class="material-icons">person_remove</i></a></td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>



        <div class="row">
          <div class="col s12 m4 l2"> </div>
          <div class="col s12 m4 l8">
            <div class="center">
              <button class="green lighten-0 waves-effect waves-light btn modal-trigger" href="#modal1">Create
                User</button>
            </div>

            <!-- Signup form -->
            <div class="modal card" id="modal1">
              <div class="card-content z-depth-3">
                <h4 class="teal-text text-darken-3 center">Create New Users</h4>
                <form action="../includes/signupcode.php" method="POST">
                  <div class="input-field">
                    <input type="text" id="name_user" name="name_user" required>
                    <label for="name_user">Name</label>
                  </div>
                  <div class="input-field">
                    <input type="email" id="email" name="email" class="validate" required>
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Invalid Email"></span>
                  </div>
                  <div class="input-field">
                    <input type="text" id="username" name="username" required>
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                  </div>
                  <div class="input-field">
                    <select id="roles" name="roles" required>
                      <option value="" disabled selected>Select Roles</option>
                      <option value="Administrator">Administrator</option>
                      <option value="Staff">Staff</option>
                    </select>
                    <label for="roles">Roles</label>
                  </div>
                  <div class="input-field center-align">
                    <!-- PHP codes -->
                    <button class="green lighten-0 btn waves-effect waves-light" type="submit" id="adminsignupBtn"
                      name="adminsignupBtn">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- End of Signup Form -->
            <!-- Edit form -->
            <div class="modal card" id="modal2">
              <div class="card-content z-depth-3">
                <h5 class="grey-text text-darken-3" style="font-weight: bold;" id="edit_name" name="edit_name"></h5>
                <span>Please leave the text-input field empty if you wish to maintain its original content.</span>
                <form action="../includes/edit_users.php" method="POST">
                  <div class="input-field">
                    <input class="required" type="hidden" id="user_id" name="user_id">
                  </div>
                  <div class="input-field">
                    <input class="required" type="text" id="name_user" name="name_user">
                    <label for="name_user">Name</label>
                  </div>
                  <div class="input-field">
                    <input class="required" type="text" id="email" name="email">
                    <label for="email">Email</label>
                  </div>
                  <div class="input-field">
                    <input class="required" type="text" id="username" name="username">
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field">
                    <input class="required" type="password" id="password" name="password">
                    <label for="password">Password</label>
                  </div>
                  <div class="input-field">
                    <select id="roles" name="roles">
                      <option value="" disabled selected>Select Roles</option>
                      <option value="Administrator">Administrator</option>
                      <option value="Staff">Staff</option>
                    </select>
                    <label for="roles">Roles</label>
                  </div>
                  <div class="input-field center-align">


                    <button class="green lighten-0 btn waves-effect waves-light" type="submit" id="editBtn"
                      name="editBtn">Edit</button>
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