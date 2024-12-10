<!doctype html>
            <html>
                <head>
                    <title>HOGWARTS UNIVERTY</title>
                    <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-signal.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/lib/w3-colors-2017.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
     <link rel="stylesheet" href="style.css">
    <script type='text/javascript' src='js/functions.js'> </script>
                </head>

<?php
include 'header_footer.php';
include 'php_functions.php';
session_start();
// //
// if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== "S") {
//     header("Location: ../index.php");
// }
// if (isset($_POST['signout'])) {
//   session_unset();
//   session_destroy();
//   header("Location: ../logout_page.php");
// }

htmlheader_root('w3-white');




$User_ID = $_SESSION['User_ID'];
    $holds = array();
    $sql = "SELECT HOLD_ID, HOLD_TYPE, Student_ID FROM Student_Holds WHERE Student_ID = '$User_ID'";

    $conn = mysqlConnect();
    if ($result = mysqli_query($conn, $sql)) {
        if (!mysqli_num_rows($result) == 0) {
            while ($row = mysqli_fetch_array($result)) {
                $holds [] = $row[1];
            }

            $holds = implode(', ', $holds);
          $_SESSION['message'] = "<div class='w3-container w3-opacity-min w3-pale-red'>
                    <h4>Unable to Register</h4>
                    <p> <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> <b>You have the following hold/holds against your account:</b> $holds </p>
                    </div>";
                    echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
                    header("location: view_sections.php");

          exit();
        }

        else {
            $_SESSION['message'] = "<div class='w3-container w3-opacity-min w3-khaki'>
                    <p> <b>You have no holds against your account</b> </p>
                    </div>";
        }
    }

    else {
    echo "failed " . mysqli_error($conn);
}
mysqli_close($conn);

?>

<br>

<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''?>

</div>

<?php
htmlfooter();

unset($_SESSION['message']);
?>


