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
	<title>All Users</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
	<!-- <link rel="stylesheet" type="text/css" href="pg5.css"> -->
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
      <h2 class="fontfamily">Users</h2>
      </div>
    </div>
	<div id="line2">
	  <span class="pull-right fontfamily col-md-3 col-md-offset-8"><a id="addUser" href="addUser.php">Add User</a></span>
	</div>
<br>
<br>

<div class="container">
	<table class="table table-striped">
		<thead>
			<tr class="bg-primary">
				<th>Name</th>
				<th>Room</th>
				<th>Image</th>
				<th>Ext.</th>
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

<!-- ------------------------------------------- -->
<script type="text/javascript">
let currentUser = <?php echo json_encode($_SESSION['userInfo']); ?>;
document.getElementById("admin").textContent = currentUser['name'];
document.getElementById("adminimage").src = currentUser['image'];
class admin
		{
			showusers(id, name, room, imag, ext)
			{
				var table=document.getElementsByTagName("table")[0].children[0];
				var row = document.createElement("tr");
				var uname=document.createElement("td");
				uname.textContent=name;
				var rom=document.createElement("td");
				rom.textContent=room;
				var image=document.createElement("td");
				var pic = document.createElement("img");
				pic.src = imag;
				pic.width = "50";
				image.appendChild(pic);
				var extl=document.createElement("td");
				extl.textContent=ext;
				var actions=document.createElement("td");
				var edit= document.createElement("a");
				edit.textContent="Edit";
				edit.href="edituser.php?ueid=" + id
				var delet= document.createElement("a");
				delet.textContent="Delete";
				delet.href="page5.php?udid=" + id
				actions.appendChild(edit);
				actions.appendChild(document.createTextNode('  '));
				actions.appendChild(delet);
				row.appendChild(uname);
				row.appendChild(rom);
				row.appendChild(image);
				row.appendChild(extl);
				row.appendChild(actions);
				table.appendChild(row);
			}

		}
		var p=new admin;

		var ids = <?php echo json_encode($_SESSION['uids']); ?>;
		var names = <?php echo json_encode($_SESSION['names']); ?>;
		var rooms = <?php echo json_encode($_SESSION['rooms']); ?>;
		var images = <?php echo json_encode($_SESSION['uimages']); ?>;
		var ext = <?php echo json_encode($_SESSION['ext']); ?>;

		var noOfRows= <?php echo count($_SESSION['uids']); ?>;
		var i=0;
		while (i< noOfRows)
		{
			p.showusers(ids[i], names[i], rooms[i], images[i], ext[i]);
			i++;
		}




</script>

</body>
</html>
