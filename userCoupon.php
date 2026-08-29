<?php
session_start();
require "db.php";

$couponUserName = $_POST["couponUserName"];

$sql = "SELECT * FROM coupons
        WHERE coupnName = '$couponUserName'
        AND isActive = 1";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {

    $coupon = mysqli_fetch_assoc($result);

    $_SESSION["couponValue"] = $coupon["couponValue"];

  

    header("Location: cart.php");
    exit();

} else {

    echo "Invalid coupon";
}
?>