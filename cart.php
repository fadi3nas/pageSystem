<?php
session_start();
require "dbProducts.php";

$sql = "SELECT * FROM products WHERE isDeleted=0 ORDER BY id ASC";
$result = mysqli_query($con, $sql);
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .remove-button {
    padding: 8px 12px;
    background-color: red;
    border: none;
    color:white;
    cursor: pointer;
    display: inline-block;
    position: static;
    width: auto;
    height: auto;
} 
h3,p,h1,h2{color:black;}
.add-product {
    padding: 14px 28px;
    background-color: red;
    color: white;
    text-decoration: none;
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 20px;
}
.totalBar {
    position: absolute;
    top: 150px;
    left: 330px;
    color: black;
}

    </style>
    <title>My Cart</title>
</head>
<body>

<h1>My Cart</h1>
<a class="add-product" href="productPage.php">Go back to the product page</a>

<?php
if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $index=>$product) {
    echo "<h3>" . $product["name"] . "</h3>";
    echo "<p>Price: " . $product["price"] . "</p>";
    echo "<p>Available: " . $product["availableQuantity"] . "</p>";
    echo '<button type="button" onclick="changeQuantity(' . $index . ', \'minus\')">-</button>';
    echo '<span> ' . $product["quantity"] .' </span>';
    echo '<button type="button" onclick="changeQuantity(' . $index . ', \'plus\')">+</button><br><br>';
    echo '<button type="button" class="remove-button" onclick="removeFromCart(' . $index . ')">Remove the product</button>';
        $total = $total + ($product["price"] * $product["quantity"]);      
    }
} 
else {
    echo "Cart is empty, add any produt";
}
if (isset($_SESSION["couponValue"])) {
    $total = $total - $_SESSION["couponValue"];

    if ($total < 0) {
        $total = 0;
    }
}?>

 <h2 class="totalBar"> total: <?php echo $total; ?></h2>
 
<form action="userCoupon.php" method="POST">
    <input type="text" name="couponUserName">
    <button type="submit">Add coupon</button>
</form>


 <?php if (!empty($_SESSION["cart"])) { ?>
<form action="buy.php" method="POST">
    <button type="submit">Buy</button>
</form>
<?php } ?>

<script>
    function removeFromCart(index){
        fetch("removeFromCart.php",{method:"POST",headers:{"Content-Type": "application/x-www-form-urlencoded"},body:"index="+index})
        .then(response=>response.text())
        .then(data=>{if(data.trim()==="success"){
            location.reload();
        }
    });    
        }
function changeQuantity(index, action) {
    fetch("changeQuantity.php", {
        method: "POST",headers: {"Content-Type": "application/x-www-form-urlencoded"},body: "index=" + index + "&action=" + action})
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
         location.reload();
        }
    });
}
</script>


</body>
</html> 