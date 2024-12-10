        <!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once 'Includes/dbhinc.php';
include 'header_footer.php';
session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: index.php");
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: logout_page.php");
// }


htmlheader();


    ?>

    <meta charset="UTF-8">
    <title>Master Schedule</title>
    <link rel="stylesheet" href="masterStyle.css">
    </head>

<body>
            <h1>MASTER SCHEDULE</h1>
<div style="height:900px; width: auto; overflow-y: scroll;">
         <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th width="75">CRN</th>
                        <th width="75">Section</th>
                        <th width="75">Course_ID</th>
                        <th width="96">Course Name</th>
                        <th width="96">Department</th>
                        <th width="96">Day</th>
                        <th width="96">Start Time</th>
                        <th width="96">End Time</th>
                        <th width="96">Semester</th>
                        <th width="96">Year</th>
                        <th width="96">Building Name</th>
                        <th width="96">Room Number</th>
                        <th width="96">Professor First Name</th>
                        <th width="96">Professor Last Name</th>
                        <th width="96">Available Seats</th>
                        <th width="96">Total Seats</th>
                    </tr>
                </thead>
    <tbody>
 
        <?php

            $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

            if ($conn->connect_error) { 
                die("Connection failed: " . $conn-> connect_error); 
            } 

            $sql = "SELECT CRN, Section, Course_ID, Course_Name, Department_Name, Day_ID, Start_Time, End_Time, Semester, Year, Building, Room_Number, Professor_First_Name, Professor_Last_Name, Available_Seats, Total_Seats FROM MSFALL2021";
            $result=$conn-> query($sql);

            if ($result -> num_rows > 0) {
               while ($row = $result -> fetch_assoc()) {
                    echo "<tr><td>".$row["CRN"]."</td><td>"
                        .$row["Section"]."</td><td>"
                        .$row["Course_ID"]."</td><td>"
                        .$row["Course_Name"]."</td><td>"
                        .$row["Department_Name"]."</td><td>"
                        .$row["Day_ID"]."</td><td>"
                        .$row["Start_Time"]."</td><td>"
                        .$row["End_Time"]."</td><td>"
                        .$row["Semester"]."</td><td>"
                        .$row["Year"]."</td><td>"
                        .$row["Building"]."</td><td>"
                        .$row["Room_Number"]."</td><td>"
                        .$row["Professor_First_Name"]."</td><td>"
                        .$row["Professor_Last_Name"]."</td><td>"
                        .$row["Available_Seats"]."</td><td>"
                        .$row["Total_Seats"]."</td></tr>";
               }

               echo "</table>";   
            }
            else {
                echo "0 result";
            }

            $conn-> close();


            ?>