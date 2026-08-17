<?php
require "dbProducts.php";

$id = $_POST["id"];

$sql = "UPDATE products
        SET isDeleted = 1
        WHERE id = '$id'";

if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "error";
}
?>