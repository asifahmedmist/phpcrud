<?php 
	session_start();
	include ("connection.php");
	$requestType = $_SERVER['REQUEST_METHOD'];

	if($requestType == 'POST') {
		if (isset($_POST['update'])) {
			$product_id = $_POST['product_id'];

			$sql = "SELECT * FROM product WHERE product_id = $product_id";
			$result = $conn->query($sql);
		}
	}	
	$filepath = 'http://localhost/phpcrud/uploads/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product Update</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container" style="padding: 10px; margin-top: 20px; border: 2px solid #000; border-radius: 2px; ">
		<h2 style="text-align: center; color: #d08c23; ">UPDATE PRODUCT</h2>
	
		<form action="server.php" method="POST" enctype="multipart/form-data">
			<?php while($row = $result->fetch_assoc()) { ?>
			<div class="form-group">
				<label for="productName">Product Name</label>
				<input type="text" class="form-control" name="proname" placeholder="Enter Product Name" value="<?php echo $row["product_name"]; ?>" required>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputCity">Product SKU</label>
					<input type="text" class="form-control" name="prosku" value="<?php echo $row["product_sku"]; ?>" required>
				</div>
				<div class="form-group col-md-6">
					<label for="inputState">Product Price</label>
					<input type="text" class="form-control" name="proprice" value="<?php echo $row["product_price"]; ?>" required>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="inputCity">Height</label>
					<input type="text" class="form-control" name="proheight" value="<?php echo $row["product_height"]; ?>">
				</div>
				<div class="form-group col-md-4">
					<label for="inputState">Width</label>
					<input type="text" class="form-control" name="prowidth" value="<?php echo $row["product_width"]; ?>">
				</div>
				<div class="form-group col-md-4">
					<label for="inputZip">Weight</label>
					<input type="text" class="form-control" name="proweight" value="<?php echo $row["product_weight"]; ?>">
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputCity">Product Category</label>
					<select class="custom-select my-1 mr-sm-2" name="procategory" required>
						<option selected>Select Categort</option>
						<option value="1" <?php if($row["product_category"] == 1) { ?> selected="selected" <?php } ?> >Shirt</option>
						<option value="2" <?php if($row["product_category"] == 2) { ?> selected="selected" <?php } ?>>Pant</option>
						<option value="3" <?php if($row["product_category"] == 3) { ?> selected="selected" <?php } ?>>Saree</option>
						<option value="4" <?php if($row["product_category"] == 4) { ?> selected="selected" <?php } ?>>Shalwar Kameez</option>
						<option value="5" <?php if($row["product_category"] == 5) { ?> selected="selected" <?php } ?>>Jewellery</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="inputState">Product Image</label>
					<input type="file" class="custom-file-input" name="proimage">
					<label class="custom-file-label" for="customFile" style="margin-top: 35px; margin-left: 5px;">Choose file</label>
				</div>
				<div class="currentImage col-md-2">
					<img src="<?php echo $filepath.$row["product_image"] ?>" width="50" height="50">
				</div>
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Product Description</label>
				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="prodesc"><?php echo $row["product_description"]; ?></textarea>
			</div>

			

			<button class="btn btn-primary" type="submit">Update Product Information</button>
			<input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
			<input type="hidden" name="update_product">
			<?php } ?>
		</form>
	</div>

	<script>
        $('.custom-file-input').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>

</body>
</html>