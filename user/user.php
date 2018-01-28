<?php
    session_start();
 ?>

<?php
    require_once('order.php');
    $dsn = "mysql:host=localhost;dbname=cafeteria";
    $db = new PDO($dsn, "amr", "amr1990");
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

    if(isset($_POST['neworder']) && $_POST['neworder'] == "true"){
        $order = new Order;
        $order -> insert_order();
        $order -> show_orders();
        $_POST['neworder'] = "false";
        header("location: myorders.php");
    }

    if(isset($_GET['delete']) && $_GET['delete'] == "true"){
        $user = new User;
        $order = new Order;
        $user -> cancel_order();
        $order -> show_orders();
        header("location: myorders.php");
    }
    if(isset($_GET['show']) && $_GET['show'] == "true"){
        $order = new Order;
        $order -> show_orders();
        header("location: myorders.php");
    }
    if(isset($_GET['showbydate']) && $_GET['showbydate'] == "true"){
        $order = new Order;
        $order -> show_orders_by_date();
        header("location: myorders.php");

    }

    $order = new Order;
    $order -> show_orders();
    header("location: myorders.php");


 ?>
