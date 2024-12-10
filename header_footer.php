<?php


function htmlheader($color = NULL){

if (isset($_SESSION['User_Type'])){

    if ($_SESSION['User_Type'] == 'Admin') {
        $home = "admin_home.php";
    }
    else if ($_SESSION['User_Type'] == 'Student') {
        $home = "student_home.php";
    }
    else if ($_SESSION['User_Type'] == 'Faculty') {
        $home = "faculty_home.php";
    }
    else if ($_SESSION['User_Type'] == 'Research Staff') {
        $home = "research_home.php";
    }
}
else {
    $home = "index.php";
}

if ($color == NULL) {
    $body_color = 'w3-2017-niagra';
}
else {
    $body_color = $color;
}


    echo "<!doctype html>
            <html>
                <head>

                    <title>Hogwarts Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-highway.css'>
    <script type='text/javascript' src='js/functions.js'> </script>
    <script src='js/css.js' type='text/javascript'></script>
                </head>";
    
    echo "</span><body class=$body_color>
 





    <!-- Navbar start (small screens) -->
<div class='w3-hide-medium w3-opacity w3-hover-opacity-off w3-hide-large' id='myNavbar'>
  <div class='w3-bar w3-brown w3-center w3-hover-opacity-off w3-small'>
  <button class='w3-bar-item w3-button w3-brown w3-hover-brown' onclick='toggleSideBarMobile()' style = 'width:25%' id = 'navButton'><b> <i class='fa fa-bars fa-2x' aria-hidden='true'></i> </b> </button> 
    <a href='$home' class='w3-bar-item w3-button w3-hover-khaki' style = 'width:25%' >Home</a>
    <a href='schedule.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Master Schedule</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Master Catalog</a>
   <!-- <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Academics</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Departments</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>About</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Contact&nbsp;Us</a>
         <form action = '?' method = 'post'>
        <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' style = 'width:25%' value = 'Sign Out'>
        </form>-->
</div>
</div>
 <!-- Navbar end (small screens) -->


<div zclass='w3-main w3-container w3-padding-large' id='main'>

    
    <!-- Navbar start (large screens) -->
        <nav class='w3-bar w3-brown  w3-hover-opacity-off w3-hide-small'>
        <button class='w3-bar-item w3-button  w3-hover-khaki w3-hide-small w3-small' onclick='w3_open()'></button> 
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='$home'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='fall2021.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='cATALOG.php'>Master Catalog</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='cONTACT.php'>Contact Us</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='about.php'>About</a>
        <form action = '?' method = 'post'>
        <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-round w3-right' href = 'logout_page.php'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true'></i> Log Out </button>
        </form>";


        if (isset($_SESSION['usertype'])){
            echo "<div class='w3-dropdown-click w3-right'>";
            echo "<button class='w3-button' onclick='open_dropdown()'><i class='fa fa-user fa-1x'></i> ";
            echo $_SESSION['firstname'];
            echo " <i class='fa fa-caret-down'></i> </button>";
            echo "<div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
                </div></div>";
        }



    echo "</nav>
    <!-- Navbar end (large screens) -->
";

}


function htmlheader_root($color = NULL){
        if ($_SESSION['User_Type'] == 'Admin') {
  $home = "admin_home.php";
}
else if ($_SESSION['User_Type'] == 'Student') {
  $home = "student_home.php";
}
else if ($_SESSION['User_Type'] == 'Faculty') {
  $home = "faculty_home.php";
}
else if ($_SESSION['User_Type'] == 'Research staff') {
  $home = "research_home.php";
}

if ($color == NULL) {
    $body_color = 'w3-2017-niagra';
}
else {
    $body_color = $color;
}
    echo "<!doctype html>
            <html>
                <head>
                    <title>Hogwarts Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script type='text/javascript' src='../js/functions.js'> </script>
    <script src='../js/css.js' type='text/javascript'></script>
                </head>";
    
    echo "</span><body class=$body_color>


    <!-- Navbar start (small screens) -->
<div class='w3-hide-medium w3-opacity w3-hover-opacity-off w3-hide-large' id='myNavbar'>
  <div class='w3-bar w3-brown w3-center w3-hover-opacity-off w3-small'>
  <button class='w3-bar-item w3-button w3-brown w3-hover-brown' onclick='toggleSideBarMobile()' style = 'width:25%' id = 'navButton'><b> <i class='fa fa-bars fa-2x' aria-hidden='true'></i> </b> </button> 
    <a href='$home' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%' >Home</a>
    <a href='../schedule.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Master Schedule</a>
    <a href='../catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Master Catalog</a>
   <!-- <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Academics</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Departments</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>About</a>
    <a href='catalog.php' class='w3-bar-item w3-button w3-hover-brown' style = 'width:25%'>Contact&nbsp;Us</a>
    <div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
         <form action = '?' method = 'post'>
        <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' style = 'width:25%' value = 'Sign Out'>
        </form>-->
</div>
</div>
 <!-- Navbar end (small screens) -->


<div zclass='w3-main w3-container w3-padding-large' id='main'>

    
    <!-- Navbar start (large screens) -->
        <nav class='w3-bar w3-brown  w3-hover-opacity-off w3-hide-small'>
        <button class='w3-bar-item w3-button  w3-hover-khaki w3-hide-small w3-small' onclick='w3_open()'></button> 
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='$home'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='fall2021.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='cATALOG.php'>Master Catalog</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href='cONTACT.php'>Contact Us</a>
            <a class='w3-bar-item w3-button w3-hover-khaki w3-mobile' href=''>About</a>
        <form action = '?' method = 'post'>
       <button type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-round w3-right'> 
          <i class='fa fa-sign-out fa-1x' aria-hidden='true' ></i> Log Out </button>
        </form>
        <div class='w3-dropdown-click w3-right'>
            <button class='w3-button' onclick='open_dropdown()'><i class='fa fa-user fa-1x'></i> ";
            echo $_SESSION['firstname'];
            echo " <i class='fa fa-caret-down'></i> </button>
            <div class='w3-dropdown-content w3-bar-block w3-border' style='position:absolute; z-index: 2;' id = 'dropdown'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Academics</a>
            </div>
         </div>
    </nav>
    <!-- Navbar end (large screens) -->
";

}


function htmlfooter(){
Echo "<script>
function w3_open() {
  document.getElementById('main').style.marginLeft = '18%';
  document.getElementById('mySidebar').style.width = '18%';
  document.getElementById('mySidebar').style.display = 'block';
}
function w3_close() {
  document.getElementById('main').style.marginLeft = '0%';
  document.getElementById('mySidebar').style.display = 'none';
}


/***Function to open/close mobile sidebar ***/
function toggleSideBarMobile() {
	myMenu.classList.add('menu--animatable');	
	if(!myMenu.classList.contains('menu--visible')) {		
		myMenu.classList.add('menu--visible');
	} else {
		myMenu.classList.remove('menu--visible');		
	}	
}

function OnTransitionEnd() {
	myMenu.classList.remove('menu--animatable');
}

var myMenu = document.querySelector('.menu');
var closeButton = document.getElementById('close-button');
myMenu.addEventListener('transitionend', OnTransitionEnd, false);
//closeButton.addEventListener('click', toggleClassMenu, false);
/***Function to open/close mobile sidebar ***/

function open_dropdown() {
    var x = document.getElementById('dropdown');
    if (x.className.indexOf('w3-show') == -1) {
        x.className += ' w3-show';
    } else { 
        x.className = x.className.replace(' w3-show', '');
    }
}
</script>
</body>
</html>";
}


?>
