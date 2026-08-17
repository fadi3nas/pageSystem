<?php
require "db.php";

$sqlCategories = "SELECT * FROM categories";
$resultCategories = mysqli_query($con, $sqlCategories);
?>  


<!DOCTYPE html>
<html>
<head>
<style>
    p,h1{text-align:center;
        font-size:20px}
    </style>
</head>
<body>
    <form action="product.php" method="POST" enctype="multipart/form-data">
    <h1 style="font-size:40px">Product Info</h1><br><br>
   <p> Name:<input type="text" name="name"><br><br>
    Quantity:<input type="number" name="quantity"><br><br>
    Description:<input type="text" name="description"><br><br>
    Creation Date:<input type="date" name="creationDate"><br><br>
    Modification Date<input type="date" name="modificationDate"><br><br>
    Price<input type="number" name="price"><br><br>
    Image<input type="file" name="image" accept=".png" required><br><br>
                        
                    Category:
<select name="categoryId">
    <?php while ($category = mysqli_fetch_assoc($resultCategories)) { ?>
        <option value="<?php echo $category["id"]; ?>">
            <?php echo $category["name"]; ?>
        </option>
    <?php } ?>
</select>
<br><br><button>Add</button></p>
</form>
</body>
</html>

