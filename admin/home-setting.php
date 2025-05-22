<?php
include('../includes/session_admin.php');
include('../includes/updatehompage.php');
$homepagequery = "SELECT * FROM homepage WHERE id ='1'";
$homapageresult = mysqli_query($link, $homepagequery);
$home = mysqli_fetch_assoc($homapageresult);
$title = $home['title'];
$subtitle = $home['subtitle'];
$title1 = $home['title1'];
$context1 = $home['context1'];
$context2 = $home['context2'];
$context3 = $home['context3'];
$email = $home['email'];
$phonenumber = $home['phonenumber'];



?>
<?php if (!empty($message)): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      M.toast({ html: '<?php echo $message; ?>' });
    });
  </script>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Settings - Vermicompost Monitoring System</title>
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
      <h5 style="font-weight: bold;">Homepage Settings</h5>
      <span>Edit texts on hompage</span>

      <div class="row">
        <div class="card col s12 m12 l12">
          <div class="card-content">
            <form method="POST" enctype="multipart/form-data" class="col s12">
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="title" name="title" class="materialize-textarea"><?php echo $title; ?></textarea>
                  <label for="title">Title</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="subtitle" name="subtitle"
                    class="materialize-textarea"><?php echo $subtitle; ?></textarea>
                  <label for="subtitle">Subtitle</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="title1" name="title1" class="materialize-textarea"><?php echo $title1; ?></textarea>
                  <label for="title1">Context Title</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="context1" name="context1"
                    class="materialize-textarea"><?php echo $context1; ?></textarea>
                  <label for="context1">Context 1</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="context2" name="context2"
                    class="materialize-textarea"><?php echo $context2; ?></textarea>
                  <label for="context2">Context 2</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="context3" name="context3"
                    class="materialize-textarea"><?php echo $context3; ?></textarea>
                  <label for="context3">Context 3</label>
                </div>
              </div>
              <div class="center"><button class="green btn waves-effect waves-light" type="submit"
                  id="updateHomepageBtn" name="updateHomepageBtn">Update<i
                    class="material-icons right">send</i></button></div><br />
            </form>
          </div>
        </div>
      </div><br />

      <h5 style="font-weight: bold;">Footer</h5>
      <span>Edit information on the footer of the homepage</span>
      <div class="row">
        <div class="card col s12 m12 l12">
          <div class="card-content">
            <form method="POST" enctype="multipart/form-data" class="col s12">
              <div class="row">
                <div class="input-field col s12">
                  <input id="footer-email" name="footer-email" type="email" class="validate" required value="<?php echo $email; ?>">
                  <label for="footer-email">Email</label>
                  <span class="helper-text" data-error="Invalid email"></span>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="phone-number" name="phone-number" type="text" class="validate" required value="<?php echo $phonenumber; ?>">
                  <label for="phone-number">Phone Number</label>
                </div>
              </div>

              <div class="center"><button class="green btn waves-effect waves-light" type="submit" id="footerBtn"
                  name="footerBtn">Update<i class="material-icons right">send</i></button></div><br />
            </form>
          </div>
        </div>
      </div><br />







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