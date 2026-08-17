<?php
session_start();

require "dbOrderHistory.php";

$orderId = $_POST["orderId"];
$status = $_POST["status"];

$sql = "UPDATE orderhistory
        SET status = '$status'
        WHERE id = '$orderId'";

mysqli_query($con, $sql);

echo "success";
?>