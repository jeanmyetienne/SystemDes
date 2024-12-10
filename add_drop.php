<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
//     header("Location: ../index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }


$sem_id = $_SESSION['Semester_ID'];

$stu_id = $_SESSION['Student_ID'];

$conn = mysqlConnect();
$sqlGetCredits = "SELECT sum(Courses.Course_Credit)
                  FROM Enrollment
                  INNER JOIN Class ON Enrollment.CRN = Class.CRN
                  INNER JOIN Courses on Class.Course_ID = Courses.Course_ID
                  WHERE Class.Semester_ID = '{$_SESSION['Semester_ID']}' AND Enrollment.Student_ID = '{$_SESSION['User_ID']}' ";

if ($result = mysqli_query($conn, $sqlGetCredits)) {
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
           $total_credits = $row[0];
        }
   }
}
else {
	echo "Failed " . mysqli_error($conn);
}

$sql = "SELECT Enrollment.Student_ID, Enrollment.CRN, Semester.Registration_Date, Courses.Major,
            Courses.Course_Name, Courses.Course_Credit, CONCAT(Building.Building_Name,' ',Room.Room_ID),
            Day.Day_ID, CONCAT(Period.Start_Time,'-',Period.End_Time),
            CONCAT(MONTH(Semester.Start_Date),'/',Day(Semester.Start_Date), '-', MONTH(Semester.End_Date),'/',Day(Semester.End_date)),
            Semester.Semester_Name, IFNULL(CONCAT(Users.first_name, ' ' , Users.last_name), 'N/A') FROM Enrollment
            INNER JOIN Class ON Enrollment.CRN = Class.CRN
            INNER JOIN Room ON Class.Room_ID = Room.Room_ID
            INNER JOIN Building ON Room.Building_ID = Building.Building_ID
            INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID
            INNER JOIN Time_slot ON Class.Timeslot_ID = Time_slot.Timeslot_ID
            INNER JOIN Day ON Time_slot.Day_ID = Day.Day_ID
            INNER JOIN Period ON Time_slot.Period_ID = Period.Period_ID
            INNER JOIN Semester ON Class.Semester_ID = Semester.semester_ID
            LEFT OUTER JOIN MSFALL2021 ON Class.CRN = MSFALL2021.CRN
            LEFT OUTER JOIN Users ON MSFALL2021.Professor_Last_Name = Users.User_ID
            WHERE Enrollment.Student_ID = '{$_SESSION['User_ID']}' AND Class.Semester_ID = '{$_SESSION['Semester_ID']}' ";
$schedule= "";
if ($result = mysqli_query($conn, $sql)) {
    		if (!mysqli_num_rows($result) == 0) {
				$resultTable = "<div class='w3-container'>
                               <table class='w3-table w3-bordered'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-teal'>
                                    <th> Select </th>
                                    <th> CRN </th>
                                    <th> Subject </th>
                                    <th> Course </th>
                                    <th> Credits </th>
                                    <th> Semester </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {


					$resultTable.= "<tr>
					            <td><button class='w3-btn w3-ripple w3-brown w3-round w3-padding-small' type = 'submit' name = 'drop_course' value = $row[1]>Drop</button></td>
                                <td>$row[1]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[10]</td>
                                </tr>";
				}
				$resultTable.= "</table>
                                </form></div>";
				//echo ($resultTable);

		}
        else {
            $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <p> <b>No currently registered classes<b> </p>
                                        </div>";
        }
}
else {
    echo "failed " . mysqli_error($conn);
}

if (isset($_POST['drop_course'])) {
	$crn = $_POST['drop_course'];
	$conn = mysqlConnect();
	$sql = "DELETE FROM Enrollment WHERE Student_ID = '{$_SESSION['User_ID']}' AND CRN = '$crn' ";
	if ($result = mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                				<h3>Success</h3>
               					<p>CRN $crn dropped</p>
            					</div> <br>";
		header('location: add_drop.php');
		exit();
	}
	else {
		echo "failed " . mysqli_error($conn);
	}
}
mysqli_close($conn);

htmlheader_root('w3-white')
?>

    <h3 class = "w3-text-black"> <?php echo isset($_SESSION['Semester_ID']) ? $_SESSION['Semester_ID'] : ''?> </h3>
    <h3 class = "w3-text-black"> <?php echo isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : ''?> </h3>
    <h2 class="w3-text-dark-grey w3-padding-16 w3-container">Drop Classes</h2>

    <div class='w3-container w3-card-4 w3-brown' style='max-width:1000px'>
          <p> <strong> Total Credits: <?php echo isset($total_credits) ? $total_credits: ' '?></strong> </p>
          <p> <strong> Maximum Credits: 18 </strong> </p>
        </div>
        <br>

  <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

  <?php echo isset($resultTable) ? $resultTable: ''?>


<?php
htmlfooter();
unset($_SESSION['message']);
?>
