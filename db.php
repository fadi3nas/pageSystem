<?php   
$dservername = "localhost";
$dusername = "root";
$dpassword = "";
$dbname = "pagedb";

$con=mysqli_connect($dservername,$dusername,$dpassword,$dbname);
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>