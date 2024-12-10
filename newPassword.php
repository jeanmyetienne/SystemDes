<?php

include 'php_functions.php';
include 'header_footer.php';
include 'securitycode.php';
session_start();

//to prevent logged in user from using this page
//if (isset($_SESSION['username'])) {
  //header("Location: home.php");
//  exit;
// }
htmlheader_root();
  error_reporting(-1);
  ini_set('display_errors', 'On');
  set_error_handler("var_dump");
  $email = $_SESSION["Email"];
  $subject = "Security Code";
  $message = "Your Security code is " . $code;
  $headers = "FROM: jeanmyetienne@gmail.com"."\r\n";
  mail($email, $subject, $message, $headers);
    if(isset($_POST["Security"])) {
      $userCode = $_POST["code"];
      if ($userCode==$code){
        header("location:newPassword.php");

      }
      else{
        echo "Incorrect Security Code"
      }
    }
?>