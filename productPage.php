<?php
session_start();
require "dbProducts.php";

$sql = "SELECT * FROM products WHERE isDeleted=0 ORDER BY id ASC";
$result = mysqli_query($con, $sql);

?>
 <!DOCTYPE html>
  <html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.add-product {
    padding: 14px 28px;
    background-color: red;
    color: white;
    text-decoration: none;
    position: absolute;
    top: 75px;
    right: 16px;
    font-size: 20px;
}
.add-product2 {
    padding: 3px 8px;
    background-color: gray;
    color: black;
    text-decoration: none;
    
   
}
.add-product3 {
    padding: 14px 28px;
    background-color: red;
    color: white;
    text-decoration: none;
    position: absolute;
    top: 150px;
    right: 4px;
    font-size: 20px;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  display: inline-block;
    margin: 10px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 15px;
}
.cart-button {
    padding: 14px 28px;
    background-color: black;
    color: white;
    text-decoration: none;
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 20px;
}
</style>
</head>
<body>

<h2 style="text-align:center;">GM Products</h2>


<?php if($_SESSION["isAdmin"]==1) {?>
<a class="add-product" href="productAddInfo.php">
    Add A Product
<?php } ?></a>

<a class="cart-button" href="cart.php">
    Cart
</a>
<?php if($_SESSION["isAdmin"]==1){ ?>
                <a class="add-product3" href="admin.php"> Return to the main screen</a>        
                  <?php } ?>
                  <?php if($_SESSION["isAdmin"]==0){ ?>
                <a class="add-product3" href="user.php"> Return to the main screen</a>        
                  <?php } ?>


 <?php while ($product = mysqli_fetch_assoc($result)) { ?>
 <div class="card" id="product-<?php echo $product['id']; ?>">
 <a href="productDetails.php?id=<?php echo $product["id"]; ?>">
 <img src="image/<?php echo $product["image"]; ?>" style="width:90%"></a>

<div class="container">
    
<h4><b><?php echo $product["name"]; ?></b> </h4>
    <p><?php echo $product["description"]; ?><br>
     Quantity: <?php echo $product["quantity"]; ?><br>
     Price:<?php echo $product["price"];?>
     <button type="button"
        onclick="addToFavorites(<?php echo $product["id"]; ?>)">
    Add to Favorites
</button>
    <?php if ($_SESSION["isAdmin"] == 1) { ?>
     <button onclick="softDelete(<?php echo $product['id']; ?>, this)">
            Delete
        </button><?php } ?></p>
        <?php if($_SESSION["isAdmin"]==1){?>
                   <a class="add-product2" href="editProductPage.php?id=<?php echo $product["id"]; ?>"> edit prodcut</a>
                  <?php }?> 
                  
    </div>
    </div>
<?php } ?>
<script>
    function addToFavorites(id) {

    let data = new FormData();

    data.append("productId", id);

    fetch("addToFavorites.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            alert("Added to favorites");
        }
    });
}

function softDelete(id) {
    fetch("softDelete.php", {method: "POST",headers: {"Content-Type": "application/x-www-form-urlencoded"},body: "id=" + id})
    .then(response => response.text())
    .then(data => {if (data.trim() === "success") {
     document.getElementById("product-" + id).remove();
    }});
}
</script>
</body>
</html> 