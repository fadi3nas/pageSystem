<?php 
session_start();
require "dbProducts.php";
 
$id=$_GET["id"];


$sql="SELECT * FROM products WHERE id=$id";
$result=mysqli_query($con,$sql);
$product=mysqli_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST["name"];
    $price=$_POST["price"];
    $quantity=$_POST["quantity"];
    $description=$_POST["description"];
 
    $sqlupdate="UPDATE products SET 
    name='$name',price='$price',quantity='$quantity'
    ,description='$description' WHERE id='$id'";
    mysqli_query($con,$sqlupdate);
    header("Location: productPage.php");
    exit();   
}


?>
<form method="POST">
<input type="text" name="name" value="<?php echo $product["name"]; ?>">
<input type="number" name="price" value="<?php echo $product["price"]; ?>">
<input type="number" name="quantity" value="<?php echo $product["quantity"]; ?>">
<input type="text" name="description" value="<?php echo $product["description"]; ?>">
 
<button tybe="submit"> save the cahnges</button>
</form>

