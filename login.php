<?php
session_start();

if (isset($_SESSION['id'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Vermicompost Monitoring System</title>
    <link rel="shortcut icon" href="images/favicon.ico?v=2" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon">



    <!-- CSS  -->
    <link href="css/custom.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />



</head>

<body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3 ">
                <!-- Login form -->
                <div class="card">
                    <div class="card-content z-depth-3">
                        <div class="center">
                            <img onClick="handleClick()" height="150" width="auto" src="images/logo.png">
                        </div>
                        <form action="includes/signincode.php">
                            <div class="input-field">
                                <input type="text" id="username" name="username" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" id="password" name="password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field center-align">
                              
                                <button class="green lighten-0 btn waves-effect waves-light" type="submit" id="login"
                                    name="login">Login</button>
                                    <div class="row"><a class="col s12 right-align blue-text"  href="forgot_password.php" >Forgot Password?</a></div>
                                
                            </div>
                        </form>
                        <br>


                        <div class="row">
                            <div class="col s6 left-align"><a href="index.php"
                                    class="green lighten-0 btn waves-effect waves-light"><i
                                        class="material-icons left">arrow_back</i>Back</a></div>
                            <div class="col s6 right-align"><button
                                    class="green lighten-0 btn waves-effect waves-light modal-trigger"
                                    href="#modal1">Create Account</button></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>






    </div>

    <!-- Signup form -->
    <div class="modal" id="modal1">
        <div class="modal-content z-depth-3">
            <h4 class="teal-text text-darken-3 center">Create New Users</h4>

            <?php if (isset($_GET['error'])): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          M.toast({html: '<?php echo $_GET['error']; ?>'});
        });
      </script>
    <?php endif; ?>
    <?php if (isset($_GET['msg'])): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          M.toast({html: '<?php echo $_GET['msg']; ?>'});
        });
      </script>
    <?php endif; ?>

            <?php if (isset($_GET['message'])): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          M.toast({html: '<?php echo $_GET['message']; ?>'});
        });
      </script>
    <?php endif; ?>
            <form action="includes/signupcode.php" method="POST">
                <div class="input-field">
                    <input type="text" id="name_user" name="name_user"  required>
                    <label for="name_user">Name</label>
                </div>
                <div class="input-field">
                    <input type="text" id="username" name="username"  required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field">
                    <input type="email" id="email" name="email" class="validate" required>
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Invalid Email"></span>
                </div>
                <div class="input-field">
                    <input type="password" id="password" name="password"  required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field center-align">

                    <button class="green lighten-0 btn waves-effect waves-light" type="submit" id="signupBtn"
                        name="signupBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End of Signup Form -->









    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="../js/modal.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });



        function showData(td) {
            // Get the text content of the clicked cell
            var data = td.textContent;

            // Put the data into a text field
            document.getElementById("user_id").value = data;
        }

        $(document).ready(function () {
            $('.modal').modal();
        }); </script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        // Get the value of the 'error' parameter
        const errorParam = urlParams.get('error');
        const messageParam = urlParams.get('message');

        // Check if the 'error' parameter exists and has a specific value
        if (errorParam || messageParam) {
            // Run your JavaScript code here
            $(document).ready(function () {
                $('.modal').modal();
                $('#modal1').modal('open');

                // Trigger a click event on the button
                $('#modal1').click();
            });
            // Add your code logic to handle the specific error or perform actions
        }

        var clickCount = 0;

        function handleClick() {

            clickCount++;

            if (clickCount >= 10) {
                window.location.href = "setup.php"; // Replace with the desired target page URL
            }
        }
    </script>

</body>

</html>