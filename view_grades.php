<?php
    include("php_functions.php");
    include("header_footer.php");
    session_start();
    htmlheader_root();

    $faculty_id = $_SESSION['Faculty_ID'];
    viewFacultyGrades(getFacultybyName($_GET["name"]));
    htmlfooter();
?>