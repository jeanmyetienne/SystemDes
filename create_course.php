<?php
include 'header_footer.php';
session_start();
// //
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "admin") {
//         header("Location: index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }

htmlheader('w3-white');

//search query using username as condition to get the rows for account_type;
?>
        <h1 style="text-align:center">Add New Course</h1>
        <div class="w3-panel w3-center" >
            <form class="w3-container" action = "course_validate.php" method = "post">
            <label class="w3-label w3-white"><b>Department</b></label>
<!--            <input class="w3-input" type="number" name="dept">-->
            <select class="w3-select w3-border" name="Dept_Name" required>
                <?php include("php_functions.php"); getAllDepartments(); ?>
            </select><br><br>
            <label class="w3-label w3-white"><b>Course Name</b></label>
            <input class="w3-input" type="text" name="Course_Name" required>
            <br>
            <label class="w3-label w3-white"><b>Course ID</b></label>
            <input class="w3-input" type="text" name="Course_ID">
            <br>
            <label class="w3-label w3-white"><b>Major</b></label>
            <input class="w3-input" type="text" name="Major"></input>
            <br>
            <label class="w3-label w3-white"><b>Course Credit</b></label>
            <input class="w3-input" type="number" max="4" min="2" name="Course_Credit" required>

            <div>
                <button class="w3-btn w3-brown" type="submit" onclick="validateEmptyFields();">Create Course</button>
            </div>
            </form>
        </div>
    </div>

<?php
htmlfooter();
?>
