<?php
include 'header_footer.php';
session_start();

//if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }
htmlheader_root();
?>

    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top w3-margin-top w3-animate-right" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="add_degree.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Add Minor</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="view_degree.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Minor</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
  </div>

</footer>

<?php 
htmlfooter();
?>