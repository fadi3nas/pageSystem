<?php
require "db.php";
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

}else {
    $sql = "INSERT INTO users
            (username, password, firstName, lastName, phoneNumber, email)
            VALUES
            ('$username', '$password', '$fname', '$lname', '$phoneNum', '$email')";

    mysqli_query($con, $sql);
        echo "Account is created succesfully";
    
}




?>