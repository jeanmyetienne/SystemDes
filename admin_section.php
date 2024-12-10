<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader();
    adminSchedule();
    htmlfooter();


session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: ../index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: ../index.php");
//     }
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

?>



<?php
htmlfooter();
?>