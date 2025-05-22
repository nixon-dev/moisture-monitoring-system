<?php include('includes/db_conn.php');
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
$phone = $home['phonenumber'];


?>
<!doctypehtml>
    <html lang="en">

    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <meta content="width=device-width,initial-scale=1" name="viewport">
        <title>QSU RDET - Vermicompost Monitoring System</title>
        <link href="images/favicon.ico?v=2" rel="shortcut icon" type="image/x-icon">
        <link href="images/favicon.ico?v=2" rel="icon" type="image/x-icon">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/materialize.css" rel="stylesheet" type="text/css" media="screen,projection">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="screen,projection">
    </head>

    <body>
        <div class="parallax-container" id="index-banner">
            <div class="section no-pad-bot">
                <div class="container">
                    <h1 class="center green-text header text-darken-1"
                        style="text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000"><?php echo $title; ?></h1>
                        <h2 class="center green-text header text-darken-1"
                            style="text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000"><?php echo $subtitle; ?></h2>
                </div>
            </div>
            <div class="parallax"><img src="images/bgs/<?php echo $top; ?>" alt="Top Image"></div>
        </div>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="center col s12">
                        <h3><i class="brown-text mdi-content-send"></i></h3>
                        <h4><?php echo $title1; ?></h4>
                        <p class="left-align light"><?php echo $context1; ?></p>
                        <div class="slider">
                            <ul class="slides">
                                <li><img src="images/bgs/<?php echo $slider1; ?>"></li>
                                <li><img src="images/bgs/<?php echo $slider2; ?>"></li>
                                <li><img src="images/bgs/<?php echo $slider3; ?>"></li>
                                <li><img src="images/bgs/<?php echo $slider4; ?>"></li>
                                <li><img src="images/bgs/<?php echo $slider5; ?>"></li>
                                <li><img src="images/bgs/<?php echo $slider6; ?>"></li>
                                <li><img src="images/bgs/<?php echo $slider7; ?>"></li>
                            </ul>
                        </div>
                        <p class="left-align light"><?php echo $context2; ?></p>
                        <p class="left-align light"><?php echo $context3; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="parallax-container valign-wrapper">
            <div class="section no-pad-bot">
                <div class="container">
                    <div class="center row"></div>
                </div>
            </div>
            <div class="parallax"><img src="images/bgs/<?php echo $bottom; ?>" alt="Bottom Image"></div>
        </div>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="center col s12">
                        <h3><i class="brown-text mdi-content-send"></i></h3>
                        <h4>Objectives</h4>
                        <p class="left-align light">The primary objectives of this project are to design and to develop
                            a system for Quirino State University- Research and Development Extension Training
                            Vermicompost Monitoring System. Specifically, it seeks to:</p>
                        <p class="left-align light">1. Determine the practices and procedures in the vermicast
                            laboratory acquired by the staff members.</p>
                        <p class="left-align light">2. Identify the problem in monitoring the vermicompost soil moisture
                            of Quirino State University of RDET.</p>
                        <p class="left-align light">3. Design and develop an automated monitoring system to regulate the
                            vermicompost soil moisture.</p>
                        <p class="left-align light">4. Evaluate the acceptability and reliability of the proposed
                            system.</p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="green lighten-0 page-footer">
            <div class="container">
                <div class="row">
                    <div class="col s12 l4">
                        <h5 class="white-text">Quirino State University</h5>
                        <p class="grey-text text-lighten-4">Andres Bonifacio<br>Diffun, Quirino</p>
                        <p class="grey-text text-lighten-4"></p>
                    </div>
                    <div class="col s12 l4">
                        <h5 class="white-text">RDET</h5>
                        <p class="grey-text text-lighten-4">Email: <?php echo $email; ?><br>Tel: <?php echo $phone; ?></p>
                        <p class="grey-text text-lighten-4"></p>
                    </div>
                    <div class="col s12 l4">
                        <h5 class="white-text">LINKS</h5>
                        <p class="grey-text text-lighten-4"><a class="grey-text text-lighten-3"
                                href="login.php">Login</a><br><a class="grey-text text-lighten-3"
                                href="gallery.php">Gallery</a></p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container"><span>© 2023 <a class="grey-text text-lighten-3"
                            href="https://ko-fi.com/momijinanashi">QSU - RDET</a>, All rights reserved.</span><span
                        class="right">Made with <a class="grey-text text-lighten-3" href="https://materializecss.com"
                            target=”_blank”>MaterializeCSS</a></span></div>
            </div>
        </footer>
        <script>document.addEventListener("DOMContentLoaded", function () { var e = document.querySelectorAll(".slider"); M.Slider.init(e, { indicators: !0, height: 500, transition: 500, interval: 6e3 }) })</script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script>document.addEventListener("DOMContentLoaded", function () { var t = document.querySelectorAll(".fixed-action-btn"); M.FloatingActionButton.init(t, options) })</script>
    </body>

    </html>