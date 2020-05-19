<?php 
require("includes/connection.php");
?>
<?php include("includes/header.php") ?>
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><h2 style="font-size: 40px;  font-weight: 700">MH <span>Books</span></h2></p>
            <!-- <h1 class="mb-0 bread"><?php //echo $row['cat_name'] ?></h1> -->
          </div>
        </div>
      </div>
    </div>
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-10 order-md-last">
				<div class="row" id="names"><?php 
					$query="SELECT * FROM product inner join sub_cat on sub_cat.sub_id=product.sub_id
							  inner join category on category.cat_id=product.cat_id";
	$result=mysqli_query($conn,$query);
	while ($row=mysqli_fetch_assoc($result)) {
		echo "<div class='col-sm-6 col-md-6 col-lg-4'>";
		echo "<div class='product'>";
		echo "<a href='product-single.php?id={$row['pro_id']}' class='img-prod'><img class='img-fluid' width='100%' style='height:300px;	' src='admin/uploads/category/{$row['cat_name']}/{$row['pro_img']}' alt='Colorlib Template'>";
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
	}?>
				</div>
			</div>
			<div class="col-md-4 col-lg-2 sidebar">
				<?php 
				$query="SELECT * FROM category";
				$result=mysqli_query($conn,$query);
				foreach ($result as $key => $value) {
					?>
					<div class="sidebar-box-2">
						<h2 class="heading mb-4"><label><?php echo $value['cat_name'] ?></label></h2>
						<ul>
							<?php 
							$que="SELECT * FROM sub_cat where cat_id='{$value['cat_id']}'";
							$res=mysqli_query($conn,$que);
							foreach ($res as $key => $val) {
								?>
								<li>
									<button style="border:0; background: #f8f9fa;" data-id="<?php echo $val['sub_id'] ?>" class="show" id="show" ><?php echo $val['sub_name'] ?></button>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
				}
				?>


			</div>
		</div>
	</section>

	<?php include("includes/footer.php") ?>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$(".show").on('click',function()
			{
                    //get selected parent option 
                    var sub_id = $(this).attr('data-id');              
                    //alert(admin_id);
                    $.ajax(
                    {
                    	type: "GET",
                    	url: "names.php?sub_id="+sub_id,
                    	success: function(data)
                    	{                                    
                    		$("#names").html(data);                                    
                    	}
                    });
                });

		});
	</script>