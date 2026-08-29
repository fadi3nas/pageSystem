<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];
$productId = $_POST["productId"];
$rating = $_POST["rating"];
$reviewText = $_POST["reviewText"];
$reviewDate = date("Y-m-d");

$sql = "INSERT INTO reviews
        (userId, productId, rating, reviewText, reviewDate)
        VALUES
        ('$userId', '$productId', '$rating', '$reviewText', '$reviewDate')";

mysqli_query($con, $sql);

header("Location: productDetails.php?id=$productId");
exit();
?>