<?php

 $dbServername = "project1.cdbkarygfry8.us-east-2.rds.amazonaws.com";
 $dbUsername = "admin";
 $dbPassword = "Group463!";
 $dbName = "WebBasedSystem";

 $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if ($conn->connect_error) { 
die("Connection failed: " . $conn->connect_error); 
} 
echo " "; 