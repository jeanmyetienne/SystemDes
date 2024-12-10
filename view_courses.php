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


if (isset($_SESSION['Major_ID'])) {
    $major_id = $_SESSION['Major_ID'];
    //echo $major_id;
}


$conn = mysqlConnect();

$sql = "SELECT Major_Requirements.Major_ID, Major_Requirements.Course_ID, Courses.Course_Name, Courses.Course_Credit, Courses.Major, Department.Dept_Name FROM Major_Requirements
INNER JOIN Major ON Major_Requirements.Major_ID = Major.Major_ID 
INNER JOIN Courses ON Major_Requirements.Course_ID = Courses.Course_ID 
INNER JOIN Department ON Department.Dept_ID = Courses.Dept_ID
WHERE Major_Requirements.Major_ID = '{$_SESSION['Major_ID']}'  ";
$courses= "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $courses .= "<div class='w3-container'>
          <h4 class='w3-opacity w3-brown w3-padding-small'><b>$row[2]</b></h4>
          <p class='w3-text-dark-grey'> $row[3] credit hours </p>
          <p class='w3-text-dark-grey'> $row[5] Department </p>
          <p class='w3-text-dark-grey'> $row[4] </p>
          <form action = '?' method = 'post'>
          <input type = 'hidden' name = 'Course_Name' value = $row[2]>
          <input type = 'hidden' name = 'Course_ID' value = $row[1]>
          <input class='w3-btn w3-brown w3-section' type = 'submit' name = 'delete' value = 'Remove from Major'>
          </form>
          <hr>
        </div> ";
    }
}
else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);


if (isset($_POST['delete']) && isset($_POST['Course_Name']) && isset($_POST['Course_ID'])) {
    $course_id = $_POST['Course_ID'];
    $course_name = $_POST['Course_Name'];

    $sql = "DELETE FROM Major_Requirements WHERE Major_ID = '{$_SESSION['Major_ID']}' AND Course_ID  = '{$_SESSION['Course_ID']}'";
    $conn = mysqlConnect();
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] =  "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>'$course_name' removed from major successfully.</p>
            </div>";
        header('location: view_courses.php');
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
        <h2 class = "w3-container w3-text-brown"> <?php echo isset($_SESSION['Major_ID']) ? $_SESSION['Major_ID'] : ''?> </h2>
        <h3 class="w3-text-dark-grey w3-padding-16 w3-container">Courses</h3>
        <?php echo $courses ?>
    

    </div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>