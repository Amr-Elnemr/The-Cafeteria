<?php
ob_start();
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
    <style>
      .fontfamily{
        font-family: "Allerta Stencil", Sans-serif;
      }
	  </style>
</head>
<body>
	<div class="container">
      <div class="jumbotron">
      <a href="order.php"><b class="fontfamily">Home</b></a>
      <b> | </b>
      <a href="pg5.php"><b class="fontfamily">Products</b></a>
        <b> | </b>
      <a href="pg6.php"><b class="fontfamily">Users</b></a>
        <b> | </b>
      <a href="products.php"><b class="fontfamily">Manual Orders</b></a>
        <b> | </b>
      <a href="class_admin.php"><b class="fontfamily">Checks</b></a>

      <b class="pull-right"><br>&nbsp;	&nbsp;	<u id="admin" class="pull-right"></u></b>
      <img id="adminimage" class="img-responsive img-circle pull-right" style="display:inline" width="60" height="60">
      <br>
      <h2 class="fontfamily">Products</h2>
	  <div id="line2">
  		<span class="pull-right"><a id="addProduct" href="pg8.php?add=1">Add product</a></span>
  	</div>
      </div>
    </div>


	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr class="bg-primary">
					<th>Product</th>
					<th>Price</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>

			<!-- tr>
				<td>ahmed</td>
				<td>1201</td>
				<td>image</td>
				<td>6065</td>
				<td>
					<a href="">Edit</a>
					<a href="">Delete</a>
				</td>
			</tr> -->

		</table>
	</div>


<!-- ---------------------------------------------------- -->
	<script type="text/javascript">
	let currentUser = <?php echo json_encode($_SESSION['userInfo']); ?>;
	document.getElementById("admin").textContent = currentUser['name'];
	document.getElementById("adminimage").src = currentUser['image'];
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
				actions.appendChild(document.createTextNode('  '));
				actions.appendChild(edit);
				actions.appendChild(document.createTextNode('  '));
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
		// console.log(images);
		while (i< noOfRows)
		{
			available[i]=="true"? status="Available" : status="Unavailable"
			p.showproducts(ids[i], products[i], prices[i], images[i], status);
			i++;
		}


	</script>
<!-- -------------------------------------------------------- -->

</body>
</html>
