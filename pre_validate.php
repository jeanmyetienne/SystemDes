<?php
session_start();
//
include 'header_footer.php';
include'php_functions.php';
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: index.php");
// }

//search query using username as condition to get the rows for account_type;
htmlheader_root();
?>
<!doctype html>
<html>
	<head>
		<title>Hogwarts University </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
	</head>

	<body class="w3-white">
        

        <div>
            <?php
                addPrereq($_POST['master_id'],$_POST['pre_req_id']);
            ?>
        </div>

    </body>
</html>