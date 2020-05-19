
<?php 
require("includes/connection.php");
if (isset($_POST['submit'])) {
	$name=$_POST['namecat'];
	$image=uniqid();
	$tmp_name=$_FILES['image']['tmp_name'];
	$path= "uploads/category/";
	if(!is_dir($path.$name)){
		mkdir($path.$name);
		$pathImage=$path.$name."/".$image;
	}else
	{
		$pathImage=$path.$name."/".$image;
	}
	move_uploaded_file($tmp_name, $pathImage);
	$query="INSERT INTO category(cat_name,cat_image) 
	VALUES('$name','$image')";
	mysqli_query($conn,$query);
	header("location:manage_category.php");

}
if (isset($_POST['edit'])) {
	$id=$_POST['id_cat'];
	$name=$_POST['name_cat'];
	$old_name=$_POST['cat_old'];
	$image_cat=$_POST['image_cat'];
	$error=$_FILES['image']['error'];
	if ($cat_old!=$name) {
		$path="uploads/category/";
		if (!is_dir($path.$name)) {
			mkdir($path.$name);
			if (!$error){
				$image=uniqid();
				$tmp_name=$_FILES['image']['tmp_name'];
				$path= "uploads/category/".$name."/".$image;
				move_uploaded_file($tmp_name, $path);
				$Image=$image;
				unlink($image_cat);
			}else{
				$old="uploads/category/".$old_name."/".$image_cat;
				$path= "uploads/category/".$name."/".$image_cat;
				rename($old, $path);
				$Image=$image_cat;
			}
		}else{
			if (!$error){
				$image=uniqid();
				$tmp_name=$_FILES['image']['tmp_name'];
				$path= "uploads/category/".$name."/".$image;
				move_uploaded_file($tmp_name, $path);
				$Image=$image;
				unlink($image_cat);
			}else{
				$old="uploads/category/".$old_name."/".$image_cat;
				$path= "uploads/category/".$name."/".$image_cat;
				rename($old, $path);
				$Image=$image_cat;
			}
		}
	}else{
		if (!$error) {
			$image=uniqid();
			$tmp_name=$_FILES['image']['tmp_name'];
			$path= "uploads/category/".$old_name."/".$image;
			move_uploaded_file($tmp_name, $path);
			$Image=$image;
		}else
		{
			$Image=$image_cat;
		}
	}
	$query="UPDATE category SET cat_name='$name',
	cat_image='$Image'
	WHERE cat_id='$id'";
	$result=mysqli_query($conn,$query);
	if ($result) {
		header("location:manage_category.php");
	}else
	{ 
		echo "no";
	}
}
if (isset($_GET['d_id'])) {
	$id=$_GET['d_id'];
	$query="DELETE FROM category WHERE cat_id='$id'";
	mysqli_query($conn,$query);
	header("location:manage_category.php");
}



?>
<?php require("includes/header.php"); ?>
<!-- Modal -->
<div class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit category</h5>
				<button type="button" class="close btnclose" data-dismiss="modal"><span>&times;</span></button>
			</div>

			<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<!-- <label>ID:</label> -->
						<input type="hidden" name="id_cat" id="id_cat" class="form-control">
					</div>
					<div class="form-group">
						<label>Category Name</label>
						<input type="text" name="name_cat" id="name_cat" class="form-control">
						<input type="hidden" name="cat_old" id="cat_old" class="form-control">	
					</div>
					<div class="form-group">
						<label>Category Image</label>
						<input type="file" name="image" class="form-control">
						<input type="hidden" name="image_cat" id="image_cat" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
					<button type="submit" name="edit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- basic modal end -->
<div class="main-content-inner">
	<div class="col-lg-6 col-ml-12">
		<div class="row">
			<!-- basic form start -->
			<div class="col-12 mt-5">
				<div class="card">
					<div class="card-body">
						<h4 class="header-title text-center"> Add Category</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label >Name Category</label>
								<input type="text" class="form-control" name="namecat" autocomplete="off" required placeholder="Enter Category name">
							</div>
							<div class="form-group ">
								<label  class="control-label mb-1">Image Category</label>
								<input id="cc-name" required name="image" type="file" class="form-control cc-name valid" >
								<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
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
				<h4 class="header-title text-center mb-4">Category Information</h4>
				<div class="table">
					<table class="table">
						<tbody>
							<tr style="background-color: #333;height: 60px; color: #fff; line-height: 30px;" >
								<td>Category ID</td>
								<td>Category Name</td>
								<td>Category Image</td>
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							$query="SELECT * FROM category";
							$result=mysqli_query($conn,$query);
							foreach ($result as $key => $value) { ?>
								<tr>
									<form method="post">
										<td><?php echo $value['cat_id']?></td>
										<td><?php echo $value['cat_name']?></td>
										<td><img style="width:100px; height:100px" src="uploads/category/<?php echo $value['cat_name'].'/'. $value['cat_image']?>"></td>
										<td>
											<button type='button' data-id="<?php echo $value['cat_id']?>" data-name="<?php echo $value['cat_name']?>" data-image="<?php echo $value['cat_image']?>" class='btn btn-info editbtn'>Edit</button>
										</td>
										<td>
											<input type="button" class="btn btn-danger " onClick="deleted(<?php echo $value['cat_id']?>)" name="Delete" value="Delete">
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
		<?php require("includes/footer.php"); ?>
		<script language="javascript">
			function deleted(dil) {
				if (confirm("Do you want to delete")) {
					window.location.href='manage_category.php?d_id='+dil+'';
					return true;
				}
			}

		</script>
	</script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
			$('.editbtn').on('click',function(){
				$('.modal').show();
				var id = $(this).attr('data-id');
				var name = $(this).attr('data-name');
				var image = $(this).attr('data-image');
				$('#id_cat').val(id);
				$('#name_cat').val(name);
				$('#cat_old').val(name);

				$('#image_cat').val(image);

			});
			$('.btnclose').on('click',function(){
				$('.modal').hide();
			});

			$('#password_category').focus(function(event){
				$('#alertedit').hide();
			});
		});
	</script>