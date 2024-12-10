<?php
session_start();
include 'header_footer.php';
include 'php_functions.php';
//
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "S") {
//         header("Location: index.php");
//     }
// }
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}
htmlheader_root();
?>


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
  <header class="w3-container w3-center w3-padding-16 w3-white w3-opacity-min w3-hide-small">
    <h1 class="w3-xxxlarge w3-text-brown"><b>Hogwarts University</b></h1>
    <h6>Welcome Students</span></h6>
    <h6><span> Signed in as <?php echo $_SESSION['User_ID']?> </span>
  </header>

<div class="w3-display-container w3-center w3-wide w3-hide-small image w3-grayscale-min">
  <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  </div>
</div>

 <header class="w3-container w3-center w3-padding w3-white w3-opacity-min w3-hide-large">
    <h1 class="w3-xxxlarge w3-text-brown"><b>Hogwarts University</b></h1>
    <h6>Welcome <span class="w3-hover-white w3-text-brown">Students</span></h6>
    <h6><span> Signed in as <?php echo $_SESSION['User_ID']?> </span>
  </header>

<div class="w3-display-container w3-center w3-wide w3-hide-large image-small w3-grayscale-min">
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
  </div>
</div>

    <!-- Cards start -->
   <!-- <div class="w3-row-padding w3-margin-top w3-animate-right w3-card-4 w3-light-grey" style = "color:black"> -->
    <div class = "w3-container w3-card-4 w3-white w3-opacity-min" style="max-width: auto">
        <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:black; overflow-x: hidden"> 
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="academics.php">
          <div class="w3-center w3-hover-brown icons">
            <!--<img src="img/file_icon.png"  alt="icon">-->
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Academics</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="registration.php">
          <div class="w3-center w3-hover-brown icons">
            <!--<img src="img/file_icon.png"  alt="icon">-->
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>Registration</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->

        <a class="w3-quarter" style="text-decoration: none;" href="lookup_semester.php">
          <div class="w3-center w3-hover-brown icons">
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>View Schedule</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="view_hold.php">
          <div class="w3-center w3-hover-brown icons">
            <!--<img src="img/file_icon.png"  alt="icon">-->
            <i class=" fa-5x" aria-hidden="true"></i>
            <div class="w3-container">
              <h3>View Holds</h3>
            </div>
          </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End of Icon buttons -->
</div>





    <script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "18%";
  document.getElementById("mySidebar").style.width = "18%";
  document.getElementById("mySidebar").style.display = "block";
 // document.getElementById("footer").style.marginLeft = "18%";
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  // document.getElementById("footer").style.marginLeft = "0%";
}

/***Function to open/close mobile sidebar ***/
function toggleSideBarMobile() {
	myMenu.classList.add("menu--animatable");	
	if(!myMenu.classList.contains("menu--visible")) {		
		myMenu.classList.add("menu--visible");
	} else {
		myMenu.classList.remove('menu--visible');		
	}	
}

function OnTransitionEnd() {
	myMenu.classList.remove("menu--animatable");
}

var myMenu = document.querySelector(".menu");
var closeButton = document.getElementById("close-button");
myMenu.addEventListener("transitionend", OnTransitionEnd, false);
//closeButton.addEventListener("click", toggleClassMenu, false);
/***Function to open/close mobile sidebar ***/


function open_dropdown() {
    var x = document.getElementById("dropdown");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<?php 
htmlfooter();
?>

	</body>

</html>
