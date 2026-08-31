<?php
session_start();

require "dbOrderHistory.php";

$firstName = $_SESSION["firstName"];
$lastName = $_SESSION["lastName"];
$email = $_SESSION["email"];
$buyDate = date("Y-m-d");
$total = 0;

foreach ($_SESSION["cart"] as $product) {
    $total = $total + ($product["price"] * $product["quantity"]);
}
$userId = $_SESSION["userId"];

$sql = "INSERT INTO orderhistory
        (userId, userFname, userLname, buyDate, userEmail, total)
        VALUES
        ('$userId', '$firstName', '$lastName', '$buyDate', '$email', '$total')";

mysqli_query($con, $sql);


$orderId = mysqli_insert_id($con);
$message = "Your order #$orderId has been created.";

$sqlNotification = "INSERT INTO notifications
                    (userId, message)
                    VALUES
                    ('$userId', '$message')";

mysqli_query($con, $sqlNotification);

    $adminMessage = "New order #$orderId has been created.";

$sqlAdminNotification = "INSERT INTO notifications
                         (userId, message, isAdminNotification)
                         VALUES
                         ('$userId', '$adminMessage', 1)";

mysqli_query($con, $sqlAdminNotification);
foreach ($_SESSION["cart"] as $product) {
    $productId = $product["productId"];
    $productName = $product["name"];
    $price = $product["price"];
    $quantity = $product["quantity"];

   $itemSql = "INSERT INTO orderitems
            (orderId, productId, productName, price, quantity)
            VALUES
            ('$orderId', '$productId', '$productName', '$price', '$quantity')";

mysqli_query($con, $itemSql);
   $updateSql = "UPDATE products
              SET quantity = quantity - $quantity
              WHERE id = '$productId'";
mysqli_query($con, $updateSql);

$stockSql = "SELECT quantity
             FROM products
             WHERE id = '$productId'";

$stockResult = mysqli_query($con, $stockSql);

$stock = mysqli_fetch_assoc($stockResult);

if ($stock["quantity"] == 0) {

    $adminMessage = "Product #$productId is out of stock.";

    $sqlAdminNotification = "INSERT INTO notifications
                             (userId, message, isAdminNotification)
                             VALUES
                             ('$userId', '$adminMessage', 1)";

    mysqli_query($con, $sqlAdminNotification);

} else if ($stock["quantity"] <= 5) {

    $adminMessage = "Product #$productId has low stock. Remaining: "
                    . $stock["quantity"];

    $sqlAdminNotification = "INSERT INTO notifications
                             (userId, message, isAdminNotification)
                             VALUES
                             ('$userId', '$adminMessage', 1)";

    mysqli_query($con, $sqlAdminNotification);
}
}
  unset($_SESSION["cart"]);
header("Location: productPage.php");
exit();

?>