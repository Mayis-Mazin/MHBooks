<?php require("includes/connection.php") ;

if (isset($_POST['submit'])) {
	$name =$_POST['namecat'];
	$cat  =$_POST['cat'];
	$query="SELECT * FROM category where cat_id=$cat";
	$result=mysqli_query($conn,$query);
	$category=mysqli_fetch_assoc($result);
	// $cat_name=$category['cat_name'];
	// $image=uniqid();
	// $tmp_name=$_FILES['image']['tmp_name'];
	// $path= "uploads/category/".$image;
	// move_uploaded_file($tmp_name,$path);
	$query="INSERT INTO sub_cat(sub_name,cat_id)
						values('$name','$cat') ";
	mysqli_query($conn,$query);
	header("manage_subcat.php");
}

if (isset($_GET['d_id'])) {
	$id=$_GET['d_id'];
	$query="DELETE FROM sub_cat WHERE sub_id='$id'";
	mysqli_query($conn,$query);
	header("location:manage_subcat.php");
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
						<h4 class="header-title text-center"> Add Subcategory</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label >Name Subcategory</label>
								<input type="text" class="form-control" name="namecat" autocomplete="off" required placeholder="Enter Sub Category name">
							</div>
							<!-- <div class="form-group ">
								<label  class="control-label mb-1">Image Subcategory</label>
								<input id="cc-name" required name="image" type="file" class="form-control cc-name valid" >
								<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
							</div> -->
							<div class="form-group">
                             <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Category Name</label>
                                <select id="inputState" class="form-control p-1" name="cat" required>
                                    <option value="">Choose....</option>
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
				<!-- order list area start -->
		<div class="card mt-5">
			<div class="card-body">
				<h4 class="header-title text-center mb-4">Subcategory Information</h4>
				<div class="table">
					<table class="table">
						<tbody>
							<tr style="background-color: #333;height: 60px; color: #fff; line-height: 30px;" >
								<td>Subcategory ID</td>
								<td>Subcategory Name</td>
								<!-- <td>Subategory Image</td> -->
								<td>Category Name</td>
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							$query="SELECT * FROM sub_cat inner join category on sub_cat.cat_id=category.cat_id";
							$result=mysqli_query($conn,$query);
							foreach ($result as $key => $value) { ?>
								<tr>
									<form method="post">
										<td><?php echo $value['sub_id']?></td>
										<td><?php echo $value['sub_name']?></td>
										<!-- <td><img style="width:100px; height:100px" src="uploads/category/<?php //echo $value['sub_img']?>"></td> -->
										<td><?php echo $value['cat_name']?></td>
										<td>
											<a href="edit_sub.php?id=<?php echo $value['sub_id']?>" class="btn btn-info">Edit
										</td>
										<td>
											<input type="button" class="btn btn-danger " onClick="deleted(<?php echo $value['sub_id']?>)" name="Delete" value="Delete">
										</td>
									</form>
								</tr>
							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<?php include("includes/footer.php") ?>
<script language="javascript">
	function deleted(dil) {
		if (confirm("Do you want to delete")) {
			window.location.href='manage_subcat.php?d_id='+dil+'';
			return true;
		}
	}
</script>
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
