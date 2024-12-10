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

htmlheader_root('w3-white');
$course_id = $_SESSION['Course_ID'];
$dept_id = $_SESSION['dept_id'];
$conn = mysqlConnect();
// $sql = "SELECT Dept_Name FROM Department 
// WHERE Dept_ID =" . $_SESSION['dept_id'];

$sql = "SELECT Dept_ID FROM Department WHERE Dept_ID = '$dept_id' ";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments = $row[0];
    }
}
else {
    echo "failed " . mysqli_error($conn);
}



// $sql = "SELECT * from Courses WHERE Dept_ID = " . $_SESSION['dept_id'];
 // $sql = "SELECT Dept_ID, Dept_Name, Chair, Phone_Number, Email, Office_ID FROM Department where Dept_ID  = " . $_SESSION['dept_id'] ;
$sql = "SELECT  Courses.Course_ID, Courses.Course_Name, Department.Dept_Name, Courses.Course_Credit FROM Courses 
        INNER JOIN Department ON Courses.Dept_ID = Department.Dept_ID 
        WHERE Courses.Dept_ID  = '$dept_id' 
        ORDER BY Course_Name ASC";
$courses = "";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $courses.= "<div class='w3-container'>
          <h4 class=' w3-khaki w3-padding-small'><b>$row[1]</b></h4>
          <p class='w3-text-black' >$row[2]</p>
          <p class='w3-text-black' >$row[0]</p>
          <p class='w3-text-black' >$row[3]</p>
          <form action = 'view_sections.php?Course_ID=".$row[0]."' method = 'post'>
          <input type = 'hidden' name = 'Course_Name' value = '$row[1]'>
          <input type = 'hidden' name = 'Course_ID' value = $row[0]> 
          <input type = 'hidden' name = 'Course_Credit' value = $row[3]> 
          <input class='w3-btn w3-brown w3-section' type = 'submit' name = 'submit' value = 'View Sections'>
          </form>
          <hr>
        </div>";
    }
}
else {
    echo "Failed: " . mysqli_error($conn);
}
mysqli_close($conn);

?>
    <h2 class = "w3-container w3-text-brown"> <?php echo isset($departments) ? $departments : ''?> </h2>

    <div class='w3-container'>

          <form action = 'view_sections.php' method = 'post'>
          <input class='w3-btn w3-brown w3-section' type = 'submit' name = 'submit_all' value = 'View All Sections'>
          </form>
        </div>
        <br>

    <?php echo $courses ?>

    <script>
   /**  window.onload = function() {
          
    var elements = document.getElementById("course_category").selectedOptions;

    for(var i = 0; i < elements.length; i++){
      elements[i].selected = false;
     }
  
    }**/
    
    function validateCheckbox() {
    var errorMsg = document.getElementById('errorMsg');
       element = document.getElementById("departments");
        if (element.value == "") {
            element.style.border = "2px groove #CD2627";
            errorMsg.classList.add('w3-red');
            errorMsg.innerHTML = "Please select an option";
            event.preventDefault();
        }
    }
    </script>

   <?php 
   if (isset($_POST['submit']) && isset($_POST['departments'])) {
       $_SESSION['Dept_ID'] = $_POST['departments'];
       header('location: section_selection.php');
   }
   
   ?>

<?php
htmlfooter();
?>
