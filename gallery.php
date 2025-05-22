<!DOCTYPE html>
<html lang="en">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gallery - Vermicompost Monitoring System</title>
    <link rel="shortcut icon" href="images/favicon.ico?v=2" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon">



    <!-- CSS  -->
    <link href="css/custom.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />



</head>

<body>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large waves-effect waves-light green" href="index.php"><i
                class="material-icons">arrow_back</i></a>

    </div>

    <div class="container">


        <h1>Gallery</h1>


        <div class="row">
            <?php
            $folder = "images/bgs/"; // Folder path
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif'); // Allowed image file extensions
            
            $files = scandir($folder); // Get the list of files in the folder
            
            foreach ($files as $file) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                // Check if the file has an allowed extension
                if (in_array($extension, $allowedExtensions)) {
                    $imagePath = $folder . $file;

                    // Generate a unique ID for the modal
                    $modalId = 'modal_' . uniqid();

                    // Generate the gallery item HTML
                    echo '<div class="col s12 m6 l4">
<div class="card">
  <div class="card-image">
  <a class="modal-trigger" href="#' . $modalId . '"><img src="' . $imagePath . '"></a>
    
  </div>

</div>
</div>';

                    // Generate the modal HTML
                    echo '
        <img id="' . $modalId . '"  class="modal responsive-img" src="' . $imagePath . '">
           ';
                }
            }
            ?>

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
            var CarouselElems = document.querySelectorAll('.carousel');
            var CarouselInstances = M.Carousel.init(CarouselElems, CarouselOptions);

            var CarouselOptions = {
                duration: 200,
                fullWidth: true,
                indicators: true
            };

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
        document.addEventListener('DOMContentLoaded', function () {
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
        });

    </script>

</body>

</html>