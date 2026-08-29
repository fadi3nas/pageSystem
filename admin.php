<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <header>
     <style>
      h1,h3{text-align:center;
                }
      h2{text-align:center;
        text-decoration:underline;}     
        a{padding: 14px 28px;
            color:white;
            background-color:red;
        text-decoration:none;}  
        .admin-button {
    display: inline-block;
    padding: 12px 24px;
    background-color: red;
    color: white;
    text-decoration: none;
}   
      </style>
</header>
<body>
    <h1>Welcome Admin <?php  echo $_SESSION["username"]; ?></h1>
    <h2>Your Information<h2>   
        <h3>Username:<?php echo $_SESSION["username"];?><h3>
        <h3>Email:<?php echo $_SESSION["email"];?><h3>
        <h3>Username:<?php echo $_SESSION["firstName"];?><h3><br><br><br>
            <a href="userReturnInfo.php">View Users List</a>
            <a href="productPage.php">View the products</a>
            <a href="orderHistory.php" class="admin-button">View Order History</a>
            <a href="addCategory.php" class="admin-button">Add Category</a>
            <a href="reports.php" class="admin-button">Reports</a>
            <a href="addCoupon.php" class="admin-button">Coupons</a>
            <a href="wishlist.php"class="admin-button"> My Wishlist</a>
 <a href="favorites.php">My Favorites</a>
</body>
</html>
