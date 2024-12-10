<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();
//
// if (!isset($_SESSION['username'])) {
//     header("Location: ../index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: ../index.php");
//     }
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

if (isset($_GET['sname'])) {
    $_SESSION['Student_Name'] = $_GET['sname'];

}
if (isset($_GET['id'])) {
    $_SESSION['Student_ID'] = $_GET['id'];

}

// $stu_id =  $_SESSION['Student_ID'];

if (isset($_POST['addholdbutton'])) {
    $holdID = $_POST['HOLD_ID'];

    $conn = mysqlConnect();
    $sql = "INSERT INTO Student_Holds (HOLD_ID, Student_ID) VALUES ('$holdID', ".$_SESSION['Student_ID'].") ";

    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green' id='messageAlert'>
                                <h3>Success</h3>
                                <p>Hold Created Successfully.</p>
                                </div>";
       header("Location: student_hold.php");
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red' id='messageAlert'>
                                <h3>Failed</h3>
                                 <p>Could Not Create Degree</p>
                                </div>" . mysqli_error($conn);
    }
   // $_SESSION['message'] = $message;
    mysqli_close($conn);
}

if (isset($_POST['delholdbutton'])) {
    $holdID = $_POST['HOLD_ID'];

    $conn = mysqlConnect();
    $sql = "DELETE FROM Student_Holds
            WHERE HOLD_ID = '$holdID'
            AND Student_ID = ".$_SESSION['Student_ID'].";";

    if (mysqli_query($conn, $sql)) {
        //header('location: add_degree.php');
        $_SESSION['message'] = "<div class='w3-container w3-pale-green' id='messageAlert'>
                                <h3>Success</h3>
                                <p>Hold Successfully Deleted.</p>
                                </div>";
       header("Location: student_hold.php");
       exit();
    }
    else {
        $message = "<div class='w3-container w3-red' id='messageAlert' >
                                <h3>Failed</h3>
                                 <p>Could Not Delete the Hold</p>
                                </div>" . mysqli_error($conn);
    }
   // $_SESSION['message'] = $message;
     mysqli_close($conn);
}

function getAllStuHoldsSelect(){
    $conn = connectToHost();
//CHANGE HOLDS
    $sql  = "SELECT HOLD_ID, HOLD_NAME FROM HOLD";


    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<option value='" .$row["HOLD_ID"]. "'>" .$row["HOLD_NAME"]. "</option>";
        }
    } else {
        echo "<option value='NULL' disabled>-- No holds to apply --</option>";
    }

    $conn->close();
}

function getAllStuHoldsRadioBut(){
    $conn = connectToHost();

    $sql  = "SELECT * FROM HOLD
             INNER JOIN Student_Holds ON HOLD.HOLD_ID = Student_Holds.HOLD_ID
             WHERE Student_ID = ".$_SESSION['Student_ID']." ";

    $result = runSQL($conn,$sql);

    if(!$result){
        echo "Failed:". mysqli_error($conn);
    } elseif(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()) {
            echo "<tr><td><input type='radio' name='holdID' value=" .$row["HOLD_ID"]. "></td><td>" .$row["HOLD_NAME"]. "</td></tr>";
        }
    }else{
        echo "<tr><td></td><td>This student does not have any holds</td></tr>";
    }

    $conn->close();
}
htmlheader_root('w3-white');
?>

        <div class="w3-container">
            <h1>Add or Delete Student Holds</h1>
            <div class = "w3-container w3-card-4 w3-brown" style="max-width: auto">
            <h2><?php echo "Student Name: " .$_SESSION['Student_Name'];
                      echo "<br> Student ID: " .$_SESSION['Student_ID']; ?>
            </h2>
        </div>
            <br>
            <h3>Apply hold to student:</h3>

            <form class="w3-container" id="addHoldForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label class="w3-label w3-white">Select a hold to apply:</label>
                <select class="w3-select w3-border" name="HOLD_ID">
                    <?php getAllStuHoldsSelect(); ?>
                </select>
                <div>
                    <input class="w3-btn w3-brown" type="submit" name="addholdbutton" value="Add Hold" onclick="return confirm('Are you sure you want to add this hold to the student account?')" />
                </div>
            </form>
        </div>

        <div class="w3-container" >
            <h3><b>Current Holds</b></h3>
            <p>To delete a hold, select one and click the "Delete Hold" button.</p>
                 <form class="w3-container" id="delHoldForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                    <div class="w3-section">
                        <table class="w3-table-all w3-margin-top" id="myTable">
                            <tr>
                                <th style="width:10%;">Select Hold</th>
                                <th style="width:30%;">Hold Name</th>
                            </tr>
                            <?php getAllStuHoldsRadioBut(); ?>
                        </table>
                    </div>
                    <div>
                        <input class="w3-btn w3-brown" type="submit" name="delholdbutton" value="Delete Hold" onclick="return confirm('Are you sure you want to delete this hold from the student account?')" />
                    </div>
                </form>
        </div>
</div>

<?php
htmlfooter();
?>