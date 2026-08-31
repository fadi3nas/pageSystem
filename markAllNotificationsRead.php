<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];

$sql = "UPDATE notifications
        SET isRead = 1
        WHERE userId = '$userId'";

mysqli_query($con, $sql);

header("Location: notifications.php");
exit();
?>