<?php
session_start();

$index = $_POST["index"];
$action = $_POST["action"];

if ($action == "plus") {   
 if ($_SESSION["cart"][$index]["quantity"] < $_SESSION["cart"][$index]["availableQuantity"]){
                                $_SESSION["cart"][$index]["quantity"]++;}}

if ($action == "minus") {
if($_SESSION["cart"][$index]["quantity"] > 1) {
        $_SESSION["cart"][$index]["quantity"]--;}}
        
echo "success";
?>