<?php 
require("includes/connection.php");
$query="SELECT *FROM sub_cat inner join category on sub_cat.cat_id=category.cat_id
and sub_id={$_GET['id']}";
$result=mysqli_query($conn,$query);
$sub=mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
	$id       =$_GET['id'];
	$name     =$_POST['name'];
	$cat      =$_POST['cat'];

	$query="UPDATE sub_cat SET sub_name='$name',
							   cat_id='$cat'
						 WHERE sub_id='$id'";
	$result=mysqli_query($conn,$query);
	if ($result) {
		header("location:manage_subcat.php");
	}else
	{ 
		echo "no";
	}
}
 ?>
<?php include("includes/header.php") ?>
<div class="main-content-inner">
	<div class="col-lg-6 col-ml-12">
		<div class="row">
			<!-- basic form start -->
			<div class="col-12 mt-5">
				<div class="card">
					<div class="card-body">
						<h4 class="header-title text-center"> Edit Subcategory</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label >Name Subcategory</label>
								<input type="text" class="form-control" name="name" autocomplete="off" required placeholder="Enter Sub Category name" value="<?php echo $sub['sub_name'] ?>">
							</div>
							<div class="form-group">
								<div class="form-group has-success">
									<label for="cc-name" class="control-label mb-1">Category Name</label>
									<select id="inputState" class="form-control p-1" name="cat" required>
										<option selected  value="<?php echo $sub['cat_id'] ?>"><?php echo $sub['cat_name'] ?></option>
										<?php  
										$query="SELECT * FROM category";
										$result=mysqli_query($conn,$query);
										while ($cat=mysqli_fetch_assoc($result))
											{ ?>
												<option value='<?php echo $cat['cat_id'] ?>'><?php echo $cat['cat_name']?>

											</option>
										<?php } ?>
										?>
									</select>  
								</div>
							</div>
							<button type="submit" name="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<!-- basic form end -->
		</div>


		<?php include("includes/footer.php") ?>
		<script type="text/javascript">
		$(document).ready(function(){
			var placeholder = '';
			$('#alertedit').hide();
			$('#alert').hide();
			$('input').on('focus',function(){
				placeholder = $(this).attr('placeholder');
				$(this).attr('placeholder', '');
				$(this).css('border-color','#007bff');
			});

			$('input').on('blur',function(){
				$(this).attr('placeholder',placeholder);
				placeholder = '';
				$(this).css('border-color','#ced4da');

			});
			
			$('.btnclose').on('click',function(){
				$('.modal').hide();
			});

			$('#password_category').focus(function(event){
				$('#alertedit').hide();
			});
		});
	</script>
