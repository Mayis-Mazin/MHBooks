<?php
require('includes/connection.php');



?>


<?php include('includes/header.php') ?>
<div class="main-content-inner">
	<div class="col-lg-6 col-ml-12">
		<!-- order list area start -->
		<div class="card mt-5">
			<div class="card-body">
				<h4 class="header-title text-center mb-4">Orders Information</h4>
				<div class="table">
					<table class="table">
						<tbody class="text-center">
							<tr style="background-color: #333;height: 60px; color: #fff; line-height: 30px;" >
								<td>ID</td>
								<td>date</td>
								<td>name Customer</td>
								<td>Mobile</td>
								<td>Statues</td>
								<!-- <td>prodoct name</td> -->
								<!-- <td>qty</td> -->
								<td>Edit</td>
								<td>Delete</td>
							</tr>
							<?php
							$query="SELECT * FROM orders 
							inner join customer on customer.cust_id=orders.cust_id
							inner join order_details on orders.order_id=order_details.order_id
                            INNER join product on product.pro_id=order_details.product_id";
							$result=mysqli_query($conn,$query);
							
							foreach ($result as $key => $value) { ?>
								<tr>
									<form method="post">
										<td><?php echo $value['order_id']?></td>
										<td><?php echo $value['order_date']?></td>
										<td><?php echo $value['cust_name']?></td>
										<td><?php echo $value['cust_mobile']?></td>
										<td><?php echo $value['status']?></td>
										<!-- <td><?php echo $value['pro_name']?></td> -->
										<!-- <td><?php echo $value['qty']?></td> -->
										<td>
											<button type='button' class='btn btn-info editbtn'>Edit</button>
										</td>
										<td>
											<input type="button" class="btn btn-danger " onClick="deleted(<?php echo $value['order_id']?>)" name="Delete" value="Delete">
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
