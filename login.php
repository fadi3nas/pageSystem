<?php
session_start();
require "db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body{font-size:40px;
                text-align:center;}
        </style>
</head>
    <body>


<?php

$username=$_POST['username'];
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
$result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $user = mysqli_fetch_assoc($result);

    if ($user["isAdmin"] == 1) {
        $_SESSION["userId"] = $user["id"];
         $_SESSION["username"]=$user["username"];
        $_SESSION["email"]=$user["email"];
        $_SESSION["firstName"]=$user["firstName"];
        $_SESSION["lastName"] = $user["lastName"];
            $_SESSION["isAdmin"] = $user["isAdmin"];
        header("Location: admin.php");
        exit();

        
    } else {
        $_SESSION["userId"] = $user["id"];
        $_SESSION["username"]=$user["username"];
        $_SESSION["email"]=$user["email"];
        $_SESSION["firstName"]=$user["firstName"];
        $_SESSION["lastName"] = $user["lastName"];
       $_SESSION["isAdmin"] = $user["isAdmin"];
        header("Location: user.php");
        exit();
       

    }
   
}   else 
        {
            echo "please sign up or wrong username or password";
            }


?>
</body>
</html>