<?php
	// GET POST DATA
	$requestType = $_SERVER['REQUEST_METHOD'];

	if($requestType == 'POST') {
		//print_r($_POST);
		$product_name 			= $_POST['proname'];
		$product_sku 			= $_POST['prosku'];
		$product_price 			= $_POST['proprice'];
		$product_height 		= $_POST['proheight'];
		$product_width 			= $_POST['prowidth'];
		$product_weight 		= $_POST['proweight'];
		$product_category 		= $_POST['procategory'];
		$product_description 	= $_POST['prodesc'];

		if(isset($_FILES)) {
			// Product Image Upload (Reference here: https://www.w3schools.com/php/php_file_upload.asp)
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["proimage"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["proimage"]["tmp_name"], $target_file)) {
			        //echo "The file ". basename( $_FILES["proimage"]["name"]). " has been uploaded.";
			        $proimage = $_FILES["proimage"]["name"];
			        $successimage = 1;
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		}
	}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sampleproductdata";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO product (product_name, product_price, product_sku, product_height, product_width, 	product_weight, product_category, product_image, product_description)
	VALUES ('".$product_name."', '".$product_price."', '".$product_sku."', '".$product_height."', '".$product_width."','".$product_weight."', '".$product_category."', '".$proimage."', '".$product_description."')";

	session_start();
	if ($conn->query($sql) === TRUE) {
	    $_SESSION["success_message"] =  "New record created successfully";
	} else {
	    $_SESSION["success_message"] = "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	header('Location: product_view.php');
?>