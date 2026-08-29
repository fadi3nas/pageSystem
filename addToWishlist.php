<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];
$productId = $_POST["productId"];

$sqlCheck = "SELECT * FROM wishlist
             WHERE userId = '$userId'
             AND productId = '$productId'";

$resultCheck = mysqli_query($con, $sqlCheck);

if (mysqli_num_rows($resultCheck) == 0) {

    $sql = "INSERT INTO wishlist
            (userId, productId)
            VALUES
            ('$userId', '$productId')";

    mysqli_query($con, $sql);
}

echo "success";
?>