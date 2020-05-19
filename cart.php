<?php 
session_start();
require('includes/connection.php');

if(isset($_POST['edit'])){
	$product_id = $_POST['product_id'];
	$quantity   = $_POST['quantity'];
	$_SESSION['cart'][$product_id] = $quantity;
	header("Location:cart.php");
}
if(isset($_POST['remove'])){
	$product_id = $_POST['product_id'];
	unset($_SESSION['cart'][$product_id]);
	header("Location:cart.php");
}

?>
<?php include("includes/header.php"); ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
				<h1 class="mb-0 bread">My Cart</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="">
					<table class="table" id="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>quantity</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody id="tableBody">
							<?php 
							$sumPrice = 0;
							if(isset($_SESSION['cart'])){

								foreach($_SESSION['cart'] as $product_id => $quantity){
									$sql = "SELECT * FROM product inner join category on category.cat_id=Product.cat_id and pro_id='$product_id'";
									$res = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_assoc($res)){
										$prod_id  = $row['pro_id'];
										?>
										<tr class="text-center">
											<td >
												<form  action="" method="post">
													<input type="hidden" name="product_id" value="<?php echo $prod_id; ?>">
													<button class="btn btn-link py-1 px-4" type="submit" name="remove" value="remove" style="cursor:pointer;border:0; width: 40px!important; background: #fff;">
														<span class="ion-ios-close"></span>
													</button>
												</form>
											</td>

											<td class="image-prod">
												<div class="img">
													<img src="admin/uploads/category/<?php echo $row['cat_name']."/".$row['pro_img'] ?>" width="100%" >
												</div>
											</td>

											<td class="product-name">
												<h3><?php echo $row['pro_name'] ?></h3>

											</td>

											<td >
												<span class="editQuantity"><?php echo $quantity; ?></span>
												<span class="formEdit">
													<form action="" method="post">
														<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
														<input class="quantity-left-minus btn" type="number" name="quantity" value="<?php echo $quantity; ?>">
														<input class="btn btn-black py-3 px-5" style="font-size:0.8rem;" type="submit" name="edit" value="Update">
													</form>
												</span>
											</td>


											<td id="total">
												$<?php echo $row['pro_price'];
												$sumPrice += $row['pro_price'] * $quantity;
												?>
											</td>
										</tr>
										<!-- END TR-->
										<?php 
									} 
								} 
							}$_SESSION['sumPrice'] = $sumPrice; 
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Cart Totals</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span class="total">$<?php echo $sumPrice ?></span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span>Free</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span class="total">$<?php echo $sumPrice ?></span>
					</p>
				</div>
				<button class="btn btn-primary py-3 px-4" onclick="window.location.href='checkout.php'" <?php if($sumPrice == 0) echo "disabled" ?> >Proceed to Checkout</button>
			</div>
		</div>
	</div>
</section>

<?php include('includes/footer.php')?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
	$(document).ready(function(){
		$('.formEdit').hide();
		$('.editQuantity').on('click',function(){
			$(this).hide().next().show();
		});

	});
</script>

</body>
</html>