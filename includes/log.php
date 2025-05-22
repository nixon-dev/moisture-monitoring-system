<?php

include('db_conn.php');

// Log saver for bed number 1
if (isset($_POST['log1Btn'])) {

	// Retrieve the range values from the form
	$bedname = $_GET['bed'];
	$range1 = $_POST['range1'];
	$range2 = $_POST['range2'];
	$range3 = $_POST['range3'];
	date_default_timezone_set('UTC');
	$logdate = date("Y-m-d H:i:s");

	// Prepare an SQL statement to insert the range values into the database
	$sql = "INSERT INTO logs (bedname, gauge1, gauge2, gauge3, logdate) VALUES ('$bedname','$range1', '$range2', '$range3' ,'$logdate')";

	// Execute the SQL statement
	if (mysqli_query($link, $sql)) {

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		echo '<span class="green-text text-lighten-4">Log saved successfully</span>';
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}

}



?>