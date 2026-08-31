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
$adminMessage = "New review added for product #$productId.";

$sqlAdminNotification = "INSERT INTO notifications
                         (userId, message, isAdminNotification)
                         VALUES
                         ('$userId', '$adminMessage', 1)";

mysqli_query($con, $sqlAdminNotification);

header("Location: productDetails.php?id=$productId");
exit();
?>