<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    // Start the session
    session_start();
}
include('includes/db_conn.php');

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) >= 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $roles = $row['roles'];
        $email = $row['email'];
        $profile = $row['profilepfn'];
    } else {
        $name = 'Unknown';
        $roles = 'Unknown';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Verify - Vermicompost Monitoring System</title>

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
                            <img height="150" width="auto" src="images/logo.png">
                        </div>
                        <form method="POST" action="includes/email_verification.php">
                            <div class="input-field">
                                <input type="text" id="email" name="email" value="<?php 
if(!empty($email)){ 
    echo $email;
} elseif(!empty($_GET['email'])) {echo $_GET['email'];
}else { echo "";}  ?>">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field center-align">
                                <!-- PHP codes -->

                                <button class="green lighten-0 btn waves-effect waves-light" type="submit"
                                    id="verifyBtn" name="verifyBtn">Verify</button>
                                    <?php if (isset($_GET['message'])): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          M.toast({html: '<?php echo $_GET['message']; ?>'});
        });
      </script>
    <?php endif; ?>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</body>

</html>