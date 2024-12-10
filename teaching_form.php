<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader();
    teachingForm($_GET["Timeslot_ID"],$_GET["CRN"]);
    htmlfooter();
?>
