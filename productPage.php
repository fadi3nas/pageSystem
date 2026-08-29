<?php
session_start();
require "dbProducts.php";
$page=1;
$offset=0;


$sort="";
$AtoZ="";
$ZtoA="";
$LOWtoHIGh="";
$HIGHtoLOW="";
$newest="";
if(isset($_GET["sort"])){
$sort=$_GET["sort"];
}


$search = "";
if (isset($_GET["search"])) {
    $search = $_GET["search"];

}

$categoryId = "";
$minPrice = "";
$maxPrice = "";
$inStock = "";

if (isset($_GET["categoryId"])) {
    $categoryId = $_GET["categoryId"];
}

if (isset($_GET["minPrice"])) {
    $minPrice = $_GET["minPrice"];
}

if (isset($_GET["maxPrice"])) {
    $maxPrice = $_GET["maxPrice"];
}

if (isset($_GET["inStock"])) {
    $inStock = $_GET["inStock"];


}

$sqlCategories = "SELECT * FROM categories";
$resultCategories = mysqli_query($con, $sqlCategories);



$sql = "SELECT products.*, categories.name AS categoryName
        FROM products
        LEFT JOIN categories
        ON products.categoryId = categories.id
        WHERE products.isDeleted = 0";
$result = mysqli_query($con, $sql);

if ($categoryId != "") {
    $sql .= "AND products.categoryId = '$categoryId'";
}

if ($minPrice != "") {
    $sql .= "AND products.price >= '$minPrice'";
}

if ($maxPrice != "") {
    $sql .= "AND products.price <= '$maxPrice'";
}

if ($inStock == "yes") {
    $sql .= "AND products.quantity > 0";
}

if ($inStock == "no") {
    $sql .= "AND products.quantity = 0";
}
if ($search != "") {
    $sql .= "AND products.name LIKE '%$search%'";
}
//sort the producys
if ($sort == "atoz") {
    $sql .= " ORDER BY products.name ASC";
}

if ($sort == "ztoa") {
    $sql .= " ORDER BY products.name DESC";
}

if ($sort == "lowtohigh") {
    $sql .= " ORDER BY products.price ASC";
}

if ($sort == "hightolow") {
    $sql .= " ORDER BY products.price DESC";
}

if ($sort == "newest") {
    $sql .= " ORDER BY products.creationDate DESC";
}

if(isset($_GET["page"])){
    $page=$_GET["page"];
}


if($page==1){
$offset=0;
}
if($page==2){
    $offset=10;
}
if($page==3){
    $offset=20;
}

$sql .=" LIMIT 10 OFFSET $offset";

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

<form method="GET">

<select name="sort">
    <option value="">Sort By</option>
    <option value="atoz">Name A-Z</option>
    <option value="ztoa">Name Z-A</option>
    <option value="lowtohigh">Price Low to High</option>
    <option value="hightolow">Price High to Low</option>
    <option value="newest">Newest</option>
</select>

    <input type="text"
           name="search"
           placeholder="Search product"
           value="<?php echo $search; ?>">

    <button type="submit">Search</button>

    <br><br>
    <label>Category:</label>

    <select name="categoryId">

        <option value="">All Categories</option>

        <?php while ($category = mysqli_fetch_assoc($resultCategories)) { ?>

            <option value="<?php echo $category["id"]; ?>">
                <?php echo $category["name"]; ?>
            </option>

        <?php } ?>

    </select>
<br><br>

<label>Price From:</label>
<input type="number" name="minPrice" value="<?php echo $minPrice; ?>">

<label>Price To:</label>
<input type="number" name="maxPrice" value="<?php echo $maxPrice; ?>">

<br><br>
<label>In Stock:</label>

<select name="inStock">

    <option value="">All</option>

    <option value="yes">Yes</option>

    <option value="no">No</option>

</select>
<button type="submit">Filter</button>
<br><br>
</form> 
 <?php while ($product = mysqli_fetch_assoc($result)) { ?>
 <div class="card" id="product-<?php echo $product['id']; ?>">
 <a href="productDetails.php?id=<?php echo $product["id"]; ?>">
 <img src="image/<?php echo $product["image"]; ?>" style="width:90%"></a>
  
<div class="container">
    
<h4><b><?php echo $product["name"]; ?></b> </h4>
    <p><?php echo $product["description"]; ?><br>
     Quantity: <?php echo $product["quantity"]; ?><br>
     Price:<?php echo $product["price"];?>
     <p>
    Category:
    <?php echo $product["categoryName"]; ?>
</p>
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

<a href="productPage.php?page=1">1</a>
<a href="productPage.php?page=2">2</a>
<a href="productPage.php?page=3">3</a>
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