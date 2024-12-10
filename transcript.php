<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();
//
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "S") {
//         header("Location: ../index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

/*Getting Semesters for Student*/
$semesters = array();
$sql = "SELECT DISTINCT(Semester.Semester_Name), Student_History.Semester_ID
 FROM Student_History
 INNER JOIN Semester ON Student_History.Semester_ID = Semester.Semester_ID
 WHERE Student_History.Student_ID = " . $_SESSION['User_ID'] .
 " ORDER BY Student_History.Semester_ID";

 $conn = mysqlConnect();

if ($result = mysqli_query($conn, $sql)) {
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
           $semesters[] = $row[0];
        }
   }
}
else {
	echo "Failed " . mysqli_error($conn);
}

$transcript = "";
$cumulativeEarnedCredits = 0;
$cumulativeTotalCredits = 0;
$cumulativeTotalPoints = 0;
$cumulativeGpa = 0;

if (sizeof($semesters) > 0) {
foreach ($semesters as $semester) {
    $sql =  " SELECT Student_History.CRN, Courses.Course_Name, Student_History.Semester_ID, Semester.Semester_Name, Student_History.Grade, Courses.Course_credit,
              CASE Student_History.Grade
              WHEN 'A'  THEN 4.00 * Courses.Course_credit
              WHEN 'A-' THEN 3.70 * Courses.Course_credit
              WHEN 'B+' THEN 3.30 * Courses.Course_credit
              WHEN 'B'  THEN 3.00 * Courses.Course_credit
              WHEN 'B-' THEN 2.70 * Courses.Course_credit
              WHEN 'C+' THEN 2.30 * Courses.Course_credit
              WHEN 'C'  THEN 2.00 * Courses.Course_credit
              WHEN 'C-' THEN 1.70 * Courses.Course_credit
              WHEN 'D+' THEN 1.30 * Courses.Course_credit
              WHEN 'D'  THEN 1.00 * Courses.Course_credit
              WHEN 'D-' THEN 0.70 * Courses.Course_credit
              WHEN 'F'  THEN 0.00 * Courses.Course_credit
              END AS quality_point
              FROM Student_History
              INNER JOIN Class ON Student_History.CRN = Class.CRN
              INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID
              INNER JOIN Semester ON Student_History.Semester_ID = Semester.Semester_ID
              WHERE Semester.Semester_Name = '$semester'
              AND Student_History.Student_ID = " . $_SESSION['User_ID'];

   if ($result = mysqli_query($conn, $sql)) {
    if (!mysqli_num_rows($result) == 0) {
       $transcript .= "<div class='w3-container w3-responsive'>
            <h4 w3-opacity class='w3-brown w3-padding-small'><b>$semester</b></h4>
            <div class='w3-col l2 s3 '>
                <h5 class='w3-khaki'><b> </b></h5>
            </div>
            <div class='w3-col l2 s3 '>
                <h5 class='w3-khaki'><b>Course</b></h5>
            </div>
            <div class='w3-col l2 s3 '>
                <h5 class='w3-khaki'><b>Grades</b></h5>
            </div>
            <div class='w3-col l2 s3 '>
                <h5 class='w3-khaki'><b>Credits</b></h5>
            </div>
            <div class='w3-col l2 s3 '>
                <h5 class='w3-khaki'><b>Points</b></h5>
            </div>";

          $termEarnedCredits = 0;
          $termTotalCredits = 0;
          $termTotalPoints = 0;

        while ($row = mysqli_fetch_array($result)) {
            if ($row[4] !== 'F') {
              $termEarnedCredits+= $row[5];
            }
            $termTotalCredits += $row[5];
            $termTotalPoints += $row[6];

            $transcript .= "<div class='w3-row'>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[7]</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[1]</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[4]</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[5].00</p>
                </div>
                <div class='w3-col l2 s3 w3-left'>
                    <p class='w3-text-dark-grey'>$row[6]</p>
                </div>
            </div>";
        }
        /***Term Calculation ***/
        $termGpa = number_format($termTotalPoints/$termTotalCredits, 2, '.', '');
        /***Cumulative Calculation ***/
        $cumulativeEarnedCredits += $termEarnedCredits;
        $cumulativeTotalCredits += $termTotalCredits;
        $cumulativeTotalPoints += $termTotalPoints;
        $cumulativeGpa = number_format($cumulativeTotalPoints/$cumulativeTotalCredits, 2, '.', '');

        $transcript .= "<div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-khaki'><b>GPA</b></h5>
                      </div>
                      <div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-khaki'><b>Points</b></h5>
                      </div>
                      <div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-khaki'><b>Earned Hours</b></h5>
                      </div>
                      <div class='w3-col l1 s4 w3-right w3-margin-top'>
                        <h5 class='w3-khaki'><b>Attempted Credits</b></h5>
                      </div>

                    <div class='w3-row'>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termGpa</p>
                        </div>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termTotalPoints</p>
                        </div>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termEarnedCredits</p>
                        </div>
                        <div class='w3-col l1 s4 w3-right'>
                            <p class='w3-text-dark-grey'>$termTotalCredits</p>
                        </div>
                        <div class='w3-col l2 s4 w3-right'>
                            <h5 class='w3-text-dark-grey'><b>Term:</b></h5>
                        </div>
                  </div>

                    <div class='w3-row'>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeGpa</p>
                      </div>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeTotalPoints</p>
                      </div>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeEarnedCredits</p>
                      </div>
                      <div class='w3-col l1 s4 w3-right'>
                          <p class='w3-text-dark-grey'>$cumulativeTotalCredits</p>
                      </div>
                      <div class='w3-col l2 s4 w3-right'>
                          <h5 class='w3-text-dark-grey'><b>Cumulative:</b></h5>
                      </div>
                </div>
              </div>";
   }
}
  else {
    echo "Failed " . mysqli_error($conn);
  }

}
//mysqli_close($conn);
}
//else {
   // $transcript = "";
//}

/**** For future enrolled semesters ****/
 $sql = "SELECT DISTINCT(Semester.Semester_Name), Class.Semester_ID from Enrollment
 INNER JOIN Class ON Enrollment.CRN = Class.CRN
 INNER JOIN Semester ON Class.Semester_ID = Semester.Semester_ID
 where (Class.Semester_ID  > (SELECT max(Student_History.Semester_ID) FROM Student_History WHERE Student_History.Student_ID =" . $_SESSION['User_ID'] . " ) 
 OR Class.Semester_ID NOT IN (SELECT Student_History.Semester_ID FROM Student_History WHERE Student_History.Student_ID =" . $_SESSION['User_ID'] . "))
 AND Enrollment.Student_ID = " . $_SESSION['User_ID'] .
 " ORDER BY Class.Semester_ID";

     if ($result = mysqli_query($conn, $sql)) {
         $enrolledSemesters = array();
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            $enrolledSemesters[] = $row[0]; 
        }
   }
}
if (sizeof($enrolledSemesters) > 0) {
    foreach($enrolledSemesters as $semester) {
        $sql = "SELECT Enrollment.CRN, Class.Semester_ID, Semester.Semester_Name, Courses.Course_Name, Courses.Course_credit from Enrollment
            INNER JOIN Class ON Enrollment.CRN = Class.CRN
            INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID
            INNER JOIN Semester ON Class.Semester_ID = Semester.Semester_ID
            WHERE Semester.Semester_Name = '$semester'
            AND Enrollment.Student_ID = " . $_SESSION['User_ID'];

            if ($result = mysqli_query($conn, $sql)) {
            $transcript .= "<div class='w3-container w3-responsive'>
                    <h4 w3-opacity class='w3-brown w3-padding-small'><b>$semester</b> (In Progress) </h4>
                    <div class='w3-col l2 s3 w3-left'>
                        <h5 class='w3-khaki'><b>Course</b></h5>
                    </div>
                    <div class='w3-col l2 s3 w3-left'>
                        <h5 class='w3-khaki'><b>Credits</b></h5>
                    </div>
                    
                       ";
                while ($row = mysqli_fetch_array($result)) {
                    $transcript .= "<div class='w3-row'>
                        <div class='w3-col l2 s3 w3-left'>
                            <p class='w3-text-dark-grey'>$row[3]</p>
                        </div>
                        <div class='w3-col l2 s3 w3-left'>
                            <p class='w3-text-dark-grey'>$row[4]</p>
                        </div>
                        <div class='w3-col l2 s3 w3-left'>
                            <p class='w3-text-dark-grey'>$row[5]</p>
                        </div>
                    </div>";  
             }
             $transcript .= "</div>";
        }
        else {
            echo "Failed " . mysqli_error($conn);
        }
    }
}

if ($transcript == "") {
    $transcript = "<div class='w3-container w3-pale-red'>
                    <p> <b>There is no transcript under your record</b> </p>
                    </div>";
}


htmlheader_root('w3-white');
?>

<br>

<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

<!--<div class = 'transcript' style = 'overflow-x:scroll;'></div>-->
<?php echo isset($transcript) ? $transcript : '' ?>


<?php
htmlfooter();

unset($_SESSION['message']);
?>