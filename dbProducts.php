<?php   
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "pagedb";

$con=mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>