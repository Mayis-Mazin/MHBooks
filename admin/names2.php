<?php
$conn = mysqli_connect("localhost","root","","curtains");
$result = mysqli_query($conn, "SELECT * FROM sub_cat where cat_id={$_GET['catId']}");
$row = mysqli_fetch_assoc($result);
echo "<option disabled selected>Choose...</option>";
foreach ($result as $key => $value) {
	
echo "<option value='{$value['sub_id']}'>{$value['sub_name']}</option>";
}
