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

if (isset($_POST['assign_minor'])) {
    $student_id = $_POST['assign_minor'];

    $conn = mysqlConnect();
    $sql1 = "SELECT first_name, last_name, date_of_birth, Email, Zipcode, User_ID FROM Users
    INNER JOIN User_Login on User_Login.User_ID = Users.User_ID
     WHERE Users.User_ID = $student_id";
    if ($result = mysqli_query($conn, $sql1)) {
        while ($row = mysqli_fetch_array($result)) {
                    $student_name = $row[0] . ' ' . $row[1];
                    $first_name = $row [0];
                    $last_name = $row[1];
                    $dob = $row[2];
                    $email = $row[3];
                    $Zipcode = $row[4];
                    $user_id = $row[5];
        }
    }
    else {
        echo "failed " . mysqli_error($conn);
    }

    $sql2 = "INSERT INTO Student_Minor (Minor_ID, Student_ID) VALUES ($minor_id, $student_id)";
    if (mysqli_query($conn, $sql2)) {
        $_SESSION['table'] = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Assign Minor </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Zipcode  </th>
                                    <th> User ID </th>
                                </tr>
                                </thead>
                                <tr>
                                <td> <span class='w3-tag w3-teal w3-round'>Assigned</span> </td>  
                                <td>$first_name</td>
                                <td>$last_name</td>
                                <td>$dob</td>
                                <td>$email</td>
                                <td>$Zipcode</td>
                                <td>$user_id</td>
                                </tr> <br>";
        $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                                <h3>Success</h3>
                                <p>$minor_name assigned to $student_name</p>
                                </div>";
        header('location: minor_student.php');
        exit();
    }
    else {
        echo "Couldn't assign minor " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

if (isset($_POST['remove_minor'])) {
    $student_id = $_POST['remove_minor'];

    $conn = mysqlConnect();
   $sql1 = "SELECT first_name, last_name, date_of_birth, Email, Zipcode, User_ID FROM Users
    INNER JOIN User_Login on User_Login.User_ID = Users.User_ID
     WHERE User_ID = '$student_id'";
    if ($result = mysqli_query($conn, $sql1)) {
        while ($row = mysqli_fetch_array($result)) {
                    $student_name = $row[0] . ' ' . $row[1];
                    $first_name = $row [0];
                    $last_name = $row[1];
                    $dob = $row[2];
                    $email = $row[3];
                    $Zipcode = $row[4];
                    $user_id = $row[5];
        }
    }
    else {
        echo "failed " . mysqli_error($conn);
    }

    $sql2 = "DELETE FROM Student_Minor WHERE Minor_ID = '$minor_id' AND Student_ID = '$student_id'";
    if (mysqli_query($conn, $sql2)) {
        $_SESSION['table'] = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Assign Minor </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> Email </th>
                                    <th> Zipcode  </th>
                                    <th> User ID </th>
                                </tr>
                                </thead>
                                <tr>
                                <td> <span class='w3-tag w3-red w3-round'>Removed</span> </td>  
                                <td>$first_name</td>
                                <td>$last_name</td>
                                <td>$dob</td>
                                <td>$email</td>
                                <td>$Zipcode</td>
                                <td>$user_id</td>
                                </tr> <br>";
        $_SESSION['message'] = "<div class='w3-container w3-pale-green'>
                                <h3>Success</h3>
                                <p>$minor_name withdrawn from $student_name</p>
                                </div>";
        header('location: minor_student.php');
        exit();
    }
    else {
        echo "Couldn't assign minor " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

htmlheader_root('w3-white');

?>

<br>
    <div class = "w3-container">
       <h2 class = " w3-text-dark-grey"> <?php echo isset($_SESSION['Minor_Name']) ? $_SESSION['Minor_Name'] : ''?> </h2>
    </div>
        <h4 style = "margin-left:15px"> Search Student Account To Assign Minor</h4>
        <div class="w3-container">
             <form action = "?" method = "post">
                <input class = "w3-round login w3-padding-medium" type = "number" placeholder="Search By Student ID" id = "search_user_ID" name = "search_user_ID">
                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By First Name" id = "search_first_name" name = "search_first_name">
                <input class = "w3-round login w3-padding-medium" type = "text" placeholder="Search By Last Name" id = "search_last_name" name = "search_last_name"> <br />
                <input class="w3-btn w3-brown w3-section" type="submit" name = "submit" value = "Search User">
            </form>
        </div>
 <?php

     //echo isset($resultTable) ? $resultTable : ''
     echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
     echo isset($_SESSION['table']) ? $_SESSION['table'] : '';

?>

 <?php
    if (isset($_POST['submit'])) {
        $user_id = $_POST['search_user_ID'];
        $first_name = trim($_POST['search_first_name']);
        $last_name = trim($_POST['search_last_name']);
        $searchFields = array();
        if ($user_id !== "") {
            $searchFields['User_ID'] = $_POST['search_user_ID'];
        }

        if ($first_name !== "") {
            $searchFields['first_name'] = $_POST['search_first_name'];
        }

        if ($last_name !== "") {
            $searchFields['last_name'] = $_POST['search_last_name'];
        }
        if ($first_name !== "" && $last_name !== "") {
            $searchFields['full_name'] = $first_name . ' ' . $last_name;
        }

        foreach($searchFields as $key => $value) {
            if ($value !== "") {
                switch ($key) {
                case 'User_ID':
                    $sql = "SELECT User_ID, first_name, last_name, date_of_birth FROM Users WHERE User_ID = '$value'";
                    break;

                case 'first_name':
                    $sql = "SELECT User_ID, first_name, last_name, date_of_birth FROM Users WHERE first_name = '$value'";
                    break;

                case 'last_name':
                    $sql = "SELECT User_ID, first_name, last_name, date_of_birth FROM Users WHERE last_name = '$value'";
                    break;
                }
            }
        }
    

    // }
    if (isset($searchFields['user_id']) && isset($searchFields['first_name'])) {
        echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Can't combine Student_ID With First or Last Name</p>
                        </div>";
    }
    else if (isset($searchFields['user_id']) && isset($searchFields['last_name'])) {
        echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Can't combine Student_ID With First or Last Name</p>
                        </div>";
    }

    //if (sizeof($searchFields) == 1) {
    else {
        $conn = mysqlConnect();
        $result = mysqli_query($conn, $sql);
        if (!mysqli_num_rows($result) == 0) {

                $resultTable = "<div class='w3-container'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = '?' method = 'post'>
                               <thead>
                                <tr class='w3-grey'>
                                    <th> Assign Minor </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Date Of Birth </th>
                                    <th> User ID </th>
                                </tr>
                                </thead>
                                ";
                while ($row = mysqli_fetch_array($result)) {
                    //<td><input type = 'checkbox' name = 'checkbox[]' value = $row[0]> <a href = 'account_info.php?account=$row[0]'> $row[0] </a></td>
                    //$sql2 = "SELECT * from student_major WHERE major_id = $major_id AND student_id = $row[0]";
                    //$result2 = mysqli_query($conn, $sql2);
                        if ($row[7] == $minor_id) {
                        //$input = "<span class='w3-tag w3-teal w3-round'>Assigned</span>";
                        $input = "<button class='w3-btn w3-ripple w3-khaki w3-round w3-padding-small' name = 'remove_minor' value = $row[0]>Remove</button>";
                        
                    }
                    else {
                        $input = "<button class='w3-btn w3-ripple w3-khaki w3-round w3-padding-small' name = 'assign_minor' value = $row[0]>Assign</button>";
                    }
                    $resultTable.= "<tr>
                                <td>$input</td>  
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td>$row[5]</td>
                                </tr>";
                }
                $resultTable.= "</table></form></div>";
                echo ($resultTable);
            
        }
        else {
            echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Account Doesn't Exist</p>
                        </div>";
        }

        mysqli_close($conn);
    }
    /**else
    if (sizeof($searchFields) > 1) {
         echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Search can be performed by one field only</p>
                        </div>";
    }
    else
    if (sizeof($searchFields) == 0) {
        echo "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Please fill in one of the fields for search</p>
                        </div>";
    }**/

}


?>
   
    </div>

<?php
htmlfooter();
unset($_SESSION['message']);
unset($_SESSION['table']);
?>