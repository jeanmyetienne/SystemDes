<?php
include 'header_footer.php';
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
//   header("Location: ../index.php");
// }

htmlheader_root('w3-white');
?>
    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_advisor.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Assign Student to Advisor</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_student.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Assign Advisor to Student</h3>
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
