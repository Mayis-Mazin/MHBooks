<?php
require("includes/connection.php");
if (isset($_POST['submit'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$name=$_POST['name'];
	if (isset($_FILES['image'])) {
		$image=uniqid();
		$tmp_name=$_FILES['image']['tmp_name'];
		$path= "uploads/admin/".$image;
		if(move_uploaded_file($tmp_name, $path)){
			$Image="uploads/admin/".$image;
		}else
		{
			$Image="uploads/admin/avatar.png";
		}
	}
	if($password==$cpassword){
		// $password=md5($password);
		$query="SELECT admin_email FROM admin WHERE admin_email=$email";
		$result=mysqli_query($conn,$query);
		$row=mysqli_fetch_assoc($result);
		if($row){
			$msg ="This account does exist";
		}else{

			$query="INSERT INTO admin(admin_email,admin_password,fullName,admin_image)
			VALUES('$email','$password','$name','$Image')";
			mysqli_query($conn,$query);
			header("location:index.php");
		}
	}else
	{
		$msg= "password not matched";
	}
}

if (isset($_POST['edit'])) {
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
	if ($result) {
		header("location:index.php");
	}
}

if (isset($_GET['d_id'])) {
	$id=$_GET['d_id'];
	$query="DELETE FROM admin WHERE admin_id='$id'";
	$row=mysqli_query($conn,$query);

	header("location:index.php");
}
?>

<?php  require("includes/header.php"); ?>
<!-- Modal -->
<div class="modal" id="exampleModalLong">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Admin</h5>
				<button type="button" class="close btnclose" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-group">
					<!-- <label>ID:</label> -->
					<input type="hidden" name="id_admin" id="id_admin" class="form-control">
				</div>
				<div class="form-group">
					<label>Full Name</label>
					<input type="text" name="name_admin" id="name_admin" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email_admin" id="email_admin" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password_admin" id="password_admin" class="form-control">
					<div id="alertedit" class="alert alert-danger text-center mt-4" role="alert">
							Password must have at least 8 symbols</div>
				</div>
				<div class="form-group">
					<label>Profile Image</label>
					<input type="file" name="image" class="form-control">
					<input type="hidden" name="image_admin" id="image_admin" class="form-control">
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
						<h4 class="header-title text-center"> Add Admin</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label >Full name</label>
								<input type="text" class="form-control" name="name" autocomplete="off" required placeholder="Enter Full name">
							</div>
							<div class="form-group">
								<label >User name or Email</label>
								<input type="text" class="form-control" name="email" autocomplete="off" required placeholder="Enter user name or email">
							</div>
							<div class="form-group">
								<label >Password</label>
								<input type="password" class="form-control" id="password" autocomplete="off" name="password" required placeholder="Password">
							</div>
							<div class="form-group">
								<label >Confirm Password</label>
								<input type="password" class="form-control" autocomplete="off" name="cpassword" required placeholder="Confirm Password">
							</div>
							<div class="form-group ">
								<label  class="control-label mb-1">Image profile</label>
								<input id="cc-name" name="image" type="file" class="form-control cc-name valid" >
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
		<!-- order list area start -->
		<div class="card mt-5">
			<div class="card-body">
				<h4 class="header-title text-center mb-4">Admins Information</h4>
				<div class="table">
					<table class="table">
						<tbody>
							<tr style="background-color: #333;height: 60px; color: #fff; line-height: 30px;" >
								<td>admin ID</td>
								<td>admin Name</td>
								<td>admin Email</td>
								<td>Profile Image</td>
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							$query="SELECT * FROM admin";
							$result=mysqli_query($conn,$query);
							foreach ($result as $key => $value) { ?>
								<tr>
									<form method="post">
										<td><?php echo $value['admin_id']?></td>
										<td><?php echo $value['fullName']?></td>
										<td><?php echo $value['admin_email']?></td>
										<td><img style="width:100px; height:100px" src="<?php echo $value['admin_image']?>"></td>
										<td>
											<button type='button' data-id="<?php echo $value['admin_id']?>" data-name="<?php echo $value['fullName']?>" data-email="<?php echo $value['admin_email']?>" data-pass="<?php echo $value['admin_password']?>" data-image="<?php echo $value['admin_image']?>" class='btn btn-info editbtn'>Edit</button>
										</td>
										<td>
											<input type="button" class="btn btn-danger " onClick="deleted(<?php echo $value['admin_id']?>)" name="Delete" value="Delete">
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
		<!-- order list area end -->
		<?php 
		require("includes/footer.php");
		?>
		<script language="javascript">
			function deleted(dil) {
				if (confirm("Do you want to delete")) {
					window.location.href='index.php?d_id='+dil+'';
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
				$('.editbtn').on('click',function(){
					$('.modal').show();
					var id = $(this).attr('data-id');
					var name = $(this).attr('data-name');
					var email = $(this).attr('data-email');
					var password = $(this).attr('data-pass');
					var image = $(this).attr('data-image');
					$('#id_admin').val(id);
					$('#name_admin').val(name);
					$('#email_admin').val(email);
					$('#password_admin').val(password);
					$('#image_admin').val(image);

				});
				$('.btnclose').on('click',function(){
					$('.modal').hide();
				});

				$('#password_admin').focus(function(event){
					$('#alertedit').hide();
				});
				$('#password_admin').blur(function(event){
					if($('#password_admin').val().length <8 )
					{
						$('#alertedit').show();
						$('#password_admin').css('border-color','#dc3545');

					} 
					else {
						$('#alertedit').hide();
					}
				});

			});
		</script>