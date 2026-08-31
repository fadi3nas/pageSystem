<?php
session_start();
require "db.php";

$id = $_GET["id"];

$sql = "UPDATE notifications
        SET isRead = 1
        WHERE id = '$id'
        AND isAdminNotification = 1";

mysqli_query($con, $sql);

header("Location: adminNotifications.php");
exit();
?>