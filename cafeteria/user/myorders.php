<?php
    session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>All Users</title>
	<link rel="stylesheet" type="text/css" href="page5.css">
</head>
<body>
	<div>
		<a class="menu" href="">Home</a>
		<a class="menuLast" href="">My Orders</a>


		<span id='adm'>
			<img id="usrImg" src="../imgs/profile.png">
			<a id="usrName" href="">Islam Askar</a>
		</span>

	</div>

	<div id="line2">
		<a id="title">My Orders</a>
	</div>

	<div align="center">
		 Date From: <input type="date"  placeholder="Date From" name="bday">
		 Date to: <input type="date" placeholder="Date to" name="bday">
	</div>

	<table id="orders">
		<tr>
			<th>Order Date</th>
			<th>Status</th>
			<th>Amount</th>
			<th>Action</th>
		</tr>
	</table>

	<script type="text/javascript">
		let orders = <?php echo json_encode($_SESSION['orders']); ?>;
		let table = document.getElementById('orders');
		for (var i = orders.length - 1; i >= 0 ; i--) {
			order = orders[i];
			let row = document.createElement("tr");
			let orderDate = document.createElement("td");
			let status = document.createElement("td");
			let amount = document.createElement("td");
			let action = document.createElement("td");
			orderDate.textContent = order['date'] + " " + order['time'];
			status.textContent = order['status'];
			amount.textContent = order['total'] + " EPG";
			if(order['status'] === "processing"){
				let cancel = document.createElement('a');
				console.log(order['order_id']);
				cancel.setAttribute("href", "user.php?delete=true&order_id="+order['order_id']);
				cancel.textContent = "cancel";
				action.appendChild(cancel);
			}
			row.appendChild(orderDate);
			row.appendChild(status);
			row.appendChild(amount);
			row.appendChild(action);
			table.appendChild(row);
		}

	</script>

</body>
</html>
