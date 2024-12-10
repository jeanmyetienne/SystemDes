<?php
include 'header_footer.php';
session_start();
//
// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
//     header("Location: ../index.php");
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
        <a class="w3-quarter" style="text-decoration: none;" href="lookup_semester2.php">
          <div class="w3-center w3-hover-brown icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Drop Classes</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="lookup_semester.php">
          <div class="w3-center w3-hover-brown icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Look Up Classes To Add</h3>
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

