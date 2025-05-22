<?php


$dbname = 'monitoring';
$dbuser = 'root';
$dbpass = '';
$dbhost = 'localhost';


$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$link) {
    echo "Connection to DB failed!";
} 

?>