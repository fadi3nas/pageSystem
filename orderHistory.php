<?php
session_start();

require "dbOrderHistory.php";

if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != 1) {
    header("Location: login.php");
    exit();
}
if (isset($_GET["status"]) && $_GET["status"] != "") {

    $status = $_GET["status"];

    $sql = "SELECT * FROM orderhistory
            WHERE status = '$status'
            ORDER BY id DESC";

} else {

    $sql = "SELECT * FROM orderhistory
            ORDER BY id DESC";
}
$result = mysqli_query($con, $sql);
?><h1>Order History</h1>
<form method="GET">
    <select name="status">
        <option value="">All</option>
        <option value="Pending">Pending</option>
        <option value="Processing">Processing</option>
        <option value="Completed">Completed</option>
        <option value="Cancelled">Cancelled</option>
    </select>

    <button type="submit">Filter</button>
</form>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Buy Date</th>
        <th>Total</th>
        <th>Status</th>
    </tr>
    <?php while ($order = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td>
                <a href="orderDetails.php?id=<?php echo $order["id"]; ?>">
                    <?php echo $order["id"]; ?>
                </a>

            </td>
            <td><?php echo $order["userFname"]; ?></td>
            <td><?php echo $order["userLname"]; ?></td>
            <td><?php echo $order["userEmail"]; ?></td>

            <td><?php echo $order["buyDate"]; ?></td>

            <td><?php echo $order["total"]; ?></td>
            <td>
    <select onchange="changeStatus(<?php echo $order['id']; ?>, this.value)">

        <option value="Pending"
            <?php if ($order["status"] == "Pending") echo "selected"; ?>>
            Pending
        </option>

        <option value="Processing"
            <?php if ($order["status"] == "Processing") echo "selected"; ?>>
            Processing
        </option>

        <option value="Completed"
            <?php if ($order["status"] == "Completed") echo "selected"; ?>>
            Completed
        </option>

        <option value="Cancelled"
            <?php if ($order["status"] == "Cancelled") echo "selected"; ?>>
            Cancelled
        </option>

    </select>
</td>
        </tr>

        
    <?php }?>
    <script>
function changeStatus(orderId, status) {

    let data= new FormDate();

    data.append("orderId", orderId);
    data.append("status", status);

    fetch("changeOrderStatus.php", {
        method: "POST",
        body: data
    });
}
</script>   

</table>