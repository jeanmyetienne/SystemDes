<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader();
    addRoom($_POST["Building"],$_POST["Room_ID"],$_POST["Room_Type"]);
    htmlfooter();
?>
