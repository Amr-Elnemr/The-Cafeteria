<?php
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <table border="solid" id="orders">
            <tr>
                <th>Order Date</th>
                <th>status</th>
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
