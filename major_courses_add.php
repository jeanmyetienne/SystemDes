<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: ../index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

if (isset($_SESSION['Dept_ID'])) {
    $dept_id = $_SESSION['Dept_ID'];
}

if (isset($_SESSION['Major_ID'])) {
    $major_id = $_SESSION['Major_ID'];
    //echo $major_id;
}


$conn = mysqlConnect();
$sql = "SELECT Courses.Course_ID, Courses.Course_Name, Courses.Major, Courses.Course_Credit, Department.Dept_Name, Major.Major_ID FROM Courses 
INNER JOIN Department ON Courses.Dept_ID = Department.Dept_ID
LEFT OUTER JOIN Major ON Courses.Course_ID = Major.Major_ID AND Courses.Major = '$major_id'
WHERE Courses.Dept_ID = '$dept_id'";
$courses= "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
           if ($row[6] == $major_id) {
             $input = "";
             $status = "<span class='w3-tag w3-teal w3-round'>Added</span>";
          }
          else {
            $input = "<input class='w3-btn w3-blue-grey w3-section' type = 'submit' name = 'submit' value = 'Add to Major'>";
            $status = "";
        }
        $courses .= "<div class='w3-container'>
          <h4 class='w3-opacity w3-grey w3-padding-small'><b>$row[1]</b></h4>
          $status
          <p class='w3-text-dark-grey'>$row[4] credit hours </p>
          <p class='w3-text-dark-grey'>$row[5] Department </p>
          <p class='w3-text-dark-grey'>$row[3]</p>
          <form action = '?' method = 'post'>
          <input type = 'hidden' name = 'Course_Name' value = '$row[1]'>
          <input type = 'hidden' name = 'Course_ID' value = $row[0]> 
          $input
          </form>
          <hr>
        </div>";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}



mysqli_close($conn);


if (isset($_POST['submit']) && isset($_POST['Course_ID']) && isset($_POST['Course_Name'])) {
    $course_id = $_POST['Course_ID'];
    $course_name = $_POST['Course_Name'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO Courses (Major_ID, Course_ID) VALUES ($major_id, $course_id)";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] =  "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>$course_name assigned to Major successfully.</p>
            </div>";
        header('location: major_courses_add.php');
        exit();
    }
    else {
    echo "failed " . mysqli_error($conn);
}
}

htmlheader_root('w3-white');
?>
