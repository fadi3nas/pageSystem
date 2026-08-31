<?php
session_start();
require "db.php";

$sql = "SELECT * FROM notifications
        WHERE isAdminNotification = 1
        ORDER BY createdAt DESC";

$result = mysqli_query($con, $sql);

$sqlUnread = "SELECT COUNT(*) AS unreadCount
              FROM notifications
              WHERE isAdminNotification = 1
              AND isRead = 0";

$resultUnread = mysqli_query($con, $sqlUnread);
$unread = mysqli_fetch_assoc($resultUnread);
?>
<h3>
    Unread Notifications:
    <?php echo $unread["unreadCount"]; ?>
</h3>

<h2>Admin Notifications</h2>
<a href="markAllAdminNotificationsRead.php">
    Mark all as Read
</a>
<?php while ($notification = mysqli_fetch_assoc($result)) { ?>

    <p>
        <?php echo $notification["message"]; ?>
    </p>

    <p>
        <?php echo $notification["createdAt"]; ?>
    </p>

    <?php if ($notification["isRead"] == 0) { ?>

    <a href="markAdminNotificationRead.php?id=<?php echo $notification["id"]; ?>">
        Mark as Read
    </a>

<?php } ?>
    <hr>

<?php } ?>