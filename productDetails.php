<?php 
require "dbProducts.php";
$id = $_GET["id"];

$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($con, $sql);

$product = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<style>
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
</style>    
<title>Product Details</title>

</head>
<body>
    <a class="add-product" href="productPage.php">Go back to the product page</a>

    <img src="image/<?php echo $product["image"]; ?>" style="width:300px;">

    <h1><?php echo $product["name"]; ?></h1>

    <p><?php echo $product["description"]; ?></p>
 
    <p>Price: <?php echo $product["price"]; ?></p>

    <p>Quantity: <?php echo $product["quantity"]; ?></p><br>
    <button type="button" onclick="addToCart(
            '<?php echo $product["name"]; ?>',
            <?php echo $product["price"]; ?>,
            <?php echo $product["quantity"]; ?>
        )">
    Add to Cart
</button>
    <script>
function addToCart(name, price,availableQuantity) {
let data = new FormData();
data.append("name", name);
data.append("price", price);
data.append("availableQuantity", availableQuantity);
    fetch("addToCart.php", {method: "POST",body: data}).
    then(response => response.text())
    .then(data => {
        window.location.href = "cart.php";
    });
}
</script>





</body>
</html>