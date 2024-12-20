<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Website Homepage design </title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../all.css">
</head>
<style> 
/* Navbar container */
.navbar {
  overflow: hidden;
  background-color: #654321;
  font-family: Arial;
}

/* Links inside the navbar */
.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown button */
.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Add a red background color to navbar links on hover */
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: khaki;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: khaki;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/*WELCOME TEXT*/

.welcome-text {
	position: relative;
	top: 50px;
	width: 600px;
	height: 300px;
	margin: 20% 30%;
	text-align: center;
}
.welcome-text h1 {
	text-align: center;
	 position:  relative;
	color: #964B00;
	text-transform: uppercase;
	font-size: 60px;
}
.welcome-text p{
	text-align: center;
	color: white;
	text-transform: uppercase;

}

.welcome-text a {
	background-color: #964B00;
	padding: 10px 25px;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 14px;
	margin-top: 20px;
	display: inline-block;
	color: #fff;
}
.welcome-text a:hover {
	background: white;
	color: #964B00;
}
</style>
</head>
<body>
<nav class="w3-bar w3-brown w3-hover-opacity-off w3-hide-small">
	<div class="navbar">
	<a href=""> <img src ="images/hoglogo.png" style="margin: auto" ></a>
  <a href="cATALOG.php">VIEW CATALOG</a>
  <a href="LoginPg.php">LOGIN</a>
  <a href="cONTACT.php">CONTACT US</a>
  <div class="dropdown">
    <button class="dropbtn">ACADEMIC CALENDAR
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="academicCalendar.php">Fall 2020</a>
      <a href="academicCalendar2.php">Spring 2022</a>
    </div>
  </div>
   <div class="dropdown">
    <button class="dropbtn">MASTER SCHEDULE
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="fall2021.php">Fall 2020</a>
      <a href="spring2022.php">Spring 2022</a>
    </div>
  </div>
</div>
		</nav>

<div class="welcome-text container text-center" >
    
        <h1>HOGWARTS University</h1>
        <p>Own Your Future</p>
		<a href="signup.php">No one like you. No place like this... </a>
    	</div>
   

    		<div class = "container text-center">
    			<h2>FACILITIES</h2>
    		<div class="row">
    			<div class = "column">
    				<a href="#Campus"><img src="images/campus1.jpeg" alt= ""></a>
    				<a href="">CAMPUS</a>
    			</div>
    				<div class = "column">
    				<a href="CANTINE"><img src="images/cafe.jpeg" alt= ""></a>
    				<a href="">CANTINE</a>
    			</div>
    				<div class = "column">
    				<a href="#lIBRARY"><img src="images/lib.jpeg" alt= ""></a>
    				<a href="">LIBRARY</a>
    		</div>
    	</div>

</div>
