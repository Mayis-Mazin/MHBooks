<?php
$conn = mysqli_connect("localhost","root","","curtains");
$query="SELECT * FROM product inner join sub_cat on sub_cat.sub_id=product.sub_id
							  inner join category on category.cat_id=product.cat_id	
							  and sub_cat.sub_id={$_GET['sub_id']}";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
while ($row=mysqli_fetch_assoc($result)) {
echo "<div class='col-sm-6 col-md-6 col-lg-4'>";
		echo "<div class='product'>";
		echo "<a href='#' class='img-prod'><img class='img-fluid' width='100%' style='height:300px;	' src='admin/uploads/category/{$row['cat_name']}/{$row['pro_img']}' alt='Colorlib Template'>";
			echo "<div class='overlay'></div>";
		echo "</a>";
		echo "<div class='text py-3 px-3'>";
			echo "<h3><a href='#'>{$row['pro_name']}</a></h3>";
			echo "<span>{$row['author']}</span>";
			echo "<div class='d-flex'>";
				echo "<div class='pricing'>";
				   	echo "<p class='price'><span>$ {$row['pro_price']}</span></p>";
				    echo "</div>";
			echo "</div>";
		    echo "<p class='bottom-area d-flex px-3'>";
		    	echo "<a href='product-single.php?id={$row['pro_id']}' class='add-to-cart text-center py-2 mr-1'><span>Add to cart <i class='ion-ios-add ml-1'></i></span></a>";
		    	
			echo "</p>";
		echo "</div>";
	echo "</div>";
echo "</div>";

}
}else
{
	
	$query="SELECT * FROM product inner join sub_cat on sub_cat.sub_id=product.sub_id
							      inner join category on category.cat_id=product.cat_id";
	$result=mysqli_query($conn,$query);
		echo "<div class='col-sm-12 col-md-12 col-lg-12 text-center m-5' >";
		echo "<span style='font-size: 30px; color:#000; font-weight: 700' >All Books</span>";
		echo "</div>";
	while ($row=mysqli_fetch_assoc($result)) {
		echo "<div class='col-sm-6 col-md-6 col-lg-4'>";
			echo "<div class='product'>";
				echo "<a href='#' class='img-prod'><img class='img-fluid' width='100%' style='height:300px;	' src='admin/uploads/category/{$row['cat_name']}/{$row['pro_img']}' alt='Colorlib Template'>";
					echo "<div class='overlay'></div>";
				echo "</a>";
				echo "<div class='text py-3 px-3'>";
					echo "<h3><a href='#'>{$row['pro_name']}</a></h3>";
					echo "<span>{$row['author']}</span>";
					echo "<div class='d-flex'>";
						echo "<div class='pricing'>";
				   			echo "<p class='price'><span>$ {$row['pro_price']}</span></p>";
				    	echo "</div>";
					echo "</div>";
			    	echo "<p class='bottom-area d-flex px-3'>";
			    		echo "<a href='product-single.php?id={$row['pro_id']}' class='add-to-cart text-center py-2 mr-1'><span>Add to cart <i class='ion-ios-add ml-1'></i></span></a>";
					echo "</p>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}
}
