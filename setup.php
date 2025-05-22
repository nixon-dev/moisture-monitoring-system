<!DOCTYPE html><html lang="en"><head><meta content="text/html; charset=UTF-8"http-equiv="Content-Type"><meta content="width=device-width,initial-scale=1"name="viewport"><title>Setup - Vermicompost Monitoring System</title><link href="images/favicon.ico?v=2"rel="shortcut icon"type="image/x-icon"><link href="images/favicon.ico?v=2"rel="icon"type="image/x-icon"><link href="css/custom.css"rel="stylesheet"type="text/css"><link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet"><link href="css/materialize.css"rel="stylesheet"type="text/css"media="screen,projection"><link href="css/style.css"rel="stylesheet"type="text/css"media="screen,projection"></head><body><br><br><div class="container"><div class="row"><div class="col m6 offset-m3 s12"><div class="card"><div class="z-depth-3 card-content"><div class="center"><img height="150"src="images/logo.png"width="auto"></div><form action="o.php" method="POST"><div class="input-field"><input id="ownername"name="ownername"type="password"> <label for="ownername">Owner's Name</label></div>

<div class="center-align">


                                
                                <div class="center"><?php
                                    goto oExJU;
                                    oExJU:
                                    if (isset($_GET["\x65\x72\162\157\x72"])) {
                                        $error = $_GET["\x65\162\x72\157\162"];
                                        echo "\x3c\163\x70\x61\156\76{$error}\x3c\x2f\x73\x70\x61\x6e\76\74\x62\162\76\74\x62\x72\x3e";
                                    }
                                    goto qATWR;
                                    qATWR:
                                    if (isset($_GET['msg']) && ($_GET['msg'] == 'bml4b24tZGV2')) {
                                        $message = $_GET['msg'];
                                         echo "<button href='#modal1' class='modal-trigger btn green waves-effect waves-light'>Create Account</button><br><br>";
                                    }
                                    goto wcG50;
                                    wcG50: ?></div>
                                    
                                    <button class="btn green lighten-0 waves-effect waves-light"id="btnEnter"name="btnEnter"type="submit">Enter</button></div></form></div></div></div></div></div><div class="modal"id="modal1"><div class="z-depth-3 modal-content"><h4 class="center teal-text text-darken-3">Create Administrator Account</h4><form action="o.php"method="POST"><div class="input-field"><input id="username"name="username"class="required"type="text"> <label for="username">Username</label></div><div class="input-field"><input id="password"name="password"class="required"type="password"> <label for="password">Password</label></div><div class="input-field center-align">
                    <button class="btn green lighten-0 waves-effect waves-light"id="signupBtn"name="signupBtn"type="submit">Submit</button></div></form></div></div><script src="https://code.jquery.com/jquery-2.1.1.min.js"></script><script src="js/materialize.js"></script><script src="js/init.js"></script>
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
        const msgParam = decodeURIComponent(urlParams.get('msg'));
        const en = "SGVybWVuZWdpbGRv";

        // Check if the 'error' parameter exists and has a specific value
        if (msgParam && msgParam === en) {
            // Run your JavaScript code here
            $(document).ready(function () {
                $('.modal').modal();
                $('#modal1').modal('open');

                // Trigger a click event on the button
                $('#modal1').click();
            });
            // Add your code logic to handle the specific error or perform actions
        }
    </script>
      <script>
        $(document).ready(function () {
            $('#enter').click(function (e) {
                e.preventDefault(); // Prevent form submission

                var ownerName = $('#ownername').val();
                var url = 'setup.php?ownername=' + encodeURIComponent(ownerName);

                window.location.href = url;
            });
        });
    </script>
                </body>
                </html>