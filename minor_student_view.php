<?php
include 'header_footer.php';
include 'php_functions.php';

session_start();

// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "A") {
//     header("Location: ../index.php");
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

$minor_id = $_SESSION['Minor_ID'];
$minor_name = $_SESSION['Minor_Name'];

	$conn = mysqlConnect();
	$sql1 = "SELECT Student_Minor.Minor_ID, Student_Minor.Student_ID, Users.first_name, Users.last_name, Users.User_ID, Users.Zipcode  FROM Student_Minor 
    INNER JOIN Student ON Student_Minor.Student_ID = Student.Student_ID 
    INNER JOIN Users ON Users.User_ID = Student.Student_ID 
    WHERE Student_Minor.Minor_ID = '{$_SESSION['Minor_ID']}' ";

    $sql2 = "SELECT COUNT(Minor_ID), Minor_ID FROM Student_Minor WHERE Minor_ID = '{$_SESSION['Minor_ID']}' ";

     if ($result = mysqli_query($conn, $sql1)) {

        if (!mysqli_num_rows($result) == 0) {
            $resultTable = "<br> <div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-khaki'>
                                    <th> Major </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Zipcode </th>
                                    
                                    <th> Student ID </th>
                                </tr>
                                </thead>";
          while ($row = mysqli_fetch_array($result)) {

                    $resultTable .= "<tr>
                        <td> <span class='w3-tag w3-brown w3-round'>Assigned</span> </td>  
                        <td>$row[2]</td>
                        <td>$row[3]</td>
                        <td>$row[5]</td>
                     
                        <td>$row[4]</td>
                        </tr> ";
                }
         }
         else {
             $resultTable = "";
         }
    
}
	else {
		echo "Failed " . mysqli_error($conn);
	}

    if ($result = mysqli_query($conn, $sql2)) {
		while ($row = mysqli_fetch_array($result)) {
            $student_minor_count = $row[0];

        }
	}
	else {
		echo "Failed " . mysqli_error($conn);
	}
	mysqli_close($conn);

htmlheader_root('w3-white');
?>

<br>
  <div class = "w3-container">
    <h2 class = " w3-text-brown"> <?php echo isset($_SESSION['Minor_ID']) ? $_SESSION['Minor_ID'] : ''?> </h2>
    <h3> Students Enrolled In Minor</h3>
  </div>

<div class = "w3-container w3-card-4 w3-brown" style="max-width:210px">
    <h4> <strong> Total Students: <?php echo $student_minor_count ?> </strong> </h4> 
  </div>




 <?php

	 echo isset($resultTable) ? $resultTable : '';
	 echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
	 echo isset($_SESSION['table']) ? $_SESSION['table'] : '';

?>

   
	</div>

<?php
htmlfooter();
unset($_SESSION['message']);
unset($_SESSION['table']);
?>