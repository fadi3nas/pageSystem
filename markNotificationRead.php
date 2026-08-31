<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];
$id = $_GET["id"];

$sql = "UPDATE notifications
        SET isRead = 1
        WHERE id = '$id'
        AND userId = '$userId'";

mysqli_query($con, $sql);

header("Location: notifications.php");
exit();
?>