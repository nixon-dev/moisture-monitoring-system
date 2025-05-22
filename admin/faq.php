<?php include '../includes/session_admin.php';
$dropdownActive = true; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>FAQ - Vermicompost Monitoring System</title>
  <link rel="shortcut icon" href="../images/favicon.ico?v=2" type="image/x-icon">
  <link rel="icon" href="../images/favicon.ico?v=2" type="image/x-icon">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="../css/sidenav.css" type="text/css" rel="stylesheet" />
  <link href="../css/custom.css" type="text/css" rel="stylesheet" />

</head>

<body class="has-fixed-sidenav">
  <?php include('../includes/sidenav_admin.php') ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h5 style="font-weight: bold;">FAQs</h5>
      <span>Frequently Asked Questions and Answers</span>
      <ul class="collapsible">
        <!-- First FAQ -->
        <li>
          <div class="collapsible-header" onclick="toggleIcon(this)"><i class="material-icons left"
              id="icon1">expand_more</i>How to create Administrator Account?</div>
          <div class="collapsible-body">
            <p>1. Visit the Users page by clicking on the following link: <a href="users.php">Users</a></p>
            <p>2. On the Users page, locate and click on the "Create User" button.</p>
            <p>3. Fill in all the required information in the provided fields. Make sure to select "Administrator" as
              the role for the user.</p>
            <p>4. Once you have entered all the necessary details, click on the "Submit" button to create the
              Administrator account.</p>
            <br>
            <p>For a visual guide, refer to the following steps:</p>
            <p>1. Visit the Users page by clicking on the following link: <a href="users.php">Users</a></p>
            <img class="materialboxed" width="300" src="../images/faqs/1-1.png">
            <p>2. On the Users page, locate and click on the "Create User" button.</p>
            <img class="materialboxed" width="300" src="../images/faqs/1-2.png">
            <p>3. Fill in all the required information in the provided fields. Make sure to select "Administrator" as
              the role for the user.</p>
            <img class="materialboxed" width="300" src="../images/faqs/1-3.png">
            <p>4. Once you have entered all the necessary details, click on the "Submit" button to create the
              Administrator account.</p>
          </div>
        </li>
        <!-- Second FAQ -->
        <li>
          <div class="collapsible-header" onclick="toggleIcon(this)"><i class="material-icons left"
              id="icon1">expand_more</i>How to deactivate Users Account?</div>
          <div class="collapsible-body">
            <p>1. Visit the Users page by clicking on the following link: <a href="users.php">Users</a></p>
            <p>2. On the Users page, find the user you want to deactivate and click on the "Deactivate" button
              associated with their account.</p>
            <br>
            <p>For a visual guide, refer to the following steps:</p>
            <p>1. Visit the Users page by clicking on the following link: <a href="users.php">Users</a></p>
            <img class="materialboxed" width="300" src="../images/faqs/1-1.png">
            <p>2. On the Users page, find the user you want to deactivate and click on the "Deactivate" button
              associated with their account.</p>
            <img class="materialboxed" width="300" src="../images/faqs/2-2.png">
          </div>
        </li>
        <!-- Third FAQ -->
        <li>
          <div class="collapsible-header" onclick="toggleIcon(this)"><i class="material-icons left"
              id="icon1">expand_more</i>How to reactivate or permanently delete Users Account?</div>
          <div class="collapsible-body">
            <p>1. Visit the Deactivated Users page by clicking on the following link: <a href="activate.php">Deactivated Users</a></p>
            <p>2. To delete a user, find the user you wish to remove. Once you have located the user, click on the "Delete" button associated with their account.</p>
            <p>3. To reactivate a user, find the user you wish to reactivate. Once you have located the user, click on the "Edit" button associated with their account.</p>
            <p>4. Select "Yes" and click on the activate button to reactivate the user.</p>
            <br>
            <p>For a visual guide, refer to the following steps:</p>
            <p>1. Visit the Users page by clicking on the following link: <a href="users.php">Users</a></p>
            <img class="materialboxed" width="300" src="../images/faqs/3-1.png">
            <p>2. On the Users page, find the user you want to delete and click on the "Delete" button associated with
              their account.</p>
            <img class="materialboxed" width="300" src="../images/faqs/2-2.png">
          </div>
        </li>
        <!-- Fourth FAQ -->
        <li>
          <div class="collapsible-header" onclick="toggleIcon(this)"><i class="material-icons left"
              id="icon1">expand_more</i>How to add more beds?</div>
          <div class="collapsible-body">
            <p>1. To add a new bed, simply click on the "Add Bed" option in the sidebar menu.</p>
            <br>
            <p>For a visual guide, refer to the following steps:</p>
            <p>1. To add a new bed, simply click on the "Add Bed" option in the sidebar menu.</p>
            <img class="materialboxed" width="300" src="../images/faqs/4-1.png">
          </div>
        </li>
        <!-- Fifth FAQ -->
        <li>
          <div class="collapsible-header" onclick="toggleIcon(this)"><i class="material-icons left"
              id="icon1">expand_more</i>How to change images on frontpage?</div>
          <div class="collapsible-body">
          <p>1. To customize your images, navigate to the "Image Settings" option in the sidebar menu. From there, you can modify and change the images according to your preferences.</p>
            <br>
            <p>For a visual guide, refer to the following steps:</p>
          <p>1. To customize your images, navigate to the "Image Settings" option in the sidebar menu. From there, you can modify and change the images according to your preferences.</p>
            <img class="materialboxed" width="300" src="../images/faqs/5-1.png">
          </div>
        </li>
      </ul>

    </div>
  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/materialize-custom.js"></script>
  <script> document.addEventListener('DOMContentLoaded', function () {
      var materialboxElems = document.querySelectorAll('.materialboxed');
      M.Materialbox.init(materialboxElems);
    });</script>


</body>

</html>