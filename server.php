<?php
	session_start();
	include ("connection.php");
	$requestType = $_SERVER['REQUEST_METHOD'];

	if($requestType == 'POST') {
		if (isset($_POST['delete'])) {
			$product_id = $_POST['product_id'];

			//Delete product associated image first then delete product
			// image delete code goes here...... you need to write the code hints: unlink function in php

			$sql = "DELETE FROM product WHERE product_id=$product_id";
			if ($conn->query($sql) === TRUE) { 
				$_SESSION['success_message'] = "Product deleted Successfully!";
			}
			header('location: product_view.php'); 
		} 

		if (isset($_POST['update_product'])) {
			print_r($_POST);
			// please write the code for update product as per insert product information
		}
	}
?>