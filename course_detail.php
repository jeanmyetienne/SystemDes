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
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: index.php");
// }

htmlheader();

//search query using username as condition to get the rows for account_type;
?>


        <div class="w3-container w3-center">
        <?php
        $Course_id = $_GET['id'];

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
            $sql = "SELECT Courses.* , b.Course_Name as 'prereq', Prerequesites.PRE_ID FROM Courses left join Prerequesites on Prerequesites.Course_Name = Courses.Course_ID left join course b on Prerequesites.PRE_ID = b.Course_ID WHERE Courses.Course_ID = $Course_ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();

                echo "<h1>Course Details: ".$row["Course_Name"]. "</h1><div class='w3-panel w3-white w3-round-xlarge'><h3>Course ID</h3><p>" . $row["Course_ID"]. "</p><h4>Course Credits</h4> <p>" . $row["Course_Credit"]. "</p></div><div class='w3-panel w3-white w3-round-xlarge'>";
            }
            $conn->close();
        ?>
        </div>

        <div class="w3-panel w3-center w3-margin w3-white w3-padding w3-round-xlarge">
            <?php echo "<a class='w3-btn w3-brown' href='delete_validation.php?id=".$_GET['id']."' onclick='return confirm(\"Would you like to delete this course?\")'>Delete Course</a>"; ?>

            <?php echo "<a class='w3-btn w3-brown' href='course_prereq.php?id=".$_GET['id']."'>Add Prequisite</a>"; ?>

            <?php echo "<a class='w3-btn w3-brown' href='edit_course.php?id=".$_GET['id']."'>Edit Course</a>"; ?>

            <?php echo "<a class='w3-btn w3-brown' href='add_section.php?id=".$_GET['id']."'>Add Section</a>"; ?>
        </div>

</div>

<?php
htmlfooter();
?>