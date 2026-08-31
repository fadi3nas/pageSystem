<?php
session_start();
require "db.php";

$sqlNewOrders = "SELECT COUNT(*) AS newOrders
                 FROM orderhistory
                 WHERE status = 'Pending'";

$resultNewOrders = mysqli_query($con, $sqlNewOrders);
$rowNewOrders = mysqli_fetch_assoc($resultNewOrders);
$newOrders = $rowNewOrders["newOrders"];

$sqlUnread = "SELECT COUNT(*) AS unreadNotifications
              FROM notifications
              WHERE isAdminNotification = 1
              AND isRead = 0";

$resultUnread = mysqli_query($con, $sqlUnread);
$rowUnread = mysqli_fetch_assoc($resultUnread);
$unreadNotifications = $rowUnread["unreadNotifications"];

$sqlLowStock = "SELECT COUNT(*) AS lowStock
                FROM products
                WHERE quantity > 0
                AND quantity <= 5
                AND isDeleted = 0";

$resultLowStock = mysqli_query($con, $sqlLowStock);
$rowLowStock = mysqli_fetch_assoc($resultLowStock);
$lowStock = $rowLowStock["lowStock"];

$sqlOutStock = "SELECT COUNT(*) AS outStock
                FROM products
                WHERE quantity = 0
                AND isDeleted = 0";

$resultOutStock = mysqli_query($con, $sqlOutStock);
$rowOutStock = mysqli_fetch_assoc($resultOutStock);
$outStock = $rowOutStock["outStock"];
?>
<!DOCTYPE html>
<html>
    <header>
     <style>
      h1,h3{text-align:center;
                }
      h2{text-align:center;
        text-decoration:underline;}     
        a{padding: 14px 28px;
            color:white;
            background-color:red;
        text-decoration:none;}  
        .admin-button {
    display: inline-block;
    padding: 12px 24px;
    background-color: red;
    color: white;
    text-decoration: none;
}   
      </style>
</header>
<body>
    <h1>Welcome Admin <?php  echo $_SESSION["username"]; ?></h1>
    <h2>Your Information<h2>   
        <h3>Username:<?php echo $_SESSION["username"];?><h3>
        <h3>Email:<?php echo $_SESSION["email"];?><h3>
        <h3>Username:<?php echo $_SESSION["firstName"];?><h3><br><br><br>
            <a href="userReturnInfo.php">View Users List</a>
            <a href="productPage.php">View the products</a>
            <a href="orderHistory.php" class="admin-button">View Order History</a>
            <a href="addCategory.php" class="admin-button">Add Category</a>
            <a href="reports.php" class="admin-button">Reports</a>
            <a href="addCoupon.php" class="admin-button">Coupons</a>
            <a href="wishlist.php"class="admin-button"> My Wishlist</a>
            <a href="notifications.php" class="admin-button">Notifications</a>
            <a href="favorites.php">My Favorites</a><h2>Dashboard</h2>

<h3>New Orders: <?php echo $newOrders; ?></h3>

<h3>Unread Notifications: <?php echo $unreadNotifications; ?></h3>

<h3>Low Stock Products: <?php echo $lowStock; ?></h3>

<h3>Out of Stock Products: <?php echo $outStock; ?></h3>
</body>
</html>
