<?php session_start();
require("includes/connection.php");
if(!isset($_SESSION['user_id'])){
	header("Location: login.php");
}else{
$user_id       = $_SESSION['user_id'];
$grand_total   = $_SESSION['sumPrice'];
$query="INSERT INTO orders(cust_id,status,total_price)
				 VALUES ('$user_id','pending','$grand_total')";
if (mysqli_query($conn,$query)) {
	$order_id=mysqli_insert_id($conn);
	foreach ($_SESSION['cart'] as $product_id => $quantity) {
		$insertDetails="INSERT INTO order_details(order_id,product_id,qty)
		VALUES('$order_id','$product_id','$quantity') ";
		$res= mysqli_query($conn, $insertDetails);
	}
}else
{
	echo "Not Done";exit;
}
header("location:done.php");
}
?>
