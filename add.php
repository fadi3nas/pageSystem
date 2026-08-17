<?php
require "db.php";
session_start();
$username =$_POST["username"];
$password=$_POST["password"];
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$phoneNum=$_POST["pnum"];

   $sql = "SELECT * FROM users
        WHERE username='$username'
        OR email='$email'";

   $result = mysqli_query($con, $sql);     
    if (mysqli_num_rows($result) > 0) {


    echo "account already exists";

}else { $user = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO users
            (username, password, firstName, lastName, phoneNumber, email)
            VALUES
            ('$username', '$password', '$fname', '$lname', '$phoneNum', '$email')";
            mysqli_query($con, $sql);
           echo "account has been created";
            $_SESSION["username"]=$user["username"];
        $_SESSION["email"]=$user["email"];
        $_SESSION["firstName"]=$user["firstName"];
        header("Location: user.php");
        exit();

    
}




?>