<?php

include 'header_footer.php';
header('Refresh: 5;url=search_dept.php');

include 'php_functions.php';

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

//search query using username as condition to get the rows for account_type;
htmlheader_root();

?>
<!doctype html>
<html>
	<head>
		<title>Hogwats University</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">

	</head>

    <span> Signed in as <?php echo $_SESSION['Username']?> </span>

	<body class="w3-white">
        

    <?php

        $dbServername = "project1.cdbkarygfry8.us-east-2.rds.amazonaws.com";
        $dbUsername = "admin";
         $dbPassword = "Group463!";
         $dbName = "WebBasedSystem";

 $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //load page here
        $dept_id = $_GET['id'];
        $sql = "DELETE FROM Department WHERE Dept_ID = '$dept_id'";
              if (mysqli_query($conn, $sql)) {
            echo "<div class='w3-panel w3-green w3-center'><h2>Department has been deleted!</h2></div>";
        } elseif(mysqli_errno($conn) == 1451) {
            echo "<br><h3 class='w3-center w3-red'>ERROR: You cannot delete a department with active courses or department members!!</h3>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>" . mysqli_errno($conn);
        }


        $conn->close();

        redirectPageCountDown(10);

    ?>
    <!-- End of Icon buttons -->
	</body>
</html>
