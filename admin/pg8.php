<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(isset($_GET['add']) && ($_GET['add']==1))
{
	unset($_SESSION['storName']); //to remove any stored values through editProduct();
	unset($_SESSION['storPrice']);
	unset($_SESSION['storImage']);
	unset($_SESSION['eid']);
}

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
		<a class="menu" href="order.php">Home</a>
		<a class="menu" href="pg5.php">Products</a>
		<a class="menu" href="pg6.php">Users</a>
		<a class="menu" href="products.php">Manual Order</a>
		<a class="menuLast" href="class_admin.php">Checks</a>

		<span id='adm'>
			<img id="adminimage" >
			<a id="admin" href=""></a>
		</span>
	</div>

	 <div id="line2">
		<a id="title"><?php if(isset($_SESSION['storName'])){echo "Edit User";} else {echo "Add User";}?></a>
	</div>

	<form method="post" action="page5.php">
	<table>
		<tr>
			<th id="prodLab">Product</th>
			<th><input type="type" name="product" id="prodIn" required value="<?php if(isset($_SESSION['storName'])){echo $_SESSION['storName'];}?>"></th>
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
			<th id="priceLab">Price</th>
			<th><input type="number" name="price" required value="<?php if(!empty($_SESSION['storPrice'])){echo $_SESSION['storPrice'];}?>"><span id="egp">EGP</span>
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
			<th id="picLab">Product Picture</th>
			<th>
				<input type="file" name="" class="input" id="product-pic-input" value="<?php if(!empty($_SESSION['storImage'])){echo $_SESSION['storImage'];}?>">
				<input type="hidden" name="productpic" value="" id="pic">
			</th>
		</tr>
	</table>
		<br>
		<div>
			<button type="submit" name="submit" class="button">Submit</button>
		  	<button type="reset" name="reset" class="button">Reset</button>
		 </div>
	</form>

	<script type="text/javascript">
		let currentUser = <?php echo json_encode($_SESSION['userInfo']); ?>;
		document.getElementById("admin").textContent = currentUser['name'];
		document.getElementById("adminimage").src = currentUser['image'];
		let image = document.getElementById('product-pic-input');
		image.addEventListener("change", addImage);

		function addImage(e) {
			let name = image.value;
    		name = name.split('\\');
    		name = name[2];
			name = "../imgs/products/" + name;
			document.getElementById('pic').setAttribute("value", name);

		}
	</script>

</body>
</html>
