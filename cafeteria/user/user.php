<?php
    session_start();
 ?>

<?php
    require_once('order.php');
    $dsn = "mysql:host=localhost;dbname=cafeteria";
    $db = new PDO($dsn, "tarek", "tito");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    class User
    {
        public function cancel_order()
        {
            global $db;
            $status = $db -> query("SELECT status FROM orders WHERE order_id="."'".$_GET['order_id']."'");
            $status = $status -> fetch(PDO::FETCH_ASSOC);
            if($status['status'] == "processing")
                $db -> query("DELETE FROM orders WHERE order_id="."'".$_GET['order_id']."'");
        }


    }

    if($_POST['neworder'] == "true"){
        echo "fff";
        $order = new Order;
        $order -> insert_order();
        $order -> show_orders();
        header("location: myorders.php");
        $_POST['neworder'] = "false";
    }

    if($_GET['delete'] == "true"){
        $user = new User;
        $order = new Order;
        $user -> cancel_order();
        $order -> show_orders();
        header("location: myorders.php");
    }
    if($_GET['show'] == "true"){
        $order = new Order;
        $order -> show_orders();
        header("location: myorders.php");
    }


 ?>
