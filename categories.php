<?php
require "db.php";

$sql = "SELECT * FROM categories";

$result = mysqli_query($con, $sql);
?>

<h2>Categories</h2>

<?php while ($category = mysqli_fetch_assoc($result)) { ?>

    <p>
        <?php echo $category["id"]; ?>
        -
        <?php echo $category["name"]; ?>

        <a href="editCategory.php?id=<?php echo $category["id"]; ?>"> Edit </a><br>
        <a href="editCategory.php?id=<?php echo $category["id"]; ?>"> Delete  </a>
    </p>

<?php } ?>