<?php
include 'header_footer.php';
session_start();
// //
// if (!isset($_SESSION['username'])) {
//     header("Location: ../index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: ../index.php");
//     }
// }

htmlheader_root('w3-white');
?>

        <div class="w3-container">
            <h2>Search Department</h2>

        
            <table class="w3-table-all w3-margin-top" id="myTable">
                <tr>
                    <th style="width:25%;">Department Name</th>
                    <th style="width:25%;">Department ID</th>
                    <th style="width:15%;">Chair</th>
                    <th style="width:15%;">Chair Telephone</th>
                    <th style="width:20%;">Chair Email</th>
                    <th style="width:25%;">Office ID</th>
                </tr>
        <?php
        $dbServername = "project1.cdbkarygfry8.us-east-2.rds.amazonaws.com";
        $dbUsername = "admin";
        $dbPassword = "Group463!";
        $dbName = "WebBasedSystem";

        $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
                 if (mysqli_connect_errno()) {
                     die("Connection failed: " . mysqli_connect_error());
                     }

                    

            //load page here
            $sql = "SELECT Dept_Name, Dept_ID, Chair, Phone_Number, Email, Office_ID FROM Department ";
           
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td><a href='dept_detail.php?id=".$row["Dept_ID"]."'>
                        ".$row["Dept_Name"]. "</a></td><td>"
                        .$row["Dept_ID"]. "</td><td>"  
                        .$row["Chair"]. "</td><td>" 
                        .$row["Phone_Number"]. "</td><td>" 
                        .$row["Email"]. "</td><td>" 
                        .$row["Office_ID"]. "</td></tr>";
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