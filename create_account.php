<?php
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

 if(isset($_POST['usertype'])) {
        $_SESSION['User_Type'] = $_POST['usertype'];
        header("Location: create_user_account.php");
    }

htmlheader('w3-white');
?>



    <div class = "w3-container">
    <h2> Create User Account </h2>
    <p> Select the user account category to add </p>
    </div>

    <form class="w3-container" action = "?" method = "post" id = "loginForm">
    <div class="w3-section">
        <select name="usertype">
        <option value="Admin">Admin</option>
        <option value="Student">Student</option>
        <option value="Faculty">Faculty</option>
        <option value="Research Staff">Research Staff</option>
        </select> <br>
        <input class="w3-btn w3-brown w3-section" type="submit" name = "submit" value = "Go">
    </div>
    </form>
   
	</body>
</html>

<?php
htmlfooter();
?>