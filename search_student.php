<?php
include 'header_footer.php';
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

htmlheader_root('w3-white');
?>


        <div class="w3-container">
            <h2>Search Student</h2>
            <p>Search for a Student in the input field.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for student name" id="myInput" onkeyup="filter_table()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:50%;">Student Name</th>
                    <th style="width:50%;">Student ID</th>
                </tr>

             <?php

             $dbServername = "project1.cdbkarygfry8.us-east-2.rds.amazonaws.com";
             $dbUsername = "admin";
             $dbPassword = "Group463!";
             $dbName = "WebBasedSystem";

             $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // load page here

            $sql = "SELECT Student.Student_ID, CONCAT(Users.first_name, ' ', Users.last_name) AS full_name
                    FROM Users
                    INNER JOIN Student ON Users.User_ID = Student.Student_ID; ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='addAdvToStu.php?id=".$row["Student_ID"]."&sname=".$row["full_name"]."'>".$row["full_name"]. "</td><td>".$row["Student_ID"]. "</td></tr>";
                }
            } else {
                $conn->close();
            }
            $conn->close();
        ?>
            </table>

        </div>
</div>

<?php
htmlfooter();
?>