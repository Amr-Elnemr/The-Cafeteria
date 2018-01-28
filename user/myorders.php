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
		<a class="menu" href="products.php">Home</a>
		<a class="menuLast" href="user.php">My Orders</a>


		<span id='adm'>
			<img id="usrImg" src="../imgs/profile.png">
			<a id="usrName" href="">Islam Askar</a>
		</span>

	</div>

	<div id="line2">
		<a id="title">My Orders</a>
	</div>

	<div align="center">
		 Date From: <input type="date"  placeholder="Date From" name="bday" id="datefrom">
		 Date to: <input type="date" placeholder="Date to" name="bday" id="dateto">
	</div>

	<table id="orders">
		<tr>
			<th>Order Date</th>
			<th>Status</th>
			<th>Amount</th>
			<th>Action</th>
		</tr>
	</table>

	<table id="details">

	</table>
	<h1 id="total"></h1>

	<script type="text/javascript">
		let orders = <?php echo json_encode($_SESSION['orders']); ?>;
		let orderDetails = <?php echo json_encode($_SESSION['orders_detail']); ?>;

		let details = document.getElementById('details');
		let table = document.getElementById('orders');
		let showTotal = document.getElementById('total');
		let dateFromFlag = false;
		let dateToFlag = false;
		let dateFrom = "";
		let dateTo = "";
		let opened = false;
		let total = 0;

		for (var i = orders.length - 1; i >= 0 ; i--) {
			order = orders[i];
			total += Number(order['total']);
			let row = document.createElement("tr");
			let orderDate = document.createElement("td");
			let status = document.createElement("td");
			let amount = document.createElement("td");
			let action = document.createElement("td");
			let detail = document.createElement('a');

			detail.setAttribute("href", "#");
			detail.textContent = "details";
			detail.style['margin-left'] = "25px";
			detail.addEventListener("click", showDetails);
			detail.id = order['order_id'];

			orderDate.textContent = order['date'] + " " + order['time'];
			orderDate.appendChild(detail);
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
		showTotal.textContent = "Total : " + total + " EPG";

		function showDetails(e){
			if(!opened){
				opened = true;
				details.textContent = "";
				for (let i = 0; i < orderDetails.length; i+=2) {
					orderDetail = orderDetails[i];

					if(e.target.id == orderDetail)
					{
						or = orderDetails[i+1];
						row = document.createElement('tr');
			            col = document.createElement('td');
			            // col.setAttribute('colspan', "4");
						for (let i = 0; i < or.length; i++)
						{
							product = or[i];
							figure = document.createElement('figure');
							caption = document.createElement('figcaption');
							image = document.createElement('img');

							image.src = product['image'];
							image.width = "100";
							// image.style.margin = "20px";

							figure.style.border = "thin silver solid";
							figure.style['margin'] = "30px";
							figure.style['text-align'] = "center";

							caption.textContent =  product['name'] + " (price " + product['price'] + " EPG)" + " count = "+ product['quantity'];

							figure.appendChild(image);
							figure.appendChild(caption);
							col.appendChild(figure);


						}
						row.appendChild(col);
						details.appendChild(row);
						return;
					}
				}
			}
			else{
				details.textContent = "";
				opened = false;
			}

		}

		document.getElementById('datefrom').onchange = function(e){
			console.log(e.target.value);
			dateFrom = e.target.value;
			dateFromFlag = true;
			go();

		};

		document.getElementById('dateto').onchange = function(e){
			console.log(e.target.value);
			dateTo = e.target.value;
			dateToFlag = true;
			go();
		};

		function go()
		{
			if(dateFromFlag && dateToFlag)
				window.location.href = `user.php?showbydate=true&datefrom=${dateFrom}&dateto=${dateTo}` ;
		}


	</script>

</body>
</html>
