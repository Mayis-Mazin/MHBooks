<?php 
require("includes/connection.php");
session_start();
$id=$_GET['id'];
$query="SELECT * FROM product INNER JOIN category on product.cat_id=category.cat_id
INNER JOIN sub_cat on product.sub_id=sub_cat.sub_id
and product.pro_id=$id";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result); 
// $productCart=array();
// if (isset($_POST['submit'])) {
// 	$_SESSION['product'][]=$id;
// 	foreach ($_SESSION['product'] as $proId) {
// 		$query="SELECT * FROM product INNER JOIN category on product.cat_id=category.cat_id INNER JOIN sub_cat on product.sub_id=sub_cat.sub_id and product.pro_id=$id";
// 		$result=mysqli_query($conn,$query);
// 		while ($row=mysqli_fetch_assoc($result)) {
// 			$productCart[]=$row;
// 		}
// 	}
// }
if(isset($_POST['addProduct'])){
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }
  $product_id=$_POST['product_id'];

  $_SESSION['cart'][$_POST['product_id']] = $_POST['quantity'];
  echo "<script type='text/javascript'>window.top.location='product-single.php?id=$product_id';</script>"; exit;
}
// echo "<pre>";
// print_r($productCart);
// die;

?>


<?php include("includes/header.php"); ?>

<?php
foreach ($result as $key => $value) {
	?>
	<div class="container m-5">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate text-center">
				<a href="admin/uploads/category/<?php echo $value['cat_name']."/".$value['pro_img']  ?>" class="image-popup"><img src="admin/uploads/category/<?php echo $value['cat_name']."/".$value['pro_img']  ?>" width="75%" style="height: 500px" class="img-fluid" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3><?php echo $value['pro_name'] ?></h3>
				<h4>By: <?php echo $value['author'] ?></h4>
				<p class="price"><span>$ <?php echo $value['pro_price'] ?></span></p>
				<p><?php echo $value['pro_desc'] ?></p>
				<form action="" method="post">	
					<!-- <button type="submit" class="btn btn-black py-3 px-5">Add to Cart</button> -->
					<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="" min="1" max="100" placeholder="quantity" required="" autocomplete="0">
	             	<input type="hidden" name="product_id" value="<?php echo $row['pro_id']  ?>">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
	          	</div>
					<button type="submit" name="addProduct" class="btn btn-primary mt-4 pr-4 pl-4" style="background-color: black!important; border-radius: 20px 50px; width: 200px; height: 70px!important ">Add to Cart</button>
				</form>
			</div>
		</div>
	</div>
</section>

<?php
}
?>

<?php include("includes/footer.php"); ?>
<script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            if (quantity<100) {
		            $('#quantity').val(quantity + 1);
}
		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>1){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
