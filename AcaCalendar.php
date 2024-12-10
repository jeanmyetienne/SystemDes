<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>Catalog</title>
    <link rel="stylesheet" href="AcademicCalendar.css">
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

     <div style="height:950px; width: auto; overflow-y: scroll;">
            <table class="table table-striped table-light">
                <thead>
                    <tr>
                        <th width="500" scope="col">Date</th>
                        <th width="500" scope="col">Events</th>

                    </tr>
                    </thead>

    <tbody>               
 
       <?php
            require_once 'Includes/dbhinc.php';
            $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

            if ($conn->connect_error) { 
                die("Connection failed: " . $conn-> connect_error); 
            } 

            $sql = "SELECT DATE, CAMPUS_EVENTS  FROM Academic_Calendar";
            $result=$conn-> query($sql);

            if ($result -> num_rows > 0) {
               while ($row = $result -> fetch_assoc()) {
                    echo "<tr><td>"
                    .$row["DATE"]."</td><td>"
                    .$row["CAMPUS_EVENTS"]."</td><td>"
                    .$row["Course_Credit"]."</td></tr>";
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