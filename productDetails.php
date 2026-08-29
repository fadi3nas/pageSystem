<?php 
session_start();
require "dbProducts.php";

$id = $_GET["id"];

$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($con, $sql);

$product = mysqli_fetch_assoc($result); 

$productId = $product["id"];
$userId = $_SESSION["userId"];
$sqlWishlist = "SELECT * FROM wishlist
                WHERE userId = '$userId'
                AND productId = '$productId'";

$resultWishlist = mysqli_query($con, $sqlWishlist);

$isInWishlist = mysqli_num_rows($resultWishlist) > 0;

$sqlReviews = "SELECT reviews.*, users.username
               FROM reviews
               JOIN users
               ON reviews.userId = users.id
               WHERE reviews.productId = '$productId'";

$resultReviews = mysqli_query($con, $sqlReviews);
$sqlRating = "SELECT AVG(rating) AS averageRating,
                     COUNT(*) AS ratingsCount
              FROM reviews
              WHERE productId = '$productId'";

$resultRating = mysqli_query($con, $sqlRating);
$ratingInfo = mysqli_fetch_assoc($resultRating);
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
.add-product2 {
    padding: 7px 14px;
    background-color: gray;
    color: white;
    text-decoration: none;
    position: absolute;
    top: 80px;
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
    <button class="add-product2" type="button" onclick="addToCart(
        <?php echo $product["id"]; ?>,
            '<?php echo $product["name"]; ?>',
            <?php echo $product["price"]; ?>,
            <?php echo $product["quantity"]; ?>
        )">
    Add to Cart
    
</button>

<form action="addReview.php" method="POST">

    <input type="hidden"
           name="productId"
           value="<?php echo $product["id"]; ?>">

    <input type="hidden"
           name="rating"
           id="rating">

    <p>Choose Rating:</p>

    <button type="button" onclick="chooseRating(1)">1</button>
    <button type="button" onclick="chooseRating(2)">2</button>
    <button type="button" onclick="chooseRating(3)">3</button>
    <button type="button" onclick="chooseRating(4)">4</button>
    <button type="button" onclick="chooseRating(5)">5</button>

    <br><br>

    <textarea name="reviewText"
              placeholder="Write your review"></textarea>

    <br><br>

    <button type="submit">Submit Review</button>

</form>
<p>
    Average Rating:
    <?php echo $ratingInfo["averageRating"]; ?>
</p>

<p>
    Number of Ratings:
    <?php echo $ratingInfo["ratingsCount"]; ?>
</p>
<h2>Reviews</h2>


<?php while ($review = mysqli_fetch_assoc($resultReviews)) { ?>

    <p>User: <?php echo $review["username"]; ?></p>

    <p>Rating: <?php echo $review["rating"]; ?>/5</p>

    <p><?php echo $review["reviewText"]; ?></p>

    <p>Date: <?php echo $review["reviewDate"]; ?></p>

    <hr>

<?php } ?>
<?php if ($isInWishlist) { ?>

    <button type="button"
            onclick="removeFromWishlist(<?php echo $product["id"]; ?>)">
        Remove from Wishlist
    </button>
    <button type="button"
        onclick="moveToCart(<?php echo $product["id"]; ?>)">
    Move to Cart
</button>

<?php } else { ?>

    <button type="button"
            onclick="addToWishlist(<?php echo $product["id"]; ?>)">
        Add to Wishlist
    </button>

<?php } ?>
<script>
function moveToCart(productId) {

    let data = new FormData();
    data.append("productId", productId);

    fetch("moveToCart.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            location.reload();
        }
    });
}
</script>
<script>
function addToWishlist(productId) {

    let data = new FormData();

    data.append("productId", productId);

    fetch("addToWishlist.php", {
        method: "POST",
        body: data
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            alert("Added to Wishlist");
        }
    });
}
</script>
<script>
function chooseRating(number) {
    document.getElementById("rating").value = number;
}
</script>
    <script>
function addToCart(productId, name, price, availableQuantity) {
let data = new FormData();
data.append("productId", productId);
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