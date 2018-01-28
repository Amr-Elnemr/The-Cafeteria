<?php
    session_start();
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

    <b class="pull-right"><br>&nbsp;	&nbsp;	<u>Admin</u></b>
    <img src="../imgs/profile.png" class="img-responsive img-circle pull-right" style="display:inline" width="60" height="60">
    <br>
    <h2 class="fontfamily">Orders</h2>
    </div>
  </div>

  <div class="container">
    <table class="table table-bordered">

      <thead >
        <tr class="bg-primary">
          <th class="col-md-4">Order date</th>
          <th class="col-md-3">Name</th>
          <th class="col-md-2">Room</th>
          <th class="col-md-1">Ext.</th>
          <th class="col-md-2">Action</th>
        </tr>
      </thead>
      <tbody id="orderinfo" align="center">

      </tbody>
    </table>
  </div>
  <div id="imagesdiv" class="container" style="display:block">
    <div class="row">
      <div class="col-md-12" id="orderimgs">

      </div>
    </div>
  </div>
  <script type="text/javascript">
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

          orderInfo.appendChild(row);

          row = document.createElement('tr');
          col = document.createElement('td');
          col.setAttribute('colspan', "5");
          for (let i = 0; i < order_detail.length; i++) {
              product = order_detail[i];
              // console.log(product);


              figure = document.createElement('figure');
              caption = document.createElement('figcaption');
              image = document.createElement('img');

              image.src = product['image'];
              image.width = "100";
              // image.style.margin = "20px";

              figure.style.border = "thin silver solid";
              figure.style['margin'] = "30px";
              figure.style['text-align'] = "center";

              caption.textContent =  product['name'] + " (price " + product['price'] + " EPG)";

              figure.appendChild(image);
              figure.appendChild(caption);
              col.appendChild(figure);
              row.appendChild(col);

          }
          s = document.createElement("br");
          total = document.createElement("h3");
          total.classList.add("pull-right");
          // total.classList.add("bottom-align-text");
          total.textContent = "total : " + order['total'] + " EPG";
          col.appendChild(s);
          col.appendChild(total);
          orderInfo.appendChild(row);
      }


  </script>

</body>
</html>
