<?php
session_start();
require "db.php";

$userId = $_SESSION["userId"];

$sql = "SELECT products.*
        FROM wishlist
        JOIN products
        ON wishlist.productId = products.id
        WHERE wishlist.userId = '$userId'";

$result = mysqli_query($con, $sql);
?>

<h2>My Wishlist</h2>

<?php while ($product = mysqli_fetch_assoc($result)) { ?>

    <h3><?php echo $product["name"]; ?></h3>

    <p>Price: <?php echo $product["price"]; ?></p>

    <button type="button"
            onclick="removeFromWishlist(<?php echo $product["id"]; ?>)">
        Remove from Wishlist
    </button>

    <hr>

<?php } ?>
<script>
function removeFromWishlist(productId) {

    let data = new FormData();
    data.append("productId", productId);

    fetch("removeFromWishlist.php", {
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