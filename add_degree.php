<?php
include 'header_footer.php';
include 'php_functions.php';
include 'dbhinc.php';
session_start();

//if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: ../index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

$conn = mysqlConnect();
$sql1 = "SELECT Dept_ID, Dept_Name FROM Department";
$sql2 = "SELECT Minor_ID, Minor_Name FROM Minor";
$departments = "";
// $degrees = "";
if ($result = mysqli_query($conn, $sql1)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments .= "<option value = $row[1]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
// if ($result = mysqli_query($conn, $sql2)) {
//     while ($row = mysqli_fetch_array($result)) {
//         $degrees .= "<option value = $row[0]> $row[1] </option>";
//     }
// }
// else {
//     echo "failed " . mysqli_error();
// }
mysqli_close($conn);


if (isset($_POST['submit']) && isset($_POST['Minor_Name'])) {

    $majorName = $_POST['Minor_Name'];
    $department = $_POST['Dept_Name'];
    $degree = $_POST['Minor_ID'];
 if (empty($department) && empty($degree)) {
     $sql = "INSERT INTO Minor (Minor_Name) VALUES ('$majorName')";
 }
 else if (empty($department) && !empty($degree)) {
     $sql = "INSERT INTO Minor (Minor_Name, Minor_ID, Dept_Name) VALUES ('$majorName', '$degree', NULL)";
 }
 else if (!empty($department) && empty($degree)) {
     $sql = "INSERT INTO Minor (Minor_Name, Dept_Name, Minor_ID) VALUES ('$majorName', '$department', NULL)";
 }
 else {
     $sql = "INSERT INTO Minor (Minor_Name, Dept_Name, Minor_ID) VALUES ('$majorName', '$department', '$degree')";
 }
    $conn = mysqlConnect();

    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                                <h3>Success</h3>
                                <p>Minor Created Successfully.</p>
                                </div>";
       header('location: add_degree.php');
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could Not Create Minor</p>
                                </div>" . mysqli_error($conn);
    }
   // $_SESSION['message'] = $message;
    mysqli_close($conn);
}

htmlheader_root('w3-white');
?>

 <br>
    <div id = "errorMsg" class = "w3-container">
      <p></p>
    </div>

    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>
    <?php echo isset($message) ? $message : ''?>

    <h1 style="margin-left:15px">Add Minor</h1>

    <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();">
        <div class="w3-section">

            <label ><b>Minor Name</b></label><br>
            <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "Minor_Name" name = "Minor_Name" maxlength = '255'> <br>

            <label><b>Department</b></label><br>
            <select class="w3-select w3-border-bottom w3-border-color-brown" id = "Dept_Name" name="Dept_Name">
                <option value="">Department</option>
                <?php echo $departments ?>
            </select> <br> <br>

            <label><b>Minor ID</b></label><br>
                <input class = "w3-input w3-round signup w3-padding-medium" type = "varchar" id = "Minor_ID" name = "Minor_ID" maxlength = '7'> <br>
            </select>

            <input class="w3-btn w3-brown w3-section" type="submit" name = "submit" value = "Submit">
        </div>
    </form>

</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>