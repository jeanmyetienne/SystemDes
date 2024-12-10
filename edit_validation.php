<?php
session_start();
    include("php_functions.php");
    include("header_footer.php");

//  if (!isset($_SESSION['username']) || $_SESSION['User_Type'] !== "Admin") {
//     header("Location: index.php");
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }

    htmlheader_root();
//make form goes here
    //editCourse($course,$name, $catagory ,$desc,$cred,$department)
    editCourse($_POST["Course_Name"],$_POST["Course_ID"],$_POST["Major"],$_POST["Course_Credit"],$_POST["Dept"]);
    htmlfooter();
?>
