<?php
session_start();

require "db.php";

$email = $_SESSION["email"];
$productId = $_POST["productId"];

$sql = "INSERT INTO favorites (userEmail, productId)
        VALUES ('$email', '$productId')";

mysqli_query($con, $sql);

echo "success";
?>