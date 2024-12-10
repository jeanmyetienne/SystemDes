<!DOCTYPE html>
<html lang="en">
<?php
include 'header_footer.php';
session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "Admin") {
//         header("Location: index.php");
//     }
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: index.php");
// }
htmlheader();
?>
<head>


    <meta charset="UTF-8">
    <title>Catalog</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    
    </head>
  <body>
<!--     <nav class ="menu1">
            <a class ="toggle-nav" href ="#"></a>
            <ul>
                <li class = "HG"><a href="index.html"
                      class="HGLink">
                      <h1>HOGWARTS UNIVERSITY</h1>
                    </a></li>
                    </ul>
                </nav>
 -->
     <div style="height:950px; width: auto; overflow-y: scroll;">
            <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th width="75" scope="col">Course ID</th>
                        <th width="75" scope="col">Course Name</th>
                        <th width="115" scope="col">Course Credit</th>
                        <th width="96" scope="col">Major Name</th>
                        <th width="96" scope="col">Department Name</th>
                    </tr>
                    </thead>

    <tbody>               
 
       <?php
            require_once 'Includes/dbhinc.php';
            $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

            if ($conn->connect_error) { 
                die("Connection failed: " . $conn-> connect_error); 
            } 

            $sql = "SELECT Course_ID, Course_Name, Course_Credit, Major, Dept_Name  FROM Courses";
            $result=$conn-> query($sql);

            if ($result -> num_rows > 0) {
               while ($row = $result -> fetch_assoc()) {
                    echo "<tr><td>"
                    .$row["Course_ID"]."</td><td>"
                    .$row["Course_Name"]."</td><td>"
                    .$row["Course_Credit"]."</td><td>"
                    .$row["Major"]."</td><td>"
                    .$row["Dept_Name"]."</td></tr>";
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