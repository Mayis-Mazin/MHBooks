<?php 
session_start();
if (isset($_GET['pro_id'])) {
	// $_SESSION['product']=array_diff($_SESSION['product'],$prod_id);
	session_unset($_SESSION['product']);
	// echo "<pre>";
	// print_r($_SESSION['product']);
	// die;	

}