<?php
include 'header_footer.php';
session_start();
//
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: index.php");
//     }
// }
if (isset($_POST['signout'])) {
  session_unset();
  session_destroy();
  header("Location: logout_page.php");
}
htmlheader_root('w3-white');
?>

    <h1 style="margin-left:15px">Edit Depeartment</h1><br>

    <?php

        include "php_functions.php";
        $conn = connectToHost();

        $dept_id = $_GET['id'];
        $sql = "SELECT Dept_ID, Dept_Name, Chair, Phone_Number, Email From Department WHERE Dept_ID = '$dept_id' ";

        $result = runSQL($conn,$sql);

        if($result){
            $row = $result->fetch_assoc();
            echo "<form class='w3-container' action = 'dept_update_validate.php' method = 'post'>
                <input type='hidden' name='id' value='" .$row['Dept_ID']. "'>

                <label class='w3-label w3-white'><b>Department Name: </b></label>
                <input class='w3-input' type='text' name='dept' value='".$row['Dept_Name']."'>
                <br>
                <label class='w3-label w3-white'><b>Department Chair: </b></label>
                <select class='w3-select w3-border' name='chair'>";
                getAllFacultySelect($row['chair']);
        
            echo "</select>
                <br><br>
                <button class='w3-btn w3-brown' type='submit' onclick='return confirm(\"Are you sure you want to apply the changes?\")'>Update</button>
                <a class='w3-btn w3-brown' href='admin_home.php'>cancel</a>
                </div>
                </form>";
        }else{
            echo "Failed:". mysqli_error($conn);
        }

        $conn->close();
    ?>
    <div>
    </div>

</div>

<?php
htmlfooter();
?>

