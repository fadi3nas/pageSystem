<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];

$sql = "SELECT * FROM notifications
        WHERE userId = '$userId'
        ORDER BY createdAt DESC";

$result = mysqli_query($con, $sql);
$sqlUnread = "SELECT COUNT(*) AS unreadCount
              FROM notifications
              WHERE userId = '$userId'
              AND isRead = 0";

$resultUnread = mysqli_query($con, $sqlUnread);
$unread = mysqli_fetch_assoc($resultUnread);
?>
<h3>
    Unread Notifications:
    <?php echo $unread["unreadCount"]; ?>
</h3>
<a href="markAllNotificationsRead.php">
    Mark all as Read
</a>
<h2>Notifications</h2>

<?php while ($notification = mysqli_fetch_assoc($result)) { ?>


    <p>
        <?php echo $notification["message"]; ?>
    </p>

    <p>
        <?php echo $notification["createdAt"]; ?>
    </p>

    <?php if ($notification["isRead"] == 0) { ?>

    <a href="markNotificationRead.php?id=<?php echo $notification["id"]; ?>">
        Mark as Read
    </a>

<?php } ?>
    <hr>

<?php } ?>