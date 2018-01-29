<?php
ob_start();
    session_start();
    if(! isset($_SESSION['userInfo']))
        header("location: ../login.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Orders</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">

<style>
.fontfamily{
  font-family: "Allerta Stencil", Sans-serif;
}
figure {
  width: 25%;
  float: left;
  margin: 0;
  text-align: center;
  padding: 0;
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

    <b class="pull-right"><br>&nbsp;	&nbsp;	<u id="admin"></u></b>
    <img id="adminimage" class="img-responsive img-circle pull-right" style="display:inline" width="60" height="60">
    <br>
    <h2 class="fontfamily">Orders</h2>
    </div>
  </div>

  <div class="container">
    <!-- <table class="table table-striped">

      <thead >
        <tr class="bg-primary">
          <th class="col-md-4">Order date</th>
          <th class="col-md-3">Name</th>
          <th class="col-md-2">Room</th>
          <th class="col-md-1">Ext.</th>
          <th class="col-md-2">Action</th>
        </tr>
      </thead>

    </table> -->
    <div id="orderinfo" align="center">

    </div>
  </div>
  <div id="imagesdiv" class="container" style="display:block">
    <div class="row">
      <div class="col-md-12" id="orderimgs">

      </div>
    </div>
  </div>
  <script type="text/javascript">
      let currentUser = <?php echo json_encode($_SESSION['userInfo']); ?>;
      document.getElementById("admin").textContent = currentUser['name'];
      document.getElementById("adminimage").src = currentUser['image'];
      window.addEventListener("beforeunload", function() {
          window.location.href = "order.php";
      });
      let orders = <?php echo json_encode($_SESSION['orders']); ?>;
      let orders_detail = <?php echo json_encode($_SESSION['orders_detail']); ?>;
      let orderInfo = document.getElementById('orderinfo');
      // let orderImgs = document.getElementById('orderimgs');
      for (let i = 0; i < orders.length; i++) {
          order = orders[i];
          order_detail = orders_detail[i];
          table = document.createElement('table');
          table.classList.add("table");
          head = document.createElement('thead');
          mainRow = document.createElement('tr');
          mainRow.classList.add("bg-primary");
          th1 = document.createElement('th');
          th2 = document.createElement('th');
          th3 = document.createElement('th');
          th4 = document.createElement('th');
          th5 = document.createElement('th');
          th1.textContent = "Order Date";
          th2.textContent = "Name";
          th3.textContent = "Room";
          th4.textContent = "Ext.";
          th5.textContent = "Action";
          mainRow.appendChild(th1);
          mainRow.appendChild(th2);
          mainRow.appendChild(th3);
          mainRow.appendChild(th4);
          mainRow.appendChild(th5);
          row = document.createElement('tr');
          date = document.createElement('td');
          n = document.createElement('td');
          roomNo = document.createElement('td');
          phone = document.createElement('td');
          action = document.createElement('td');
          deliver = document.createElement('a');

          deliver.setAttribute("href", "order.php?deliver=true&id="+order['order_id']);

          date.textContent = order['date'];
          n.textContent = order['name'];
          roomNo.textContent = order['room_no'];
          phone.textContent = order['phone'];
          deliver.textContent = "deliver";
          action.appendChild(deliver);

          row.appendChild(date);
          row.appendChild(n);
          row.appendChild(roomNo);
          row.appendChild(phone);
          row.appendChild(action);
          table.appendChild(mainRow);
          table.appendChild(row);
          orderInfo.appendChild(table);

          row = document.createElement('div');

          row.classList.add("col-md-12");

          for (let i = 0; i < order_detail.length; i++) {
              product = order_detail[i];
              // col = document.createElement('td');
              figure = document.createElement('figure');
              caption = document.createElement('figcaption');
              image = document.createElement('img');

              image.src = product['image'];
              image.width = "40";
              image.height = "40"
              image.style.dispaly = 'inline'

              figure.style['margin'] = "5px";
              figure.style['text-align'] = "center";

              caption.textContent =  product['name'] + " (price " + product['price'] + " EPG)";

              figure.appendChild(image);
              figure.appendChild(caption);
              // col.appendChild(figure);
              row.appendChild(figure);

          }

          // s = document.createElement("br");
          total = document.createElement("h3");
          // total.classList.add("pull-right");
          // total.classList.add("bottom-align-text");
          total.textContent = "total : " + order['total'] + " EPG";

          // col.appendChild(s);
          row.appendChild(total);

          orderInfo.appendChild(row);
      }


  </script>

</body>
</html>
