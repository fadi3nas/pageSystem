<?php
session_start();

require "dbOrderHistory.php";

if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != 1) {
    header("Location: login.php");
    exit();
}

$orderId = $_GET["id"];
$sql = "SELECT * FROM orderitems WHERE orderId = '$orderId'";

$result = mysqli_query($con, $sql);
?>
<h1>Order Details</h1>

<table border="1">

    <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        
    </tr>

    <?php while ($item = mysqli_fetch_assoc($result)) { ?>

        <tr>
            8
            <td><?php echo $item["productName"]; ?></td>

            <td><?php echo $item["price"]; ?></td>

            <td><?php echo $item["quantity"]; ?></td>

            <td>
                <?php echo $item["price"] * $item["quantity"]; ?>
            </td>
        </tr>

    <?php } ?>

</table>