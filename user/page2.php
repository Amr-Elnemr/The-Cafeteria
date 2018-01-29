<?php
ob_start();
    session_start();
    if(! isset($_SESSION['userInfo']))
        header("location: ../login.php");
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">

        <style>
        .fontfamily{
            font-family: "Allerta Stencil", Sans-serif;
            }
        </style>
        <title></title>
    </head>
    <body>
        <div class="container">
    <div class="jumbotron">
    <a href="products.php"><b class="fontfamily">Home</b></a>
    <b> | </b>
    <a href="user.php?show=true"><b class="fontfamily">Orders</b></a>
    <br>
    <h2 class="fontfamily">Home</h2>
    <img id="userimg" width="40" class="pull-right">
    <b class="pull-right"><br>&nbsp;	&nbsp;	<u id="user" class="pull-right">Name</u></b>
    </div>
  </div>
        <div class="container">

            <!-- <div class="page-header">
                <a href="products.php" class="btn btn-info btn-sm " >Home</a>
                <a href="user.php?show=true" class="btn btn-info btn-sm" >My Orders</a>

            </div> -->
            <div class="row">
                <form class="" action="user.php" method="post">
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
                                    <select id="rooms" name="room" class="form-control" style="position: relative; top: 40%;">
                                        <option value=""></option>
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


                <div id="products" class="col-lg-7">

                </div>
            </div>

        </div>
        <script type="text/javascript">
        // document.addEventListener("beforeunload", function(){
        //     document.location.href = "products.php";
        //     console.log("refresh");
        // });
        let user =  <?php echo json_encode($_SESSION['userInfo']); ?>;
        let rooms = <?php echo json_encode($_SESSION['rooms']); ?>;

        document.getElementById("user").textContent = user['name'];
        document.getElementById("userimg").src = user['image'];
        document.onbeforeunload = function(e){
            // e,preventDefault
            // document.stop();
            document.location.href = "products.php";
            // console.log("refresh");
        }
        let products = <?php echo json_encode($_SESSION['products']); ?>;

            let preview = document.getElementById("products");
            let addRooms = document.getElementById('rooms');

            for (let i = 0; i < products.length; i++)
            {
                product = products[i];

                figure = document.createElement('figure');
                caption = document.createElement('figcaption');
                image = document.createElement('img');

                image.src = product['image'];
                image.name = product['name'] + "-" + product['price'] ;
                image.width = "70";
                image.height = "70";
                image.style.cursor = 'pointer'
                image.style.margin = "5px";

                caption.textContent =  product['name'] + " (price " + product['price'] + " EPG)";

                figure.style.display = "inline-block";
                // figure.style.border = "thin silver solid";
                figure.style.margin = "25px";
                figure.style['text-align'] = "center";

                figure.appendChild(image);
                figure.appendChild(caption);
                preview.appendChild(figure);

            }

            for (let i = 0; i < rooms.length; i++) {
                room = rooms[i];
                ro = document.createElement('option');
                ro.textContent = room;
                console.log(ro);
                addRooms.appendChild(ro);
            }
        </script>
       <script src="page2JavaScript.js"></script>

    </body>
</html>
