<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="pg8.css">

</head>
<body>


	<div>
		<a class="menu" href="">Home</a>
		<a class="menu" href="pg5.php">Products</a>
		<a class="menu" href="">Users</a>
		<a class="menu" href="">Manual Order</a>
		<a class="menuLast" href="">Checks</a>

		<span id='adm'>
			<img id="usrImg" src="user.png">
			<a id="usrName" href="">Admin</a>
		</span>
	</div>

	 <div id="line2">
		<a id="title">Add Product</a>
	</div>

	<form method="post" action="page5.php">
	<table>
		<tr>
			<th id="label">Product</th>
			<th><input type="type" name="product" required></th>
			<th>
				<?php
					if(isset($_GET['dupError']))
					{
						echo "<p>This Product already exists!!</p>";
					}
				?>
				
			</th>
		</tr>
		<tr>
			<th id="label">Price</th>
			<th><input type="number" name="price" required><span id="egp">EGP</span>
			</th>
		</tr>
		<tr>
			<th id="label">Category</th>
			<th>
				<select type="checkbox" name="category" id="category-input">
	  			<option>Hot Drinks</option>
	  			<option>Cold Drinks</option>
	  			</select><a id ="add-category" href="#">Add Category</a>
	  		</th>
		</tr>
		<tr>
			<th id="label">Product Picture</th>
			<th>
				<input type="file" name="product pic" class="input" id="product-pic-input">
			</th>
		</tr>
	</table>
		<br>
		<div>
			<button type="submit" name="submit" class="button">Submit</button>
		  	<button type="reset" name="reset" class="button">Reset</button>
		 </div>
	</form>

</body>
</html>