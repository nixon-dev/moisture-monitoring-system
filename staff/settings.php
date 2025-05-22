<?php include '../includes/session_staff.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Settings - Vermicompost Monitoring System</title>
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
     

      <!-- Code here -->
      <div class="row">
      <div class="col s12 m4 l2"><p></p></div>
      <div class="card col s12 m4 l8">
          <div class="card-content">
            <!-- START Profile PHP Code -->
            <?php if($profile == null): ?>
              <div class="center"><img class="circle" height="150" width="auto" src="../images/default_profile.png"></img></div>
            <?php else: ?>
              <div class="center"><img class="circle" height="150" width="auto" src="../images/profile/<?php echo $profile;?>"></img></div>
            <?php endif; ?>
            <!-- END Profile PHP Code -->
            <form action="../includes/updateuser.php" method="POST" enctype="multipart/form-data">
              <div class="file-field input-field">
                <div class="btn green">
                  <span>Profile Picture</span>
                  <input type="file" name="profile_picture" id="profile_picture">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" name="profile_picture" id="profile_picture" type="text" placeholder="Upload your profile picture">
                </div>
              </div>
              <!-- PHP CODE  TO GET COLUMN'S VALUES -->
              <?php 
                $id = $_SESSION['id'];
                $query = "SELECT * from users WHERE id = '$id'";
                $result = mysqli_query($link,$query);
                  $row = mysqli_fetch_assoc($result);
                  $name = $row['name'];
                  $email = $row['email'];
                  $username = $row['username'];
                  $password = $row['password'];                  
              ?>
              <!-- END OF PHP CODE -->
              <div class="input-field">
                                <input class="required" type="text" id="name_user" name="name_user" value="<?php echo $name; ?>">
                                <label for="name_user">Name</label>
                            </div>
                            <div class="input-field">
                                <input class="required" type="text" id="email" name="email" value="<?php echo $email; ?>">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input class="required" type="text" id="username" name="username" value="<?php echo $username; ?>">
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field">
                                <input class="required" type="password" id="password" name="password" value="<?php echo $password; ?>">
                                <label for="password">Password</label>
                                <span class="prefix"><i class="material-icons" id="toggle-password">visibility</i></span>                                
                            </div>
                            <!-- PHP Code Include here -->
              
                <div class="center"><button class="green btn waves-effect waves-light" type="submit" id="uploadBtn" name="uploadBtn">Update<i class="material-icons right">send</i></button></div>
            </form>
          </div>
      </div>
      <div class="col s12 m4 l2"><p></p></div>
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
