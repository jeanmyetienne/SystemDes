<?php

include 'php_functions.php';
include 'header_footer.php';
session_start();

//to prevent logged in user from using this page
//if (isset($_SESSION['username'])) {
  //header("Location: home.php");
//  exit;
// }
htmlheader_root();

if(isset($_POST['password-reset-token']) && $_POST['Email'])
{
    include "dbinc.php";
     
    $emailId = $_POST['email'];
 
    $result = mysqli_query($conn,"SELECT * FROM User_Login WHERE Email='" . $emailId . "'");
 
    $row= mysqli_fetch_array($result);
 
  if($row)
  {
     
     $token = md5($emailId).rand(10,9999);
 
     $expFormat = mktime(
     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
     );
 
    $expDate = date("Y-m-d H:i:s",$expFormat);
 
    $update = mysqli_query($conn,"UPDATE User_Login set  Password='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE Email='" . $emailId . "'");
 
    $link = "<a href='http://3.133.220.255/SystemDes1/SystemDes/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";
 
    require_once('PHPMailerAutoload.php');
 
    $mail = new PHPMailer();
 
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // hogwarts username
    $mail->Username = "your_email_id@hogwartsubiversity.edu";
    // GMAIL password
    $mail->Password = "your_email_password";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.hogwartsubiversity.edu";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='your_gmail_id@hogwartsubiversity.edu';
    $mail->FromName='your_name';
    $mail->AddAddress('reciever_email_id', 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }else{
    echo "Invalid Email Address. Go back";
  }
}

?>