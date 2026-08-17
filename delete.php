<?php 
require "db.php";
$id=$_POST["id"];
$sql="UPDATE users SET isDelete=1 WHERE id=$id";
mysqli_query($con,$sql);
header("Location: userReturnInfo.php");
exit();

?>


