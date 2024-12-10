<?php

include 'php_functions.php';

session_start();

//to prevent logged in user from using this page
//if (isset($_SESSION['username'])) {
  //header("Location: home.php");
//  exit;
// }

if (isset($_POST['Email']) && isset($_POST['Password'])) {

    //Creating global SESSION variables for username and password for textbox diplay (This prevents the user from entering field data again after failed form submission)
    $_SESSION['usernamefield'] = $_POST['Email'];
    $_SESSION['passwordfield'] = $_POST['Password'];

    $login = validateLogin($_POST['Email'], $_POST['Password']);

    if ($login[0] == "" && $login[1] == "") {

    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $conn = mysqlConnect();

    $sql = "SELECT * FROM User_Login WHERE Email = '$Email' AND Password = '$Password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (!mysqli_num_rows($result) == 0) {
        $_SESSION['User_ID'] = $row['User_ID'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Password'] = $row['Password'];
        //echo ("Welcome " . $_SESSION['username']);
        $user = $row['User_Type'];
        $_SESSION['User_Type'] = $user;


        switch($user) {
            case "Admin":
                header("Location: admin_home.php");
                break;
            case "Student":
                header("Location: student_home.php");
                break;
            case "Faculty":
                header("Location: faculty_home.php");
                break;
            case "Research Staff";
                header("Location: research_home.php");
                break;
        }
    }
    else {
        //$errMsg = "invalid username or password";
        $message = "<div class='w3-container w3-content w3-center w3-red w3-margin-top' style='max-width:420px'>
            <p>Invalid Email or Password.</p>
        </div> <br>";
    }
    mysqli_close($conn);
}
    else {
        //Updating Errors
        $errorUsername = $login[0];
        $errorPassword = $login[1];
        
        //Updating CSS for Errors
        $error_username_css = $login[2];
        $error_password_css = $login[3];
     }
}

?>



<html>
	<head>
		<title>Hogwarts University</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<!--         <link rel="stylesheet" href="style.css"> -->
        <script type="text/javascript" src="js/functions.js"> </script>
	</head>

	<body>
		<nav class="w3-bar w3-brown w3-hover-opacity-off w3-hide-small">
			<a class="w3-bar-item w3-button w3-hover-khaki" href="index.php">Home</a>
  			<a class="w3-bar-item w3-button w3-hover-khaki" href="fall2021.php">Master Schedule</a>
  			<a class="w3-bar-item w3-button w3-hover-khaki" href="cATALOG.php">Catalog</a>

		</nav>

		<br> <br> <br> <br> <br> <br>

     <!-- <div class="w3-container"> -->
        <div class = "w3-center w3-container w3-card-4 w3-white " style="max-width:450px; margin: auto" >
      	 <div class="w3-center"><br>
        	   <img src="images/hoglogo.png" alt="Hogwarts University" style="width:20%" class="w3-circle w3-margin">
               <!-- <i class="fa fa-user-circle fa-5x" aria-hidden="true"></i> -->
      	 </div> 
  
                <?php echo isset($message) ? $message : ''?>                               
           
              <div class = "w3-content w3-container w3-center w3-margin-bottom" style="max-width:450px">
      		    <form action = "?" method = "post" id = "loginForm"  onsubmit ="validateLogin();">
        		<!--  <div class="w3-section"> -->
          			<label><b>Email</b></label>
          			<input class="w3-input w3-round login" type="Email" placeholder="Enter Email" id = "Email" name = "Email"  <?php echo isset($_SESSION['usernamefield']) ? 'value="'. $_SESSION['usernamefield'] .'"' : '' ?> <?php echo isset($error_username_css) ? 'style="'. $error_username_css .'"' : ''?>>
					 <span class = "errormsg" id="errorUsername" style = "color: #CD2627"> <?php echo isset($errorUsername) ? $errorUsername : ''?> </span>
          			

                    <br> <br> 
                      <label><b>Password</b></label>
          			<input class="w3-input w3-round login" type="Password" placeholder="Enter Password" id = "Password" name = "Password"  <?php echo isset($_SESSION['passwordfield']) ? 'value="'. $_SESSION['passwordfield'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					   <span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> 
          			<input class="w3-btn-block w3-brown w3-section w3-padding" type="submit" name = "submit" value = "Login">
          			<input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me

      		    </form>
            </div>

      		    <div class="w3-container w3-content w3-center w3-padding-16 w3-white" style="max-width:420px">
        		  <span class="w3-padding"> <a href="reset-password.php">Forgot Password?</a></span>
      		    </div>

        <!-- End of Login -->

    </body>
</html>

<?php
unset($_SESSION['usernamefield']);
unset($_SESSION['passwordfield']);
?>
