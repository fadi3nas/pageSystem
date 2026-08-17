<?php 
require "db.php";


$id=$_GET["id"];
$sql="DELETE FROM categories WHERE id='$id' ";
mysqli_query($con,$sql);

header("Location: categories.php");
exit();



?>