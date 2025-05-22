<!-- <?php
include('db_conn.php');


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['updateHomepageBtn'])){

        $updatetitle = mysqli_real_escape_string($link, $_POST['title']);
        $updatesubtitle = mysqli_real_escape_string($link, $_POST['subtitle']);
        $updatetitle1 = mysqli_real_escape_string($link, $_POST['title1']);
        $updatecontext1 = mysqli_real_escape_string($link, $_POST['context1']);
        $updatecontext2 = mysqli_real_escape_string($link, $_POST['context2']);
        $updatecontext3 = mysqli_real_escape_string($link, $_POST['context3']);


        $query = "UPDATE homepage SET title = '$updatetitle', subtitle = '$updatesubtitle', title1 = '$updatetitle1', context1 = '$updatecontext1', context2 = '$updatecontext2', context3 = '$updatecontext3' WHERE id = '1'";
        $result = mysqli_query($link, $query);

        if ($result) {
            $message = "Homapage Information has been updated successfully";
        } else {
            $message = "Error";
        }

    }

    if(isset($_POST['footerBtn'])) {
        $phone = mysqli_real_escape_string($link, $_POST['phone-number']);
        $email = mysqli_real_escape_string($link, $_POST['footer-email']);

        $fquery = "UPDATE homepage SET email = '$email', phonenumber = '$phone' WHERE id = '1'";
        $fresult = mysqli_query($link, $fquery);

        if($fresult) {
            $message = "Footer information has been updated succcessfully";
        } else {
            $message = "Error";
        }
    }
}


?> -->