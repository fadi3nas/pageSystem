<?php
session_start();
$productId = $_POST["productId"];
$name = $_POST["name"];
$price = $_POST["price"];
$availableQuantity = $_POST["availableQuantity"];


if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

$exists = false;

foreach ($_SESSION["cart"] as $product) {
    if ($product["name"] == $name) {
        $exists = true;
    }
}

if (!$exists) {
    $_SESSION["cart"][] = [
        "name" => $name,
        "price" => $price,"quantity" => 1,
    "availableQuantity" => $availableQuantity
    ];
}

echo "success";
?>