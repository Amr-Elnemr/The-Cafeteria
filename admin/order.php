<?php
ob_start();
    session_start();
    if(! isset($_SESSION['userInfo']))
        header("location: ../login.php");
 ?>

<?php
    // require_once(config.php);
    $dsn = "mysql:host=localhost;dbname=id4446548_omgamalcafeteria";
    $db = new PDO($dsn, "id4446548_tarekessam", "tito");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    class Order
    {
        private $product_names;
        private $numberOfProducts;
        private $date;
        private $time;
        private $user;
        private $room_no;
        private $note;

        public function insert_order()
        {
            global $db;
            date_default_timezone_set('Africa/Cairo');
            $this -> product_names = $_POST['products'];
            $this -> numberOfProducts = $_POST['count'];
            $this -> user = $_POST['user'];
            $this -> room_no = $_POST['room'];
            $this -> date = @date("Y-m-d");
            $this -> time = @date("h:i:sa");
            $this -> note = $_POST['notes'];
            $user = $this -> user;
            $user_id = $db -> query("SELECT user_id FROM users WHERE name='$user'");
            $user_id = $user_id -> fetch(PDO::FETCH_ASSOC);
            $user_id = $user_id['user_id'];

            $orders_table = "INSERT INTO orders VALUES (null, ?, ?, ?, ?, ?, 'processing')";
            $order_product_table = "INSERT INTO order_product VALUES (?, ?, ?)";
            $orders_table  =  $db -> prepare($orders_table );
            $order_product_table =  $db -> prepare($order_product_table);
            $orders_table -> execute([$this -> date, $this -> note, $this -> time, $user_id , $this -> room_no]);
            $order_id = $db -> lastInsertId();
            for ($i=0; $i < sizeof($this -> product_names); $i++) {
                $name = $this -> product_names[$i];
                $result =  $db -> query("SELECT * FROM products WHERE name = '$name'");
                $result = $result->fetch(PDO::FETCH_ASSOC);
                $product_id = $result['product_id'];
                $order_product_table -> execute ([$order_id, $product_id, $this -> numberOfProducts[$i]]);
            }
        }

        public function show_orders($value='')
        {
            global $db;
            $orders_detail = [];
            //$id = $this -> user_id;
            $orders = $db -> query("SELECT orders.order_id, orders.date,phone,room_no, users.name, orders.time, sum(price * quantity) AS total from users, orders, order_product, products
            where  users.user_id = orders.user_id and status='processing' and orders.order_id = order_product.order_id and order_product.product_id = products.product_id
            GROUP BY orders.order_id");
            $orders = $orders -> fetchAll();
            $_SESSION['orders'] = $orders;
            for ($i=0; $i < sizeof($orders); $i++) {
                $order = $orders[$i];
                $id = $order['order_id'];
                $detail = $db -> query("SELECT name, quantity, price, image from orders, order_product, products
                where orders.order_id=order_product.order_id and order_product.product_id = products.product_id
                and status= 'processing' and orders.order_id = $id");
                $detail = $detail -> fetchall(PDO::FETCH_ASSOC);
                array_push($orders_detail, $detail);
            }
            $_SESSION['orders_detail'] = $orders_detail;
        }

        public function deliver()
        {
            global $db;
            $db -> query("SET GLOBAL event_scheduler=ON");
            $id = $_GET['id'];
            $event = "e".$id;
            $db -> query("UPDATE orders SET status='out for delivery' WHERE order_id=$id");
            $db -> query("CREATE EVENT $event ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 10 MINUTE DO UPDATE orders SET status='done' WHERE order_id=$id");
        }
    }
    if( isset($_GET['deliver']) && $_GET['deliver'] == 'true'){
        $order1 = new Order;
        $order1 -> deliver();
        $order1 -> show_orders();
        $_GET['deliver'] = 'false';
        header("location: home.php");
    }
    if( isset($_POST['neworder']) && $_POST['neworder'] == 'true') {
        $order1 = new Order;
        $order1 -> insert_order();
        $order1 -> show_orders();
        $_POST['neworder'] = 'false';
        header("location: home.php");
    }
    $order1 = new Order;
    $order1 -> show_orders();
    header("location: home.php");
 ?>
