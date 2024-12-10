<?php
include 'header_footer.php';
include 'php_functions.php';

session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: index.php");
// }

if (isset($_GET['account'])) {
$_SESSION['account'] = $_GET['account'];
//echo $_SESSION['account'];
$User_ID = $_SESSION['account'];
}
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }

// if (isset($_POST['view_transcript'])) {
//     header('location: account_view_transcript.php');
// }

// if (isset($_POST['view_grades'])) {
//     header('location: account_view_grades.php');
// }

// if (isset($_POST['assign_grades'])) {
//     header('location: account_assign_grades.php');
// }


htmlheader_root('w3-white');
?>


    <div class = "w3-container">
    <h2> Edit User Account </h2>
    <p> Edit <?php echo ucfirst($_SESSION['User_Type']) ?> Account </p>
    </div>




<?php
if (isset($_GET['account'])) {
$conn = mysqlConnect();
$sql = "SELECT User_ID, first_name, last_name, date_of_birth, Zipcode From Users where User_ID = '$User_ID'";

if($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
                    $User_ID = $row[0];
                    $firstname = $row[1];
                    $lastname = $row[2];
                    $dateofbirth = $row[3];
                    $Zipcode = $row[4];
}

}
else {
    //die('Invalid query: ' . mysql_error());
    echo "<div class = 'w3-container'>
                <span style = 'font-size:130%; color: #CD2627'> Invalid Query </span>
                </div>";
}

}


if (isset($_POST['update'])) {

    $_SESSION['User_ID'] = $_POST['User_ID'];
    $_SESSION['Email'] = $_POST['Email'];
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
    $_SESSION['Zipcode'] = $_POST['Zipcode'];

    $User_ID = $_POST['User_ID'];
    $email = $_POST['Email'];

    $first_name = validateFirstName($_POST['first_name']);
    $last_name = validateLastName($_POST['last_name']);
    $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
    $Zipcode = validateZipcode($_POST['Zipcode']);

    if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $Zipcode[0] == "") {
        $firstnameUpdate = $_POST['first_name'];
        $lastnameUpdate = $_POST['last_name'];
        $Zipcode = $_POST['Zipcode'];
        $dateofbirthUpdate = date("Y-m-d", strtotime($_POST['date_of_birth']));    

        $conn = mySqlConnect();
        $sqlUpdate = "UPDATE Users SET first_name = '$firstnameUpdate', last_name = '$lastnameUpdate', date_of_birth = '$dateofbirthUpdate', Zipcode = '$Zipcode'
        WHERE User_ID = $User_ID";
        if (mysqli_query($conn, $sqlUpdate)) {
            echo "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>User updated successfully.</p>
            </div>";
        }
        else {
            echo "<div class='w3-container w3-red'>
                <p>Could not update user.</p>
            </div>";
            echo mysqli_error($conn);
        }
    }
else {
         //Updating Errors
          $errorFirstName = $first_name[0];
          $errorLastName = $last_name[0];
          $errorDateOfBirth = $dob[0];
          $errorNumber = $Zipcode[0];
                
         //Updating CSS for Errors
          $error_firstname_css = $first_name[1];
          $error_lastname_css = $last_name[1];
          $error_dob_css = $dob[1];
          $error_number_css = $Zipcode[1];
}

}

if (isset($_POST['delete'])) {

    /**$_SESSION['user_id'] = $_POST['user_id'];
    $_SESSION['email'] = $_POST['email_address'];
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
    $_SESSION['number'] = $_POST['number'];**/

    $User_ID = $_POST['User_ID'];

    $conn = mySqlConnect();
    $sqlDelete = "DELETE FROM Users WHERE User_ID = $User_ID";
    if (mysqli_query($conn, $sqlDelete)) {
        echo "<div class='w3-container w3-yellow'>
            <h3>Success</h3>
            <p>User deleted successfully.</p>
        </div>";
    }
    else {
        echo "<div class='w3-container w3-red'>
            <p>Could not delete user.</p>
        </div>";
        echo mysqli_error($conn);
    }


}

if ($_SESSION['User_Type'] == "Student" ) {

?>


<div class = "w3-card-4 w3-brown" style="max-width:560px">
    <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();">
               <input type="submit" class="w3-btn w3-teal w3-section w3-mobile" id = "view_transcript" name = "view_transcript" value = "View Student Transcript">
               <input type="submit" class="w3-btn w3-teal w3-section w3-mobile" id = "assign_grades" name = "assign_grades" value = "Assign Grades">   
               <input type="submit" class="w3-btn w3-teal w3-section w3-mobile" id = "view_grades" name = "view_grades" value = "View/Edit Grades">           
      	 </form>
</div>
<br>

<?php
}
?>

          <form class="w3-container" action = "?" method = "post" id = "loginForm" onsubmit = "validate();" style="max-width:550px">
        		  <div class="w3-section">

                   <label ><b>User ID</b></label><br>
                    <input class = "w3-input w3-border w3-light-grey w3-round signup w3-padding-medium" type = "text" id = "User_ID" name = "User_ID" <?php echo isset($User_ID) ? 'value="'. $User_ID .'"' : (isset($_SESSION['User_ID']) ? 'value="'. $_SESSION['User_ID'] .'"' : '') ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?> readonly> <br>

                    
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> 
          			
                    <label ><b>First Name</b></label><br>
                    <input class = "w3-input w3-border w3-round signup w3-padding-medium" type = "text" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($firstname) ? 'value="'. $firstname .'"' : (isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '') ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-border w3-round signup w3-padding-medium" type = "text" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($lastname) ? 'value="'. $lastname .'"' : (isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '') ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> 

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-border w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($dateofbirth) ? 'value="'. $dateofbirth .'"' : (isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '') ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> 

                    <label><b>Zipcode</b></label><br>
                    <input class="w3-input w3-border w3-round signup w3-padding-medium" type="text" id = "Zipcode" name = "Zipcode" onchange = "validateZipcode(this.value);" <?php echo isset($Zipcode) ? 'value="'. $Zipcode .'"' : (isset($_SESSION['Zipcode']) ? 'value="'. $_SESSION['Zipcode'] .'"' : '') ?> <?php echo isset($error_zipcode_css) ? 'style="'. $error_zipcode_css .'"' : ''?>>
					<span class = "errormsg" id="errorZipcode" style = "color: #CD2627"> <?php echo isset($errorZipcode) ? $errorZipcode : ''?> </span> <br> 
    		
                      <input class="w3-btn w3-brown w3-section" type="submit" name = "update" value = "Update User" onclick = "return confirm('Are you sure you want to update the user?');">
                      <input class="w3-btn w3-brown w3-section" type="submit" name = "delete" value = "Delete User" onclick = "return confirm('Are you sure you want to delete the user?');">
        		  </div>
      		    </form>

             </div>

<?php
    htmlfooter();
    unset($_SESSION['User_ID']);
    unset($_SESSION['Email']); 
    unset($_SESSION['first_name']); 
    unset($_SESSION['last_name']); 
    unset($_SESSION['date_of_birth']); 
    unset($_SESSION['Zipcode']); 
?>
