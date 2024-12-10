<?php
include 'header_footer.php';
session_start();
//
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: index.php");
//     }
// }

htmlheader_root();
?>

<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">

	</head>
        

    <?php

        $host = 'project1.cdbkarygfry8.us-east-2.rds.amazonaws.com';
        $database = 'WebBasedSystem';
        $user = 'admin';
        $password = 'Group463!';

        // Create connection
        $conn = new mysqli($host, $user, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //load page here
        $sql = "DELETE FROM Courses WHERE Course_ID = ".$_GET['id']."";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='w3-panel w3-white w3-center'><h2>Course has been deleted!</h2></div>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


        $conn->close();


    ?>
    <!-- End of Icon buttons -->
</html>


