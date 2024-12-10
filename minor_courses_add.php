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

if (isset($_SESSION['Minor_ID'])) {
    $minor_id = $_SESSION['Minor_ID'];
    //echo $major_id;
}


$conn = mysqlConnect();
$sql = "SELECT Courses.Course_ID, Courses.Course_Name, Courses.Course_Credit, Department.Dept_Name, Minor.Minor_ID FROM Courses 
INNER JOIN Department ON Courses.Dept_ID = Department.Dept_ID
LEFT OUTER JOIN Minor ON Courses.Course_ID = Minor.Minor_ID 
WHERE Courses.Dept_ID = '$dept_id'";
$courses= "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
           if ($row[6] == $minor_id) {
             $input = "";
             $status = "<span class='w3-tag w3-teal w3-round'>Added</span>";
          }
          else {
            $input = "<input class='w3-btn w3-blue-grey w3-section' type = 'submit' name = 'submit' value = 'Add to Minor'>";
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
    $course_name = $_POST['course_name'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO Minor_Requirements (Minor_ID, Course_ID) VALUES ($minor_id, $course_id)";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] =  "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>$course_name assigned to Minor successfully.</p>
            </div>";
        header('location: minor_courses_add.php');
        exit();
    }
    else {
    echo "failed " . mysqli_error($conn);
}
}

htmlheader_root('w3-white');
?>


    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>
        
        <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?>
        <h2 class = "w3-container w3-text-dark-grey"> <?php echo isset($_SESSION['Minor_Name']) ? $_SESSION['Minor_Name'] : ''?> </h2>
        <h3 class="w3-text-dark-grey w3-padding-16 w3-container">Courses</h3>
        <?php echo $courses ?>




      <!--  <div class="w3-container">
          <h5 class="w3-opacity"><b>Systems Design</b></h5>
          <p class="w3-text-dark-grey">4 credit hours </p>
          <p class="w3-text-dark-grey">Mathematics and Computer Sciences Department </p>
          <p class="w3-text-dark-grey">Students will learn and implement all system requirements to produce a completely finished product.</p>
          <form action = "?" method = "post">
          <input type = "hidden" name = "course_id" value = ""> 
          <input class="w3-btn w3-blue-grey w3-section" type = "submit" value = "Add to Major"> 
          </form>
          <hr>
        </div> -->
    

    </div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>

