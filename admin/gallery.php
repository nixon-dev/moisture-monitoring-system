<?php include '../includes/session_admin.php'; ?>
<?php
$query = "SELECT * from images WHERE id = '1'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$top = $row['topimage'];
$slider1 = $row['slider1'];
$slider2 = $row['slider2'];
$slider3 = $row['slider3'];
$slider4 = $row['slider4'];
$slider5 = $row['slider5'];
$slider6 = $row['slider6'];
$slider7 = $row['slider7'];
$bottom = $row['bottomimage'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>Gallery - Vermicompost Monitoring System</title>
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


    <div class="center"><h4>Top Image</h4></div><br>
      <div class="row">
     

        <div class="col s12 m4 offset-m2 l8 offset-l2">
        <div class="section no-pad-bot">
          <div class="card-container">
          <img class="responsive-img" src="../images/bgs/<?php echo $top; ?>" alt="Top Image">
          
          </div>
        </div>
        <form action="../includes/gallery.php" class="center" method="POST" enctype="multipart/form-data">
        <div class=" file-field input-field">
          <div class="green btn">
            <span>Top Image</span>
            <input type="file" name="top_image" id="top_image">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" name="top_image" id="top_image" type="text">
          </div>
        </div>
        <button class="green btn waves-effect waves-light" type="submit" id="topBtn" name="topBtn">Apply</button>
      </form>

      </div>

      </div>

 <br><br>
      <div class="row center">
      <h4>Sliders</h4>
        <div class="col s6">
          <div class="row">
            <div class="col s12 center">
              <h3><i class="mdi-content-send brown-text"></i></h3>
              <div class="slider">
                <ul class="slides">
                  <li>
                    <img src="../images/bgs/<?php echo $slider1; ?>"> <!-- Slider 1 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 1</h3>
                    </div>
                  </li>
                  <li>
                    <img src="../images/bgs/<?php echo $slider2; ?>"> <!-- Slider 2 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 2</h3>
                    </div>
                  </li>
                  <li>
                    <img src="../images/bgs/<?php echo $slider3; ?>"> <!-- Slider 3 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 3</h3>
                    </div>
                  </li>
                  <li>
                    <img src="../images/bgs/<?php echo $slider4; ?>"> <!-- Slider 4 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 4</h3>
                    </div>
                  </li>
                  <li>
                    <img src="../images/bgs/<?php echo $slider5; ?>"> <!-- Slider 5 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 5</h3>
                    </div>
                  </li>
                  <li>
                    <img src="../images/bgs/<?php echo $slider6; ?>"> <!-- Slider 6 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 6</h3>
                    </div>
                  </li>
                  <li>
                    <img src="../images/bgs/<?php echo $slider7; ?>"> <!-- Slider 7 -->
                    <div class="caption left-align">
                      <h3 class="bold green white-text accent-4">Slider 7</h3>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col s6">
        <form action="../includes/gallery.php" class="center" method="POST" enctype="multipart/form-data">
                <div style="margin-top: 30px;" class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 1</span>
                    <input type="file" name="slider1_image" id="slider1_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider1_image" id="slider1_image" type="text">
                  </div>
                </div>
                <div class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 2</span>
                    <input type="file" name="slider2_image" id="slider2_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider2_image" id="slider2_image" type="text">
                  </div>
                </div>
                <div class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 3</span>
                    <input type="file" name="slider3_image" id="slider3_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider3_image" id="slider3_image" type="text">
                  </div>
                </div>
                <div class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 4</span>
                    <input type="file" name="slider4_image" id="slider4_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider4_image" id="slider4_image" type="text">
                  </div>
                </div>

                <div class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 5</span>
                    <input type="file" name="slider5_image" id="slider5_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider5_image" id="slider5_image" type="text">
                  </div>
                </div>

                <div class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 6</span>
                    <input type="file" name="slider6_image" id="slider6_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider6_image" id="slider6_image" type="text">
                  </div>
                </div>

                <div class=" file-field input-field">
                  <div class="green btn">
                    <span>Slider 7</span>
                    <input type="file" name="slider7_image" id="slider7_image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" name="slider7_image" id="slider7_image" type="text">
                  </div>
                </div>

                <button class="green btn waves-effect waves-light" type="submit" id="sliderBtn"
                  name="sliderBtn">Apply</button>
              </form>


        </div>
      </div>

      <div class="center"><h4>Bottom Image</h4></div><br>
      
      <div class="row">
     

        <div class="col s12 m4 offset-m2 l8 offset-l2">
        <div class="section no-pad-bot">
          <div class="card-container">
          <img class="responsive-img" src="../images/bgs/<?php echo $bottom; ?>" alt="Bottom Image">
          
          </div>
        </div>
        <form action="../includes/gallery.php" class="center" method="POST" enctype="multipart/form-data">
        <div class=" file-field input-field">
          <div class="green btn">
            <span>Bottom Image</span>
            <input type="file" name="bottom_image" id="bottom_image">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" name="bottom_image" id="bottom_image" type="text">
          </div>
        </div>
        <button class="green btn waves-effect waves-light" type="submit" id="bottomBtn" name="bottomBtn">Apply</button>
      </form>
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.slider');
      var options = {
        indicators: true,
        height: 500,
        transition: 500,
        interval: 6000
      };
      var instances = M.Slider.init(elems, options);
    });


  </script>

</body>

</html>