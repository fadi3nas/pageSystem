<?php
session_start();

require "db.php";

$email = $_SESSION["email"];
$productId = $_POST["productId"];

$sql = "DELETE FROM favorites
        WHERE userEmail = '$email'
        AND productId = '$productId'";

mysqli_query($con, $sql);

echo "success";
?>