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

htmlheader('w3-white');

//search query using username as condition to get the rows for account_type;
?>
<!-- In PHP check cookies id not there redirect to main page or display not logged in -->


        <div class="w3-container">
            <h2>Courses</h2>
            <p>Search for a course in the input field.</p>
            <p>Click on a course name to view details, edit, add Prereq., add Section, archive, or delete it.</p>

            <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for the course name." id="myInput" onkeyup="filter_table()">
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:10%;">Course Name</th>
                    <th style="width:20%;">Course Credit</th>
                    <th style="width:60%;">Major</th>
                    <th style="width:10%;">Department Name</th>
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
            //load page here
            $sql = "SELECT * FROM Courses ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='course_detail.php?id=".$row["Course_ID"]."'>".$row["Course_Name"]. "</a></td><td>" . $row["Course_Credit"]. "</td><td>" . $row["Major"]. "</td><td>" . $row["Dept_Name"]. "</td></tr>";
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