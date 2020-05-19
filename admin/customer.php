<?php 
require('includes/connection.php');

if (isset($_GET['d_id'])) {
	$id=$_GET['d_id'];
	$query="DELETE FROM customer WHERE cust_id='$id'";
	$row=mysqli_query($conn,$query);

	header("location:index.php");
}
if (isset($_POST['edit'])) {
	$id=$_POST['id_cust'];
	$name=$_POST['name_cust'];
	$email=$_POST['email_cust'];
	$mobile=$_POST['mobile_cust'];
	$password=$_POST['password_cust'];
	$query="UPDATE customer SET cust_name='$name',cust_email='$email',cust_password='$password',cust_mobile='$mobile' WHERE cust_id='$id' ";
	$result=mysqli_query($conn,$query);
	if ($result) {
		header("location:customer.php");
	}else
	{
		echo "no";
	}

}


 ?>
<?php include('includes/header.php') ?>
<!-- Modal -->
<div class="modal" id="exampleModalLong">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit cust</h5>
				<button type="button" class="close btnclose" data-dismiss="modal"><span>&times;</span></button>
			</div>
			<form action="" method="post">
			<div class="modal-body">
				<div class="form-group">
					<!-- <label>ID:</label> -->
					<input type="hidden" name="id_cust" id="id_cust" class="form-control">
				</div>
				<div class="form-group">
					<label>Full Name</label>
					<input type="text" name="name_cust" id="name_cust" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email_cust" id="email_cust" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" name="mobile_cust" id="mobile_cust" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password_cust" id="password_cust" class="form-control">
					<div id="alertedit" class="alert alert-danger text-center mt-4" role="alert">
							Password must have at least 8 symbols</div>
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
		<!-- order list area start -->
		<div class="card mt-5">
			<div class="card-body">
				<h4 class="header-title text-center mb-4">Customer Information</h4>
				<div class="table">
					<table class="table">
						<tbody class="text-center">
							<tr style="background-color: #333;height: 60px; color: #fff; line-height: 30px;" >
								<td>ID</td>
								<td>Name</td>
								<td>Email</td>
								<td>Mobile</td>
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							$query="SELECT * FROM customer";
							$result=mysqli_query($conn,$query);
							foreach ($result as $key => $value) { ?>
								<tr>
									<form method="post">
										<td><?php echo $value['cust_id']?></td>
										<td><?php echo $value['cust_name']?></td>
										<td><?php echo $value['cust_email']?></td>
										<td><?php echo $value['cust_mobile']?></td>
										<td>
											<button type='button' data-id="<?php echo $value['cust_id']?>" data-name="<?php echo $value['cust_name']?>" data-email="<?php echo $value['cust_email']?>" data-pass="<?php echo $value['cust_password']?>" data-mobile="<?php echo $value['cust_mobile'] ?>" class='btn btn-info editbtn'>Edit</button>
										</td>
										<td>
											<input type="button" class="btn btn-danger " onClick="deleted(<?php echo $value['cust_id']?>)" name="Delete" value="Delete">
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
	</div>


	<?php include('includes/footer.php') ?>
	<script language="javascript">
			function deleted(dil) {
				if (confirm("Do you want to delete")) {
					window.location.href='customer.php?d_id='+dil+'';
					return true;
				}
			}

		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#alertedit').hide();
				$('.editbtn').on('click',function(){
					$('.modal').show();
					var id = $(this).attr('data-id');
					var name = $(this).attr('data-name');
					var email = $(this).attr('data-email');
					var password = $(this).attr('data-pass');
					var mobile = $(this).attr('data-mobile');
					$('#id_cust').val(id);
					$('#name_cust').val(name);
					$('#email_cust').val(email);
					$('#password_cust').val(password);
					$('#mobile_cust').val(mobile);

				});
				$('.btnclose').on('click',function(){
					$('.modal').hide();
				});
				$('#password_cust').focus(function(event){
					$('#alertedit').hide();
				});
				$('#password_cust').blur(function(event){
					if($('#password_cust').val().length <8 )
					{
						$('#alertedit').show();
						$('#password_cust').css('border-color','#dc3545');

					} 
					else {
						$('#alertedit').hide();
					}
				});
			});
		</script>