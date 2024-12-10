<?php
include 'header_footer.php';
include 'php_functions.php';
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
$sql1 = "SELECT Dept_ID, Dept_Name from Department";
$sql2 = "SELECT Major_ID, Major_Name from Major";
$departments = "";
// $degrees = "";
if ($result = mysqli_query($conn, $sql1)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments .= "<option value = $row[0]> $row[1] </option>";
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


if (isset($_POST['submit']) && isset($_POST['Major_Name'])) {

    $majorName = $_POST['Major_Name'];
    $department = $_POST['Dept_Name'];
    $degree = $_POST['Major_ID'];
 if (empty($department) && empty($degree)) {
     $sql = "INSERT INTO Major (Major_Name) VALUES ('$majorName')";
 }
 else if (empty($department) && !empty($degree)) {
     $sql = "INSERT INTO Major (Major_Name, Major_ID, Dept_Name) VALUES ('$majorName', '$degree', NULL)";
 }
 else if (!empty($department) && empty($degree)) {
     $sql = "INSERT INTO Major (Major_Name, Dept_Name, Major_ID) VALUES ('$majorName', '$department', NULL)";
 }
 else {
     $sql = "INSERT INTO Major (Major_Name, Dept_Name, Major_ID) VALUES ('$majorName', '$department', '$degree')";
 }
    $conn = mysqlConnect();

    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                                <h3>Success</h3>
                                <p>Major Created Successfully.</p>
                                </div>";
       header('location: add_major.php');
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red'>
                                <h3>Failed</h3>
                                 <p>Could Not Create Major</p>
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

    <h1 style="margin-left:15px">Add Major</h1>

    <form class="w3-container" action = "?" method = "post" id = "degreeForm" onsubmit = "validateEmptyFields();">
        <div class="w3-section">

            <label ><b>Major Name</b></label><br>
            <input class = "w3-input w3-round signup w3-padding-medium" type = "text" id = "Major_Name" name = "Major_Name" maxlength = '255'> <br>

            <label><b>Department</b></label><br>
            <select class="w3-select w3-border-bottom w3-border-color-brown" id = "Dept_Name" name="Dept_Name">
                <option value="">N/A</option>
                <?php echo $departments ?>
            </select> <br> <br>

            <label><b>Major ID</b></label><br>
                <input class = "w3-input w3-round signup w3-padding-medium" type = "varchar" id = "Major_ID" name = "Major_ID" maxlength = '5'> <br>
            </select>

            <input class="w3-btn w3-brown w3-section" type="submit" name = "submit" value = "Submit">
        </div>
    </form>

</div>

<?php
htmlfooter();
unset($_SESSION['message']);
?>