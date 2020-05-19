<?php 
require("includes/connection.php");
$query="SELECT * FROM product inner join category on category.cat_id=product.cat_id";
$result=mysqli_query($conn,$query);
?>

<?php include("includes/header.php"); ?>
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><h2 style="font-size: 40px; font-weight: 700">All <span>Books</span></h2></p>
            <!-- <h1 class="mb-0 bread"><?php //echo $row['cat_name'] ?></h1> -->
          </div>
        </div>
      </div>
    </div>
 <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<?php foreach ($result as $key => $value) {
    		?> 
    			<div class="col-sm-3 col-md-6 col-lg-3 ftco-animate" >
    				<div class="product" >
    					<a href="product-single.php?id=<?php echo $value['pro_id']?>" class="img-prod"><img class="img-fluid" style="height: 300px;" width="100%" src="admin/uploads/category/<?php echo $value['cat_name']."/".  $value['pro_img'] ?>">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 px-3">
                            <h3><a href="product-single.php"><?php echo $value['pro_name'] ?></a></h3>
    						<span>By:<?php echo $value['author'] ?></span>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="price-sale"><?php echo $value['pro_price'] ?>&nbsp;JD</span></p>
		    					</div>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="product-single.php?id=<?php echo $value['pro_id']?>" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							
    						</p>
    					</div>
    				</div>
    			</div>
    	<?php
    			} ?>
    		</div>
    	</div>
    </section>
<?php include("includes/footer.php"); ?>