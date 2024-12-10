<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: index.php");
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy(); 
//   header("Location: logout_page.php");
// }

?>



    <?php

        if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "Admin") 
        {

        if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['Email']) &&
            isset($_POST['Password']) &&
            isset($_POST['Zipcode']) &&
            isset($_POST['User_ID']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['Email'] = $_POST['Email'];
            $_SESSION['Password'] = $_POST['Password'];
            $_SESSION['Zipcode'] = $_POST['Zipcode'];
            $_SESSION['User_ID'] = $_POST['User_ID'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $Email = validateEmail($_POST['Email']);
            $Password = validatePassword($_POST['Password']);
            $Zipcode = validateNumber($_POST['Zipcode']);
            $User_ID = validateID($_POST['User_ID']);
            

            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $Email[0] == "" && $Password[0] == "" && $Zipcode[0] == "") {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];
                $Zipcode = $_POST['Zipcode'];
                $User_ID = $_POST['User_ID'];
                $User_Type = ucfirst($_SESSION['User_Type']);

                $conn = mysqlConnect();

                $sql = "INSERT INTO Users (first_name, last_name, date_of_birth, Zipcode, User_Type, User_ID)
                        VALUES ('$first_name', '$last_name', '$dob', '$Zipcode', '$User_Type', '$User_ID');
                        INSERT INTO User_Login (Email, Password, User_ID, User_Type)
                        VALUES ('$Email', '$Password', '$User_ID', '$User_Type');
                        INSERT INTO Admin (Admin_id)
                        VALUES ('$User_ID');

                        ";
                 mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $Email;
                          $_SESSION['Zipcodec'] = $Zipcode;
                          $_SESSION['Passwordc'] = $Password;
                          $_SESSION['User_IDc'] = $User_ID;
                          header('location:account_creation_confirmation.php');            
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>" . mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $Email[0];
                $errorPassword = $Password[0];
                $errorNumber = $Zipcode[0];
                $errorID = $User_ID[0];
                
                //Updating CSS for Errors
                $error_email_css = $Email[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $Password[1];
                $error_number_css = $Zipcode[1];
                $error_ID_css = $User_ID[1];
                
            }

        }

        htmlheader('w3-white');

        ?>
        <?php echo isset($message) ? $message : '';?>

    <div class = "w3-container">
    <h2> Create Admin Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

          <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
        		  <div class="w3-section">
          			
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@hogwartsuniversity.edu" id = "Email" name = "Email" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['Email']) ? 'value="'. $_SESSION['Email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "Password" name = "Password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['Password']) ? 'value="'. $_SESSION['Password'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
					<span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Zipcode</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="#####" id = "Zipcode" name = "Zipcode" onchange = "validateNumber(this.value);" <?php echo isset($Zipcode) ? 'value="'. $Zipcode .'"' : (isset($_SESSION['Zipcode']) ? 'value="'. $_SESSION['Zipcode'] .'"' : '') ?> >
					<span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
                    <label><b>User ID</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="" id = "User_ID" name = "User_ID" onchange = "validateID(this.value);" <?php echo isset($User_ID) ? 'value="'. $User_ID .'"' : (isset($_SESSION['User_ID']) ? 'value="'. $_SESSION['User_ID'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorID" style = "color: #CD2627"> <?php echo isset($errorID) ? $errorID : ''?> </span> <br><br>

                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
        		  </div>
      		    </form>
<?php
        }

      else if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "Research Staff") 
        {

        if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['Email']) &&
            isset($_POST['Password']) &&
            isset($_POST['Zipcode']) &&
            isset($_POST['User_ID']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['Email'] = $_POST['Email'];
            $_SESSION['Password'] = $_POST['Password'];
            $_SESSION['Zipcode'] = $_POST['Zipcode'];
            $_SESSION['User_ID'] = $_POST['User_ID'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $Email = validateEmail($_POST['Email']);
            $Password = validatePassword($_POST['Password']);
            $Zipcode = validateNumber($_POST['Zipcode']);
            $User_ID = validateID($_POST['User_ID']);
            

            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $Email[0] == "" && $Password[0] == "" && $Zipcode[0] == "") {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];
                $Zipcode = $_POST['Zipcode'];
                $User_ID = $_POST['User_ID'];
                $User_Type = ucfirst($_SESSION['User_Type']);
                $conn = mysqlConnect();

                $sql = "INSERT INTO Users (first_name, last_name, date_of_birth, Zipcode, User_Type, User_ID)
                        VALUES ('$first_name', '$last_name', '$dob', '$Zipcode', '$User_Type', '$User_ID');
                        INSERT INTO User_Login (Email, Password, User_ID, User_Type)
                        VALUES ('$Email', '$Password', '$User_ID', '$User_Type');";
                      mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $Email;
                          $_SESSION['Zipcodec'] = $Zipcode;
                          $_SESSION['Passwordc'] = $Password;
                          $_SESSION['User_IDc'] = $User_ID;
                          header('location:account_creation_confirmation.php');        
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>" . mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {


                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $Email[0];
                $errorPassword = $Password[0];
                $errorNumber = $Zipcode[0];
                $errorID = $User_ID[0];
                
                //Updating CSS for Errors
                $error_email_css = $Email[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $Password[1];
                $error_number_css = $Zipcode[1];
                $error_ID_css = $User_ID[1];
                
            }

        }

        htmlheader('w3-white');

        ?>
   <?php echo isset($message) ? $message : '';?>

    <div class = "w3-container">
    <h2> Create Research Staff Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

          <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
                  <div class="w3-section">
                    
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@hogwartsuniversity.edu" id = "Email" name = "Email" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['Email']) ? 'value="'. $_SESSION['Email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "Password" name = "Password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['Password']) ? 'value="'. $_SESSION['Password'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
                    <span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Zipcode</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="#####" id = "Zipcode" name = "Zipcode" onchange = "validateNumber(this.value);" <?php echo isset($Zipcode) ? 'value="'. $Zipcode .'"' : (isset($_SESSION['Zipcode']) ? 'value="'. $_SESSION['Zipcode'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
                    <label><b>User ID</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="" id = "User_ID" name = "User_ID" onchange = "validateID(this.value);" <?php echo isset($User_ID) ? 'value="'. $User_ID .'"' : (isset($_SESSION['User_ID']) ? 'value="'. $_SESSION['User_ID'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorID" style = "color: #CD2627"> <?php echo isset($errorID) ? $errorID : ''?> </span> <br><br>

                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
                  </div>
                </form>

     <?php
        }


   else if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "Student") 
   {

            if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['Email']) &&
            isset($_POST['Password']) &&
            isset($_POST['Zipcode']) &&
            isset($_POST['User_ID']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['Email'] = $_POST['Email'];
            $_SESSION['Password'] = $_POST['Password'];
            $_SESSION['Zipcode'] = $_POST['Zipcode'];
            $_SESSION['User_ID'] = $_POST['User_ID'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $Email = validateEmail($_POST['Email']);
            $Password = validatePassword($_POST['Password']);
            $Zipcode = validateNumber($_POST['Zipcode']);
            $User_ID = validateID($_POST['User_ID']);
            

            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $Email[0] == "" && $Password[0] == "" && $Zipcode[0] == "") {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];
                $Zipcode = $_POST['Zipcode'];
                $User_ID = $_POST['User_ID'];
                $User_Type = ucfirst($_SESSION['User_Type']);

                $conn = mysqlConnect();
      
                 $sql = "INSERT INTO Users (first_name, last_name, date_of_birth, Zipcode, User_Type, User_ID)
                        VALUES ('$first_name', '$last_name', '$dob', '$Zipcode', '$User_Type', '$User_ID');
                        INSERT INTO User_Login (Email, Password, User_ID, User_Type)
                        VALUES ('$Email', '$Password', '$User_ID', '$User_Type');
                        INSERT INTO Student (Student_ID)
                        VALUES ('$User_ID');";
                   mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $Email;
                          $_SESSION['Zipcodec'] = $Zipcode;
                          $_SESSION['Passwordc'] = $Password;
                          $_SESSION['User_IDc'] = $User_ID;
                          header('location:account_creation_confirmation.php');                  
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>";
                          echo mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user.</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

           
                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $Email[0];
                $errorPassword = $Password[0];
                $errorNumber = $Zipcode[0];
                $errorID = $User_ID[0];
                
                //Updating CSS for Errors
                $error_email_css = $Email[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $Password[1];
                $error_number_css = $Zipcode[1];
                $error_ID_css = $User_ID[1];
            }

        }
        htmlheader('w3-white');
  ?>
    <?php echo isset($message) ? $message : '';?>

    
    <div class = "w3-container">
    <h2> Create Student Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

          <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
                  <div class="w3-section">
                    
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@hogwartsuniversity.edu" id = "Email" name = "Email" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['Email']) ? 'value="'. $_SESSION['Email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "Password" name = "Password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['Password']) ? 'value="'. $_SESSION['Password'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
                    <span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Zipcode</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="#####" id = "Zipcode" name = "Zipcode" onchange = "validateNumber(this.value);" <?php echo isset($Zipcode) ? 'value="'. $Zipcode .'"' : (isset($_SESSION['Zipcode']) ? 'value="'. $_SESSION['Zipcode'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
                    <label><b>User ID</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="" id = "User_ID" name = "User_ID" onchange = "validateID(this.value);" <?php echo isset($User_ID) ? 'value="'. $User_ID .'"' : (isset($_SESSION['User_ID']) ? 'value="'. $_SESSION['User_ID'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorID" style = "color: #CD2627"> <?php echo isset($errorID) ? $errorID : ''?> </span> <br><br>
 <input class="w3-round login w3-padding-medium" type="radio" name = "status" value = "full_time" checked="checked">
                    <label><b>Full Time</b></label><br><br>

                     <input class="w3-round login w3-padding-medium" type="radio" name = "status" value = "part_time">
                    <label><b>Part Time</b></label><br> <br>
                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
                  </div>
                </form>
     <?php
        }

        else if (isset($_SESSION['User_Type']) && $_SESSION['User_Type'] == "Faculty") 
   {
            if (isset($_POST['first_name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['date_of_birth']) &&
            isset($_POST['Email']) &&
            isset($_POST['Password']) &&
            isset($_POST['Zipcode']) &&
            isset($_POST['User_ID']) &&
            isset($_POST['submit']))

        {
            //Creating global SESSION variables for each field
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
            $_SESSION['Email'] = $_POST['Email'];
            $_SESSION['Password'] = $_POST['Password'];
            $_SESSION['Zipcode'] = $_POST['Zipcode'];
            $_SESSION['User_ID'] = $_POST['User_ID'];
            
            $first_name = validateFirstName($_POST['first_name']);
            $last_name = validateLastName($_POST['last_name']);
            $dob = validateDateOfBirth(date("Y-m-d", strtotime($_POST['date_of_birth'])));
            $Email = validateEmail($_POST['Email']);
            $Password = validatePassword($_POST['Password']);
            $Zipcode = validateNumber($_POST['Zipcode']);
            $User_ID = validateID($_POST['User_ID']);
            

            if ($first_name[0] == "" && $last_name[0] == "" && $dob[0] == "" && $Email[0] == "" && $Password[0] == "" && $Zipcode[0] == "") {

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $dob = $_POST['date_of_birth'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];
                $Zipcode = $_POST['Zipcode'];
                $User_ID = $_POST['User_ID'];
                $User_Type = ucfirst($_SESSION['User_Type']);


                $conn = mysqlConnect();
                
      $sql = "INSERT INTO Users (first_name, last_name, date_of_birth, Zipcode, User_Type, User_ID)
                        VALUES ('$first_name', '$last_name', '$dob', '$Zipcode', '$User_Type', '$User_ID');
                        INSERT INTO User_Login (Email, Password, User_ID, User_Type)
                        VALUES ('$Email', '$Password', '$User_ID', '$User_Type');
                        INSERT INTO Faculty (Faculty_ID)
                        VALUES ('$User_ID');";
                   mysqli_autocommit($conn, FALSE);
                //mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);       
                if(mysqli_multi_query($conn, $sql)) {
                  while (mysqli_more_results($conn) && mysqli_next_result($conn)) {
                         mysqli_store_result($conn);
                  }
                  if (!mysqli_error($conn)) {
                          mysqli_commit($conn);
                          $_SESSION['first_namec'] = $first_name;
                          $_SESSION['last_namec'] = $last_name;
                          $_SESSION['date_of_birthc'] = $dob;
                          $_SESSION['emailc'] = $Email;
                          $_SESSION['Zipcodec'] = $Zipcode;
                          $_SESSION['Passwordc'] = $Password;
                          $_SESSION['User_IDc'] = $User_ID;
                          header('location:account_creation_confirmation.php');             
                     }
                     else {
                         mysqli_rollback($conn);
                         $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Transaction rolled back</p>
                                </div>" . mysqli_error($conn);
                     }
                   
                }
                else {
                    $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could not create user.</p>
                                </div>" . mysqli_error($conn);
                }
                mysqli_close($conn);

            }
            else {

                //Updating Errors
                $errorFirstName = $first_name[0];
                $errorLastName = $last_name[0];
                $errorDateOfBirth = $dob[0];
                $errorEmail = $Email[0];
                $errorPassword = $Password[0];
                $errorNumber = $Zipcode[0];
                $errorID = $User_ID[0];
                
                //Updating CSS for Errors
                $error_email_css = $Email[1];
                $error_firstname_css = $first_name[1];
                $error_lastname_css = $last_name[1];
                $error_dob_css = $dob[1];
                $error_password_css = $Password[1];
                $error_number_css = $Zipcode[1];
                $error_ID_css = $User_ID[1];
                
            }

        }

        htmlheader('w3-white');        

  ?>
  <!-- <script> 
  function checkStatus() {
        var statusPartTime = document.getElementById('part_time');
        var statusFullTime = document.getElementById('full_time');

        if (statusPartTime.checked) {
            document.getElementById("yearly_salary").readOnly  = true;
            document.getElementById("yearly_salary").style.background = "#C7C7C7";
            document.getElementById("hourly_salary").readOnly  = false;
            document.getElementById("hourly_salary").style.background = "";
        }
        else if (statusFullTime.checked) {
            document.getElementById("hourly_salary").readOnly  = true;
            document.getElementById("hourly_salary").style.background = "#C7C7C7";
            document.getElementById("yearly_salary").readOnly  = false;
            document.getElementById("yearly_salary").style.background = "";
        }
  }
  </script>
 -->
  <?php echo isset($message) ? $message : '';?>

  
    <div class = "w3-container">
    <h2> Create Faculty Account </h2>
    <p> Create <?php echo ucfirst($_SESSION['user_category']) ?> Account </p>
    </div>

          <form class="w3-container" action = "?" method = "post" id = "loginForm" onSubmit = "validate();" style="max-width:450px">
                  <div class="w3-section">
                    
                    <label><b>First Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter First Name" id = "first_name" name = "first_name" onchange = "validateFirstName(this.value);" <?php echo isset($_SESSION['first_name']) ? 'value="'. $_SESSION['first_name'] .'"' : '' ?> <?php echo isset($error_firstname_css) ? 'style="'. $error_firstname_css .'"' : '' ?>>  
                    <span class = "errormsg" id="errorFirstName" style = "color: #CD2627"> <?php echo isset($errorFirstName) ? $errorFirstName : '' ?></span> <br> <br>

                     <label><b>Last Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="Enter Last Name" id = "last_name" name = "last_name" onchange = "validateLastName(this.value);" <?php echo isset($_SESSION['last_name']) ? 'value="'. $_SESSION['last_name'] .'"' : '' ?> <?php echo isset($error_lastname_css) ? 'style="'. $error_lastname_css .'"' : '' ?>> 
                    <span class = "errormsg" id="errorLastName" style = "color: #CD2627"> <?php echo isset($errorLastName) ? $errorLastName : '' ?></span> <br> <br>

                    <label><b>Date Of Birth</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "date" id = "date_of_birth" name = "date_of_birth" <?php echo isset($_SESSION['date_of_birth']) ? 'value="'. $_SESSION['date_of_birth'] .'"' : '' ?> <?php echo isset($error_dob_css) ? 'style="'. $error_dob_css .'"' : ''?>>  
                    <span class = "errormsg" id="errorDateOfBirth" style = "color: #CD2627"> <?php echo isset($errorDateOfBirth) ? $errorDateOfBirth : ''?></span> <br> <br>

                    <label><b>Email Address</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" placeholder="username@hogwartsuniversity.edu" id = "Email" name = "Email" onchange = "validateEmail(this.value);" <?php echo isset($_SESSION['Email']) ? 'value="'. $_SESSION['Email'] .'"' : '' ?> <?php echo isset($error_email_css) ? 'style="'. $error_email_css .'"' : ''?>>
                    <span class = "errormsg" id="errorEmail" style = "color: #CD2627"> <?php echo isset($errorEmail) ? $errorEmail : ''?> </span> <br> <br>
                      
                    <label><b>Password (6 characters min.)</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="password" placeholder="1 each of a-z, A-Z and 0-9" id = "Password" name = "Password" onchange = "validatePassword(this.value);" <?php echo isset($_SESSION['Password']) ? 'value="'. $_SESSION['Password'] .'"' : '' ?> <?php echo isset($error_password_css) ? 'style="'. $error_password_css .'"' : ''?>>
                    <span class = "errormsg" id="passwordError" style = "color: #CD2627"> <?php echo isset($errorPassword) ? $errorPassword : ''?></span> <br> <br>

                    <label><b>Zipcode</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="#####" id = "Zipcode" name = "Zipcode" onchange = "validateNumber(this.value);" <?php echo isset($Zipcode) ? 'value="'. $Zipcode .'"' : (isset($_SESSION['Zipcode']) ? 'value="'. $_SESSION['Zipcode'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorNumber" style = "color: #CD2627"> <?php echo isset($errorNumber) ? $errorNumber : ''?> </span> <br><br>
                    <label><b>User ID</b></label><br>
                    <input class="w3-input w3-round signup w3-padding-medium" type="text" placeholder="" id = "User_ID" name = "User_ID" onchange = "validateID(this.value);" <?php echo isset($User_ID) ? 'value="'. $User_ID .'"' : (isset($_SESSION['User_ID']) ? 'value="'. $_SESSION['User_ID'] .'"' : '') ?> >
                    <span class = "errormsg" id="errorID" style = "color: #CD2627"> <?php echo isset($errorID) ? $errorID : ''?> </span> <br><br>

                      <input class="w3-btn w3-blue-grey w3-section" type="submit" name = "submit" value = "Create User">
                  </div>
                </form>
     <?php
        }
   
?>

   </div>

<?php
 htmlfooter();
 unset($_SESSION['usernamefield']);
 unset($_SESSION['email']);
 unset($_SESSION['first_name']);
 unset($_SESSION['last_name']);
 unset($_SESSION['date_of_birth']);
 unset($_SESSION['passwordfield']);
 unset($_SESSION['Zipcode']);
?>
