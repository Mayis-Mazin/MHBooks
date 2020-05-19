<?php 
	include("includes/connection.php");
	$query="SELECT * FROM product WHERE cat_id ={$_GET['cat_id']}";
	$product=mysqli_query($conn,$query);
	// $row=mysqli_fetch_assoc($result);
	foreach ($product as $key => $value) {
		echo "string";
	?>
<!-- <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">

	<div class="overlay"></div>
</a>
<div class="text py-3 px-3">
	<h3><a href="#">Floral Jackquard Pullover</a></h3>
	<div class="d-flex">
		<div class="pricing">
			<p class="price"><span class="price-sale">$80.00</span></p>
		</div>
	</div>
	<p class="bottom-area d-flex px-3">
		<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
		<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
	</p>
</div> -->
<?php }
?>