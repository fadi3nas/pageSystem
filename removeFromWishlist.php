<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];
$productId = $_POST["productId"];

$sql = "DELETE FROM wishlist
        WHERE userId = '$userId'
        AND productId = '$productId'";

mysqli_query($con, $sql);
echo "success";
?>