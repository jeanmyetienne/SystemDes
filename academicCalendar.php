<!doctype html>
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
    <meta charset="utf-8">
    <title>Hogwarts University</title>
    <link rel="stylesheet" href="academiccalendar.css">
    <link rel="stylesheet" href="../all.css">
    <!-- Bootstrap core CSS -->
    <!-- Bootstrap core CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
    <!-- Bootstrap core CSS -->
    <!-- BOOTSTRAP LIBRARIES -->
    <!-- BOOTSTRAP LIBRARIES -->
 <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@100&family=Cinzel:wght@900&family=Open+Sans+Condensed:wght@700&family=Playfair+Display+SC:ital,wght@1,700&display=swap" rel="stylesheet">

 <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

 <!-- BOOTSTRAP LIBRARIES -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    @@ -29,9 +49,64 @@
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
        <script src="https://kit.fontawesome.com/b559e0b638.js" crossorigin="anonymous"></script>


    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<link rel="icon" href="excellence.ico">








<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

<script src="https://kit.fontawesome.com/b559e0b638.js" crossorigin="anonymous"></script>

<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }


      .arrow
{
  position: relative;
  bottom: -2rem;
  left: 50%;
  margin-left:-20px;
  width: 40px;
  height: 40px;

  /**
   * Dark Arrow Down
   */
  background-image: url( );
  background-size: contain;
}

.bounce {
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-30px);
  }
  60% {
    transform: translateY(-15px);
  }
}


    </style>
<!-- <nav class ="menu1">
            <a class ="toggle-nav" href ="#"></a>
            <ul>
                <li class = "HG"><a href="index.html"
                      class="HGLink">
                      <h1>HOGWARTS UNIVERSITY</h1>
                    </a></li>
                    </ul>
                </nav> -->

<main>
  <div class="container-fluid">
    <div class="row">
        <nav 
        class="col-md-3 col-lg-2 d-md-block .bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">

                <li class="nav-item" style="color: white;" href="javascript:;" data-toggle="collapse"
                        data-target="#reg_dropdown32">
                        <a style="color :white;" class="nav-link active" aria-current="page" href="javascript:void(0);">
                            <span data-feather="users"></span>
                        </a>
                        <ul style="color: green;" id="reg_dropdown32" class="collapse">
            
                        </ul>

                        </ul>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br><br>
                        <br>
                        <br>
                        

                </ul>

        </nav>


<main class="col-md-11 ms-sm-auto col-lg-10 px-md-4 left">
<br>
<h1> Hogwarts University Academic Calendar- FALL 2021</h1>
<br>
      <div style="height:900px; width: auto; overflow-y: scroll;">
        <table class="table table-striped table-light">
        <thead>
            <tr>
                <th>Date</th>
                <th>Campus Event</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> September 01 (All Day) 2021 </td>
                <td> First Day Of School </td>
            </tr>
            <tr>
                <td> September 01 (All Day), 2021,  to September 07 (All Day),2021 </td>
                <td>Add or Drop Classes Without Any Fee</td>
            </tr>
            <tr>
                <td> September 02 (In the Afternoon),2021 </td>
                <td>Events to welcome all freshman studnets </td>
            </tr>
            <tr>
                <td> September 06 (All Day),2021 </td>
                <td> Labor Day (No Class) All Office will be close </td>
            </tr>
            <tr>
                <td> September 07 (All Day),2021 </td>
                <td> Last Day to drop with no fee applies </td>
            </tr>
            <tr>
                <td> October 01 (All Day),2021 </td>
                <td> Advising beginning period for semester of Spring 2022 </td>
            </tr>
            <tr>
                <td> October 01 (All Day),2021 </td>
                <td> Graduation Application start </td>
            </tr>
            <tr>
                <td> October 11 (All Day),2021 </td>
                <td> Columbus Day No Class </td>
            </tr>
            <tr>
                <td> October 16 (All Day),2021 </td>
                <td> Midtern Week begins </td>
            </tr>
            <tr>
                <td> October 25 (All Day), 2021 </td>
                <td> Midtern Week finish & Grades are due </td>
            </tr>
            <tr>
                <td> November 1 (All Day), 2021 </td>
                <td> Spring 2022 Registration begin for all Seniors </td>
            </tr>
            <tr>
                <td> November 2 (All Day), 2021 </td>
                <td> Election Day- Class Still In Section </td>
            </tr>
            <tr>
                <td> November 11 (All Day), 2021 </td>
                <td> Veteran Day- Class Still In Section </td>
            </tr>
            <tr>
                <td> November 11 (All Day), 2021 </td>
                <td> Spring Registration begin for all Sophmores </td>
            </tr>
            <tr>
                <td> November 15 (All Day), 2021 </td>
                <td> Spring Registration begin for all Freshmans </td>
            </tr>
            <tr>
                <td> November 16 (All Day), 2021 </td>
                <td> Registration continue for all students </td>
            </tr>
            <tr>
                <td> November 23 (In the Evening), 2021 </td>
                <td> Cantine Halll closed after dinner </td>
            </tr>
             <tr>
                <td> November 25 (All Day), 2021 </td>
                <td> Thanksgiving Break- class is not in section </td>
            </tr>
             <tr>
                <td> November 28 (All Day), 2021 </td>
                <td> Cantine Halll re-open after dinner </td>
            </tr>
             <tr>
                <td> November 29 (All Day), 2021 </td>
                <td>Class Back In Session </td>
            </tr>
             <tr>
                <td> December 08 (All Day), 2021 </td>
                <td>Job Fair In The Campus Center For All Students </td>
            </tr>
             <tr>
                <td> December 14 (All Day), 2021 </td>
                <td> Study and Make up days </td>
            </tr>
             <tr>
                <td>December 16 (All Day), 2021</td>
                <td> FINAL EXAM WEEK BEGINS </td>
            </tr>
             <tr>
                <td> December 18 (All day), 2021 </td>
                <td>Grades Are due</td>
            </tr>
             <tr>
                <td> December 22 (All Day), 2021 </td>
                <td> Fall Semester End.</td>
            </tr>
        </tbody>
    </table>