<?php
session_start();
include('header_footer.php');
//
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "F") {
//         header("Location: index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }
//search query using username as condition to get the rows for account_type;
if ($color == NULL) {
    $body_color = 'w3-2017-niagra';
}
else {
    $body_color = $color;
}
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

  




    <!-- Navbar start (small screens) -->
<div class='w3-hide-medium w3-opacity w3-hover-opacity-off w3-hide-large' id='myNavbar'>

    <a href='student_home.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%' >Home</a>
    <a href='schedule.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Master Schedule</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Master Catalog</a>
  
</div>
</div>
 <!-- Navbar end (small screens) -->


<div zclass='w3-main w3-container w3-padding-large' id='main'>

    
    <!-- Navbar start (large screens) -->
        <nav class='w3-bar w3-brown w3-opacity-min w3-hover-opacity-off w3-hide-small'>
            <a class='w3-bar-item w3-button w3-hover-brown w3-mobile' href='student_home.php'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-dark-brown w3-mobile' href='schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-brown w3-mobile' href='catalog.php'>Master Catalog</a>
        <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-round w3-right'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Log Out </button>
        </form>
        <div class='w3-dropdown-click w3-right'>
            <button class='w3-button' onclick='open_dropdown()'><i class='fa fa-user fa-1x'></i> <?php echo $_SESSION['firstname'];?>
            <i class='fa fa-caret-down'></i> </button>
            <div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
            </div>
         </div>
    </nav>
    <!-- Navbar end (large screens) -->


<!-- Background Image -->
<div class="w3-display-container w3-center w3-wide image w3-white">
  <div class="w3-display-bottommiddle w3-text-black w3-center w3-hide-small w3-hide-medium" style = "margin-bottom:40px">
  <h2 class = "w3-xxxlarge">Hogwarts University</h2>
 </div>
 <div class="w3-display-bottommiddle w3-text-white w3-center w3-hide-large" style = "margin-bottom:10px">
    <h2 class="w3-xxlarge w3-hide-large">Hogwarts University</h2>
    <h2 class="w3-xxlarge w3-hide-large">Hogwarts University</h2>
  </div>
</div>

<header class="w3-container w3-center w3-padding-16 w3-white w3-opacity-min w3-hide-small">
    <h1 class="w3-xxxlarge w3-text-brown"><b>Hogwarts University</b></h1>
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
    <div class="w3-row-padding w3-margin-top w3-margin-top" style = "color:white">
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href='view_class.php' name=<?php echo $_SESSION['username']?>>
          <div class="w3-center w3-text-brown w3-hover-khaki icons">
              <i class=" fa-5x" aria-hidden="true"></i>
                <div class="w3-container ">
                    <h3>View Schedule</h3>
                </div>
          </div>
        </a>
        <!-- End Card -->
          <a class="w3-quarter" style="text-decoration: none;" href='view_grades.php' name=<?php echo $_SESSION['username']?>>
          <div class="w3-center w3-text-brown w3-hover-khaki icons">
              <i class=" fa-5x" aria-hidden="true"></i>
                <div class="w3-container ">
                    <h3>View Grades</h3>
                </div>
          </div>
        </a>
        <!-- Start Card -->
        <a class="w3-quarter" style="text-decoration: none;" href="search_advisee.php">
          <div class="w3-center w3-text-brown w3-hover-khaki icons">
              <i class=" fa-5x" aria-hidden="true"></i>
                <div class="w3-container">
                  <h3>View Advisees</h3>
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
	</body>

</html>
