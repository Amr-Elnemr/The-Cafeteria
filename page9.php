<?php
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Checks</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
  <style>
    .fontfamily{
      font-family: "Allerta Stencil", Sans-serif;
    }
    #table2{
      width: 85%;
    }
    tr:hover {
          background-color: gray;
        }
    #imagesdiv{
      border: 1px solid gray;
      border-radius: 6px;
      width: 70%;
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
    <a href="#"><b class="fontfamily">Home</b></a>
    <b> | </b>
    <a href="#"><b class="fontfamily">Products</b></a>
      <b> | </b>
    <a href="#"><b class="fontfamily">Users</b></a>
      <b> | </b>
    <a href="#"><b class="fontfamily">Manual Orders</b></a>
      <b> | </b>
    <a href="#"><b class="fontfamily">Checks</b></a>

    <b class="pull-right"><br>&nbsp;	&nbsp;	<u>Admin</u></b>
    <img src="images/user.png" class="img-responsive img-circle pull-right" style="display:inline" width="60" height="60">
    <br>
    <h2 class="fontfamily">Checks</h2>
    </div>
  </div>

  <div class="container">
      <div class="row">
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
      </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
					<select id="dropusers" class="form-control showusers" name="users">
						<option value="all">all</option>

					</select>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr class="bg-primary">
          <th class="col-md-6">Name</th>
          <th class="col-md-6">Total Amount</th>
        </tr>
      </thead>
      <tbody  id="display1">



      </tbody>
    </table>
  </div>
<br>

  <div id="table2" class="container" style="display:none">
    <table class="table table-bordered">
      <thead>
        <tr class="bg-primary">
          <th class="col-md-5">Order Date</th>
          <th class="col-md-5">Total Amount</th>
        </tr>
      </thead>
      <tbody id="display2">

      </tbody>
    </table>
  </div>

  <div id="imagesdiv" class="container" style="display:none">
    <div class="row">
      <div id="display3">
        
      </div>
    </div>
  </div>

  <div class="container">
  <ul class="pager">
    <li><a href="#"><img class="img-responsive img-circle" style="display:inline" src="images/prev.png" width="20" height="20"></a></li>
    <li><a href="#"><img class="img-responsive img-circle" style="display:inline" src="images/prev1.png" width="20" height="20"></a></li>

    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">..</a></li>

    <li><a href="#"><img class="img-responsive img-circle" style="display:inline" src="images/next1.png" width="20" height="20"></a></li>
    <li><a href="#"><img class="img-responsive img-circle" style="display:inline" src="images/next.png" width="20" height="20"></a></li>
  </ul>
</div>

<!-- <script src="page9.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
// document.addEventListener("DOMContentLoaded", function () {
  var datetochanged = false;
  var datefromchanged = false;
  var usernamechanged = false;
  var displaytable2 = true;
  var opened1 = false;
  var usernamevalue = 'all';
  var datefromvalue = '2018-01-01';
  var datetovalue = '2018-01-30';
  var datefrombotton = document.getElementById('datefrom');
  var datetobotton = document.getElementById('dateto');
  var allpayments = <?php echo json_encode($_SESSION['allpayment']); ?>;
  var display1 = document.getElementById('display1');
  var showusers = document.getElementsByClassName('showusers')[0];
  var display2 = document.getElementById('display2');
  var table2 = document.getElementById('table2');
  table2.style.display = 'none';


  for (var i = 0; i < allpayments.length; i++) {

  var record =  allpayments[i].split(":")
  var tablerow = document.createElement('tr')

  var showbotton = document.createElement('img');
  showbotton.setAttribute('src', 'images/add.png');
  showbotton.setAttribute('width', 15);
  showbotton.setAttribute('height', 15);
  showbotton.setAttribute('style', "cursor:pointer");
  showbotton.setAttribute('class', 'pull-left');
  showbotton.classList.add('imgs');
  showbotton.setAttribute('id', `${record[0]}`);



  var recordcol1 = document.createElement('td');
  recordcol1.textContent = `${record[0]}`;
  recordcol1.appendChild(showbotton);
  tablerow.appendChild(recordcol1);

  var recordcol2 = document.createElement('td');
  recordcol2.textContent = `${record[1]}`;
  tablerow.appendChild(recordcol2);
  display1.appendChild(tablerow);

  var selectuser = document.createElement('option');
  selectuser.setAttribute('value',`${record[0]}`);
  selectuser.textContent = `${record[0]}`;
  showusers.appendChild(selectuser);
  }
// })
var datefrombotton = document.getElementById('datefrom');
var datetobotton = document.getElementById('dateto');
var showusers = document.getElementsByClassName('showusers')[0];
datefrombotton.addEventListener('change', function() {
  datefromchanged = true;
  datefromvalue = datefrombotton.value;
  redirect();
});
datetobotton.addEventListener('change', function () {
  datetochanged = true;
  datetovalue = datetobotton.value;
  redirect();
});
showusers.addEventListener('change', function () {
  usernamechanged = true;
  usernamevalue = showusers.value;

})


var showorders = document.getElementsByClassName('imgs')
for (var i = 0; i < showorders.length; i++) {
  showorders[i].addEventListener("click", function (e) {
    var currentname = e.target.getAttribute("id");
    display2.innerHTML = ""
      window.location.href = `php/class_admin.php?datefrom=${datefromvalue}&dateto=${datetovalue}&name=${currentname}`
  })
}

    orders = <?php if (isset($_SESSION['orders'])) {
      echo json_encode($_SESSION['orders']);}else {
        echo 'display2.innerHTML = ""';
      }  ?>;
      table2.style.display = "block"
      for (var i = 0; i < orders.length; i++) {
      var order =  orders[i].split(":")

        var roww = document.createElement('tr')

        var orderbotton = document.createElement('img');
        orderbotton.setAttribute('src', 'images/add.png');
        orderbotton.setAttribute('width', 15);
        orderbotton.setAttribute('height', 15);
        orderbotton.setAttribute('style', "cursor:pointer");
        orderbotton.setAttribute('class', 'pull-left');
        orderbotton.classList.add('orderdet');
        orderbotton.setAttribute('id', `${order[0]}`);

        var ordercol1 = document.createElement('td');
        ordercol1.textContent = `${order[1]}`;
        ordercol1.appendChild(orderbotton);
        roww.appendChild(ordercol1);

        var ordercol2 = document.createElement('td');
        ordercol2.textContent = `${order[2]}`;
        roww.appendChild(ordercol2);
        display2.appendChild(roww);
    }
    var showcontent = document.getElementsByClassName('orderdet');
    for (var i = 0; i < showcontent.length; i++) {
      showcontent[i].addEventListener("click", function (e) {
        var currentid = e.target.getAttribute("id");
          window.location.href = `php/class_admin.php?orderid=${currentid}`
      })
    }

    var content = <?php if (isset($_SESSION['content'])) {
      echo json_encode($_SESSION['content']);}else {
        echo 'console.log("no content")';
      }  ?>;
      for (var i = 0; i < content.length; i++) {
        var ordercontent =  content[i].split(":")
        console.log(ordercontent);
        var displaytable3 = document.getElementById('imagesdiv');
        displaytable3.style.display = 'block'
        var containerdiv = document.getElementById('display3');
        var fig = document.createElement('figure');
        var productimg = document.createElement('img');
        productimg.setAttribute('src',`${ordercontent[3]}`);
        productimg.setAttribute('width','40');
        productimg.setAttribute('height','40');
        var figcapt = document.createElement('figcaption');
        var pro = document.createTextNode(`Product: ${ordercontent[1]}`)
        // figcapt.appendChild(document.createElement('br'));
        var price = document.createTextNode(`Price: ${ordercontent[2]}`)
        // figcapt.appendChild(document.createElement('br'));
        var quant = document.createTextNode(`Quantity: ${ordercontent[0]}`)
        figcapt.appendChild(pro);
        figcapt.appendChild(document.createElement('br'));
        figcapt.appendChild(price);
        figcapt.appendChild(document.createElement('br'));
        figcapt.appendChild(quant);
        fig.appendChild(productimg);
        fig.appendChild(figcapt);
        containerdiv.appendChild(fig);
      }

function redirect() {
if ((datetochanged == true) && (datetochanged == true)) {
  table2.style.display = 'none';
  display2.style.display = 'none';
  display2.innerHTML="";
  window.location.href = `php/class_admin.php?datefrom=${datefromvalue}&dateto=${datetovalue}&uname=${usernamevalue}`;
}
};


</script>
</body>
</html>
