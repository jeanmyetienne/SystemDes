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
//         header("Location: index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

htmlheader_root('w3-white');

$conn = mysqlConnect();
$sql = "SELECT DISTINCT(Enrollment.Semester_ID), Semester.Semester_Name from Enrollment
        INNER JOIN Semester ON Enrollment.Semester_ID = Semester.Semester_ID
        WHERE Enrollment.Student_ID = " . $_SESSION['User_ID'];
$semesters = "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $semesters .= "<option value = '$row[0]'> $row[1] </option>";

    }
}
else {
    echo "failed " . mysqli_error($conn);
}

$grades = '';
if ($semesters !== "" ) {
$sql = " SELECT Enrollment.CRN, Courses.Course_Name, Enrollment.Semester_ID, Semester.Semester_Name, Enrollment.Grade, Courses.Course_credit,
              Enrollment.Grade, Courses.Dept_Name,
               CASE Enrollment.Grade
              WHEN 'A'  THEN 4.00 * Courses.Course_Credit
              WHEN 'A-' THEN 3.70 * Courses.Course_Credit
              WHEN 'B+' THEN 3.30 * Courses.Course_Credit
              WHEN 'B'  THEN 3.00 * Courses.Course_Credit
              WHEN 'B-' THEN 2.70 * Courses.Course_Credit
              WHEN 'C+' THEN 2.30 * Courses.Course_Credit
              WHEN 'C'  THEN 2.00 * Courses.Course_Credit
              WHEN 'C-' THEN 1.70 * Courses.Course_Credit
              WHEN 'D+' THEN 1.30 * Courses.Course_Credit
              WHEN 'D'  THEN 1.00 * Courses.Course_Credit
              WHEN 'D-' THEN 0.70 * Courses.Course_Credit
              WHEN 'F'  THEN 0.00 * Courses.Course_Credit
              END AS quality_point
              FROM Enrollment
              INNER JOIN Class ON Enrollment.CRN = Class.CRN
              INNER JOIN Courses ON Class.Course_ID = Courses.Course_ID
              INNER JOIN Semester ON Enrollment.Semester_ID = Semester.Semester_ID
              WHERE Semester.Semester_ID = (SELECT MAX(Enrollment.Semester_ID) FROM Enrollment WHERE Enrollment.Student_ID =" . $_SESSION['User_ID'] . " )
              AND Enrollment.Student_ID = " . $_SESSION['User_ID'];

$termEarnedCredits = 0;
$termTotalCredits = 0;
$termTotalPoints = 0;
$termGpa = 0;

if ($result = mysqli_query($conn, $sql)) {

    $termEarnedCredits = 0;
    $termTotalCredits = 0;
    $termTotalPoints = 0;
    if (!mysqli_num_rows($result) == 0) {
     while ($row = mysqli_fetch_array($result)) {
            if ($row[4] !== 'F') {
            $termEarnedCredits+= $row[5];
            }
            $termTotalCredits += $row[5];
            $termTotalPoints += $row[8];

            }
        /***Term Calculation ***/
        $termGpa = number_format($termTotalPoints/$termTotalCredits, 2, '.', '');
 }
}


if ($result = mysqli_query($conn, $sql)) {

    $grades .= "<form class = 'w3-container' action = '?' method = 'post' id = 'gradeForm'>
    <div class='w3-section'>
        <select id = 'Semester' name='Semester'>
        $Semester
        </select>
        </div>
    </form>
    <div class='w3-container w3-card-8 w3-white w3-twothird' id = 'Grade' style='margin: auto'>
          <div class='w3-section w3-card-8 w3-brown' style='max-width:150px'>
                <p>Term GPA: $termGpa</p>
            </div>
           
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-khaki'><b>Course</b></h5>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-khaki'><b>Course Name</b></h5>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <h5 class='w3-khaki'><b>Grade</b></h5>
            </div>";

    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
        $grades .= "<div class='w3-row'>
      
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'>$row[7]</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'>$row[1]</p>
            </div>
            <div class='w3-col l4 s4 w3-left'>
                <p class='w3-text-dark-grey'><span class='w3-tag w3-brown w3-round'>$row[4]</span></p>
            </div>
         </div>";
   }
}

}
else {
	echo "Failed " . mysqli_error($conn);
}
mysqli_close($conn);
}
else {
    $grades = "<div class='w3-container w3-pale-red'>
                    <p> <b>You don't have grades for any semester yet</b> </p>
                    </div>";
}
?>

<br> <br>

<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

<?php echo isset($grades) ? $grades : '' ?>

</div>

<!-- <script>
    window.onload = function() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var grades = document.getElementById('Grade');
    var semester = document.getElementById('Semester');

    semester.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById('Grade').innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../ajax_requests.php?semester="+semester.value,true);
        xmlhttp.send();
    });
}
 </script> -->

<?php
htmlfooter();

unset($_SESSION['message']);

?>


