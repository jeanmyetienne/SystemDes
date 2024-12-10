<!doctype html>
<?php 
    
    include 'phpfunctions.php';
    // if(!isset($_COOKIE['user'])){
    //     header("Location:  $baseURL/homepage/homepage.php"); 
    //     die();
    }

    function createMajorClassArray($majorID){
        if($majorID == 0){

           $toReturn = array(
            "MA2090",
            "CS2511",
            "MA2310",
            "MA2320",
            "MA3030",
            "MA3160",
            "MA3210",
            "MA3330",
            "MA3520",
            "MA4360",
            "MA5120",
            "MA5320"
           );

           
        }
        else if($majorID == 1){

            $toReturn = array(
                "CS2511",
                "CS2510",
                "MA2090",
                "MA2310",
                "MA3030",
                "MA3210",
                "MA4100",
                "CS3620",
                "CS3810",
                "CS3911",
                "CS4100",
                "CS4501",
                "CS4550",
                "CS4720",
                "CS5910"
            );
     
            
         }
         else if($majorID == 2){

            $toReturn = array(
    
                "EL1000",            
                "ED3700",
                "ED3950",
                "ED4050",
                "ED4121",
                "ED4122",
                "ED4200",
                "ED4220",
                "ED5925",
                "EL2206",
                "ML1100",
                "ML1100",
                "MA2090",
                "CP2120",
                "CP2121"            
            );

         }
         else if($majorID == 3){

            $toReturn = array(
    
                "EL1000",
                "VA3100",
                "VA3200",
                "VA4200",
                "VA5200",
                "VA2010",
                "VA2020",
                "VA2030",
                "VA2045",
                "VA2500",
                "VA2510",
                "VA3400",
                "VA2750"  
            );
 
         }
         else if($majorID == 4){

            $toReturn = array(
                "EL1000",
                "PY2010",
                "PY3010",
                "PY4200",     
                "PY3410",
                "PY3420",
                "PY3610",
                "PY3620",
                "PY3020",
                "PY3310"
    
            );
  
         }
         else if($majorID == 5){

            $toReturn = array(
                "EL1000",
                "HI2681",
                "AS2112",
                "HI3091",
                "HI2810",
                "HI4001",
                "HI3610",
                "HI4062"

            );

         }
         else if($majorID == 6){

            $toReturn = array(
                "EL1000",
                "EL2206",
                "EL3500",
                "EL3510",
                "EL3800",
                "EL3561",
                "EL4312",
                "EL4800",         
                "EL4050",
                "EL4040",
                "EL3865",
                "EL4640",
                "EL4650"

            );

         }
         else if($majorID == 7){
    
            $toReturn = array(
                "MA2090",
                "BS2400",
                "BS2401",
                "BS2410",
                "BS2411",
                "CP2120",
                "CP2121",
                "CP2220",
                "CP2221",
                "BS4400",
                "BS4460",
                "BS3400",
                "BS3520",
                "BS4440",
                "BS4470"
                     
            );
            
        }
        return $toReturn;
    }
    function createMinorClassArray($minorID){    
        if ($minorID == -1){
            return array();
        }
        if($minorID == 1){
            return array(
                "CS2511",
                "CS2510",
                "MA2090",
                "MA2310",
                "MA3030",
                "CS3810",
                "CS4501"
            );
        }
        else if($minorID == 0){
            return array(
                "MA2310", 
                "MA2320",
                "MA3030",
                "MA3160",
                "MA3210",
                "MA3330",
                "MA3520",
                "MA4100",
                "MA4510"
            );
        }
        else if($minorID == 2){
            return array(
                "PY2010",
                "PY3010",
                "PY4200"
            );
        }
    }
    // function removeDuplicateCourses($coreCourses, $minorClasses){
    //     $toReturn = array();
    //     for($x = 0; $x < count($coreCourses); $x++){
    //         for($y = 0; $y < count($minorClasses); $y++){

    //             if($minorClasses[$y] == $coreCourses[$x]){
    //                 $minorClasses[$y] = NULL;
    //             }
    //         }
    //     }
    //     for($y = 0; $y < count($minorClasses); $y++){

    //         if($minorClasses[$y] != NULL){
    //             array_push($toReturn, $minorClasses[$y]);
    //         }
    //     }
    //     return $toReturn;

    // }

    function createDegreeClassArray($majorID){
        if($majorID == "\"Mathematics, PhD\""){

           $toReturn = array(
            "MA9000",
            "MA9010",
            "MA9020",
            "MA9030",
            "MA9040"
           );
        }
        else if($majorID == "\"M.S. in Data Science\""){
            $toReturn = array(
                "MA6510",
                "MA6520",
                "CS6010",
                "CS6020",
                "CS6030",
                "CS6110",
                "CS6120",
                "CS7510",
                "CS7910",
                "CS7920",
                "CS7800"
            );
     
         }
         else if($majorID == "\"Adolescence Education: Mathematics (7-12), M.A.T.\""){
    
            $toReturn = array(
                "ED6000",
                "ED6001",
    "ED6002",
    "ED6084",
    "ED6094",
    "ED6092",
    "MA6100",
    "MA6150",
    "MA6200",
    "MA6250",
    "MA6400",
    "MA7500"
            );
         }
         else if($majorID == "\"Mental Health Counseling, M.S.\""){

            $toReturn = array(
                "MH6100",
                "MH6110",
    "MH6120",
    "MH6530",
    "MH6130",
    "MH6140",
    "MH6510",
    "MH6520",
    "MH6540",
    "MH7500",
    "MH6500",
    "MH7100",
    "MH7110",
    "MH7120",
    "MH7130",
    "MH7510",
    "MH7520",
    "MH7530"
            
            );
         }
         else if($majorID == "\"Adolescence Education: English Language Arts (7-12), M.A.T.\""){
    
            $toReturn = array(
                "ED6000",
                "ED6001",
                "ED6002",
                "ED6003",
                "ED6083",
                "ED6083",
                "ED6093",
                "EL6510",
                "EL6520",
                "EL6530",
                "EL6540",
                "EL6550",
                "EL7500"
            );
            
         }
         else if($majorID == "\"Adolescence Education: Biology (7-12), M.A.T.\""){
    
            $toReturn = array(
                
                "ED6000",
                "ED6001",
                "ED6002",
                "ED6003",
                "ED6900",
                "ED6082",
                "ED6092",
                "ED6250",
                "BS6560",
                "BS6590",
                "CP6740"    
            );

         }
         else if($majorID == "\"Biomedical Sciences, PhD\""){

            $toReturn = array(
                "BS9000",
                "BS9010",
                "BS9020",
                "BS9030",
                "BS9040"
   
            ); 
         }
        
        return $toReturn;
    
        }
    // function checkIfThere($classes, $class){
    //     for($x = 0; $x < count($classes); $x++){
    //         if($class == $classes[$x][0]){
    //             return $classes[$x];
    //         }
    //     }

    //     return NULL;

    // }
    // function checkIfThereReverse($classes, $class){
    //     for($x = 0; $x < count($classes); $x++){
    //         if($class == $classes[$x]){
    //             return true;
    //         }
    //     }

    //     return false;

    // }
    
    // function getLibArts($myCourses, $coreCourses, $electives, $minorClasses){
    //     $toReturn = array();
    //     $toCompare =  array();
    //     for($x = 0; $x < count($coreCourses[0]); $x++){
    //         array_push($toCompare, $coreCourses[0][$x]);
    //     }
    //     for($x = 0; $x < count($coreCourses[1]); $x++){
    //         array_push($toCompare, $coreCourses[1][$x]);
    //     }
    //     for($x = 0; $x < count($electives[0]); $x++){
    //         array_push($toCompare, $electives[0][$x]);
    //     }
    //     for($x = 0; $x < count($electives[1]); $x++){
    //         array_push($toCompare, $electives[1][$x]);
    //     }
    //     for($x = 0; $x < count($minorClasses); $x++){
    //         array_push($toCompare, $minorClasses[$x]);
    //     }
        

    //     for($x = 0; $x < count($myCourses); $x++){
    //         if(!checkIfThereReverse($toCompare, $myCourses[$x][0])){
                
    //         array_push($toReturn, $myCourses[$x][0]);
    //         }
    //     }
    //     return $toReturn;
    // }

?>
<html lang="en">

<head>
    
<link rel="stylesheet" href="degreeAudit.css">
<title>
Degree Audit
 </title>
</head>

<body>
<?php 
if($_SESSION['User_Type'] == "Student"){

    $studentID = $_SESSION['User_ID'];
}
else{
    $studentID = $_SESSION['User_ID'];
}
$conn = connectToDB();



//get type

$sql = "SELECT Student_Type FROM Student WHERE User_ID = '$studentID'";
$result = mysqli_query($conn, $sql);
if($result->num_rows == 0){
    echo "Student $studentID does NOT exist.";
    die();
}

$row = $result->fetch_row();
$studentType = $row[0];
$coreCourses = array();
$electives = array();


$majorID = array();
if($studentType == "Undergraduate"){
    //get major classes
    $sql = "SELECT Major_ID FROM Student_Major WHERE Student_ID = '$studentID'";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    while($row = $result->fetch_row()){
        array_push($majorID, $row[0]);
    }
    
    
    for($x = 0; $x < count($majorID); $x++){
        array_push($coreCourses,createMajorClassArray($majorID[$x]));
    if($majorID[$x] == 1){
        array_push($electives, 
        array(
            "CS4200",
            "CS4400",
            "CS4705",
            "CS4710",
            "CS5610",
            "CS5710",
            "CS5730",
            "CS5810")
        );
        
       

    }
    else if($majorID[$x] == 0){
        array_push($electives, 
        array(
            "MA4100",
            "MA4200",
            "MA4510",
            "MA4910",
            "MA4920",
            "MA5230",
            "MA5380",
            "MA5510")
        );

    }
    else{
        array_push($electives, array());
    }
    }
    $minorID = -1;
    $sql = "SELECT Minor_ID FROM Student_Minor WHERE Student_ID = '$studentID'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $row = $result->fetch_row();
        $minorID = $row[0];
        $minorClasses = createMinorClassArray($minorID);
    }

}
else if ($studentType == "Graduate"){
    //get gradProgram
    $sql = "SELECT Program FROM Graduate WHERE Student_ID = '$studentID'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $gradProgram = "\"" . $row[0] . "\"";

    array_push($coreCourses, createDegreeClassArray($gradProgram));
    array_push($majorID, -1);
}


//Get courses the person has

// $sql = "SELECT Class.Course_ID, 
//         Courses.Course_Name, 
//         Class.CRN, 
//         Class.Semester_ID,
//         Semester.Semester_Name,
//         Student_History.Grade,
//         Enrollment.Grade,
//         Courses.Course_Credit
// FROM Enrollment
// LEFT JOIN Class ON Class.CRN = Enrollment.CRN
// LEFT JOIN Courses ON Class.Course_ID = Courses.Course_ID
// LEFT JOIN Semester ON Class.Semester_ID = Semester.Semester_ID
// LEFT JOIN Student_History ON (Student_History.CRN = Enrollment.CRN && Student_History.Student_ID = Enrollment.Student_ID)
// WHERE Enrollment.Student_ID = '$studentID'
// GROUP BY CRN";

// $result = mysqli_query($conn, $sql);
// $myCourses = array();
// while ($row = $result->fetch_row()){
//     array_push($myCourses, $row);

// }



for($y = 0; $y < count($majorID); $y++){

    if($studentType == "Undergraduate"){
        $sql = "SELECT Major_Name FROM Major WHERE Major_ID = " . $majorID[$y];
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $coreCoursesTitle = $row[0];
    }
    else{
        
        $coreCoursesTitle = substr($gradProgram,1, strlen($gradProgram) - 2);
    
    }

$totalCredits = count($coreCourses[$y]) * 4;
$currentCredits = 0;
for($z = 0; $z < count($coreCourses[$y]); $z++){
    $row = checkIfThere($myCourses, $coreCourses[$y][$z]);
    if($row != null){$currentCredits += 4;}
}

echo "
<h2>$coreCoursesTitle Core Courses</h2>
<p>Credits: $currentCredits/$totalCredits</p>
<table>
<thead>
<tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>Grade</th>
    <th>Credits</th>
    <th>Semester</th>   
</tr>
</thead>
<tbody>";
// for($x = 0; $x < count($coreCourses[$y]); $x++){
//     $row = checkIfThere($myCourses, $coreCourses[$y][$x]);
    
//     $color = "red";
    
//     if($row != NULL){
//         if($row[7] == ""){
//             $color = "gray";
//         }
//         if($row[6] == "U"){
//             $color = "red";
//         }
//         else if($row[6] == "S"){
//             $color = "lightgreen";
//         }
//         echo "<tr>
//         ";
//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[0];
//         echo "</td>";
        
//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[1];
//         echo "</td>";
        
//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[7];
//         if($row[7] == ""){
//             echo "~";
//         }
//         echo "</td>";

//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[8];
//         echo "</td>";

//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[4] . " " . $row[5];
//         echo "</td>";
//     }
//     else{
//         echo "<tr>";

//         echo "<td style = 'background-color: $color;'>";
//         echo $coreCourses[$y][$x];
//         echo "</td>";

//         echo "<td style = 'background-color: $color;'>";
//         $sql = "SELECT Course_Name FROM Course WHERE Course_ID = \"" . $coreCourses[$y][$x] . "\"";
//         $result = mysqli_query($conn, $sql);
//         $row = $result->fetch_row();
//         echo $row[0];
//         echo "</td>";

//         echo "<td style = 'background-color: $color;'>";
//         echo "?";
//         echo "</td>";

//         echo "<td style = 'background-color: $color;'>";
//         echo "?";
//         echo "</td>";
        
//         echo "<td style = 'background-color: $color;'>";
//         echo "?";
//         echo "</td>";

//     }
//     echo "
//     </tr>";
// }

// echo "
// </tbody>
// </table>
// ";

// if(count($electives[$y]) > 0){
// $totalCredits = 12;
// $currentCredits = 0;
// for($z = 0; $z < count($electives[$y]); $z++){
//     $row = checkIfThere($myCourses, $electives[$y][$z]);
//     if($row != null){$currentCredits += 4;}
// }

// echo "
// <h2>$coreCoursesTitle Elective Courses (Any 3)</h2>
// <p>Credits: $currentCredits/$totalCredits</p>
// <table>
// <thead>
// <tr>
//     <th>Course ID</th>
//     <th>Course Name</th>
//     <th>Grade</th>
//     <th>Credits</th>
//     <th>Semester</th>   
// </tr>
// </thead>
// <tbody>";
// for($x = 0; $x < count($electives[$y]); $x++){
//     $row = checkIfThere($myCourses, $electives[$y][$x]);
    
//     $color = "red";
    
//     if($row != NULL){
//         if($row[7] == ""){
//             $color = "gray";
//         }
//         if($row[6] == "U"){
//             $color = "red";
//         }
//         else if($row[6] == "S"){
//             $color = "lightgreen";
//         }
//         echo "<tr>
//         ";
//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[0];
//         echo "</td>";
        
//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[1];
//         echo "</td>";
        
//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[7];
//         if($row[7] == ""){
//             echo "~";
//         }
//         echo "</td>";

//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[8];
//         echo "</td>";

//         echo "<td style = 'background-color:  $color;'>";
//         echo $row[4] . " " . $row[5];
//         echo "</td>";
//     }
//     else{
//         echo "<tr>";

//         echo "<td style = 'background-color: $color;'>";
//         echo $electives[$y][$x];
//         echo "</td>";

//         echo "<td style = 'background-color: $color;'>";
//         $sql = "SELECT Course_Name FROM Courses WHERE Course_ID = \"" . $electives[$y][$x] . "\"";
//         $result = mysqli_query($conn, $sql);
//         $row = $result->fetch_row();
//         echo $row[0];
//         echo "</td>";

//         echo "<td style = 'background-color: $color;'>";
//         echo "?";
//         echo "</td>";

//         echo "<td style = 'background-color: $color;'>";
//         echo "?";
//         echo "</td>";
        
//         echo "<td style = 'background-color: $color;'>";
//         echo "?";
//         echo "</td>";

//     }
//     echo "
//     </tr>";
// }

// echo "
// </tbody>
// </table>
// ";
// }
// }

if($minorID != -1){
    $sql = "SELECT Minor_Name FROM Minor WHERE Minor_ID = " . $minorID;
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $minorCoursesTitle = $row[0];

    $totalCredits = count($minorClasses) * 4;
    $currentCredits = 0;
    for($z = 0; $z < count($minorClasses); $z++){
        $row = checkIfThere($myCourses, $minorClasses[$z]);
        if($row != null){$currentCredits += 4;}
    }

    echo "
<h2>$minorCoursesTitle Minor Core Courses</h2>
<p>Credits: $currentCredits/$totalCredits</p>
<table>
<thead>
<tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>Grade</th>
    <th>Credits</th>
    <th>Semester</th>   
</tr>
</thead>
<tbody>";
for($x = 0; $x < count($minorClasses); $x++){
    $row = checkIfThere($myCourses, $minorClasses[$x]);
    
    $color = "red";
    
    if($row != NULL){
        if($row[7] == ""){
            $color = "gray";
        }
        if($row[6] == "U"){
            $color = "red";
        }
        else if($row[6] == "S"){
            $color = "lightgreen";
        }
        echo "<tr>
        ";
        echo "<td style = 'background-color:  $color;'>";
        echo $row[0];
        echo "</td>";
        
        echo "<td style = 'background-color:  $color;'>";
        echo $row[1];
        echo "</td>";
        
        echo "<td style = 'background-color:  $color;'>";
        echo $row[7];
        if($row[7] == ""){
            echo "~";
        }
        echo "</td>";

        echo "<td style = 'background-color:  $color;'>";
        echo $row[8];
        echo "</td>";

        echo "<td style = 'background-color:  $color;'>";
        echo $row[4] . " " . $row[5];
        echo "</td>";
    }
    else{
        echo "<tr>";

        echo "<td style = 'background-color: $color;'>";
        echo $minorClasses[$x];
        echo "</td>";

        echo "<td style = 'background-color: $color;'>";
        $sql = "SELECT Course_Name FROM Courses WHERE Course_ID = \"" . $minorClasses[$x] . "\"";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        echo $row[0];
        echo "</td>";

        echo "<td style = 'background-color: $color;'>";
        echo "?";
        echo "</td>";

        echo "<td style = 'background-color: $color;'>";
        echo "?";
        echo "</td>";
        
        echo "<td style = 'background-color: $color;'>";
        echo "?";
        echo "</td>";

    }
    echo "
    </tr>";
}
echo "
    </tbody>
    </table>
    ";
}




if($studentType == "Undergraduate"){

////$myCourses, $coreCourses, $electives, $minorClasses
$libArts = getLibArts($myCourses, $coreCourses, $electives, $minorClasses);
    $currentCredits = 0;
    for($z = 0; $z < count($libArts); $z++){
        $row = checkIfThere($myCourses, $libArts[$z]);
        if($row != null){$currentCredits += 4;}
    }

    echo "
<h2>Liberal Arts Courses</h2>
<p>Credits: $currentCredits</p>
<table>
<thead>
<tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>Grade</th>
    <th>Credits</th>
    <th>Semester</th>   
</tr>
</thead>
<tbody>";
for($x = 0; $x < count($libArts); $x++){
    $row = checkIfThere($myCourses, $libArts[$x]);
    
    $color = "red";
    
    if($row != NULL){
        if($row[7] == ""){
            $color = "gray";
        }
        if($row[6] == "U"){
            $color = "red";
        }
        else if($row[6] == "S"){
            $color = "lightgreen";
        }
        echo "<tr>
        ";
        echo "<td style = 'background-color:  $color;'>";
        echo $row[0];
        echo "</td>";
        
        echo "<td style = 'background-color:  $color;'>";
        echo $row[1];
        echo "</td>";
        
        echo "<td style = 'background-color:  $color;'>";
        echo $row[7];
        if($row[7] == ""){
            echo "~";
        }
        echo "</td>";

        echo "<td style = 'background-color:  $color;'>";
        echo $row[8];
        echo "</td>";

        echo "<td style = 'background-color:  $color;'>";
        echo $row[4] . " " . $row[5];
        echo "</td>";
    }
    else{
        echo "<tr>";

        echo "<td style = 'background-color: $color;'>";
        echo $libArts[$x];
        echo "</td>";

        echo "<td style = 'background-color: $color;'>";
        $sql = "SELECT Course_Name FROM Courses WHERE Course_ID = \"" . $libArts[$x] . "\"";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        echo $row[0];
        echo "</td>";

        echo "<td style = 'background-color: $color;'>";
        echo "?";
        echo "</td>";

        echo "<td style = 'background-color: $color;'>";
        echo "?";
        echo "</td>";
        
        echo "<td style = 'background-color: $color;'>";
        echo "?";
        echo "</td>";

    }
    echo "
    </tr>";
}

echo "
</tbody>
</table>
";
}
?>

</body>
</html>