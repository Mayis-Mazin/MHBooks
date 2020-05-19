<?php 
require("includes/connection.php");
?>
<?php 
$query="SELECT * FROM category WHERE cat_id={$_GET['id']} ";
$result=mysqli_query($conn,$query);
$category=mysqli_fetch_assoc($result);

?>

<?php include("includes/header.php"); ?>
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				
				<h1 style="font-weight: 600">Collection Books from<br><span><?php echo $category['cat_name'] ?></span></h1>


			</div>
		</div>
	</div>
</div>
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-md col-lg order-md-last">
				<div class="row">
					<?php 
					$query="SELECT * FROM product inner join category on category.cat_id=Product.cat_id and product.cat_id={$_GET['id']} ";
					$result=mysqli_query($conn,$query);
					// foreach ($product as $key => $value)
					while ($row=mysqli_fetch_assoc($result))
					{
						?>
						<div class="col-sm-3 col-md-6 col-lg-4">
							<div class="product">
								<a href="product-single.php?id=<?php echo $row['pro_id']?>" class="img-prod"><img class="img-fluid" width="100%" style="height: 300px;" src="admin/uploads/category/<?php echo $row['cat_name']."/".$row['pro_img'] ?>" >
									<div class="overlay"></div>
								</a>
								<div class="text py-3 px-3">
									<h3><a href="#"><?php echo $row['pro_name'] ?></a></h3>
									<span>By: <?php echo $row['author'] ?></span>
									<div class="d-flex">
										<div class="pricing">
											<p class="price"><span class="price-sale">$ <?php echo $row['pro_price'] ?>&nbsp; </span></p>
										</div>
									</div>
									<p class="bottom-area d-flex px-3">
										<a href="product-single.php?id=<?php echo $row['pro_id']?>" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
									</p>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		<!-- 	<div class="col-md-4 col-lg-2 sidebar">
				<?php 
				$query="SELECT * FROM category";
				$cat=mysqli_query($conn,$query);
				foreach ($cat as $key => $value) {
					?>
					<div class="sidebar-box-2">
						<h2 class="heading mb-4"><a href="#"><?php echo $value['cat_name'] ?></a></h2>
						<ul>
							<?php 
							$query="SELECT * FROM product WHERE cat_id={$value['cat_id']}";
							$cat=mysqli_query($conn,$query);
							foreach ($cat as $key => $val) {
								?>
								<li><a href="#"><?php echo $val['pro_name']?></a></li>
							<?php } ?>	
						</ul>
					</div>
					<?php
				}
				?>
			</div> -->

		</div>
	</div>
</section>
<?php include("includes/footer.php"); ?>
