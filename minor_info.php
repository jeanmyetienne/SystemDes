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


$conn = mysqlConnect();
$sql1 = "SELECT Dept_ID, Dept_Name from Department";
$sql2 = "SELECT Minor_ID, Minor_Name from Minor";
$departments = "";
$degrees = "";
if ($result = mysqli_query($conn, $sql1)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
if ($result = mysqli_query($conn, $sql2)) {
    while ($row = mysqli_fetch_array($result)) {
        $degrees .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
mysqli_close($conn);



if (isset($_GET['Minor'])) {
$_SESSION['Minor_ID'] = $_GET['Minor'];
$Minor_ID = $_SESSION['Minor_ID'];
$conn = mysqlConnect();
$sql = "SELECT Minor_Name, Dept_ID, Dept_Name, Minor_ID FROM Minor WHERE Minor_ID = '$Minor_ID'";

if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $minor_name = $row[0];
        $department_id = $row[1];
        $department_name = $row[2];
        $_SESSION['Minor_Name'] = $Minor_Name;
    }
}
else {
    echo "failed " . mysqli_error();
}
mysqli_close($conn);
}


if (isset($_POST['update']) && isset($_POST['Minor_Name'])) {
    $Minor_ID = $_SESSION['Minor_ID'];
    $Minor_Name = $_POST['Minor_Name'];
    $department = $_POST['Department'];

 if (empty($department) ) {
     $sql = "UPDATE Minor SET Minor_Name = '$Minor_Name', Dept_ID = NULL WHERE Minor_ID = '$Minor_ID'";
 }
 else if (empty($department) ) {
     $sql = "UPDATE Minor SET Minor_Name = '$Minor_Name', Dept_ID = NULL WHERE Minor_ID = '$Minor_ID";
 }
 else if (!empty($department)) {
     $sql = "UPDATE Minor SET Minor_Name = '$Minor_Name', Dept_ID = $department WHERE Minor_ID = $Minor_ID'";
 }
 else {
     $sql = "UPDATE Minor SET Minor_Name = '$Minor_Name', Dept_ID = $department WHERE Minor_ID = $Minor_id";
 }
        $conn = mySqlConnect();
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                <h3>Success</h3>
                <p>Degree updated successfully.</p>
            </div>";
            header('location: minor_info.php?minor='.$Minor_ID);
            exit();
        }
        else {
            echo "<div class='w3-container w3-red'>
                <p>Could not update degree.</p>
            </div>";
            echo mysqli_error($conn);
        }

}

if (isset($_POST['delete'])) {
    $Minor_ID = $_SESSION['Minor_ID'];
    $conn = mySqlConnect();
    $sqlDelete = "DELETE FROM Minor WHERE Minor_ID = '$Minor_ID'";
    if (mysqli_query($conn, $sqlDelete)) {
        echo "<div class='w3-container w3-pale-green'>
            <h3>Success</h3>
            <p>Degree deleted successfully.</p>
        </div>";
    }
    else {
        echo "<div class='w3-container w3-red'>
            <p>Could not delete degree.</p>
        </div>";
        echo mysqli_error($conn);
    }
}

if (isset($_POST['add_courses'])) {
    header('location: minor_courses.php');
}

if (isset($_POST['view_courses'])) {
    header('location: view_courses.php');
}
if (isset($_POST['student_portal'])) {
    header('location: minor_student.php');
}
if (isset($_POST['student_view'])) {
    header('location: minor_student_view.php');
}



htmlheader_root('w3-white');
?>
<div class = "w3-container">
    <h2 class = " w3-text-brown"> <?php echo isset($_SESSION['Minor_ID']) ? $_SESSION['Minor_ID'] : ''?> </h2>
  </div>

    <div class = "w3-container">
    <h2> Edit Minor</h2>
    </div>


    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

    <!--<div class = "w3-container">
    <h3> Click <a href = "major_courses.php">here</a> to add/remove courses from this major</h3>
    </div>-->
<div class = "w3-card-4 w3-brown" style="max-width:710px">
    <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();">
      
               <input type="submit" class="w3-btn w3-brown w3-section w3-mobile" id = "add_courses" name = "add_courses" value = "Add Courses">
               <input type="submit" class="w3-btn w3-brown w3-section w3-mobile" id = "view_courses" name = "view_courses" value = "View/Remove Courses">  
               <input type="submit" class="w3-btn w3-brown w3-section w3-mobile" id = "student_portal" name = "student_portal" value = "Assign/Remove Minor"> 
               <input type="submit" class="w3-btn w3-brown w3-section w3-mobile" id = "student_portal" name = "student_view" value = "View Students">           
         </form>
</div>
<br>

          <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();" style="max-width:550px">
                  <div class="w3-section">

                   <label ><b>Minor Name</b></label><br>
                    <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "Minor_Name" name = "Minor_Name" value = "<?php echo isset($Minor_Name) ? $Minor_Name       : ''?>"> <br>

                    <label><b>Department</b></label><br>
                    <select class="w3-select w3-padding-small w3-border-bottom w3-border-brown" id = "department" name="department">
                    <option value = ""> N/A </option>
                    <option value="<?php echo isset($department_id) ? $department_id : ''?>"selected> <?php echo isset($department_name) ? $department_name : 'N/A'?> </option>
                     <?php echo isset($departments) ? $departments : '<option value="">None</option>' ?> 
                     </select> <br> <br>

                    
                     </select>

                      <input class="w3-btn w3-brown w3-section" type="submit" name = "update" value = "Update Minor" onclick = "return confirm('Are you sure you want to update the major?');">
                      <input class="w3-btn w3-brown w3-section" type="submit" name = "delete" value = "Delete Minor" onclick = "return confirm('Are you sure you want to delete the major?');">
                  </div>
                </form>

</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>
