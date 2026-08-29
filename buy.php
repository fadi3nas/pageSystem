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

    $orderId = mysqli_insert_id($con);
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
}
  unset($_SESSION["cart"]);
header("Location: productPage.php");
exit();

?>