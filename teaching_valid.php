<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader();
    //addFaculty($faculty, $crn)
    addFaculty($_POST["Faculty"], $_POST["CRN"]);
    htmlfooter();
?>
