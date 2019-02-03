<?php

//xampp server
$dbServerName = "localhost";
$userName = "root";
$password = "";
// $dbName = "splashve_splash";
$dbName = "guests";


//live server
// $dbServerName = "localhost:3306";
// $userName = "splashve_web"; 
// $password = "7ksnUG^yj3w;";
// $dbName = "splashve_guests";

$conn = mysqli_connect($dbServerName, $userName, $password, $dbName);
