<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $sql = "INSERT INTO categories (name)
            VALUES ('$name')";

    mysqli_query($con, $sql);
}
?>

<form method="POST">

    <input type="text" name="name" placeholder="Category Name">

    <button type="submit">Add Category</button>

</form>
 <a href="categories.php" >The Category</a>