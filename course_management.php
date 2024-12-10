<?php
include 'header_footer.php';
session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "Admin") {
//         header("Location: index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: index.php");
// }
htmlheader();
?>


    <!-- Cards start -->
    <div class="w3-row-padding w3-margin-top w3-margin-top w3-animate-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="create_course.php">
          <div class="w3-center w3-hover-khaki icons">
            <!-- <i class="fa fa-plus fa-5x" aria-hidden="true"></i> -->
            <div class="w3-container">
              <h3>Create Course</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_catalog.php">
          <div class="w3-center w3-hover-khaki icons">
           <!--  <i class=" fa fa-laptop-code fa-5x" aria-hidden="true"></i> -->
            <div class="w3-container">
              <h3>Manage Courses</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="admin_section.php">
          <div class="w3-center w3-hover-khaki icons">
            <!-- <i class="fa fa-book fa-5x" aria-hidden="true"></i> -->
            <div class="w3-container">
              <h3>Manage  Faculty</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
    </div>


<!--Footer for large screens-->
<!-- <footer class="w3-container w3-row w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-medium w3-hide-small footer">
  <div class='w3-center'>
  <h3>Contact Us</h3>
  <p>354-546-8548</a></p>
  <p><a href = "mailto:anyone@hogwartsuniversity.edu">anyone@hogwartsuniversity.edu</a></p>
  </div>
  <div class='w3-center'>
  <h3>Address</h3>
  <address>
            Hogwarts University<br>5678 Nowhere St<br> Scotland, NY 11965<br>U.S.A.
          </address>
  </div>
</footer>
 -->
<!--Footer for small screens-->
<!-- <footer class="w3-center w3-row w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-small w3-hide-large footer_small">
  <div class='w3-center'>
  <h3>Contact Us</h3>
  <p>354-546-8548</a></p>
  <p><a href = "mailto:anyone@hogwartsuniversity.edu">anyone@hogwartsuniversity.edu</a></p>
  </div>
  <div class='w3-center'>
  <h3>Address</h3>
  <address>
            Hogwarts University<br>5678 Nowhere St<br> Scotland, NY 11965<br>U.S.A.
          </address>
  </div>
</footer> -->

<?php 
htmlfooter();
?>
