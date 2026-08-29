<?php 
require "db.php";
0

?>
<form action="coupon.php" method="POST">
<input type="text" name="coupnName"> add the name of the coupon:</input><br><br>
<input type="checkbox" name="isActive"> is the coupon active:</input><br><br>
<input type="number" name="couponValue"> what is the value of the coupon:</input><br><br>
<input type="number" name="couponNumUsed"> how many times the coupon will be used:</input><br><br>
<input type="date" name="couponCreationAndEnding"> the date of the coupon:</input><br><br>
<input type="date" name="couponEndDate"> the end date of the coupon:</input><br><br>

<button type="submit" >add the coupon</button>
</form>