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
	<title>All Users</title>
	<link rel="stylesheet" type="text/css" href="pg5.css">
</head>
<body>
	<div>
		<a class="menu" href="">Home</a>
		<a class="menu" href="">Products</a>
		<a class="menu" href="">Users</a>
		<a class="menu" href="">Manual Order</a>
		<a class="menuLast" href="">Checks</a>

		<span id='adm'>
			<img id="usrImg" src="user.png">
			<a id="usrName" href="">Admin</a>
		</span>

	</div>

	<div id="line2">
		<a id="title">All Users</a>
		<span><a id="addUser" href="">Add User</a></span>
	</div>

	<table>
		<tr>
			<th>Name</th>
			<th>Room</th>
			<th>Image</th>
			<th>Ext.</th>
			<th>Action</th>
		</tr>
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
<!-- ------------------------------------------- -->
<script type="text/javascript">
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
				image.textContent=imag;
				var extl=document.createElement("td");
				extl.textContent=ext;
				var actions=document.createElement("td");
				var edit= document.createElement("a");
				edit.textContent="Edit";
				edit.href="page5.php?ueid=" + id
				var delet= document.createElement("a");
				delet.textContent="Delete";
				delet.href="page5.php?udid=" + id
				actions.appendChild(edit);
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