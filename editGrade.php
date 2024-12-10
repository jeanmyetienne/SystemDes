<!doctype html>
<html lang="en">
<?php 
include 'header_footer.php';
session_start();
    // include '../global.php';
    // if(!isset($_COOKIE['user']) || $_COOKIE['userType'] != "Faculty"){
    //     header("Location:  $baseURL/homepage/homepage.php"); 
    //     die();
    // }
htmlheader_root('w3-white');
?>
    <head>
        <title>Edit Grade</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="faculty.css">

        <script type="text/javascript">
            function sendRedirectForm(value){
                var id;
                switch(value){
                    case 0:
                        id = "facultyHomepage"
                        break;
                }

                var submissionFrom = document.getElementById("redirectForm"); 

                submissionFrom.innerHTML = "<input type = \"hidden\" name = \"webpage\" value = "+ id +" />";

                submissionFrom.submit();
            }
        </script>

    </head>
    <body>
        <div>
            <h1>Edit Student Course Grade</h1>
            <form method="post" class="form" action="facultyEditGrade.php" onsubmit="return confirm('Are you sure you want to submit the form?')">
                <label><b>ID</b></label>
                <input type="text" class="field" placeholder="Enter Id of student you would like to edit the grade of" pattern="\d{0,10}" title="Please enter numeric user ID" name="StudentID" required>
                
                <p><label><b>CRN</b></label>
                <input type="text" class="field" placeholder="Enter CRN " pattern="\d{0,10}" title="Please enter numeric CRN" name="CRN" required></p>

                <p><label><b>Course Grade</b></label> 
                <select name="CourseGrade" id="courseGrade">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="F">F</option>
                </select>
                <p><input type="submit" value="Submit">
                <input type="button" onclick="sendRedirectForm(0)" value="Cancel"></p>
            </form>
        </div>
     <!--    <form action= "../scripts/redirect.php" method="post" id="redirectForm">
        </form> -->
    </body>
</html>
<?php
htmlfooter();
?>