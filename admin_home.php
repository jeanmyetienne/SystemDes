<?php
include 'header_footer.php';
session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }


htmlheader();

?>

 <!-- Background Image -->
<!doctype html>
            <html>
                <head>
                    <title>HOGWARTS UNIVERTY</title>
                    <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="style.css">
    <script type='text/javascript' src='js/functions.js'> </script>
                </head>



<!-- Header -->
<header class="w3-container w3-center w3-padding-16 w3-white w3-opacity-min  w3-hide-small">

    <h1 class="w3-xxxlarge w3-text-brown "><b>Hogwarts University</b></h1>
    <h6>Welcome Admin</span></h6>
    <h6><span> Signed in as <?php echo $_SESSION['User_ID']?> </span>
  </header>

<div class="w3-display-container w3-center w3-wide w3-hide-small image w3-grayscale-min">
  <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  </div>
</div>

 <header class="w3-container w3-center w3-padding w3-white w3-opacity-min w3-hide-large">
    <h1 class="w3-xxxlarge w3-text-brown"><b>Hogwarts University</b></h1>
    <h6>Welcome Admin</span></h6>
    <h6><span> Signed in as <?php echo $_SESSION['User_ID']?> </span>
  </header>

<div class="w3-display-container w3-center w3-wide w3-hide-large image-small w3-grayscale-min">
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
  </div>
</div>

  
    <!-- Cards start -->
  <div class = "w3-container w3-card-4 w3-white w3-opacity-min" style="max-width: auto">
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="account_management.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Account </h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="course_management.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Course</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="dept_management.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Department</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="degree_management.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Minor</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="facility_home.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Facility </h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="major_management.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Major </h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="advisor_management.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class="fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Advisor </h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
         <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="manage_holds.php">
          <div class="w3-center w3-hover-khaki icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Manage Holds </h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
</div>

    <!--Footer for large screens-->
<!-- <footer class="w3-container w3-row w3-black w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-medium w3-hide-small footer" id = "footer">
  <div class='w3-quarter'>
  <h3>Contact Us</h3>
  <p>234-546-1385</a></p>
 <p><a href = "mailto:anyone@hogwartsuniversity.edu">anyone@hogwartsuniversity.edu</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Address</h3>
  <p>Hogwarts University<br>5678 Nowhere St<br> Scotland, NY 11965<br>U.S.A.</a></p>
  </div>
</footer> -->

<!--Footer for small screens-->
<!-- <footer class="w3-center w3-row w3-black w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-small w3-hide-large footer_small">
  <div class='w3-quarter'>
  <h3>Social Media</h3>
  <p>Facebook</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Contact Us</h3>
  <p>555-674-9999</a></p>
  </div>
  <div class='w3-quarter'>
  <h3>Address</h3>
  <p>223 Store Hill Road, Old Westbury</a></p>
  </div>
</footer> -->

<?php 
htmlfooter();
?>

