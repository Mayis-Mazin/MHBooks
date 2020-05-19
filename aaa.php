	<!-- slider with botton  -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="images/about-1.jpg" style="height: 400px" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="images/about.jpg" style="height: 400px" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="images/about-2.jpg" style="height: 400px" alt="Third slide">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- slider  page php -->
<section id="home-section" class="hero">
	<div class="home-slider js-fullheight owl-carousel">
		<div class="slider-item js-fullheight">
			<div class="container-fluid ">
				<div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
					<div class="one-third order-md-last img js-fullheight" style="background-image: url(admin/uploads/ramadan.jpeg);" >
						<!-- <img src="admin/uploads/ramadan.jpeg" width="100%" height="400px"> -->
					
					</div>
					<div class="one-forth d-flex js-fullheight ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
						<div class="text">
							<span class="subheading"><b>Prince of Curtains</b> </span>
							<div class="horizontal">
								<h3 class="vr"><span style="font-size: 20px; font-weight:700"> Categorys &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h3>
								<h1 class="mb-4 mt-3">Catch Your Own <br></h1>
								<?php 
								$query="SELECT * FROM category";
								$result=mysqli_query($conn,$query);
								$counter=1;
								foreach($result as $key => $value) {
									?>
									<div class="ml-5">
										<span><?php echo $counter; ?></span>&nbsp;
										<a href="shop.php?id=<?php echo $value['cat_id'] ?>" style="font-size: 15px"><?php echo $value['cat_name'] ?> </a>
									</div>
									<?php 
									$counter++;
								}	?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

$('.editbtn').on('click',function(){
				$('.modal').show();
				var id    = $(this).attr('data-id');
				var name  = $(this).attr('data-name');
				var image = $(this).attr('data-image');
				var catId = $(this).attr('data-cat');
				$('#id_cat').val(id);
				$('#name_cat').val(name);
				$('#cat_old').val(name);
				$('#image_cat').val(image);

			});
data-id="<?php echo $value['cat_id']?>" data-name="<?php echo $value['cat_name']?>" data-image="<?php echo $value['cat_image']?>" data-cat="<?php echo $value['cat_id'] ?>"