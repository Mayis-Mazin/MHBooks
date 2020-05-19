<?php require("admin/includes/connection.php"); ?>
<?php include("includes/header.php"); ?>

   <section id="home-section" class="hero">
		  <div class="home-slider js-fullheight owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
	          	<div class="one-third order-md-last img js-fullheight w-100 " style="background-image:url(images/index.png);">
	          	</div>
		          <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">MH books Shop</span>
		          		<div class="horizontal">
		          			<h3 class="vr" style="background-image: url(images/divider.jpg);">Stablished Since 2020</h3>
				            <h1 class="mb-4 mt-3">Catch Your Own <br><span>Books</span></h1>
				            
				            
				            <p><a href="allbook.php" class="btn btn-primary px-5 py-3 mt-3">Discover Now</a></p>
				          </div>

		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>

	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
	          	<div class="one-third order-md-last img js-fullheight w-100" style="background-image:url(images/index2.png);">
	          	</div>
		          <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">Winkel eCommerce Shop</span>
		          		<div class="horizontal">
		          			<h3 class="vr" style="background-image: url(images/divider.jpg);">Best eCommerce Online Shop</h3>
				            <h1 class="mb-4 mt-3">A Thouroughly <span>Modern</span> Woman</h1>
				            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country.</p>
				            
				            <p><a href="books.php" class="btn btn-primary px-5 py-3 mt-3">Shop Now</a></p>
				          </div>
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </section>
<section class="bg-light p-5" >
	<div class="container" >
		<div class="row justify-content-center">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4">Shop By <span style="color:#ffa45c;">Category</span></h2>
			</div>
		</div>   		
	</div>
	<div class="container">
		<div class="row text-center">
			<?php 
			$query="SELECT * FROM category"; 
			$result=mysqli_query($conn,$query);
			foreach ($result as $key => $value) {
				?>
				<a class="col-sm-3 col-md col-lg-3 " href="shop.php?id=<?php echo $value['cat_id'] ?>">
					<div class="col-12 col-sm col-md " style="background-color: #fff;">
						<img src="admin/uploads/category/<?php echo $value['cat_name'].'/'. $value['cat_image'] ?>" width="100%" style="height: 150px;" >
						<p><span style="font-size: 20px;"> <?php echo $value['cat_name']; ?> </span></p>
					</div>
				</a>
			<?php }?>
		</div>
	</div>

</section>
<section>
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="m-4">All <span style="color:#ffa45c;">Books</span></h2>

			</div>
		</div>   		
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class=" popular-products-slides owl-carousel ">
					<?php 
					$query="SELECT * FROM product inner join category on category.cat_id=product.cat_id";
					$pro=mysqli_query($conn,$query);
					foreach ($pro as $key => $value) {
						?>
						<!-- Single Product -->
						<div class="product">
							<!-- Product Image -->
							<a href="product-single.php?id=<?php echo $value['pro_id']?>">
							<div >
								<img src="admin/uploads/category/<?php echo $value['cat_name']."/".  $value['pro_img'] ?>" style="height: 200px" class="img-fluid" alt="">
								<!-- Favourite -->
							</div>
							</a>
							<!-- Product Description -->
							<div class="text py-3 px-3">
								<b><?php echo $value['pro_name'] ?></b><br>
								<span>By: <?php echo $value['author']?></span> 
								<p class="product-price">$ <?php echo $value['pro_price']?>&nbsp;</p>

								<!-- Hover Content -->
								<p class="bottom-area d-flex px-3">
									<a href="product-single.php?id=<?php echo $value['pro_id']?>" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
									
								</p>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class=" bg-light">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="m-4">Resent <span style="color:#ffa45c;">Books</span></h2>
			</div>
		</div>   		
	</div>
	<div class="container">
		<div class="row">
			<?php 
			$query="SELECT * FROM product inner join category on category.cat_id=Product.cat_id and state='1'";
			$recent=mysqli_query($conn,$query);
			foreach ($recent as $key => $value) {
				?>
				<div class="col-sm-3 col-md  col-lg-3 ftco-animate">
					<div class="product">
						<a href="product-single.php?id=<?php echo $value['pro_id']?>" class="img-prod"><img class="img-fluid" width="100%" style="height: 300px" src="admin/uploads/category/<?php echo $value['cat_name']."/".  $value['pro_img'] ?>" >
							<div class="overlay"></div>
						</a>
						<div class="text py-3 px-3">
							<h3><?php echo $value['pro_name'] ?></h3>
							<span>By: <?php echo $value['author'] ?></span>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span class="price-sale">$ <?php echo $value['pro_price'] ?>&nbsp; </span></p>
								</div>
							</div>
							<p class="bottom-area d-flex px-3">
								<a href="product-single.php?id=<?php echo $value['pro_id']?>" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
								
							</p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>



<?php include("includes/footer.php"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.popular-products-slides').owlCarousel({
			// items: 4,
			margin: 30,
			loop: true,
			nav: false,
			dots: true,
			autoplay: true,
			autoplayTimeout: 3000,
			smartSpeed: 1000,
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 2
				},
				768: {
					items: 3
				},
				992: {
					items: 4
				}
			}
		});

	});
</script>