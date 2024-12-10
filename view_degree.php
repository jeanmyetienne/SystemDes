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

$conn = mysqlConnect();
$sql1 = "SELECT Dept_ID, Dept_Name from Department";
$sql2 = "SELECT Minor_ID, Minor_Name from Minor";
$departments = "";
$degrees = "";
if ($result = mysqli_query($conn, $sql1)) {
    while ($row = mysqli_fetch_array($result)) {
        $departments .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
if ($result = mysqli_query($conn, $sql2)) {
    while ($row = mysqli_fetch_array($result)) {
        $degrees .= "<option value = $row[0]> $row[1] </option>";
    }
}
else {
    echo "failed " . mysqli_error();
}
mysqli_close($conn);


$conn = mysqlConnect();
$sql = "SELECT Minor_Name, Dept_Name, Minor_ID, Dept_ID FROM Minor";
if ($result = mysqli_query($conn, $sql)) {
                $resultTable = "<div class='w3-container' id='major_table'>
                               <table class='w3-table-all w3-hoverable'>
                               <form action = 'degree_info.php' method = 'get'>
                               <thead>
                                <tr class='w3-light-grey'>
                                    <th> Minor Name </th>
                                    <th> Department Name </th>
                                    <th> Minor ID </th>
                                </tr>
                                </thead>
                                ";
                while ($row = mysqli_fetch_array($result)) {
                    $resultTable.= "<tr>
                                <td><a href = 'minor_info.php?Minor=$row[2]'> $row[0] </a></td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                </tr>";
                }
                $resultTable .= "</form></table></div>";
       }
       else {
           $resultTable = "<div class='w3-container w3-red'>
                        <h3>Failed</h3>
                        <p>Couldn't connect to the server</p>
                        </div>";
       }
mysqli_close($conn);

htmlheader_root('w3-white');
?>


    <h1 style="margin-left:15px">View Minor</h1>
        <form class="w3-container" action = "?" method = "post" id = "degreeForm">
    <div class="w3-section">


      <!--  <label style="font-size:130%;"> Search By Degree </label>
        <select id = "degree" name="degree">
        <option value="All">All</option>
        
        </select>-->
    </div>
    </form>

   <?php echo isset($resultTable) ? $resultTable : ''?>

<script>
    window.onload = function() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    var degree = document.getElementById('degree');
    var department = document.getElementById('department');

    department.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("major_table").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../ajax_requests.php?department="+department.value,true);
        xmlhttp.send();
    });

    /**degree.addEventListener('change', function() {
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("major_table").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../ajax_requests.php?major_degree="+degree.value,true);
        xmlhttp.send();
    });**/

     

    }
 </script>

</div>

<?php
htmlfooter();
?>
