<!DOCTYPE html>
<html>
<head>
	<title>page7</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="page8.css">

</head>
<body>


	  <div class="nav">
	  	<a href="#">Home</a> |
	  	<a href="#">Products</a> |
	  	<a href="#">Users</a> |
	  	<a href="#">Manual Order</a> |
	  	<a href="#">Checks</a>
	  </div>
	  <div class="admin">
	  	<img src="profile.png" width=50 height=50>
	  	<h3>Admin</h3>
	  </div>
	  <br><br>
	  <div class="container">
	  	<form method="post" action="#">
	  		<h3>Add Product</h3>
	  		<br><br>
	  		Product<input type="text" name="product" class="input" id="product-input"><br><br>
	  		Price<input type="number" name="Price" class="input" id="price-input"><h6>EGP</h6><br><br>
	  		Category<select type="checkbox" name="category" class="input" id="category-input">
	  			<option>First</option>
	  			<option>second</option>
	  			<option>third</option>
	  			<option>fourth</option>
	  			</select><a id ="add-category" href="#">Add Category</a><br><br>
	  		product picture<input type="file" name="product pic" class="input" id="product-pic-input"><br><br>
	  		<button type="submit" name="submit" class="button">Submit</button>
	  		<button type="reset" name="reset" class="button">Reset</button>
	  	</form>
	  	
	  </div>

</body>
</html>