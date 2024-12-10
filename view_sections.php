<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();
ob_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
//     header("Location: ../index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

htmlheader_root('w3-white');
$_SESSION['Course_ID'] = $_POST['Course_ID'];
$userid = $_SESSION['User_ID'];
$dept_id = $_SESSION['dept_id'];
$semester_id = $_SESSION['Semester_ID'];
$course_id = $_SESSION['Course_ID'];

$conn = mysqlConnect();

if(isset($_SESSION['Dept_ID'])) {
$sql = "SELECT Dept_ID, Dept_Name FROM Department WHERE Dept_ID = '$dept_id' ";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments = $row[0];

    }
}
else {
    echo "failed " . mysqli_error($conn);
  }
}

if (isset($_POST['submit_all'])) {
    $_SESSION['sql'] = "SELECT Class.CRN, Courses.Course_Name, Courses.Course_Credit, CONCAT(Building.Building_Name,' ',Room.Room_ID),
            Day.Day_ID, CONCAT(Period.Start_Time,'-',Period.End_Time), 
            CONCAT(MONTH(Semester.Start_Date),'/',DAY(Semester.Start_Date), '-', MONTH(Semester.End_Date),'/',DAY(Semester.End_Date)),
            Semester.Semester_Name, Department.Dept_Name, Class.Course_ID, Time_slot.Timeslot_ID, Enrollment.CRN, IFNULL(CONCAT(MAX(Users.first_name), ' ' , MAX(Users.last_name)), 'N/A'),
            Courses.Major, MSFALL2021.Total_Seats, COUNT(e2.CRN) as enrolled, (MSFALL2021.Total_Seats - COUNT(e2.CRN)) as remaining
            FROM Class
            INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID
            INNER JOIN Department ON Courses.Dept_ID = Department.Dept_ID
            INNER JOIN Room ON Class.Room_ID = Room.Room_ID
            INNER JOIN Building ON Room.Building_ID = Building.Building_ID
            INNER JOIN Time_slot ON Class.Timeslot_ID = Time_slot.Timeslot_ID
            INNER JOIN Day ON Time_slot.Day_ID = Day.Day_ID
            INNER JOIN Period ON Time_slot.Period_ID = Period.Period_ID
            INNER JOIN Semester ON Class.Semester_ID = Semester.Semester_ID
            LEFT OUTER JOIN MSFALL2021 ON Class.CRN = MSFALL2021.CRN
            LEFT OUTER JOIN Users ON MSFALL2021.Professor_Last_Name = Users.last_name
            LEFT OUTER JOIN Enrollment ON Class.CRN = Enrollment.CRN AND Enrollment.Student_ID = '{$_SESSION['User_ID']}'
            LEFT OUTER JOIN Enrollment e2 ON Class.CRN = e2.CRN
            WHERE Department.Dept_ID = '{$_SESSION['dept_id']}' AND Class.Semester_ID = '{$_SESSION['semester_id']}'
            GROUP BY Class.CRN";
}

else if (isset($_POST['submit'])) {
       $_SESSION['sql'] = "SELECT Class.CRN, Courses.Course_Name, Courses.Course_Credit, CONCAT(Building.Building_Name,' ',Room.Room_ID),
            Day.Day_ID, CONCAT(Period.Start_Time,'-',Period.End_Time), 
            CONCAT(MONTH(Semester.Start_Date),'/',DAY(Semester.Start_Date), '-', MONTH(Semester.End_Date),'/',DAY(Semester.End_Date)),
            Semester.Semester_Name, Department.Dept_Name, Class.Course_ID, Time_slot.Timeslot_ID, Enrollment.CRN, IFNULL(CONCAT(MAX(Users.first_name), ' ' , MAX(Users.last_name)), 'N/A'),
            Courses.Major, MSFALL2021.Total_Seats, COUNT(Enrollment.CRN) as enrolled, (MSFALL2021.Total_Seats - COUNT(Enrollment.CRN)) as remaining
            FROM Class
            INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID
            INNER JOIN Department ON Courses.Dept_ID = Department.Dept_ID
            INNER JOIN Room ON Class.Room_ID = Room.Room_ID
            INNER JOIN Building ON Room.Building_ID = Building.Building_ID
            INNER JOIN Time_slot ON Class.Timeslot_ID = Time_slot.Timeslot_ID
            INNER JOIN Day ON Time_slot.Day_ID = Day.Day_ID
            INNER JOIN Period ON Time_slot.Period_ID = Period.Period_ID
            INNER JOIN Semester ON Class.Semester_ID = Semester.Semester_ID
            LEFT OUTER JOIN MSFALL2021 ON Class.CRN = MSFALL2021.CRN
            LEFT OUTER JOIN Users ON MSFALL2021.Professor_Last_Name = Users.last_name
            LEFT OUTER JOIN Enrollment ON Class.CRN = Enrollment.CRN AND Enrollment.Student_ID = '{$_SESSION['User_ID']}'
            WHERE Department.Dept_ID ='{$_SESSION['dept_id']}' AND Class.Semester_ID = '{$_SESSION['semester_id']}' 
            AND Class.Course_ID = '{$_SESSION['Course_ID']}'
            ";
}



$sql = $_SESSION['sql'];
if ($result = mysqli_query($conn, $sql)) {
    		if (!mysqli_num_rows($result) == 0) {
				$resultTable = "<div class='w3-container w3-responsive'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                               <tr class='w3-khaki'>
                                    <th> Select </th>
                                    <th> Subject </th>
                                    <th> Course Title </th>
                                    <th> Credits </th>
                                    <th> Days </th>
                                    <th> Time </th>
                                    <th> Cap </th>
                                    <th> Act </th>
                                    <th> Rem </th>
                                    <th> Instructor </th>
                                    <th> Date </th>
                                    <th> Building & Room </th>
                                    <th> Semester </th>
                                </tr>
                                </thead>
                                ";
				while ($row = mysqli_fetch_array($result)) {

                    //<td><input type = 'checkbox' name = 'checkbox[]' value = $row[0]> <a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
					//$sql2 = "SELECT * from student_major WHERE major_id = $major_id AND student_id = $row[0]";
					//$result2 = mysqli_query($conn, $sql2);


                    if ($row[0] == $row[11]) {
                        $input = "<span class='w3-tag w3-brown w3-round'>Registered</span>";
                    }

                    else if (!$row[0] == $row[11] && $row[16] == 0) {
                        $input = "<span class='w3-tag w3-brown w3-round'>Full</span>";
                    }

                    else {
                        $input = "<input type = 'checkbox' name = 'crn[]' value = $row[0]>";
                    }

					$resultTable.= "<tr>
					            <td>$input</td>
                                <td>$row[13]</td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                <td>$row[14]</td>
                                <td>$row[15]</td>
                                <td>$row[16]</td>
                                <td>$row[12]</td>
                                <td>$row[6]</td>
                                <td>$row[3]</td>
                                <td>$row[7]</td>
                                </tr>";
				}

				$resultTable.= "</table>
                                <input class='w3-btn w3-brown w3-section' type = 'submit' name = 'register' value = 'Register'>
                                </form></div>";
				//echo ($resultTable);	
		}

        else {
            $_SESSION['message'] = "<div class='w3-container w3-khaki'>
                                        <p> <b>No classes were found that meets your search <b> </p>
                                        </div>";
        }
}

else {
    echo "failed " . mysqli_error($conn);
}

mysqli_close($conn);

if (isset($_POST['register']) && isset($_POST['crn'])) {
    $conn = mysqlConnect();

    /*************  Hold Validation  **************/
    $holds = array();
    $sqlCheckHolds = "SELECT Student_Hold.HOLD_ID, HOLD.Hold_Name, Student_Hold.Student_ID FROM Student_Hold 
                    INNER JOIN HOLD ON Student_Hold.HOLD_ID = HOLD.HOLD_ID WHERE Student_ID = '{$_SESSION['User_ID']}' ";

    if ($result = mysqli_query($conn, $sqlCheckHolds)) {
        if (!mysqli_num_rows($result) == 0) {
            while ($row = mysqli_fetch_array($result)) {
                $holds [] = $row[1];
            }

          $holds = implode(', ', $holds);
          $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>
                    <p> <b>You have the following hold/holds against your account:</b> $holds </p>
                    </div>";
          header("location: view_sections.php");
          exit();
        }
    }

    else {

    echo "failed " . mysqli_error($conn);
}

    /*************  Prerequisites Validation  **************/
    $prereqs = array();
    foreach ($_POST['crn'] as $crn) {
            /**$sqlCheckPrereq = "SELECT section.crn, section.course_id, c2.course_name, prerequisites.prereq_id, c1.course_name as prereq_course_name, transcript_test.course_id as transcript_course_id, transcript_test.grade FROM section 
                            INNER JOIN prerequisites ON section.course_id = prerequisites.course_id
                            INNER JOIN course AS c1 ON prerequisites.prereq_id = c1.course_id 
                            INNER JOIN course AS c2 ON section.course_id = c2.course_id 
                            LEFT OUTER JOIN transcript_test ON prerequisites.prereq_id = transcript_test.course_id AND transcript_test.student_id = $userid
                            WHERE section.crn = $crn";**/

               $sqlCheckPrereq = "SELECT Class.CRN, Class.Course_ID, c2.Course_Name, Prerequisites.PRE_ID, 
                                  c1.Course_Name as prereq_course_name, Enrollment.Student_ID, Enrollment.CRN as transcript_crn, s3.Course_ID, Enrollment.Grade FROM Class
                                  INNER JOIN Prerequisites ON Class.Course_ID = Prerequisites.Course_ID
                                  INNER JOIN Courses AS c1 ON Prerequisites.PRE_ID = c1.Course_ID
                                  INNER JOIN Courses AS c2 ON Class.Course_ID = c2.Course_ID
                                  LEFT OUTER JOIN Class as s2 ON Prerequisites.PRE_ID = s2.Course_ID 
                                  LEFT OUTER JOIN Enrollment ON s2.CRN = Enrollment.CRN AND Enrollment.Student_ID = '$user_id'
                                  LEFT OUTER JOIN Class as s3 ON Enrollment.CRN = s3.CRN 
                                  WHERE Class.CRN = '$crn' ";

            if ($result = mysqli_query($conn, $sqlCheckPrereq)) {
                while ($row = mysqli_fetch_array($result)) {
                    if (!$row[3] == $row[7]) {
                    $prereqs[$row[2]][] = $row[4];
                    }
                }
            }
    }

    if (sizeof($prereqs) > 0) {
        //print_r($prereqs[3][0]);
       // print_r($prereqs[3][1]);
       // print_r($prereqs);

        $message = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>";
        foreach($prereqs as $key => $value) {
            $values = array();
            $message.= "<p> <b>Unfulfilled prerequisites for $key: </b> ";
            foreach($value as $key => $value) {
                $values [] = $value;
            }
         $values = implode(', ', $values);
         $message.= "$values </p>";
       }
        $message.= "</div>";
    }

    else {
        $registerCredits = 0;
        $timeslots = array();
        foreach ($_POST['crn'] as $crn) {

                /*************  Timeslot Validation  **************/
               $sqlValidateTimeSlot1 = "SELECT Enrollment.Student_ID, Enrollment.CRN, Class.CRN, Class.Timeslot_ID
                                        FROM Class
                                        INNER JOIN Enrollment ON Class.CRN = Enrollment.CRN
                                        WHERE Enrollment.Student_ID = '$user_id' AND Class.Semester_ID =" . $_SESSION['Semester_ID'];

               $sqlValidateTimeSlot2 = "SELECT Timeslot_ID from Class where Class.CRN = '$crn' AND Class.Semester_ID =" . $_SESSION['Semester_ID'];                         


                if ($result1 = mysqli_query($conn, $sqlValidateTimeSlot1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $result2 = mysqli_query($conn, $sqlValidateTimeSlot2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    //$timeslots[] = $row2[0];
                                    if ($row2[0] == $row1[3]) {
                                        $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <h4>Unable to Register</h4>
                                        <p> <b> Time conflict with current schedule </b> </p>
                                        </div>";
                                        header("location: view_sections.php");
                                        exit();
                                    }
                                }
                     }      

              }

              else {
                   echo "failed " . mysqli_error($conn);
               }
               if ($result = mysqli_query($conn, $sqlValidateTimeSlot2)) {
                   while ($row = mysqli_fetch_array($result)) {
                       $timeslots[] = $row[0];
                   }
               }


                 /*************  Credit Validation  **************/
                $sqlValidateCredits = "SELECT SUM(Course.Course_Credits) as current_credits, 
                                                 (SELECT SUM(Course.Course_Credits) FROM Class
							                     INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID 
                                                 WHERE Class.CRN = '$crn') as course_credits
                                       FROM Enrollment
                                       INNER JOIN Class ON Enrollment.CRN = Class.CRN
                                       INNER JOIN Courses on Class.Course_ID = Courses.Course_ID
                                       WHERE Class.Semester_ID=" . $_SESSION['Semester_ID'] . 
                                       " AND Enrollment.Student_ID = '$user_id' ";      

                    if ($result = mysqli_query($conn, $sqlValidateCredits)) {
                    while ($row = mysqli_fetch_array($result)) {
                    $currentCredits = $row[0];
                    $registerCredits += $row[1];
                }
              }

              else {
                   echo "failed " . mysqli_error($conn);
               }
        }

         if (count(array_unique($timeslots)) < count($timeslots)) {
                $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                                        <h4>Unable to Register</h4>
                                        <p> <b> Please choose unique timeslots for sections </b> </p>
                                        </div>";
                                        header("location: view_sections.php");
                                        exit();
         }

        $totalCredits = $currentCredits + $registerCredits;
        if ($totalCredits > 16) {
            $_SESSION['message'] = "<div class='w3-container w3-pale-red'>
                    <h4>Unable to Register</h4>
                    <p> <b>Maximum credit amount exceeded: </b> </p>
                    <p> Current registered credits: $currentCredits | Max credits allowed: 16 </p>
                    </div>";
          header("location: view_sections.php");
          exit();
        }

            /*************  Registration (if all validations above pass) **************/
            $courses = array();
            $confirmation = "<div class='w3-container w3-pale-green'>
                             <h4>Registration Successful</h4>";
            foreach ($_POST['crn'] as $crn) {
                    $sqlGetCourseName = "SELECT Courses.Course_Name FROM Class
                                         INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID 
                                         WHERE Class.CRN = '$crn' ";

                    if ($result = mysqli_query($conn, $sqlGetCourseName)) {
                        while ($row = mysqli_fetch_array($result)) {
                            $courses[] = $row[0];
                        }
                    } 
                    $sqlRegister = "INSERT INTO Enrollment (Student_ID, CRN, Enroll_Date) VALUES ($userid, $crn, CURRENT_DATE)";
                    if (!mysqli_query($conn, $sqlRegister)) {
                        echo "failed " . mysqli_error($conn);
                        exit();
                    }
            }

            foreach($courses as $course) {
                $confirmation.= "<p> <b> Successfully registered for $course </b> </p> ";
          }
            $confirmation.= "</div>";
            $_SESSION['message'] = $confirmation;
            header("location: view_sections.php");
            exit(); 
 }

 mysqli_close($conn); 
}

else if (isset($_POST['register']) && !isset($_POST['crn'])) {
    $message = "<div class='w3-container w3-red'>
                    <h4>Please select one of the sections to register</h4>
                    </div>";
}


?>

<div class = "w3-container">

    <h2 class = "w3-container w3-text-dark-grey"> <?php echo isset($departments) ? $departments : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_SESSION['semester_id']) ? $_SESSION['semester_id'] : ''?> </h2>
<h2 class = " w3-text-brown"> <?php echo isset($_SESSION['Course_ID']) ? $_SESSION['Course_ID'] : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_SESSION['User_ID']) ? $_SESSION['User_ID'] : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_SESSION['dept_id']) ? $_SESSION['dept_id'] : ''?> </h2>

    <h3 class = "w3-container w3-text-dark-grey"> Register For Classes </h3>

    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

    <?php echo isset($message) ? $message : ''?>

    <br>

    <?php echo isset($resultTable) ? $resultTable : ''?>
    

    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

	</body>
</html>



<?php
htmlfooter();
unset($_SESSION['message']);
?>
