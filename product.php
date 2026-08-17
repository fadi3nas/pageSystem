<?php

require "dbProducts.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $creationDate = $_POST["creationDate"];
    $modificationDate = $_POST["modificationDate"];
    $price=$_POST["price"];
    $imageName = $_FILES["image"]["name"];
    $imageTemp = $_FILES["image"]["tmp_name"];

    move_uploaded_file($imageTemp, "image/" . $imageName);


    $chekSql = "SELECT * FROM products WHERE name = '$name'";
    $result = mysqli_query($con, $chekSql);

    if (mysqli_num_rows($result) > 0) {

        echo "Product already exists";

    } else {

        $sql = "INSERT INTO products
        (name, quantity, description, creationDate, modificationDate,price,image)
        VALUES
        ('$name', '$quantity', '$description',
         '$creationDate', '$modificationDate', '$price','$imageName')";

        if (mysqli_query($con, $sql)) {
            header("Location: productPage.php");
            exit();

        } else {

            echo "Error: " . mysqli_error($con);
        }
    }
}

?>