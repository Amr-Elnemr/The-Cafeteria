<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('page5.php');
// session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<title>All products</title>
	<link rel="stylesheet" type="text/css" href="pg5.css">
</head>
<body>
	<div>
		<a class="menu" href="">Home</a>
		<a class="menu" href="">Products</a>
		<a class="menu" href="">Users</a>
		<a class="menu" href="products.php">Manual Order</a>
		<a class="menuLast" href="">Checks</a>

		<span id='adm'>
			<img id="usrImg" src="user.png">
			<a id="usrName" href="">Admin</a>
		</span>

	</div>

	<div id="line2">
		<a id="title">All Products</a>
		<span><a id="addProduct" href="pg8.php">Add product</a></span>
	</div>

	<table>
		<tr>
			<th>Product</th>
			<th>Price</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
		<!-- <tr>
			<td>Tea</td>
			<td>5 EGP</td>
			<td></td>
			<td>
				<a href="">Available</a>
				<a href="">Edit</a>
				<a href="">Delete</a>
			</td>
		</tr>

		<tr>
			<td>Nescafe</td>
			<td>7 EGP</td>
			<td></td>
			<td>
				<a href="">Available</a>
				<a href="">Edit</a>
				<a href="">Delete</a>
			</td>
		</tr>

		<tr>
			<td>Coffee</td>
			<td>6 EGP</td>
			<td></td>
			<td>
				<a href="">Available</a>
				<a href="">Edit</a>
				<a href="">Delete</a>
			</td>
		</tr>
 -->
	</table>

<!-- ---------------------------------------------------- -->
	<script type="text/javascript">
		class admin
		{
			showproducts(id, prod, pric, imag, ava)
			{
				var table=document.getElementsByTagName("table")[0].children[0];
				var row = document.createElement("tr");
				var product=document.createElement("td");
				product.textContent=prod;
				var price=document.createElement("td");
				price.textContent=pric + " EGP";
				var image=document.createElement("td");
				var pic = document.createElement("img");
				pic.src = imag;
				pic.width = "50";
				image.appendChild(pic);
				var actions=document.createElement("td");
				var available=document.createElement("a");
				available.textContent=ava;
				available.href="page5.php?aid=" + id
				var edit= document.createElement("a");
				edit.textContent="Edit";
				edit.href="page5.php?eid=" + id
				var delet= document.createElement("a");
				delet.textContent="Delete";
				delet.href="page5.php?did=" + id
				actions.appendChild(available);
				actions.appendChild(edit);
				actions.appendChild(delet);
				row.appendChild(product);
				row.appendChild(price);
				row.appendChild(image);
				row.appendChild(actions);
				table.appendChild(row);
			}

		}
		var p=new admin;

		var ids = <?php echo json_encode($_SESSION['ids']); ?>;
		var products = <?php echo json_encode($_SESSION['productList']); ?>;
		var prices = <?php echo json_encode($_SESSION['prices']); ?>;
		var images = <?php echo json_encode($_SESSION['images']); ?>;
		var available = <?php echo json_encode($_SESSION['available']); ?>;

		var noOfRows= <?php echo count($_SESSION['ids']); ?>;
		var i=0;
		var status;
		while (i< noOfRows)
		{
			available[i]=="true"? status="Available" : status="Unavailable"
			p.showproducts(ids[i], products[i], prices[i], images[i], status);
			i++;
		}


	</script>
<!-- -------------------------------------------------------- -->
	<!-- <script type="text/javascript" src="pg5js.php"></script> -->
</body>
</html>
