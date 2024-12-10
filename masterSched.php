<!DOCTYPE html>
<html lang="en">
<head>
    <?php
     require_once 'Includes/dbhinc.php';
    ?>

    <meta charset="UTF-8">
    <title>Master Schedule</title>
    <link rel="stylesheet" href="MasterStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>
  <body>
    <nav class ="menu1">
            <a class ="toggle-nav" href ="#"></a>
            <ul>
                <li class = "HG"><a href="index.html"
                      class="HGLink">
                      <h1>HOGWARTS UNIVERSITY</h1>
                    </a></li>
                    </ul>
                </nav>

        <form action=" " method="post" enctype="multipart/form-data">
            <h1>MASTER SCHEDULE</h1>
                <select name="Semester_Id">
                    <option value="sas "> Select a Semester</option>
                    <option value='Fall 2017'>Fall 2017</option>
                    <option value='Spring 2018'>Spring 2018</option>
                    <option value='Fall 2018'>Fall 2018</option>
                    <option value='Spring 2019'>Spring 2019</option>
                    <option value='Fall 2019'>Fall 2019</option>
                    <option value='Spring 2020'>Spring 2020</option>
                    <option value='Fall 2020'>Fall 2020</option>
                    <option value='Spring 2021'>Spring 2021</option>
                    <option value='Fall 2021'>Fall 2021</option>
                    <option value='Spring 2022'>Spring 2022</option>
                </select>
                <input class="btn btn-dark signinbtn" type="submit" name="semesterbtn" value="Select Semester">

                    </form> 
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
                        <th width="96">Semester Year</th>
                        <th width="96">Room Number</th>
                        <th width="96">Building Name</th>
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

            

            $sql = "SELECT CRN, Section, Course_Id, Course_Name, Department_Name, Day, Start_Time, End_Time, Semester_Year, Building, Room_Number, Professor_First_Name, Professor_Last_Name, Available_Seats, Total_Seats  FROM Masterschedulefull ";


            

            $result=$conn-> query($sql);

            if (isset($_POST['semesterbtn'])) {
                $selectedSem=ucfirst($_POST['Semester_Id']);
               while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>".$row["CRN"]."</td><td>"
                        .$row["Section"]."</td><td>"
                        .$row["Course_Id"]."</td><td>"
                        .$row["Course_Name"]."</td><td>"
                        .$row["Department_Name"]."</td><td>"
                        .$row["Day"]."</td><td>"
                        .$row["Start_Time"]."</td><td>"
                        .$row["End_Time"]."</td><td>"
                        .$row["Semester_Year"]."</td><td>"
                        .$row["Building"]."</td><td>"
                        .$row["Room_Number"]."</td><td>"
                        .$row["Professor_First_Name"]."</td><td>"
                        .$row["Professor_Last_Name"]."</td><td>"
                        .$row["Available_Seats"]."</td><td>"
                        .$row["Total_Seats"]."</td></tr>" ;
               }

               echo "</table>";   
            }
            else {
                echo "0 result";
            }

            
                  $conn-> close();
            ?>
                
        </tbody>
        </table>
        
        <a href='#'>Back to top</a>
</body>
</html>