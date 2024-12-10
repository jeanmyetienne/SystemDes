<?php
include 'header_footer.php';
session_start();
//
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "S") {
//         header("Location: ../index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }


htmlheader_root();
?>

    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top" style = "color:black; overflow-x: hidden">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="grades.php">
          <div class="w3-center w3-hover-brown icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>View Grades</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="transcript.php">
          <div class="w3-center w3-hover-brown icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>View Transcript</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
       <a class="w3-quarter" style="text-decoration: none;" href="degreeAudit.php">
          <div class="w3-center w3-hover-brown icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Degree Audit</h3>
            </div>
          </div>
        </a>
    </div>
    <!-- End of Icon buttons -->
</div>



<?php
htmlfooter();
?>
