<?php
ob_start();
    session_start();
    if(! isset($_SESSION['userInfo']))
        header("location: ../login.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>All Users</title>
	<!-- <link rel="stylesheet" type="text/css" href="page5.css"> -->
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
<a href="products.php"><b class="fontfamily">Home</b></a>
<b> | </b>
<a href="user.php"><b class="fontfamily">Orders</b></a>
<br>
<h2 class="fontfamily">My Orders</h2>
<img id="userimage" width="40" class="pull-right">
<b class="pull-right"><br>&nbsp;	&nbsp;	<u id="user" class="pull-right"></u></b>
</div>
</div>
    <div class="container">


        <div class='col-md-3'>
            <div class="form-group">
              <p class="fontfamily">from date:</p>
                    <input id="datefrom" type='date' class="form-control" value="YYYY-MM-DD"/>
            </div>
        </div>
        <div class='col-md-3'>
            <div class="form-group">
              <p class="fontfamily">to date:</p>
                    <input id="dateto" type='date' class="form-control" value="YYYY-MM-DD"/>
            </div>
        </div>

	<table class="table table-bordered" id="orders">
        <thead>
            <tr class="bg-primary">
    			<th>Order Date</th>
    			<th>Status</th>
    			<th>Amount</th>
    			<th>Action</th>
    		</tr>
        </thead>

	</table>

	<table class="table table-bordered" id="details">

	</table>
	<h1 id="total"></h1>

	<script type="text/javascript">
    let user =  <?php echo json_encode($_SESSION['userInfo']); ?>;
    document.getElementById("user").textContent = user['name'];
    document.getElementById("userimage").src = user['image'];
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
            detail.classList.add('btn');
            detail.classList.add('btn-primary');

			orderDate.textContent = order['date'] + " " + order['time'];
			orderDate.appendChild(detail);
			status.textContent = order['status'];
			amount.textContent = order['total'] + " EPG";
			if(order['status'] === "processing"){
				let cancel = document.createElement('a');
				console.log(order['order_id']);
				cancel.setAttribute("href", "user.php?delete=true&order_id="+order['order_id']);
				cancel.textContent = "cancel";
                cancel.classList.add('btn');
                cancel.classList.add('btn-danger');
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
							image.width = "70";
                            image.height = "70";
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
