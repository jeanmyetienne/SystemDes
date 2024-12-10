<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Website Homepage design </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
  <link rel="stylesheet" href="style3.css">
  <link rel="stylesheet" href="../all.css">
</head>
  <header>

  <body> 
 <!--        <nav class ="menu1">
            <a class ="toggle-nav" href ="#"></a>
            <ul>
              <li class = "HG"><a href="index.html"class="HGLink">
                <h1>HOGWARTS UNIVERSITY</h1>
                  </a></li>
            </ul>
        </nav> -->
    <div class="container">
    <h5>CONTACT US</h5>
    
    <div class="login">
      <input type="text" placeholder="Your Name" class="input">
      <input type="text" placeholder="Your Email Address" class="input">
    </div>
    
    <div class="subject">
      <input type="text" placeholder="Subject" class="input">
    </div>
    
    <div class="msg">
      <textarea  class="area" placeholder="Leave a Message"></textarea>
    </div>
    
    <div class="btn">Send Message</div>
  </div>




    <div class = "row">
      <footer class="w3-container w3-row w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-medium w3-hide-small footer">
  <div class='w3-center'>
  <h3>Contact Us</h3>
  <p>354-546-8548</a></p>
  <p><a href = "mailto:anyone@hogwartsuniversity.edu">anyone@hogwartsuniversity.edu</a></p>
  </div>
  <div class='w3-center'>
  <h3>Address</h3>
  <address>
            Hogwarts University<br>5678 Nowhere St<br> Scotland, NY 11965<br>U.S.A.
          </address>
  </div>
</footer>

<!--Footer for small screens-->
<footer class="w3-center w3-row w3-opacity-min w3-hover-opacity-off w3-padding-16 w3-small w3-hide-large footer_small">
  <div class='w3-center'>
  <h3>Contact Us</h3>
  <p>354-546-8548</a></p>
  <p><a href = "mailto:anyone@hogwartsuniversity.edu">anyone@hogwartsuniversity.edu</a></p>
  </div>
  <div class='w3-center'>
  <h3>Address</h3>
  <address>
            Hogwarts University<br>5678 Nowhere St<br> Scotland, NY 11965<br>U.S.A.
          </address>
  </div>
</footer>
      <!-- <aside class = "col-3">
          <br>
          <h3>General Information</h3>

          <h4>Main Phone Number</h4>
          <p><a href="tel:555-5555">555-5555</a></p>
          <h4>Main Email</h4>
          <p><a href = "mailto:anyone@hogwartsuniversity.edu">anyone@hogwartsuniversity.edu</a></p>
          <h4>Main Postal Address</h4>
          <address>
            Hogwarts University<br>5678 Nowhere St<br> Scotland, NY 11965<br>U.S.A.
          </address>

      </aside> -->

      <main class ="col-9">

        <h2>VISIT US!</h2>
      

        <!-- <h3>Visit Us</h3> --> <!--In line style ok here-->
        <div id="mapGoogleEmbeded">
          <iframe class = "justify-content-lg-center" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d10026.756032330122!2d-73.57839792492584!3d40.794343796063174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x89c286b9d1a30b3b%3A0x57c0cda29c90ff7c!2sold%20westbury%20college!3m2!1d40.799302499999996!2d-73.5739715!5e0!3m2!1sen!2sus!4v1580490629325!5m2!1sen!2sus" width="600" height="450" frameborder="0" s allowfullscreen="" ></iframe>
        </div>

       
      </main> 

      

    </div>
  </div>

</html>
