<?php
include 'header_footer.php';
session_start();
//
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
//   header("Location: ../index.php");
// }
htmlheader_root();
?>

    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top w3-margin-top w3-animate-right" style = "color:black"> 
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="create_dept.php">
          <div class="w3-center w3-hover-khaki icons">
            <div class="w3-container">
              <h3>Create Department</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_dept.php">
          <div class="w3-center w3-hover-khaki icons">
            <div class="w3-container">
              <h3>View/Edit/Delete Departments</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
</div>



<?php 
htmlfooter();
?>
