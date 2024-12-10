<?php
        include 'header_footer.php';
        include 'php_functions.php'; 
        session_start();
        htmlheader_root('w3-white');
?>

<!doctype html>

<html lang="en">
    <head>
        <title>Edit Course Grade For Student</title>
    </head>
    <body>
        <div class = "w3-container">
    <h1>Student Course Grade</h1>

    <h2 class = " w3-text-brown"> <?php echo isset($_POST['StudentID']) ? $_POST['StudentID'] : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_POST['CourseGrade']) ? $_POST['CourseGrade'] : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_POST['CRN']) ? $_POST['CRN'] : ''?> </h2>
</div>
       
        <?php
        include 'header_footer.php';
        include 'php_functions.php'; 
        session_start();
        htmlheader_root('w3-white');
   // $dbServername = "project1.cdbkarygfry8.us-east-2.rds.amazonaws.com";
   //      $dbUsername = "admin";
   //      $dbPassword = "Group463!";
   //      $dbName = "WebBasedSystem";

   //      $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
   //          // Check connection
   //      if ($conn->connect_error) {
   //          die("Connection failed: " . $conn->connect_error);
   //      }

            $studentID = $_POST['StudentID'];
            $CRN = $_POST['CRN'];
            $courseGrade = $_POST['CourseGrade'];
            
            $faculyID = $_COOKIE['userID'];
            $userType = $_COOKIE['userType'];
            $date = date("Y-m-d");
            $conn = connectToDB();

     

            //check if the student ID provided exists:
            $sql = "SELECT * FROM Student WHERE Student.Student_ID = '{$_POST['StudentID']}' ";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows >= 0){
                echo "Student $studentID does NOT exist.";
                die();
            }

       

            //check if the CRN exists:
            $sql = "SELECT * FROM Courses WHERE CRN = '$CRN' ";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows == 0){
                echo "Section with CRN $CRN does NOT exist.";
                die();
            }

            // //check if student is taking class with CRN provided:
            $sql = "SELECT * FROM Enrollment WHERE Enrollment.Student_ID = '$studentID' AND Enrollment.CRN = '$CRN' ";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows ==0){
                echo "Student $studentID is NOT currently registered to class with CRN $CRN.";
                die();
            }

            if($userType == "Faculty"){

                //check if the faculty is teaching the class with CRN provided:
                $sql = "SELECT * FROM Courses WHERE Faculty_ID = '$faculyID' AND CRN = '$CRN' ";
                $result = mysqli_query($conn, $sql);
                if($result->num_rows ==0){
                    echo "You cannot change provided student's grade since you do NOT teach the class with CRN $CRN.";
                    die();
                }

                //check if the update grade window is open:
                $sql = "SELECT Semester.Start_Date, Semester.End_Date FROM Semester
                        INNER JOIN Courses ON Semester.Semester_ID = Courses.Semester_ID
                        WHERE Courses.CRN = '$CRN' ";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_row();
                $windowStart = $row[0];
                $windowEnd = $row[1];
                
                if(time() < strtotime($windowStart) || time() >= strtotime($windowEnd)){
                    echo "Could not update Grade of student $studentID because the update grade window is not open yet or has ended. Window Start
                            Date is: $windowStart and Window End Date is: $windowEnd. Today's date is: $date.";
                    die();
                }
            }
            //if user is admin, check if the section is in fall 2021, if so, cannot change grade:
            if($userType == "Admin"){
                $sql = "SELECT Enroll_Date FROM Enrollment WHERE Student_ID = '$studentID' AND CRN = '$CRN' ";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_row();
                if($row[0] > $date){
                    echo "Cannot change grade for student: $studentID for class with CRN: $CRN because the class has not yet started. 
                    <br></br>
                    The class starts on $row[0], today's date is: $date";
                    die();
                }
            }
            //see if wether grade is null
            $sql = "SELECT Grade
                    FROM Enrollment
                    WHERE Enrollment.Student_ID = '$studentID' AND Enrollment.CRN = '$CRN'";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();
            
            $isNull = false;
            if($row[0] == ""){
                $isNull = true;
            }


            //Update the course grade of provided student:
            $sql = "UPDATE Enrollment
                    SET Grade = '$courseGrade'
                    WHERE Enrollment.Student_ID = '$studentID' AND Enrollment.CRN = '$CRN' ";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo "Could Not set the grade $courseGrade for Student $studentID for class with CRN $CRN.";
            }
            else{
                echo "Updated course grade of student $studentID to $courseGrade for class with CRN $CRN successfully!";
            }


            //update credit amount
            if($courseGrade != "F" && $courseGrade != "D" && $isNull == true){
            $sql = "SELECT Courses.Course_Credit FROM Courses
                    LEFT JOIN Courses ON Courses.Course_ID = Class.courseID
                    WHERE Class.CRN = '$CRN' ";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();

            $sql = "UPDATE Student
                    SET CREDITS_EARNED = CREDITS_EARNED + " . $row[0] . "
                    WHERE Student_ID = '$studentID' ";
            $result = mysqli_query($conn, $sql);

            }
            setGPA($conn, $studentID);
            die();
        ?>
       
    
    </body>
<div class = "w3-container">
    <h1>Student Course Grade</h1>

    <h2 class = " w3-text-brown"> <?php echo isset($_POST['StudentID']) ? $_POST['StudentID'] : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_POST['CourseGrade']) ? $_POST['CourseGrade'] : ''?> </h2>

    <h2 class = " w3-text-brown"> <?php echo isset($_POST['CRN']) ? $_POST['CRN'] : ''?> </h2>
</div>
</html>
<?php
htmlfooter();
?>