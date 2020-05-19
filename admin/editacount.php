<?php
session_start();
require("includes/connection.php");
if (isset($_POST['submit'])) {
	$id=$_POST['id_admin'];
	$name=$_POST['name_admin'];
	$email=$_POST['email_admin'];
	$password=$_POST['password_admin'];
	$image_admin=$_POST['image_admin'];
	$error=$_FILES['image']['error'];
	if (!$error) {
		$image=$_FILES['image']['name'];
		$tmp_name=$_FILES['image']['tmp_name'];
		$path= "uploads/admin/".$image;
		if(move_uploaded_file($tmp_name, $path)){	
			$Image="uploads/admin/".$image;
			unlink($image_admin);
		}
	}else
	{
		$Image=$image_admin;
	}
	$query="UPDATE admin SET admin_email='$email',
							 admin_password='$password',fullName='$name',
							 admin_image='$Image' WHERE admin_id='$id'";
	$result=mysqli_query($conn,$query);
	$query="SELECT * FROM admin WHERE admin_id =$id";
	$result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    if(isset($row['admin_id'])){

        $_SESSION=$row;
        header('location:index.php');
    }
    else
    {
        $massage= "USER NOT FOUND";
    }
	// header("location:index.php");
	
}
$id=$_GET['id'];
$query="SELECT * FROM admin WHERE admin_id='$id'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);

?>
<?php  require("includes/header.php"); ?>
<div class="main-content-inner">
	<div class="col-lg-6 col-ml-12">
		<div class="row">
			<!-- basic form start -->
			<div class="col-12 mt-5">
				<div class="card">
					<div class="card-body">
						<h4 class="header-title text-center"> Edit Admin</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<!-- <label >ID</label> -->
								<input type="hidden" class="form-control" name="id_admin" autocomplete="off" required placeholder="Enter Full name" value="<?php echo $row['admin_id'] ?>">
							</div>
							<div class="form-group">
								<label >Full name</label>
								<input type="text" class="form-control" name="name_admin" autocomplete="off" required placeholder="Enter Full name" value="<?php echo $row['fullName'] ?>">
							</div>
							<div class="form-group">
								<label >User name or Email</label>
								<input type="text" class="form-control" name="email_admin" autocomplete="off" required placeholder="Enter user name or email" value="<?php echo $row['admin_email']  ?>">
							</div>
							<div class="form-group">
								<label >Password</label>
								<input type="text" class="form-control" name="password_admin" id="password" autocomplete="off" value="<?php echo $row['admin_password']  ?>" required placeholder="Password">
							</div>
							<div class="form-group ">
								<label  class="control-label mb-1">Image profile</label>
								<input id="cc-name" name="image" type="file" class="form-control cc-name valid" >
								<input type="hidden" name="image_admin" value="<?php echo $row['admin_image']  ?>" class="form-control" >
								
								<span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
							</div>
							<div id="alert" class="alert alert-danger text-center" role="alert">
							Password must have at least 8 symbols</div>
							<?php if (isset($msg)) { ?>
								<div class="alert alert-danger text-center" role="alert">
									<?php echo $msg ?>
								</div>
							<?php }?>
							<button type="submit" name="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<!-- basic form end -->
		</div>
		<?php 
		require("includes/footer.php");
		?>
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
				$('#password').focus(function(event){
					$('#alert').hide();
				});
				$('#password').blur(function(event){
					if($('#password').val().length <8 )
					{
						$('#alert').show();
						$('#password').css('border-color','#dc3545');

					} 
					else {
						$('#alert').hide();
					}
				});

			});
		</script>