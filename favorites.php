<?php
session_start();

require "db.php";

$email = $_SESSION["email"];

$sql = "SELECT products.*
        FROM favorites
        JOIN products
        ON favorites.productId = products.id
        WHERE favorites.userEmail = '$email'";

$result = mysqli_query($con, $sql);
?>
<h1>My Favorites</h1>

<?php while ($product = mysqli_fetch_assoc($result)) { ?>

    <div>
        <h3><?php echo $product["name"]; ?></h3>

        <p>Price: <?php echo $product["price"]; ?></p>

        <p><?php echo $product["description"]; ?></p>
        <button type="button"
        onclick="removeFavorite(<?php echo $product["id"]; ?>)">
    Remove from Favorites
</button>
    </div>

<?php } ?>
<script>
function removeFavorite(id) {

    let data = new FormData();

    data.append("productId", id);

    fetch("removeFavorite.php", {
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