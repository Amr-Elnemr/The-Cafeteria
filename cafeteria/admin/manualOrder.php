<?php
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title></title>
    </head>
    <body>
        <div class="container">

            <div class="page-header">
                <a href="page2.html" class="btn btn-info btn-sm " >Home</a>
                <a href="user.php?show=true" class="btn btn-info btn-sm" >My Orders</a>
                <img src="../imgs/profile.png" width="40" class="pull-right">
                <a href="#" class="pull-right" style="text-align: center">Name</a>
            </div>
            <div class="row">
                <form class="" action="order.php" method="post">
                    <div class="panel panel-default col-lg-5" style="height: 800px;"  >
                        <div class="panel-heading" style="height: 7%" align="center">
                            <p>Order</p>
                        </div>
                        <div class="panel-body" style="height: 80%" id="panel">

                                <div >
                                    <table id="orders" border="solid">

                                    </table>
                                </div>
                                <div id="notes" style="display: none">
                                    <!-- <p style="position: relative; top: 40%">Notes</p> -->
                                    <textarea name="notes" placeholder="Notes" class="form-control" rows ="8" style="margin-top: 25px;"></textarea>
                                </div>
                                <div id="room" style="display: none">
                                    <h2 style="position: relative; top: 40%">Room</h2>
                                    <select name="room" class="form-control" style="position: relative; top: 40%;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div id="u" style="display: none">
                                    <h2 style="position: relative; top: 40%">Add To User</h2>
                                    <select id="users" name="user">
                                        <option >----------------------------</option>

                                    </select>
                                </div>


                            </div>
                            <div class="panel-footer">
                                <h1 id="totalprice">  EPG 00</h1>
                                <button type="submit"  class="btn btn-primary">Confirm</button>
                                <input type="hidden" name="neworder" value="true"/>
                            </div>



                    </div>

                </form>

                <div class="row search-container pull-right">
                    <form action="#">
                        <input type="text" placeholder="Search.." name="search">
                       <span class="glyphicon glyphicon-search"></span>
                    </form>
                </div>
                <br /><br />


                <div id="products" class="col-lg-7">

                </div>
            </div>

        </div>
        <script type="text/javascript">

            window.addEventListener("beforeunload", function() {
                window.location.href = "products.php";
            });
            let products = <?php echo json_encode($_SESSION['products']); ?>;
            let users = <?php echo json_encode($_SESSION['users']); ?>;

            let preview = document.getElementById("products");
            let addTOUser = document.getElementById('users');

            for (var i = 0; i < products.length; i++)
            {
                product = products[i];

                figure = document.createElement('figure');
                caption = document.createElement('figcaption');
                image = document.createElement('img');

                image.src = product['image'];
                image.name = product['name'] + "-" + product['price'] ;
                image.width = "130";
                image.style.margin = "5px";

                caption.textContent =  product['name'] + " (price " + product['price'] + " EPG)";

                figure.style.display = "inline-block";
                figure.style.border = "thin silver solid";
                figure.style.margin = "25px";
                figure.style['text-align'] = "center";

                figure.appendChild(image);
                figure.appendChild(caption);
                preview.appendChild(figure);


            }
            for (var i = 0; i < users.length; i++) {
                user = users[i];
                console.log(user['name']);
                op = document.createElement('option');
                op.textContent =user['name'];
                addTOUser.appendChild(op);
            }
        </script>

       <script src="manualOrder.js"></script>

    </body>
</html>