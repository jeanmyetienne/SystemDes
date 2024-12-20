<?php
include 'header_footer';
include 'php_functions.php';

session_start();
//
// if (!isset($_SESSION['username'])) {
//     header("Location: ../index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A" && $_SESSION['usertype'] != "F") {
//         header("Location: ../index.php");
//     }
    //}

//search query using username as condition to get the rows for account_type;
?>
<!-- In PHP check cookies id not there redirect to main page or display not logged in -->
<html>
	<head>
		<title>Hogwarts University</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
        <script src="../js/css.js" type="text/javascript"></script>
	</head>

	<body>
        <nav class="w3-bar w3-brown">
			<a class="w3-bar-item w3-button w3-hover-brown" href="faculty_home.php">Home</a>
  			<a class="w3-bar-item w3-button w3-hover-brown" href="fall2021.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-brown" href="cATALOG.php">Master Catalog</a>
  			<a class="w3-bar-item w3-button w3-right w3-brown w3-right" href=" ">Log Out</a>
		</nav>



        <div class="w3-container">
            <h2>Search Student Advisee</h2>
            <p>Search for a Student in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for student name.." id="myInput" onkeyup="filter_table()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:33%;">Student Name</th>
                    <th style="width:33%;">Student ID</th>
                </tr>
                <?php getAdviseeListTable($_SESSION['User_ID']); ?>
            </table>

        </div>
    </body>
</html>

<?php
htmlfooter();

?>