<?php
session_start();

require "dbOrderHistory.php";

$email = $_SESSION["email"];
$sql = "SELECT * FROM orderhistory
        WHERE userEmail = '$email'
        ORDER BY id DESC";

$result = mysqli_query($con, $sql);
?>
<h1>My Orders</h1>

<table border="1">

    <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Total</th>
        <th>Status</th>
    </tr>

    <?php while ($order = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $order["id"]; ?></td>
            <td><?php echo $order["buyDate"]; ?></td>
            <td><?php echo $order["total"]; ?></td>
            <td><?php echo $order["status"]; ?></td>
        </tr>

    <?php } ?>

</table>