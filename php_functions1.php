

<?php
//include 'D:\wamp64\www\test\mysql.php';

/***********Database**********/

// These credentials are for a local database server. Change it before testing on your local machine.

function mysqlConnect()
{



 $host = 'project1.cdbkarygfry8.us-east-2.rds.amazonaws.com';
 $database = 'WebBasedSystem';
 $user = 'admin';
 $password = 'Group463!';


	$conn = mysqli_connect($host, $user, $password, $database);
	if (mysqli_connect_errno()) {
		die("Connection failed: " . mysqli_connect_error());
	}

	return $conn;
}

/***********Login**********/

function validateLogin($Email, $password)
{
	if ($Email == "") {
		$errorUsername = "Please enter your email";
		$error_username_css = "border:2px groove #CD2627";
	}
	else {
		$errorUsername = "";
		$error_username_css = "";
	}

	if ($password == "") {
		$errorPassword = "Please enter your password";
		$error_password_css = "border:2px groove #CD2627";
	}
	else {
		$errorPassword = "";
		$error_password_css = "";
	}

	return array(
		$errorUsername,
		$errorPassword,
		$error_username_css,
		$error_password_css
	);
}

/***********Account Creation**********/

function validateFirstName($firstname)
{
	if ($firstname == "") {
		$errorFirstName = "Please enter your first name ";
		$error_firstname_css = "border:2px groove #CD2627";
	}
	else {
		$errorFirstName = "";
		$error_firstname_css = "";
	}

	return array(
		$errorFirstName,
		$error_firstname_css
	);
}

function validateLastName($lastname)
{
	if ($lastname == "") {
		$errorLastName = "Please enter your last name ";
		$error_lastname_css = "border:2px groove #CD2627";
	}
	else {
		$errorLastName = "";
		$error_lastname_css = "";
	}

	return array(
		$errorLastName,
		$error_lastname_css
	);
}

function validateDateOfBirth($dateOfBirth)
{
	$currentDate = date("Y-m-d");
	if (empty($dateOfBirth)) {
		$errorDateOfBirth = "Please enter dob";
	}
	else
	if ($dateOfBirth > $currentDate) {
		$errorDateOfBirth = "Date of birth cannot be in future";
		$error_dob_css = "border:2px groove #CD2627";
	}
	else {
		$errorDateOfBirth = "";
		$error_dob_css = "";
	}

	return array(
		$errorDateOfBirth,
		$error_dob_css
	);
}

function validateUsername($username)
{
	if ($username == "") {
		$errorUsername = "Please choose a username PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else
	if (strlen($username) >= 1 && strlen($username) < 5) {
		$errorUsername = "Username must be atleast 5 characters long PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else
	if (preg_match("/[^a-zA_Z0-9_-]/", $username)) {
		$errorUsername = "Only a-z, A-Z, 0-9, - and _ allowed in username PHP";
		$error_username_css = "border:2px groove #CD2627";
	}
	else {
		$errorUsername = "";
		$error_username_css = "";
	}

	return array(
		$errorUsername,
		$error_username_css
	);
}

function validateEmail($email)
{

	if ($email == "") {
		$errorEmail = "Please enter your email PHP";
		$error_email_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/\S+@\S+\.\S+/", $email)) {
		$errorEmail = "The Email Address is invalid PHP";
		$error_email_css = "border:2px groove #CD2627";
	}
	else 
	if ($email !== "") {
		$conn = mysqlConnect();
		$sql = "Select Email FROM User_Login where Email = '$email'";
		if ($result = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($result) > 0) {
				$errorEmail = "The Email Address is already taken";
				$error_email_css = "border:2px groove #CD2627";
		  }
		   else {
				$errorEmail = "";
				$error_email_css = "";
			}
	    }
	}

	return array(
		$errorEmail,
		$error_email_css
	);
}

function validateID($User_ID)
{

	if ($User_ID == "") {
		$errorID = "Please enter a User ID";
		$error_ID_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/^\d{9}$/", $User_ID)) {
		$errorID = "The User ID is invalid";
		$error_ID_css = "border:2px groove #CD2627";
	}
	else 
	if ($User_ID !== "") {
		$conn = mysqlConnect();
		$sql = "Select User_ID FROM Users where User_ID = '$User_ID'";
		if ($result = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($result) > 0) {
				$errorID = "The User ID is already taken";
				$error_ID_css = "border:2px groove #CD2627";
		  }
		   else {
				$errorID = "";
				$error_ID_css = "";
			}
	    }
	}

	return array(
		$errorID,
		$error_ID_css
	);
}

function validatePassword($password)
{
	if ($password == "") {
		$errorPassword = "Please enter password PHP";
		$error_password_css = "border:2px groove #CD2627";
	}
	else
	if (strlen($password) > 1 && strlen($password) < 6) {
		$errorPassword = "Password must be atleast 6 characters long";
		$error_password_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
		$errorPassword = "Pasword require 1 each of a-z, A-Z and 0-9";
		$error_password_css = "border:2px groove #CD2627";
	}
	else {
		$errorPassword = "";
		$error_password_css = "";
	}

	return array(
		$errorPassword,
		$error_password_css
	);
}

function validateNumber($Zipcode)
{
	if ($Zipcode == "") {
		$errorNumber = "Please enter Zipcode";
		$error_number_css = "border:2px groove #CD2627";
	}
	else
	if (!preg_match("/(^\d{5}$)|(^\d{5}-\d{4}$)/", $Zipcode)) {
		$errorNumber = "The Zip Code is invalid";
		$error_number_css = "border:2px groove #CD2627";
	}
	else {
		$errorNumber = "";
		$error_number_css = "";
	}

	return array(
		$errorNumber,
		$error_number_css
	);
}


function validateSalary($salaryPartTime, $salaryFullTime)
{
	if ($salaryPartTime == "" && $salaryFullTime == "") {
		$errorsalary = "Please enter salary PHP";
		$error_salary_css = "border:2px groove #CD2627";
	}
	else if ($salaryPartTime !== "" && $salaryFullTime !== ""){
		$errorsalary = "Only one field required for salary";
		$error_salary_css = "";
	}
	else {
		$errorsalary = "";
		$error_salary_css = "";
	}

	return array(
		$errorsalary,
		$error_salary_css
	);
}

/***********Account Management**********/

function searchAccount2($searchFields, $user_type = '')
{
	global $errorMsg;

	// foreach($searchFields as $key => $value) {

	if ($user_type == '') {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value'";
					break;

				case 'first_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value'";
					break;

				case 'last_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "student") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'S'";
					break;

				case 'first_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'S'";
					break;

				case 'last_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'S'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "faculty") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'F'";
					break;

				case 'first_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'F'";
					break;

				case 'last_name':
					$sql = "SELECT first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'F'";
					break;
				}
			}
		}
	}

	// }

	if (sizeof($searchFields) == 1) {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sql);
		if (!mysqli_num_rows($result) == 0) {
			$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
			while ($row = mysqli_fetch_array($result)) {
				$resultTable.= "<tr>
                                <td>$row[0]</td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                </tr>";
			}

			$resultTable.= "</table></div>";
			echo ($resultTable);
		}
		else {
			echo ("Account doesn't exist");
		}

		mysqli_close($conn);
	}
	else
	if (sizeof($searchFields) > 1) {
		echo "<div class = 'w3-container'>
                <span style = 'font-size:130%; color: #CD2627'> Search can be performed by one field only </span>
                </div>";
	}
	else
	if (sizeof($searchFields) == 0) {
		echo "<div class = 'w3-container'>
                <span style = 'font-size:130%; color: #CD2627'> Please fill in one of the fields for search </span>
                </div>";
	}
}

function searchAccount($searchFields, $user_type = NULL, $operation = NULL)
{
	// foreach($searchFields as $key => $value) {

	if ($user_type == NULL) {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE user_id = '$value'";
					break;

				case 'first_name':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE first_name = '$value'";
					break;

				case 'last_name':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE last_name = '$value'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "admin") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'User_ID':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE User_ID = '$value' AND User_Type = 'Admin'";
					break;

				case 'first_name':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE first_name = '$value' AND User_Type = 'Admin'";
					break;

				case 'last_name':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE last_name = '$value' AND User_Type = 'Admin'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "research") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE User_ID = '$value' AND User_Type = 'Research Staff'";
					break;

				case 'first_name':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE first_name = '$value' AND User_Type = 'Research Staff'";
					break;

				case 'last_name':
					$sql = "SELECT User_ID, first_name, last_name, date_of_birth, email FROM Users WHERE last_name = '$value' AND User_Type = 'Research Staff'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "student") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'S'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'S'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'S'";
					break;
				}
			}
		}
	}
	else
	if ($user_type == "faculty") {
		foreach($searchFields as $key => $value) {
			if ($value !== "") {
				switch ($key) {
				case 'user_id':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE user_id = '$value' AND user_type = 'F'";
					break;

				case 'first_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE first_name = '$value' AND user_type = 'F'";
					break;

				case 'last_name':
					$sql = "SELECT user_id, first_name, last_name, date_of_birth, email, tel_num, username FROM user WHERE last_name = '$value' AND user_type = 'F'";
					break;
				}
			}
		}
	}

	// }

	if (sizeof($searchFields) == 1) {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sql);
		if (!mysqli_num_rows($result) == 0) {
			if ($operation == NULL) {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
					$resultTable.= "<tr>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                </tr>";
				}

				$resultTable.= "</table></div>";
				echo ($resultTable);
			}
			else
			if ($operation == 'delete') {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = 'account_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> User_ID </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Number  </th>
                                    <th> Username </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {
                    //<td><input type = 'checkbox' name = 'checkbox[]' value = $row[0]> <a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
					$resultTable.= "<tr>  
                                <td><a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[6]</td>
                                </tr>";
				}
				//$resultTable.= "</table><input class='w3-btn w3-blue-grey w3-section' type='submit' name = 'Delete' value = 'Delete User'></form></div>";
				echo ($resultTable);
			}
		}
		else {
			echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Account doesn't exist</p>
                        </div>";
		}

		mysqli_close($conn);
	}
	else
	if (sizeof($searchFields) > 1) {
		 echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Search can be performed by one field only</p>
                        </div>";
	}
	else
	if (sizeof($searchFields) == 0) {
		echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Please fill in one of the fields for search</p>
                        </div>";
	}
    
}

function deleteAccount()
{
	$deleteFields = array();
	foreach($_GET['checkbox'] as $id) {
		$deleteFields[] = $id;
		if (sizeof($deleteFields) == 1) {
			$sqlDelete = "DELETE FROM user WHERE user_id = $id";
		}
		else
		if (sizeof($deleteFields) > 1) {
			$deleteFields = implode(',', $deleteFields);
			$sqlDelete = "DELETE FROM user WHERE user_id IN ($deleteFields)";
		}
	}

	if (sizeof($deleteFields) >= 1) {
		$conn = mysqlConnect();
		$result = mysqli_query($conn, $sqlDelete);
		if (mysqli_query($conn, $sqlDelete)) {
			$message = "<div class='w3-container w3-pale-green'>
                        <h3>Success</h3>
                        <p>User deleted successfully.</p>
                        </div>";
		}
		else {
			$message = "<div class='w3-container w3-pale-green'>
                         <h3>Failure</h3>
                        <p>Delete operation failed.</p>
                        </div>";
		}

		mysqli_close($conn);
	}
   return $message;
}
// ------------------ BENS FUNCTIONS------------------------------------
function connectToHost(){
 $host = 'project1.cdbkarygfry8.us-east-2.rds.amazonaws.com';
 $database = 'WebBasedSystem';
 $user = 'admin';
 $password = 'Group463!';

    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	return $conn;
}

function runSQL($conn, $sql){
    $result = $conn->query($sql);
    return $result;
}

function addPrereq($id, $preid){
    $conn = connectToHost();
    $sql = "insert into prerequisites (Course_Name, PRE_ID) values ($id,$preid)";
    $result = runSQL($conn,$sql);

    if($result){
        echo "Prerequisite added for course id '$id' ";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function makeEditCourseForm($Course_ID){
    $conn = connectToHost();
    $sql = "SELECT * FROM Courses WHERE Course_ID = $Course_ID";
    $result = runSQL($conn,$sql);


    if($result){
        $row = $result->fetch_assoc();

        echo "<h1 style='margin-left:15px'>Edit Course</h1>
            <form class='w3-container' action = 'edit_validation.php' method = 'post'>
            <label class='w3-label w3-white'><b>Department</b></label>
            <select class='w3-select w3-border' name='dept' required>";
            getAllDepartments();


        echo "</select><br><br>
            <label class='w3-label w3-white'><b>Course Name</b></label>
            <input class='w3-input' type='text' name='name' value='".$row['Course_Name']."' required>
            <br>
            <label class='w3-label w3-white'><b>Course ID</b></label>
            <input class='w3-input' type='text' name='crsid' value='".$row['Course_ID']."'>
            <br>
            <label class='w3-label w3-white'><b>Major</b></label>
            <textarea class='w3-input' type='text' name='major'>".$row['Major']."</textarea>
            <br>
            <label class='w3-label w3-white'><b>Course Credit</b></label>
            <input class='w3-input' type='number' max='4' min='2' name='credits' value='".$row['Course_Credit']." required'>
            <input value=".$_GET["Course_ID"]." name='crsid' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();' >Update</button>
                <a class='w3-btn w3-green' href='admin_home.php'>cancel</a>
            </div>
            </form>";
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function makeEditSectionForm($room,$semester,$timeslot){
    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'confirm_section_edit.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Room</label>
            <select class='w3-select w3-border' name='room' required>";
            getAllRooms($room);
    echo  " </select>
            <label class='w3-label w3-blue-grey'>Semester</label>
            <select class='w3-select w3-border' name='semester' required>";
            getAllSemesters($semester);
    echo  " </select>
            <label class='w3-label w3-blue-grey'>TimeSlot</label>
            <select class='w3-select w3-border' name='timeslot' required>";
            getAllTimeslots($timeslot);
    echo  " </select>
            <input value='".$_GET['CRN']."' name='crn' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='admin_home.php'>cancel</a>
            </div>
          </form>";

}

function editSection($crn, $room, $semester,$timeslot){
//    $conn = connectToHost();
//    $sql = "update course set dept_id = $department, course_name = '$name', course_category = '$catagory', course_description = '$desc', credits = $cred where course_id = $course";
//    if(runSQL($conn, $sql)){
//        echo "course updated";
//    }else{
//        echo "Failed:". mysqli_error($conn);
//    }
//    $conn->close();
    $conn = connectToHost();
    //$sql = "insert into section(course_id, room_id, semester_id ,timeslot_id ) values ($course, $room, '$semester',$timeslot)";
    $sql = "update section set room_id = $room, semester_id = $semester, timeslot_id = $timeslot where crn = $crn";
    $sql_valid = "select * from section where room_id = $room and timeslot_id = $timeslot";
    $result = runSQL($conn, $sql_valid);
    if($result->num_rows == 0){
        if(runSQL($conn, $sql)){
            echo "Section updated";
        }else{
            echo "Failed:". mysqli_error($conn);
        }
    }else{
         echo "Scheduling Conflict please try again";
    }
    $conn->close();
}

function editCourse($course,$name, $catagory ,$desc,$cred, $department){
    $conn = connectToHost();
    $sql = "update course set dept_id = $department, course_name = '$name', course_category = '$catagory', course_description = '$desc', credits = $cred where course_id = $course";
    if(runSQL($conn, $sql)){
        echo "course updated";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addBuilding($buildingName){
    $conn = connectToHost();
    $sql = "insert into Building (Building_ID, Building_Name, Building_Type) values ('$buildingID', '$buildingName', '$buildingType')";
    if(runSQL($conn, $sql)){
        echo "Building created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}
function addRoom($buildingId, $roomNum, $roomtype, $capacity){
    $conn = connectToHost();
    $sql = "insert into Room(Building_ID, Room_ID, Room_Type) values ($buildingId, '$roomNum', $roomtype)";

    if(runSQL($conn, $sql)){
        echo "Room created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addSemester($name, $year, $start, $end){
    $conn = connectToHost();
    $sql = "insert into semester(sem_name, sem_year, sem_start_date, sem_end_date) values ($name, $year, $start, $end)";
    if(runSQL($conn, $sql)){
        echo "Semester created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addPeriod($start, $end){
    $conn = connectToHost();
    $sql = "insert into period(start_time, end_time) values ($start, $end)";
    if(runSQL($conn, $sql)){
        echo "Period created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addDay($day){
    $conn = connectToHost();
    $sql = "insert into day(day) values ($day)";
    if(runSQL($conn, $sql)){
        echo "Day created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function addTimeslot($day, $period){
    $conn = connectToHost();
    $sql = "insert into timeslot(day_id, period_id) values ($day, $period)";
    if(runSQL($conn, $sql)){
        echo "Timeslot created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

/**function htmlheader(){
    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
        header("Location: index.php");
    }

    if (isset($_POST['signout'])) {
        session_unset();
        session_destroy();
        header("Location: logout_page.php");
    }

    echo "<!doctype html>
            <html>
                <head>
                    <title>BJK Registration</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		            <link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
                    <script src='js/functions.js' type='text/javascript'></script>
                </head>

    <span> Signed in as ";
    echo $_SESSION['username'];
    echo "</span><body class='w3-blue-grey'>
        <nav class='w3-bar w3-white'><a class='w3-bar-item w3-button w3-hover-blue-grey' href='admin_home.php'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='catalog.php'>Master Catalog</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='dept_viewAllpub.php'>Departments</a>
        <form action = '?' method = 'post'>
            <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' value = 'Sign Out'>
        </form>
		<div class='w3-dropdown-hover w3-right'>
            <button class='w3-button'>";
			 echo $_SESSION['firstname'];
			echo "</button>
            <div class='w3-dropdown-content w3-bar-block w3-border'>
                <a href='personal_info.php' class='w3-bar-item w3-button'>Account</a>
                <a href='#' class='w3-bar-item w3-button'>Link 2</a>
                <a href='#' class='w3-bar-item w3-button'>Link 3</a>
            </div>
         </div>
    </nav>";
}**/

function htmllayer($level){
    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "admin") {
        header("Location: ../index.php");
    }

    if (isset($_POST['signout'])) {
        session_unset();
        session_destroy();
        header("Location: ../logout_page.php");
    }

    echo "<!doctype html>
            <html>
                <head>
                    <title>Hogwarts University</title>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
		            <link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
                    <script src='../js/functions.js' type='text/javascript'></script>
                    <script src='../js/css.js' type='text/javascript'></script>
                </head>

    <span> Signed in as ";
    echo $_SESSION['username'];
    echo "</span><body class='w3-blue-grey'>
        <nav class='w3-bar w3-white'><a class='w3-bar-item w3-button w3-hover-blue-grey' href='../admin_home.php'>Home</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='../schedule.php'>Master Schedule</a>
            <a class='w3-bar-item w3-button w3-hover-blue-grey' href='../catalog.php'>Master Catalog</a>
        <form action = '?' method = 'post'>
            <input type = 'submit' name = 'signout' class='w3-bar-item w3-button w3-right w3-red' value = 'Sign Out'>
        </form>
    </nav>";
}

/**function htmlfooter(){
    echo "</body></html>";
}**/

function makeBuildingForm(){

    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'building_create_vaild.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Building ID</label>
            <input class='w3-input' type='text' name='Building_ID'>
            <label class='w3-label w3-blue-grey'>Building Name</label>
            <input class='w3-input' type='text' name='building_name'>
            <label class='w3-label w3-blue-grey'>Building Type</label>
            <input class='w3-input' type='text' name='Building_Type'>

            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='../admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";


}

function makeRoomForm(){

    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'room_vaild.php' method = 'post'>

            <label class='w3-label w3-blue-grey'>Building Name</label>
            <select class='w3-input' name='Building'>";
            getAllBuildings();
    echo   "</select>
            <label class='w3-label w3-blue-grey'>Room Number</label>
            <input class='w3-input' type='text' name='Room_ID'>
            <label class='w3-label w3-blue-grey'>Room Type</label>
            <select class='w3-input' id='Rooms' onchange='setTextField(this)'>
                <option value='0'>Lab</option>
                <option value='1'>Lecture Hall</option>
                <option value='1'>Classroom</option>
                <option value='1'>Classroom/Lab</option>

            </select>
            <input id='room_type2' type = 'hidden' name = 'Room_Type' value = '' />
            <script type='text/javascript'>
                function setTextField(ddl) {
                    document.getElementById('room_type2').value = ddl.options[ddl.selectedIndex].text;
                }
            </script>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='../admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";


}


function addSection($course, $room ,$semester,$timeslot){
    $conn = connectToHost();
    $sql = "insert into Class(Course_ID, Room_ID, Semester_ID ,Timeslot_ID ) values ($course, $room, '$semester',$timeslot)";
    $sql_valid = "select * from Class where Room_ID = $room and Timeslot_ID = $timeslot";
    $result = runSQL($conn, $sql_valid);
    if($result->num_rows == 0){
        if(runSQL($conn, $sql)){
            echo "Section created";
        }else{
            echo "Failed:". mysqli_error($conn);
        }
    }else{
         echo "Scheduling conflict please try again";
    }
    $conn->close();
}

function addFaculty($faculty, $crn){
    $conn = connectToHost();
    $sql = "insert into teaching(faculty_id, crn) values ($faculty, $crn)";
    $sql_valid = "select * from teaching left join section on teaching.crn = section.crn where faculty_id = $faculty";
    $result = runSQL($conn, $sql_valid);
    if($result->num_rows == 0){
        if(runSQL($conn, $sql)){
            echo "Faculty has been assigned";
        }else{
            echo "Failed:". mysqli_error($conn);
        }
    }else{
         echo "Scheduling Conflict please try again";
    }
    $conn->close();
}


function deleteSection($crn){
    $conn = connectToHost();
    $sql = "DELETE FROM Class WHERE CRN = $crn";
    if(runSQL($conn, $sql)){
        echo "Section delete";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function archiveCourse($Course_ID){
    $conn = connectToHost();
    $sql = "update course set is_archived = 1 where Course_ID = $Course_ID";
    if(runSQL($conn, $sql)){
        echo "course archived";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function restoreCourse($Course_ID){
    $conn = connectToHost();
    $sql = "update course set is_archived = 0 where Course_ID = $Course_ID";
    if(runSQL($conn, $sql)){
        echo "course archived";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

//--------------------------------------------------
function confirmAction($text, $redirect){
    echo "<script>
            var conf = confirm('$text');
            if(!conf){
                window.location.href= \"$redirect\";
                window.stop();
            }
        </script>";
}

//--------------------------------------------------
function addHold($name, $desc){
    $conn = connectToHost();
    $sql = "insert into hold(hold_name, hold_desc) values ($name, $desc)";
    if(runSQL($conn, $sql)){
        echo "Hold created";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function editHold($hold_id,$name, $desc){
    $conn = connectToHost();
    $sql = "update hold set hold_name = $name,hold_desc = $desc where hold_id = $hold_id";
    if(runSQL($conn, $sql)){
        echo "Hold updated";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function deleteHold($hold_id){
    $conn = connectToHost();
    $sql = "DELETE FROM hold WHERE hold_id = $hold_id";
    if(runSQL($conn, $sql)){
        echo "Hold delete";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function viewStudentHold($student_id){
    $conn = connectToHost();
    $sql = "select hold.hold_name, hold.hold_desc
            from student_hold
            inner join hold on hold.hold_id = student_hold.hold_id
            where student_hold.student_id = $student_hold";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo $row["hold_name"]." ".$row["hold_desc"];
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}
function teachingForm($timeslot,$crn){
        echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'teaching_valid.php' method = 'post'>
            <label class='w3-label w3-blue-grey'>Facilty</label>
            <select class='w3-select w3-border' name='faculty' required>";
            getAvaliableFaculty($timeslot);
    echo  " </select>
            <input value='$crn' name='crn' type='hidden'>
            <div>
                <button class='w3-btn w3-green' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-green' href='../admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";
}

function getAvaliableFaculty($timeslot){
    $conn = connectToHost();
    $sql  = "SELECT Faculty.Faculty_ID, CONCAT(last_name, ', ', first_name) AS full_name
	         FROM Faculty
                INNER JOIN Users ON Faculty.Faculty_ID = Users.User_ID
                left join Masterschedulefull on Masterschedulefull.Faculty_ID = Faculty.Faculty_ID
                left join Class on Class.CRN = Masterschedulefull.CRN
             where Class.Timeslot_ID != $timeslot or Class.CRN is null";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["Faculty_ID"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function applyHold($hold, $student){
    $conn = connectToHost();
    $sql = "insert into student_hold(student_id, hold_id) values ($hold, $student)";
    if(runSQL($conn, $sql)){
        echo "Hold Applied";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function removeStudentHold($student_id, $hold_id){
    $conn = connectToHost();
    $sql = "DELETE FROM student_hold WHERE hold_id = $hold_id and student_id = $student_id";
    if(runSQL($conn, $sql)){
        echo "Hold Deleted from student account";
    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}
function viewFacultyGrades($faculty){
    echo "<table class='w3-table-all w3-margin-top w3-text-black' id='myTable'>
                <tr>
                    <th style='width:10%;'>CRN</th>
                    <th style='width:10%;'>Course Name</th>
                    <th style='width:10%;'>Location</th>
                    <th style='width:10%;'>Days</th>
                    <th style='width:10%;'>Start Time</th>
                    <th style='width:10%;'>End Time</th>
                    <th style='width:10%;'>Attendance</th>
                </tr> ";
    viewfacultySec($faculty);
    echo "</table>";
}

function viewSections(){
    $conn = connectToHost();
    $sql = "SELECT
                section.crn,
                course.course_name,
                CASE
                	when user.first_name is null then 'TBA'
               	 	else user.first_name
                End as 'first_name'
                ,
                CASE
                	when user.last_name is null then ''
               	 	else user.last_name
                End as 'last_name',
                building.building_name,
                room.room_num,
                room.capacity,
                semester.sem_name,
                day.day,
                period.start_time,
                period.end_time

            FROM section
            left join teaching on teaching.crn = section.crn
            left join course on section.course_id = course.course_id
            left join user on user.user_id = teaching.faculty_id
            left join room on room.room_id = section.room_id
            left join building on room.building_id = building.building_id
            left join semester on semester.semester_id = section.semester_id
            left join timeslot on timeslot.timeslot_id = section.timeslot_id
            left join day on timeslot.day_id = day.day_id
            left join period on timeslot.period_id = period.period_id
            GROUP by section.crn
            ";
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["crn"]. "</td><td>" . $row["course_name"]. "</td><td>" . $row["first_name"]." ". $row["last_name"]."</td><td>" . $row["building_name"]." ". $row["room_num"]. "</td><td>". $row["capacity"]. "</td><td>". $row["sem_name"]. "</td><td>". $row["day"]. "</td><td>". $row["start_time"]. "</td><td>". $row["end_time"]. "</td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function viewAdminSections(){
    $conn = connectToHost();
    $sql = "SELECT
                Class.CRN,
                Courses.Course_Name,
                CASE
                	when Users.first_name is null then 'TBA'
               	 	else Users.first_name
                End as 'first_name'
                ,
                CASE
                	when Users.last_name is null then ''
               	 	else Users.last_name
                End as 'last_name',
                Building.Building_Name,
                Room.Room_Type,
                Masterschedulefull.Total_Seats,
                Semester.Semester_Name,
                Day.Day_ID,
                Period.Start_Time,
                Period.End_Time,
                Class.Timeslot_ID,
                Semester.Semester_ID,
                Room.Room_ID

            FROM Class
            left join Masterschedulefull on Masterschedulefull.CRN = Class.CRN
            left join Courses on Class.Course_ID = Course.Course_ID
            left join Users on Users.User_ID = Masterschedulefull.Faculty_ID
            left join Room on Room.Room_ID = Class.Room_ID
            left join Building on Room.Building_ID = Building.Building_ID
            left join Semester on Semester.Semester_ID = Class.Semester_ID
            left join Time_slot on Time_slot.Timeslot_ID = Class.Timeslot_ID
            left join Day on Time_slot.Day_ID = Day.Day_ID
            left join Period on Time_slot.Period_ID = Period.Period_ID
            GROUP by Class.CRN ";
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='../teaching_form.php?crn=".$row["CRN"]."&Time_slot=".$row["Timeslot_ID"]."'>".$row["CRN"]. "</td><td>" . $row["Course_Name"]. "</td><td>" . $row["first_name"]." ". $row["last_name"]."</td><td>" . $row["Building"]." ". $row["Room_Number"]. "</td><td>". $row["Total_Seats"]. "</td><td>". $row["Semester_Year"]. "</td><td>". $row["Day"]. "</td><td>". $row["Start_Time"]. "</td><td>". $row["End_Time"]. "</td><td><a href='../edit_section.php?crn=".$row["CRN"]."&time=".$row["Timeslot_ID"]."&room=".$row["Room_ID"]."&Semester=".$row["Semester_ID"]."' class='w3-button'>Edit Section</a></td><td><a href='../delete_section.php?crn=".$row["CRN"]."' class='w3-button'>Delete Section</a></td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function getClass($faculty, $crn){
    $conn = connectToHost();
    $sql = "SELECT Users.User_ID,Users.first_name, Users.last_name, Attendance.Attendance, Enrollment.Student_ID
    	from Enrollment
        inner join Users on Users.User_ID = Enrollment.Student_ID
        left join Attendance on Attendance.Student_ID = Enrollment.Student_ID
        where Enrollment.CRN = '$crn' ";
    $result = runSQL($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='hidden' name='student[]' value='".$row["User_ID"]."' ><input type='hidden' name='crn' value='$crn' ><a href='account_info.php' account=".$row["Student_ID"]."&crn=".$_GET["CRN"].">".$row["first_name"]."</a></td><td>".$row["last_name"]."</td><td>".$row["User_ID"]."</td>";

            if($row["attendance"] == 0 || $row["attendance"] === null){
                echo "<td><select name='attendance[]'>
                        <option value='0' selected='selected'>Absent</option>
                        <option value='1'>Present</option>
                        <option value='2'>Late</option>
                    </select>
                    </td></tr>";
            }
            if($row["attendance"] == 1){
                echo "<td><select name='attendance[]'>
                        <option value='0'>Absent</option>
                        <option value='1'selected='selected'>Present</option>
                        <option value='2'>Late</option>
                    </select>
                    </td></tr>";
            }
           if($row["attendance"] == 2){
                echo "<td><select name='attendance[]'>
                        <option value='0'>Absent</option>
                        <option value='1'>Present</option>
                        <option value='2' selected='selected'>Late</option>
                    </select>
                    </td></tr>";
            }


        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function getClass2($faculty, $crn){
    $conn = connectToHost();
    $sql = "SELECT Users.User_ID,Users.first_name, Users.last_name, Attendance.Attendance, Enrollment.Student_ID
    	from Enrollment
        inner join Users on Users.User_ID = Enrollment.Student_ID
        left join Attendance on Attendance.Student_ID = Enrollment.Student_ID
        where Enrollment.CRN = '$crn' ";
    $result = runSQL($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='hidden' name='student[]' value='".$row["User_ID"]."' ><input type='hidden' name='crn' value='$crn' >".$row["first_name"]."</td><td>".$row["last_name"]."</td>";

            if($row["attendance"] == 0 || $row["attendance"] === null){
                echo "<td>Absent</td></tr>";
            }
            if($row["attendance"] == 1){
               echo "<td>Present</td></tr>";
            }
           if($row["attendance"] == 2){
                echo "<td>Late</td></tr>";
            }
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}
function getFacultybyName($name){
    $conn = connectToHost();
    $sql = "SELECT User_ID
            FROM Faculty
                INNER join User_Login on User_Login.User_ID = Faculty.Faculty_ID
                where Email = '$name' ";
    $result = runSQL($conn, $sql);
    $id = null;
    if ($result->num_rows >= 0) {
        $row = $result->fetch_assoc();
        $id = $row["User_ID"];
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
    return $id;
}

function viewFacultyClasses($faculty){
    echo "<table class='w3-table-all w3-margin-top w3-text-black' id='myTable'>
                <tr>
                    <th style='width:10%;'>CRN</th>
                    <th style='width:10%;'>Course Name</th>
                    <th style='width:10%;'>Location</th>
                    <th style='width:10%;'>Day</th>
                    <th style='width:10%;'>Start Time</th>
                    <th style='width:10%;'>End Time</th>
                    <th style='width:10%;'>Attendance</th>
                </tr> ";
    viewfacultySections($faculty);
    echo "</table>";

}
function viewfacultySections($faculty){
    $conn = connectToHost();
    $sql = "SELECT
                Class.CRN,
                Courses.Course_Name,
                CASE
                	when Users.first_name is null then 'TBA'
               	 	else Users.first_name
                End as 'first_name'
                ,
                CASE
                	when Users.last_name is null then ''
               	 	else Users.last_name
                End as 'last_name',

                Room.Room_ID,
                MSFALL2021.Total_Seats,
                Semester.Semester_Name,
                Day.Day_ID,
                Period.Start_Time,
                Period.End_Time,
                Class.Timeslot_ID

            FROM Class
            left join MSFALL2021 on MSFALL2021.CRN = Class.CRN
            left join Courses on Class.Course_ID = Courses.Course_ID
            left join Users on Users.first_name = MSFALL2021.Professor_First_Name
            left join Room on Room.Room_ID = Class.Room_ID
            left join Semester on Semester.Semester_ID = Class.Semester_ID
            left join Time_slot on Time_slot.Timeslot_ID = Class.Timeslot_ID
            left join Day on Time_slot.Day_ID = Day.Day_ID
            left join Period on Time_slot.Period_ID = Period.Period_ID
            WHERE User_ID = '{$_SESSION['Faculty_ID']}'
            ORDER BY CRN ";
            
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='view_roster.php' crn=".$row["CRN"].">".$row["CRN"]. "</a></td><td>" . $row["Course_Name"]."</td><td> ". $row["Room_ID"]. "</td><td>". $row["Day_ID"]. "</td><td>". $row["Start_Time"]. "</td><td>". $row["End_Time"]. "</td><td><a href='view_form.php' crn=".$row["CRN"]." class='w3-button w3-hover-brown'>View</a></td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function viewfacultySec($faculty){
    $conn = connectToHost();
    $sql = "SELECT
                Class.CRN,
                Courses.Course_Name,
                CASE
                	when Users.first_name is null then 'TBA'
               	 	else Users.first_name
                End as 'first_name'
                ,
                CASE
                	when Users.last_name is null then ''
               	 	else Users.last_name
                End as 'last_name',

                Room.Room_ID,
                MSFALL2021.Total_Seats,
                Semester.Semester_Name,
                Day.Day_ID,
                Period.Start_Time,
                Period.End_Time,
                Class.Timeslot_ID

            FROM Class
            left join MSFALL2021 on MSFALL2021.CRN = Class.CRN
            left join Courses on Class.Course_ID = Courses.Course_ID
            left join Users on Users.first_name = MSFALL2021.Professor_First_Name
            left join Room on Room.Room_ID = Class.Room_ID
            left join Semester on Semester.Semester_ID = Class.Semester_ID
            left join Time_slot on Time_slot.Timeslot_ID = Class.Timeslot_ID
            left join Day on Time_slot.Day_ID = Day.Day_ID
            left join Period on Time_slot.Period_ID = Period.Period_ID
            WHERE User_ID = '{$_SESSION['Faculty_ID']}'
            ORDER BY CRN ";
            
    $result = runSQL($conn, $sql);
    if ($result->num_rows >= 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='view_roster_grades.php' crn=".$row["CRN"].">".$row["CRN"]. "</a></td><td>" . $row["Course_Name"]."</td><td> ". $row["Room_ID"]. "</td><td>". $row["Day_ID"]. "</td><td>". $row["Start_Time"]. "</td><td>". $row["End_Time"]. "</td><td><a href='view_form.php' crn=".$row["CRN"]." class='w3-button w3-hover-brown'>View</a></td></tr>";
        }
    } else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function updateAttendance($student, $crn, $date, $attendance){
    $conn = connectToHost();

    $sql = "INSERT INTO Attendance (Attendance.Student_ID, Attendance.CRN, Attendance.Date, Attendance.Attendance) 
    VALUES ('$student', '$crn', '$date', '$attendance') 
    on duplicate key UPDATE Attendance = '$attendance'  ";

    if(runSQL($conn, $sql)){
        echo "Attendance Updated for $date";

    }else{
        echo "Failed:". mysqli_error($conn);
    }
    $conn->close();
}

function adminSchedule(){
    echo '<div class="w3-container">
            <h2>Courses</h2>
            <p>Search for a course in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="CRN" id="myInput" onkeyup="filter_table()">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Course Name" id="myInput1" onkeyup="filtert(1,1)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Instructor" id="myInput2" onkeyup="filtert(2,2)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Location" id="myInput3" onkeyup="filtert(3,3)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Capacity" id="myInput4" onkeyup="filtert(4,4)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Semester" id="myInput5" onkeyup="filtert(5,5)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Day" id="myInput6" onkeyup="filtert(6,6)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Start time" id="myInput7" onkeyup="filtert(7,7)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="End Time" id="myInput8" onkeyup="filtert(8,8)">
            <table class="w3-table-all w3-margin-top w3-text-black" id="myTable">
                <tr>
                    <th style="width:10%;">CRN</th>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Instructor</th>
                    <th style="width:10%;">Location</th>
                    <th style="width:10%;">Capacity</th>
                    <th style="width:10%;">Semester</th>
                    <th style="width:10%;">Day</th>
                    <th style="width:10%;">Start Time</th>
                    <th style="width:10%;">End Time</th>
                </tr>';
    viewAdminSections();
    echo "</table></div>";

}

function masterSchedule(){
    echo '<div class="w3-container">
            <h2>Master Schedule</h2>
            <p>Search for a Class Section in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="CRN" id="myInput" onkeyup="filter_table()">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Course Name" id="myInput1" onkeyup="filtert(1,1)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Instructor" id="myInput2" onkeyup="filtert(2,2)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Location" id="myInput3" onkeyup="filtert(3,3)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Capacity" id="myInput4" onkeyup="filtert(4,4)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Semester" id="myInput5" onkeyup="filtert(5,5)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Day" id="myInput6" onkeyup="filtert(6,6)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="Start time" id="myInput7" onkeyup="filtert(7,7)">
            <input class="w3-input w3-border w3-padding" type="text" placeholder="End Time" id="myInput8" onkeyup="filtert(8,8)">
            <table class="w3-table-all w3-margin-top w3-text-black" id="myTable">
                <tr>
                    <th style="width:10%;">CRN</th>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Instructor</th>
                    <th style="width:10%;">Location</th>
                    <th style="width:10%;">Capacity</th>
                    <th style="width:10%;">Semester</th>
                    <th style="width:10%;">Day</th>
                    <th style="width:10%;">Start Time</th>
                    <th style="width:10%;">End Time</th>
                </tr>';
    viewSections();
    echo "</table></div>";

}

function    makeSection(){
    echo "<div class='w3-panel'>";
    echo "<form class='w3-container' action = 'confirm_section.php' method = 'post'>
            <label class='w3-label w3-text-black w3-text-center'>Room Type:</label>
            <select class='w3-select w3-border w3-center' name='room' required>";
            getAllRooms();
    echo  " </select>
            <label class='w3-label w3-text-black w3-text-center'>Semester:</label>
            <select class='w3-select w3-border w3-center' name='semester' required>";
            getAllSemesters();
    echo  " </select>
            <label class='w3-label w3-text-black w3-text-center'>Time Slot:</label>
            <select class='w3-select w3-border w3-center' name='timeslot' required>";
            getAllTimeslots();
    echo  " </select>
            <input value='".$_GET['crsid']."' name='course' type='hidden'>
            <div>
                <button class='w3-btn w3-brown w3-center' onclick ='return confirmAcion();'>Create</button>
                <a class='w3-btn w3-brown w3-center' href='admin_home.php'>cancel</a>
            </div>
          </form>";
    echo "</div>";
}

function getAllRooms($crsid = null){
    $conn = connectToHost();
    $sql = "select Room.Room_ID, Room.Room_Type, Building.Building_Name from Room inner join Building on Room.Building_ID = Building.Building_ID";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id != null && $id = $row["Room_ID"]){
                echo "<option value='".$row["Room_ID"]."' selected>".$row["Building_Name"]." ".$row["Room_Type"]."</option>";
            }else{
                echo "<option value='".$row["Room_ID"]."'>".$row["Building_Name"]." ".$row["Room_Type"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllBuildings($id = null){
    $conn = connectToHost();
    $sql = "select * from Building";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id != null && $id == $row["Building_ID"] ){
                echo "<option value='".$row["Building_ID"]."' selected>".$row["Building_Name"]."</option>";
            }else{
                echo "<option value='".$row["Building_ID"]."'>".$row["Building_Name"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
	}

function getAllSemesters($crsid = null){
    $conn = connectToHost();
    $sql = "select Semester_ID, Semester_Name, Semester_Year from Semester";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id == $row["Semester_ID"] && $id != null){
                echo "<option value='".$row["Semester_ID"]."' selected>".$row["Semester_Name"].$row["Semester_Year"]." </option>";
            }else{
                echo "<option value='".$row["Semester_ID"]."'>".$row["Semester_Name"].$row["Semester_Year"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllTimeSlots($crsid = null){
    $conn = connectToHost();
    $sql = "select Time_slot.Timeslot_ID, Day.Day_ID, Period.Start_Time, Period.End_Time  from Time_slot inner join Day on Time_slot.Day_ID = Day.Day_ID
            inner join Period on Time_slot.Period_ID = Period.Period_ID";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            if($id != null && $crsid == $row["Timeslot_ID"]){
                echo "<option value='".$row["Timeslot_ID"]."' selected>".$row["Day"]." ".$row["Start_Time"]." - ".$row["End_Time"]."</option>";
            }else{
                echo "<option value='".$row["Timeslot_ID"]."'>".$row["Day"]." ".$row["Start_Time"]." - ".$row["End_Time"]."</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllCourses(){
    $conn = connectToHost();
    $sql = "SELECT Course_ID, Course_Name FROM Courses";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["Course_ID"]."'>".$row["Course_Name"]."</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}


//---------------------- JEFF FUNCTIONS ---------------------

function getAllDepartments(){
    $conn = connectToHost();
    $sql = "SELECT Dept_ID, Dept_Name from Department";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["Dept_ID"]."'>".$row["Dept_Name"]."</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFaculty(){
    $conn = connectToHost();
    $sql  = "SELECT Faculty_ID, CONCAT(last_name, ', ', first_name) AS full_name ";
    $sql .= "FROM Faculty INNER JOIN Users ON Faculty_ID = User_ID ";
    $sql .= "ORDER BY full_name";
    $result = runSQL($conn,$sql);


    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["Faculty_ID"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultySelect($chair_id){
    $conn = connectToHost();
    $sql  = "SELECT Faculty_ID, first_name, last_name ";
    $sql .= "FROM Faculty INNER JOIN Users ON Faculty_ID = User_ID ";
    $sql .= "ORDER BY last_name, first_name";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            if($row["faculty_id"] == (int)$chair_id){
                echo "<option value='" .$row["Faculty_ID"]. "' selected>" .$row["last_name"]. ", " .$row["first_name"]. "</option>";
            } else {
                echo "<option value='" .$row["Faculty_ID"]. "'>" .$row["last_name"]. ", " .$row["first_name"]. "</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyMemb($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT fd.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name
             FROM faculty_department fd
             INNER JOIN faculty f ON fd.faculty_id = f.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.dept_id = $dept_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["Faculty_ID"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyMembTable($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT Faculty_ID, CONCAT(Users.first_name, ' ', Users.last_name) AS full_name, Users.User_ID
             FROM Faculty
             INNER JOIN Users ON Faculty.Faculty_ID = Users.User_ID

             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["User_ID"]."</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}

function departmentReport(){
    $conn = connectToHost();

    $sql  = "Select DISTINCT case when department.dept_name is null then 'UnDeclared' else department.dept_name end as 'Department',count(student.student_id) as 'Students', count(student.student_id)/(select count(*) from student)* 100 as 'percent'

from student
           left join student_major on student.student_id = student_major.student_id
           left join major on major.major_id = student_major.major_id
           left join department on major.dept_id = department.dept_id

GROUP BY department.dept_id";

    $result = runSQL($conn,$sql);
    echo "
    <table>
    <thead>
            <tr class='w3-light-grey'>
                                    <th>Department</th>
                                    <th>Number Of Students</th>
                                    <th>Percent</th>
                                </tr>
                                </thead>";
    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["Department"]. "</td><td>" .$row["Students"]. "</td><td>" .$row["percent"]. "%</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }
    echo "</table>";
    $conn->close();
}

function sectionReport(){
    $conn = connectToHost();

    $sql  = "select
	course.course_id,
	course.course_name,
	count(section.crn) as 'sections',
	count(section.crn)/ (select count(section.crn) from section) * 100+'%'  as 'percent'
from course
	LEFT join section on section.course_id = course.course_id
group by course.course_id";

    $result = runSQL($conn,$sql);
    echo "
    <table>
    <thead>
            <tr class='w3-light-grey'>
                                    <th>Course ID</th>
                                    <th>Course</th>
                                    <th>Number Of Sections</th>
                                    <th>Percentage</th>
                                </tr>
                                </thead>";
    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["course_id"]. "</td><td>" .$row["course_name"]. "</td><td>" .$row["sections"]. "</td><td>" .$row["percent"]. "%</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }
    echo "</table>";
    $conn->close();
}




function getAllFacultyMembCheckbox($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT f.faculty_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, u.tel_num, u.email
             FROM faculty f
             INNER JOIN faculty_department fd ON fd.faculty_id = f.faculty_id
             INNER JOIN user u ON f.faculty_id = u.user_id
             WHERE fd.dept_id = $dept_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='checkbox' name='memberlist[]' value=" .$row["faculty_id"]. "></td><td>" .$row["full_name"]. "</td><td>" .$row["tel_num"]. "</td><td>" .$row["email"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyNotMemb(){
    $conn = connectToHost();

    $sql  = "SELECT first_name, last_name FROM Users WHERE User_Type = 'Faculty';";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["first_name"]. " , " .$row["last_name"]. "'>" .$row["last_name"]. " </option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllFacultyNotMembCheckbox(){
    $conn = connectToHost();

    $sql  = "SELECT Faculty.Faculty_ID, CONCAT(Users.first_name, ' ', Users.last_name) AS full_name
             FROM Faculty 
             LEFT JOIN Faculty_Dept ON Faculty.Faculty_ID = Faculty_Dept.Faculty_ID
             INNER JOIN Users ON Faculty.Faculty_ID = Users.User_ID
             WHERE Faculty_Dept.Faculty_ID;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='checkbox' name='memberlist[]' value=" .$row["Faculty_ID"]. "></td><td>" .$row["full_name"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllStudentsSelect(){
    $conn = connectToHost();

    $sql  = "SELECT s.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, s.student_type
             FROM student s
             INNER JOIN user u ON s.student_id = u.user_id
             ORDER BY full_name;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["student_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllCurrentAdvisorsSelect(){
    $conn = connectToHost();
    $sql  = "SELECT DISTINCT sa.facutly_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name ";
    $sql .= "FROM user u  ";
    $sql .= "INNER JOIN student_advisor sa on u.user_id = sa.faculty_id";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["faculty_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllStudWithAdvSelect($dept_id){
    $conn = connectToHost();

    $sql  = "SELECT s.student_id, CONCAT(u.last_name, ', ', u.first_name) AS full_name, s.student_type
             FROM student s
             INNER JOIN student_advisor sa on s.student_id = sa.student_id
             INNER JOIN user u ON s.student_id = u.user_id
             ORDER BY full_name";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["student_id"]. "'>" .$row["full_name"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllStuNoAdvisorCheckbox(){
    $conn = connectToHost(); 

    $sql  = "SELECT s.Student_ID, CONCAT(u.last_name, ', ', u.first_name) AS full_name, s.STUDENT_TYPE
             FROM Student s
             LEFT JOIN Advisor sa ON s.Student_ID = sa.Student_ID
             INNER JOIN Users u ON s.Student_ID = u.User_ID
             WHERE sa.Student_ID IS NULL;";

    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='checkbox' name='studentlist[]' value=" .$row["Student_ID"]. "></td><td>" .$row["full_name"]. "</td><td>" .$row["STUDENT_TYPE"]. "</td><td>" .$row["Student_ID"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}
function getStuByAdvisorTable($fac_id){
    $conn = connectToHost();

   // $sql  = "SELECT sa.Student_ID, CONCAT(u.last_name, ', ', u.first_name) AS full_name
   //           FROM Advisor sa
   //           INNER JOIN Users u ON sa.Student_ID = u.User_ID
   //           WHERE sa.Faculty_ID = $fac_id
   //           ORDER BY full_name ;";

   $sql = "SELECT Advisor.Student_ID, CONCAT(Users.first_name, ' ', Users.last_name) AS full_name
                    FROM Advisor
                    INNER JOIN Users ON Users.User_ID = Advisor.Student_ID
                    WHERE Advisor.Faculty_ID 
                     ORDER BY full_name ;";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["Student_ID"]. "</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}
function getAdviseeListTable($fac_id){
    $conn = connectToHost();

    $sql  = "SELECT Advisor.Student_ID, CONCAT(Users.first_name, ' ', Users.last_name) AS full_name
             FROM Advisor
             INNER JOIN Users ON Advisor.Student_ID = Users.User_ID
             WHERE Advisor.Faculty_ID = '$fac_id'
             ORDER BY full_name  ";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><a href='account_info.php' account=".$row["Student_ID"].">" .$row["full_name"]. "</td><td>" .$row["Student_ID"]. "</td></tr>";
        }
    }else{
        echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
    }

    $conn->close();
}

function getAdvisorByStuTable($stu_id){
    $conn = connectToHost();

    $sql  = "SELECT Advisor.Faculty_ID, CONCAT(Users.last_name, ', ', Users.first_name) AS full_name
             FROM Advisor
             INNER JOIN Users ON Advisor.Faculty_ID = Users.User_ID
             WHERE Advisor.Student_ID; ";

    $result = runSQL($conn,$sql);

    if(!$result) {
        echo "Failed:". mysqli_error($conn);
    } else {
        if (mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" .$row["full_name"]. "</td></tr>";
            }
        } else {
            echo "<tr><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td><td>&lt;Unassigned&gt;</td></tr>";
        }
    }
/*
    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" .$row["full_name"]. "</td><td>" .$row["student_id"]. "</td></tr>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
*/

    $conn->close();
}

function getAllSchools(){
    $conn = connectToHost();
    $sql  = "SELECT Dept_ID FROM Department";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        echo "<option disabled selected value> -- select an option -- </option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["Dept_ID"]. "'>" .$row["Dept_ID"]. "</option>";
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getAllSchoolsSelect($school_id){
    $conn = connectToHost();
    $sql  = "SELECT school_id, school_name ";
    $sql .= "FROM school ";
    $sql .= "ORDER BY school_name";
    $result = runSQL($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            if($row["school_id"] == (int)$school_id){
                echo "<option value='" .$row["school_id"]. "' selected>" .$row["school_name"]. "</option>";
            } else {
                echo "<option value='" .$row["school_id"]. "'>" .$row["school_name"]. "</option>";
            }
        }
    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function getFLnameByID($id){

    $conn = connectToHost();
    $sql  = "SELECT first_name, last_name
             FROM user
             WHERE user_id = $id;";

    $result = runSQL($conn,$sql);

     if(mysqli_num_rows($result) > 0){

         $row = $result->fetch_assoc();
         $flName = $row['first_name']. " " .$row['last_name'];

         return $flName;

    }else{
        echo "Failed:". mysqli_error($conn);
    }

    $conn->close();
}

function insertMember($myF_id, $myD_id) {

    $conn = connectToHost();

	$sql  = "INSERT into faculty_department (faculty_id, dept_id) ";
	$sql .= "VALUES ($myF_id, $myD_id);";

	$result = mysqli_query($conn, $sql);

	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
}

function insertMemberArray($sqltext) {

    $conn = connectToHost();

	$sql  = "INSERT into Faculty_Dept(Faculty_ID, Dept_ID) ";
	$sql .= "VALUES " .$sqltext. ";";

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function deleteMember($myF_id, $myD_id) {

    $conn = connectToHost();

	$sql  = "DELETE FROM faculty_department ";
	$sql .= "WHERE faculty_id = $myF_id
             AND dept_id = $myD_id";

	$result = mysqli_query($conn, $sql);

	if ($result)
	{
		return '';
	} else {
		return 'NotDeleted';
	}
}

function deleteMemberArray($sqltext) {

    $conn = connectToHost();

	$sql  = "DELETE FROM faculty_department ";
	$sql .= "WHERE faculty_id IN (" .$sqltext. ");";

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function insertStuAdvArray($sqltext) {

    $conn = connectToHost();

	$sql  = "INSERT INTO Advisor (Faculty_ID, Student_ID) ";
	$sql .= "VALUES " .$sqltext. ";";

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='30'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function isAssignedAdvisor($stu_id) {

    $conn = connectToHost();

    $sql  = "SELECT Advisor.Faculty_ID, CONCAT(Users.last_name, ', ', Users.first_name) AS full_name, Users.tel_num, Users.Email
             FROM Advisor 
             INNER JOIN Users ON Users.Faculty_ID = Users.User_ID
             WHERE Advisor.Student_ID = $stu_id;";

    $result = runSQL($conn,$sql);
    $isAssigned = False;

    if(!$result) {
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result)>0) {
        $isAssigned = True;
    }

    $conn->close();
    return $isAssigned;
}

function insertStuAdv($fac_id,$stu_id,$isAssigned) {

    $conn = connectToHost();

    if($isAssigned){
        $sql  = "UPDATE Advisor SET Faculty_ID=$fac_id WHERE Student_ID=$stu_id;";
    } else {
        $sql  = "INSERT into Advisor (Faculty_ID, Student_ID) VALUES ($fac_id,$stu_id);";
    }

	$result = mysqli_query($conn, $sql);
    echo "<meta http-equiv='refresh' content='0'>";
/*	if ($result)
	{
		return '';
	} else {
		return 'NotAdded';
	}
*/
    if (!$result){
        return "Failed:". mysqli_error($conn);
    } else {
        return '';
    }
}

function redirectPageCountDown(){
    echo "
    <script type=\"text/javascript\">
            (function () {
                var timeLeft = 3,
                    cinterval;

                var timeDec = function (){
                    timeLeft--;
                    document.getElementById('countdown').innerHTML = timeLeft;
                    if(timeLeft === 0){
                        clearInterval(cinterval);
                    }
                };

                cinterval = setInterval(timeDec, 1000);
            })();

        </script>
        <br><p><b>Redirecting in <span id=\"countdown\">3</span></b></p>";
}
?>