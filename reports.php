<?php
session_start();

require "dbOrderHistory.php";

if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != 1) {
    header("Location: login.php");
    exit();
}
$sqlOrders = "SELECT COUNT(*) AS totalOrders FROM orderhistory";
$resultOrders = mysqli_query($con, $sqlOrders);
$rowOrders = mysqli_fetch_assoc($resultOrders);
$totalOrders = $rowOrders["totalOrders"];

$sqlSales = "SELECT SUM(total) AS totalSales FROM orderhistory";
$resultSales = mysqli_query($con, $sqlSales);
$rowSales = mysqli_fetch_assoc($resultSales);
$totalSales = $rowSales["totalSales"];

$sqlUsers = "SELECT COUNT(*) AS totalUsers FROM users";
$resultUsers = mysqli_query($con, $sqlUsers);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$totalUsers = $rowUsers["totalUsers"];

$sqlProducts = "SELECT COUNT(*) AS totalProducts FROM products";
$resultProducts = mysqli_query($con, $sqlProducts);
$rowProducts = mysqli_fetch_assoc($resultProducts);
$totalProducts = $rowProducts["totalProducts"];

$sqlBestProduct = "SELECT products.id, products.name, SUM(orderitems.quantity) AS totalSold
FROM orderitems
JOIN products
ON orderitems.productId = products.id
GROUP BY products.id, products.name
ORDER BY totalSold DESC
LIMIT 1
";
$resultBestProduct = mysqli_query($con, $sqlBestProduct);
$bestProduct = mysqli_fetch_assoc($resultBestProduct);

$sqlLeastProduct = "SELECT products.id, products.name, SUM(orderitems.quantity) AS totalSold
FROM orderitems
JOIN products
ON orderitems.productId = products.id
GROUP BY products.id, products.name
ORDER BY totalSold ASC
LIMIT 1
";
$resultLeastProduct = mysqli_query($con, $sqlLeastProduct);
$leastProduct = mysqli_fetch_assoc($resultLeastProduct);

$sqlOrdersPerUser = "SELECT users.email, orderhistory.userId, COUNT(*) AS ordersCount
                     FROM orderhistory
                     JOIN users
                     ON orderhistory.userId = users.id
                     GROUP BY orderhistory.userId, users.email";
$resultOrdersPerUser = mysqli_query($con, $sqlOrdersPerUser);
$sqlTopUser = "SELECT users.email, orderhistory.userId, COUNT(*) AS ordersCount
               FROM orderhistory
               JOIN users
               ON orderhistory.userId = users.id
               GROUP BY orderhistory.userId, users.email
               ORDER BY ordersCount DESC
               LIMIT 1";          
$resultTopUser = mysqli_query($con, $sqlTopUser);
$topUser = mysqli_fetch_assoc($resultTopUser);

$sqlDailySales = "SELECT buyDate, SUM(total) AS dailySales FROM orderhistory GROUP BY buyDate ORDER BY buyDate DESC";
$resultDailySales = mysqli_query($con, $sqlDailySales);


$sqlMonthlySales = "SELECT DATE_FORMAT(buyDate, '%Y-%m') AS salesMonth, SUM(total) AS monthlySales
 FROM orderhistory GROUP BY DATE_FORMAT(buyDate, '%Y-%m') ORDER BY salesMonth DESC";
$resultMonthlySales = mysqli_query($con, $sqlMonthlySales);


?>
<h1>Reports</h1>

<h3>Total Orders: <?php echo $totalOrders; ?></h3>
<h3>Total Sales: <?php echo $totalSales; ?></h3>
<h3>Total Users: <?php echo $totalUsers; ?></h3>
<h3>Total Products: <?php echo $totalProducts; ?></h3>
<h3>Best Selling Product:<?php echo $bestProduct["name"]; ?> </h3>
<h3>Quantity Sold:<?php echo $bestProduct["totalSold"]; ?></h3>
<h3>Least Selling Product:<?php echo $leastProduct["name"]; ?></h3>

<h3>Quantity Sold:<?php echo $leastProduct["totalSold"]; ?></h3>
<h2>Orders Per User:</h2>

<?php while ($row = mysqli_fetch_assoc($resultOrdersPerUser)) { ?>

    <p>
        <?php echo $row["email"]; ?>
        :
        <?php echo $row["ordersCount"]; ?>
    </p>

<?php } ?>
<h3>Top User: <?php echo $topUser["email"]; ?></h3>
<h3>Orders Count: <?php echo $topUser["ordersCount"]; ?></h3>  
<h2>Daily Sales</h2>
<?php while ($day = mysqli_fetch_assoc($resultDailySales)) { ?>
<p>
<?php echo $day["buyDate"]; ?>
:
<?php echo $day["dailySales"]; ?>
</p>
<?php } ?>
    <h2>Monthly Sales</h2>
<?php while ($month = mysqli_fetch_assoc($resultMonthlySales)) { ?>

    <p>
        <?php echo $month["salesMonth"]; ?>
        :
        <?php echo $month["monthlySales"]; ?>
    </p>

<?php } ?>



<?php while ($userOrders = mysqli_fetch_assoc($resultOrdersPerUser)) { ?>

    <p>
        <?php echo $userOrders["userEmail"]; ?>
        :
        <?php echo $userOrders["ordersCount"]; ?>
        orders
    </p>

<?php } ?>