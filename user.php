<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <header>
     <style>
      h1,h3{text-align:center;
                }
      h2{text-align:center;
        text-decoration:underline;}  
        a{padding: 14px 30px;
      background-color:red;
      text-decoration:none;
      text-align:center;
    color:white;}        
      </style>
</header>
<body>
    <h1>Welcome  <?php  echo $_SESSION["username"]; ?></h1>
    <h2>Your Information<h2>   
        <h3>Username:<?php echo $_SESSION["username"];?><h3>
        <h3>Email:<?php echo $_SESSION["email"];?><h3>
        <h3>First Name:<?php echo $_SESSION["firstName"];?><h3>
          <a href="myOrders.php">my orders</a>
          <a href="favorites.php">My Favorites</a>
          <a href="productPage.php">view the products</a>
</body>
</html>
