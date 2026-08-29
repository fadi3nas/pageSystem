<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];
$productId = $_POST["productId"];

$sql = "SELECT * FROM products
        WHERE id = '$productId'";

$result = mysqli_query($con, $sql);
$product = mysqli_fetch_assoc($result);

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

$_SESSION["cart"][] = [
    "productId" => $product["id"],
    "name" => $product["name"],
    "price" => $product["price"],
    "quantity" => 1,
    "availableQuantity" => $product["quantity"]
];

$sqlDelete = "DELETE FROM wishlist
              WHERE userId = '$userId'
              AND productId = '$productId'";

mysqli_query($con, $sqlDelete);

echo "success";
?>