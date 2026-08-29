<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $couponName = $_POST["coupnName"];
    $couponValue = $_POST["couponValue"];
    $couponNumUsed = $_POST["couponNumUsed"];
    $couponCreationAndEnding = $_POST["couponCreationAndEnding"];
    $couponEndDate = $_POST["couponEndDate"];
    
    if (isset($_POST["isActive"])) {
        $isActive = 1;
    } else {
        $isActive = 0;
    }

    $sqlChecked = "SELECT * FROM coupons
                   WHERE coupnName = '$couponName'";

    $res = mysqli_query($con, $sqlChecked);

    if (mysqli_num_rows($res) > 0) {

        echo "The coupon is already in the system";

    } else {

        $sql = "INSERT INTO coupons
                (coupnName, isActive, couponValue, couponNumUsed,
                 couponCreationAndEnding, couponEndDate)
                VALUES
                ('$couponName', '$isActive', '$couponValue',
                 '$couponNumUsed', '$couponCreationAndEnding',
                 '$couponEndDate')";

        mysqli_query($con, $sql);

        echo "Coupon added successfully";
    }
}
?>