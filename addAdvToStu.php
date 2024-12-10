<?php
include 'header_footer.php';
include "php_functions.php";
session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: ../index.php");
// }
// else{
//     if ($_SESSION['usertype'] != "A") {
//         header("Location: ../index.php");
//     }
// }

// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

if (isset($_GET['sname'])) {
    $_SESSION['Student_Name'] = $_GET['sname'];
}

if (isset($_GET['id'])) {
    $_SESSION['Student_ID'] = $_GET['id'];
}


htmlheader_root('w3-white');
?>

        <div class="w3-container">
            <h1>Assign Advisor to Student</h1>
            <div class = "w3-container w3-card-4 w3-brown" style="max-width:400px">
            <h2><?php echo $_SESSION['Student_Name']; ?></h2>
            <h2><?php echo $_SESSION['Student_ID']; ?></h2>

        </div>
            <p>Assign advisor to student:</p>

            <form class="w3-container" id="addMemForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label >Select an advisor:</label>
                <select class="w3-select w3-border" name="Advisor">
                    <?php getAllFaculty(); ?>
                </select>
                <div>
                    <input class="w3-btn w3-brown" type="submit" name="addbutton" value="Assign Advisor" />
                </div>
            </form>
        </div>
        <?php

            $isAssigned = isAssignedAdvisor($_SESSION['stu_id']);

            if (isset($_POST['addbutton'])) {
                $myaddbutton = trim($_POST['addbutton']);
            } else {
                $myaddbutton = '';
            }

            if ($myaddbutton == 'Assign Advisor') {

                if (isset($_POST['advisor'])) {
                    $advisor = trim($_POST['advisor']);
                } else {
                    $advisor = '';
                }

                $advText = '';


                $rtninfo = insertStuAdv($advisor,$_SESSION['stu_id'],$isAssigned);

                if ($rtninfo == "NotAdded") {
                    print "<p style='color: red'>Member Not Added</p>";
                } else {
                    //$sMember = getFLnameByID($_POST['member']);
                    print $rtninfo;
                    print "<p style='color: green'>Member has been Added!";
                }
            }

        ?>

        <div class="w3-container" >
            <h3><b>Current Advisor:</b></h3>
            <table class="w3-table-all w3-margin-top " id="myTable">
                <tr>
                    <th class="w3-center">Advisor Name</th>
                    
                </tr>
                <?php getAdvisorByStuTable($_SESSION['Student_ID']); ?>
            </table>
        </div>
</div>

<?php

htmlfooter();
?>